<?php

namespace App\Repositories\User;

use App\Interfaces\Helpers\EncryptionInterface;
use DB;
use Carbon\Carbon;
use App\Models\User\User;
use App\Interfaces\User\UserInterface;
use Illuminate\Database\QueryException;
use App\Interfaces\Helpers\StorageInterface;
use App\Exceptions\Helpers\DatabaseException;
use App\Exceptions\Partner\RoleNotFoundException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserInterface
{
    protected $user;
    protected $storage;
    protected $encryption;
    use AuthenticatesUsers;

    public function __construct(StorageInterface $storage, EncryptionInterface $encryption)
    {
        $this->storage = $storage;
        $this->encryption = $encryption;
        $this->user = app(User::class);
    }


    public function paginate($filter)
    {
        $users = $this->user->newQuery();

        if (isset($filter['role'])) {

            if ($filter['role'] == 'pending') {


                $users->where('password', null)
                    ->whereHas('roles', function ($query) {
                        return $query->where('name', 'Partner');
                    });

            } else {
                $users->whereHas('roles', function ($query) use ($filter) {
                    $query->where('name', $filter['role']);
                });
            }

        }

        if (isset($filter['partner_id'])) {
            $users->where('partner_id', $filter['partner_id']);
        }

        if (isset($filter['membership'])) {
            $users->where('membership', $filter['membership']);
        }

        $users->with(['profile', 'roles', 'owner']);


        //dd($users->getBindings());

        return $users;
    }


    public function login($credentials)
    {
        if (auth()->attempt(['email' => $credentials->email, 'password' => $credentials->password])) {
            return $this->sendLoginResponse();
        }
        return $this->sendFailedLoginResponse($credentials);
    }


    public function sendLoginResponse()
    {
        $user = auth()->user();
        $user->profile = auth()->user()->profile;

        $tokenResult = $user->createToken("Personal Access Token");
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user'         => auth()->user()
        ], 200);
    }

    public function showById($id)
    {

        try {

            $user = $this->user->with('profile')->findOrFail($id);


            return $user;

        } catch (ModelNotFoundException $e) {
            throw new RoleNotFoundException();
        }


    }


    public function showByEmail($email)
    {
        try {
            $user = $this->user->with('profile')->where('email', $email)->first();
            return $user;
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException();
        }
    }

    public function register($data, $role)
    {
        try {
            DB::beginTransaction();

            $user = $this->user->create([
                'partner_id' => auth()->check() ? auth()->user()->id : null,
                'email'      => $data['email'],
                'password'   => isset($data['password']) ? $this->encryption->encryptString($data['password']) : null,
                'locale'     => app()->getLocale()
            ]);

            if (request()->file('id_card') || request()->file('proof_residence')){
                $idCard = $this->storage->save('users/' . $user->id . '/', request()->file('id_card'));
                $proofResidence = $this->storage->save('users/' . $user->id . '/', request()->file('proof_residence'));
            }
            $user->profile()->create([
                'name'            => $data['name'],
                'lastname'        => $data['lastname'],
                'whatsapp'        => $data['whatsapp'],
                'country_code'    => 'MX',
                'id_card'         => isset($idCard) ? $idCard : null,
                'proof_residence' => isset($proofResidence) ? $proofResidence : null,
            ]);

            $user->assignRole($role);

            DB::commit();

            return $user->load('profile', 'roles');


        } catch (QueryException $e) {

            DB::rollBack();
            throw new DatabaseException();
        }
    }


    public function changeRole($id, $role)
    {
        try {
            DB::beginTransaction();

            $user = $this->user->find($id);
            $user->syncRoles([$role]);


            DB::commit();

            return $user;
        } catch (QueryException $e) {
            DB::rollBack();
            throw new DatabaseException();
        }
    }


    public function showAllByRole($role)
    {

        $partners = $this->user
            ->whereHas('roles', function ($query) use ($role) {
                return $query->where('name', $role);
            })
            ->with('profile')
            ->get();

        return $partners;
    }

    public function forgotPassword($user)
    {
        $token = Str::random(60);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email'      => $user->email,
                'token'      => $token,
                'created_at' => now()
            ]
        );
        return $passwordReset;
    }

    public function logout()
    {
        $accessToken = auth()->user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);
        $accessToken->revoke();

        return response()->json(null, 204);
    }

    public function delete($id)
    {

        $user = $this->showById($id);
        $user->delete();

    }


    public function updateProfile($id, $data)
    {

        $user = $this->showById($id);

        try {

            DB::beginTransaction();

            $user->email = value_instead($data, 'email', $user->email);
            $user->membership = value_instead($data, 'membership', $user->membership);
            $user->save();


            $profile = $user->profile;
            $profile->name = value_instead($data, 'name', $profile->name);
            $profile->lastname = value_instead($data, 'lastname', $profile->name);
            $profile->photo = value_instead($data, 'photo', $profile->photo);
            $profile->whatsapp = value_instead($data, 'whatsapp', $profile->whatsapp);
            $profile->id_card = value_instead($data, 'id_card', $profile->id_card);
            $profile->proof_residence = value_instead($data, 'proof_residence', $profile->proof_residence);
            $profile->save();

            DB::commit();

            return $user;


        } catch (QueryException $e) {

            DB::rollBack();
            throw new DatabaseException();
        }

    }

    public function updateCredentials($id, $data)
    {
        $user = $this->showById($id);

        $user->password = $data['password'];
        $user->save();

        return $user;
    }

}

<?php

use App\Models\User\User;
use App\Models\User\Profile;
use Illuminate\Database\Seeder;
use App\Interfaces\Helpers\EncryptionInterface;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(EncryptionInterface $encryption)
    {

        $memberships = array_keys(config('memberships'));

        if (env('APP_ENV') === 'production') {

            $user = factory(User::class)->create([
                'email'    => 'info@veltacorp.com',
                'password' => $encryption->encryptString('Ivelta932_33'),
                'locale'   => 'es'
            ]);
            $user->profile()->save(factory(Profile::class)->make());
            $user->save();
            $user->assignRole('Super Admin');

        } else {

            factory(User::class, 5)->create()->each(function ($user) use ($memberships) {

                $user->profile()->save(factory(Profile::class)->make());

                if ($user->id > 1) {
                    $user->assignRole('Partner');
                    $user->membership = $memberships[random_int(0, count($memberships) - 1)];
                    $user->save();
                } else {
                    $user->email = 'admin@mail.com';
                    $user->assignRole('Super Admin');
                    $user->save();
                }


            });

        }


        Artisan::call('passport:client --name=veltaApp --no-interaction --personal');
    }
}

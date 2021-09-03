<?php


use App\Models\User\User;
use App\Models\Investment\Plan;
use Illuminate\Database\Seeder;
use App\Models\Investment\Report;
use App\Models\Investment\Transaction;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;


class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $plan = Plan::first();

        $users->each(function ($user) use ($plan) {
            $startDate = now()->subMonth(6);

            $investment = $user->investment()->create([
                'plan_id'           => $plan->id,
                'currency_id'       => $plan->currency_id,
                'start_date'        => $startDate,
                'end_date'          => $startDate->copy()->addYear(),
                'balance'           => 50000,
                'profit_percentage' => $plan->profit_percentage,
                'period_in_years'   => 1,
                'status'            => 'on_progress',
            ]);
            $investment->transactions()->createMany(factory(Transaction::class, 1)->make()->toArray());
            $investment->reports()->createMany(factory(Report::class, 4)->make()->toArray());

            $investment->reports()->each(function ($report) use ($user) {
                // Set fake report.
                $fakePdfReport = file_get_contents(storage_path('1593457516.pdf'));
                $filePath = 'users/' . $user->id . '/reports/' . now()->timestamp . $report->id . '.pdf';
                Storage::put('public/' . $filePath, $fakePdfReport);
                $report->file = $filePath;
                $report->save();
            });
        });

        Artisan::call('generate:profit');
    }
}

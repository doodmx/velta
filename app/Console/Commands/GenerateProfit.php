<?php

namespace App\Console\Commands;

use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Investment\Investment;

class GenerateProfit extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'generate:profit';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Generate a investment profit';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $this->generateProfit();
    }

    /**
     * Generate a performance
     */
    public function generateProfit(){
        $investmentList = Investment::where('status', 'on_progress')->get();

        try {
            DB::beginTransaction();
            foreach ($investmentList as $investment) {
                $lastPeriod = $investment->transactions->where('type', 'profit')->last();
                $periodNumber = $investment->transactions->where('type', 'profit')->count() + 1;

                //Performance information
                $performanceByYear = ($investment->balance * $investment->profit_percentage) / 100;
                $performanceByMonth = $performanceByYear / 12;

                //Period information
                $startPeriod = (($lastPeriod) ? $lastPeriod->end_date : $investment->start_date);
                $endPeriod = $investment->start_date->copy()->addMonthsNoOverflow($periodNumber);

                //Current date information
                $difference = Carbon::parse($startPeriod)->copy()->diffInMonths(now());
                //$difference = $now->diffInMonths($startPeriod);
                if ($difference != 0) {
                    $transactionDB = $this->createProfit($investment, $performanceByMonth, $startPeriod, $endPeriod);
                    $this->generateProfit();
                    Log::info('Transacción '.$transactionDB->id.' generada correctamente.');
                    $this->info('Transacción '.$transactionDB->id.' generada correctamente.');
                }
            }
            DB::commit();
        }
        catch (QueryException $e) {
            DB::rollBack();
            Log::error("Ocurrio un error al generar los rendimientos. ".$e->getMessage());
        }
    }

    /**
     * Create a new performance
     * @param $investment
     * @param $amount
     * @param $startPeriod
     * @param $endPeriod
     * @return mixed
     */
    public function createProfit($investment, $amount, $startPeriod, $endPeriod)
    {
        $transaction = [
            'amount'     => $amount,
            'balance'    => 0, //cuanto tenia
            'start_date' => $startPeriod,
            'end_date'   => $endPeriod,
            'type'       => 'profit',
            'status'     => 'applied',
            'created_at' => $endPeriod->toDateString().' '.Carbon::now()->toTimeString()
        ];

        $transactionDB = $investment->transactions()->create($transaction);

        return $transactionDB;
    }
}

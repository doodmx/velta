<?php

namespace App\Http\Controllers\User;

use App\DataTables\ReportDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\User\UserInterface;
use App\Interfaces\Investment\ReportInterface;
use App\Interfaces\Investment\InvestmentInterface;
use App\Http\Requests\Investment\CreateReportRequest;

class ReportController extends Controller
{
    protected $user;
    protected $report;
    protected $investment;

    public function __construct(
        UserInterface $useContract,
        ReportInterface $reportContract,
        InvestmentInterface $investmentContract
    )
    {
        $this->user = $useContract;
        $this->report = $reportContract;
        $this->investment = $investmentContract;
    }

    public function index($userId, $investmentId, ReportDataTable $reportDataTable)
    {
        $user = $this->user->showById($userId);
        $investment = $this->investment->allByStatus($userId);

        return $reportDataTable
            ->with('investmentId', $investmentId)
            ->render('admin.users.investment.reports.index', [
                'user'       => $user,
                'investment' => $investment
            ]);
    }

    public function store($userId, $investmentId, CreateReportRequest $request)
    {
        $report = $this->report->create($request);

        return response()->json($report, 201);
    }


    public function destroy($userId, $investmentId, $reportId)
    {
        $this->report->delete($reportId);
        return response()->json( 201);
    }
}

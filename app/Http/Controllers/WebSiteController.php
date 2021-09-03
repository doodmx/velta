<?php

namespace App\Http\Controllers;

use Analytics;
use App\Exceptions\Helpers\AnalyticsException;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Spatie\Analytics\Period;
use App\Http\Requests\Lead\SendLeadRequest;
use App\Interfaces\Helpers\StorageInterface;
use App\Interfaces\User\UserInterface;
use App\Notifications\LeadCreated;
use App\Notifications\LeadMail;
use App\Notifications\AppointmentMail;
use App\Http\Requests\Lead\LeadMailRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\Lead\AppointmentMailRequest;


class WebSiteController extends Controller
{


    public function index()
    {
        return view('web.index');
    }


    public function getAbout()
    {
        return view('web.about');
    }

    public function getWeDo()
    {
        return view('web.we_do');
    }

    public function getMembership()
    {
        return view('web.membership');

    }

    public function getIntro()
    {
        return view('web.intro');

    }

    public function getVeltaCenter()
    {
        return view('web.velta_center');

    }

    public function getTerms()
    {
        return view('web.legal.terms');
    }


    public function getPolicies()
    {
        return view('web.legal.policies');
    }

    public function sendLead(SendLeadRequest $request, UserInterface $userContract, StorageInterface $storage)
    {
        try {

            if (!auth()->check()) {
                Notification::route('mail', 'info@veltacorp.com')
                    ->notify(new LeadCreated($request['lastname'] . ' ' . $request['name'], $request['whatsapp'], $request['email']));
            }

            $role = auth()->check() ? 'Investment' : 'Partner';
            $user = $userContract->register($request->all(), $role);

            $message = auth()->check() ? __('messages.register.success_investment') : __('messages.register.success_partner');
            return response()->json([
                'message'    => $message,
                'user'       => $user,
                'is_partner' => auth()->check()
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'message' => __('messages.register.error_exception') . $e->getMessage(),
            ], 500);
        }
    }


    public function sendLeadmail(LeadMailRequest $request)
    {
        try {
            Notification::route('mail', config('mail.from')["address"])
                ->notify(new LeadMail($request->all()));
            return response()->json(["message" => __('web/forms.contact')['success']], 200);
        } catch (\Exception $ex) {
            return response()->json(["message" => __('web/forms.contact')['error']], 500);
        }
    }

    public function sendAppointmentMail(AppointmentMailRequest $request)
    {
        try {
            Notification::route('mail', config('mail.from')["address"])
                ->notify(new AppointmentMail($request->all()));
            return response()->json(["message" => __('web/forms.schedule')['success']], 200);
        } catch (\Exception $ex) {
            return response()->json(["message" => __('web/forms.scheduler')['error']], 500);
        }
    }

    public function changeLocale($locale)
    {

        session()->put('locale', $locale);
        return redirect()->back();

    }

    public function getAnalytics()
    {
        return view('admin.analytics');
    }

    public function getAnalyticsStats()
    {

        $to = Carbon::now();
        $from = Carbon::now()->subDays(7);

        try {


            $analyticsPeriod = Period::create($from, $to);

            $carbonPeriod = CarbonPeriod::create($from, $to);

            $browsersData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics'    => 'ga:entrances',
                    'dimensions' => 'ga:browser'
                ]
            );

            $visitorsData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics'    => 'ga:users,ga:newUsers',
                    'dimensions' => 'ga:day'
                ]
            );

            $generalStats = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions,ga:pageviewsPerSession,ga:avgSessionDuration,ga:percentNewSessions,ga:bounces,ga:bounceRate,ga:entrances,ga:entranceRate',
                ]
            );

            $conversionsData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics' => 'ga:goal1Completions,ga:goal2Completions,ga:goal3Completions',
                ]
            );
            foreach ($carbonPeriod as $key => $carbonDate) {
                $visitorsData->rows[$key][0] = $carbonDate->format('F d');
            }

            $pagesData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics'    => 'ga:pageviews,ga:entrances,ga:bounces,ga:avgTimeOnPage,ga:entranceRate,ga:bounceRate,ga:users,ga:newUsers',
                    'dimensions' => 'ga:pagePath,ga:deviceCategory'
                ]
            );

            $pagesGraph = [];
            foreach ($pagesData['rows'] as $pageData) {

                $pageRows = array_filter($pagesData['rows'], function ($item) use ($pageData) {
                    return $item[0] == $pageData[0];
                });

                $totalViews = array_sum(array_column($pageRows, 2)); // sum pageviews column
                $totalEntrances = array_sum(array_column($pageRows, 3)); // sum entrances column

                $isOnGraph = array_search($pageData[0], array_column($pagesGraph, 'page'));
                if (!$isOnGraph) {
                    array_push($pagesGraph, [
                        'page'      => $pageData[0],
                        'pageviews' => $totalViews,
                        'entrances' => $totalEntrances
                    ]);
                }

            }

            $countriesData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics'    => 'ga:pageviews,ga:entrances',
                    'dimensions' => 'ga:country'
                ]
            );


            return response()->json([
                'browsers'    => $browsersData,
                'visitors'    => $visitorsData,
                'general'     => $generalStats,
                'conversions' => $conversionsData,
                'pages'       => $pagesData,
                'pagesGraph'  => $pagesGraph,
                'countries'   => $countriesData
            ], 200);

        } catch (\Exception $exception) {

            throw new AnalyticsException($exception->getMessage());

        }

    }
}

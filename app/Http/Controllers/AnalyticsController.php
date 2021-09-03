<?php

namespace App\Http\Controllers;

use Analytics;
use App\Exceptions\Helpers\AnalyticsException;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
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


class AnalyticsController extends Controller
{


    public function getAnalytics()
    {
        return view('admin.analytics');
    }

    public function getAnalyticsStats(Request $request)
    {


        $to = Carbon::createFromFormat('Y-m-d', $request->get('to'));
        $from = Carbon::createFromFormat('Y-m-d', $request->get('from'));

        try {


            $analyticsPeriod = Period::create($from, $to);

            // Get total entrances by browser
            $browsersData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics'    => 'ga:entrances',
                    'dimensions' => 'ga:browser'
                ]
            );

            // Get new and total users by day
            $visitorsData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics'    => 'ga:users,ga:newUsers',
                    'dimensions' => 'ga:day'
                ]
            );
            //Format visitors date by month name and day like: July 7
            $carbonPeriod = CarbonPeriod::create($from, $to);
            foreach ($carbonPeriod as $key => $carbonDate) {
                $visitorsData->rows[$key][0] = $carbonDate->format('F d');
            }

            // Get general stats like entrances,pageviews,bounces, etc
            $generalStats = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics' => 'ga:sessions,ga:pageviewsPerSession,ga:avgSessionDuration,ga:percentNewSessions,ga:bounces,ga:bounceRate,ga:entrances,ga:entranceRate',
                ]
            );

            // Get whatsapp,calls and contact completed conversions
            $conversionsData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics' => 'ga:goal1Completions,ga:goal2Completions,ga:goal3Completions',
                ]
            );

            // Get complete information like entrances,pageviews,bounces.. divided by pages
            $pagesData = Analytics::performQuery(
                $analyticsPeriod,
                'ga:sessions',
                [
                    'metrics'    => 'ga:pageviews,ga:entrances,ga:bounces,ga:avgTimeOnPage,ga:entranceRate,ga:bounceRate,ga:users,ga:newUsers',
                    'dimensions' => 'ga:pagePath,ga:deviceCategory'
                ]
            );

            // Get total entrances and page views from all pages, we sum browser and desktop stats
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

            // Get total pageviews and entrances by country
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

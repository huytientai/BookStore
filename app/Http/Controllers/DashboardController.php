<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class DashboardController extends Controller
{
    protected $order;
    protected $user;

    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!(Gate::allows('admin', Auth::user()) || Gate::allows('staff', Auth::user()))) {
            flash("You are not authorized");
            return back();
        }

        // info
        $revenue = $this->order->select(DB::raw('sum(total_price) as sum'))->where('created_at', '>=', now()->subDays(1)->toDateTimeString())->get()->pluck('sum')->toArray()[0];
        $register = $this->user->select(DB::raw('count(*) as register'))->where('created_at', '>=', now()->subDays(30)->toDateTimeString())->get()->pluck('register')->toArray()[0];

        $info['revenue'] = $revenue;
        $info['register'] = $register;

        // chart
        $dailyChart = new Chart();
        $dailyRevenue = $this->getDailyRevenue();

        $dailyChart->labels(array_keys($dailyRevenue));
        $options = $dailyChart->options;
        $options['animation'] = 'duration';
        $dailyChart->dataset('Revenue($)', 'line', array_values($dailyRevenue))->options($options, true)->color('white');

        $monthlyChart = new Chart();
        $monthlyChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);

        $monthlyRevenue = $this->getMonthlyRevenue();
        $monthlyChart->dataset('Revenue($)', 'bar', $monthlyRevenue)->options($options, true)->backgroundColor('white');

        //get new employees

        $employees = $this->user->where('created_at', '>=', now()->subDays(365)->toDateTimeString())->where('role', '!=', User::GUESS)->get();

        return view('dashboard.index', compact('info', 'dailyChart', 'monthlyChart', 'employees'));
    }

    public function getDailyRevenue()
    {
        $first_date = strtotime("-1 week +1day");
        $first_date = date("Y-m-d", $first_date);

        $days = array();
        $timestamp = strtotime("-1 week +1day");

        for ($i = 0; $i < 7; $i++) {
            $days[strftime('%a', $timestamp)] = 0;
            $timestamp = strtotime('+1 day', $timestamp);
        }

        $dailyRevenue = $this->order->select(DB::raw("DATE_FORMAT(orders.created_at,'%a') as day, sum(total_price) as sum"))->where('created_at', '>=', $first_date)->orderBy('created_at')->groupBy('Day')->get()->pluck('sum', 'day')->toArray();
        $dailyRevenue = array_merge($days, $dailyRevenue);
        return $dailyRevenue;
    }

    public function getMonthlyRevenue()
    {
        $first_date = strtotime("first day of january this year");
        $first_date = date("Y-m-d", $first_date);

        $monthlyRevenue = $this->order->select(DB::raw("DATE_FORMAT(orders.created_at,'%m') as month, sum(total_price) as sum"))->where('created_at', '>=', $first_date)->groupBy('month')->get()->pluck('sum', 'month')->toArray();

        foreach ($monthlyRevenue as $key => $value) {
            $monthlyRevenue[intval($key)] = $value;
            unset($monthlyRevenue[$key]);
        }

        for ($i = 1; $i < 13; $i++) {
            if (!isset($monthlyRevenue[$i])) {
                if ($i <= date('m')) {
                    $monthlyRevenue[$i] = 0;
                } else
                    $monthlyRevenue[$i] = null;
            }
        }
        ksort($monthlyRevenue);
        return array_values($monthlyRevenue);
    }

}

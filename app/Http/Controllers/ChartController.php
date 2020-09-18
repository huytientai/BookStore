<?php

namespace App\Http\Controllers;

use App\Charts\Revenue;
use App\Models\Loaisach;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ChartController extends Controller
{
    protected $order;
    protected $orderDetail;
    protected $category;

    public function __construct(Order $order, Orderdetail $orderDetail, Loaisach $category)
    {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->category = $category;
    }

    /**
     * Show all charts
     */
    public function index()
    {
        if (!Gate::any(['admin','staff'],Auth::user())){
            flash('You are not authorized')->warning();
            return back();
        }

        //---------------------        Last Month           ------------------

        // line chart
        $lineLastMonthChart = $this->getTotalRevenueEachDay('last month');

        $categories = $this->category->all()->pluck('name', 'id')->toArray();
        foreach ($categories as $key => $value) {
            $total = $this->getDayRevenueByCategory($key, 'last month');
            $lineLastMonthChart->dataset($value, 'line', array_values($total))->color('#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6));
        }

        // doughnut chart
        $categories = $this->getMonthRevenueEachCategory('last month');
        $doughnutLastMonthChart = new Revenue();
        if (count($categories) == 0) {
            $doughnutLastMonthChart->labels(['Total']);
            $doughnutLastMonthChart->dataset('sum', 'doughnut', [0])->backgroundColor('white');
        } else {
            $doughnutLastMonthChart->labels($categories->pluck('name')->toArray());

            for ($i = 0; $i < count($categories); $i++) {
                $colors[$i] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            }
            $doughnutLastMonthChart->dataset('sum', 'doughnut', $categories->pluck('revenue')->toArray())->backgroundColor($colors);
        }

        //-------------------      Current Month           -------------------

        // line chart
        $lineCurrentMonthChart = $this->getTotalRevenueEachDay();

        $categories = $this->category->all()->pluck('name', 'id')->toArray();
        foreach ($categories as $key => $value) {
            $total = $this->getDayRevenueByCategory($key);
            $lineCurrentMonthChart->dataset($value, 'line', array_values($total))->color('#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6));
        }

        // doughnut chart
        $categories = $this->getMonthRevenueEachCategory();
        $doughnutCurrentMonthChart = new Revenue();
        if (count($categories) == 0) {
            $doughnutCurrentMonthChart->labels(['Total']);
            $doughnutCurrentMonthChart->dataset('sum', 'doughnut', [0])->backgroundColor('white');
        } else {
            $doughnutCurrentMonthChart->labels($categories->pluck('name')->toArray());

            for ($i = 0; $i < count($categories); $i++) {
                $colors[$i] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            }
            $doughnutCurrentMonthChart->dataset('sum', 'doughnut', $categories->pluck('revenue')->toArray())->backgroundColor($colors);
        }

        return view('charts.index', compact('lineLastMonthChart', 'doughnutLastMonthChart', 'lineCurrentMonthChart', 'doughnutCurrentMonthChart'));
    }


    //--------------------         Support Functions     ------------------------

    public function getTotalRevenueEachDay($time = null)
    {
        $chart = new Revenue();
        $chart->labels(range(1, 31, 1));
        $date = now();

        if ($time == 'last month') {
            $first_date = strtotime(date("Y-m-d", strtotime($date)) . ", first day of last month");
            $first_date = date("Y-m-d", $first_date);

            $last_date = strtotime(date("Y-m-d", strtotime($date)) . ", last day of last month");
            $last_date = date("Y-m-d", $last_date);
        } else {
            $first_date = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
            $first_date = date("Y-m-d", $first_date);

            $last_date = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
            $last_date = date("Y-m-d", $last_date);
        }

        $total = $this->order->select(DB::raw("DATE_FORMAT(created_at,'%d') as date,sum(total_price)"))->where('created_at', '>=', $first_date)->where('created_at', '<=', $last_date)->groupBy('date')->orderBy('date')->get()->pluck('sum(total_price)', 'date')->toArraY();
        for ($i = 1; $i < 32; $i++) {
            if (!isset($total[$i])) {
                $total[$i] = 0;
            }
        }
        ksort($total);

        $chart->dataset('Total', 'line', array_values($total))->color('red');
        return $chart;
    }

    public function getDayRevenueByCategory($id, $time = null)
    {
        $date = now();

        if ($time == 'last month') {
            $first_date = strtotime(date("Y-m-d", strtotime($date)) . ", first day of last month");
            $first_date = date("Y-m-d", $first_date);

            $last_date = strtotime(date("Y-m-d", strtotime($date)) . ", last day of last month");
            $last_date = date("Y-m-d", $last_date);
        } else {
            $first_date = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
            $first_date = date("Y-m-d", $first_date);

            $last_date = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
            $last_date = date("Y-m-d", $last_date);
        }

        $days = DB::table('orders')->leftJoin('orderdetails', 'orders.id', '=', 'orderdetails.order_id')->leftJoin('books', 'orderdetails.book_id', '=', 'books.id')->select(DB::raw("DATE_FORMAT(orders.created_at,'%d') as date,sum(sell_price*quantity) as sum"))->where('loaisach_id', '=', $id)->where('orders.created_at', '>=', $first_date)->where('orders.created_at', '<=', $last_date)->groupBy('date')->get()->pluck('sum', 'date')->toArray();

        for ($i = 1; $i < 32; $i++) {
            if (!isset($days[$i])) {
                $days[$i] = 0;
            }
        }
        ksort($days);
        return $days;
    }

    /**
     *  return \App\Models\Loaisach $categories
     **/
    public function getMonthRevenueEachCategory($time = null)
    {
        $date = now();

        if ($time == 'last month') {
            $first_date = strtotime(date("Y-m-d", strtotime($date)) . ", first day of last month");
            $first_date = date("Y-m-d", $first_date);

            $last_date = strtotime(date("Y-m-d", strtotime($date)) . ", last day of last month");
            $last_date = date("Y-m-d", $last_date);
        } else {
            $first_date = strtotime(date("Y-m-d", strtotime($date)) . ", first day of this month");
            $first_date = date("Y-m-d", $first_date);

            $last_date = strtotime(date("Y-m-d", strtotime($date)) . ", last day of this month");
            $last_date = date("Y-m-d", $last_date);
        }
        $revenue = DB::table('orders')->leftJoin('orderdetails', 'orders.id', '=', 'orderdetails.order_id')->leftJoin('books', 'orderdetails.book_id', '=', 'books.id')->select('loaisach_id as id', DB::raw('sum(sell_price*quantity) as sum'))->where('orders.created_at', '>=', $first_date)->where('orders.created_at', '<=', $last_date)->groupBy('loaisach_id')->get()->pluck('sum', 'id');

        $revenue = $revenue->toArray();

        $categories = $this->category->all();
        foreach ($categories as $key => $category) {
            if (isset($revenue[$category->id])) {
                $category->revenue = $revenue[$category->id];
            } else {
                $categories->forget($key);
            }
        }

        return $categories;
    }
}

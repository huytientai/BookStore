<?php

namespace App\Http\Controllers;

use App\Charts\Revenue;
use App\Models\Loaisach;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    protected $revenue;
    protected $order;
    protected $orderDetail;
    protected $category;

    public function __construct(Revenue $revenue, Order $order, Orderdetail $orderDetail,Loaisach $category)
    {
        $this->revenue = $revenue;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->category = $category;
    }

    /**
     * Show all charts
     */
    public function index()
    {
        $chart = $this->revenue;
        $chart->labels(range(1, 31, 1));

        $total = $this->order->select(DB::raw("DATE_FORMAT(created_at,'%d') as date,sum(total_price)"))->where('created_at', '>=', now()->subDays(30)->toDateTimeString())->groupBy('date')->orderBy('date')->get()->pluck('sum(total_price)', 'date')->toArraY();
        for ($i = 1; $i < 32; $i++) {
            if (!isset($total[$i])) {
                $total[$i] = 0;
            }
        }
        ksort($total);
        $chart->dataset('Total', 'line', array_values($total))->color('red');

        $categories = $this->category->all()->pluck('id','name')->toArray();
        foreach ($categories as $key => $value ) {
            $total=$this->getDayRevenueByCategory($value);
            $chart->dataset($key, 'line',array_values($total))->color('#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6));
        }
//        dd(mt_rand(0, 0xFFFFFF));

        return view('charts.index', compact('chart'));
    }

    public function getDayRevenueByCategory($id)
    {
        $days = DB::table('orders')->leftJoin('orderdetails', 'orders.id', '=', 'orderdetails.order_id')->leftJoin('books', 'orderdetails.book_id', '=', 'books.id')->select(DB::raw("DATE_FORMAT(orders.created_at,'%d') as date,sum(sell_price*quantity) as sum"))->where('loaisach_id', '=', $id)->where('orders.created_at', '>=', now()->subDays(30)->toDateTimeString())->groupBy('date')->get()->pluck('sum', 'date')->toArray();

        for ($i = 1; $i < 32; $i++) {
            if (!isset($days[$i])) {
                $days[$i] = 0;
            }
        }
        ksort($days);
        return $days;
    }

    public function getRevenueEachCategory()
    {
        $revenue = DB::table('orders')->leftJoin('orderdetails', 'orders.id', '=', 'orderdetails.order_id')->leftJoin('books', 'orderdetails.book_id', '=', 'books.id')->select('loaisach_id as id', DB::raw('sum(sell_price*quantity) as sum'))->where('orders.created_at', '>=', now()->subDays(30)->toDateTimeString())->groupBy('loaisach_id')->get()->pluck('sum', 'id');

        $revenue = $revenue->toArray();
        return $revenue;
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $productsCount = Product::count();

        $usersCount = User::count();

        $ordersCount = Order::count();

        $totalRevenue = Order::sum('total');


        $salesChart = Order::selectRaw('DATE_FORMAT(created_at,"%m %Y") AS `date`, SUM(total) AS `total`')->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')->groupByRaw('MONTH(created_at)')->get();

        $dates = $salesChart->pluck('date')->all();
        $totals = $salesChart->pluck('total')->all();

        return view('dashboard.home', compact('productsCount', 'usersCount', 'ordersCount', 'totalRevenue', 'dates', 'totals'));

    }


}

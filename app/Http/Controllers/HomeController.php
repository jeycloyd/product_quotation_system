<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get current month for new customers basis and growth rate
        $currentMonth = Carbon::now()->format('m');
        $previousMonth = Carbon::now()->subMonth()->format('m');

        //simple dashboard info
        $count_customer = DB::table('customers')->whereNull('deleted_at')->count();
        $count_quotation = DB::table('quotations')->count();
        $count_new_customer = DB::table('customers')->whereMonth('created_at',$currentMonth)->whereNull('deleted_at')->count();
        $count_customer_last_month = DB::table('customers')->whereMonth('created_at',$previousMonth)->whereNull('deleted_at')->count();
        $count_product = DB::table('products')->where('status','Active')->count();
        $count_user = DB::table('users')->count();

        //get customer growth rate
        $customer_growth_rate = number_format(( $count_new_customer / $count_customer ) * 100,2);

        return view('home', compact('count_customer','count_quotation','count_new_customer','count_product','count_user','customer_growth_rate'));
    }
}

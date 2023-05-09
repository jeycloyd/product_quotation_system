<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    //show billing page
    public function viewBilling($id){
        // //get the current month
        // $current_month = Carbon::now()->format('M');
        // //set container for the months
        // $period = array();
        // //set an array with all the months
        
        // foreach($months as $month){
        //     if($month == $current_month){
        //         break;
        //     }
        //     array_push($period,$month);
        // }
        
        //fetch all transactions of the specific customer and group them by month
        // $billings = DB::table('product_quotation')
        //         ->join('quotations','product_quotation.quotation_id','=','quotations.id')
        //         ->select(DB::raw('MONTHNAME(product_quotation.created_at) AS PERIOD, SUM(sub_total) AS DUE'),'quotations.customer_id')
        //         ->where('quotations.customer_id',$id)
        //         ->groupBy(DB::raw('MONTHNAME(created_at)'),'quotations.customer_id')
        //         ->get();
        
        //fetch all transactions and months of the specific customer and group them by month
        $billings = DB::table('product_quotation')
                    ->join('quotations','product_quotation.quotation_id','=','quotations.id')
                    ->select(DB::raw('MONTHNAME(product_quotation.created_at) AS PERIOD, SUM(sub_total) AS DUE'),'quotations.customer_id')
                    ->where('quotations.customer_id',$id)
                    ->groupBy(DB::raw('MONTHNAME(created_at)'),'quotations.customer_id')
                    ->orderBy('product_quotation.created_at','ASC')
                    ->get();
        $total_balance = floatval(DB::table('product_quotation')
                    ->select(DB::raw('SUM(sub_total) AS total_balance'))
                    ->where('quotation_id', 1202305082)
                    ->first()->total_balance);
        $months = array('January','February','March','April','May','June','July','August','September','October','November','December');   
        return view('pages.billings.billing',compact('billings','months','total_balance'));
    }
}
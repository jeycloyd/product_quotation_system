<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class QuotationController extends Controller
{   
    //show select customer first
    public function showSelectCustomer(){
        $customers = Customer::all();
        return view('pages.quotations.select_customer',compact('customers'));
    }
    //show create form for quotations
    public function create(Request $request){
        $customers = Customer::all();
        $products = Product::all();
        $selected_customer = $request->customer_name;
        $generated_id = $this->generateQuotationId(1,1);
        return view('pages.quotations.create', compact('customers','products','selected_customer','generated_id'));
    }
    public function generateQuotationId($customer_id, $transaction_id){
        $date_now = Carbon::now()->format('Ymd'); 
        $generated_id = $customer_id . $date_now . $transaction_id;
        return $generated_id;
    }
}

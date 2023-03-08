<?php

namespace App\Http\Controllers;

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
        return view('pages.quotations.create', compact('customers','products','selected_customer'));
    }
}

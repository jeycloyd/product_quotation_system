<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    //show create form for quotations
    public function create(){
        $customers = Customer::all();
        $products = Product::all();
        return view('pages.quotations.create', compact('customers','products'));
    }
}

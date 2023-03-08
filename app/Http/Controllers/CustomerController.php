<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //show create form for customer
    public function create(){
        return view('pages.customers.create');
    }

    //store data in customer table
    public function store(Request $request){

        //validate data
        $request->validate([
            'customer_name' => 'required|unique:customers',
            'customer_contact_no' => 'required'
        ]);

        //save data
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->customer_contact_no = $request->customer_contact_no;
        $customer->save();
        
        //return response
        return back()->with('Success','Customer added successfully');
    }
}

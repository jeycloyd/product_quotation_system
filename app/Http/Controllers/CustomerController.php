<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        return redirect('/quotations/select-customer')->with('success','Customer added successfully');
    }
    //show list of all customers
    public function index(){
        $customers = customer::all();
        return view('pages/customers/index', compact('customers'));
    }
    //show a specific customer info
    public function show($id){
        $customer = Customer::findOrFail($id);
        $customer_id = $customer->id;
        $customer_name = $customer->customer_name;
        $customer_contact_no = $customer->customer_contact_no;
        return view('pages/customers/edit', compact('customer_id' , 'customer_name', 'customer_contact_no'));
    }
    //update customer info
    public function update($id, Request $request){
        $request->validate([
            'customer_name' => [ 'required',
                Rule::unique('customers')->ignore($id),
            ],
            'customer_contact_no' => 'required'
        ]);
        $customer = Customer::findOrFail($id);
        $customer->customer_name = $request->customer_name;
        $customer->customer_contact_no = $request->customer_contact_no;
        $customer->save();
        return redirect('customers/index')->with('success', 'customer details have been updated');
    }
}

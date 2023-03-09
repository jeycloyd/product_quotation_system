<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Decimal;

class QuotationController extends Controller
{   
    //show select customer first
    public function showSelectCustomer(){
        $customers = Customer::all();
        if($customers->isEmpty()){
            return view('pages.customers.create');
        }else{
            return view('pages.quotations.select_customer',compact('customers'));
        } 
    }
    //show create form for quotations
    public function create(Request $request){
        if(!isset($customers, $products, $selected_customer, $count_no_of_transactions, $select_customer, $customer_name, $generated_id)){
            $customers = Customer::all();
            $products = Product::all();
            
            //extract value of customer_name via id
            $selected_customer = $request->customer_name;

            //count the number of transactions already made by the user and add 1
            $count_no_of_transactions = DB::table('quotations')
                ->where('customer_id', $selected_customer)
                ->count()+1;

            //query to get the name of the equivalent id from the $selected_customer variable
            $select_customer = DB::table('customers')->where('id', $selected_customer)->get()->pluck('customer_name');

            //to get the data from the object as it was being outputted as an object
            $customer_name = $select_customer[0];

            //call a function to generate quotation id
            $generated_id = $this->generateQuotationId($selected_customer,$count_no_of_transactions);
        }
        return view('pages.quotations.create', compact('customers','products','customer_name','generated_id','selected_customer'));
    }
    //show a success page when quotation has been made and saved successfully
    public function success(){
        return view('pages.quotations.success');
    }
    //show list of quotations in the page
    public function viewQuotations(){
        return view('pages.quotations.view');
    }
    //helper function to generate the quotation id
    public function generateQuotationId($customer_id, $transaction_id){
        $date_now = Carbon::now()->format('Ymd'); 
        $generated_id = $customer_id . $date_now . $transaction_id;
        return $generated_id;
    }
    //store data to quotations table
    public function store(Request $request){
        
        $quotation = new Quotation();
        $quotation->id = $request->quotation_id;
        $quotation->quotation_date =$request->date;
        $quotation->customer_id = $request->customer_id;
        $quotation->save();
    }
    //add items to the quotation_product table
    public function addProducts(Request $request){
        //extract the name, id, and price of the item by using explode method with a delimiter
        $products = explode('|', $request->product_name);
        $product_id = $products[0];
        $product_price = $products[1];
        $product_name = $products[2];
        //get qty value
        $quantity = $request->quantity;
        //get price from multiplying quantity and product price
        $total = $quantity * floatval($product_price);
    }
    
}

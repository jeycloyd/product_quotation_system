<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\TempTable;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal;
use App\Models\ProductQuotation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Input\Input;

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
        $products = Product::all();
        $products_isEmpty = DB::table('products')->count();
        //redirect the user if there are no products added yet
        if($products_isEmpty == 0){
            return view('pages.products.create');
        }
        if(!isset($customers, $products, $selected_customer, $count_no_of_transactions, $select_customer, $customer_name, $generated_id)){
            $customers = Customer::all();
            
            

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
            //show list of quoted items based on the quotation id
            //$temp_tables = DB::table('temp_tables')->where('quotation_id',$generated_id)->get();
            $temp_tables = DB::table('temp_tables')
                            ->select('product_name', DB::raw('ROUND(AVG(unit_price),2) as unit_price'), DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total_price) as total_price'))
                            ->where('quotation_id','=',$generated_id)
                            ->groupBy('product_name')
                            ->get();
            //check if temp_table is empty
            $temp_tables_isEmpty = DB::table('temp_tables')->count();
            //show grand total
            $grand_total = DB::table('temp_tables')->where('quotation_id', '=' , $generated_id)->sum('total_price');
        }
        return view('pages.quotations.create', compact('customers','products','customer_name','generated_id','selected_customer','temp_tables','grand_total','temp_tables_isEmpty'));
    }
    //show a success page when quotation has been made and saved successfully
    public function success(){
        return view('pages.quotations.success');
    }
    //show list of quotations in the page
    public function viewQuotations(){
        // combine the info from customers and quotations table via join
        $quotations = DB::table('customers')
            ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
            ->select('customers.*', 'quotations.id' , 'quotations.created_at',)
            ->whereNull('deleted_at')
            ->orderByDesc('quotations.created_at')
            ->get();
        return view('pages.quotations.view',compact('quotations'));
    }
    //helper function to generate the quotation id
    public function generateQuotationId($customer_id, $transaction_id){
        $date_now = Carbon::now()->format('Ymd'); 
        $generated_id = $customer_id . $date_now . $transaction_id;
        return $generated_id;
    }
    //add items to the quotation_product table
    public function addProducts(Request $request){
        //FOR PRODUCT DETAILS EXTRACTION
        //extract the name, id, and price of the item by using explode method with a delimiter
        $product = explode('|', $request->product_name);
        $product_id = $product[0];
        $product_price = $product[1];
        $product_name = $product[2];
        //get qty value
        $quantity = $request->quantity;
        //get price from multiplying quantity and product price
        $total = $quantity * floatval($product_price);
       

        //FOR RETAINING THE DETAILS AFTER CLICKING ADD TO PREVENT DATA LOSS
        //get quotation ID
        $quotation_id = $request->quotation_id;
        //get the products data 
        $products = Product::all();
        //call a function to generate quotation id
        $generated_id = $request->quotation_id;
        //get customer id 
        $selected_customer = $request->customer_id;
        //get the customer name
        $customer_name = $request->customer_name;

        //insert into product_quotation table
        $temp_tables = TempTable::all();
        $temp_table = New TempTable();
        $temp_table->product_id = $product_id;
        $temp_table->product_name = $product_name;
        $temp_table->product_name = $product_name;
        $temp_table->product_description = 'This is a temporary description.';
        $temp_table->quotation_id = $quotation_id;
        $temp_table->quantity = $quantity;
        $temp_table->unit_price = $product_price;
        $temp_table->total_price = $total;
        $grand_total = DB::table('temp_tables')->where('quotation_id', '=' , $generated_id)->sum('total_price');

        //check if what button was pressed
        if ($request->input('action') == 'add') {
            // perform save action
            $temp_table->save();
        } elseif ($request->input('action') == 'clear') {
            // perform clear 
            DB::table('temp_tables')->where('quotation_id', '=' , $generated_id)->delete();
        }
        return redirect()->back()->with(compact('products','generated_id','selected_customer','customer_name','product_id','product_price','temp_tables','grand_total'));
    }
    //store data to quotations table
    public function store(Request $request){
        
        $quotation = new Quotation();
        $quotation->id = $request->quotation_id;
        $quotation->quotation_date =$request->date;
        $quotation->customer_id = $request->customer_id;
        $quotation->total_price = $request->total_price;
        $quotation->save();

        //transfer table info from temp tables to product_quotation table
        $data = DB::table('temp_tables')->select('product_id', 'quotation_id', 'quantity', 'created_at' , 'updated_at')->get();

        foreach ($data as $row) {
            DB::table('product_quotation')->insert([
                'product_id' => $row->product_id,
                'quotation_id' => $row->quotation_id,
                'quantity' => $row->quantity,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        //empty table temp based on the quotation id
        DB::table('temp_tables')->where('quotation_id', '=' , $request->quotation_id)->delete();
        return view('pages.quotations.success');
    }
    //Show the details of a selected quotation
    public function show($id){
        $quotation_id = $id;
        //get the customer's name for this quotation
        $customer_name = DB::table('customers')
            ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
            ->select('customers.customer_name')
            ->where('quotations.id',$quotation_id)
            ->value('customer_name');
        //get the total of the quotation
        $grand_total = DB::table('quotations')->where('id',$quotation_id)->value('total_price');
        //get the date of the quotation
        $quotation_date = DB::table('quotations')->where('id', $quotation_id)->value('created_at');
        $quotation_date = Carbon::parse($quotation_date)->format('Y-m-d');
        //group items by product name
        $quotations = DB::table('products')
                            ->join('product_quotation', 'products.id', '=', 'product_quotation.product_id')
                            ->select('product_name', DB::raw('ROUND(AVG(product_price),2) as product_price'), DB::raw('SUM(quantity) as quantity'))
                            ->where('quotation_id','=', $quotation_id)
                            ->groupBy('product_name')
                            ->get();
        return view('pages.quotations.view_quotation',compact('quotation_id','quotations', 'grand_total', 'customer_name', 'quotation_date'));
    }
    //delete a quotation record from the list
    public function destroy($id){
        $quotations = Quotation::findOrFail($id);
        $quotations->delete();
        return redirect()->back()->with('success','data has been deleted successfully');
    }
    public function export($id){
        $quotation_id = $id;
        //get the customer's name for this quotation
        $customer_name = DB::table('customers')
            ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
            ->select('customers.customer_name')
            ->where('quotations.id',$quotation_id)
            ->value('customer_name');
        //get the total of the quotation
        $grand_total = DB::table('quotations')->where('id',$quotation_id)->value('total_price');
        //get the date of the quotation
        $quotation_date = DB::table('quotations')->where('id', $quotation_id)->value('created_at');
        $quotation_date = Carbon::parse($quotation_date)->format('Y-m-d');
        $formatted_date = \Carbon\Carbon::createFromFormat('Y-m-d', $quotation_date);
        $final_quotation_date = $formatted_date->format('F j, Y');
        //group items by product name
        $quotations = DB::table('products')
                            ->join('product_quotation', 'products.id', '=', 'product_quotation.product_id')
                            ->select('product_name', DB::raw('ROUND(AVG(product_price),2) as product_price'), DB::raw('SUM(quantity) as quantity'))
                            ->where('quotation_id','=', $quotation_id)
                            ->groupBy('product_name')
                            ->get();
        //download and export as pdf
        $dompdf = App::make('dompdf.wrapper');
        $dompdf->set_paper('A4');
        $pdf = $dompdf->loadView('pages.quotations.pdf.pdf_quotation',compact('quotation_id','quotations', 'grand_total', 'customer_name', 'final_quotation_date')); 
        return $dompdf->stream('Quotation_'.$id .'.pdf');
    }
}

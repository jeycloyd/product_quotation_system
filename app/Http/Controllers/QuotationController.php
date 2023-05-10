<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\TempTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class QuotationController extends Controller
{   
    //show select customer first
    public function showSelectCustomer(){
        $customers = DB::table('customers')->whereNull('deleted_at')->get();
        if($customers->isEmpty()){
            return redirect('/customers/create');
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

            //extract value of quotation_type via id
            $quotation_type = $request->quotation_type;

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
                            ->select('product_name','product_description', DB::raw('ROUND(AVG(unit_price),2) as unit_price'), DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total_price) as total_price'))
                            ->where('quotation_id','=',$generated_id)
                            ->groupBy('product_name','product_description')
                            ->get();
            //check if temp_table is empty
            $temp_tables_count = DB::table('temp_tables')->where('quotation_id', $generated_id)->count();
            //show grand total
            $grand_total = DB::table('temp_tables')->where('quotation_id', '=' , $generated_id)->sum('total_price');
        }
        return view('pages.quotations.create', compact('customers','products','customer_name','generated_id','selected_customer','temp_tables','grand_total','temp_tables_count','quotation_type'));
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
            ->select(DB::raw('customers.id AS customer_id'),'customers.*', 'quotations.id' , 'quotations.created_at','quotations.approval_status','quotations.quotation_type','billing_approval_status')
            ->whereNull('quotations.deleted_at')
            ->orderByDesc('quotations.created_at')
            ->paginate(5);
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
        $product_description = $product[3];
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
        //get quotation type
        $quotation_type = $request->quotation_type;

        //insert into product_quotation table
        $temp_tables = TempTable::all();
        $grand_total = DB::table('temp_tables')->where('quotation_id', '=' , $generated_id)->sum('total_price');

        //check if what button was pressed
        if ($request->input('action') == 'add') {
            //prevent inserting into temp tables if the quotation id is already existing in the database
            $quotation_id_check = DB::table('quotations')->where('id',$request->quotation_id)->value('id');
            if(($quotation_id_check == $request->quotation_id)){
                return redirect()->back();
            }
            //check if product name already exists in temp table
            $temp_table = TempTable::where('product_name', $product_name)
                                    ->where('quotation_id', $quotation_id)
                                    ->first();
            if ($temp_table) {
                // Product exists, add the quantity
                $temp_table->quantity += $request->quantity;
                $temp_table->total_price = $temp_table->quantity * $temp_table->unit_price;
                $temp_table->save();
            }else{
                $temp_table = New TempTable();
                $temp_table->product_id = $product_id;
                $temp_table->product_name = $product_name;
                $temp_table->quantity = $quantity;
                $temp_table->product_description = DB::table('products')->where('product_name',$product_name)->value('product_description');
                // $temp_table->product_description = 'This is a temporary description.';
                $temp_table->quotation_id = $quotation_id;
                $temp_table->quantity = $quantity;
                $temp_table->unit_price = $product_price;
                $temp_table->total_price = $quantity * $product_price;
                $temp_table->save();
            }
        } elseif ($request->input('action') == 'clear') {
            // perform clear 
            DB::table('temp_tables')->where('quotation_id', '=' , $generated_id)->delete();
        }
        return redirect()->back()->with(compact('products','generated_id','selected_customer','customer_name','product_id','product_price','temp_tables','grand_total','product_description','quotation_type'));
    }
    //store data to quotations table
    public function store(Request $request){
        //check first if the quotation already exists in the quotations database
        $quotation_id_check = DB::table('quotations')->where('id',$request->quotation_id)->value('id');
        if(!($request->quotation_id === $quotation_id_check)){
            //download pdf and insert data into the quotations table
            $quotation = new Quotation();
            $quotation->id = $request->quotation_id;
            $quotation->quotation_date =$request->date;
            $quotation->customer_id = $request->customer_id;
            $quotation->quotation_type = $request->quotation_type;
            $grand_total = $request->grand_total;
            //approval status
            $approval_status = 'For Approval';
            $quotation->approval_status = $approval_status;
            $quotation->save();
            //transfer table info from temp tables to product_quotation table
            $data = DB::table('temp_tables')->select('product_id', 'quotation_id', 'quantity', 'created_at' , 'updated_at','product_name','unit_price','total_price','product_description')
                    ->where('quotation_id',$request->quotation_id)
                    ->get();
            foreach ($data as $row) {
                DB::table('product_quotation')->insert([
                    'product_id' => $row->product_id,
                    'quotation_id' => $row->quotation_id,
                    'quantity' => $row->quantity,
                    'product_name' => $row->product_name,
                    'product_description'=> $row->product_description,
                    'unit_price' => $row->unit_price,
                    'sub_total' => $row->total_price,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            //empty table temp based on the quotation id
            DB::table('temp_tables')->where('quotation_id', '=' , $request->quotation_id)->delete();
            // ----------------------------------- PDF CODE HERE-------------------------------------------------------------//
            $quotation_id = $request->quotation_id;
            $product_quotations = DB::table('product_quotation')
                                ->select('product_name', DB::raw('ROUND(AVG(unit_price),2) as unit_price'), DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(sub_total) as total_price'))
                                ->where('quotation_id','=',$quotation_id)
                                ->groupBy('product_name')
                                ->get();
            $customer_name = DB::table('customers')->where('id',$request->customer_id)->value('customer_name');
            $final_quotation_date = DB::table('quotations')->where('id',$quotation_id)->value('created_at');
            $grand_total = DB::table('product_quotation')->select(DB::raw('SUM(sub_total) as total_price'))->where('quotation_id',$quotation_id)->value('total_price');
            //download and export as pdf
            $dompdf = App::make('dompdf.wrapper');
            $dompdf->set_paper('A4');
            $pdf = $dompdf->loadView('pages.quotations.pdf.pdf_quotation',compact('quotation_id','product_quotations', 'grand_total', 'customer_name', 'final_quotation_date','approval_status')); 
            $pdf = $dompdf->render();
            return $dompdf->download('Quotation_'.$quotation_id .'.pdf');
        }else{
            //download only the pdf of the quotation based on the id
            // ----------------------------------- PDF CODE HERE-------------------------------------------------------------//
            $quotation_id = $request->quotation_id;
            $product_quotations = DB::table('product_quotation')
                                ->select('product_name', DB::raw('ROUND(AVG(unit_price),2) as unit_price'), DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(sub_total) as total_price'))
                                ->where('quotation_id','=',$quotation_id)
                                ->groupBy('product_name')
                                ->get();
            $customer_name = DB::table('customers')->where('id',$request->customer_id)->value('customer_name');
            $final_quotation_date = DB::table('quotations')->where('id',$quotation_id)->value('created_at');
            $grand_total = DB::table('product_quotation')->select(DB::raw('SUM(sub_total) as total_price'))->where('quotation_id',$quotation_id)->value('total_price');
            //approval status
            $approval_status = 'For Approval';
            //download and export as pdf
            $dompdf = App::make('dompdf.wrapper');
            $dompdf->set_paper('A4');
            $pdf = $dompdf->loadView('pages.quotations.pdf.pdf_quotation',compact('quotation_id','product_quotations', 'grand_total', 'customer_name', 'final_quotation_date','approval_status')); 
            $pdf = $dompdf->render();
            return $dompdf->download('Quotation_'.$quotation_id .'.pdf');
        } 
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
        $grand_total = DB::table('product_quotation')->where('quotation_id', $quotation_id)->sum('sub_total');
        //get approval status
        $approval_status = DB::table('quotations')->where('id',$id)->value('approval_status');
        //get the date of the quotation
        $quotation_date = DB::table('quotations')->where('id', $quotation_id)->value('created_at');
        $quotation_date = Carbon::parse($quotation_date)->format('Y-m-d');
        //get items purchased and group them by product name based on the quotation id
        $product_quotations = DB::table('product_quotation')
                            ->select('product_name', DB::raw('ROUND(AVG(unit_price),2) as unit_price'), DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(sub_total) as total_price'))
                            ->where('quotation_id','=',$id)
                            ->groupBy('product_name')
                            ->paginate(5);
        return view('pages.quotations.view_quotation',compact('quotation_id','product_quotations', 'grand_total', 'customer_name', 'quotation_date','approval_status'));
    }
    //delete a quotation record from the list
    public function destroy(Request $request){
        $quotations = Quotation::findOrFail($request->id);
        $quotations->delete();
        return redirect()->back()->with('success','data has been deleted successfully');
    }
    public function downloadPDF($id){
        $quotation_id = $id;
        //approval status
        $approval_status = DB::table('quotations')->where('id',$quotation_id)->value('approval_status');
        //get the customer's name for this quotation
        $customer_name = DB::table('customers')
            ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
            ->select('customers.customer_name')
            ->where('quotations.id',$quotation_id)
            ->value('customer_name');
        //get the total of the quotation
        $grand_total = DB::table('product_quotation')->where('quotation_id', $quotation_id)->sum('sub_total');
        //get the date of the quotation
        $quotation_date = DB::table('quotations')->where('id', $quotation_id)->value('created_at');
        $quotation_date = Carbon::parse($quotation_date)->format('Y-m-d');
        $formatted_date = \Carbon\Carbon::createFromFormat('Y-m-d', $quotation_date);
        $final_quotation_date = $formatted_date->format('F j, Y');
        //group items by product name
        //get items purchased and group them by product name based on the quotation id
        $product_quotations = DB::table('product_quotation')
                            ->select('product_name', DB::raw('ROUND(AVG(unit_price),2) as unit_price'), DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(sub_total) as total_price'))
                            ->where('quotation_id','=',$id)
                            ->groupBy('product_name')
                            ->get();
        //download and export as pdf
        $dompdf = App::make('dompdf.wrapper');
        $dompdf->set_paper('A4');
        $pdf = $dompdf->loadView('pages.quotations.pdf.pdf_quotation',compact('quotation_id','product_quotations', 'grand_total', 'customer_name', 'final_quotation_date','approval_status')); 
        return $dompdf->stream('Quotation_'.$id .'.pdf');
    }
    //search details from the quotation list
    public function search(Request $request){
        $search = $request->search;
        $search_approval_status = $request->approval_status;
        $search_quotation_type = $request->quotation_type;
        // if(is_null($search_approval_status) && is_null($search_quotation_type)){
        //     //retrieve all quotations
        //     $quotations = DB::table('customers')
        //     ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
        //     ->select('customers.*', 'quotations.id' , 'quotations.created_at','quotations.approval_status','quotations.quotation_type')
        //     ->whereNull('quotations.deleted_at')
        //     ->where('customer_name', 'LIKE' , '%' . $search . '%')
        //     ->orderByDesc('quotations.created_at')
        //     ->paginate(5);
        //     return view('pages.quotations.view', compact('quotations'));
        // }else{
        //     $quotations = DB::table('customers')
        //     ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
        //     ->select('customers.*', 'quotations.id' , 'quotations.created_at','quotations.approval_status','quotations.quotation_type')
        //     ->whereNull('quotations.deleted_at')
        //     ->where('customer_name', 'LIKE' , '%' . $search . '%')
        //     ->where('approval_status',$search_approval_status)
        //     ->where('quotation_type',$search_quotation_type)
        //     ->orderByDesc('quotations.created_at')
        //     ->paginate(5);
        //     return view('pages.quotations.view', compact('quotations'));
        // }
        $quotations = DB::table('customers')
            ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
            ->select('customers.*', 'quotations.id', 'quotations.created_at', 'quotations.approval_status', 'quotations.quotation_type','quotations.billing_approval_status')
            ->whereNull('quotations.deleted_at')
            ->where('customer_name', 'LIKE', '%' . $search . '%');

        if (!is_null($search_approval_status)) {
            $quotations->where('approval_status', $search_approval_status);
        }
        if (!is_null($search_quotation_type)) {
            $quotations->where('quotation_type', $search_quotation_type);
        }
        $quotations = $quotations->orderByDesc('quotations.created_at')
            ->paginate(5);
        // return view('pages.quotations.view', compact('quotations'));
        return view('pages.quotations.view', [
            'quotations' => $quotations,
            'oldApprovalStatus' => $search_approval_status,
            'oldQuotationType' => $search_quotation_type,
        ]);
    }
    //approve quotations
    public function approveQuotations(Request $request){

            $quotations = Quotation::find($request->id);
            $quotations->approval_status = 'Approved';
            $quotations->save();
            return redirect()->back()->with('success','Quotation has been approved successfully!');
    }
    //view billing pdf
    public function previewPDFBilling($id){
        $billing = $id;
        //get the customer's name for this quotation
        $customer_name = DB::table('customers')
            ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
            ->select('customers.customer_name')
            ->where('quotations.id',$billing)
            ->value('customer_name');
        //get the customer's address for this quotation
        $customer_address = DB::table('customers')
        ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
        ->select('customers.address')
        ->where('quotations.id',$billing)
        ->value('address');
        //get the total of the quotation
        $grand_total = DB::table('product_quotation')->where('quotation_id', $id)->sum('sub_total');
        //get items purchased and group them by product name based on the quotation id
        $product_quotations = DB::table('product_quotation')
                            ->select('product_name', DB::raw('ROUND(AVG(unit_price),2) as unit_price'), DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(sub_total) as total_price'))
                            ->where('quotation_id','=',$id)
                            ->groupBy('product_name')
                            ->get();
        $dompdf = App::make('dompdf.wrapper');
        $dompdf->set_paper('A4');
        $pdf = $dompdf->loadView('pages.quotations.pdf.pdf_billing',compact('billing','product_quotations','grand_total','customer_name','customer_address')); 
        return $dompdf->stream('Billing_for_'.$billing.'.pdf');
    }
}

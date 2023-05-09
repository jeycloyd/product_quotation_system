<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class CustomerController extends Controller
{
    //show create form for customer
    public function create(){
        return view('pages.customers.create');
    }

    //store data in customer table
    public function store(Request $request){

        //validate data and check if name already exist in the soft delete records
        $request->validate([
            'customer_name' => [
                'required',
                Rule::unique('customers')->whereNull('deleted_at'),
                function ($attribute, $value, $fail) {
                    $softDeletedRecord = Customer::onlyTrashed()
                        ->where('customer_name', $value)
                        ->first();
                    if ($softDeletedRecord) {
                        //restore the softdeleted data if it exists before
                        $softDeletedRecord->restore();
                        $fail("The name already exists before. It has been restored instead.");
                    }
                },
            ],
            'customer_contact_no' => 'required'
        ]);
        //save data
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->address = $request->address;
        $customer->customer_contact_no = $request->customer_contact_no;
        $customer->save();
        
        //return response
        return redirect('customers/index')->with('success','Customer added successfully!');
    }
    //show list of all customers
    public function index(){
        $customers = DB::table('customers')
                    ->whereNull('deleted_at')
                    ->paginate(5);
        return view('pages/customers/index', compact('customers'));
    }
    //show a specific customer info
    public function show($id){
        $customer = Customer::findOrFail($id);
        $customer_id = $customer->id;
        $customer_address = $customer->address;
        $customer_name = $customer->customer_name;
        $customer_contact_no = $customer->customer_contact_no;
        return view('pages/customers/edit', compact('customer_id' , 'customer_name', 'customer_contact_no','customer_address'));
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
        $customer_name = DB::table('customers')->where('customer_name', $request->customer_name)->value('customer_name');
        $customer_contact_no = DB::table('customers')->where('customer_name', $request->customer_name)->value('customer_contact_no');
        $customer_address = DB::table('customers')->where('customer_name', $request->customer_name)->value('address');
        if($customer_name == $request->customer_name && $customer_contact_no == $request->customer_contact_no && $customer_address == $request->customer_address){
            return redirect('customers/index');
        }else{
            $customer->customer_name = $request->customer_name;
            $customer->customer_contact_no = $request->customer_contact_no;
            $customer->address = $request->customer_address;
            $customer->save();
            return redirect('customers/index')->with('success', 'Customer details have been updated');
        }
        
    }
    //search details from the customer list
    public function search(Request $request){
        $search = $request->search;
        $customers =  DB::table('customers')
                      ->select('*')
                      ->where('customer_name', 'LIKE' , '%' . $search . '%')
                      ->paginate(5);
        return view('pages.customers.index', compact('customers'));
    }
    // //delete customers 
    public function destroy(Request $request){
        $customers = Customer::findOrFail($request->id);
        $customers->delete();
        return redirect()->back()->with('success','Customer removed successfully!');
    }
    //show all quotations made by a specific user
    public function view($id){
        // $customers = Customer::all();
        $customer_name = Customer::where('id',$id)->value('customer_name');
        $customer_id = $id;
        $customer_quotations = DB::table('quotations')
                     ->join('customers' , 'customers.id' , '=' , 'quotations.customer_id')
                     ->select('quotations.id as quotation_id', 'quotations.created_at', 'customers.id as customer_id','quotations.approval_status')
                     ->where('customers.id',$id)
                     ->whereNull('quotations.deleted_at')
                     ->paginate(5);
        return view('pages.customers.view_customer',compact('customer_quotations','customer_name','customer_id'));
    }
    //search a quotation from the list of quotations of a specific user
    public function searchCustomerQuotations($id, Request $request){
        $search = $request->search;
        $approval_status = $request->approval_status;
        $customer_id = $id;
        $customer_name = Customer::where('id',$id)->value('customer_name');
        if(!is_null($approval_status)){
            //show list of all quotations by the customer
            $customer_quotations = DB::table('quotations')
                     ->join('customers' , 'customers.id' , '=' , 'quotations.customer_id')
                     ->select('quotations.id as quotation_id', 'quotations.created_at', 'customers.id as customer_id','quotations.approval_status')
                     ->where('customers.id',$id)
                     ->where('quotations.id', 'LIKE' , '%' . $search . '%')
                     ->where('quotations.approval_status',$approval_status)
                     ->whereNull('quotations.deleted_at')
                     ->paginate(5);
            return view('pages.customers.view_customer',compact('customer_quotations','customer_name','customer_id'));
        }else{
            $customer_quotations = DB::table('quotations')
                     ->join('customers' , 'customers.id' , '=' , 'quotations.customer_id')
                     ->select('quotations.id as quotation_id', 'quotations.created_at', 'customers.id as customer_id','quotations.approval_status')
                     ->where('customers.id',$id)
                     ->where('quotations.id', 'LIKE' , '%' . $search . '%')
                     ->whereNull('quotations.deleted_at')
                     ->paginate(5);
            return view('pages.customers.view_customer',compact('customer_quotations','customer_name','customer_id'));
        }
        
        
    }
    //signature form view
    public function signatureForm(){
        return view('signature');
    }
    //submit signature and output the signature through a PDF
    public function storeImage(request $request){
        //get data from hidden input
        $image = $request->base64string;
        //output the png image of the signature (via base64) to a PDF
        $dompdf = App::make('dompdf.wrapper');
            $dompdf->set_paper('A4');
            $pdf = $dompdf->loadView('pages.quotations.pdf.pdftest',compact('image')); 
            return $dompdf->stream('Signature'.'.pdf');
    }
}

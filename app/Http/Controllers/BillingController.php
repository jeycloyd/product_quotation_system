<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Billing;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    //show billing page based on the selected quotation
    public function viewBilling($id){
        //extract id from url
        $quotation_id = $id;
        //total of the quotation
        $total = DB::table('product_quotation')->where('quotation_id', $quotation_id)->sum('sub_total');

        //fetch data from billings table
        return view('pages.billings.billing',compact('quotation_id','total'));
    }

    //create a billing for a specific quotation
    public function createBilling(){

    }
    
    //approve a billing from the list of quotations
    public function approveBilling(Request $request){
        //get inputs
        $quotation_id = $request->id;
        $customer_id = $request->customer_id;
        $total = $request->total;

        //save to billing table
        $billings = new Billing();
        $billings->customer_id = $customer_id;
        $billings->quotation_id = $quotation_id;
        $billings->due = $total;
        $billings->quotation_id = $quotation_id;
        $billings->save();

        //update quotation and make it approved
        $quotations = Quotation::find($quotation_id);
        $quotations->billing_approval_status = 'Approved';
        $quotations->save();

        //return response
        return redirect()->back()->with('success','Billing approved');

    }

    //mark as paid for the billing
    public function markAsPaidBilling(Request $request){
        //get the receipt image from the file input
        if ($request->hasFile('receipt_image')) {
            $image = $request->file('receipt_image');
            $imageContents = file_get_contents($image->getRealPath());
            $base64Image = base64_encode($imageContents);
            //add webp extension to the base64
            $final_base64Image = 'data:image/webp;base64,'.$base64Image;
        }

        //update payment status of billing to paid
        $billing_id = $request->billing_id;
        $billings = Billing::findOrFail($billing_id);
        $billings->payment_status = 'paid';
        $billings->receipt_image = $final_base64Image;
        $billings->save();

        return redirect()->back()->with('success','Marked as paid');
    }
}

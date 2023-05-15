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
        //get customer_id
        $customer_id = DB::table('customers')
            ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
            ->select('customers.id')
            ->where('quotations.id',$id)
            ->value('id');
        //extract id from url
        $quotation_id = $id;

        //get the months from the billings table and display in dropdown
        $months = DB::table('billings')
                    ->select('month')
                    ->where('quotation_id', $quotation_id)
                    ->distinct()
                    ->orderBy(DB::raw("MONTH(STR_TO_DATE(month, '%M'))"))
                    ->get();

        //get the years from the billings table and display in dropdown
        $years = DB::table('billings')
                    ->select('year')
                    ->where('quotation_id',$quotation_id)
                    ->distinct()
                    ->orderBy('year')
                    ->get();

        //the cost of the quotation
        $quotation_cost = DB::table('product_quotation')->where('quotation_id', $quotation_id)->sum('sub_total');

        //total balance of the billing
        $total_balance = DB::table('billings')->where('quotation_id', $quotation_id)->where('payment_status','unpaid')->sum('due');

        //fetch data from billings table
        $billings = DB::table('billings')->where('quotation_id',$id)->paginate(5);
        return view('pages.billings.billing',compact('quotation_id','total_balance','customer_id','billings','quotation_cost','months','years'));
    }

    //create a billing for a specific quotation
    public function createBilling(Request $request){
        $customer_id = $request->customer_id;
        $quotation_id = $request->quotation_id;
        $due = $request->due;
        $month = $request->month;
        $year = $request->year;

        //check if a billing was already creted in the same month + year
        $check_duplicate_month_and_year = DB::table('billings')
                                            ->where('quotation_id',$quotation_id)
                                            ->where('month',$month)
                                            ->where('year',$year)
                                            ->exists();
        if($check_duplicate_month_and_year){
            return redirect()->back()->with('error','Billing already created!');
        }else{
            //store billing inside
            $billings = new Billing();
            $billings->customer_id = $customer_id;
            $billings->quotation_id = $quotation_id;
            $billings->due = $due;
            $billings->month = $month;
            $billings->year = $year;
            $billings->save();

            return redirect()->back()->with('success','Billing for this month addedd successfully!');
        }        
    }
    
    //approve a billing from the list of quotations
    public function approveBilling(Request $request){
        //get inputs
        $quotation_id = $request->id;

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

    //search records inside the billing of a specific quotation
    public function search(Request $request, $id){
        //get search value for month and year
        $search_month = $request->month;
        $search_year = $request->year;

        //get customer_id
         $customer_id = DB::table('customers')
         ->join('quotations', 'customers.id', '=', 'quotations.customer_id')
         ->select('customers.id')
         ->where('quotations.id',$id)
         ->value('id');
        //extract id from url
        $quotation_id = $id;

        //get the months from the billings table and display in dropdown
        $months = DB::table('billings')
                    ->select('month')
                    ->where('quotation_id', $quotation_id)
                    ->distinct()
                    ->orderBy(DB::raw("MONTH(STR_TO_DATE(month, '%M'))"))
                    ->get();

        //get the years from the billings table and display in dropdown
        $years = DB::table('billings')
                    ->select('year')
                    ->where('quotation_id',$quotation_id)
                    ->distinct()
                    ->orderBy('year')
                    ->get();

        //the cost of the quotation
        $quotation_cost = DB::table('product_quotation')->where('quotation_id', $quotation_id)->sum('sub_total');

        //total balance of the billing
        $total_balance = DB::table('billings')->where('quotation_id', $quotation_id)->where('payment_status','unpaid')->sum('due');

        //fetch data from billings table
        $billings = DB::table('billings')
        ->select('*')
        ->where('quotation_id', $id);

        //attach this when month is selected
        if (!is_null($search_month)){
        $billings->where('month', $search_month);
        }

        //attach this when year is selected
        if (!is_null($search_year)){
        $billings->where('year', $search_year);
        }

        $billings = $billings->paginate(5);

        return view('pages.billings.billing',compact('quotation_id','total_balance','customer_id','billings','quotation_cost','months','years'));

    }
}

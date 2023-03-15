<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //show create form for products
    public function create(){
        return view('pages.products.create');
    }
    
    //store data to products table
    public function store(Request $request){

        // //validate data
        $request->validate([
            'product_name' => 'required|unique:products',
            'product_description' => 'required',
            'product_price' => 'required'
        ]);

        //save data
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->save();
        
        //return response
        return redirect()->back()->with('success','Product added successfully');
    }
    //delete a product from the temp tables 
    public function destroyProductQuotation($product_name){
        $product = DB::table('temp_tables')
                    ->where('product_name','=',$product_name)
                    ->delete();
        return redirect()->back()->with('success','Product deleted successfully');
    }
}

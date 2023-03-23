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
        $product->status = 'Active';
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
    //show list of added products
    public function index(){
        $products = DB::table('products')->where('status','Active')->paginate(5);
        return view('pages/products/index', compact('products'));
    }
    //show the selected product details
    public function show($id){
        $products = Product::findOrFail($id);
        $product_id = $products->id;
        $product_name = $products->product_name;
        $product_price = $products->product_price;
        return view('pages/products/edit', compact('products', 'product_id' , 'product_name', 'product_price'));
    }
    //update info of selected product
    public function update($id, Request $request){
        $products = Product::findOrFail($id);
        $products->product_name = $request->product_name;
        $products->product_price = $request->product_price;
        $products->save();
        return redirect('/products/index')->with('success','Product details have been updated');
    }
    //search details from the customer list
    public function search(Request $request){
        $search = $request->search;
        $products =  DB::table('products')
                      ->select('*')
                      ->where('product_name', 'LIKE' , '%' . $search . '%')
                      ->paginate(5);
        return view('pages.products.index', compact('products'));
    }
    //delete selected product from list
    public function destroy($id){
        $products = Product::findOrFail($id);
        $products->status = 'Inactive';
        $products->save();
        return redirect('products/index')->with('success','product deleted successfully');
    }
}

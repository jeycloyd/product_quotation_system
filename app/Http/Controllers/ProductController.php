<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TempTable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //show create form for products
    public function create(){
        return view('pages.products.create');
    }
    
    //store data to products table
    public function store(Request $request){
        $product = Product::where('product_name', $request->product_name)
                    ->where('status','Inactive')
                    ->first();
        if ($product) {
            // product already exists, update its status to 'Active'
            $product->status = 'Active';
            $product->save();
            return redirect()->back()->with('message','Product details already exists and has been restored.');
        } else {
            // product does not exist, add it to the database
            $request->validate([
                'product_name' => 'required|unique:products',
                'product_description' => 'required',
                'product_price' => 'required',
            ]);
            $product = new Product([
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'product_price' => $request->product_price,
                'status' => 'Active',
            ]);
            $product->product_description = $request->product_description;
            $product->product_price = $request->product_price;
            $product->status = 'Active';
            $product->save();
            //return response
            return redirect('/products/index')->with('success','Product added successfully');
        }  
    }
    //delete a product from the temp tables 
    public function destroyProductQuotation($product_name, $id){
        $product = TempTable::where('product_name','=',$product_name)
                             ->where('quotation_id',$id);
        $product->delete(); 
        return redirect()->back()->with('success','Product removed from the list');
    }
    //subtract one quantity from the temp tables products list
    public function subtractOne($product_name, $id){
        $quotations = DB::table('temp_tables')
                ->select('product_name', DB::raw('ROUND(AVG(unit_price),2) as unit_price'), DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(total_price) as total_price'))
                ->where('product_name', '=', $product_name)
                ->where('quotation_id', $id)
                ->groupBy('product_name')
                ->first();
        $quantity = $quotations->quantity;
        if ($quantity <= 1) {
            DB::table('temp_tables')
                ->where('product_name', '=', $product_name)
                ->delete();
        } else {
            //$temp_table = new TempTable();
            $temp_table = TempTable::where('product_name', '=', $product_name)->first();
            $temp_table->quantity -= 1;
            $temp_table->total_price = $temp_table->quantity * $temp_table->unit_price;
            $temp_table->save();
        }
        return redirect()->back();
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

        // //validate data
        $request->validate([
            'product_name' => [ 'required',
                Rule::unique('products')->ignore($id),
            ],
            'product_price' => 'required'
        ]);

        $product_name = DB::table('products')->where('product_name', $request->product_name)->value('product_name');
        if($product_name == $request->product_name){
            return redirect('products/index');
        }else{
            //update data
            $products->product_name = $request->product_name;
            $products->product_price = $request->product_price;
            $products->save();
            return redirect('/products/index')->with('success','Product details have been updated');
        }
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
        return redirect('products/index')->with('success','Product deleted successfully!');
    }
}

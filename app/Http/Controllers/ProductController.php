<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    // [httpGet]
    public function show()
    {
        $products = Product::where('action_type', '!=', 'DELETE')
                            ->orderBy('product_id', 'desc')
                            ->get();
        
        $data = compact('products');

        return view('product.productlist')->with($data);
    }

    // [httpGet]
    public function create()
    {
        return view('product.addproduct');
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'registration_date' => 'required',
                'product_name' => 'required'
            ]
        );
        // echo "<pre>";
        // print_r($request->all());
        $product = new Product();

        $product->registration_date = $request['registration_date'];  
        $product->product_name = $request['product_name'];  
        $product->product_code = $request['product_code'] ; 
        $product->product_unit_type = $request['product_unit_type'];  
        $product->product_unit_price = $request['product_unit_price'] ; 
        $product->product_actual_price = $request['product_actual_price'] ;
        $product->product_unit_price_c = $request['product_unit_price_c'];  
        $product->product_net_price = $request['product_net_price'];  
        $product->atv_rate = $request['atv_rate'];  
        $product->material_description = $request['material_description'];  
        $product->product_packing = $request['product_packing'];  
        $product->import_information = $request['import_information'];  
        $product->h_s_code = $request['h_s_code'];
        $product->low_stock_alert = $request['low_stock_alert'];  
        $product->product_description = $request['product_description'];  
        $product->product_generic = $request['product_generic'];
        $product->product_category = $request['product_category'] ; 
        $product->product_brand = $request['product_brand'];
        $product->product_grouping = $request['product_grouping'];  
        $product->product_image = $request['product_image'];
        $product->action_type = 'INSERT';
        $product->user_id = 'sys-user';
        $product->action_date = now();

        $product->save();

        return redirect('/product/list');
    }
}

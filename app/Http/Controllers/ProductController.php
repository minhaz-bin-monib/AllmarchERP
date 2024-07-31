<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    // [httpGet]
    public function show()
    {
        $products = Product::all();
        echo '<pre>';
        print_r($products->toArray());

        //return view('product.productlist');
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
        echo "<pre>";
        print_r($request->all());
        //return view('product.productlist');
    }
}

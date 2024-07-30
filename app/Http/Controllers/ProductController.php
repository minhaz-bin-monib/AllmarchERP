<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    // [httpGet]
    public function show()
    {
        // Fetach data from BD and show into view page
        return view('product.productlist');
    }

    // [httpGet]
    public function create()
    {
        return view('product.addproduct');
    }

    // [httpPost]
    public function store(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        //return view('product.productlist');
    }
}

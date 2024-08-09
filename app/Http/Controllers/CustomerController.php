<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
     // [httpGet]
     public function show()
     {
         // Fetach data from BD and show into view page
         return view('customer.customerlist');
     }
 
     // [httpGet]
     public function create()
     {
        $customer = new Customer(); 
        $url = url('/customer/create');
        $toptitle = 'Add Customer';
        $data = compact('customer','url', 'toptitle');
        return view('customer.addcustomer')->with($data);
     }
 
     // [httpPost]
     public function store(Request $request)
     {
        $request->validate(
            [
                'registration_date' => 'required'
            ]
        );
        echo '<pre>';
        print_r($request->all());
        // return view('customer.customerlist');
     }
}

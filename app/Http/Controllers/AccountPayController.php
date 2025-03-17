<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountPayController extends Controller
{
    //
    public function checkPrint(){
        return view('accountPay.checkPay');
    }
}

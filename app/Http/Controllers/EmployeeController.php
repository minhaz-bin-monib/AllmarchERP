<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
     // [httpGet]
     public function show()
     {
         // Fetach data from BD and show into view page
         return view('employee.employeelist');
     }
 
     // [httpGet]
     public function create()
     {
         return view('employee.addemployee');
     }
 
     // [httpPost]
     public function store()
     {
         return view('employee.employeelist');
     }
}

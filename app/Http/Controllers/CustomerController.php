<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
{
     // [httpGet]
     public function show()
     { 
        $customers = Customer::where('action_type', '!=', 'DELETE')
                            ->orderBy('customer_id', 'desc')
                            ->get();

        $data = compact('customers');

        return view('customer.customerlist')->with($data);
     }
      // API only [httpGet] 
      public function getList()
      { 
         $customers = Customer::where('action_type', '!=', 'DELETE')
                             ->orderBy('customer_name')
                             ->get();

         return response()->json($customers);
      }
 
     // [httpGet]
     public function create()
     {
        $customer = new Customer(); 
        $customer->registration_date = Carbon::now()->format('Y-m-d');
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
                'registration_date' => 'required',
                'customer_name' => 'required',
            ]
        );
        $customer = new Customer();

        $customer->registration_date = $request['registration_date'];
        $customer->customer_name = $request['customer_name'];
        $customer->proprietor_name =  $request['proprietor_name'];
        $customer->loyalty_discount = $request['loyalty_discount'];
        $customer->customer_dob = $request['customer_dob'];
        $customer->customer_phone = $request['customer_phone'];
        $customer->national_id = $request['national_id'];
        $customer->passport_no = $request['passport_no'];
        $customer->blood_group = $request['blood_group'];
        $customer->customer_email = $request['customer_email'];
        $customer->customer_disability = $request['customer_disability'];
        $customer->customer_remark = $request['customer_remark'];
        $customer->customer_address = $request['customer_address'];
        $customer->fathers_name = $request['fathers_name'];
        $customer->mothers_name = $request['mothers_name'];
        $customer->family_members = $request['family_members'];
        $customer->siblings_position= $request['siblings_position'];
        $customer->spouse_name = $request['spouse_name'];
        $customer->number_of_kids= $request['number_of_kids'];
        $customer->customer_grade = $request['customer_grade'];
        $customer->customer_referred_by = $request['customer_referred_by'];
        $customer->emergency_contact_details = $request['emergency_contact_details'];
        $customer->set_reminder_amount = $request['set_reminder_amount'];
        $customer->customer_note = $request['customer_note'];
        $customer->customer_image = $request['customer_image'];
        $customer->action_type = 'INSERT';
        $customer->user_id = 'sys-user';
        $customer->action_date = now();

        $customer->save();

        return redirect('/customer/list');
     }

     // [httpGet]
    public function delete($id)
    {
        $customer = Customer::find($id);
        
        $customer->action_type = 'DELETE';
        $customer->action_date = now();

        $customer->save();

        return redirect('/customer/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $customer = Customer::find($id);

        if(is_null($customer))
        {
            // customer not found
            return redirect('/customer/list');
        }
        else{
            $url = url('/customer/update') ."/". $id;
            $toptitle = 'Edit Customer';

            $data = compact('customer', 'url', 'toptitle'); // data and dynamic url pass into view
            
            return view('customer.addcustomer')->with($data);;
         
        }
    }

    // [httpPost]
    public function update($id, Request $request)
    {
        $request->validate(
            [
                'registration_date' => 'required',
                'customer_name' => 'required'
            ]
        );

        $customer = Customer::find($id);

        $customer->registration_date = $request['registration_date'];
        $customer->customer_name = $request['customer_name'];
        $customer->proprietor_name =  $request['proprietor_name'];
        $customer->loyalty_discount = $request['loyalty_discount'];
        $customer->customer_dob = $request['customer_dob'];
        $customer->customer_phone = $request['customer_phone'];
        $customer->national_id = $request['national_id'];
        $customer->passport_no = $request['passport_no'];
        $customer->blood_group = $request['blood_group'];
        $customer->customer_email = $request['customer_email'];
        $customer->customer_disability = $request['customer_disability'];
        $customer->customer_remark = $request['customer_remark'];
        $customer->customer_address = $request['customer_address'];
        $customer->fathers_name = $request['fathers_name'];
        $customer->mothers_name = $request['mothers_name'];
        $customer->family_members = $request['family_members'];
        $customer->siblings_position= $request['siblings_position'];
        $customer->spouse_name = $request['spouse_name'];
        $customer->number_of_kids= $request['number_of_kids'];
        $customer->customer_grade = $request['customer_grade'];
        $customer->customer_referred_by = $request['customer_referred_by'];
        $customer->emergency_contact_details = $request['emergency_contact_details'];
        $customer->set_reminder_amount = $request['set_reminder_amount'];
        $customer->customer_note = $request['customer_note'];
        $customer->customer_image = $request['customer_image'];
        $customer->action_type = 'UPDATE';
        $customer->user_id = 'sys-user';
        $customer->action_date = now();

        $customer->save();

        return redirect('/customer/list');
    }

}

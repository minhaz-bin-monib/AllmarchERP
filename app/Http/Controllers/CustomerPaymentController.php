<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPayment;
use App\Models\Customer;
use App\Models\DipositMethod;
use App\Models\BankName;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CustomerPaymentController extends Controller
{
    // [httpGet]
    public function show($type)
    {
        $searchType = $type;

        // Base query
        $query = DB::table('customer_payments')
            ->join('customers', 'customer_payments.customer_id', '=', 'customers.customer_id')
            ->leftJoin('diposit_methods', 'customer_payments.diposit_method_id', '=', 'diposit_methods.diposit_method_id')
            ->leftJoin('bank_names', 'customer_payments.bank_name_id', '=', 'bank_names.bank_name_id')
            ->where('customer_payments.action_type', '!=', 'DELETE')
            ->select(
                'customer_payments.*',
                'customers.customer_name',
                'diposit_methods.method_name',
                'bank_names.bank_name'
            )
            ->orderBy('customer_payments.customer_payment_id', 'desc');

        // Add condition if $type is not 'All'
        if ($type !== 'All') {
            $query->where('customer_payments.payment_type', '=', $type);
        }

        $customerPayments = $query->get();

        return view('customerPayment.customerPaymentlist', compact('customerPayments', 'searchType'));
    }



    // [httpGet]
    public function create()
    {
        $customerPayment = new CustomerPayment();
        $customerPayment->receive_date = Carbon::now()->format('Y-m-d');
        $customerPayment->honour_date = Carbon::now()->format('Y-m-d');

        $customers = Customer::get();
        $dipositMethods = DipositMethod::get();
        $bankNames = BankName::get();

        $url = url('/customerPayment/create');
        $toptitle = 'Make Customer Payment';
        $data = compact('customerPayment', 'customers', 'dipositMethods', 'bankNames', 'url', 'toptitle');
        return view('customerPayment.addCustomerPayment')->with($data);

    }

    // [httpPost]
    public function store(Request $request)
    {

        $request->validate(
            [
                'receive_date' => 'required',
                'customer_id' => 'required',
                'diposit_dmount' => 'required',
                'diposit_method_id' => 'required',
            ]
        );

        $customerPayment = new CustomerPayment();

        $customerPayment->receive_date = $request['receive_date'];
        $customerPayment->customer_id = $request['customer_id'];
        $customerPayment->diposit_dmount = $request['diposit_dmount'];
        $customerPayment->diposit_method_id = $request['diposit_method_id'];
        $customerPayment->honour_date = $request['honour_date'];
        $customerPayment->reference = $request['reference'];
        $customerPayment->bank_name_id = $request['bank_name_id'];
        $customerPayment->payment_type = "Pending"; // Honoured, Rejected
        $customerPayment->action_type = 'INSERT';
        $customerPayment->user_id = 'sys-user';
        $customerPayment->action_date = now();

        $customerPayment->save();

        return redirect('/customerPayment/list/Pending');

    }

    // [httpGet]
    public function delete($id)
    {
        /*
          $customerPayment = CustomerPayment::find($id);
          
          $customerPayment->action_type = 'DELETE';
          $customerPayment->action_date = now();
  
          $customerPayment->save();
  
          return redirect('/customerPayment/list');
        */
    }

    // [httpGet]
    public function edit($id)
    {

        $customerPayment = CustomerPayment::find($id);

        if (is_null($customerPayment)) {
            // customerPayment not found
            return redirect('/customerPayment/list/Pending');
        } else {
            $url = url('/customerPayment/update') . "/" . $id;
            $toptitle = 'Edit Customer Payment';

            $customers = Customer::get();
            $dipositMethods = DipositMethod::get();
            $bankNames = BankName::get();

            $data = compact('customerPayment', 'customers', 'dipositMethods', 'bankNames', 'url', 'toptitle');

            return view('customerPayment.addcustomerPayment')->with($data);

        }


    }

    // [httpPost]
    public function update($id, Request $request)
    {

        $request->validate(
            [
                'receive_date' => 'required',
                'customer_id' => 'required',
                'diposit_dmount' => 'required',
                'diposit_method_id' => 'required',
            ]
        );

        $customerPayment = CustomerPayment::find($id);

        $customerPayment->receive_date = $request['receive_date'];
        $customerPayment->customer_id = $request['customer_id'];
        $customerPayment->diposit_dmount = $request['diposit_dmount'];
        $customerPayment->diposit_method_id = $request['diposit_method_id'];
        $customerPayment->honour_date = $request['honour_date'];
        $customerPayment->reference = $request['reference'];
        $customerPayment->bank_name_id = $request['bank_name_id'];
        $customerPayment->payment_type = "Pending"; // Honoured, Rejected
        $customerPayment->action_type = 'INSERT';
        $customerPayment->user_id = 'sys-user';
        $customerPayment->action_date = now();

        $customerPayment->save();

        return redirect('/customerPayment/list/Pending');

    }
}

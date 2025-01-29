<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerPayment;
use App\Models\Customer;
use App\Models\DipositMethod;
use App\Models\BankName;
use App\Models\CustomerForwardBlance;
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
            if ($customerPayment->payment_type == 'Pending')
                $toptitle = 'Edit Customer Payment';
            else
                $toptitle = 'View ' . $customerPayment->payment_type . ' Payment';

            $customers = Customer::get();
            $dipositMethods = DipositMethod::get();
            $bankNames = BankName::get();

            $data = compact('customerPayment', 'customers', 'dipositMethods', 'bankNames', 'url', 'toptitle');

            return view('customerPayment.addCustomerPayment')->with($data);

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
    public function statusChange($id, $status)
    {


        $customerPayment = CustomerPayment::find($id);


        $customerPayment->payment_type = $status; // Honoured, Rejected

        $customerPayment->save();

        return redirect('/customerPayment/list/' . $status);

    }

    // [httpGet]
    public function createForward()
    {
        $customerForward = new CustomerForwardBlance();

        $customersForwardList = DB::table('customer_forward_blances')
            ->join('customers', 'customer_forward_blances.customer_id', '=', 'customers.customer_id')
            ->select(
                'customer_forward_blances.*',
                'customers.customer_name'
            )
            ->orderBy('customer_forward_blances.customer_forward_blance_id', 'desc')
            ->get();

        $customers = Customer::get();

        $url = url('/customerPayment/createForward');
        $toptitle = 'Customer Forward Info';
        $data = compact('customerForward', 'customers', 'customersForwardList', 'url', 'toptitle');
        return view('customerPayment.addCustomerForward')->with($data);

    }

    // [httpPost]
    public function storeForward(Request $request)
    {

        $request->validate(
            [
                'customer_id' => 'required',
                'opening_forward_invoice_amount' => 'required',
                //'opening_forward_given_amount' => 'required',
            ]
        );
        $customerExist = CustomerForwardBlance::where('customer_id', '=', $request['customer_id'])->first();

        if ($customerExist) {
            return redirect()->back()->withErrors(['customer_id' => 'This customer already has a forward entry.']);
        }
        $customerPayment = new CustomerForwardBlance();

        $customerPayment->customer_id = $request['customer_id'];
        $customerPayment->opening_forward_invoice_amount = $request['opening_forward_invoice_amount'];
        $customerPayment->opening_forward_given_amount = 0;//$request['opening_forward_given_amount'];
        $customerPayment->save();

        return redirect('/customerPayment/createForward');

    }

    // [httpGet]
    public function statementReport($customer_id, $startDate, $endDate, $type)
    {
         $FormDate = Carbon::createFromFormat('Y-m-d', $startDate);
         $ToDate = Carbon::createFromFormat('Y-m-d', $endDate);
        $FormDate1 = Carbon::parse($startDate)->format('Y-m-d');
        $ToDate1 = Carbon::parse($endDate)->format('Y-m-d');
        $searchType = $type;
        $customerid = $customer_id;
        $customerName = '';

        // Customer Info    
        $customers = Customer::get();
        $cust = Customer::where('customer_id', '=', $customer_id)->first();
        ;
        if ($cust) {
            $customerName = $cust->customer_name;
        }

        // Opening Amount of Invoice and Payment Amount
        $openingInvAmt = 0;
        $openingDipositAmt = 0;
        $customerForward = CustomerForwardBlance::where('customer_id', '=', $customerid)->first();
        if ($customerForward) {
            $openingInvAmt = $customerForward->opening_forward_invoice_amount;
            $openingDipositAmt = $customerForward->opening_forward_given_amount;
        }

        // get Invoice and Payment-Houonered Date < less then FromDate 
        $openingDipositAmt += DB::table('customer_payments')
            ->where('customer_payments.honour_date', '<', $FormDate1)
            ->where('customer_payments.customer_id', $customer_id)
            ->where('customer_payments.payment_type', 'Honoured')
            ->where('customer_payments.action_type', '!=', 'DELETE')
            ->sum('customer_payments.diposit_dmount');

        $salesInvoiceFromDate = DB::table('invoices')
             ->where('invoices.invoice_date', '<', $FormDate1)
            ->where('invoice_type', 'Statement')
            ->where('customer_id', $customer_id)
            ->where('action_type', '!=', 'DELETE')
            ->select('salesInvoice_id', 'customer_id', 'invoice_date')
            ->get();

        $salInvIds = $salesInvoiceFromDate->pluck('salesInvoice_id');

        $salesInvProds = DB::table('invoice_products')
            ->whereIn('salesInvoice_id', $salInvIds)
            ->where('action_type', '!=', 'DELETE')
            ->select('salesInvoice_id', 'packing', 'no_of_packing', 'unit_price')
            ->get();

        $salesInvProdsGrp = $salesInvProds->groupBy('salesInvoice_id');

        $SalesInvResults = $salesInvoiceFromDate->map(function ($salesInv) use ($salesInvProdsGrp, &$openingInvAmt) {
            $quantitySum = 0;
            $invoice_amount = 0;

           
            $products = $salesInvProdsGrp->get($salesInv->salesInvoice_id, []);

            foreach ($products as $product) {
                $Weight = $product->packing * $product->no_of_packing;
                $Cost = $Weight * $product->unit_price;
                $quantitySum += $Weight;
                $invoice_amount += $Cost;
            }
            $openingInvAmt += $invoice_amount;
        });


        // All Invoice get by customer_Id
        // and invoice Quantity and Amount Sum should be
        $salesInvoiceFromToDate = DB::table('invoices')
            ->whereBetween(DB::raw('DATE(invoice_date)'), [$FormDate1, $ToDate1])
            ->where('invoice_type', 'Statement')
            ->where('customer_id', $customer_id)
            ->where('action_type', '!=', 'DELETE')
            ->select('salesInvoice_id', 'customer_id', 'invoice_date')
            ->orderBy('invoice_date', 'ASC')
            ->get();

        $salesInvIds = $salesInvoiceFromToDate->pluck('salesInvoice_id');

        $salesInvoiceProducts = DB::table('invoice_products')
            ->whereIn('salesInvoice_id', $salesInvIds)
            ->where('action_type', '!=', 'DELETE')
            ->select('salesInvoice_id', 'packing', 'no_of_packing', 'unit_price')
            ->get();

        $salesInvoiceProductsGrouped = $salesInvoiceProducts->groupBy('salesInvoice_id');

        $SalesInvResults = $salesInvoiceFromToDate->map(function ($salesInv) use ($salesInvoiceProductsGrouped) {
            $quantitySum = 0;
            $invoice_amount = 0;

            // Get products for the current sales invoice
            $products = $salesInvoiceProductsGrouped->get($salesInv->salesInvoice_id, []);

            foreach ($products as $product) {
                $Weight = $product->packing * $product->no_of_packing;
                $Cost = $Weight * $product->unit_price;
                $quantitySum += $Weight;
                $invoice_amount += $Cost;
            }

            return [
                'customer_id' => $salesInv->customer_id,
                'invoice_date' => $salesInv->invoice_date,
                'type' => 'Delivery',
                'salesInvoice_id' => $salesInv->salesInvoice_id,
                'quantity' => $quantitySum,
                'invoice_amount' => $invoice_amount,
                'diposit_amount' => '',
            ];
        });

        // All payments by customer_id
        $customerPayments = DB::table('customer_payments')
            ->leftJoin('diposit_methods', 'customer_payments.diposit_method_id', '=', 'diposit_methods.diposit_method_id')
            ->leftJoin('bank_names', 'customer_payments.bank_name_id', '=', 'bank_names.bank_name_id')
            ->whereBetween('customer_payments.honour_date', [$FormDate1, $ToDate1]) // Filter between dates
            ->where('customer_payments.customer_id', $customer_id)
            ->where('customer_payments.payment_type', 'Honoured')
            ->where('customer_payments.action_type', '!=', 'DELETE')
            ->select(
                'customer_payments.*',
                'diposit_methods.method_name',
                'bank_names.bank_name'
            )
            ->orderBy('customer_payments.honour_date', 'ASC')
            ->get();


        $customerPaymentResults = $customerPayments->map(function ($custPay) {
            return [
                'customer_id' => $custPay->customer_id,
                'invoice_date' => $custPay->honour_date,
                'type' => $custPay->method_name,
                'salesInvoice_id' => $custPay->bank_name,
                'quantity' => 'Ref:' . $custPay->reference,
                'invoice_amount' => '',
                'diposit_amount' => $custPay->diposit_dmount,
            ];
        });
        // Date wise sort them and like table way 
        $finalStatemnetResults = $SalesInvResults->merge($customerPaymentResults)->sortBy('invoice_date')
            ->values();


        $data = compact(
            'customers',
            'customerName',
            'customerid',
            'FormDate',
            'ToDate',
            'searchType',
            'openingInvAmt',
            'openingDipositAmt',
            'finalStatemnetResults'
        );
        return view('customerPayment.statementReport')->with($data);

    }

}

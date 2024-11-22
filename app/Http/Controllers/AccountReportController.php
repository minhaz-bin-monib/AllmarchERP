<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\SalesInvoice;
use Illuminate\Support\Facades\DB;
class AccountReportController extends Controller
{
    public function lastMonthSales($lastMonth)
    {
        $date = Carbon::createFromFormat('Y-m-d', $lastMonth);
        
        // Extract year and month
        $year = $date->year;
        $month = $date->month;



        $salesInvoice =  DB::table('invoices')
                           // ->join('products', 'invoices.product_id', '=', 'products.product_id')
                             ->join('customers', 'invoices.customer_id', '=', 'customers.customer_id')
                             ->whereYear('invoices.invoice_date', $year) 
                             ->whereMonth('invoices.invoice_date', $month) 
                             ->where('invoices.action_type', '!=', 'DELETE')
                            ->select('invoices.*', 'customers.customer_name')
                            ->get();

        // Note:  Here we are grouping by customer_id and summing up the sales
        // We need to work 
        // looing all same customer customer_id 
        // their sales values sum together
        // Looping or need to query more advanced to get acoureate output 
        // Query is more difficult reater server looping 
        // I hope you understand 
        
        $salesInvoice =  $salesInvoice->map(function ($invoice) {
            $invoice->totalSales = '1000-DO'; // Static value
            return $invoice;
        });

        // Now Group by customer get by only one customer get at at a time
        $salesInvoice = $salesInvoice->unique('customer_id');
        $data = compact('salesInvoice', 'date');

        return view('accountReport.lastMonthSales')->with($data);
    }
}

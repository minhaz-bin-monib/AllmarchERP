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



        $salesInvoice = DB::table('invoices')
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

        $salesInvoice = $salesInvoice->map(function ($invoice) {
            $invoice->totalSales = '1000-DO'; // Static value
            return $invoice;
        });

        // Now Group by customer get by only one customer get at at a time
        $salesInvoice = $salesInvoice->unique('customer_id');
        $data = compact('salesInvoice', 'date');

        return view('accountReport.lastMonthSales')->with($data);
    }
    public function monthlySalesStandard($monthYear)
    {
        $date = Carbon::createFromFormat('Y-m-d', $monthYear);

        // Extract year and month
        $year = $date->year;
        $month = $date->month;

        $salesInvoice = DB::table('invoices')
            // ->join('products', 'invoices.product_id', '=', 'products.product_id')
            ->join('customers', 'invoices.customer_id', '=', 'customers.customer_id')
            ->whereYear('invoices.invoice_date', $year)
            ->whereMonth('invoices.invoice_date', $month)
            ->where('invoices.action_type', '!=', 'DELETE')
            ->select('invoices.*', 'customers.customer_name')
            ->orderBy('invoices.invoice_date', 'ASC')
            ->get();

        $salesInvIds = $salesInvoice->map(function ($invoice) {
            return $invoice->salesInvoice_id;
        });

        $salesInvoiceProducts = DB::table('invoice_products')
            ->join('products', 'invoice_products.product_id', '=', 'products.product_id')
            // ->join('customers', 'invoices.customer_id', '=', 'customers.customer_id')
            ->whereIn('invoice_products.salesInvoice_id', $salesInvIds)
            ->where('invoice_products.action_type', '!=', 'DELETE')
            ->select('invoice_products.*', 'products.product_name')
            ->get();


        $salesInvoiceUniqCustomers = $salesInvoice->unique('customer_id');

        $InvResults = $salesInvoiceUniqCustomers->map(function ($invUniqCust) use ($salesInvoice, $salesInvoiceProducts) {
            
            // Filter all Inv by Customer for the current customer
            $filterSalesInv = $salesInvoice->filter(function ($saleInv) use ($invUniqCust) {
                return $saleInv->customer_id == $invUniqCust->customer_id;
            });

            // Collect products for each invoice under this customer
            $products = $filterSalesInv->flatMap(function ($saleInv) use ($salesInvoiceProducts) {
                
                $productList = $salesInvoiceProducts->filter(function ($saleInvProd) use ($saleInv) {
                    return $saleInvProd->salesInvoice_id == $saleInv->salesInvoice_id;
                });
                 
                // Map over the collection of products
                return $productList->map(function ($product) use ($saleInv) {
                    return [
                        'invoiceDate' => $saleInv->invoice_date,
                        'salesInvoice_id' => $product->salesInvoice_id,
                        'productName' => $product->product_name,
                        'packing' => $product->packing,
                        'no_of_packing' => $product->no_of_packing,
                        'unit_price' => $product->unit_price,
                    ];
                });
            });

            // Return structured data for each unique customer
            return [
                'Customer' => $invUniqCust->customer_name,
                'InvProducts' => $products
            ];
        });


        $data = compact('InvResults', 'date');

        return view('accountReport.monthlySalesStandard')->with($data);
    }
    public function yearSalesStandard($monthYearForm, $monthYearTo)
    {
        $FormDate = Carbon::createFromFormat('Y-m-d', $monthYearForm);
        $ToDate = Carbon::createFromFormat('Y-m-d', $monthYearTo);


        $salesInvoice = DB::table('invoices')
                    ->join('customers', 'invoices.customer_id', '=', 'customers.customer_id')
                    ->whereBetween('invoices.invoice_date', [$FormDate, $ToDate]) // Filter between dates
                    ->where('invoices.action_type', '!=', 'DELETE')
                    ->select('invoices.*', 'customers.customer_name') 
                    ->orderBy('invoices.invoice_date', 'ASC') 
                    ->get();

        $salesInvIds = $salesInvoice->map(function ($invoice) {
            return $invoice->salesInvoice_id;
        });

        $salesInvoiceProducts = DB::table('invoice_products')
            ->join('products', 'invoice_products.product_id', '=', 'products.product_id')
            // ->join('customers', 'invoices.customer_id', '=', 'customers.customer_id')
            ->whereIn('invoice_products.salesInvoice_id', $salesInvIds)
            ->where('invoice_products.action_type', '!=', 'DELETE')
            ->select('invoice_products.*', 'products.product_name')
            ->get();


        $salesInvoiceUniqCustomers = $salesInvoice->unique('customer_id');

        $InvResults = $salesInvoiceUniqCustomers->map(function ($invUniqCust) use ($salesInvoice, $salesInvoiceProducts) {
            
            // Filter all Inv by Customer for the current customer
            $filterSalesInv = $salesInvoice->filter(function ($saleInv) use ($invUniqCust) {
                return $saleInv->customer_id == $invUniqCust->customer_id;
            });

            // Collect products for each invoice under this customer
            $products = $filterSalesInv->flatMap(function ($saleInv) use ($salesInvoiceProducts) {
                
                $productList = $salesInvoiceProducts->filter(function ($saleInvProd) use ($saleInv) {
                    return $saleInvProd->salesInvoice_id == $saleInv->salesInvoice_id;
                });
                 
                // Map over the collection of products
                return $productList->map(function ($product) use ($saleInv) {
                    return [
                        'invoiceDate' => $saleInv->invoice_date,
                        'company' => $saleInv->company,
                        'salesInvoice_id' => $product->salesInvoice_id,
                        'productName' => $product->product_name,
                        'packing' => $product->packing,
                        'no_of_packing' => $product->no_of_packing,
                        'unit_price' => $product->unit_price,
                    ];
                });
            });

            // Return structured data for each unique customer
            return [
                'Customer' => $invUniqCust->customer_name,
                'InvProducts' => $products
            ];
        });


        $data = compact('InvResults', 'FormDate', 'ToDate');

        return view('accountReport.yearSalesStandard')->with($data);
    }
}

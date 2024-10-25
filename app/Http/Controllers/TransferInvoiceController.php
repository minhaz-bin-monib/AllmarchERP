<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferInvoice;
use App\Models\TransferInvoiceProduct;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use NumberToWords\NumberToWords;

class TransferInvoiceController extends Controller
{
     // [httpGet]
     public function show()
     {
         $transferInvoices =  DB::table('transfer_invoices')
          ->join('customers', 'transfer_invoices.customer_id', '=', 'customers.customer_id')
          ->join('products', 'transfer_invoices.product_id', '=', 'products.product_id')
         ->where('transfer_invoices.action_type', '!=', 'DELETE')
         ->select('transfer_invoices.*', 'customers.customer_name', 'products.product_name')
         ->orderBy('transfer_invoices.transferInvoice_id', 'desc')
         ->get();
 
 
         $data = compact('transferInvoices');
 
         return view('invoice.transferInvoiceList')->with($data);
     }
 
     // [httpGet]
     public function create()
     {
         $transferInvoice = new TransferInvoice();
         $transferInvoice->registration_date = Carbon::now()->format('Y-m-d');
         $transferInvoice->invoice_date = Carbon::now()->format('Y-m-d');
         $transferInvoice->proforma_invoice = 'CIT-'.Carbon::now()->format('Y').'-';
         $transferInvoice->no_of_packing = 1;
         $url = url('/transferInvoice/create');
         $toptitle = 'Transfer Invoice';
         $data = compact('transferInvoice', 'url', 'toptitle');
         return view('invoice.addTransferInvoice')->with($data);
     }
 
     // [httpPost]
     public function store(Request $request)
     {
         // Validate the request outside the try-catch block so validation errors are handled by Laravel
         $request->validate(
             [
                 'registration_date' => 'required',
                 'customer_id' => 'required',
                 //'batch_id' => 'required',
                 'product_id' => 'required',
                 // 'manufacturer_id' => 'required',
                // 'batch_no' => 'required',
                // 'order_ref' => 'required',
                 'packing' => 'required',
                 'no_of_packing' => 'required',
                 'unit_price' => 'required',
                 'invoice_date' => 'required',
                 'delivery_date' => 'required',
                 'company' => 'required',
             ]
         );
 
         try {
             // Create and save the TransferInvoice
             $transferInvoice = new TransferInvoice();
 
             $transferInvoice->registration_date = $request['registration_date'];
             $transferInvoice->customer_id = $request['customer_id'];
             $transferInvoice->batch_id = $request['batch_id'];
             $transferInvoice->product_id = $request['product_id'];
             $transferInvoice->manufacturer_id = $request['manufacturer_id'];
             $transferInvoice->order_ref = $request['order_ref'];
             $transferInvoice->proforma_invoice = $request['proforma_invoice'];
             $transferInvoice->batch_no = $request['batch_no'];
             $transferInvoice->packing = $request['packing'];
             $transferInvoice->no_of_packing = $request['no_of_packing'];
             $transferInvoice->unit_price = $request['unit_price'];
             $transferInvoice->invoice_date = $request['invoice_date'];
             $transferInvoice->delivery_date = $request['delivery_date'];
             $transferInvoice->delivery_by = $request['delivery_by'];
             $transferInvoice->remark = $request['remark'];
             $transferInvoice->discount = $request['discount'];
             $transferInvoice->company = $request['company'];
             $transferInvoice->enable_discount = $request['enable_discount'];
             $transferInvoice->invoice_type = 'Statement';
             $transferInvoice->invoice_type_category = 'Transfer';
             $transferInvoice->action_type = 'INSERT';
             $transferInvoice->user_id = 'sys-user';
             $transferInvoice->action_date = now();
 
             $transferInvoice->save();
 
             // Create and save SaleInvoiceProduct 
             $transferInvoiceProduct = new TransferInvoiceProduct();
 
             $transferInvoiceProduct->registration_date = $request['registration_date'];
             $transferInvoiceProduct->transferInvoice_id = $transferInvoice->transferInvoice_id;
             $transferInvoiceProduct->batch_id = $request['batch_id'];
             $transferInvoiceProduct->product_id = $request['product_id'];
             //$transferInvoiceProduct->manufacturer_id = $request['manufacturer_id'];
             $transferInvoiceProduct->batch_no = $request['batch_no'];
             $transferInvoiceProduct->packing = $request['packing'];
             $transferInvoiceProduct->no_of_packing = $request['no_of_packing'];
             $transferInvoiceProduct->unit_price = $request['unit_price'];
             $transferInvoiceProduct->discount = $request['discount'];
             $transferInvoiceProduct->enable_discount = $request['enable_discount'];
             $transferInvoiceProduct->action_type = 'INSERT';
             $transferInvoiceProduct->user_id = 'sys-user';
             $transferInvoiceProduct->action_date = now();
 
             $transferInvoiceProduct->save();
 
             // Redirect to the edit page of the newly created invoice
             return redirect('transferInvoice/edit/' . $transferInvoice->transferInvoice_id)
                 ->with('success', 'Invoice created successfully.');
         } catch (\Exception $e) {
             // Log the exception if necessary
             \Log::error('Error creating sales invoice: ' . $e->getMessage());
 
             // Return back to the form with an error message
             return redirect()->back()->with('error', 'Failed to create the invoice. Please try again.');
         }
     }
 
 
 
 
     // [httpGet]
     public function edit($id)
     {
         $numberToWords = new NumberToWords();
         $converter = $numberToWords->getNumberTransformer('en');
 
         // $transferInvoice = TransferInvoice::find($id);
         $transferInvoice = TransferInvoice::where('transferInvoice_id', $id)
             ->where('action_type', '!=', 'DELETE')
             ->first();
 
         if (is_null($transferInvoice)) {
             // transferInvoice not found
             return redirect('/transferInvoice/list');
         } else {
             $transferInvoiceProduct = DB::table('transfer_invoice_products')
                 ->join('products', 'transfer_invoice_products.product_id', '=', 'products.product_id')
                 // ->join('customers', 'batches.customer_id', '=', 'customers.customer_id')
                 ->where('transfer_invoice_products.transferInvoice_id', '=', $transferInvoice->transferInvoice_id)
                 ->where('transfer_invoice_products.action_type', '!=', 'DELETE')
                 ->select('transfer_invoice_products.*', 'products.product_name')
                 ->get();
 
 
             $url = url('/transferInvoice/update') . "/" . $id;
             $toptitle = 'Transfer Invoice ' . $transferInvoice->transferInvoice_id;
 
             $data = compact('converter', 'transferInvoice', 'transferInvoiceProduct', 'url', 'toptitle'); // data and dynamic url pass into view
 
             return view('invoice.addTransferInvoice')->with($data);
 
         }
 
     }
 
     // [httpPost]
     public function update($id, Request $request)
     {
         $request->validate(
             [
                 'registration_date' => 'required',
                 'customer_id' => 'required',
                // 'batch_id' => 'required',
                 'product_id' => 'required',
                 // 'manufacturer_id' => 'required',
                 //'batch_no' => 'required',
                // 'order_ref' => 'required',
                 'packing' => 'required',
                 'no_of_packing' => 'required',
                 'unit_price' => 'required',
                 'invoice_date' => 'required',
                 'delivery_date' => 'required',
                 'company' => 'required',
             ]
         );
 
         try {
             $transferInvoice = TransferInvoice::where('transferInvoice_id', $id)
                 ->where('action_type', '!=', 'DELETE')
                 ->first();
             if (!is_null($transferInvoice)) {
 
                // $transferInvoice->registration_date = $request['registration_date'];
                 $transferInvoice->customer_id = $request['customer_id'];
                 $transferInvoice->batch_id = $request['batch_id'];
                 $transferInvoice->product_id = $request['product_id'];
                 $transferInvoice->manufacturer_id = $request['manufacturer_id'];
                 $transferInvoice->order_ref = $request['order_ref'];
                 $transferInvoice->proforma_invoice = $request['proforma_invoice'];
                 $transferInvoice->batch_no = $request['batch_no'];
                 $transferInvoice->packing = $request['packing'];
                 $transferInvoice->no_of_packing = $request['no_of_packing'];
                 $transferInvoice->unit_price = $request['unit_price'];
                 $transferInvoice->invoice_date = $request['invoice_date'];
                 $transferInvoice->delivery_date = $request['delivery_date'];
                 $transferInvoice->delivery_by = $request['delivery_by'];
                 $transferInvoice->remark = $request['remark'];
                 $transferInvoice->discount = $request['discount'];
                 $transferInvoice->company = $request['company'];
                 $transferInvoice->enable_discount = $request['enable_discount'];
                 $transferInvoice->invoice_type = 'Statement';
                 $transferInvoice->action_type = 'UPDATE';
                 $transferInvoice->user_id = 'sys-user';
                 $transferInvoice->action_date = now();
 
                 $transferInvoice->save();
 
                 // Create and save SaleInvoiceProduct 
                 $transferInvoiceProduct = new TransferInvoiceProduct();
 
                 $transferInvoiceProduct->registration_date = $request['registration_date'];
                 $transferInvoiceProduct->transferInvoice_id = $transferInvoice->transferInvoice_id;
                 $transferInvoiceProduct->batch_id = $request['batch_id'];
                 $transferInvoiceProduct->product_id = $request['product_id'];
                 //$transferInvoiceProduct->manufacturer_id = $request['manufacturer_id'];
                 $transferInvoiceProduct->batch_no = $request['batch_no'];
                 $transferInvoiceProduct->packing = $request['packing'];
                 $transferInvoiceProduct->no_of_packing = $request['no_of_packing'];
                 $transferInvoiceProduct->unit_price = $request['unit_price'];
                 $transferInvoiceProduct->discount = $request['discount'];
                 $transferInvoiceProduct->enable_discount = $request['enable_discount'];
                 $transferInvoiceProduct->action_type = 'INSERT';
                 $transferInvoiceProduct->user_id = 'sys-user';
                 $transferInvoiceProduct->action_date = now();
 
                 $transferInvoiceProduct->save();
             }
             // Redirect to the edit page of the newly created invoice
             return redirect('transferInvoice/edit/' . $transferInvoice->transferInvoice_id)
                 ->with('success', 'Invoice created successfully.');
         } catch (\Exception $e) {
             // Log the exception if necessary
             \Log::error('Error creating sales invoice: ' . $e->getMessage());
 
             // Return back to the form with an error message
             return redirect()->back()->with('error', 'Failed to create the invoice. Please try again.');
         }
 
     }
 
     // [httpGet]
     public function delete($id)  // Delete  Transfer Invoice by invoice Id
     {
         try {
 
             $transferInvoice = TransferInvoice::find($id);
             if (!is_null($transferInvoice)) {
                 $transferInvoice->action_type = 'DELETE';
                 $transferInvoice->action_date = now();
 
                 $transferInvoice->save();
 
                 // Update all child Invoice Producs 
                 DB::table('transfer_invoice_products')
                     ->where('transferInvoice_id', $id)
                     ->update(['action_type' => 'DELETE', 'action_date' => now()]);
 
             }
 
 
             return redirect('/transferInvoice/list');
         } catch (\Exception $e) {
             // Log the exception if necessary
             \Log::error('Error creating sales invoice: ' . $e->getMessage());
 
             // Return back to the form with an error message
             return redirect()->back()->with('error', 'Failed to deleted the invoice product. Please try again.');
         }
 
 
 
 
 
     }
     // [httpGet]
     public function invoiceProductDelete($invoiceId, $invoiceProductid)
     {
         try {
             $transferInvoiceProduct = TransferInvoiceProduct::find($invoiceProductid);
             if (!is_null($transferInvoiceProduct)) {
                 $transferInvoiceProduct->action_type = 'DELETE';
                 $transferInvoiceProduct->action_date = now();
 
                 $transferInvoiceProduct->save();
 
             }
 
             // Redirect to the edit page of the newly created invoice
             return redirect('transferInvoice/edit/' . $invoiceId)
                 ->with('success', 'Invoice product deleted successfully.');
         } catch (\Exception $e) {
             // Log the exception if necessary
             \Log::error('Error creating sales invoice: ' . $e->getMessage());
 
             // Return back to the form with an error message
             return redirect()->back()->with('error', 'Failed to deleted the invoice product. Please try again.');
         }

     }
     // [httpGet]
     public function invoiceProductStickar($invoiceId, $invoiceProductid)
     {
         /* Delete has the History table 
         //relation to maintain and all related item mark as delted as well
         
         $transferInvoice = TransferInvoice::find($id);
 
         $transferInvoice->action_type = 'DELETE';
         $transferInvoice->action_date = now();
 
         $transferInvoice->save();
         */
         return redirect('/transferInvoice/list');
     }
 
     // [httpGet]
     public function proformaInvoicePdf($transferInvoiceId)
     {
         $numberToWords = new NumberToWords();
         $converter = $numberToWords->getNumberTransformer('en');
         $options = new Options();
         $options->set('defaultFont', 'Arial');
        // $options->set('isRemoteEnabled', true); // Enable remote content
         $options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
         $dompdf = new Dompdf($options);
 
         // $transferInvoice = TransferInvoice::find($id);
         $transferInvoice = TransferInvoice::where('transferInvoice_id', $transferInvoiceId)
             ->where('action_type', '!=', 'DELETE')
             ->first();
         
         if (!is_null($transferInvoice)) {
             $transferInvoice->invoice_date = date('d-m-Y', strtotime($transferInvoice->invoice_date));
             $customer = Customer::where('customer_id', $transferInvoice->customer_id)
             ->where('action_type', '!=', 'DELETE')
             ->first();
 
   
             $transferInvoiceProduct = DB::table('transfer_invoice_products')
                 ->join('products', 'transfer_invoice_products.product_id', '=', 'products.product_id')
                 // ->join('customers', 'batches.customer_id', '=', 'customers.customer_id')
                 ->where('transfer_invoice_products.transferInvoice_id', '=', $transferInvoice->transferInvoice_id)
                 ->where('transfer_invoice_products.action_type', '!=', 'DELETE')
                 ->select('transfer_invoice_products.*', 'products.product_name','products.material_description', 'products.h_s_code')
                 ->get();
 
             $data = compact('converter', 'transferInvoice', 'transferInvoiceProduct', 'customer'); 
 
             $html = view('templateForPdf.proformaInvoice')->with($data)->render();
     
             $dompdf->loadHtml($html);
             $dompdf->setPaper('A4', 'portrait');
             $dompdf->render();
             return $dompdf->stream('proformaInvoice.pdf', ['Attachment' => false]);
         }
        
         // If pdf not gennrate then return into Invoice list
        // return redirect('/transferInvoice/list');
     }
     public function commercialInvoicePdf($transferInvoiceId)
     {/*
         $numberToWords = new NumberToWords();
         $converter = $numberToWords->getNumberTransformer('en');
         $options = new Options();
         $options->set('defaultFont', 'Arial');
        // $options->set('isRemoteEnabled', true); // Enable remote content
         $options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
         $dompdf = new Dompdf($options);
 
         // $transferInvoice = TransferInvoice::find($id);
         $transferInvoice = TransferInvoice::where('transferInvoice_id', $transferInvoiceId)
             ->where('action_type', '!=', 'DELETE')
             ->first();
         
         if (!is_null($transferInvoice)) {
             $transferInvoice->invoice_date = date('d-m-Y', strtotime($transferInvoice->invoice_date));
             $customer = Customer::where('customer_id', $transferInvoice->customer_id)
             ->where('action_type', '!=', 'DELETE')
             ->first();
 
   
             $transferInvoiceProduct = DB::table('transfer_invoice_products')
                 ->join('products', 'transfer_invoice_products.product_id', '=', 'products.product_id')
                 // ->join('customers', 'batches.customer_id', '=', 'customers.customer_id')
                 ->where('transfer_invoice_products.transferInvoice_id', '=', $transferInvoice->transferInvoice_id)
                 ->where('transfer_invoice_products.action_type', '!=', 'DELETE')
                 ->select('transfer_invoice_products.*', 'products.product_name')
                 ->get();
 
             $data = compact('converter', 'transferInvoice', 'transferInvoiceProduct', 'customer'); 
 
             $html = view('templateForPdf.salesDeliveryInvoice')->with($data)->render();
     
             $dompdf->loadHtml($html);
             $dompdf->setPaper('A4', 'portrait');
             $dompdf->render();
             return $dompdf->stream('Invoice.pdf', ['Attachment' => false]);
         }
        */
         // If pdf not gennrate then return into Invoice list
         return redirect('/transferInvoice/list');
     }

}

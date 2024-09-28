<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesInvoice;
use App\Models\SalesInvoiceProduct;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;
use NumberToWords\NumberToWords;

class SampleInvoiceController extends Controller
{
 
 /*   // [httpGet]
   public function show()
   {
       $salesInvoices = SalesInvoice::where('action_type', '!=', 'DELETE')
           ->orderBy('salesInvoice_id', 'desc')
           ->get();

       $data = compact('salesInvoices');

       return view('invoice.salesInvoiceList')->with($data);
   }
*/
   // [httpGet]
   public function create()
   {
       $salesInvoice = new SalesInvoice();
       $salesInvoice->registration_date = Carbon::now()->format('Y-m-d');
       $salesInvoice->invoice_date = Carbon::now()->format('Y-m-d');
       $salesInvoice->order_ref = "Sample";
       $salesInvoice->no_of_packing = 1;
       $url = url('/sampleInvoice/create');
       $toptitle = 'Sample Invoice';
       $data = compact('salesInvoice', 'url', 'toptitle');
       return view('invoice.addSampleInvoice')->with($data);
   }

   // [httpPost]
   public function store(Request $request)
   {
       // Validate the request outside the try-catch block so validation errors are handled by Laravel
       $request->validate(
           [
               'registration_date' => 'required',
               'customer_id' => 'required',
               'batch_id' => 'required',
               'product_id' => 'required',
               // 'manufacturer_id' => 'required',
               'batch_no' => 'required',
               'order_ref' => 'required',
               'packing' => 'required',
               'no_of_packing' => 'required',
               'unit_price' => 'required',
               'invoice_date' => 'required',
           ]
       );

       try {
           // Create and save the SalesInvoice
           $salesInvoice = new SalesInvoice();

           $salesInvoice->registration_date = $request['registration_date'];
           $salesInvoice->customer_id = $request['customer_id'];
           $salesInvoice->batch_id = $request['batch_id'];
           $salesInvoice->product_id = $request['product_id'];
           $salesInvoice->manufacturer_id = $request['manufacturer_id'];
           $salesInvoice->order_ref = $request['order_ref'];
           $salesInvoice->batch_no = $request['batch_no'];
           $salesInvoice->packing = $request['packing'];
           $salesInvoice->no_of_packing = $request['no_of_packing'];
           $salesInvoice->unit_price = $request['unit_price'];
           $salesInvoice->invoice_date = $request['invoice_date'];
           $salesInvoice->delivery_by = $request['delivery_by'];
           $salesInvoice->remark = $request['remark'];
           $salesInvoice->discount = $request['discount'];
           $salesInvoice->enable_discount = $request['enable_discount'];
           $salesInvoice->invoice_type = 'Sample';
           $salesInvoice->invoice_type_category = 'Sample';
           $salesInvoice->action_type = 'INSERT';
           $salesInvoice->user_id = 'sys-user';
           $salesInvoice->action_date = now();

           $salesInvoice->save();

           // Create and save SaleInvoiceProduct 
           $salesInvoiceProduct = new SalesInvoiceProduct();

           $salesInvoiceProduct->registration_date = $request['registration_date'];
           $salesInvoiceProduct->salesInvoice_id = $salesInvoice->salesInvoice_id;
           $salesInvoiceProduct->batch_id = $request['batch_id'];
           $salesInvoiceProduct->product_id = $request['product_id'];
           //$salesInvoiceProduct->manufacturer_id = $request['manufacturer_id'];
           $salesInvoiceProduct->batch_no = $request['batch_no'];
           $salesInvoiceProduct->packing = $request['packing'];
           $salesInvoiceProduct->no_of_packing = $request['no_of_packing'];
           $salesInvoiceProduct->unit_price = $request['unit_price'];
           $salesInvoiceProduct->discount = $request['discount'];
           $salesInvoiceProduct->enable_discount = $request['enable_discount'];
           $salesInvoiceProduct->action_type = 'INSERT';
           $salesInvoiceProduct->user_id = 'sys-user';
           $salesInvoiceProduct->action_date = now();

           $salesInvoiceProduct->save();

           // Redirect to the edit page of the newly created invoice
           return redirect('sampleInvoice/edit/' . $salesInvoice->salesInvoice_id)
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

       // $salesInvoice = SalesInvoice::find($id);
       $salesInvoice = SalesInvoice::where('salesInvoice_id', $id)
           ->where('action_type', '!=', 'DELETE')
           ->first();

       if (is_null($salesInvoice)) {
           // salesInvoice not found
           return redirect('/salesInvoice/list');
       } else {
           $salesInvoiceProduct = DB::table('invoice_products')
               ->join('products', 'invoice_products.product_id', '=', 'products.product_id')
               // ->join('customers', 'batches.customer_id', '=', 'customers.customer_id')
               ->where('invoice_products.salesInvoice_id', '=', $salesInvoice->salesInvoice_id)
               ->where('invoice_products.action_type', '!=', 'DELETE')
               ->select('invoice_products.*', 'products.product_name')
               ->get();


           $url = url('/sampleInvoice/update') . "/" . $id;
           $toptitle = 'Sample Invoice ' . $salesInvoice->salesInvoice_id;

           $data = compact('converter', 'salesInvoice', 'salesInvoiceProduct', 'url', 'toptitle'); // data and dynamic url pass into view

           return view('invoice.addSampleInvoice')->with($data);

       }

   }

   // [httpPost]
   public function update($id, Request $request)
   {
       $request->validate(
           [
               'registration_date' => 'required',
               'customer_id' => 'required',
               'batch_id' => 'required',
               'product_id' => 'required',
               // 'manufacturer_id' => 'required',
               'batch_no' => 'required',
               'order_ref' => 'required',
               'packing' => 'required',
               'no_of_packing' => 'required',
               'unit_price' => 'required',
               'invoice_date' => 'required',
           ]
       );

       try {
           $salesInvoice = SalesInvoice::where('salesInvoice_id', $id)
               ->where('action_type', '!=', 'DELETE')
               ->first();
           if (!is_null($salesInvoice)) {

              // $salesInvoice->registration_date = $request['registration_date'];
               $salesInvoice->customer_id = $request['customer_id'];
               $salesInvoice->batch_id = $request['batch_id'];
               $salesInvoice->product_id = $request['product_id'];
               $salesInvoice->manufacturer_id = $request['manufacturer_id'];
               $salesInvoice->order_ref = $request['order_ref'];
               $salesInvoice->batch_no = $request['batch_no'];
               $salesInvoice->packing = $request['packing'];
               $salesInvoice->no_of_packing = $request['no_of_packing'];
               $salesInvoice->unit_price = $request['unit_price'];
               $salesInvoice->invoice_date = $request['invoice_date'];
               $salesInvoice->delivery_by = $request['delivery_by'];
               $salesInvoice->remark = $request['remark'];
               $salesInvoice->discount = $request['discount'];
               $salesInvoice->enable_discount = $request['enable_discount'];
               $salesInvoice->invoice_type = 'Sample';
               $salesInvoice->action_type = 'UPDATE';
               $salesInvoice->user_id = 'sys-user';
               $salesInvoice->action_date = now();

               $salesInvoice->save();

               // Create and save SaleInvoiceProduct 
               $salesInvoiceProduct = new SalesInvoiceProduct();

               $salesInvoiceProduct->registration_date = $request['registration_date'];
               $salesInvoiceProduct->salesInvoice_id = $salesInvoice->salesInvoice_id;
               $salesInvoiceProduct->batch_id = $request['batch_id'];
               $salesInvoiceProduct->product_id = $request['product_id'];
               //$salesInvoiceProduct->manufacturer_id = $request['manufacturer_id'];
               $salesInvoiceProduct->batch_no = $request['batch_no'];
               $salesInvoiceProduct->packing = $request['packing'];
               $salesInvoiceProduct->no_of_packing = $request['no_of_packing'];
               $salesInvoiceProduct->unit_price = $request['unit_price'];
               $salesInvoiceProduct->discount = $request['discount'];
               $salesInvoiceProduct->enable_discount = $request['enable_discount'];
               $salesInvoiceProduct->action_type = 'INSERT';
               $salesInvoiceProduct->user_id = 'sys-user';
               $salesInvoiceProduct->action_date = now();

               $salesInvoiceProduct->save();
           }
           // Redirect to the edit page of the newly created invoice
           return redirect('sampleInvoice/edit/' . $salesInvoice->salesInvoice_id)
               ->with('success', 'Invoice created successfully.');
       } catch (\Exception $e) {
           // Log the exception if necessary
           \Log::error('Error creating sales invoice: ' . $e->getMessage());

           // Return back to the form with an error message
           return redirect()->back()->with('error', 'Failed to create the invoice. Please try again.');
       }

   }

   /*
   // [httpGet]
   public function delete($id)  // Delete  Sales Invoice by invoice Id
   {
       try {

           $salesInvoice = SalesInvoice::find($id);
           if (!is_null($salesInvoice)) {
               $salesInvoice->action_type = 'DELETE';
               $salesInvoice->action_date = now();

               $salesInvoice->save();

               // Update all child Invoice Producs 
               DB::table('invoice_products')
                   ->where('salesInvoice_id', $id)
                   ->update(['action_type' => 'DELETE', 'action_date' => now()]);

           }


           return redirect('/salesInvoice/list');
       } catch (\Exception $e) {
           // Log the exception if necessary
           \Log::error('Error creating sales invoice: ' . $e->getMessage());

           // Return back to the form with an error message
           return redirect()->back()->with('error', 'Failed to deleted the invoice product. Please try again.');
       }
   
   }
*/

   // [httpGet]
   public function invoiceProductDelete($invoiceId, $invoiceProductid)
   {
       try {
           $salesInvoiceProduct = SalesInvoiceProduct::find($invoiceProductid);
           if (!is_null($salesInvoiceProduct)) {
               $salesInvoiceProduct->action_type = 'DELETE';
               $salesInvoiceProduct->action_date = now();

               $salesInvoiceProduct->save();

           }

           // Redirect to the edit page of the newly created invoice
           return redirect('sampleInvoice/edit/' . $invoiceId)
               ->with('success', 'Invoice product deleted successfully.');
       } catch (\Exception $e) {
           // Log the exception if necessary
           \Log::error('Error creating sales invoice: ' . $e->getMessage());

           // Return back to the form with an error message
           return redirect()->back()->with('error', 'Failed to deleted the invoice product. Please try again.');
       }


      // return redirect('/sampleInvoice/list');
   }
   // [httpGet]
   public function invoiceProductStickar($invoiceId, $invoiceProductid)
   {
       /* Delete has the History table 
       //relation to maintain and all related item mark as delted as well
       
       $salesInvoice = SalesInvoice::find($id);

       $salesInvoice->action_type = 'DELETE';
       $salesInvoice->action_date = now();

       $salesInvoice->save();
       */
       return redirect('/salesInvoice/list');
   }

   // [httpGet]
   public function sampleCustomerInvoicePdf($salesInvoiceId)
   {
    
       $numberToWords = new NumberToWords();
       $converter = $numberToWords->getNumberTransformer('en');
       $options = new Options();
       $options->set('defaultFont', 'Arial');
      // $options->set('isRemoteEnabled', true); // Enable remote content
       $options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
       $dompdf = new Dompdf($options);

       // $salesInvoice = SalesInvoice::find($id);
       $salesInvoice = SalesInvoice::where('salesInvoice_id', $salesInvoiceId)
           ->where('action_type', '!=', 'DELETE')
           ->first();
       
       if (!is_null($salesInvoice)) {
           $salesInvoice->invoice_date = date('d-m-Y', strtotime($salesInvoice->invoice_date));
           $customer = Customer::where('customer_id', $salesInvoice->customer_id)
           ->where('action_type', '!=', 'DELETE')
           ->first();

 
           $salesInvoiceProduct = DB::table('invoice_products')
               ->join('products', 'invoice_products.product_id', '=', 'products.product_id')
               // ->join('customers', 'batches.customer_id', '=', 'customers.customer_id')
               ->where('invoice_products.salesInvoice_id', '=', $salesInvoice->salesInvoice_id)
               ->where('invoice_products.action_type', '!=', 'DELETE')
               ->select('invoice_products.*', 'products.product_name')
               ->get();

           $data = compact('converter', 'salesInvoice', 'salesInvoiceProduct', 'customer'); 

           $html = view('templateForPdf.sampleCustomerInvoice')->with($data)->render();
   
           $dompdf->loadHtml($html);
           $dompdf->setPaper('A4', 'portrait');
           $dompdf->render();
           return $dompdf->stream('Invoice.pdf', ['Attachment' => false]);
       }
    
       // If pdf not gennrate then return into Invoice list
       return redirect('/salesInvoice/list');
   }
   public function sampleDeliveryInvoicePdf($salesInvoiceId)
   {
     
       $numberToWords = new NumberToWords();
       $converter = $numberToWords->getNumberTransformer('en');
       $options = new Options();
       $options->set('defaultFont', 'Arial');
      // $options->set('isRemoteEnabled', true); // Enable remote content
       $options->set('isHtml5ParserEnabled', true); // Enable HTML5 support
       $dompdf = new Dompdf($options);

       // $salesInvoice = SalesInvoice::find($id);
       $salesInvoice = SalesInvoice::where('salesInvoice_id', $salesInvoiceId)
           ->where('action_type', '!=', 'DELETE')
           ->first();
       
       if (!is_null($salesInvoice)) {
           $salesInvoice->invoice_date = date('d-m-Y', strtotime($salesInvoice->invoice_date));
           $customer = Customer::where('customer_id', $salesInvoice->customer_id)
           ->where('action_type', '!=', 'DELETE')
           ->first();

 
           $salesInvoiceProduct = DB::table('invoice_products')
               ->join('products', 'invoice_products.product_id', '=', 'products.product_id')
               // ->join('customers', 'batches.customer_id', '=', 'customers.customer_id')
               ->where('invoice_products.salesInvoice_id', '=', $salesInvoice->salesInvoice_id)
               ->where('invoice_products.action_type', '!=', 'DELETE')
               ->select('invoice_products.*', 'products.product_name')
               ->get();

           $data = compact('converter', 'salesInvoice', 'salesInvoiceProduct', 'customer'); 

           $html = view('templateForPdf.sampleDeliveryInvoice')->with($data)->render();
   
           $dompdf->loadHtml($html);
           $dompdf->setPaper('A4', 'portrait');
           $dompdf->render();
           return $dompdf->stream('Invoice.pdf', ['Attachment' => false]);
       }
        
       // If pdf not gennrate then return into Invoice list
       return redirect('/salesInvoice/list');
   }
}

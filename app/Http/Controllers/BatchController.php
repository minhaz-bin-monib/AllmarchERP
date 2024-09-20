<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{

    // [httpGet]
    public function show()
    {
        // $batchs = Batch::where('action_type', '!=', 'DELETE')
        //                     ->orderBy('batch_id', 'desc')
        //                     ->get();
        $batchs = DB::table('batches')
            ->join('products', 'batches.product_id', '=', 'products.product_id')
            ->join('customers', 'batches.customer_id', '=', 'customers.customer_id')
            ->select('batches.*', 'products.product_name', 'customers.customer_name')
            ->get();
        $data = compact('batchs');

        return view('batch.batchlist')->with($data);
    }
    public function getBatchByProductId($id)
    {
        $batchs = Batch::where('action_type', '!=', 'DELETE')
                        ->where('product_id', $id)
                        ->get();
       
        return response()->json($batchs);
    }
    public function getBatchByCustomerAndProductId($cid, $pid)
    {
        $batchs = Batch::where('action_type', '!=', 'DELETE')
                        ->where('customer_id', $cid)
                        ->where('product_id', $pid)
                        ->get();
       
        return response()->json($batchs);
    }

    // [httpGet]
    public function create()
    {
        $batch = new Batch();
        $batch->registration_date = Carbon::now()->format('Y-m-d');
        $batch->remark = 'N/A';
        $batch->production_date = Carbon::now()->format('Y-m-d');
        $productionDate = Carbon::parse($batch->production_date);
        $expireDate = $productionDate->addYears(2);
        $batch->expire_date = $expireDate->format('Y-m-d');
        $url = url('/batch/create');
        $toptitle = 'Add Batch';
        $data = compact('batch', 'url', 'toptitle');
        return view('batch.addbatch')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'registration_date' => 'required',
                'production_date' => 'required',
                'expire_date' => 'required',
                'product_id' => 'required',
                'customer_id' => 'required',
                'batch_title' => 'required',
                'batch_no' => 'required'
            ]
        );

        $batch = new Batch();

        $batch->registration_date = $request['registration_date'];
        $batch->production_date = $request['production_date'];
        $batch->expire_date = $request['expire_date'];
        $batch->product_id = $request['product_id'];
        $batch->customer_id = $request['customer_id'];
        $batch->batch_title = $request['batch_title'];
        $batch->batch_no = $request['batch_no'];
        $batch->batch_packing = $request['batch_packing'];
        $batch->remark = $request['remark'];
        $batch->import_info = $request['import_info'];
        $batch->action_type = 'INSERT';
        $batch->user_id = 'sys-user';
        $batch->action_date = now();

        $batch->save();

        return redirect('/batch/list');
    }
    /*

    // [httpGet]
    public function delete($id)
    {
        $batch = Batch::find($id);
        
        $batch->action_type = 'DELETE';
        $batch->action_date = now();

        $batch->save();

        return redirect('/batch/list');
    }

    // [httpGet]
    public function edit($id)
    {
        $batch = Batch::find($id);

        if(is_null($batch))
        {
            // batch not found
            return redirect('/batch/list');
        }
        else{
            $url = url('/batch/update') ."/". $id;
            $toptitle = 'Edit Batch';

            $data = compact('batch', 'url', 'toptitle'); // data and dynamic url pass into view
            
            return view('batch.addbatch')->with($data);;
         
        }

    }

    // [httpPost]
    public function update($id, Request $request)
    {
        
        $request->validate(
            [
                'registration_date' => 'required',
                'batch_name' => 'required'
            ]
        );

        $batch = Batch::find($id);

       $batch->registration_date = $request['registration_date'];
        $batch->production_date = $request['production_date'];
        $batch->expire_date = $request['expire_date'];
        $batch->product_name = $request['product_name'];
        $batch->customer_name = $request['customer_name'];
        $batch->batch_title = $request['batch_title'];
        $batch->batch_no = $request['batch_no'];
        $batch->batch_packing = $request['batch_packing'];
        $batch->remark = $request['remark'];
        $batch->import_info = $request['import_info'];
        $batch->action_type = 'UPDATE';
        $batch->user_id = 'sys-user';
        $batch->action_date = now();

        $batch->save();
        
        return redirect('/batch/list');

    }
    */
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
class AccountReportController extends Controller
{
    public function lastMonthSales()
    {
        $products = Product::where('action_type', '!=', 'DELETE')
                            ->orderBy('product_id', 'desc')
                            ->get();
        
        $data = compact('products');

        return view('accountReport.lastMonthSales')->with($data);
    }
}

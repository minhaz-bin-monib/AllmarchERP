<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OpenningExpanse;
use Illuminate\Support\Facades\DB;
class AccountDailyController extends Controller
{
  // Get 
  // [httpGet]
  public function dailyExpanse()
  {


    $oppenningExpanse = OpenningExpanse::where('action_type', '!=', 'DELETE')->first();
    
    $isNewDailyExpanse = true;
    $openingDate =  Carbon::now()->format('Y-m-d');
    if ($oppenningExpanse) { 
      if($oppenningExpanse->closing_status == 1)
      {
        $isNewDailyExpanse = false; // openning done wait for closing
        $openingDate = Carbon::parse($oppenningExpanse->opening_date)->format('Y-m-d');
      }
    } 
    $urlOpeningDailyExpanse = url('/accountDaily/openingDailyExpanse');
    $urlAddOpeningDailyDebit = url('/accountDaily/addOpeningDailyDebit');
    $urlAddOpeningDailyCredit = url('/accountDaily/addOpeningDailyCredit');
    $urlClosingDailyExpanse = url('/accountDaily/closingDailyExpanse');
    $toptitle = 'Daily Expanse';
    $data = compact( 
      'oppenningExpanse',
      'isNewDailyExpanse',
      'urlOpeningDailyExpanse',
      'urlAddOpeningDailyDebit',
      'urlAddOpeningDailyCredit',
      'urlClosingDailyExpanse',
      'toptitle',
      'openingDate' 
    );


    return view('accountDaily.dailyExpanse')->with($data);
  }
  public function dailyExpanseList()
  {
    /*  
    //  $product = new Product(); 
      //$product->registration_date = Carbon::now()->format('Y-m-d');
      $url = url('/product/create');
      $toptitle = 'Add Product';
      $data = compact('url', 'toptitle');
     
     
     return view('accountDaily.dailyExpanse')->with($data);
     */
    return "Expanse List DO";
  }
  public function openingDailyExpanse($date)
  {
    $date1 = Carbon::parse($date);
    $openningExpanse = OpenningExpanse::where('action_type', '!=', 'DELETE')->first();
    if($openningExpanse)
    {
      // last daily exppanse date compare 
      if($openningExpanse->closing_status == 0 && $date1->lt( Carbon::parse($openningExpanse->opening_date)))
      {
        $errorMessage = 'The new date must be greater than the previous opening date (' . Carbon::parse($openningExpanse->opening_date)->format('d-m-Y') . ').';
        return redirect('/accountDaily/expanse')->with('errorOfOpenningExpanse' , $errorMessage);
      }

    }else{

      $openningExpanse = new OpenningExpanse();
    }
    
    
    $openningExpanse->opening_date = $date;
    $openningExpanse->closing_status = 1;   // Open
    $openningExpanse->action_type = 'INSERT';
    $openningExpanse->user_id = 'sys-user';
    $openningExpanse->action_date = now();

    $openningExpanse->save();

    return redirect('/accountDaily/expanse');
  }
  public function closingDailyExpanse()
  {
      DB::beginTransaction(); 
  
      try {
          // Pass all data from the OpenningExpanse table to the ClosingExpanse table
         /*  $openningData = OpenningExpanse::all();
  
          foreach ($openningData as $data) {
              ClosingExpanse::create([
                  'column1' => $data->column1, // Replace with actual column names
                  'column2' => $data->column2,
                  // Add other columns here
              ]);
          }
          */
          // Delete all data from the OpenningExpanse table
         // OpenningExpanse::truncate();
         $openningExpanse = OpenningExpanse::where('action_type', '!=', 'DELETE')->first();
         $openningExpanse->closing_status = 0;   // Close 
         $openningExpanse->save();

          DB::commit(); 
      } catch (\Exception $e) {
          DB::rollBack(); 
          \Log::error('Transaction failed: ' . $e->getMessage());
          return redirect('/accountDaily/expanseList')->withErrors('An error occurred. Please try again.');
      }
  
      return redirect('/accountDaily/expanseList')->with('success', 'Daily expanse closed successfully.');
  }
}

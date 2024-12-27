<?php

namespace App\Http\Controllers;

use App\Models\OpenningDailyCreditDetailsExpanse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OpenningExpanse;
use App\Models\OpenningDailyCashBlance;
use App\Models\OpenningDailyDebitExpanse;
use App\Models\OpenningDailyCredit;
use App\Models\DailyCreditCategory;
use Illuminate\Support\Facades\DB;
class AccountDailyController extends Controller
{
  // Get 
  // [httpGet]
  public function dailyExpanse()
  {


    $oppenningExpanse = OpenningExpanse::where('action_type', '!=', 'DELETE')->first();

    $isNewDailyExpanse = true;
    $openingDate = Carbon::now()->format('Y-m-d');
    if ($oppenningExpanse) {
      if ($oppenningExpanse->closing_status == 1) {
        $isNewDailyExpanse = false; // openning done wait for closing
        $openingDate = Carbon::parse($oppenningExpanse->opening_date)->format('Y-m-d');
      }
    }
    $openningDebit = new OpenningDailyDebitExpanse();
    $openningCredit = new OpenningDailyDebitExpanse();

    $openingCeditCategoryDDL = OpenningDailyCredit::where('action_type', '!=', 'DELETE')
                                                  ->orderBy('openning_daily_credits_id')
                                                  ->get();

    $openingDebitList = OpenningDailyDebitExpanse::where('action_type', '!=', 'DELETE')
                                                   ->orderBy('openning_daily_debit_expanses_id')
                                                   ->get();
    $openingCreditDetailsList =  OpenningDailyCreditDetailsExpanse::where('action_type', '!=', 'DELETE')
                                      ->where('openning_expanses_id', $oppenningExpanse->openning_expanses_id)
                                      ->get();


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
      'openingDate',
      'openningDebit',
      'openningCredit',
      'openingCeditCategoryDDL',
      'openingDebitList',
      'openingCreditDetailsList'  
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
    if ($openningExpanse) {
      // last daily exppanse date compare 
      if ($openningExpanse->closing_status == 0 && $date1->lt(Carbon::parse($openningExpanse->opening_date))) {
        $errorMessage = 'The new date must be greater than the previous opening date (' . Carbon::parse($openningExpanse->opening_date)->format('d-m-Y') . ').';
        return redirect('/accountDaily/expanse')->with('errorOfOpenningExpanse', $errorMessage);
      }

    } else {

      $openningExpanse = new OpenningExpanse();
    }

    DB::beginTransaction();
    try {
      $openningExpanse->opening_date = $date;
      $openningExpanse->closing_status = 1;   // Open
      $openningExpanse->action_type = 'INSERT';
      $openningExpanse->user_id = 'sys-user';
      $openningExpanse->action_date = now();

      $openningExpanse->save();

      // All rows from OpenningDailyCashBlance Insert into OpenningDailyDebitExpanse

      $opeeingCashBlance = OpenningDailyCashBlance::where('action_type', '!=', 'DELETE')
        ->orderBy('openning_daily_cash_balance_id')
        ->get();

      foreach ($opeeingCashBlance as $cashBlance) {

        $openningDailyDebitExpanse = new OpenningDailyDebitExpanse();

        $openningDailyDebitExpanse->blance_type = $cashBlance->cash_blance_type;
        $openningDailyDebitExpanse->debit_name = $cashBlance->cush_blance_type_name;
        $openningDailyDebitExpanse->debit_blance = $cashBlance->current_cash_blance;
        $openningDailyDebitExpanse->debit_date = $openningExpanse->opening_date;
        $openningDailyDebitExpanse->openning_expanses_id = $openningExpanse->openning_expanses_id;
        $openningDailyDebitExpanse->action_type = 'INSERT';
        $openningDailyDebitExpanse->action_date = now();

        $openningDailyDebitExpanse->save();
      }
      // All rows from DailyCreditCategory Insert into OpenningDailyCredit
      // TODO
      $dailyCreditCategory = DailyCreditCategory::where('action_type', '!=', 'DELETE')
        ->orderBy('sort_order')
        ->get();

      foreach ($dailyCreditCategory as $creditCategory) {

        $openningDailyCredit = new OpenningDailyCredit();

        $openningDailyCredit->credit_category_name = $creditCategory->credit_category_name;
        $openningDailyCredit->credit_category_id = $creditCategory->daily_credit_category_id;
        $openningDailyCredit->openning_expanses_id = $openningExpanse->openning_expanses_id;
        $openningDailyCredit->action_type = 'INSERT';
        $openningDailyCredit->action_date = now();

        $openningDailyCredit->save();
      }
      DB::commit();
      return redirect('/accountDaily/expanse');


    } catch (\Exception $e) {
      DB::rollBack();
      \Log::error('Transaction failed: ' . $e->getMessage());
      return redirect('/accountDaily/expanseList')->withErrors('An error occurred. Please try again.');
    }


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


      // Delete all data from  table
      OpenningDailyCredit::truncate();
      OpenningDailyDebitExpanse::truncate();

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

  public function addOpeningDailyDebit(Request $request)
  {
    $request->validate(
      [
        'debit_name' => 'required',
        'debit_blance' => 'required'
      ]
    );
    DB::beginTransaction();

    try {
      $openningExpanse = OpenningExpanse::where('action_type', '!=', 'DELETE')->first();
      $debit = new OpenningDailyDebitExpanse();

      $debit->blance_type = 22;
      $debit->debit_name = $request['debit_name'];
      $debit->debit_blance = $request['debit_blance'];
      $debit->debit_date = $openningExpanse->opening_date;
      $debit->openning_expanses_id = $openningExpanse->openning_expanses_id;
      $debit->action_type = 'INSERT';
      $debit->user_id = 'sys-user';
      $debit->action_date = now();

      $debit->save();
      DB::commit();
      return redirect('accountDaily/expanse');
    } catch (\Exception $e) {
      DB::rollBack();
      \Log::error('Transaction failed: ' . $e->getMessage());
      return redirect('accountDaily/expanse');
    }

  }
  public function addOpeningDailyCredit(Request $request)
  {
    $request->validate(
      [
        'openning_daily_credits_id' => 'required',
        'credit_name' => 'required',
        'credit_blance' => 'required'
      ]
    );
    DB::beginTransaction();

    try {
      $openningExpanse = OpenningExpanse::where('action_type', '!=', 'DELETE')->first();
     
      $credit = new OpenningDailyCreditDetailsExpanse();

      $credit->openning_daily_credits_id = $request['openning_daily_credits_id'];
      $credit->credit_category_id = $request['openning_daily_credits_id'];
      $credit->credit_name = $request['credit_name'];
      $credit->credit_blance = $request['credit_blance'];
      $credit->credit_date = $openningExpanse->opening_date;
      $credit->openning_expanses_id = $openningExpanse->openning_expanses_id;
      $credit->action_type = 'INSERT';
      $credit->user_id = 'sys-user';
      $credit->action_date = now();

      $credit->save();
     
      DB::commit();
      return redirect('accountDaily/expanse');
    } catch (\Exception $e) {
      DB::rollBack();
      \Log::error('Transaction failed: ' . $e->getMessage());
      return redirect('accountDaily/expanse');
    }
   

  }
}

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
use App\Models\ClosingDailyExpanse;
use App\Models\ClosingDailyDebitExpanse;
use App\Models\ClosingDailyCredit;
use App\Models\ClosingDailyCreditDetailsExpanse;
use App\Models\ClosingDailyCashBlanceHistory;
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
                                    //  ->where('openning_expanses_id', $oppenningExpanse->openning_expanses_id)
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
      $totalCreditBlance = 0;
      $totalDebitBlance = 0;
      
      $closingExpanse = new ClosingDailyExpanse();
      $closingExpanse->save();

      // Openning Dabit to ClosingDaily Debit table pass 
      $openningDailyDebit = OpenningDailyDebitExpanse::where('action_type', '!=', 'DELETE')->get();

      foreach ($openningDailyDebit as $debit) {

       $closeDailyDebit =  new ClosingDailyDebitExpanse();
        
       $totalDebitBlance += $debit->debit_blance;
        
       $closeDailyDebit->blance_type = $debit->blance_type;
       $closeDailyDebit->debit_blance = $debit->debit_blance;
       $closeDailyDebit->debit_name = $debit->debit_name;
       $closeDailyDebit->debit_date = $debit->debit_date;
       $closeDailyDebit->closing_daily_expense_id = $closingExpanse->closing_daily_expense_id;
       $closeDailyDebit->action_type = 'INSERT';
       $closeDailyDebit->user_id = "sys-user";
       $closeDailyDebit->action_date = now();

       $closeDailyDebit->save();

      }

       // Openning Credit to ClosingDaily Credit table pass
       $openningDailyCredit = OpenningDailyCredit::where('action_type', '!=', 'DELETE')->get();

       foreach ($openningDailyCredit as $credit) {

         $closeCredit =  new ClosingDailyCredit();

         $closeCredit->credit_category_id = $credit->credit_category_id;
         $closeCredit->credit_category_name = $credit->credit_category_name;
         $closeCredit->closing_daily_expense_id = $closingExpanse->closing_daily_expense_id;
         $closeCredit->action_type = 'INSERT';
         $closeCredit->user_id = "sys-user";
         $closeCredit->action_date = now();

         $closeCredit->save();
        
         $creditDetails = OpenningDailyCreditDetailsExpanse::where('action_type', '!=', 'DELETE')
          ->where('openning_expanses_id', $credit->openning_expanses_id)  
          ->get();
        
          foreach ($creditDetails as $crdDetail) {

            $closeCreditDetails = new ClosingDailyCreditDetailsExpanse();

            $closeCreditDetails->closing_daily_credit_id = $credit->closing_daily_credit_id;
            $closeCreditDetails->credit_category_id = $crdDetail->credit_category_id;
            $closeCreditDetails->credit_name = $crdDetail->credit_name;
            $closeCreditDetails->credit_blance = $crdDetail->credit_blance;
            $closeCreditDetails->credit_date = $crdDetail->credit_date;
            $closeCreditDetails->closing_daily_expense_id = $closingExpanse->closing_daily_expense_id;
            $closeCreditDetails->action_type = 'INSERT';
            $closeCreditDetails->user_id = "sys-user";
            $closeCreditDetails->action_date = now();

            $closeCreditDetails->save();

            $totalCreditBlance += $crdDetail->credit_blance;
          }
  

       }
     
      // Update OpenningExpanse table
      $openningExpanse = OpenningExpanse::where('action_type', '!=', 'DELETE')->first();
      $openningExpanse->closing_status = 0;   // Close 
      $openningExpanse->save();

      // Update ClosingDailyExpanse table 
      $closingExpanse =  ClosingDailyExpanse::where('action_type', '!=', 'DELETE')
                      ->where('closing_daily_expanses_id', $closingExpanse->closing_daily_expanses_id)
                      ->get();
                      
       $opnCashBlance  = OpenningDailyCashBlance::where('action_type', '!=', 'DELETE')
                        ->where('cash_blance_type', '=', 1)     
                        ->get();

      // update Close Expanse table
      $closingExpanse->openning_date = $openningExpanse->opening_date;
      $closingExpanse->closing_blance = now();
      $closingExpanse->openning_blance = $opnCashBlance->current_cash_blance;
      $closingExpanse->closing_blance = ($totalCreditBlance - $totalDebitBlance);
      $closingExpanse->total_debit_blance = $totalDebitBlance;
      $closingExpanse->total_credit_blance = $totalCreditBlance;
      $closingExpanse->action_type = 'INSERT';
      $closingExpanse->action_date = now();
      $closingExpanse->user_id = 'sys-user';

      $closingExpanse->save();

      // Update CashBlance table
      $opnCashBlance->previous_cash_blance = $opnCashBlance->current_cash_blance;
      $opnCashBlance->current_cash_blance = ($totalCreditBlance - $totalDebitBlance);
      $opnCashBlance->previous_Update_date =$opnCashBlance->current_Update_date;
      $opnCashBlance->current_Update_date = now();

      $opnCashBlance->save();

       // Delete all data from  table
       OpenningDailyDebitExpanse::truncate();
       OpenningDailyCredit::truncate();
       OpenningDailyCreditDetailsExpanse::truncate();
 

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

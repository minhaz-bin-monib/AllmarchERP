<?php

namespace App\Http\Controllers;

use App\Models\ClosingMonthlyAccount;
use App\Models\OpeningMonthlyAccount;
use Illuminate\Http\Request;
use App\Models\OpeningMonthly;
use App\Models\OpenningMonthlyAcountsExpanse;
use App\Models\MontlyCategory;
use App\Models\ClosingMonthly;
use App\Models\ClosingDailyExpanse;
use App\Models\ClosingDailyDebitExpanse;
use App\Models\ClosingDailyCreditDetailsExpanse;
use App\Models\ClosingMonthlyAcountsExpanse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AccountMontlyController extends Controller
{
    //[HttpGet]
    public function openingMonthlyView()
    {
        $isNewDailyExpanse = true;
        $openingDate = Carbon::now()->format('Y-m-d');
        $openningMontly = new OpeningMonthly();
        $openningMontly = OpeningMonthly::where('action_type', '!=', 'DELETE')->first();
        $accountMontly = new OpeningMonthlyAccount();
        $accountMontlyList = [];

        if ($openningMontly) {
            if ($openningMontly->closing_status == 1) {
                $accountMontlyList = DB::table('opening_monthly_accounts')
                    ->join('montly_acounts', 'opening_monthly_accounts.montly_acounts_id', '=', 'montly_acounts.montly_acounts_id')
                    ->where('opening_monthly_accounts.action_type', '!=', 'DELETE')
                    ->select('opening_monthly_accounts.*', 'montly_acounts.acount_name')
                    ->get();

                $isNewDailyExpanse = false; // openning done wait for closing
                $openingDate = Carbon::parse($openningMontly->opening_date)->format('Y-m-d');
            }
        }
        $toptitle = 'Monthly Openning';
        $urlOpeningMonthlyAccount = url('/accountMonthly/openingMontlyAccount');
        $urlAddOpeningMonthlySave = '';
        $data = compact(
            'openningMontly',
            'accountMontly',
            'accountMontlyList',
            'toptitle',
            'openingDate',
            'isNewDailyExpanse',
            'urlOpeningMonthlyAccount',
            'urlAddOpeningMonthlySave'
        );

        return view('accountMonthly.openningMonthly')->with($data);
    }
    public function openingMonthlyEdit($opening_monthly_account_id)
    {
        $isNewDailyExpanse = true;
        $openingDate = Carbon::now()->format('Y-m-d');
        $openningMontly = new OpeningMonthly();
        $openningMontly = OpeningMonthly::where('action_type', '!=', 'DELETE')->first();
        $accountMontly = new OpeningMonthlyAccount();
        $accountMontlyList = [];

        if ($openningMontly) {
            if ($openningMontly->closing_status == 1) {
                $accountMontlyList = DB::table('opening_monthly_accounts')
                    ->join('montly_acounts', 'opening_monthly_accounts.montly_acounts_id', '=', 'montly_acounts.montly_acounts_id')
                    ->where('opening_monthly_accounts.action_type', '!=', 'DELETE')
                    ->select('opening_monthly_accounts.*', 'montly_acounts.acount_name')
                    ->get();

                $isNewDailyExpanse = false; // openning done wait for closing
                $openingDate = Carbon::parse($openningMontly->opening_date)->format('Y-m-d');

                $accountMontly = DB::table('opening_monthly_accounts')
                    ->join('montly_acounts', 'opening_monthly_accounts.montly_acounts_id', '=', 'montly_acounts.montly_acounts_id')
                    ->where('opening_monthly_accounts.action_type', '!=', 'DELETE')
                    ->where('opening_monthly_accounts.opening_monthly_account_id', '=', $opening_monthly_account_id)
                    ->select('opening_monthly_accounts.*', 'montly_acounts.acount_name')
                    ->first();

            }
        }
        $toptitle = 'Monthly Openning';
        $urlOpeningMonthlyAccount = url('/accountMonthly/openingMontlyAccount');
        $urlAddOpeningMonthlySave = url('/accountMonthly/openingMonthlyEditSave/' . $opening_monthly_account_id);
        $data = compact(
            'openningMontly',
            'accountMontly',
            'accountMontlyList',
            'toptitle',
            'openingDate',
            'isNewDailyExpanse',
            'urlOpeningMonthlyAccount',
            'urlAddOpeningMonthlySave'
        );

        return view('accountMonthly.openningMonthly')->with($data);
    }

    public function openingMonthlyEditSave($opening_monthly_account_id, Request $request)
    {

        $request->validate(
            [
                'company_name' => 'required',
                'opening_amount' => 'required'
            ]
        );

        $product = OpeningMonthlyAccount::find($opening_monthly_account_id);

        //$product->registration_date = $request['registration_date'];  
        $product->company_name = $request['company_name'];
        $product->opening_amount = $request['opening_amount'];
        $product->action_type = 'UPDATE';
        $product->user_id = 'sys-user';
        $product->action_date = now();

        $product->save();

        return redirect('/accountMonthly/openingMonthlyView');

    }

    public function openingMonthlyCreate($openning_date)
    {

        $date1 = Carbon::parse($openning_date)->startOfMonth();
        $openningMonthlyExpanse = OpeningMonthly::where('action_type', '!=', 'DELETE')->first();
        if ($openningMonthlyExpanse) {
            // last daily exppanse date compare 
            if ($openningMonthlyExpanse->closing_status == 0) {
                $previousOpeningDate = Carbon::parse($openningMonthlyExpanse->opening_date);

                // Compare year and month only
                if (
                    $date1->year < $previousOpeningDate->year ||
                    ($date1->year == $previousOpeningDate->year && $date1->month <= $previousOpeningDate->month)
                ) {

                    $errorMessage = 'The new month must be greater than the previous opening Month (' . $previousOpeningDate->format('F Y') . ').';
                    return redirect('/accountMonthly/openingMonthlyView')->with('errorOfOpenningExpanse', $errorMessage);
                }
            }


        } else {

            $openningMonthlyExpanse = new OpeningMonthly();
        }

        DB::beginTransaction();
        try {
            $openningMonthlyExpanse->opening_date = $date1;
            $openningMonthlyExpanse->closing_status = 1;   // Open
            $openningMonthlyExpanse->action_type = 'INSERT';
            $openningMonthlyExpanse->user_id = 'sys-user';
            $openningMonthlyExpanse->action_date = now();

            $openningMonthlyExpanse->save();

            $openningMonthlyAccountList = OpeningMonthlyAccount::where('action_type', '!=', 'DELETE')->get();
            if ($openningMonthlyAccountList->isNotEmpty()) {
                foreach ($openningMonthlyAccountList as $openningAccount) {

                    // Update the open_date field only
                    $openningAccount->opening_date = $date1; // Example date

                    // Save the updated record
                    $openningAccount->save();
                }
            } else {
                // All Account save as fresh copy (Manulally Db Update)
            }

            DB::commit();
            return redirect('/accountMonthly/openingMonthlyView');


        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Transaction failed: ' . $e->getMessage());
            return redirect('/accountMonthly/expanseList/' . now())->withErrors('An error occurred. Please try again.');
        }


    }

    public function addMonthlyExpanse($accountNoId)
    {
        // first monthly 1 and accountNo which variable 
        $isNewDailyExpanse = true;
        $openingDate = '';
        $openningMontly = new OpeningMonthly();
        $openningMontly = OpeningMonthly::where('action_type', '!=', 'DELETE')->first();
        $openningAccountMontly = null;
        $accountMontlyList = [];
        $selectedAccountMonthlyCostList = [];
        $monthlyExpanseCategoryList = [];
        $accountMontlyExpanse = new OpenningMonthlyAcountsExpanse();

        if ($openningMontly) {
            if ($openningMontly->closing_status == 1) {
                $accountMontlyList = DB::table('opening_monthly_accounts')
                    ->join('montly_acounts', 'opening_monthly_accounts.montly_acounts_id', '=', 'montly_acounts.montly_acounts_id')
                    ->where('opening_monthly_accounts.action_type', '!=', 'DELETE')
                    ->select('opening_monthly_accounts.*', 'montly_acounts.acount_name')
                    ->get();

                $isNewDailyExpanse = false; // openning done wait for closing
                $openingDate = Carbon::parse($openningMontly->opening_date)->format('Y-m-d');
                $selectedAccountMonthlyCostList = OpenningMonthlyAcountsExpanse::where('opening_monthly_id', $accountNoId)
                    ->orderBy('opening_date')
                    ->get();
                $openningAccountMontly = $accountMontlyList->firstWhere('opening_monthly_account_id', $accountNoId);
                $openningAccountMontlyaccountMontlyExpanse = new OpenningMonthlyAcountsExpanse();
                $monthlyExpanseCategoryList = MontlyCategory::all();
            }
        }
        $toptitle = 'Monthly Expanse';
        $urladdMonthlyExpanse = url('/accountMonthly/addMonthlyExpanse');
        $urlAddOpeningMonthlySave = url('/accountMonthly/addMonthlyExpansePost/' . $accountNoId);
        $data = compact(
            'openningMontly',
            'openningAccountMontly',
            'accountMontlyList',
            'toptitle',
            'openingDate',
            'isNewDailyExpanse',
            'urladdMonthlyExpanse',
            'urlAddOpeningMonthlySave',
            'accountNoId',
            'selectedAccountMonthlyCostList',
            'accountMontlyExpanse',
            'monthlyExpanseCategoryList'
        );

        return view('accountMonthly.addMonthlyExpanse')->with($data);
    }

    public function addMonthlyExpansePost($accountNoId, Request $request)
    {
        $request->validate(
            [
                'opening_date' => 'required'
            ]
        );

        $openingMontlyAccount = OpeningMonthlyAccount::find($accountNoId);

        if ($openingMontlyAccount) {
            $openingMonthlyExpanse = new OpenningMonthlyAcountsExpanse();

            $openingMonthlyExpanse->opening_date = $request['opening_date'];
            $openingMonthlyExpanse->opening_monthly_id = $accountNoId;
            $openingMonthlyExpanse->montly_acounts_id = $accountNoId; // TODO: note 
            $openingMonthlyExpanse->montly_categories_id = $request['montly_categories_id'];
            $openingMonthlyExpanse->particulars_name = $request['particulars_name'];
            $openingMonthlyExpanse->company_name = $request['company_name'];
            $openingMonthlyExpanse->payment_type = $request['payment_type'];
            $openingMonthlyExpanse->opening_amount = $request['opening_amount'];
            $openingMonthlyExpanse->action_type = 'UPDATE';
            $openingMonthlyExpanse->user_id = 'sys-user';
            $openingMonthlyExpanse->action_date = now();

            $openingMonthlyExpanse->save();

        }

        return redirect('/accountMonthly/addMonthlyExpanse/' . $accountNoId);
    }
    public function expanseList($searchMonthDate)
    {
        $year = date('Y', strtotime($searchMonthDate));
        // $month = date('m', strtotime($searchMonthDate)); 
        // Running Month Expanse First Show 
        $runningMonthly = OpeningMonthly::where('closing_status', '=', '1')->first();


        $closingMonthlyList = ClosingMonthly::whereYear('opening_date', $year)
            ->orderByRaw('MONTH(opening_date) ASC')
            ->get();

        $searchDate = Carbon::parse($searchMonthDate)->format('Y-m-d');
        $data = compact('searchDate', 'runningMonthly', 'closingMonthlyList');


        return view('accountMonthly.monthlyExpanseList')->with($data);
    }

    public function closeMonthlyExpanse()
    {

        DB::beginTransaction();
        try {
            // openingMonthly => ClosingMonthly 
            $closingMonthly = new ClosingMonthly();
            $openingMonthly = OpeningMonthly::where('closing_status', '=', '1')->first();

            $closingMonthly->opening_date = $openingMonthly->opening_date;
            $closingMonthly->closing_status = $openingMonthly->closing_status;
            $closingMonthly->action_type = 'INSERT';
            $closingMonthly->user_id = 'sys-user';
            $closingMonthly->action_date = now();

            $closingMonthly->save();  // Save DB

            // OpenningMonthlyAccount => ClosingMonthlyAccount
            // Both 


            $openingMonthlyAccountList = OpeningMonthlyAccount::all();
            foreach ($openingMonthlyAccountList as $openingMonthlyAccount) {

                $closingMonthlyAccount = new ClosingMonthlyAccount();

                $closingMonthlyAccount->opening_date = $openingMonthlyAccount->opening_date;
                $closingMonthlyAccount->opening_monthly_id = $closingMonthly->opening_monthly_id; // FK
                $closingMonthlyAccount->montly_acounts_id = $openingMonthlyAccount->montly_acounts_id;   // FK
                $closingMonthlyAccount->montly_categories_id = $openingMonthlyAccount->montly_categories_id ?? null;
                $closingMonthlyAccount->company_name = $openingMonthlyAccount->company_name ?? null;
                $closingMonthlyAccount->payment_type = $openingMonthlyAccount->payment_type ?? null;
                $closingMonthlyAccount->opening_amount = $openingMonthlyAccount->opening_amount ?? 0;

                $closingMonthlyAccount->action_type = 'INSERT';
                $closingMonthlyAccount->user_id = 'sys-user';
                $closingMonthlyAccount->action_date = now();

                $closingMonthlyAccount->save();  // Save to DB

                // OpenningMonthlyAccountExpanse => ClosingMonthlyAccountExpanse
                $openningMonthlyAcountsExpanseList = OpenningMonthlyAcountsExpanse::where('montly_acounts_id', '=', $openingMonthlyAccount->montly_acounts_id)->get();
                $totalBalance = $openingMonthlyAccount->opening_amount ?? 0;
                foreach ($openningMonthlyAcountsExpanseList as $openningMonthlyAcountsExpanse) {

                    $closingMonthlyAccountExpanse = new ClosingMonthlyAcountsExpanse();

                    $closingMonthlyAccountExpanse->opening_date = $openningMonthlyAcountsExpanse->opening_date;
                    $closingMonthlyAccountExpanse->opening_monthly_id = $closingMonthly->opening_monthly_id; // FK
                    $closingMonthlyAccountExpanse->opening_monthly_account_id = $closingMonthlyAccount->opening_monthly_account_id;
                    $closingMonthlyAccountExpanse->montly_categories_id = $openningMonthlyAcountsExpanse->montly_categories_id ?? null;
                    $closingMonthlyAccountExpanse->particulars_name = $openningMonthlyAcountsExpanse->particulars_name;
                    $closingMonthlyAccountExpanse->company_name = $openningMonthlyAcountsExpanse->company_name;
                    $closingMonthlyAccountExpanse->payment_type = $openningMonthlyAcountsExpanse->payment_type;
                    $closingMonthlyAccountExpanse->opening_amount = $openningMonthlyAcountsExpanse->opening_amount ?? 0;

                    $closingMonthlyAccountExpanse->action_type = 'INSERT';
                    $closingMonthlyAccountExpanse->user_id = 'sys-user';
                    $closingMonthlyAccountExpanse->action_date = now();

                    $closingMonthlyAccountExpanse->save();  // Save the new record to the database


                    // is blace if Debit or Credit 
                    if ($openningMonthlyAcountsExpanse->montly_categories_id >= 1 && $openningMonthlyAcountsExpanse->montly_categories_id <= 4) {
                        $totalBalance += $openningMonthlyAcountsExpanse->opening_amount ?? 0;
                    } else {
                        $totalBalance -= $openningMonthlyAcountsExpanse->opening_amount ?? 0;
                    }
                }

                //   Update OpenningMonthlyAccount => blance of each Bank
                $openingMonthlyAccountUpdate = OpeningMonthlyAccount::where('opening_monthly_account_id', '=', $openingMonthlyAccount->opening_monthly_account_id)->first();
                $openingMonthlyAccountUpdate->opening_amount = $totalBalance;

                $openingMonthlyAccountUpdate->save();
            }


            // Update OpeningMonlty 1 => 0
            $openingMonthly->closing_status = 0;
            $openingMonthly->save();

            OpenningMonthlyAcountsExpanse::truncate();

            // delete all OpenningMonthlyAccountExpanse

            DB::commit();
            return redirect('/accountMonthly/expanseList/' . now());


        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Transaction failed: ' . $e->getMessage());
            return redirect('/accountMonthly/expanseList/' . now())->withErrors('An error occurred. Please try again.');
        }

    }
    public function MonthlyExpanseReport($id, $type)
    {

        $openingDate = '';
        $openningMontly = new OpeningMonthly();
        $accountMontlyList = [];
        $selectedAccountMonthlyExpanseCostList = [];
        if ($type == 1) {  // Running Opening 

            $openningMontly = OpeningMonthly::where('action_type', '!=', 'DELETE')->first();
            $openingDate = $openningMontly->opening_date;

            $accountMontlyList = DB::table('opening_monthly_accounts')
                ->join('montly_acounts', 'opening_monthly_accounts.montly_acounts_id', '=', 'montly_acounts.montly_acounts_id')
                ->where('opening_monthly_accounts.action_type', '!=', 'DELETE')
                ->select('opening_monthly_accounts.*', 'montly_acounts.acount_name')
                ->orderBy('opening_monthly_account_id')
                ->get();

            $selectedAccountMonthlyExpanseCostList = OpenningMonthlyAcountsExpanse::orderBy('opening_date')
                ->get();


        } else {
            // closing all here 
            $openningMontly = ClosingMonthly::where('opening_monthly_id', '=', $id)->first();
            $openingDate = $openningMontly->opening_date;

            $accountMontlyList = DB::table('closing_monthly_accounts')
                ->join('montly_acounts', 'closing_monthly_accounts.montly_acounts_id', '=', 'montly_acounts.montly_acounts_id')
                ->where('closing_monthly_accounts.opening_monthly_id', '=', $id)
                ->select('closing_monthly_accounts.*', 'montly_acounts.acount_name')
                ->orderBy('opening_monthly_account_id')
                ->get();

            $selectedAccountMonthlyExpanseCostList = ClosingMonthlyAcountsExpanse::where('opening_monthly_id', '=', $id)
                ->orderBy('opening_date')
                ->get();
        }
        // All closing Daily Debit and Credit show on  $openingDate Month 
        $selectedMonth = Carbon::parse($openingDate)->month;
        $selectedYear = Carbon::parse($openingDate)->year;

        // Get all matching closing daily expenses
        $closingDailyExpanse_all = ClosingDailyExpanse::where('action_type', '!=', 'DELETE')
            ->whereMonth('openning_date', $selectedMonth)
            ->whereYear('openning_date', $selectedYear)
            ->orderBy('closing_daily_expense_id', 'asc')
            ->get();

        $expenseIds = $closingDailyExpanse_all->pluck('closing_daily_expense_id');

        $allDebitList = ClosingDailyDebitExpanse::where('action_type', '!=', 'DELETE')
            ->whereIn('closing_daily_expense_id', $expenseIds)
            ->orderBy('closing_daily_debit_expense_id')
            ->get();

        $allCreditDetailsList = ClosingDailyCreditDetailsExpanse::where('action_type', '!=', 'DELETE')
            ->whereIn('closing_daily_expense_id', $expenseIds)
            ->get();




        $data = compact('openingDate','closingDailyExpanse_all','allDebitList','allCreditDetailsList', 'type', 'openningMontly', 'accountMontlyList', 'selectedAccountMonthlyExpanseCostList');
        return view('accountMonthly.monthlyReport')->with($data);
    }

    function deleteMonthly($monthly_id, $return_accountNo_id){
        DB::beginTransaction();
        try{
    
         
            OpenningMonthlyAcountsExpanse::where('action_type', '!=', 'DELETE')
            ->where('openning_monthly_acounts_expanses_id', '=', $monthly_id)
            ->delete();
        
          DB::commit();
          return redirect('/accountMonthly/addMonthlyExpanse/' . $return_accountNo_id);
        } catch (\Exception $e) {
          DB::rollBack();
          \Log::error('Transaction failed: ' . $e->getMessage());
          redirect('/accountMonthly/addMonthlyExpanse/' . $return_accountNo_id);
        }
    }
}

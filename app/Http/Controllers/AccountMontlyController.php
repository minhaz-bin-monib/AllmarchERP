<?php

namespace App\Http\Controllers;

use App\Models\OpeningMonthlyAccount;
use Illuminate\Http\Request;
use App\Models\OpeningMonthly;
use App\Models\OpenningMonthlyAcountsExpanse;
use App\Models\MontlyCategory;
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

        return redirect('/accountMonthly/addMonthlyExpanse/'.$accountNoId);
    }
    public function expanseList($searchMonthDate)
    {

    }
}

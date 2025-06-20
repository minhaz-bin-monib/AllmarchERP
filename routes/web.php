<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\SalesInvoiceController;
use App\Http\Controllers\SampleInvoiceController;
use App\Http\Controllers\ExchangeInvoiceController;
use App\Http\Controllers\LoanInvoiceController;
use App\Http\Controllers\TransferInvoiceController;
use App\Http\Controllers\AccountReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountDailyController;
use App\Http\Controllers\CustomerPaymentController;
use App\Http\Controllers\AccountMontlyController;
use App\Http\Controllers\AccountPayController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AuthController::class, 'loginForm'])->middleware('isAlredyLoggedIn');

// ---------------------------- Authentication --------------------------------

Route::get('register', [AuthController::class, 'registerForm'])->middleware('isLoggedIn');
Route::post('register', [AuthController::class, 'register'])->middleware('isLoggedIn');
Route::get('login', [AuthController::class, 'loginForm'])->middleware('isAlredyLoggedIn');
Route::post('login', [AuthController::class, 'login'])->middleware('isAlredyLoggedIn');
Route::get('logout', [AuthController::class, 'logout']);

// ------------------------- Dashboard Routes ------------------------

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('isLoggedIn');
Route::get('/unauthorized',[DashboardController::class, 'unauthorized'])->middleware('isLoggedIn');


// ------------------------- Product Routes ------------------------

Route::group(['prefix' => 'product','middleware' => ['isLoggedIn','roleCheck:Admin']], function () {
    Route::get('list', [ProductController::class, 'show']);
    Route::get('create', [ProductController::class, 'create']);
    Route::post('create', [ProductController::class, 'store']);
    Route::get('delete/{id}', [ProductController::class, 'delete']);
    Route::get('edit/{id}', [ProductController::class, 'edit']);
    Route::post('update/{id}', [ProductController::class, 'update']);

    // APIs
    Route::get('getList', [ProductController::class, 'getList']);
});

// ------------------------- Employee Routes ------------------------

Route::group(['prefix' => 'employee','middleware' => ['isLoggedIn','roleCheck:Admin']], function () {
    Route::get('list', [EmployeeController::class, 'show']);
    Route::get('create', [EmployeeController::class, 'create']);
    Route::post('create', [EmployeeController::class, 'store']);
    Route::get('edit/{id}', [EmployeeController::class, 'edit']);
    Route::post('update/{id}', [EmployeeController::class, 'update']);
});

// ------------------------- Customer Routes ------------------------

Route::group(['prefix' => 'customer','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    Route::get('list', [CustomerController::class, 'show']);
    Route::get('create', [CustomerController::class, 'create']);
    Route::post('create', [CustomerController::class, 'store']);
    Route::get('delete/{id}', [CustomerController::class, 'delete']);
    Route::get('edit/{id}', [CustomerController::class, 'edit']);
    Route::post('update/{id}', [CustomerController::class, 'update']);

    //APIs
    Route::get('getList', [CustomerController::class, 'getList']);
});

// ------------------------- Batch Routes ------------------------

Route::group(['prefix' => 'batch','middleware' => ['isLoggedIn','roleCheck:Admin']], function () {
    Route::get('list', [BatchController::class, 'show']);
    Route::get('create', [BatchController::class, 'create']);
    Route::post('create', [BatchController::class, 'store']);
    Route::get('delete/{id}', [BatchController::class, 'delete']);
    Route::get('edit/{id}', [BatchController::class, 'edit']);
    Route::post('update/{id}', [BatchController::class, 'update']);

    // APIs
    Route::get('getBatchByProductId/{id}', [BatchController::class, 'getBatchByProductId']);
    Route::get('getBatchByCustomerAndProductId/{cid}/{pid}', [BatchController::class, 'getBatchByCustomerAndProductId']);
});

// ------------------------- Sales Invoice Routes ------------------------

Route::group(['prefix' => 'salesInvoice','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    Route::get('list', [SalesInvoiceController::class, 'show']);
    Route::get('create', [SalesInvoiceController::class, 'create']);
    Route::post('create', [SalesInvoiceController::class, 'store']);
    Route::get('delete/{id}', [SalesInvoiceController::class, 'delete']);
    Route::get('productDelete/{invoiceId}/{invoiceProductid}', [SalesInvoiceController::class, 'invoiceProductDelete']);
    Route::get('productStickar/{invoiceId}/{invoiceProductid}', [SalesInvoiceController::class, 'invoiceProductStickar']);
    Route::get('edit/{id}', [SalesInvoiceController::class, 'edit']);
    Route::post('update/{id}', [SalesInvoiceController::class, 'update']);
    
    // APIs
    Route::get('salesCustomerInvoicePdf/{salesInvoiceId}', [SalesInvoiceController::class, 'salesCustomerInvoicePdf']);
    Route::get('salesDeliveryInvoicePdf/{salesInvoiceId}', [SalesInvoiceController::class, 'salesDeliveryInvoicePdf']);
    Route::get('salesSpecialInvoicePdf/{salesInvoiceId}', [SalesInvoiceController::class, 'salesSpecialInvoicePdf']);
    Route::get('salesSpecialDeliveryPdf/{salesInvoiceId}', [SalesInvoiceController::class, 'salesSpecialDeliveryPdf']);
    Route::get('salesSpecialCalculateInvoicePdf/{salesInvoiceId}', [SalesInvoiceController::class, 'salesSpecialCalculateInvoicePdf']);
    Route::get('salesPreviousList/{customerId}/{productId}', [SalesInvoiceController::class, 'salesPreviousList']);
    
});

// ------------------------- Sample Invoice Routes ------------------------

Route::group(['prefix' => 'sampleInvoice','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    //Route::get('list', [SampleInvoiceController::class, 'show']);
    Route::get('create', [SampleInvoiceController::class, 'create']);
    Route::post('create', [SampleInvoiceController::class, 'store']);
    //Route::get('delete/{id}', [SampleInvoiceController::class, 'delete']);
    Route::get('productDelete/{invoiceId}/{invoiceProductid}', [SampleInvoiceController::class, 'invoiceProductDelete']);
    Route::get('productStickar/{invoiceId}/{invoiceProductid}', [SampleInvoiceController::class, 'invoiceProductStickar']);
    Route::get('edit/{id}', [SampleInvoiceController::class, 'edit']);
    Route::post('update/{id}', [SampleInvoiceController::class, 'update']);
    
    // APIs
    Route::get('sampleCustomerInvoicePdf/{salesInvoiceId}', [SampleInvoiceController::class, 'sampleCustomerInvoicePdf']);
    Route::get('sampleDeliveryInvoicePdf/{salesInvoiceId}', [SampleInvoiceController::class, 'sampleDeliveryInvoicePdf']);
    Route::get('sampleSpecialInvoicePdf/{salesInvoiceId}', [SampleInvoiceController::class, 'sampleSpecialInvoicePdf']);
    Route::get('sampleSpecialDeliveryInvoicePdf/{salesInvoiceId}', [SampleInvoiceController::class, 'sampleSpecialDeliveryInvoicePdf']);
    Route::get('sampleSpecialCalculateInvoicePdf/{salesInvoiceId}', [SampleInvoiceController::class, 'sampleSpecialCalculateInvoicePdf']);
    
});
// ------------------------- Exchange Invoice Routes ------------------------

Route::group(['prefix' => 'exchangeInvoice','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    //Route::get('list', [ExchangeInvoiceController::class, 'show']);
    Route::get('create', [ExchangeInvoiceController::class, 'create']);
    Route::post('create', [ExchangeInvoiceController::class, 'store']);
    //Route::get('delete/{id}', [ExchangeInvoiceController::class, 'delete']);
    Route::get('productDelete/{invoiceId}/{invoiceProductid}', [ExchangeInvoiceController::class, 'invoiceProductDelete']);
    Route::get('productStickar/{invoiceId}/{invoiceProductid}', [ExchangeInvoiceController::class, 'invoiceProductStickar']);
    Route::get('edit/{id}', [ExchangeInvoiceController::class, 'edit']);
    Route::post('update/{id}', [ExchangeInvoiceController::class, 'update']);
    
    // APIs
    Route::get('exchangeCustomerInvoicePdf/{salesInvoiceId}', [ExchangeInvoiceController::class, 'exchangeCustomerInvoicePdf']);
    Route::get('exchangeDeliveryInvoicePdf/{salesInvoiceId}', [ExchangeInvoiceController::class, 'exchangeDeliveryInvoicePdf']);
    Route::get('exchangeSpecialInvoicePdf/{salesInvoiceId}', [ExchangeInvoiceController::class, 'exchangeSpecialInvoicePdf']);
    Route::get('exchangeSpecialDeliveryInvoicePdf/{salesInvoiceId}', [ExchangeInvoiceController::class, 'exchangeSpecialDeliveryInvoicePdf']);
    Route::get('exchangeSpecialCalculateInvoicePdf/{salesInvoiceId}', [ExchangeInvoiceController::class, 'exchangeSpecialCalculateInvoicePdf']);
    
});
// ------------------------- Loan Invoice Routes ------------------------

Route::group(['prefix' => 'loanInvoice','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    //Route::get('list', [LoanInvoiceController::class, 'show']);
    Route::get('create', [LoanInvoiceController::class, 'create']);
    Route::post('create', [LoanInvoiceController::class, 'store']);
    //Route::get('delete/{id}', [LoanInvoiceController::class, 'delete']);
    Route::get('productDelete/{invoiceId}/{invoiceProductid}', [LoanInvoiceController::class, 'invoiceProductDelete']);
    Route::get('productStickar/{invoiceId}/{invoiceProductid}', [LoanInvoiceController::class, 'invoiceProductStickar']);
    Route::get('edit/{id}', [LoanInvoiceController::class, 'edit']);
    Route::post('update/{id}', [LoanInvoiceController::class, 'update']);
    
    // APIs
    Route::get('loanCustomerInvoicePdf/{salesInvoiceId}', [LoanInvoiceController::class, 'loanCustomerInvoicePdf']);
    Route::get('loanDeliveryInvoicePdf/{salesInvoiceId}', [LoanInvoiceController::class, 'loanDeliveryInvoicePdf']);
    Route::get('loanSpecialInvoicePdf/{salesInvoiceId}', [LoanInvoiceController::class, 'loanSpecialInvoicePdf']);
    Route::get('loanSpecialDeliveryInvoicePdf/{salesInvoiceId}', [LoanInvoiceController::class, 'loanSpecialDeliveryInvoicePdf']);
    Route::get('loanSpeicalCalculateInvoicePdf/{salesInvoiceId}', [LoanInvoiceController::class, 'loanSpeicalCalculateInvoicePdf']);
    
});


// ------------------------- Transfer Invoice Routes ------------------------

Route::group(['prefix' => 'transferInvoice','middleware' => ['isLoggedIn','roleCheck:Admin']], function () {
    Route::get('list', [TransferInvoiceController::class, 'show']);
    Route::get('create', [TransferInvoiceController::class, 'create']);
    Route::post('create', [TransferInvoiceController::class, 'store']);
    Route::get('delete/{id}', [TransferInvoiceController::class, 'delete']);
    Route::get('productDelete/{invoiceId}/{invoiceProductid}', [TransferInvoiceController::class, 'invoiceProductDelete']);
    Route::get('productStickar/{invoiceId}/{invoiceProductid}', [TransferInvoiceController::class, 'invoiceProductStickar']);
    Route::get('edit/{id}', [TransferInvoiceController::class, 'edit']);
    Route::post('update/{id}', [TransferInvoiceController::class, 'update']);
    
    // APIs
    Route::get('proformaInvoicePdf/{transferInvoiceId}', [TransferInvoiceController::class, 'proformaInvoicePdf']);
    Route::get('commercialInvoicePdf/{transferInvoiceId}', [TransferInvoiceController::class, 'commercialInvoicePdf']);
    Route::get('deliverChalanInvoicePdf/{transferInvoiceId}', [TransferInvoiceController::class, 'deliverChalanInvoicePdf']);
    Route::get('packingListInvoicePdf/{transferInvoiceId}', [TransferInvoiceController::class, 'packingListInvoicePdf']);
    Route::get('truckReceiptInvoicePdf/{transferInvoiceId}', [TransferInvoiceController::class, 'truckReceiptInvoicePdf']);
    
});

// ------------------------- Account Report  Routes ------------------------

Route::group(['prefix' => 'accountReport','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    Route::get('lastMonthSales/{lastMonth}', [AccountReportController::class, 'lastMonthSales']);
    Route::get('monthlySalesStandard/{monthYear}', [AccountReportController::class, 'monthlySalesStandard']);
    Route::get('yearSalesStandard/{monthYearForm}/{monthYearTo}', [AccountReportController::class, 'yearSalesStandard']);
   
   // Route::get('proformaInvoicePdf/{transferInvoiceId}', [TransferInvoiceController::class, 'proformaInvoicePdf']);

});

// ------------------------- Account Daily  Routes ------------------------
Route::group(['prefix' => 'accountDaily','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    Route::get('expanse', [AccountDailyController::class, 'dailyExpanse']);
    Route::get('expanseList/{searchDate}', [AccountDailyController::class, 'dailyExpanseList']);
    Route::get('openingDailyExpanse/{date}', [AccountDailyController::class, 'openingDailyExpanse']);
    Route::get('closingDailyExpanse', [AccountDailyController::class, 'closingDailyExpanse']);
    Route::post('addOpeningDailyDebit', [AccountDailyController::class, 'addOpeningDailyDebit']);
    Route::post('addOpeningDailyCredit', [AccountDailyController::class, 'addOpeningDailyCredit']);
    Route::get('dailyExpenseDetails/{clsExpanseId}', [AccountDailyController::class, 'DailyExpenseByClosedExpId']);
    Route::get('deleteDebitOrCredit/{credOrDebitId}/{typeOf}', [AccountDailyController::class, 'deleteDebitOrCredit']);
  
});

// ------------------------- Account Payment  Routes ------------------------

Route::group(['prefix' => 'customerPayment','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    Route::get('list/{type}', [CustomerPaymentController::class, 'show']);
    Route::get('create', [CustomerPaymentController::class, 'create']);
    Route::post('create', [CustomerPaymentController::class, 'store']);
    Route::get('delete/{id}', [CustomerPaymentController::class, 'delete']);
    Route::get('edit/{id}', [CustomerPaymentController::class, 'edit']);
    Route::post('update/{id}', [CustomerPaymentController::class, 'update']);
    Route::get('statusChange/{id}/{status}', [CustomerPaymentController::class, 'statusChange']);
    Route::get('createForward', [CustomerPaymentController::class, 'createForward']);
    Route::post('createForward', [CustomerPaymentController::class, 'storeForward']);
    Route::get('statementReport/{customer_id}/{startDate}/{endDate}/{type}', [CustomerPaymentController::class, 'statementReport']);
});


// ------------------------- Account Daily  Routes ------------------------
Route::group(['prefix' => 'accountMonthly','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    Route::get('openingMonthlyView', [AccountMontlyController::class, 'openingMonthlyView']);
    Route::get('openingMontlyAccount/{openning_date}', [AccountMontlyController::class, 'openingMonthlyCreate']);
    Route::get('expanseList/{searchMonthDate}', [AccountMontlyController::class, 'expanseList']);
    Route::get('openingMonthlyEdit/{opening_monthly_account_id}', [AccountMontlyController::class, 'openingMonthlyEdit']);
    Route::post('openingMonthlyEditSave/{opening_monthly_account_id}', [AccountMontlyController::class, 'openingMonthlyEditSave']);
    Route::get('addMonthlyExpanse/{accountNoId}', [AccountMontlyController::class, 'addMonthlyExpanse']);
    Route::post('addMonthlyExpansePost/{accountNoId}', [AccountMontlyController::class, 'addMonthlyExpansePost']);
    Route::get('closeMonthlyExpanse', [AccountMontlyController::class, 'closeMonthlyExpanse']);
    Route::get('MonthlyExpanseReport/{id}/{type}', [AccountMontlyController::class, 'MonthlyExpanseReport']);
    Route::get('deleteMonthly/{monthly_id}/{return_accountNo_id}', [AccountMontlyController::class, 'deleteMonthly']);
    
  
});
// ------------------------- Account Pay  Routes ------------------------
Route::group(['prefix' => 'accountPay','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    Route::get('checkPrint', [AccountPayController::class, 'checkPrint']);

});
@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
    <title>Daily Expense</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->




    <div class="px-4">
        <div class="row mb-2">

            <div class="col-12 pt-2 pb-1">
                {{-- <h6 class="text-center text-primary" style="letter-spacing: 1px;">All-March Bangladesh Limited</h6>
                <p class="text-center" style="font-size: 12px">Cash Summary As at
                    {{ $closingExpanse && $closingExpanse->openning_date ? \Carbon\Carbon::parse($closingExpanse->openning_date)->format('d-m-Y') : 'N/A' }}
                </p> --}}
                <p class="text-center text-primary" style="letter-spacing: 1px; margin-bottom: 1px;">All March Bangladesh
                    Limited</p>
                <p class="text-center " style="letter-spacing: 1px; margin-bottom: 1px;">All Payment & Received</p>
                <p class="text-center " style="letter-spacing: 1px; margin-bottom: 1px;">
                    {{ \Carbon\Carbon::parse($openingDate)->startOfMonth()->format('jS') }} to
                    {{ \Carbon\Carbon::parse($openingDate)->endOfMonth()->format('jS F Y') }}
                </p>
            </div>
            <div class="col-10"></div>
            <div class="col-2">
                {{-- <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
                <p style="margin: 0px 0px" class="text-end"><b>Print Date: {{ date('d-m-Y') }}</b></p> --}}

            </div>

        </div>

        <table id="myTable" class="table table-bordered table-hover" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">Date</th>
                    <th style="width: 190px; text-align: center;">Particulars</th>
                    <th style="width: 75px; text-align: center;">Company Name</th>
                    <th style="width: 75px; text-align: center;">Payment Type</th>
                    <th style="width: 75px; text-align: center;">Saiful Sir</th>
                    <th style="width: 75px; text-align: center;">Pubali Bank</th>
                    <th style="width: 75px; text-align: center;">Cash Rec. to Bank</th>
                    <th style="width: 75px; text-align: center;">Internal Received</th>
                    <th style="width: 75px; text-align: center;">Received </th>
                    <th style="width: 75px; text-align: center;">MD Sir</th>
                    <th style="width: 75px; text-align: center;">Chairman Sir</th>
                    <th style="width: 75px; text-align: center;">Invesment</th>
                    <th style="width: 75px; text-align: center;">Expenses</th>
                    <th style="width: 75px; text-align: center;">Internal Transfer</th>
                    <th style="width: 75px; text-align: center;">Advance & Loan</th>
                    <th style="width: 75px; text-align: center;">Attitude</th>
                    <th style="width: 75px; text-align: center;">Saiful Sir</th>
                    <th style="width: 75px; text-align: center;">Pubali Bank</th>
                    <th style="width: 95px; text-align: center;">Amount</th>
                    <th style="width: 95px; text-align: center;">Total Amount</th>
                </tr>
            </thead>
            <tbody>

                {{-- One by One Bank Account  --}}
                @foreach ($accountMontlyList as $openningAccountMontly)
                    {{-- First Print Bank Account --}}
                    @php
                        $openingTotalAmount = $openningAccountMontly->opening_amount;
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($openningAccountMontly->opening_date)->format('j-M-y') }}</td>
                        <td>{{ $openningAccountMontly->acount_name }}</td>
                        <td>{{ $openningAccountMontly->company_name }}</td>
                        <td>{{ $openningAccountMontly->payment_type }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right">{{ $openningAccountMontly->opening_amount }}</td>
                        <td></td>
                    </tr>
                    {{-- Second Print Cost Expanse Details --}}
                    @php
                        $targetMonthlyAccountId = $openningAccountMontly->opening_monthly_account_id;

                        // Filter by montly_acounts_id
                        if ($type == 1) {
                            $selectedAccountMonthlyCostList = $selectedAccountMonthlyExpanseCostList->filter(function (
                                $item,
                            ) use ($targetMonthlyAccountId) {
                                return $item->montly_acounts_id == $targetMonthlyAccountId;
                            });
                        } else {
                            $selectedAccountMonthlyCostList = $selectedAccountMonthlyExpanseCostList->filter(function (
                                $item,
                            ) use ($targetMonthlyAccountId) {
                                return $item->opening_monthly_account_id == $targetMonthlyAccountId;
                            });
                        }
                    @endphp
                    @foreach ($selectedAccountMonthlyCostList as $accMnth)
                        @php
                            if ($accMnth->montly_categories_id >= 1 && $accMnth->montly_categories_id <= 4) {
                                // Debit
                                $openingTotalAmount += $accMnth->opening_amount;
                            } else {
                                // Credit
                                $openingTotalAmount -= $accMnth->opening_amount;
                            }
                        @endphp
                        <tr>
                            <td> {{ \Carbon\Carbon::parse($accMnth->opening_date)->format('j-M-y') }}</td>
                            <td>{{ $accMnth->particulars_name }}</td>
                            <td>{{ $accMnth->company_name }}</td>
                            <td>{{ $accMnth->payment_type }}</td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 1)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 2)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td></td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 3)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 4)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 5)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 6)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 7)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 8)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 9)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 10)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 11)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 12)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($accMnth->montly_categories_id == 13)
                                    {{ $accMnth->opening_amount }}
                                @endif
                            </td>
                            <td style="text-align: right">{{ $openingTotalAmount }}</td>
                            <td></td>

                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Total:</b></td>
                        <td style="text-align: right"><b>{{ $openingTotalAmount }}</b></td>
                    </tr>
                @endforeach

                {{-- DAILY Expanse Print --}}

                @php
                    $totalDailyAmount = 0;
                @endphp
                @foreach ($closingDailyExpanse_all as $DailyExpanse_all)
                    {{-- $loop->iteration  starts from 1 --}}

                    @php
                        $isFirstIteration = $loop->iteration;
                        $closing_daily_expense_id = $DailyExpanse_all->closing_daily_expense_id;

                        // Filter by montly_acounts_id

                        $selectedDebitList = $allDebitList->filter(function ($item) use ($closing_daily_expense_id) {
                            return $item->closing_daily_expense_id == $closing_daily_expense_id;
                        });

                        $selectedallCreditDetailsList = $allCreditDetailsList->filter(function ($item) use (
                            $closing_daily_expense_id,
                        ) {
                            return $item->closing_daily_expense_id == $closing_daily_expense_id;
                        });

                    @endphp
                    {{-- Daily Openning Cash print and Debits --}}
                    @foreach ($selectedDebitList as $Debit)
                        @if ($isFirstIteration == 1 && $Debit->blance_type == 1)
                            @php
                                $totalDailyAmount += $Debit->debit_blance;
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($DailyExpanse_all->openning_date)->format('j-M-y') }}</td>
                                <td>{{ $Debit->debit_name }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">{{  $totalDailyAmount }}</td>
                                <td></td>
                            </tr>
                        @elseif ($Debit->blance_type > 1)
                            @php
                                 $totalDailyAmount += $Debit->debit_blance;
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($DailyExpanse_all->openning_date)->format('j-M-y') }}</td>
                                <td>{{ $Debit->debit_name }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">
                                    @if ($Debit->blance_type == 3)
                                        {{ $Debit->debit_blance }}
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    @if ($Debit->blance_type == 2)
                                        {{ $Debit->debit_blance }}
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    @if ($Debit->blance_type == 4)
                                        {{ $Debit->debit_blance }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">{{ $totalDailyAmount }}</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                    {{-- Daily All Credits --}}
                    @foreach ($selectedallCreditDetailsList as $CreditDetails)
                            @php
                                $totalDailyAmount -= $CreditDetails->credit_blance;
                            @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($DailyExpanse_all->openning_date)->format('j-M-y') }}</td>
                            <td>{{ $CreditDetails->credit_name }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">
                                @if ($CreditDetails->credit_category_id == 1)
                                    {{ $CreditDetails->credit_blance }}
                                @endif
                            </td>
                            <td style="text-align: right">
                                @if ($CreditDetails->credit_category_id == 2)
                                    {{ $CreditDetails->credit_blance }}
                                @endif
                            </td>
                            <td></td>
                            <td style="text-align: right">
                                @if ($CreditDetails->credit_category_id > 2)
                                    {{ $CreditDetails->credit_blance }}
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">{{ $totalDailyAmount }}</td>
                            <td></td>
                        </tr>
                @endforeach
                @endforeach

            </tbody>
        </table>

    </div>
    <script>
        $(document).ready(function() {
            // Initialize the first DataTable instance
            let table = $('#myTable').DataTable({
                paging: false, // Disable pagination
                sortable: false, // Disable sorting
                ordering: false, // Disable ordering
                dom: 'Bfrtip', // Define the table control elements
                searching: false,
                buttons: [{
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        className: 'btn  btn-sm  btn-success'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'Export to CSV',
                        className: 'btn  btn-sm  btn-warning'
                    }
                ]
            });


        });
    </script>
    <script type="text/javascript">
        // let table = new DataTable('#myTable');
        // let table = new DataTable('#myTable', {
        //     perPage: 10, // Number of entries per page
        //     sortable: true, // Allow sorting
        //     order: [
        //         [0, 'asc']
        //     ], // Maintain initial order based on first column
        // });

        function printPage() {
            console.log('print  page');
            window.print();
        }
    </script>


    <!-- END View Content Here -->
@endsection

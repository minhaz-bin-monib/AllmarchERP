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
                <h6 class="text-center text-primary" style="letter-spacing: 1px;">All-March Bangladesh Limited</h6>
                <p class="text-center" style="font-size: 12px">Cash Summary As at
                    {{ $closingExpanse && $closingExpanse->openning_date ? \Carbon\Carbon::parse($closingExpanse->openning_date)->format('d-m-Y') : 'N/A' }}
                </p>
            </div>
            <div class="col-10"></div>
            <div class="col-2">
                <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
                <p style="margin: 0px 0px" class="text-end"><b>Print Date: {{ date('d-m-Y') }}</b></p>

            </div>

        </div>

        <table id="myTable" class="table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th class="text-center">Debit</th>
                    <th style="border-right: 2px solid #0025a2;"></th>
                    <th></th>
                    <th class="text-center">Credit</th>
                    <th></th>
                    <th class="text-center">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $indexOfDebitPrint = 0;
                    $debitTotalSum = 0;
                    $creditTotalSum = 0;
                    $creditSubTotal = 0;
                @endphp

                @foreach ($closingCeditCategoryDDL as $objCrediCategory)
                    {{-- First Category Print --}}
                    <tr>
                        <td>
                            @if (isset($closingDebitList[$indexOfDebitPrint]))
                                {{ \Carbon\Carbon::parse($closingDebitList[$indexOfDebitPrint]->debit_date)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td>
                            @if (isset($closingDebitList[$indexOfDebitPrint]))
                                {{ $closingDebitList[$indexOfDebitPrint]->debit_name }}
                            @endif
                        </td>
                        <td class="text-end" style="border-right: 2px solid #0025a2;">
                            @if (isset($closingDebitList[$indexOfDebitPrint]))
                                {{ $closingDebitList[$indexOfDebitPrint]->debit_blance }}
                                @php
                                    $debitTotalSum += $closingDebitList[$indexOfDebitPrint]->debit_blance;
                                @endphp
                            @endif
                        </td>
                        <td></td>
                        <td class="text-center">
                            <b>{{ $objCrediCategory->credit_category_name }}</b>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    @php
                        $creditSubTotal = 0;

                        $filterSubCreditList = $closingCreditDetailsList->filter(function ($f) use ($objCrediCategory) {
                            return $f->closing_daily_credit_id == $objCrediCategory->closing_daily_credit_id;
                        });

                    @endphp
                    {{-- Second All Sub Category Print --}}
                    @foreach ($filterSubCreditList as $objSubCredit)
                        @php
                            $indexOfDebitPrint++;
                        @endphp
                        <tr>
                            <td>
                                @if (isset($closingDebitList[$indexOfDebitPrint]))
                                    {{ \Carbon\Carbon::parse($closingDebitList[$indexOfDebitPrint]->debit_date)->format('d-m-Y') }}
                                @endif
                            </td>
                            <td>
                                @if (isset($closingDebitList[$indexOfDebitPrint]))
                                    {{ $closingDebitList[$indexOfDebitPrint]->debit_name }}
                                @endif
                            </td>
                            <td class="text-end" style="border-right: 2px solid #0025a2;">
                                @if (isset($closingDebitList[$indexOfDebitPrint]))
                                    {{ $closingDebitList[$indexOfDebitPrint]->debit_blance }}
                                    @php
                                        $debitTotalSum += $closingDebitList[$indexOfDebitPrint]->debit_blance;
                                    @endphp
                                @endif
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($objSubCredit->credit_date)->format('d-m-Y') }}
                            </td>
                            <td>
                                {{ $objSubCredit->credit_name }}
                            </td>
                            <td class="text-end">
                                {{ $objSubCredit->credit_blance }}
                                @php
                                    $creditSubTotal += $objSubCredit->credit_blance;
                                    $creditTotalSum += $objSubCredit->credit_blance;
                                @endphp
                            </td>
                            <td></td>
                    @endforeach
                    @php
                        $indexOfDebitPrint++;
                    @endphp
                    {{-- Third After Category Print Empty row Print --}}
                    <tr>
                        <td>
                            @if (isset($closingDebitList[$indexOfDebitPrint]))
                                {{ \Carbon\Carbon::parse($closingDebitList[$indexOfDebitPrint]->debit_date)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td>
                            @if (isset($closingDebitList[$indexOfDebitPrint]))
                                {{ $closingDebitList[$indexOfDebitPrint]->debit_name }}
                            @endif
                        </td>
                        <td class="text-end" style="border-right: 2px solid #0025a2;">
                            @if (isset($closingDebitList[$indexOfDebitPrint]))
                                {{ $closingDebitList[$indexOfDebitPrint]->debit_blance }}
                                @php
                                    $debitTotalSum += $closingDebitList[$indexOfDebitPrint]->debit_blance;
                                @endphp
                            @endif
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">{{ $creditSubTotal }}</td>
                    </tr>
                    @php
                        $indexOfDebitPrint++;
                    @endphp
                @endforeach
                {{-- Fourth If Debit remain --}}
                @if (!empty($closingDebitList) && count($closingDebitList) > $indexOfDebitPrint)
                    @foreach ($closingDebitList as $index => $debit)
                        @if ($index >= $indexOfDebitPrint)
                            <tr>
                                <td>
                                    @if (isset($closingDebitList[$index]))
                                        {{ \Carbon\Carbon::parse($closingDebitList[$index]->debit_date)->format('d-m-Y') }}
                                    @endif
                                </td>
                                <td>
                                    @if (isset($closingDebitList[$index]))
                                        {{ $closingDebitList[$index]->debit_name }}
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if (isset($closingDebitList[$index]))
                                        {{ $closingDebitList[$index]->debit_blance }}
                                        @php
                                            $debitTotalSum += $closingDebitList[$index]->debit_blance;
                                        @endphp
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                {{-- Final Summery  --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td style="border-right: 2px solid #0025a2;"></td>
                    <td></td>
                    <td class="text-end text-info">Today Total Debit:</td>
                    <td class="text-end">{{ $creditTotalSum }}</td>
                    <td class="text-end">{{ $creditTotalSum }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="border-right: 2px solid #0025a2;"></td>
                    <td></td>
                    <td class="text-end text-primary">Closing Cash Balance:</td>
                    <td class="text-end">{{ $debitTotalSum - $creditTotalSum }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-start">Today Total Credit:</td>

                    <td class="text-end" style="border-right: 2px solid #0025a2;">{{ $debitTotalSum }}</td>
                    <td></td>
                    <td class="text-end">Total balance:</td>
                    <td class="text-end">{{ $debitTotalSum }}</td>
                    <td></td>
                </tr>
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
                buttons: [{
                        extend: 'copyHtml5',
                        text: 'Copy',
                        className: 'btn  btn-sm  btn-primary'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        className: 'btn  btn-sm  btn-success'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'Export to CSV',
                        className: 'btn  btn-sm  btn-warning'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export to PDF',
                        className: 'btn  btn-sm  btn-danger'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        className: 'btn  btn-sm  btn-info'
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

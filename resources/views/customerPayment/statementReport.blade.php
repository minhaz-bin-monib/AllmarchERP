@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
    <title>Customer Payment Statement</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->



    <div class="px-4">
        <div class="row mb-2">

            <div class="col-11 d-flex">
                <img style="width:440px; margin: 0 auto" src="{{ url('/') }}/img/print_logo.png" />
            </div>
            <div class="col-1">

            </div>
            <div class="col-11">
                <h6 style="margin: 0px 0px" class="text-center">Customer Name: {{ $customerName }} </h6>
                <p class="text-center"> {{ $FormDate->day }}-{{ \Carbon\Carbon::parse($FormDate)->format('F') }} -
                    {{ $FormDate->year }} To
                    {{ $ToDate->day }}-{{ \Carbon\Carbon::parse($ToDate)->format('F') }} - {{ $ToDate->year }}</p>
            </div>
            <div class="col-1">
                <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
            </div>
            <div class="col-2">
                <span>Customer</span>
                <select data-live-search="true" id="customer_id" name="customer_id" class="form-control">
                    <option value="0" {{ old('customer_id', $customerid) == '0' ? 'selected' : '' }}>
                        Select Customer
                    </option>
                    @foreach ($customers as $mat)
                        <option value="{{ $mat['customer_id'] }}"
                            {{ old('customer_id', $customerid) == $mat['customer_id'] ? 'selected' : '' }}>
                            {{ $mat['customer_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <span>From</span>
                <input type="date" value="{{ \Carbon\Carbon::parse($FormDate)->format('Y-m-d') }}" id="searchInput1"
                    class="form-control" />

            </div>
            <div class="col-2">
                <span>To</span>
                <input type="date" value="{{ \Carbon\Carbon::parse($ToDate)->format('Y-m-d') }}" id="searchInput2"
                    class="form-control" />

            </div>

            {{-- <div class="col-2">
                <span>Type</span>
                <select name="searchType" id="SearchType" class="form-control">
    
                    <option value="InvoiceAndPayment" {{ old('searchType', $searchType) == 'InvoiceAndPayment' ? 'selected' : '' }}>
                        Invoice And Payment
                    </option>
                    <option value="Invoice" {{ old('searchType', $searchType) == 'Invoice' ? 'selected' : '' }}>
                        Invoice
                    </option>
                    <option value="Payment" {{ old('searchType', $searchType) == 'Payment' ? 'selected' : '' }}>
                        Payment
                    </option>
                </select>

            </div> --}}
            <div class="col-4">
                <button id="searchButton" onClick="Search()" class="btn btn-sm btn-primary mt-4"><i
                        class="fa fa-search"></i>
                    Search</button>

            </div>
            <div class="col-2">
                <p style="margin: 0px 0px" class="text-end"><b>Print Date: {{ date('d-m-Y') }}</b></p>
            </div>
        </div>


        <table id="myTable" class="table-bordered">
            @php
                $totalInvAmt = 0;
                $totalDipositAmt = 0;
            @endphp
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Invoice</th>
                    <th>Quantity</th>
                    <th>Invoice Amount</th>
                    <th>Diposit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @php
                        $totalInvAmt += $openingInvAmt;
                        $totalDipositAmt += $openingDipositAmt;
                    @endphp
                    <td></td>
                    <td><b>Opening</b></td>
                    <td></td>
                    <td></td>
                    <td class="text-end"><b>{{ $openingInvAmt }}</b></td>
                    <td class="text-end"><b>{{ $openingDipositAmt > 0 ? $openingDipositAmt: '' }}</b></td>
                </tr>
                @foreach ($finalStatemnetResults as $stm)
                    @php
                        $totalInvAmt += (float) ($stm['invoice_amount'] ?? 0);
                        $totalDipositAmt += (float) ($stm['diposit_amount'] ?? 0);
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($stm['invoice_date'])->format('d-m-Y') }}</td>
                        <td>{{ $stm['type'] }}</td>
                        <td>{{ $stm['salesInvoice_id'] }}</td>
                        <td>{{ $stm['quantity'] }}</td>
                        <td class="text-end">{{ $stm['invoice_amount'] }}</td>
                        <td class="text-end">{{ $stm['diposit_amount'] }}</td>
                    </tr>
                @endforeach
                @if ($finalStatemnetResults->isNotEmpty())
                    <tr>
                        <td></td>
                        <td></td>
                        <td><b>Total</b></td>
                        <td></td>
                        <td class="text-end"><b>{{ $totalInvAmt}}</b></td>
                        <td class="text-end"><b>{{$totalDipositAmt}}</b></td>

                    </tr>
                @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td>No Records</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <table  class="table table-bordered">
                    <tr>
                       <td>
                        Total Sales
                        </td>
                       <td class="text-end">{{ $totalInvAmt}}</td>
                    </tr>
                    <tr>
                       <td> Payment Received</td>
                       <td class="text-end">({{$totalDipositAmt}})</td>
                    </tr>
                    <tr>
                       <td> Receivable</td>
                       <td class="text-end">{{ $totalInvAmt - $totalDipositAmt}}</td>
                    </tr>

                </table>
            </div>
            <div class="col-4"></div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            // Initialize the first DataTable instance
            let table = $('#myTable').DataTable({
                paging: false,
                sortable: false,
                ordering: false,
                dom: 'Bfrtip',
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

            $('#customer_id').selectpicker();
            $('#customer_id').selectpicker('refresh');
        });
    </script>
    <script type="text/javascript">
        function printPage() {
            console.log('print  page');
            window.print();
        }

        function Search() {

            let formDate = document.getElementById('searchInput1').value;
            let toDate = document.getElementById('searchInput2').value;
            let customer_id = document.getElementById('customer_id').value;
            let type = 'InvoiceAndPayment'; //document.getElementById('SearchType').value;
            if (new Date(formDate) > new Date(toDate)) {
                alert('FromDate cannot be greater than ToDate. Please select a valid date range.');
                return; // Stop execution if the validation fails
            }

            // Redirect if validation passes
            window.location.href = "{{ url('/customerPayment/statementReport') }}/" + customer_id + "/" + formDate + "/" +
                toDate + "/" + type;
        }
    </script>
@endsection

@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
    <title>Year Sales Standard</title>
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
                <h5 style="margin: 0px 0px" class="text-center">Sales Form
                    {{ $FormDate->day }}-{{ \Carbon\Carbon::parse($FormDate)->format('F') }} - {{ $FormDate->year }} To
                    {{ $ToDate->day }}-{{ \Carbon\Carbon::parse($ToDate)->format('F') }} - {{ $ToDate->year }}</h5>
            </div>
            <div class="col-1">
                <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
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
            <div class="col-4">
                <button id="searchButton" onClick="Search()" class="btn btn-sm btn-primary mt-4"><i class="fa fa-search"></i>
                    Search</button>

            </div>
            <div class="col-4">
                <p style="margin: 0px 0px" class="text-end"><b>Print Date: {{ date('d-m-Y') }}</b></p>
            </div>
        </div>


        <table id="myTable" class="table-bordered">

            @php
                $grandTotal = 0;
                $isFirstTime = true;
            @endphp
            @foreach ($InvResults as $salesInv)
                @php
                    $totalCost = 0;
                    $totalWeight = 0;
                @endphp
                @if ($isFirstTime == true)
                    <thead>
                        @php
                            $isFirstTime = false;
                        @endphp

                        <tr style="color:rgb(0, 0, 196)">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{ $salesInv['Customer'] }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @else
                        {{-- <tbody>    --}}
                        <tr style="color:rgb(0, 0, 196)">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $salesInv['Customer'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                @endif

                <tr>
                    <td>SL.</td>
                    <td>Date</td>
                    <td>Invoice</td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Rate</td>
                    <td>Total</td>
                    <td>Actual Price</td>
                    <td>Total Cost</td>
                    <td>Net Price</td>
                    <td>Net Cost</td>
                    <td>Against</td>

                </tr>
                @foreach ($salesInv['InvProducts'] as $productInv)
                    @php
                        $Weight = $productInv['packing'] * $productInv['no_of_packing'];
                        $Cost = $Weight * $productInv['unit_price'];
                        $totalWeight += $Weight;
                        $totalCost += $Cost;
                        $grandTotal += $Cost;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($productInv['invoiceDate'])->format('d-m-Y') }}</td>
                        <td>{{ $productInv['salesInvoice_id'] }}</td>
                        <td>{{ $productInv['productName'] }}</td>
                        <td>{{ $Weight }}</td>
                        <td>{{ $productInv['unit_price'] }}</td>
                        <td>{{ $Cost }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total: </td>
                    <td>{{ $totalWeight }}</td>
                    <td></td>
                    <td>{{ number_format($totalCost, 2) }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
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
                </tr>
            @endforeach
            <tr>
                <td> </td>
                <td><b>Grand Total:</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>{{ number_format($grandTotal, 2) }}</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>

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


        });
    </script>
    <script type="text/javascript">
        function printPage() {
            console.log('print  page');
            window.print();
        }

        function Search() {
            // Get date values
            let formDate = document.getElementById('searchInput1').value;
            let toDate = document.getElementById('searchInput2').value;

            // Validate that FromDate is not greater than ToDate
            if (new Date(formDate) > new Date(toDate)) {
                alert('FromDate cannot be greater than ToDate. Please select a valid date range.');
                return; // Stop execution if the validation fails
            }

            // Redirect if validation passes
            window.location.href = "{{ url('/accountReport/lastMonthSales') }}/" + formDate + "/" + toDate;
        }
    </script>
@endsection

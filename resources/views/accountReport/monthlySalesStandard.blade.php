@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
    <title>Monthly Sales Standard</title>
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
                <h5 style="margin: 0px 0px" class="text-center">Monthly Delivery By Customer
                    {{ \Carbon\Carbon::parse($date)->format('F') }} - {{ $date->year }}</h5>
            </div>
            <div class="col-1">
                <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
            </div>
            <div class="col-2">

                <input type="date" value="{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}" id="searchInput"
                    class="form-control" />

            </div>
            <div class="col-6">
                <button id="searchButton" onClick="Search()" class="btn btn-sm btn-primary"><i class="fa fa-search"></i>
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
                </tr>
            @endforeach
            @if($InvResults->count() > 0)<tr>
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
            </tr>
            @else
            <p class="text-center">No data available in table</p>
        @endif
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
                searching: false,
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
        function printPage() {
            console.log('print  page');
            window.print();
        }

        function Search() {
            let date = document.getElementById('searchInput').value;
            console.log(date);
            window.location.href = "{{ url('/accountReport/monthlySalesStandard') }}/" + date;
        }
    </script>
@endsection

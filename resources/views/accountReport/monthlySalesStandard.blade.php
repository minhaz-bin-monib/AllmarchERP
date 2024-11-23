@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
    <title>Monthly Sales Standard</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->



    <div class="px-4">
        <div class="row">

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
                @endphp
                @foreach ($InvResults as $salesInv)
                    @php
                        $totalCost = 0;
                        $totalWeight = 0;
                    @endphp
                    <thead> 
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
                    <tr >
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
                            $grandTotal += $totalCost;
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
                        <td>{{number_format( $totalCost,2) }}</td>
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
                <tr>
                    <td> </td>
                    <td><b>Total:</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>{{ number_format($grandTotal,2) }}</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
       // let table = new DataTable('#myTable');
        let table = new DataTable('#myTable', {
            paging: false, // Show all rows
            sortable: false, // Allow sorting
            ordering: false
        });

        function printPage() {
            console.log('print  page');
            window.print();
        }

        function Search() {
            let date = document.getElementById('searchInput').value;
            console.log(date);
            window.location.href = "{{ url('/accountReport/lastMonthSales') }}/" + date;
        }
    </script>


    <!-- END View Content Here -->
@endsection

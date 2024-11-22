@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
    <title>Products</title>
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
                <h5 style="margin: 0px 0px" class="text-center">Product Sales this
                    {{ \Carbon\Carbon::parse($date)->format('F') }} - {{ $date->year }}</h5>
            </div>
            <div class="col-1">
                <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
            </div>
            <div class="col-2">

                <input type="date"  value="{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}" id="searchInput" class="form-control" />

            </div>
            <div class="col-6">
                <button id="searchButton" onClick="Search()" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Search</button>

            </div>
            <div class="col-4">
                <p style="margin: 0px 0px" class="text-end"><b>Print Date: {{ date('d-m-Y') }}</b></p>
            </div>
        </div>


        <table id="myTable" class="table-bordered">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Month</th>
                    <th>Customer Name</th>
                    <th>Total Sales Value</th>
                    <th>Total Special Cost</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($salesInvoice as $salesInv)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($salesInv->invoice_date)->format('F') }}</td>
                        <td>{{ $salesInv->customer_name }}</td>
                        <td>{{ $salesInv->totalSales }}</td>

                        <td>{{ 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
        // let table = new DataTable('#myTable');
        let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [
                [0, 'asc']
            ], // Maintain initial order based on first column
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

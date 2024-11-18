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
                <h5 style="margin: 0px 0px" class="text-center">Product Sales By Need to work October-2024</h5>
            </div>
            <div class="col-1">
                <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
            </div>
            <div class="col-12">
                <p style="margin: 0px 0px" class="text-end"><b>Print Date: </b></p>
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
                @foreach ($products as $prod)
                    <tr>
                        <td style="width: 6%">{{ $prod->product_id }}</td>
                        <td style="width: 5%">
                            <a class="" href="{{ url('/product/edit') }}/{{ $prod->product_id }}"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td>{{ $prod->product_name }}</td>
                        <td>{{ $prod->product_unit_price }}</td>
                        <td>{{ $prod->registration_date }}</td>
                        <td style="width: 7%">
                            <a
                                class="btn btn-sm btn-danger"onClick="confirmDelete('{{ url('/product/delete') }}/{{ $prod->product_id }}')"><i
                                    class="fa fa-trash"></i></a>
                        </td>
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
                [0, 'desc']
            ], // Maintain initial order based on first column
        });

        function printPage() {
            console.log('print  page');
            window.print();
        }
    </script>


    <!-- END View Content Here -->
@endsection

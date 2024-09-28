@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container">
        
        <h5>Customers</h5>
    
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Edit</th>
                    <th>Customer Name</th>
                    <th>Referred By</th>
                    <th>Customer Phone</th>
                    <th>Customer Address</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $cust)
                    <tr>
                        <td style="width: 6%">{{ $cust->customer_id }}</td>
                        <td style="width: 5%">
                            <a class="" href="{{ url('/customer/edit') }}/{{ $cust->customer_id }}"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>{{ $cust->customer_name }}</td>
                        <td>{{ $cust->customer_referred_by }}</td>
                        <td>{{ $cust->customer_phone }}</td>
                        <td>{{ $cust->customer_address }}</td>
                        <td>{{ $cust->registration_date }}</td>
                        <td style="width: 10%">
                            <a class="btn btn-sm btn-danger"onClick="confirmDelete('{{ url('/customer/delete') }}/{{ $cust->customer_id }}')" ><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">

        let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [[0, 'desc']], // Maintain initial order based on first column
        });
       // let table = new DataTable('#myTable');

        function confirmDelete(url) {
                    if (confirm("Want to delete this item?")) {
                        window.location.href = url;
                    }
                }
    </script>


    <!-- END View Content Here -->
@endsection

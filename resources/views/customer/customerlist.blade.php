@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <h5>Customers</h5>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#SL</th>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cust->customer_name }}</td>
                    <td>{{ $cust->customer_referred_by }}</td>
                    <td>{{ $cust->customer_phone }}</td>
                    <td>{{ $cust->customer_address }}</td>
                    <td>{{ $cust->registration_date }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ url('/customer/edit') }}/{{ $cust->customer_id }}">Edit</a>
                        <a class="btn btn-danger" href="{{ url('/customer/delete') }}/{{ $cust->customer_id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- END View Content Here -->
@endsection

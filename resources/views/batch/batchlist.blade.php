@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Products</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container">
        <h5>Products</h5>

       
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#SL</th>
                    <th>Product Name</th>
                    <th>Customer Name</th>
                    <th>Batch Title</th>
                    <th>Batch No</th>
                    <th>production</th>
                    <th>Expire</th>
                    <th>Created Batch</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($batchs as  $btc)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$btc->product_id}}</td>
                    <td>{{$btc->customer_id}}</td>
                    <td>{{$btc->batch_title}}</td>
                    <td>{{$btc->batch_no}}</td>
                    <td>{{$btc->production_date}}</td>
                    <td>{{$btc->expire_date}}</td>
                    <td>{{$btc->registration_date}}</td>
                    {{-- <td> 
                       <a class="btn btn-primary" href="{{url('/batch/edit')}}/{{$btc->batch_id}}">Edit</a> 
                       <a class="btn btn-danger" href="{{url('/batch/delete')}}/{{$btc->batch_id}}">Delete</a> 
                    </td> --}}
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
   

    <!-- END View Content Here -->
@endsection
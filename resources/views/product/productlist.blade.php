@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Products</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
      
        <h5>Products</h5>

       
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#SL</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as  $prod)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$prod->product_name}}</td>
                    <td>{{$prod->product_unit_price}}</td>
                    <td>{{$prod->action_date}}</td>
                    <td> 
                       <a class="btn btn-primary" href="{{url('/product/edit')}}/{{$prod->product_id}}">Edit</a> 
                       <a class="btn btn-danger" href="{{url('/product/delete')}}/{{$prod->product_id}}">Delete</a> 
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
   

    <!-- END View Content Here -->
@endsection
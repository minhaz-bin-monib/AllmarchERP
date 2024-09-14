@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Products</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container">
        
        <h5>Sales Invoice List</h5>

       
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#SL</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesInvoices as  $slesInv)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    
                    <td>{{$slesInv->registration_date}}</td>
                    <td> 
                       <a class="btn btn-primary" href="{{url('/salesInvoice/edit')}}/{{$prod->salesInvoice_id}}">Edit</a> 
                       <a class="btn btn-danger" href="{{url('/salesInvoice/delete')}}/{{$prod->salesInvoice_id}}">Delete</a> 
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
   
    </div>

    <!-- END View Content Here -->
@endsection
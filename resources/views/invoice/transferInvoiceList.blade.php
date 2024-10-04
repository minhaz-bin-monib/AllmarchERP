@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Invoice List</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container">
        
        <h5>Transfer Invoice List</h5>

       
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Edit</th>
                    <th>Customer Name</th>
                    <th>Discount(%)</th>
                    <th>Invoice Type</th>
                    <th>Created</th>
                    <th>Invoice Date</th>
                    <th>Delivery By</th>
                    <th>Reference</th>
                    <th>Remark</th>
                    <th>Company</th>
                    <th>Statement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transferInvoices as  $transferInv)
                <tr>
                    <td>{{$transferInv->transferInvoice_id}}</td>
                    <td> 
                        @php
                            $type = match($transferInv->invoice_type_category) {
                                'Transfer' => 'transfer',
                                default => null,
                            };
                         @endphp
                    
                        <a class="" href="{{ url("/{$type}Invoice/edit/{$transferInv->transferInvoice_id}") }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td>{{$transferInv->customer_name}}</td>
                    <td>{{$transferInv->discount}} %</td>
                    <td>{{$transferInv->invoice_type}}</td>
                    <td>{{$transferInv->registration_date}}</td>
                    <td>{{$transferInv->invoice_date}}</td>
                    <td>{{$transferInv->delivery_by}}</td>
                    <td>{{$transferInv->order_ref}}</td>
                    <td>{{$transferInv->remark}}</td>
                    {{-- <td>{{$transferInv->Company}}</td> --}}
                    <td>All-March Bangladesh</td>
                   
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ url("/{$type}Invoice/customerStatemnetInvoices/{$transferInv->transferInvoice_id}/{$transferInv->customer_id}") }}" target="_blank">Statement</a>
                    </td>
                    <td>
                    <a class="btn btn-sm btn-danger" 
                                        onClick="confirmDelete('{{ url('/transferInvoice/delete') }}/{{ $transferInv->transferInvoice_id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>   
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
    //let table = new DataTable('#myTable');

        function confirmDelete(url) {
                    if (confirm("Want to delete this item?")) {
                        window.location.href = url;
                    }
                }
    </script>

    <!-- END View Content Here -->
@endsection
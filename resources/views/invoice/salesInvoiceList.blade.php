@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Products</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container">
        
        <h5>Sales Invoice List</h5>

       
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Invoice No</th>
                    <th>Edit</th>
                    <th>Discount(%)</th>
                    <th>Invoice Type</th>
                    <th>Created</th>
                    <th>Invoice Date</th>
                    <th>Delivery By</th>
                    <th>Reference</th>
                    <th>Remark</th>
                    <th>Company</th>
                    <th>Print Invoice</th>
                    <th>Print Delivery Receipt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesInvoices as  $slesInv)
                <tr>
                    <td>{{$slesInv->salesInvoice_id}}</td>
                    <td> 
                        @php
                            $type = match($slesInv->invoice_type_category) {
                                'Sales' => 'sales',
                                'Sample' => 'sample',
                                'Loan' => 'loan',
                                default => null,
                            };
                         @endphp
                    
                        <a class="" href="{{ url("/{$type}Invoice/edit/{$slesInv->salesInvoice_id}") }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td>{{$slesInv->discount}} %</td>
                    <td>{{$slesInv->invoice_type}}</td>
                    <td>{{$slesInv->registration_date}}</td>
                    <td>{{$slesInv->invoice_date}}</td>
                    <td>{{$slesInv->delivery_by}}</td>
                    <td>{{$slesInv->order_ref}}</td>
                    <td>{{$slesInv->remark}}</td>
                    <td>{{$slesInv->Company}}</td>
                    <td>
                   
                        <a class="btn btn-sm btn-primary" href="{{ url("/{$type}Invoice/{$type}CustomerInvoicePdf/{$slesInv->salesInvoice_id}") }}" target="_blank">Invoice</a>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ url("/{$type}Invoice/{$type}DeliveryInvoicePdf/{$slesInv->salesInvoice_id}") }}" target="_blank">Delivery</a>
                    </td>
                    <td>
                    <a class="btn btn-sm btn-danger" 
                                        onClick="confirmDelete('{{ url('/salesInvoice/delete') }}/{{ $slesInv->salesInvoice_id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>   
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
   
    </div>

    <script type="text/javascript">

    let table = new DataTable('#myTable');

        function confirmDelete(url) {
                    if (confirm("Want to delete this item?")) {
                        window.location.href = url;
                    }
                }
    </script>

    <!-- END View Content Here -->
@endsection
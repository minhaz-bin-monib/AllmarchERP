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
                    <th>Invoice Date</th>
                    <th>Delivery Date</th>
                    <th>Company</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Order No</th>
                    <th>Amount (USD)</th>
                    <th>Amount (BDT)</th>
                    <th>Statement</th>
                    {{-- <th>Action</th> --}}
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
                            $totalQuntity = $transferInv->packing * $transferInv->no_of_packing;
                            $totalAmountUSD  = $totalQuntity * $transferInv->unit_price;
                            $totalAmountBDT = $totalAmountUSD * 120;
                         @endphp
                    
                        <a class="" href="{{ url("/{$type}Invoice/edit/{$transferInv->transferInvoice_id}") }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td>{{$transferInv->invoice_date}}</td>
                    <td>{{$transferInv->delivery_date}}</td>
                    <td>
                        @if($transferInv->company == 'Allmarch Bangladesh')
                            All-March Bangladesh Ltd.
                        @elseif($transferInv->company == 'Allmarch International')
                            M/S. Allmarch International.
                        @endif
                    </td>
                    <td>{{$transferInv->customer_name}}</td>
                    <td>{{$transferInv->product_name}} 
                        ({{$transferInv->packing}}x{{$transferInv->no_of_packing}}={{$totalQuntity}}) 
                        //{{$transferInv->unit_price}} Tk</td>
                    <td>{{$transferInv->proforma_invoice}}</td>
                    <td>{{number_format($totalAmountUSD,2)}}</td>
                    <td>{{number_format($totalAmountBDT,2)}} DO</td>
                    {{-- <td>{{$transferInv->Company}}</td> --}}
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ url("/{$type}Invoice/customerStatemnetInvoices/{$transferInv->transferInvoice_id}/{$transferInv->customer_id}") }}" target="_blank">Statement</a>
                    </td>
                    {{-- <td>
                    <a class="btn btn-sm btn-danger" 
                                        onClick="confirmDelete('{{ url('/transferInvoice/delete') }}/{{ $transferInv->transferInvoice_id }}')">
                                        <i class="fa fa-trash"></i>
                                    </a>   
                    </td> --}}
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
@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Invoice List</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">

        {{-- <h5>Sales Invoice List</h5> --}}


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
                    <th>Print Invoice</th>
                    <th>Print Delivery Receipt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesInvoices as $slesInv)
                    <tr>
                        <td>{{ $slesInv->salesInvoice_id }}</td>
                        <td>
                            @php
                                $type = match ($slesInv->invoice_type_category) {
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
                        <td>{{ $slesInv->customer_name }}</td>
                        <td>{{ $slesInv->discount }} %</td>
                        <td>{{ $slesInv->invoice_type }}</td>
                        <td>{{ $slesInv->registration_date }}</td>
                        <td>{{ $slesInv->invoice_date }}</td>
                        <td>{{ $slesInv->nick_name }}</td>
                        <td>{{ $slesInv->order_ref }}</td>
                        <td>{{ $slesInv->remark }}</td>
                       
                        <td>
                            @php
                                $companyName = match ($slesInv->company) {
                                    'Allmarch Bangladesh' => 'All-March Bangladesh',
                                    'Allmarch International' => 'All-March International',
                                    'Believers International' => 'Believers International',
                                    default => null,
                                };
                            @endphp
                            {{ $companyName}}
                        </td>
                        <td>

                            <a class="btn btn-sm btn-primary"
                                href="{{ url("/{$type}Invoice/{$type}CustomerInvoicePdf/{$slesInv->salesInvoice_id}") }}"
                                target="_blank">Invoice</a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                                href="{{ url("/{$type}Invoice/{$type}DeliveryInvoicePdf/{$slesInv->salesInvoice_id}") }}"
                                target="_blank">Delivery</a>
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

    document.getElementById('PageName').innerText = 'Sales Invoice List';
    
    let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [
                [0, 'desc']
            ], // Maintain initial order based on first column
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

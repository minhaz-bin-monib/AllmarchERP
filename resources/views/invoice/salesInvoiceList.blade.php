@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Invoice List</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container-fluid mt-4 px-2">

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
                                    'Exchange' => 'exchange',
                                    'Demo' => 'demo',
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
                            @php
                                $convertTarget = null;
                                $convertTitle = null;
                                if ($slesInv->invoice_type_category === 'Sales') {
                                    $convertTarget = 'Demo';
                                    $convertTitle = 'Convert Sales to Demo';
                                } elseif ($slesInv->invoice_type_category === 'Demo') {
                                    $convertTarget = 'Sales';
                                    $convertTitle = 'Convert Demo to Sales';
                                }
                            @endphp

                            @if ($convertTarget)
                                <a class="btn btn-sm " title="{{ $convertTitle }}"
                                    onClick="convertInvoiceCategoryType('{{ $slesInv->salesInvoice_id }}', '{{ $convertTarget }}', '{{ $slesInv->invoice_type_category }}')">
                                    <i class="fa fa-exchange"></i>
                                </a>
                            @endif

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

    <!-- Convert Modal -->
    <div class="modal fade" id="convertModal" tabindex="-1" role="dialog" aria-labelledby="convertModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="convertModalLabel">Convert Invoice Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2" id="convertModalText"></p>
                    <label for="convertRemark">Remark (optional)</label>
                    <input type="text" id="convertRemark" class="form-control" placeholder="Add remark">
                    <input type="hidden" id="convertInvoiceId">
                    <input type="hidden" id="convertCategoryType">
                    <input type="hidden" id="convertCurrentType">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="convertSubmitBtn">Convert</button>
                </div>
            </div>
        </div>
    </div>

        <style>
        .convert-type {
            font-weight: 700;
            font-size: 1.1rem;
        }
        .convert-arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.6rem;
            height: 1.6rem;
            border-radius: 999px;
            background: #eef1ff;
            color: #3b5bdb;
            font-weight: 700;
            font-size: 1rem;
        }
    </style>
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

        const convertInvoiceCategoryBaseUrl = "{{ url('/salesInvoice/convertInvoiceCategoryType') }}";
        const convertModalEl = document.getElementById('convertModal');
        let convertModalLastFocus = null;
        if (convertModalEl) {
            convertModalEl.addEventListener('hidden.bs.modal', function () {
                if (convertModalLastFocus && typeof convertModalLastFocus.focus === 'function') {
                    convertModalLastFocus.focus();
                }
                convertModalLastFocus = null;
            });
        }
        function convertInvoiceCategoryType(invoiceId, categoryType, currentType) {
            convertModalLastFocus = document.activeElement;
            document.getElementById('convertInvoiceId').value = invoiceId;
            document.getElementById('convertCategoryType').value = categoryType;
            document.getElementById('convertCurrentType').value = currentType;
            document.getElementById('convertModalText').innerHTML =
                `<strong>Invoice #${invoiceId}</strong> <span class="mx-3">:</span>
                 <span class="convert-type">${currentType}</span>
                 <span class="mx-3 convert-arrow">&rarr;</span>
                 <span class="convert-type">${categoryType}</span>`;
            document.getElementById('convertRemark').value = '';
            if (convertModalEl && window.bootstrap && bootstrap.Modal) {
                const modal = bootstrap.Modal.getOrCreateInstance(convertModalEl);
                modal.show();
            }
        }

        document.getElementById('convertSubmitBtn').addEventListener('click', function () {
            const invoiceId = document.getElementById('convertInvoiceId').value;
            const categoryType = document.getElementById('convertCategoryType').value;
            const remark = document.getElementById('convertRemark').value || '';
            const trimmedRemark = remark.trim();
            const remarkParam = trimmedRemark === '' ? '__EMPTY__' : encodeURIComponent(trimmedRemark);
            window.location.href = `${convertInvoiceCategoryBaseUrl}/${invoiceId}/${categoryType}/${remarkParam}`;
        });
    </script>

    <!-- END View Content Here -->
@endsection


@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Add Loan Invoice</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{ $toptitle }}</h5> --}}
        <form action="{{ $url }}" method="post">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="registration_date">Registration Date <span class="text-danger"><b>*</b></span></label>
                    <input type="date" name="registration_date"
                        value="{{ old('registration_date', $salesInvoice->registration_date) }}" class="form-control"
                        id="registration_date">
                    <span class="text-danger">
                        @error('registration_date')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4"
                    style="{{ $salesInvoice->salesInvoice_id > 0 ? 'border-bottom: 1px solid #ddd;' : '' }}">
                    <label for="customer_id"> Select Customer <span class="text-danger"><b>*</b></span></label>
                    <select data-live-search="true" id="customers" name="customer_id"
                        {{ $salesInvoice->salesInvoice_id > 0 ? 'disabled' : '' }} class="form-control">
                        <option value="" selected="">Select</option>
                    </select>
                    <span class="text-danger">
                        @error('customer_id')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="customer_id">Batch</label>
                    <select id="existingBatchItems" name="batch_id" class="form-control text-primary">
                        <option value="" selected="">Select</option>
                    </select>
                    <span class="text-danger">
                        @error('batch_id')
                            {{ $message }}
                        @enderror
                    </span>

                </div>
                <div class="form-group col-md-1">
                    <label for="customer_id"><small> Manage Batch </small></label>

                    <a class="mt-1" href="{{ url('batch/create') }}"><i style="font-size: 29px;"
                            class="fa fa-external-link" aria-hidden="true"></i></a>

                </div>
                <div class="form-group col-md-3">
                    <label for="product_id"> Select Product <span class="text-danger"><b>*</b></span></label>
                    <select data-live-search="true" id="products" name="product_id" class="form-control">
                        <option value="" selected="">Select</option>

                    </select>
                    <span class="text-danger">
                        @error('product_id')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="manufacturer_id"> Manufacturer </label>
                    <select id="manufacturer_id" name="manufacturer_id" class="form-control">
                        {{-- <option value="" selected="">Select</option> --}}
                        <option value="1"
                            {{ old('manufacturer_id', $salesInvoice->manufacturer_id) == '1' ? 'selected' : '' }}>Turan
                            Kimya</option>
                        <option value="2"
                            {{ old('manufacturer_id', $salesInvoice->manufacturer_id) == '2' ? 'selected' : '' }}>Nanoprint
                        </option>
                        <option value="3"
                            {{ old('manufacturer_id', $salesInvoice->manufacturer_id) == '3' ? 'selected' : '' }}>Impex
                        </option>

                    </select>
                    <span class="text-danger">
                        @error('manufacturer_id')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="order_ref">Loan Type <span class="text-danger"><b></b></span></label>
                    {{-- <input type="text" name="order_ref" value="{{ old('order_ref', $salesInvoice->order_ref) }}"
                        class="form-control" id="order_ref"> --}}
                    <select id="order_ref" name="order_ref" class="form-control">
                        <option value="Loan Against L/C"
                            {{ old('order_ref', $salesInvoice->order_ref) == 'Loan Against L/C' ? 'selected' : '' }}>Loan
                            Against L/C</option>
                        <option value="Loan Return"
                            {{ old('order_ref', $salesInvoice->order_ref) == 'Loan Return' ? 'selected' : '' }}>Loan
                            Return</option>
                        <option value="As Loan"
                            {{ old('order_ref', $salesInvoice->order_ref) == 'As Loan' ? 'selected' : '' }}>As Loan
                        </option>
                    </select>
                    <span class="text-danger">
                        @error('order_ref')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="batch_no">Batch No <span class="text-danger"><b>*</b></span></label>
                    <input type="text" name="batch_no" value="{{ old('batch_no', $salesInvoice->batch_no) }}"
                        class="form-control" id="batch_no">
                    <span class="text-danger">
                        @error('batch_no')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group col-md-3">
                    <label for="packing">Packing <span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="packing" min="0" step="0.01"
                        value="{{ old('packing', $salesInvoice->packing) }}" class="form-control" id="packing">
                    <span class="text-danger">
                        @error('packing')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="no_of_packing">No of Packing <span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="no_of_packing" min="0" step="0.01"
                        value="{{ old('no_of_packing', $salesInvoice->no_of_packing) }}" class="form-control"
                        id="no_of_packing">
                    <span class="text-danger">
                        @error('no_of_packing')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3 tooltip-container tooltip-right" id="rightTooltip">
                    <div id="tooltipText" class="tooltip-text"></div>
                    <label for="unit_price">Unit price<span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="unit_price" min="0.0" step="0.01"
                        value="{{ old('unit_price', $salesInvoice->unit_price) }}" class="form-control" id="unit_price">
                    <span class="text-danger">
                        @error('unit_price')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="invoice_date">Invoice Date<span class="text-danger"><b>*</b></span></label>
                    <input type="date" name="invoice_date"
                        value="{{ old('invoice_date', $salesInvoice->invoice_date) }}" class="form-control"
                        id="invoice_date">
                    <span class="text-danger">
                        @error('invoice_date')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="delivery_by"> Delivery By </label>
                    <select id="delivery_by" name="delivery_by" class="form-control">
                        @foreach ($employeeslist as $emp)
                            <option value="{{ $emp['employee_id'] }}"
                                {{ old('delivery_by', $salesInvoice->delivery_by) == $emp['employee_id'] ? 'selected' : '' }}>
                                {{ $emp['nick_name'] }}
                            </option>
                        @endforeach
                    </select>
                    <span class="text-danger">
                        @error('delivery_by')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="remark">Remark</label>
                    <input type="text" name="remark" value="{{ old('remark', $salesInvoice->remark) }}"
                        class="form-control" id="remark">
                    <span class="text-danger">
                        @error('remark')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="discount">Discount (%)</label>
                    <input type="text" name="discount" value="{{ old('discount', $salesInvoice->discount) }}"
                        class="form-control" id="discount">
                    <span class="text-danger">
                        @error('discount')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3 mt-4">
                    <label for="enable_discount">Enable Discount (%)</label> &nbsp;
                    <input type="hidden" name="enable_discount" value="0">
                    <input type="checkbox" name="enable_discount" value="1"
                        {{ old('enable_discount', $salesInvoice->enable_discount) ? 'checked' : '' }}
                        id="enable_discount"> <span class="text-danger">
                        @error('enable_discount')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="company"> Company <span class="text-danger"><b></b></span></label>
                    <select data-live-search="true" id="company" name="company" class="form-control">
                        {{-- <option value="" {{ old('company', $transferInvoice->company) == '' ? 'selected' : '' }}>Select</option> --}}
                        <option value="Allmarch Bangladesh"
                            {{ old('company', $salesInvoice->company) == 'Allmarch Bangladesh' ? 'selected' : '' }}>
                            All-March Bangladesh Ltd.</option>
                        <option value="Allmarch International"
                            {{ old('company', $salesInvoice->company) == 'Allmarch International' ? 'selected' : '' }}>M/S.
                            Allmarch International.</option>
                        <option value="Believers International"
                            {{ old('company', $salesInvoice->company) == 'Believers International' ? 'selected' : '' }}>
                            Believers International</option>
                    </select>
                    <span class="text-danger">
                        @error('company')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="col-9"></div>



                @if ($salesInvoice->salesInvoice_id > 0)
                    <button type="submit" class="btn btn-sm btn-primary mx-2">Add Product</button>
                    {{-- <button type="submit" class="btn btn-sm btn-primary">Update Invoice</button> --}}
                @else
                    <button type="submit" class="btn btn-sm btn-primary">Create Invoice with Product</button>
                @endif
            </div>
        </form>

        @if ($salesInvoice->salesInvoice_id)
            <div class="row mt-2">
                <div class="col-4">
                </div>
                <div class="col-4">
                    {{-- <input type="checkbox" /> Batch Number &nbsp;
                    <input type="checkbox" /> Seal Signature --}}
                </div>
                <div class="col-4">
                    {{-- <select name="" id="" class="form-control">
                        <option value="">All-March Bangladesi</option>
                        <option value="">All-March International</option>
                        <option value="">All-March Need to work</option>
                    </select> --}}
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Product Name</th>
                        <th>Batch No</th>
                        <th>Packing Size</th>
                        <th>No of packing</th>
                        <th>Total Quantity</th>
                        <th>Unit price(Tk)</th>
                        <th>Total Price(Tk)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalCost = 0;
                    @endphp
                    @foreach ($salesInvoiceProduct as $salesInvProd)
                        @php
                            $totalWeight = $salesInvProd->packing * $salesInvProd->no_of_packing;
                            $totalPrice = $totalWeight * $salesInvProd->unit_price;
                            $totalCost += $totalPrice;
                        @endphp
                        <tr>
                            <td>{{ $salesInvProd->salesInvoiceProduct_id }}</td>
                            <td>{{ $salesInvProd->product_name }}</td>
                            <td>{{ $salesInvProd->batch_no }}</td>
                            <td>{{ $salesInvProd->packing }} Kg</td>
                            <td>{{ $salesInvProd->no_of_packing }}</td>
                            <td>{{ $totalWeight }} kg</td>
                            <td>{{ $salesInvProd->unit_price }}</td>
                            <td>{{ $totalPrice }}
                            </td>
                            <td>
                                <a class="" target="_blank"
                                    href="{{ url('/salesInvoice/productStickar') }}/{{ $salesInvProd->salesInvoice_id }}/{{ $salesInvProd->salesInvoiceProduct_id }}">Special</a>
                                <a class="btn btn-sm btn-danger"
                                    onClick="confirmDelete('{{ url('/loanInvoice/productDelete') }}/{{ $salesInvProd->salesInvoice_id }}/{{ $salesInvProd->salesInvoiceProduct_id }}')">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>Gross Amount</b></td>
                        <td>{{ $totalCost }} Tk</td>
                        <td rowspan="5" style="vertical-align : middle;text-align:center;">
                            {{-- <button class="btn btn-sm btn-primary">Make Payment</button> --}}
                        </td>
                    </tr>
                    <tr>
                        @php
                            // Calculate discount and final total cost

                            $discount = $salesInvoice->enable_discount ? $salesInvoice->discount ?? 0.0 : 0.0;
                            $discountAmount = $totalCost * ($discount / 100) ?? 0.0; // Calculate the discount amount
                            $finalTotalCost = $totalCost - $discountAmount ?? 00; // Final cost after discount
                        @endphp
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Discount Cash Purchase [
                            {{ $totalCost != 0 ? number_format($salesInvoice->discount ?? 0.0, 2) : 0.0 }} %]</td>
                        <td>{{ $discountAmount == 0 ? '' : '-' }}{{ number_format($discountAmount, 2) }} Tk</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Net Amount</td>
                        <td>{{ number_format($finalTotalCost, 2) }} Tk</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Paid Amount</td>
                        <td>0.00 Tk</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Payable</td>
                        <td>{{ number_format($finalTotalCost, 2) }} Tk</td>

                    </tr>
                </tbody>
            </table>
            <div class="row">
                @php
                    $amountParts = explode('.', number_format($finalTotalCost, 2, '.', ''));
                    $integerPart = $converter->toWords($amountParts[0]);
                    $decimalPart = isset($amountParts[1]) ? $converter->toWords($amountParts[1]) : 'zero';
                @endphp
                <p>In Word: {{ ucwords("{$integerPart} Taka & {$decimalPart} Paisa ") }} Only</p>
            </div>
            <div class="row">
                <div class="col-2">
                    <a class="btn btn-sm btn-primary"
                        href="{{ url('/loanInvoice/loanCustomerInvoicePdf') }}/{{ $salesInvoice->salesInvoice_id }}"
                        target="_blank">Loan Invoice</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-sm btn-primary"
                        href="{{ url('/loanInvoice/loanDeliveryInvoicePdf') }}/{{ $salesInvoice->salesInvoice_id }}"
                        target="_blank">Loan Delivery</a>
                </div>
                <div class="col-2">
                    {{-- <button class="btn btn-sm btn-primary">Small</button> --}}
                </div>
                <div class="col-2">
                    <a class="btn btn-sm btn-primary"
                        href="{{ url('/loanInvoice/loanSpecialInvoicePdf') }}/{{ $salesInvoice->salesInvoice_id }}"
                        target="_blank">Special Invoice</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-sm btn-primary"
                        href="{{ url('/loanInvoice/loanSpecialDeliveryInvoicePdf') }}/{{ $salesInvoice->salesInvoice_id }}"
                        target="_blank">Special Delivery</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-sm btn-primary"
                        href="{{ url('/loanInvoice/loanSpeicalCalculateInvoicePdf') }}/{{ $salesInvoice->salesInvoice_id }}"
                        target="_blank">Special Calculate</a>
                </div>
            </div>
        @endif
    </div>

    <script type="text/javascript">
        let productList = [];
        let customerList = [];
        let batchList = [];
        let selectedCustomerId = "{{ old('customer_id', $salesInvoice->customer_id ?? '') }}";
        let selectedProductId = "{{ old('product_id', $salesInvoice->product_id ?? '') }}";
        let selectedBatchId = "{{ old('batch_id', $salesInvoice->batch_id ?? '') }}";
        let productIdByOnChange = selectedProductId ?? '';
        let customerIdByOnchange = selectedCustomerId ?? '';

        document.getElementById('PageName').innerText = '{{ $toptitle }}';

        function confirmDelete(url) {
            if (confirm("Want to delete this item?")) {
                window.location.href = url;
            }
        }
        $(document).ready(function() {
            $('#customers').selectpicker();
            $('#products').selectpicker();
            $.ajax({
                url: "{{ url('/customer/getList') }}",
                method: 'GET',
                success: function(data) {

                    customerList = data;

                    // Clear existing options
                    $('#customers').empty();

                    // Append an empty option first
                    $('#customers').append('<option value="">Select a customer</option>');

                    // Loop through customer list and append options
                    $.each(customerList, function(key, customer) {
                        let isSelected = customer.customer_id == selectedCustomerId ?
                            'selected' : '';
                        $('#customers').append('<option value="' + customer.customer_id + '" ' +
                            isSelected + '>' +
                            customer.customer_name + '</option>');
                    });
                    $('#customers').selectpicker('refresh');
                }
            });

            $.ajax({
                url: "{{ url('/product/getList') }}",
                method: 'GET',
                success: function(data) {
                    productList = data;

                    // Clear existing options
                    $('#products').empty();

                    // Append an empty option first
                    $('#products').append('<option value="">Select a product</option>');

                    // Loop through the product list and append options
                    $.each(productList, function(key, product) {
                        let isSelected = product.product_id == selectedProductId ? 'selected' :
                            '';
                        $('#products').append('<option value="' + product.product_id + '" ' +
                            isSelected + '>' +
                            product.product_name + '</option>');
                    });
                    $('#products').selectpicker('refresh');
                }
            });


            $('#products').on('change', function() {
                var productId = $(this).val();
                productIdByOnChange = productId;

                let product = productList.find(f => f.product_id == productId);

                $('#packing').val(product.product_packing);
                $('#unit_price').val(product.product_unit_price);
                $('#discount').text(product.atv_rate);

                getBatchById();

            });

            $('#customers').on('change', function() {
                var customerId = $(this).val();
                customerIdByOnchange = customerId;
                let customer = customerList.find(f => f.customer_id == customerId);
                $('#discount').val(customer.loyalty_discount);
                getBatchById();
            });



            $('#existingBatchItems').on('change', function() {
                var batchId = $(this).val();
                //debugger;
                if (batchId) {

                    let batchProduct = batchList.find(f => f.batch_id == batchId);
                    //console.log(batchProduct);

                    $('#batch_no').val(batchProduct.batch_no);

                }



            });

            // when first time load data then call it 
            if (selectedCustomerId && selectedProductId) {
                getBatchItems(selectedCustomerId, selectedProductId);
            }

            function getBatchById() {
                if (customerIdByOnchange && productIdByOnChange) {
                    getBatchItems(customerIdByOnchange, productIdByOnChange);
                }
            }

            function getBatchItems(customerId, productId) {
                
                $.ajax({
                    url: "{{ url('/batch/getBatchByCustomerAndProductId') }}/" + customerId + "/" +
                        productId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        batchList = data;

                        $('#existingBatchItems').empty();
                        $('#existingBatchItems').append(
                            '<option value="">Existing Batch List (' + data.length +
                            ')</option>');
                        $.each(data, function(key, item) {
                            let customer = customerList.find(f => f.customer_id ==
                                item.customer_id);

                            let isSelected = item.batch_id == selectedBatchId ? 'selected' :
                                '';

                            $('#existingBatchItems').append('<option ' + isSelected +
                                ' value="' + item
                                .batch_id + '">' +
                                item.batch_no + ', ' + item.production_date +
                                ', ' + item.expire_date + ', ' +
                                customer.customer_name + ', ' + item.remark +
                                '</option>');
                        });
                    }
                });
                getSalesPreviousItems(customerId, productId);
            }
             function getSalesPreviousItems(customerId, productId){
                 $.ajax({
                    url: "{{ url('/salesInvoice/salesPreviousList') }}/" + customerId + "/" +
                        productId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                                 
                        let prevSalesList = '';
                        let cnt = 1;
                        $.each(data, function(key, item) {
                           
                            if(cnt <= 10){
                                prevSalesList = prevSalesList + `${item.unit_price} tk [ ${item.invoice_date},  ${item.packing} x ${item.no_of_packing}  = ${item.packing * item.no_of_packing } ] ${item.invoice_type} | ${item.batch_no}, ${item.production_date}, ${item.expire_date} | ${item.nick_name} <br/>`;
                            }
                            else{
                                prevSalesList = prevSalesList + '....';
                            }
                            cnt++;
                        });

                        document.getElementById("tooltipText").innerHTML = prevSalesList; 

                    }
                });
            }
        });
    </script>

    <!-- END View Content Here -->
@endsection

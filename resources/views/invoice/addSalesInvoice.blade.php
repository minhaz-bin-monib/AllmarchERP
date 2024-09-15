@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Add Sales Invoice</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container">
        <h5>{{ $toptitle }}</h5>
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
                <div class="form-group col-md-4">
                    <label for="customer_id"> Select Customer <span class="text-danger"><b>*</b></span></label>
                    <select id="customers" name="customer_id" class="form-control">
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
                    <select id="products" name="product_id" class="form-control">
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
                        <option value="" selected="">Select</option>

                    </select>
                    <span class="text-danger">
                        @error('manufacturer_id')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="order_ref">Order Ref <span class="text-danger"><b>*</b></span></label>
                    <input type="text" name="order_ref" value="{{ old('order_ref', $salesInvoice->order_ref) }}"
                        class="form-control" id="order_ref">
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
                    <input type="number" name="packing" min="0"
                        value="{{ old('packing', $salesInvoice->packing) }}" class="form-control" id="packing">
                    <span class="text-danger">
                        @error('packing')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="no_of_packing">No of Packing <span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="no_of_packing" min="0"
                        value="{{ old('no_of_packing', $salesInvoice->no_of_packing) }}" class="form-control"
                        id="no_of_packing">
                    <span class="text-danger">
                        @error('no_of_packing')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-3">
                    <label for="unit_price">Unit price<span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="unit_price" min="0.0"
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
                        <option value="" selected="">Select</option>

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



                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>

        @if ($salesInvoice->salesInvoice_id)
            <div class="row mt-2">
                <div class="col-4">
                </div>
                <div class="col-4">
                    <input type="checkbox" /> Batch Number &nbsp;
                    <input type="checkbox" /> Seal Signature
                </div>
                <div class="col-4">
                    <select name="" id="" class="form-control">
                        <option value="">All-March Bangladesi</option>
                        <option value="">All-March International</option>
                        <option value="">All-March Need to work</option>
                    </select>
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

                    @foreach ($salesInvoiceProduct as $salesInvProd)
                        <tr>
                            <td>{{ $salesInvProd->salesInvoiceProduct_id }}</td>
                            <td>{{ $salesInvProd->product_id }}</td>
                            <td>{{ $salesInvProd->batch_no }}</td>
                            <td>{{ $salesInvProd->packing }} Kg</td>
                            <td>{{ $salesInvProd->no_of_packing }}</td>
                            <td>{{ $salesInvProd->packing * $salesInvProd->no_of_packing }} kg</td>
                            <td>{{ $salesInvProd->unit_price }}</td>
                            <td>{{ ($salesInvProd->packing + $salesInvProd->no_of_packing) * $salesInvProd->unit_price }}
                            </td>
                            <td>
                                <a class=""
                                    href="{{ url('/salesInvoice/edit') }}/{{ $salesInvProd->salesInvoice_id }}">Special</a>
                                <a href="{{ url('/salesInvoice/edit') }}/{{ $salesInvProd->salesInvoice_id }}">Delete</a>
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
                        <td>Gross Amount</td>
                        <td>2302029 Tk</td>
                        <td rowspan="5" style="vertical-align : middle;text-align:center;">
                            <button class="btn btn-sm btn-primary">Make Payment</button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Discount Cash Purchase [3.00 %]</td>
                        <td>-230 Tk</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Net Amount</td>
                        <td>23003933 Tk</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Paid Amount</td>
                        <td>23003933 Tk</td>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Payable</td>
                        <td>23003933 Tk</td>

                    </tr>
                </tbody>
            </table>
            <div class="row">
                <p>In Word: need to work</p>
            </div>
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-sm btn-primary">Customer Invoice</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-primary">Customer Delivery</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-primary">Small</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-primary">Special Invoice</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-primary">Special Delivery</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-primary">Special Calculate</button>
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
        let productIdByOnChange = '';
        let customerIdByOnchange = '';

        $(document).ready(function() {
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

            }
        });
    </script>

    <!-- END View Content Here -->
@endsection

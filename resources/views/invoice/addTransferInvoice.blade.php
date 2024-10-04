@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Add Transfer Invoice</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container">
        <h5>{{ $toptitle }}</h5>
        <div class="row">
            <div class="col-7">
                <form action="{{ $url }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="registration_date">Registration Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="registration_date"
                                value="{{ old('registration_date', $transferInvoice->registration_date) }}"
                                class="form-control" id="registration_date">
                            <span class="text-danger">
                                @error('registration_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customer_id"> Select Customer <span class="text-danger"><b>*</b></span></label>
                            <select data-live-search="true" id="customers" name="customer_id" class="form-control">
                                <option value="" selected="">Select</option>
                            </select>
                            <span class="text-danger">
                                @error('customer_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- <div class="form-group col-md-3">
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
        
                        </div> --}}
                        <div class="form-group col-md-6">
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
                        {{-- <div class="form-group col-md-6">
                            <label for="manufacturer_id"> Manufacturer </label>
                            <select id="manufacturer_id" name="manufacturer_id" class="form-control">
                                <option value="" selected="">Select</option>
        
                            </select>
                            <span class="text-danger">
                                @error('manufacturer_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="order_ref">Reference No <span class="text-danger"><b></b></span></label>
                            <input type="text" name="order_ref"
                                value="{{ old('order_ref', $transferInvoice->order_ref) }}" class="form-control"
                                id="order_ref">
                            <span class="text-danger">
                                @error('order_ref')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="proforma_invoice">Proforma Invoice<span class="text-danger"><b></b></span></label>
                            <input type="text" name="proforma_invoice"
                                value="{{ old('proforma_invoice', $transferInvoice->proforma_invoice) }}" class="form-control"
                                id="proforma_invoice">
                            <span class="text-danger">
                                @error('proforma_invoice')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="batch_no">Batch No <span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="batch_no" value="{{ old('batch_no', $transferInvoice->batch_no) }}"
                                class="form-control" id="batch_no">
                            <span class="text-danger">
                                @error('batch_no')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div> --}}

                        <div class="form-group col-md-6">
                            <label for="packing">Packing <span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="packing" 
                                value="{{ old('packing', $transferInvoice->packing) }}" class="form-control"
                                id="packing">
                            <span class="text-danger">
                                @error('packing')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_of_packing">No of Packing <span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="no_of_packing" 
                                value="{{ old('no_of_packing', $transferInvoice->no_of_packing) }}" class="form-control"
                                id="no_of_packing">
                            <span class="text-danger">
                                @error('no_of_packing')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit_price">Unit price<span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="unit_price" 
                                value="{{ old('unit_price', $transferInvoice->unit_price) }}" class="form-control"
                                id="unit_price">
                            <span class="text-danger">
                                @error('unit_price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="invoice_date">Proforma Invoice Date<span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="invoice_date"
                                value="{{ old('invoice_date', $transferInvoice->invoice_date) }}" class="form-control"
                                id="invoice_date">
                            <span class="text-danger">
                                @error('invoice_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="delivery_date">Commercial Invoice Date<span
                                    class="text-danger"><b>*</b></span></label>
                            <input type="date" name="delivery_date"
                                value="{{ old('delivery_date', $transferInvoice->delivery_date) }}" class="form-control"
                                id="delivery_date">
                            <span class="text-danger">
                                @error('delivery_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
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
                        <div class="form-group col-md-6">
                            <label for="remark">Remark</label>
                            <input type="text" name="remark" value="{{ old('remark', $transferInvoice->remark) }}"
                                class="form-control" id="remark">
                            <span class="text-danger">
                                @error('remark')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="discount">Discount (%)</label>
                            <input type="text" name="discount"
                                value="{{ old('discount', $transferInvoice->discount) }}" class="form-control"
                                id="discount">
                            <span class="text-danger">
                                @error('discount')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <label for="enable_discount">Enable Discount (%)</label> &nbsp;
                            <input type="hidden" name="enable_discount" value="0">
                            <input type="checkbox" name="enable_discount" value="1"
                                {{ old('enable_discount', $transferInvoice->enable_discount) ? 'checked' : '' }}
                                id="enable_discount"> <span class="text-danger">
                                @error('enable_discount')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-12">

                            @if ($transferInvoice->transferInvoice_id > 0)
                                <button type="submit" class="btn btn-sm btn-primary mx-2">Add Product</button>
                                {{-- <button type="submit" class="btn btn-sm btn-primary">Update Invoice</button> --}}
                            @else
                                <button type="submit" class="btn btn-sm btn-primary">Create Invoice with Product</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-5" >
                <div class="row">
                    <div class="col-6" style="border: 1px solid #00800042">
                        <p class="text-center"><b>Existing Invoice</b></p>
                        <hr/>
                        <div class="mb-1">
                            <div class="">
                                <div>
                                    <input class=" fa-th form-control" style="border-radius:15px;" id="totalValue"
                                        name="totalValue" value="" onchange="calculatePriceAndNumberofPices(); transfer_history();"
                                        placeholder="Enter Total Value">
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="">
                                <div>
                                    <select class="form-control" style="border-radius:15px;" id="packingSize"
                                        name="packingSize" onchange="calculatePriceAndNumberofPices(); transfer_history();">
                                        <option value="40" selected="">40 KG</option>
                                        <option value="30">30 KG</option>
                                        <option value="20">20 KG</option>
                                        <option value="5">05 KG</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <div>
                                    <textarea id="calculatedFigure" rows="21" style="border-style:none;font-size:12px; width:100%"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style="border: 1px solid #0000ff3d">
                        <p class="text-center"><b>H i s t o r y</b></p>
                        <hr/>
                        <div class=""> 
                            <div class="">
                                <div style="font:Tahoma, Geneva, sans-serif; font-size:12px;">
                                    <textarea id="previousHistory" rows="25" style="border-style:none; width:100%;" disabled=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @if ($transferInvoice->transferInvoice_id)
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
                    @php
                        $totalCost = 0;
                    @endphp
                    @foreach ($transferInvoiceProduct as $salesInvProd)
                        @php
                            $totalWeight = $salesInvProd->packing * $salesInvProd->no_of_packing;
                            $totalPrice = $totalWeight * $salesInvProd->unit_price;
                            $totalCost += $totalPrice;
                        @endphp
                        <tr>
                            <td>{{ $salesInvProd->transferInvoiceProduct_id }}</td>
                            <td>{{ $salesInvProd->product_name }}</td>
                            <td>{{ $salesInvProd->batch_no }}</td>
                            <td>{{ $salesInvProd->packing }} Kg</td>
                            <td>{{ $salesInvProd->no_of_packing }}</td>
                            <td>{{ $totalWeight }} kg</td>
                            <td>{{ $salesInvProd->unit_price }}</td>
                            <td>{{ $totalPrice }}
                            </td>
                            <td>
                                <a class=""
                                    href="{{ url('/transferInvoice/productStickar') }}/{{ $salesInvProd->transferInvoice_id }}/{{ $salesInvProd->transferInvoiceProduct_id }}">Special</a>
                                <a class="btn btn-sm btn-danger"
                                    onClick="confirmDelete('{{ url('/transferInvoice/productDelete') }}/{{ $salesInvProd->transferInvoice_id }}/{{ $salesInvProd->transferInvoiceProduct_id }}')">
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
                            <button class="btn btn-sm btn-primary">Make Payment</button>
                        </td>
                    </tr>
                    <tr>
                        @php
                            // Calculate discount and final total cost

                            $discount = $transferInvoice->enable_discount ? $transferInvoice->discount ?? 0.0 : 0.0;
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
                            {{ $totalCost != 0 ? number_format($transferInvoice->discount ?? 0.0, 2) : 0.0 }} %]</td>
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
                <p>In Word: {{ $converter->toWords($finalTotalCost) }} only</p>
            </div>
            <div class="row">
                <div class="col-2">
                    <a class="btn btn-sm btn-primary"
                        href="{{ url('/transferInvoice/salesCustomerInvoicePdf') }}/{{ $transferInvoice->transferInvoice_id }}"
                        target="_blank">Customer Invoice</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-sm btn-primary"
                        href="{{ url('/transferInvoice/salesDeliveryInvoicePdf') }}/{{ $transferInvoice->transferInvoice_id }}"
                        target="_blank">Customer Delivery</a>
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
        let selectedCustomerId = "{{ old('customer_id', $transferInvoice->customer_id ?? '') }}";
        let selectedProductId = "{{ old('product_id', $transferInvoice->product_id ?? '') }}";
        let selectedBatchId = "{{ old('batch_id', $transferInvoice->batch_id ?? '') }}";
        let productIdByOnChange = selectedProductId ?? '';
        let customerIdByOnchange = selectedCustomerId ?? '';

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

            }
        });



        function calculatePriceAndNumberofPices() {
            var totalValue = $("#totalValue").val();
            var packingSize = $("#packingSize").val();

            var calculatedValue = '';
            var calculatedTitle = '';
            for (var totalQty = parseInt(packingSize); totalQty <= 5000; totalQty = totalQty + parseInt(packingSize)) {

                calculatedUnitPrice = totalValue / totalQty;
                totalValueLenght = totalValue.toString().length;
                calculatedUnitPriceLenght = calculatedUnitPrice.toString().length;

                //if((calculatedUnitPrice <= 10) && (calculatedUnitPriceLenght <= totalValueLenght)){
                //if(calculatedUnitPrice <= 10){
                totalPacking = totalQty / parseInt(packingSize);
                calculatedTitle = '[ ' + packingSize + ' kg X ' + totalPacking + ' : ' + totalQty + ' ] = ';

                calculatedValue = calculatedValue + calculatedTitle + (calculatedUnitPrice) + '\n';
                //}
            }
            $("#calculatedFigure ").html(calculatedValue);
        };



        //******************* H i s t o r y *******************
        function transfer_history() {

            var totalValue = $("#totalValue").val();
            var packingSize = $("#packingSize").val();
         /* Need to Work on History part 
            $.ajax({
                url: "http://www.allmarch.groupdecent.com/Admin/transfer_history",
                type: 'POST',
                data: {
                    packingSize: packingSize
                },
                dataType: 'JSON',
                success: function(data) {
                    $("#previousHistory ").html(data.transferHistory);
                }
            });
          */
        }
    </script>

    <!-- END View Content Here -->
@endsection

@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Product</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container">
        <h5>{{ $toptitle }}</h5>
        <form action="{{ $url }}" method="post">
            @csrf
    
            <div class="row">
                <div class="col-4"></div>
                <div class="col-8">
                    <select id="existingBatchItems" name="existingBatch" id="existingBatch" class="form-control text-primary">
    
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="registration_date">Registration Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="registration_date"
                                value="{{ old('registration_date', $batch->registration_date) }}" class="form-control"
                                id="registration_date">
                            <span class="text-danger">
                                @error('registration_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="production_date">Production Date <span class="text-danger"><b>*</b></span></label>
                            <input id="production_date" type="date" name="production_date"
                                value="{{ old('production_date', $batch->production_date) }}" class="form-control"
                                id="production_date">
                            <span class="text-danger">
                                @error('production_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_id"> Product Name <span class="text-danger"><b>*</b></span></label>
                            <select id="products" name="product_id" class="form-control">
                                <option value="" selected="">Select</option>
    
                            </select>
                            <span class="text-danger">
                                @error('product_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="expire_date">Expire Date <span class="text-danger"><b>*</b></span></label>
                            <input id="expire_date" type="date" name="expire_date"
                                value="{{ old('expire_date', $batch->expire_date) }}" class="form-control" id="expire_date">
                            <span class="text-danger">
                                @error('expire_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customer_id"> Customer Name <span class="text-danger"><b>*</b></span></label>
                            <select id="customers" name="customer_id" class="form-control">
                                <option value="" selected="">Select</option>
                            </select>
                            <span class="text-danger">
                                @error('customer_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="batch_packing">Batch Packing </label>
                            <input id="batch_packing" type="number" name="batch_packing" min="0"
                                value="{{ old('batch_packing', $batch->batch_packing) }}" class="form-control"
                                id="batch_packing">
                            <span class="text-danger">
                                @error('batch_packing')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
    
                        <div class="form-group col-md-6">
                            <label for="batch_title">Batch Title <span class="text-danger"><b>*</b></span></label>
                            <input id="batch_title" type="text" name="batch_title"
                                value="{{ old('batch_title', $batch->batch_title) }}" class="form-control" id="batch_title">
                            <span class="text-danger">
                                @error('batch_title')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="remark">Remark</label>
                            <input id="remark" type="text" name="remark" value="{{ old('remark', $batch->remark) }}"
                                class="form-control" id="remark">
                            <span class="text-danger">
                                @error('remark')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="batch_no">Batch No <span class="text-danger"><b>*</b></span></label>
                            <input id="batch_no" type="text" name="batch_no"
                                value="{{ old('batch_no', $batch->batch_no) }}" class="form-control" id="batch_no">
                            <span class="text-danger">
                                @error('batch_no')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
    
                        <div class="form-group col-md-6">
                            <label for="import_info">Import Info</label>
                            <input id="import_info" type="text" name="import_info"
                                value="{{ old('import_info', $batch->import_info) }}" class="form-control" id="import_info">
                            <span class="text-danger">
                                @error('import_info')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
    
    
    
                    </div>
    
                </div>
                <div class="col-4">
                    <h3>Existing Details</h3>
                    <p> <b>Material Desc: </b> <span id="Material_Desc"></span> </p>
                    <p><b>Types Desc: </b> <span id="Types_Desc"></span></p>
                    <p><b>H.S Code: </b> <span id="H_S_Code"></span></p>
                </div>
            </div>
    
    
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <script type="text/javascript">
        let productList = [];
        let customerList = [];
        let batchList = [];

        $(document).ready(function() {
            $.ajax({
                url: "{{ url('/customer/getList') }}",
                method: 'GET',
                success: function(data) {
                    //console.log(data);
                    customerList = data;
                    $.each(data, function(key, customer) {
                        $('#customers').append('<option value="' + customer.customer_id + '">' +
                            customer
                            .customer_name + '</option>');
                    });
                }

            });
            $.ajax({
                url: "{{ url('/product/getList') }}",
                method: 'GET',
                success: function(data) {
                    //console.log(data);
                    productList = data;
                    $.each(data, function(key, customer) {
                        $('#products').append('<option value="' + customer.product_id + '">' +
                            customer
                            .product_name + '</option>');
                    });
                }
            });

            $('#products').on('change', function() {
                var productId = $(this).val();
                //debugger;
                let product = productList.find(f => f.product_id == productId);
                //console.log(product);
                $('#batch_title').val(product.product_name.toUpperCase());
                $('#batch_packing').val(product.product_packing);
                $('#import_info').val(product.import_information);

                $('#Material_Desc').text(product.material_description);
                $('#Types_Desc').text('');
                $('#H_S_Code').text(product.h_s_code);

                if (productId) {
                    $.ajax({
                        url: "{{ url('/batch/getBatchByProductId') }}/" + productId,
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

                                $('#existingBatchItems').append('<option value="' + item
                                    .batch_id + '">' +
                                    item.batch_no + ', ' + item.production_date +
                                    ', ' + item.expire_date + ', ' +
                                    customer.customer_name + ', ' + item.remark +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#existingBatchItems').empty();
                    $('#existingBatchItems').append('<option value="">Existing Batch List</option>');
                }
            });

            $('#existingBatchItems').on('change', function() {
                var batchId = $(this).val();
                //debugger;
                if (batchId) {

                    let batchProduct = batchList.find(f => f.batch_id == batchId);
                    //console.log(batchProduct);

                    $('#production_date').val(batchProduct.production_date);
                    $('#expire_date').val(batchProduct.expire_date);
                    $('#batch_no').val(batchProduct.batch_no);
                    $('#batch_packing').val(batchProduct.batch_packing);
                    $('#import_info').val(batchProduct.import_info);
                    $('#remark').val(batchProduct.remark);
                }



            });
        });
    </script>
    <!-- END View Content Here -->
@endsection

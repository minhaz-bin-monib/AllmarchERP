@extends('layouts.main')

<!-- Set Title -->
@push('title')
<title>Product</title>
@endpush

@section('main-section')
<!-- START View Content Here -->

<h5>{{$toptitle}}</h5>
<form action="{{$url}}" method="post">
    @csrf

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="registration_date">Registration Date <span class="text-danger"><b>*</b></span></label>
            <input type="date" name="registration_date" value="{{old('registration_date',$batch->registration_date)}}" class="form-control" id="registration_date">
            <span class="text-danger">
                @error('registration_date')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="product_name"> Product Name <span class="text-danger"><b>*</b></span></label>
            <select name="product_name" class="form-control">
                <option value="" selected="">Select</option>
                <option value="1">Printex</option>
                <option value="2">Ecoplast</option>
            </select>
            <span class="text-danger">
                @error('product_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="customer_name"> Customer Name <span class="text-danger"><b>*</b></span></label>
            <select name="customer_name" class="form-control">
                <option value="" selected="">Select</option>
                <option value="1">A</option>
                <option value="2">B</option>
            </select>
            <span class="text-danger">
                @error('customer_name')
                    {{$message}}
                @enderror
            </span>
        </div>
       
        <div class="form-group col-md-4">
            <label for="batch_title">Batch Title <span class="text-danger"><b>*</b></span></label>
            <input type="text" name="batch_title" value="{{old('batch_title',$batch->batch_title)}}" class="form-control" id="batch_title">
            <span class="text-danger">
                @error('batch_title')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="batch_no">Batch No <span class="text-danger"><b>*</b></span></label>
            <input type="text" name="batch_no" value="{{old('batch_no',$batch->batch_no)}}" class="form-control" id="batch_no">
            <span class="text-danger">
                @error('batch_no')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="production_date">Production Date <span class="text-danger"><b>*</b></span></label>
            <input type="date" name="production_date" value="{{old('production_date',$batch->production_date)}}" class="form-control" id="production_date">
            <span class="text-danger">
                @error('production_date')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="expire_date">Expire Date <span class="text-danger"><b>*</b></span></label>
            <input type="date" name="expire_date" value="{{old('expire_date',$batch->expire_date)}}" class="form-control" id="expire_date">
            <span class="text-danger">
                @error('expire_date')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="batch_packing">Batch Packing </label>
            <input type="number" name="batch_packing" min="0" value="{{old('batch_packing',$batch->batch_packing)}}" class="form-control" id="batch_packing">
            <span class="text-danger">
                @error('batch_packing')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="remark">Remark</label>
            <input type="text" name="remark" value="{{old('remark',$batch->remark)}}" class="form-control" id="remark">
            <span class="text-danger">
                @error('remark')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="import_info">Import Info</label>
            <input type="text" name="import_info" value="{{old('import_info',$batch->import_info)}}" class="form-control" id="import_info">
            <span class="text-danger">
                @error('import_info')
                    {{$message}}
                @enderror
            </span>
        </div>



    </div>


    <button type="submit" class="btn btn-primary">Save</button>
</form>

<!-- END View Content Here -->
@endsection
@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Employee</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

        
<h5>Helllo Employee</h5>
<form action="" method="post">
    @csrf
   
    <div class="form-row">
       
        <div class="form-group col-md-4">
            <label for="product_name">Employee Name <span class="text-danger"><b>*</b></span></label>
            <input type="text" name="product_name"  class="form-control" id="product_name">
            <span class="text-danger">
                @error('product_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="product_name">Employee Designation <span class="text-danger"><b>*</b></span></label>
            <input type="text" name="product_name"  class="form-control" id="product_name">
            <span class="text-danger">
                @error('product_name')
                    {{$message}}
                @enderror
            </span>
        </div>
       
    </div>


    <button type="submit" class="btn btn-primary">Save</button>
</form>

    <!-- END View Content Here -->
@endsection 
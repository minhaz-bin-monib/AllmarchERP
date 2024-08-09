@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
        <h5>{{$toptitle}}</h5>

<form action="{{$url}}" method="post">
    @csrf
   
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="registration_date">Registration Date <span class="text-danger"><b>*</b></span></label>
            <input type="date" name="registration_date" value="{{old('registration_date',$customer->registration_date)}}" class="form-control" id="registration_date">
            <span class="text-danger">
                @error('registration_date')
                    {{$message}}
                @enderror
            </span>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

    <!-- END View Content Here -->
@endsection 
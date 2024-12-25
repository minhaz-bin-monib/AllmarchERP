@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">
        
        {{-- <h5>{{$toptitle}}</h5> --}}

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

        <div class="form-group col-md-4">
            <label for="customer_name">Customer Name <span class="text-danger"><b>*</b></span></label>
            <input type="text" name="customer_name" value="{{old('customer_name',$customer->customer_name)}}" class="form-control" id="customer_name">
            <span class="text-danger">
                @error('customer_name')
                    {{$message}}
                @enderror
            </span>
        </div>
          <div class="form-group col-md-4">
            <label for="proprietor_name">Proprietor Name </label>
            <input type="text" name="proprietor_name" value="{{old('proprietor_name',$customer->proprietor_name)}}" class="form-control" id="proprietor_name">
            <span class="text-danger">
                @error('proprietor_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="loyalty_discount">Loyalty Discount (%) </label>
            <input type="number" name="loyalty_discount" min="0.0" step="0.01"  value="{{old('loyalty_discount',$customer->loyalty_discount)}}" class="form-control" id="loyalty_discount">
            <span class="text-danger">
                @error('loyalty_discount')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="customer_dob">Customer DOB </label>
            <input type="date" name="customer_dob" value="{{old('customer_dob',$customer->customer_dob)}}" class="form-control" id="customer_dob">
            <span class="text-danger">
                @error('customer_dob')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="customer_phone">Customer Phone</label>
            <input type="text" name="customer_phone" value="{{old('customer_phone',$customer->customer_phone)}}" class="form-control" id="customer_phone">
            <span class="text-danger">
                @error('customer_phone')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="national_id">National ID </label>
            <input type="text" name="national_id" value="{{old('national_id',$customer->national_id)}}" class="form-control" id="national_id">
            <span class="text-danger">
                @error('national_id')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="passport_no">Passport No </label>
            <input type="text" name="passport_no" value="{{old('passport_no',$customer->passport_no)}}" class="form-control" id="passport_no">
            <span class="text-danger">
                @error('passport_no')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="blood_group">Blood Group</label>
            <input type="text" name="blood_group" value="{{old('blood_group',$customer->blood_group)}}" class="form-control" id="blood_group">
            <span class="text-danger">
                @error('blood_group')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="customer_email">Customer Email</label>
            <input type="email" name="customer_email" value="{{old('customer_email',$customer->customer_email)}}" class="form-control" id="customer_email">
            <span class="text-danger">
                @error('customer_email')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="customer_disability">Customer Disability </label>
            <input type="text" name="customer_disability" value="{{old('customer_disability',$customer->customer_disability)}}" class="form-control" id="customer_disability">
            <span class="text-danger">
                @error('customer_disability')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="customer_remark">Customer Remark</label>
            <input type="text" name="customer_remark" value="{{old('customer_remark',$customer->customer_remark)}}" class="form-control" id="customer_remark">
            <span class="text-danger">
                @error('customer_remark')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="customer_address">Customer Address </label>
            <input type="text" name="customer_address" value="{{old('customer_address',$customer->customer_address)}}" class="form-control" id="customer_address">
            <span class="text-danger">
                @error('customer_address')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="fathers_name"> Fathers Name</label>
            <input type="text" name="fathers_name" value="{{old('fathers_name',$customer->fathers_name)}}" class="form-control" id="fathers_name">
            <span class="text-danger">
                @error('fathers_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="mothers_name">Mothers Name</label>
            <input type="text" name="mothers_name" value="{{old('mothers_name',$customer->mothers_name)}}" class="form-control" id="mothers_name">
            <span class="text-danger">
                @error('mothers_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="family_members">Family Members </label>
            <input type="number" name="family_members" min="0" value="{{old('family_members',$customer->family_members)}}" class="form-control" id="family_members">
            <span class="text-danger">
                @error('family_members')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="siblings_position">Siblings Position </label>
            <input type="number" name="siblings_position" min="0" value="{{old('siblings_position',$customer->siblings_position)}}" class="form-control" id="siblings_position">
            <span class="text-danger">
                @error('siblings_position')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="spouse_name">Spouse Name </label>
            <input type="text" name="spouse_name" value="{{old('spouse_name',$customer->spouse_name)}}" class="form-control" id="spouse_name">
            <span class="text-danger">
                @error('spouse_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="number_of_kids">Number Of Kids </label>
            <input type="number" name="number_of_kids" min="0" value="{{old('number_of_kids',$customer->number_of_kids)}}" class="form-control" id="number_of_kids">
            <span class="text-danger">
                @error('number_of_kids')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
        <label for="customer_grade">Customer Grade</label>
            <select name="customer_grade" class="form-control">
                <option value="" selected="">Select</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="customer_referred_by"> Customer Referred By </label>
            <input type="text" name="customer_referred_by" value="{{old('customer_referred_by',$customer->customer_referred_by)}}" class="form-control" id="customer_referred_by">
            <span class="text-danger">
                @error('customer_referred_by')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="emergency_contact_details">Emergency Contact Details </label>
            <input type="text" name="emergency_contact_details" value="{{old('emergency_contact_details',$customer->emergency_contact_details)}}" class="form-control" id="emergency_contact_details">
            <span class="text-danger">
                @error('emergency_contact_details')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="set_reminder_amount">Set Reminder Amount</label>
            <input type="number" name="set_reminder_amount" min="0" step="0.01"  value="{{old('set_reminder_amount',$customer->set_reminder_amount)}}" class="form-control" id="set_reminder_amount">
            <span class="text-danger">
                @error('set_reminder_amount')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="customer_note">Customer Note </label>
            <input type="text" name="customer_note" value="{{old('customer_note',$customer->customer_note)}}" class="form-control" id="customer_note">
            <span class="text-danger">
                @error('customer_note')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
        <label for="customer_grade">Customer Status</label>
        <select name="customer_grade" class="form-control">
            <option value="" {{ old('customer_grade', $customer->customer_grade) == '' ? 'selected' : '' }}>Select</option>
            <option value="Active" {{ old('customer_grade', $customer->customer_grade) == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ old('customer_grade', $customer->customer_grade) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        </div>
        <div class="form-group col-md-4">
            <label for="customer_image">Customer Image</label>
            <input type="file" name="customer_image" class="form-control" id="customer_image">
        </div>
        

    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
    </div>
    <script>
        document.getElementById('PageName').innerText = '{{$toptitle}}';
    </script>
    <!-- END View Content Here -->
@endsection 
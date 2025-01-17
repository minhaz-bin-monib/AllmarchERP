@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Employee</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

        
<h5>Employee</h5>
<form action="{{$url}}" method="post">
    @csrf
   
    <div class="form-row">
       
        <div class="form-group col-md-4">
            <label for="employment_date">Employment Date<span class="text-danger"><b>*</b></span></label>
            <input type="date" name="employment_date" value="{{old('employment_date',$employee->employment_date)}}" class="form-control" id="employment_date">
            <span class="text-danger">
                @error('employment_date')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="employee_name">Employee Name<span class="text-danger"><b>*</b></span></label>
            <input type="text" name="employee_name" value="{{old('employee_name',$employee->employee_name)}}" class="form-control" id="employee_name">
            <span class="text-danger">
                @error('employee_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="nick_name">Nick Name<span class="text-danger"><b>*</b></span></label>
            <input type="text" name="nick_name" value="{{old('nick_name',$employee->nick_name)}}" class="form-control" id="nick_name">
            <span class="text-danger">
                @error('nick_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="employee_designation">Employee Designation<span class="text-danger"><b>*</b></span></label>
            <select name="employee_designation" {{ $employee->employee_id > 0 && $employee->employee_designation == 'Delivery Man' ? 'disabled' : '' }} class="form-control">
                @php
                    $roles = [
                        'Office Executive', 
                        'Executive Assistant',
                        'Driver', 
                        'Delivery Man', 
                        'Office Coordinator', 
                        'Office Assistant', 
                        'Admin', 
                        'Manager', 
                        'Marketing Officer', 
                        'Sales Assistant', 
                        'Store Incharge', 
                        'Store Manager', 
                        'Sales Manager',
                        'Finance Manager', 
                        'Inventory Manager', 
                        'Production Manager', 
                        'Quality Control Manager', 
                        'Human Resource Manager', 
                        'Logistics Manager', 
                        'Supply Chain Manager', 
                        'Customer Service Manager', 
                        'Finance Analyst',
                        'Project Manager', 
                        'Quality Assurance Manager', 
                        'Training Manager', 
                        'Supply Chain Analyst', 
                        'Marketing Manager'
                    ];
                @endphp
            
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ old('employee_designation', $employee->employee_designation) == $role ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>
            
            </div>

        <div class="form-group col-md-4">
            <label for="employment_dob">Employment DOB</label>
            <input type="date" name="employment_dob" value="{{old('employment_dob',$employee->employment_dob)}}" class="form-control" id="employment_dob">
            <span class="text-danger">
                @error('employment_dob')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="employee_mobile">Employee Mobile</label>
            <input type="text" name="employee_mobile" value="{{old('employee_mobile',$employee->employee_mobile)}}" class="form-control" id="employee_mobile">
            <span class="text-danger">
                @error('employee_mobile')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="national_id">National ID</label>
            <input type="text" name="national_id" value="{{old('national_id',$employee->national_id)}}" class="form-control" id="national_id">
            <span class="text-danger">
                @error('national_id')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="employee_email">Employee Email</label>
            <input type="text" name="employee_email" value="{{old('employee_email',$employee->employee_email)}}" class="form-control" id="employee_email">
            <span class="text-danger">
                @error('employee_email')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="employee_disability">Employee Disability </label>
            <input type="text" name="employee_disability" value="{{old('employee_disability',$employee->employee_disability)}}" class="form-control" id="employee_disability">
            <span class="text-danger">
                @error('employee_disability')
                    {{$message}}
                @enderror
            </span>
        </div>

        <div class="form-group col-md-4">
            <label for="employee_remark">Employee Remark</label>
            <input type="text" name="employee_remark" value="{{old('employee_remark',$employee->employee_remark)}}" class="form-control" id="employee_remark">
            <span class="text-danger">
                @error('employee_remark')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="employee_address">Employee Address </label>
            <input type="text" name="employee_address" value="{{old('employee_address',$employee->employee_address)}}" class="form-control" id="employee_address">
            <span class="text-danger">
                @error('employee_address')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="fathers_name"> Fathers Name</label>
            <input type="text" name="fathers_name" value="{{old('fathers_name',$employee->fathers_name)}}" class="form-control" id="fathers_name">
            <span class="text-danger">
                @error('fathers_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="mothers_name">Mothers Name</label>
            <input type="text" name="mothers_name" value="{{old('mothers_name',$employee->mothers_name)}}" class="form-control" id="mothers_name">
            <span class="text-danger">
                @error('mothers_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="family_members">Family Members </label>
            <input type="number" name="family_members" min="0" value="{{old('family_members',$employee->family_members)}}" class="form-control" id="family_members">
            <span class="text-danger">
                @error('family_members')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="siblings_position">Siblings Position </label>
            <input type="number" name="siblings_position" min="0" value="{{old('siblings_position',$employee->siblings_position)}}" class="form-control" id="siblings_position">
            <span class="text-danger">
                @error('siblings_position')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="spouse_name">Spouse Name </label>
            <input type="text" name="spouse_name" value="{{old('spouse_name',$employee->spouse_name)}}" class="form-control" id="spouse_name">
            <span class="text-danger">
                @error('spouse_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="number_of_kids">Number Of Kids </label>
            <input type="number" name="number_of_kids" min="0" value="{{old('number_of_kids',$employee->number_of_kids)}}" class="form-control" id="number_of_kids">
            <span class="text-danger">
                @error('number_of_kids')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="employee_referred_by"> Employee Referred By </label>
            <input type="text" name="employee_referred_by" value="{{old('employee_referred_by',$employee->employee_referred_by)}}" class="form-control" id="employee_referred_by">
            <span class="text-danger">
                @error('employee_referred_by')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="emergency_contact_details">Emergency Contact Details </label>
            <input type="text" name="emergency_contact_details" value="{{old('emergency_contact_details',$employee->emergency_contact_details)}}" class="form-control" id="emergency_contact_details">
            <span class="text-danger">
                @error('emergency_contact_details')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="employee_salary"> Employee Salary</label>
            <input type="number" name="employee_salary" value="{{old('employee_salary',$employee->employee_salary)}}" class="form-control" id="employee_salary">
            <span class="text-danger">
                @error('employee_salary')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="previous_employment_details">Previous Employment & Salary</label>
            <input type="text" name="previous_employment_details" value="{{old('previous_employment_details',$employee->previous_employment_details)}}" class="form-control" id="previous_employment_details">
            <span class="text-danger">
                @error('previous_employment_details')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="employee_status">Employee Status</label>
            <select name="employee_status" class="form-control">
                <option value="Active" {{ old('employee_status', $employee->employee_status) == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ old('employee_status', $employee->employee_status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            </div>
        <div class="form-group col-md-4">
            <label for="employee_image">Employee Image</label>
            <input type="file" name="employee_image" class="form-control" id="employee_image">
        </div>
       
    </div>


    <button type="submit" class="btn btn-primary">Save</button>
</form>

<script>
    document.getElementById('PageName').innerText = '{{$toptitle}}';
</script>
    <!-- END View Content Here -->
@endsection 
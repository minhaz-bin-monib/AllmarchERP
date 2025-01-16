<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;
class EmployeeController extends Controller
{
    // [httpGet]
    public function show()
    {
        $employees = Employee::where('action_type', '!=', 'DELETE')
            ->orderBy('employee_id', 'desc')
            ->get();

        $data = compact('employees');
        return view('employee.employeelist')->with($data);
    }

    // [httpGet]
    public function create()
    {
        $employee = new Employee();
        $employee->employment_date = Carbon::now()->format('Y-m-d');
        $url = url('/employee/create');
        $toptitle = 'Add Employee';
        $data = compact('employee', 'url', 'toptitle');
        return view('employee.addemployee')->with($data);
    }

    // [httpPost]
    public function store(Request $request)
    {
        $request->validate(
            [
                'employment_date' => 'required',
                'employee_name' => 'required',
                'nick_name' => 'required',
                'employee_designation' => 'required',
            ]
        );

        $employee = new Employee();

        $employee->employment_date = $request['employment_date'];
        $employee->employee_name = $request['employee_name'];
        $employee->nick_name = $request['nick_name'];
        $employee->employee_designation = $request['employee_designation'];
        $employee->employment_dob = $request['employment_dob'];
        $employee->employee_mobile = $request['employee_mobile'];
        $employee->national_id = $request['national_id'];
        $employee->employee_email = $request['employee_email'];
        $employee->employee_disability = $request['employee_disability'];
        $employee->employee_remark = $request['employee_remark'];
        $employee->employee_address = $request['employee_address'];
        $employee->fathers_name = $request['fathers_name'];
        $employee->mothers_name = $request['mothers_name'];
        $employee->family_members = $request['family_members'];
        $employee->siblings_position = $request['siblings_position'];
        $employee->spouse_name = $request['spouse_name'];
        $employee->number_of_kids = $request['number_of_kids'];
        $employee->employee_referred_by = $request['employee_referred_by'];
        $employee->emergency_contact_details = $request['emergency_contact_details'];
        $employee->employee_salary = $request['employee_salary'];
        $employee->employee_status = $request['employee_status'];
        $employee->action_type = 'INSERT';
        $employee->user_id = 'sys-user';
        $employee->action_date = now();

        $employee->save();
        return redirect('/employee/list');
    }
    // [httpGet]
    public function edit($id)
    {
        
        $employee = Employee::find($id);

        if(is_null($employee))
        {
            // employee not found
            return redirect('/employee/list');
        }
        else{
            $url = url('/employee/update') ."/". $id;
            $toptitle = 'Edit Employee';

            $data = compact('employee', 'url', 'toptitle'); // data and dynamic url pass into view
            
            return view('employee.addemployee')->with($data);;
         
        }
      
    }

    // [httpPost]
    public function update($id, Request $request)
    {
        
        $request->validate(
            [
                'employment_date' => 'required',
                'employee_name' => 'required',
                'nick_name' => 'required',
                'employee_designation' => 'required',
            ]
        );

        $employee = Employee::find($id);

        $employee->employment_date = $request['employment_date'];
        $employee->employee_name = $request['employee_name'];
        $employee->nick_name = $request['nick_name'];
        $employee->employee_designation = $request['employee_designation'];
        $employee->employment_dob = $request['employment_dob'];
        $employee->employee_mobile = $request['employee_mobile'];
        $employee->national_id = $request['national_id'];
        $employee->employee_email = $request['employee_email'];
        $employee->employee_disability = $request['employee_disability'];
        $employee->employee_remark = $request['employee_remark'];
        $employee->employee_address = $request['employee_address'];
        $employee->fathers_name = $request['fathers_name'];
        $employee->mothers_name = $request['mothers_name'];
        $employee->family_members = $request['family_members'];
        $employee->siblings_position = $request['siblings_position'];
        $employee->spouse_name = $request['spouse_name'];
        $employee->number_of_kids = $request['number_of_kids'];
        $employee->employee_referred_by = $request['employee_referred_by'];
        $employee->emergency_contact_details = $request['emergency_contact_details'];
        $employee->employee_salary = $request['employee_salary'];
        $employee->employee_status = $request['employee_status'];
        $employee->action_type = 'INSERT';
        $employee->user_id = 'sys-user';
        $employee->action_date = now();

        $employee->save();
        return redirect('/employee/list');
      
    }
}

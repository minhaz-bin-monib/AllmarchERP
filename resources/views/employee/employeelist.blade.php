@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Employees</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">
        
        {{-- <h5>Employees</h5> --}}
    
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Edit</th>
                    <th>Full Name</th>
                    <th>Nick Name</th>
                    <th>Designation</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Employee Address</th>
                    {{-- <th>Created</th> --}}
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $emp)
                    <tr>
                        <td style="width: 6%">{{ $emp->employee_id }}</td>
                        <td style="width: 5%">
                            <a class="" href="{{ url('/employee/edit') }}/{{ $emp->employee_id }}"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>{{ $emp->employee_name }}</td>
                        <td>{{ $emp->nick_name }}</td>
                        <td>{{ $emp->employee_designation }}</td>
                        <td>{{ $emp->employee_mobile }}</td>
                        <td>{{ $emp->employee_email }}</td>
                        <td>{{ $emp->employee_address }}</td>
                        {{-- <td style="width: 10%">
                            <a class="btn btn-sm btn-danger"onClick="confirmDelete('{{ url('/employee/delete') }}/{{ $cust->employee_id }}')" ><i class="fa fa-trash"></i></a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">

        document.getElementById('PageName').innerText = 'Employee List';
        
        let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [[0, 'desc']], // Maintain initial order based on first column
        });
       // let table = new DataTable('#myTable');

        function confirmDelete(url) {
                    if (confirm("Want to delete this item?")) {
                        window.location.href = url;
                    }
                }
    </script>

    <!-- END View Content Here -->
@endsection 
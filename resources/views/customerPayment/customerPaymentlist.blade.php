@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer Payments List</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">

        <div class="card p-2">
            <div class="row">
                <div class="col-2 mt-2">Payment Status</div>
                <div class="col-3">
                    <select name="searchType" onchange="onChangeSearch(this)" class="form-control">
    
                        <option value="All" {{ old('searchType', $searchType) == 'All' ? 'selected' : '' }}>
                            All
                        </option>
                        <option value="Pending" {{ old('searchType', $searchType) == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="Honoured" {{ old('searchType', $searchType) == 'Honoured' ? 'selected' : '' }}>
                            Honoured
                        </option>
                        <option value="Rejected" {{ old('searchType', $searchType) == 'Rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>
    
                    </select>
                </div>
            </div>

        </div>

        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Edit</th>
                    <th>Customer Name</th>
                    <th>Payment Type</th>
                    <th>Bank</th>
                    <th>Honour Date</th>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Honour Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customerPayments as $prod)
                    <tr>
                        <td style="width: 6%">{{ $prod->customer_payment_id }}</td>
                        <td style="width: 5%">
                            <a class="" href="{{ url('/customerPayment/edit') }}/{{ $prod->customer_payment_id }}"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td>{{ $prod->customer_name }}</td>
                        <td>{{ $prod->method_name }}</td>
                        <td>{{ $prod->bank_name }}</td>
                        <td>{{ $prod->honour_date }}</td>
                        <td>{{ $prod->reference }}</td>
                        <td>{{ $prod->diposit_dmount }}</td>
                        <td>{{ $prod->payment_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = 'Customer Payments List';
        // let table = new DataTable('#myTable');
        let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [
                [0, 'desc']
            ], // Maintain initial order based on first column
        });

        function onChangeSearch(dropdown) {
            var selectedValue = dropdown.value;
            window.location.href = "{{ url('customerPayment/list') }}/" + selectedValue;

        }
    </script>


    <!-- END View Content Here -->
@endsection

@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Daily Expense List</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->
    <div class="container mt-4">

        {{-- <h5>Products</h5> --}}
        <div class="card  mb-2 mt-3 p-2">
            <div class="row">
                <div class="col-2">

                    <input id="searchInput" type="date" value="{{ \Carbon\Carbon::parse($searchDate)->format('Y-m-d') }}"
                        class="form-control " />

                </div>
                <div class="col-3">
                    <button id="searchButton" onClick="Search()" class="btn btn-sm btn-primary"> Search</button>
                </div>
                <div class="col-6">
                    <p>Expense List of : <b> {{ \Carbon\Carbon::parse($searchDate)->format('F Y') }} </b> </p>
                </div>
            </div>
        </div>

        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Opening Date</th>
                    <th>Opening Tk</th>
                    <th>Total Debit</th>
                    <th>Total Credit</th>
                    <th>Clossing TK</th>
                    <th>Closing Date</th>
                    <th>Details</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($closingDailyExpense as $clsDailyExpn)
                    <tr>
                        <td style="width: 6%">{{ $clsDailyExpn->closing_daily_expense_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($clsDailyExpn->openning_date)->format('d-m-Y')  }}</td>
                        <td>{{ $clsDailyExpn->openning_blance  }}</td>
                        <td>{{ $clsDailyExpn->total_debit_blance  }}</td>
                        <td>{{ $clsDailyExpn->total_credit_blance  }}</td>
                        <td>{{ $clsDailyExpn->closing_blance  }}</td>
                        <td>{{ \Carbon\Carbon::parse($clsDailyExpn->closing_date)->format('d-m-Y')   }}</td>
                        <td style="width: 8%">
                            <a class="" target="_blank" href="{{ url('/accountDaily/dailyExpenseDetails/'. $clsDailyExpn->closing_daily_expense_id )  }}"><i
                                    class="fa fa-print" ></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = 'Closed Daily Expenses';
        // let table = new DataTable('#myTable');
        let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [
                [0, 'desc']
            ], // Maintain initial order based on first column
        });

        function confirmDelete(url) {
            if (confirm("Want to delete this item?")) {
                window.location.href = url;
            }
        }

        function Search() {
            let date = document.getElementById('searchInput').value;
            console.log(date);
            window.location.href = "{{ url('/accountDaily/expanseList') }}/" + date;
        }
    </script>


    <!-- END View Content Here -->
@endsection

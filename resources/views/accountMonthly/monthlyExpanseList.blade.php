@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Monthly Expense List</title>
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
                    <button id="searchButton" onClick="Search()" class="btn btn-sm btn-primary"> Search by Year</button>
                </div>
                <div class="col-6">
                    <p>Monthly Expense List of : <b> {{ \Carbon\Carbon::parse($searchDate)->format('F Y') }} </b> </p>
                </div>
            </div>
        </div>

        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Month Year</th>
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
                @if($runningMonthly)
                <tr>
                    <td>1</td>
                    <td class="text-success">
                        {{ \Carbon\Carbon::parse($runningMonthly->opening_date)->format('F Y') }}
                    </td>
                    <td> <a class="" target="_blank" href="{{ url('/accountMonthly/MonthlyExpanseReport/1/1' )  }}"><i
                        class="fa fa-print" ></i></a> 
                    </td>
                   
                </tr>
                @endif
                @foreach ($closingMonthlyList as $clsDailyExpn)
                    <tr>
                        <td >{{ $loop->iteration+1 }}</td>
                        <td> {{ \Carbon\Carbon::parse($clsDailyExpn->opening_date)->format('F Y') }}</td>
                        <td> <a class="" target="_blank" href="{{ url('/accountMonthly/MonthlyExpanseReport/'.$clsDailyExpn->opening_monthly_id.'/2' )  }}"><i
                            class="fa fa-print" ></i></a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = 'Closed Monthly Expenses';
        // let table = new DataTable('#myTable');
        // let table = new DataTable('#myTable', {
        //     perPage: 10, // Number of entries per page
        //     sortable: true, // Allow sorting
        //     order: [
        //         // [0, 'desc']
        //     ], // Maintain initial order based on first column
        // });

        function confirmDelete(url) {
            if (confirm("Want to delete this item?")) {
                window.location.href = url;
            }
        }

        function Search() {
            let date = document.getElementById('searchInput').value;
            console.log(date);
            window.location.href = "{{ url('/accountMonthly/expanseList') }}/" + date;
        }
    </script>


    <!-- END View Content Here -->
@endsection

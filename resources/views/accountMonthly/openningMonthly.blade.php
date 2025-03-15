@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Daily Expanse</title>
@endpush


@section('main-section')
    <!-- START View Content Here -->
    <div class="container">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <div class="card  mb-2 mt-3 p-2">
            <div class="row">
                @if (session('errorOfOpenningExpanse'))
                    <div class="alert alert-danger">
                        {{ session('errorOfOpenningExpanse') }}
                    </div>
                @endif
                <div class="col-2">

                    <input id="searchInput" type="date" value="{{ \Carbon\Carbon::parse($openingDate)->format('Y-m-d') }}"
                        {{ $isNewDailyExpanse == true ? '' : 'disabled' }} class="form-control " />

                </div>
                <div class="col-3">
                    <button id="searchButton" onClick="Search()"
                        class="btn btn-sm btn-primary {{ $isNewDailyExpanse == true ? '' : 'disabled' }}"> Opening
                        Monthly</button>

                    {{-- <a 
                     href="{{ $isNewDailyExpanse == true ? $urlOpeningDailyExpanse : '#' }}" 
                     class="btn btn-sm btn-primary {{ $isNewDailyExpanse == true ? '' : 'disabled' }}">
                    Opening Daily Expanse
                </a> --}}
                </div>
                <div class="col-4"></div>
                <div class="col-3">
                    {{-- <a href="{{ $isNewDailyExpanse != true ? $urlClosingDailyExpanse : '#' }}"
                        class="btn btn-sm btn-primary {{ $isNewDailyExpanse != true ? '' : 'disabled' }}"
                        onclick="return confirmAction({{ $isNewDailyExpanse }});">
                        Close Daily Expanse
                    </a> --}}
                </div>
            </div>
        </div>
         <div class="row p-2">
            <div class="card col-12 p-2">
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-primary 
                    {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">
                            Edit Expanse
                        </h6>
                    </div>
                    <div class="col-12">
                        <form action="{{ $urlAddOpeningMonthlySave }}" method="post">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="acount_name">Particulars</label>

                                    <input id="acount_name" type="text" name="acount_name"
                                        value="{{ old('acount_name', $accountMontly->acount_name) }}" disabled
                                        class="form-control">

                                    <span class="text-danger">
                                        @error('acount_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="company_name">Company Name</label>

                                    <input id="company_name" type="text" name="company_name"
                                        value="{{ old('company_name', $accountMontly->company_name) }}" 
                                        class="form-control">

                                    <span class="text-danger">
                                        @error('company_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="opening_amount">Opening Amount</label>
                                    <input id="opening_amount" type="number" step="0.01" name="opening_amount"
                                        value="{{ old('opening_amount', $accountMontly->opening_amount) }}" min="0"
                                        required class="form-control">

                                    <span class="text-danger">
                                        @error('opening_amount')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>


                            <div class="col-12 mt-1">
                                <button type="submit"
                                    class="btn btn-sm btn-primary 
                        {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        <div class="card mt-3">
            <div class="row" style="display: {{ $isNewDailyExpanse ? 'none' : '' }}">
                <div class="col-12 pt-2 pb-1">
                    <h6 class="text-center text-primary" style="letter-spacing: 1px;">List of Accounts</h6>
                </div>
                <div class="col-12">
                    <table id="myTable" class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Edit</th>
                                <th>Particulars</th>
                                <th>Company Name</th>
                                <th>Opening Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($accountMontlyList as $accMnth)
                                <tr>
                                    <td> {{ \Carbon\Carbon::parse($accMnth->opening_date)->format('d-m-Y') }}</td>
                                    <td style="width: 5%">
                                        <a class="" href="{{url('/accountMonthly/openingMonthlyEdit')}}/{{$accMnth->opening_monthly_account_id}}"><i class="fa fa-edit"></i></a> 
                                    </td>
                                    <td>{{ $accMnth->acount_name }}</td>
                                    <td>{{ $accMnth->company_name }}</td>
                                    <td>{{ $accMnth->opening_amount }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('PageName').innerText =
            '{{ $toptitle }}' +
            '{{ $isNewDailyExpanse == true ? '' : ' '. \Carbon\Carbon::parse($openingDate)->format('F Y') }}';

        function Search() {
            let date = document.getElementById('searchInput').value;
            console.log(date);
            window.location.href = "{{ $urlOpeningMonthlyAccount }}/" + date;
        }
    </script>
    <!-- END View Content Here -->
@endsection

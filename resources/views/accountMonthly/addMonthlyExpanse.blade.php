@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Daily Expanse</title>
@endpush


@section('main-section')
    <!-- START View Content Here -->
    <style>
        table{
            font-size: 10px;
        }
    </style>
    @if($openningMontly->closing_status == 1)
    <div class="container">
        {{-- <h5>{{$toptitle}}</h5> --}}

        <div class="card col-11  mb-1 mt-2 p-2">
            <div class="row">
                @if (session('errorOfOpenningExpanse'))
                    <div class="alert alert-danger">
                        {{ session('errorOfOpenningExpanse') }}
                    </div>
                @endif
                <div class="col-4">

                    {{-- <input id="searchInput" type="date" value="{{ \Carbon\Carbon::parse($openingDate)->format('Y-m-d') }}"
                        {{ $isNewDailyExpanse == true ? '' : 'disabled' }} class="form-control " /> --}}
                    <select name="accountNoId" id="activeAccountId" class="form-control" onchange="ActiveAccount()">
                        @foreach ($accountMontlyList as $mat)
                            <option value="{{ $mat->opening_monthly_account_id }}"
                                {{ old('accountNoId', $accountNoId) == $mat->opening_monthly_account_id ? 'selected' : '' }}>
                                {{ $mat->acount_name }}
                            </option>
                        @endforeach

                    </select>

                </div>
                <div class="col-4">
                    {{-- <button id="searchButton" onClick=""
                        class="btn btn-sm btn-success"> Active Account</button> --}}
                </div>
                <div class="col-4 d-flex justify-content-end">
                    {{-- <a href="{{ $isNewDailyExpanse != true ? $urlClosingDailyExpanse : '#' }}"
                        class="btn btn-sm btn-primary {{ $isNewDailyExpanse != true ? '' : 'disabled' }}"
                        onclick="return confirmAction({{ $isNewDailyExpanse }});">
                        Close Daily Expanse
                    </a> --}}
                    <button id="searchButton" onClick="CloseMonthly()" class="btn btn-sm btn-danger"> Close Monthly
                    </button>
                </div>
            </div>
        </div>
       <div class="row p-2">
            <div class=" col-11 p-2">
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-primary 
                    {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">
                            Add Expanse
                        </h6>
                    </div>
                    <div class="col-12">
                        <form action="{{ $urlAddOpeningMonthlySave }}" method="post">
                            @csrf

                             <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="opening_date">Expanse Date</label>

                                    <input id="opening_date" type="date" name="opening_date"
                                        value="{{ old('opening_date', $accountMontlyExpanse->opening_date) }}" required
                                        class="form-control">

                                    <span class="text-danger">
                                        @error('opening_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="particulars_name">Particulars</label>

                                    <input id="particulars_name" type="text" name="particulars_name"
                                        value="{{ old('particulars_name', $accountMontlyExpanse->particulars_name) }}" required
                                        class="form-control">

                                    {{-- <span class="text-danger">
                                        @error('particulars_name')
                                            {{ $message }}
                                        @enderror
                                    </span> --}}
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="company_name">Company Name</label>

                                    <input id="company_name" type="text" name="company_name"
                                        value="{{ old('company_name', $accountMontlyExpanse->company_name) }}"
                                        class="form-control">

                                    {{-- <span class="text-danger">
                                        @error('company_name')
                                            {{ $message }}
                                        @enderror
                                    </span> --}}
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="payment_type">Payment Type</label>

                                    <input id="payment_type" type="text" name="payment_type"
                                        value="{{ old('payment_type', $accountMontlyExpanse->payment_type) }}"
                                        class="form-control">

                                    {{-- <span class="text-danger">
                                        @error('payment_type')
                                            {{ $message }}
                                        @enderror
                                    </span> --}}
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="opening_amount">Category</label>
                                    <select name="montly_categories_id" id="montly_categories_id" class="form-control" >
                                        @foreach ($monthlyExpanseCategoryList as $mat)
                                            <option value="{{ $mat->montly_categories_id }}"
                                                {{ old('montly_categories_id', $accountMontlyExpanse->montly_categories_id) == $mat->montly_categories_id ? 'selected' : '' }}>
                                                {{ $mat->category_name }}
                                            </option>
                                        @endforeach
                
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="opening_amount">Amount</label>
                                    <input id="opening_amount" type="number" step="0.01" name="opening_amount"
                                        value="{{ old('opening_amount', $accountMontlyExpanse->opening_amount) }}" min="0"
                                        required class="form-control">

                                    {{-- <span class="text-danger">
                                        @error('opening_amount')
                                            {{ $message }}
                                        @enderror
                                    </span> --}}
                                </div>

                            </div> 


                            <div class="col-12 mt-1">
                                <button type="submit"
                                    class="btn btn-sm btn-primary 
                        {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
       
            <div class="row" style="display: {{ $isNewDailyExpanse ? 'none' : '' }}">
                <div class="col-12 pt-2 pb-1">

                    <p class="text-center text-primary" style="letter-spacing: 1px;">Cost List of this Account</p>
                    {{-- <p class="text-center text-primary" style="letter-spacing: 1px;">All March Bangladesh Limited</p>
                    <p class="text-center " style="letter-spacing: 1px;">All Payment & Received</p>
                    <p class="text-center " style="letter-spacing: 1px;">{{ \Carbon\Carbon::parse($openingDate)->startOfMonth()->format('jS') }} to {{ \Carbon\Carbon::parse($openingDate)->endOfMonth()->format('jS F Y') }}
                    </p> --}}
                </div>
                <div class="col-11">
                    <table id="myTable" class="table table-bordered table-hover" style="table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style="width: 60px; text-align: center;">Date</th>
                                <th style="width: 50px; text-align: center;">Action</th>
                                <th style="width: 190px; text-align: center;">Particulars</th>
                                <th style="width: 75px; text-align: center;">Company Name</th>
                                <th style="width: 75px; text-align: center;">Payment Type</th>
                                <th style="width: 75px; text-align: center;">Saiful Sir</th>
                                <th style="width: 75px; text-align: center;">Pubali Bank</th>
                                <th style="width: 75px; text-align: center;">Internal Received</th>
                                <th style="width: 75px; text-align: center;">Received </th>
                                <th style="width: 75px; text-align: center;">MD Sir</th>
                                <th style="width: 75px; text-align: center;">Chairman Sir</th>
                                <th style="width: 75px; text-align: center;">Invesment</th>
                                <th style="width: 75px; text-align: center;">Expenses</th>
                                <th style="width: 75px; text-align: center;">Internal Transfer</th>
                                <th style="width: 75px; text-align: center;">Advance & Loan</th>
                                <th style="width: 75px; text-align: center;">Attitude</th>
                                <th style="width: 75px; text-align: center;">Saiful Sir</th>
                                <th style="width: 75px; text-align: center;">Pubali Bank</th>
                                <th style="width: 95px; text-align: center;">Amount</th>
                                <th style="width: 95px; text-align: center;">Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $openingTotalAmount = $openningAccountMontly->opening_amount;
                            @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($openningAccountMontly->opening_date)->format('j-M-y') }}</td>
                                    <td></td>
                                    <td>{{ $openningAccountMontly->acount_name }}</td>
                                    <td>{{ $openningAccountMontly->company_name }}</td>
                                    <td>{{ $openningAccountMontly->payment_type }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right">{{ $openningAccountMontly->opening_amount }}</td>
                                    <td></td>
                                </tr>
                            @foreach ($selectedAccountMonthlyCostList as $accMnth)
                                @php
                                    if(($accMnth->montly_categories_id >= 1) && ($accMnth->montly_categories_id <= 4)){
                                        // Debit
                                        $openingTotalAmount += $accMnth->opening_amount;
                                    }
                                    else{
                                        // Credit
                                        $openingTotalAmount -= $accMnth->opening_amount;
                                    }
                                @endphp
                                <tr>
                                    <td> {{ \Carbon\Carbon::parse($accMnth->opening_date)->format('j-M-y') }}</td>
                                    <td style="width: 5%">
                                        {{-- <a class=""
                                            href="{{ url('/accountMonthly/openingMonthlyEdit') }}/{{ $accMnth->opening_monthly_account_id }}"><i
                                                class="fa fa-edit"></i></a> --}}
                                    </td>
                                    <td>{{ $accMnth->particulars_name }}</td>
                                    <td>{{ $accMnth->company_name }}</td>
                                    <td>{{ $accMnth->payment_type }}</td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 1)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 2)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 3)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 4)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 5)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 6)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 7)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 8)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 9)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 10)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 11)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 12)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">
                                        @if($accMnth->montly_categories_id  == 13)
                                            {{ $accMnth->opening_amount }}
                                        @endif
                                    </td>
                                    <td style="text-align: right">{{ $openingTotalAmount }}</td>

                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Total:</b></td>
                                <td style="text-align: right"><b>{{ $openingTotalAmount }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
       
    </div>
    @else
        <p class="text-danger">Please Open Monthly First</p>
    @endif
    <script>
        document.getElementById('PageName').innerText =
            '{{ $toptitle }}' +
            '{{ $isNewDailyExpanse == true ? '' : ' ' . \Carbon\Carbon::parse($openingDate)->format('F Y') }}';

        function ActiveAccount() {
            if (confirm("Want to change Account?")) {

                let date = document.getElementById('activeAccountId').value;
                console.log(date);
                window.location.href = "{{ $urladdMonthlyExpanse }}/" + date;
            } else {
                document.getElementById('activeAccountId').value = {{ $accountNoId }};
            }
        }
    </script>
    <!-- END View Content Here -->
@endsection

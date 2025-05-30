@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Daily Expanse</title>
@endpush


@section('main-section')
    <!-- START View Content Here -->
    <style>
        .link {
            cursor: pointer;
            padding: 3px;
        }
    </style>
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
                        class="btn btn-sm btn-success {{ $isNewDailyExpanse == true ? '' : 'disabled' }}"> Opening Daily
                        Expanse</button>

                    {{-- <a 
                     href="{{ $isNewDailyExpanse == true ? $urlOpeningDailyExpanse : '#' }}" 
                     class="btn btn-sm btn-primary {{ $isNewDailyExpanse == true ? '' : 'disabled' }}">
                    Opening Daily Expanse
                </a> --}}
                </div>
                <div class="col-4"></div>
                <div class="col-3">
                    <a href="{{ $isNewDailyExpanse != true ? $urlClosingDailyExpanse : '#' }}"
                        class="btn btn-sm btn-danger {{ $isNewDailyExpanse != true ? '' : 'disabled' }}"
                        onclick="return confirmAction({{ $isNewDailyExpanse }});">
                        Close Daily Expanse
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-6 p-2">
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-primary 
                    {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">
                            Debit Expanse
                        </h6>
                    </div>
                    <div class="col-12">
                        <form action="{{ $urlAddOpeningDailyDebit }}" method="post">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="blance_type">Type</label>
                                    <select name="blance_type" id="blance_type" class="form-control">

                                        {{-- <option value="1">Openning Blance</option> --}}
                                        <option value="2">Loan Return</option>
                                        <option value="3">Cash Recall from Bank</option>
                                        <option value="4">Mini Sell from Mini Company</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="debit_name">Name</label>

                                    <input id="debit_name" type="text" name="debit_name"
                                        value="{{ old('debit_name', $openningDebit->debit_name) }}" required
                                        class="form-control">

                                    <span class="text-danger">
                                        @error('debit_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="debit_blance">Debit Blance</label>
                                    <input id="debit_blance" type="number" step="0.01" name="debit_blance"
                                        value="{{ old('debit_blance', $openningDebit->debit_blance) }}" min="0"
                                        required class="form-control">

                                    <span class="text-danger">
                                        @error('debit_blance')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>


                            <div class="col-12 mt-1">
                                <button type="submit"
                                    class="btn btn-sm btn-primary 
                        {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">Add
                                    Debit (+)</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card col-6 p-2">
                <div class="row">
                    <div class="col-12">
                        <h6
                            class="text-primary
                        {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">
                            Credit Expanse
                        </h6>
                    </div>
                    <div class="col-12">
                        <form action="{{ $urlAddOpeningDailyCredit }}" method="post">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="openning_daily_credits_id">Category</label>
                                    <select name="openning_daily_credits_id" id="openning_daily_credits_id"
                                        class="form-control">
                                        @foreach ($openingCeditCategoryDDL as $category)
                                            <option value="{{ $category->openning_daily_credits_id }}">
                                                {{ $category->credit_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="credit_name">Name</label>

                                    <input id="credit_name" type="text" name="credit_name"
                                        value="{{ old('credit_name', $openningCredit->credit_name) }}" required
                                        class="form-control">

                                    <span class="text-danger">
                                        @error('credit_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="credit_blance">Credit Blance</label>
                                    <input id="credit_blance" type="number" step="0.01" name="credit_blance"
                                        value="{{ old('credit_blance', $openningCredit->credit_blance) }}" min="0"
                                        required class="form-control">

                                    <span class="text-danger">
                                        @error('credit_blance')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <div class="col-12  mt-1 d-flex justify-content-end">
                                <button type="submit"
                                    class="btn btn-sm btn-primary 
                        {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">Add
                                    Credit (-)</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="row" style="display: {{ $isNewDailyExpanse ? 'none' : '' }}">
                <div class="col-12 pt-2 pb-1">
                    <h6 class="text-center text-primary" style="letter-spacing: 1px;">All-March Bangladesh Limited</h6>
                    <p class="text-center" style="font-size: 12px">Cash Summary As at
                        {{ $oppenningExpanse && $oppenningExpanse->opening_date ? \Carbon\Carbon::parse($oppenningExpanse->opening_date)->format('d-m-Y') : 'N/A' }}
                    </p>
                </div>
                <div class="col-12">
                    <table id="myTable" class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th colspan="3" class="text-center">Debit</th>
                                <th></th>
                                <th colspan="3" class="text-center">Credit</th>
                                <th class="text-center">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $indexOfDebitPrint = 0;
                                $debitTotalSum = 0;
                                $creditTotalSum = 0;
                                $creditSubTotal = 0;
                            @endphp

                            @foreach ($openingCeditCategoryDDL as $objCrediCategory)
                                {{-- First Category Print --}}
                                <tr>
                                    <td style="width: 4%">
                                        @if (isset($openingDebitList[$indexOfDebitPrint]))
                                            <a class="link"
                                                onClick="confirmDelete('{{ url('/accountDaily/deleteDebitOrCredit') }}/{{ $openingDebitList[$indexOfDebitPrint]->openning_daily_debit_expanses_id }}/debit')">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="width: 100px;">
                                        @if (isset($openingDebitList[$indexOfDebitPrint]))
                                            {{ \Carbon\Carbon::parse($openingDebitList[$indexOfDebitPrint]->debit_date)->format('d-m-Y') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($openingDebitList[$indexOfDebitPrint]))
                                            {{ $openingDebitList[$indexOfDebitPrint]->debit_name }}
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if (isset($openingDebitList[$indexOfDebitPrint]))
                                            {{ $openingDebitList[$indexOfDebitPrint]->debit_blance }}
                                            @php
                                                $debitTotalSum += $openingDebitList[$indexOfDebitPrint]->debit_blance;
                                            @endphp
                                        @endif
                                    </td>
                                    <td colspan="3" class="text-center">
                                        <b>{{ $objCrediCategory->credit_category_name }}</b>
                                    </td>
                                    <td></td>
                                </tr>
                                @php
                                    $creditSubTotal = 0;
                                    $filterSubCreditList = $openingCreditDetailsList->filter(function ($f) use (
                                        $objCrediCategory,
                                    ) {
                                        return $f->openning_daily_credits_id ==
                                            $objCrediCategory->openning_daily_credits_id;
                                    });
                                @endphp
                                {{-- Second All Sub Category Print --}}
                                @foreach ($filterSubCreditList as $objSubCredit)
                                    @php
                                        $indexOfDebitPrint++;
                                    @endphp
                                    <tr>
                                        <td style="width: 4%">
                                            @if (isset($openingDebitList[$indexOfDebitPrint]))
                                                <a class="link"
                                                    onClick="confirmDelete('{{ url('/accountDaily/deleteDebitOrCredit') }}/{{ $openingDebitList[$indexOfDebitPrint]->openning_daily_debit_expanses_id }}/debit')">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($openingDebitList[$indexOfDebitPrint]))
                                                {{ \Carbon\Carbon::parse($openingDebitList[$indexOfDebitPrint]->debit_date)->format('d-m-Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($openingDebitList[$indexOfDebitPrint]))
                                                {{ $openingDebitList[$indexOfDebitPrint]->debit_name }}
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            @if (isset($openingDebitList[$indexOfDebitPrint]))
                                                {{ $openingDebitList[$indexOfDebitPrint]->debit_blance }}
                                                @php
                                                    $debitTotalSum +=
                                                        $openingDebitList[$indexOfDebitPrint]->debit_blance;
                                                @endphp
                                            @endif
                                        </td>
                                        <td style="width: 4%">

                                            <a class="link"
                                                onClick="confirmDelete('{{ url('/accountDaily/deleteDebitOrCredit') }}/{{ $objSubCredit->openning_daily_credit_details_expanses_id }}/credit')">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>

                                        </td>
                                        <td style="width: 100px;">
                                            {{ \Carbon\Carbon::parse($objSubCredit->credit_date)->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            {{ $objSubCredit->credit_name }}
                                        </td>
                                        <td class="text-end">
                                            {{ $objSubCredit->credit_blance }}
                                            @php
                                                $creditSubTotal += $objSubCredit->credit_blance;
                                                $creditTotalSum += $objSubCredit->credit_blance;
                                            @endphp
                                        </td>
                                        <td></td>
                                @endforeach
                                @php
                                    $indexOfDebitPrint++;
                                @endphp
                                {{-- Third After Category Print Empty row Print --}}
                                <tr>
                                    <td style="width: 4%">
                                        @if (isset($openingDebitList[$indexOfDebitPrint]))
                                            <a class="link"
                                                onClick="confirmDelete('{{ url('/accountDaily/deleteDebitOrCredit') }}/{{ $openingDebitList[$indexOfDebitPrint]->openning_daily_debit_expanses_id }}/debit')">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($openingDebitList[$indexOfDebitPrint]))
                                            {{ \Carbon\Carbon::parse($openingDebitList[$indexOfDebitPrint]->debit_date)->format('d-m-Y') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($openingDebitList[$indexOfDebitPrint]))
                                            {{ $openingDebitList[$indexOfDebitPrint]->debit_name }}
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if (isset($openingDebitList[$indexOfDebitPrint]))
                                            {{ $openingDebitList[$indexOfDebitPrint]->debit_blance }}
                                            @php
                                                $debitTotalSum += $openingDebitList[$indexOfDebitPrint]->debit_blance;
                                            @endphp
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">{{ $creditSubTotal }}</td>
                                </tr>
                                @php
                                    $indexOfDebitPrint++;
                                @endphp
                            @endforeach
                            {{-- Fourth If Debit remain --}}
                            @if (!empty($openingDebitList) && count($openingDebitList) > $indexOfDebitPrint)
                                @foreach ($openingDebitList as $index => $debit)
                                    @if ($index >= $indexOfDebitPrint)
                                        <tr>
                                            <td style="width: 4%">
                                                @if (isset($openingDebitList[$indexOfDebitPrint]))
                                                    <a class="link"
                                                        onClick="confirmDelete('{{ url('/accountDaily/deleteDebitOrCredit') }}/{{ $openingDebitList[$indexOfDebitPrint]->openning_daily_debit_expanses_id }}/debit')">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($openingDebitList[$index]))
                                                    {{ \Carbon\Carbon::parse($openingDebitList[$index]->debit_date)->format('d-m-Y') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($openingDebitList[$index]))
                                                    {{ $openingDebitList[$index]->debit_name }}
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                @if (isset($openingDebitList[$index]))
                                                    {{ $openingDebitList[$index]->debit_blance }}
                                                    @php
                                                        $debitTotalSum += $openingDebitList[$index]->debit_blance;
                                                    @endphp
                                                @endif
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            {{-- Final Summery  --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end text-info">Today Total Debit:</td>
                                <td class="text-end">{{ $creditTotalSum }}</td>
                                <td class="text-end">{{ $creditTotalSum }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end text-primary">Closing Cash Balance:</td>
                                <td class="text-end">{{ $debitTotalSum - $creditTotalSum }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-start">Today Total Credit:</td>

                                <td class="text-end">{{ $debitTotalSum }}</td>
                                <td></td>
                                <td colspan="2" class="text-end">Total balance:</td>
                                <td class="text-end">{{ $debitTotalSum }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('PageName').innerText = '{{ $toptitle }}';

        function confirmAction(isEnabled) {
            if (isEnabled != true) {
                return confirm('Are you sure you want to close the daily expanse?');
            }
            return false; // Prevent action if disabled
        }

        function Search() {
            let date = document.getElementById('searchInput').value;
            console.log(date);
            window.location.href = "{{ $urlOpeningDailyExpanse }}/" + date;
        }

        function confirmDelete(url) {
            if (confirm("Want to delete this item?")) {
                window.location.href = url;
            }
        }
    </script>
    <!-- END View Content Here -->
@endsection

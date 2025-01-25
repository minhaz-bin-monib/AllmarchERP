@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer Payment</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <form action="{{ $url }}" method="post">
            @csrf

            <div class="form-row mb-3">
                <div class="form-group col-md-4">
                    <label for="customer_id">Customer Name<span class="text-danger"><b>*</b></span></label>
                    <select data-live-search="true" id="customer_id" name="customer_id" class="form-control">
                        @foreach ($customers as $mat)
                            <option value="{{ $mat['customer_id'] }}"
                                {{ old('customer_id', $customerPayment->customer_id) == $mat['customer_id'] ? 'selected' : '' }}>
                                {{ $mat['customer_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="receive_date">Receive Date <span class="text-danger"><b>*</b></span></label>
                    <input type="date" name="receive_date"
                        value="{{ old('receive_date', $customerPayment->receive_date) }}" class="form-control"
                        id="receive_date">
                    <span class="text-danger">
                        @error('receive_date')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="diposit_dmount">Diposit Amount <span class="text-danger"><b>*</b></span></label>
                    <input type="number" name="diposit_dmount" step="0.01"
                        value="{{ old('diposit_dmount', $customerPayment->diposit_dmount) }}" min="0"
                        class="form-control" id="diposit_dmount">
                    <span class="text-danger">
                        @error('diposit_dmount')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="diposit_method_id">Diposit Method <span class="text-danger"><b>*</b></span></label>
                    <select name="diposit_method_id" class="form-control">
                        @foreach ($dipositMethods as $mat)
                            <option value="{{ $mat['diposit_method_id'] }}"
                                {{ old('diposit_method_id', $customerPayment->diposit_method_id) == $mat['diposit_method_id'] ? 'selected' : '' }}>
                                {{ $mat['method_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="honour_date">Honour Date </label>
                    <input type="date" name="honour_date"
                        value="{{ old('honour_date', $customerPayment->honour_date) }}" class="form-control"
                        id="honour_date">

                </div>
                <div class="form-group col-md-4">
                    <label for="reference">Reference </label>
                    <input type="text" name="reference" value="{{ old('reference', $customerPayment->reference) }}"
                        class="form-control" id="reference">

                </div>

                <div class="form-group col-md-4">
                    <label for="bank_name_id">Bank Name</label>
                    <select name="bank_name_id" class="form-control">
                        <option value=""
                        {{ old('bank_name_id', $customerPayment->bank_name_id) == "" ? 'selected' : '' }}>
                        Select Bank
                    </option>
                        @foreach ($bankNames as $mat)
                            <option value="{{ $mat['bank_name_id'] }}"
                                {{ old('bank_name_id', $customerPayment->bank_name_id) == $mat['bank_name_id'] ? 'selected' : '' }}>
                                {{ $mat['bank_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>


            </div>
            @if ($customerPayment->customer_payment_id > 0)
                @if ($customerPayment->payment_type == 'Pending')
                    <button type="submit" class="btn mx-2 btn-primary">Update</button>
                    <p  class="btn ml-5 mt-3 btn-success" onClick="confirmStatusChange1('{{url('/customerPayment/statusChange')}}/{{$customerPayment->customer_payment_id}}/Honoured')" >Honoured</p>
                    <p  class="btn mx-2  mt-3 btn-danger"onClick="confirmStatusChange2('{{url('/customerPayment/statusChange')}}/{{$customerPayment->customer_payment_id}}/Rejected')">Rejected</p>
                @endif
            @else
                <button type="submit" class="btn mx-2 btn-primary">Save</button>
            @endif

        </form>
    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = '{{ $toptitle }}';
        $(document).ready(function() {

            $('#customer_id').selectpicker();
            $('#customer_id').selectpicker('refresh');
        });
        function confirmStatusChange1(url) {
                    if (confirm("Honoured: Only Customer Payment Status Change. no fileds data change.?")) {
                        window.location.href = url;
                    }
                }
        function confirmStatusChange2(url) {
                    if (confirm("Rejected: Only Customer Payment Status Change. no fileds data change.?")) {
                        window.location.href = url;
                    }
                }
    </script>

    <!-- END View Content Here -->
@endsection

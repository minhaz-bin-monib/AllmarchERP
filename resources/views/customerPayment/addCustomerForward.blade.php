@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Customer Forward Payment</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">

        @if ($errors->has('customer_id'))
            <div class="alert alert-danger">
                {{ $errors->first('customer_id') }}
            </div>
        @endif
        <form action="{{ $url }}" method="post">
            @csrf

            <div class="form-row mb-3">
                <div class="form-group col-md-4">
                    <label for="customer_id">Customer Name<span class="text-danger"><b>*</b></span></label>
                    <select data-live-search="true" id="customer_id" name="customer_id" class="form-control">
                        @foreach ($customers as $mat)
                            <option value="{{ $mat['customer_id'] }}"
                                {{ old('customer_id', $customerForward->customer_id) == $mat['customer_id'] ? 'selected' : '' }}>
                                {{ $mat['customer_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="opening_forward_invoice_amount">Forward Balance <span
                            class="text-danger"><b>*</b></span></label>
                    <input type="number" name="opening_forward_invoice_amount" 
                        value="{{ old('opening_forward_invoice_amount', $customerForward->opening_forward_invoice_amount) }}"
                        min="0" class="form-control" id="opening_forward_invoice_amount">
                    <span class="text-danger">
                        @error('opening_forward_invoice_amount')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                {{-- <div class="form-group col-md-4">
                    <label for="opening_forward_given_amount">Forward Balance <span
                            class="text-danger"><b>*</b></span></label>
                    <input type="number" name="opening_forward_given_amount" 
                        value="{{ old('opening_forward_given_amount', $customerForward->opening_forward_given_amount) }}"
                        min="0" class="form-control" id="opening_forward_given_amount">
                    <span class="text-danger">
                        @error('opening_forward_given_amount')
                            {{ $message }}
                        @enderror
                    </span>
                </div> --}}

            </div>
            <button type="submit" class="btn mx-2 btn-primary">Save</button>
        </form>


        <hr />
        <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Forward Balance</th>
                    {{-- <th>Forward Balance</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($customersForwardList as $prod)
                    <tr>
                        <td style="width: 6%">{{ $prod->customer_forward_blance_id }}</td>

                        <td>{{ $prod->customer_name }}</td>
                        <td>{{ $prod->opening_forward_invoice_amount }}</td>
                        {{-- <td>{{ $prod->opening_forward_given_amount }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = '{{ $toptitle }}';
        let table = new DataTable('#myTable', {
            perPage: 10, // Number of entries per page
            sortable: true, // Allow sorting
            order: [
                [0, 'desc']
            ], // Maintain initial order based on first column
        });
        $(document).ready(function() {

            $('#customer_id').selectpicker();
            $('#customer_id').selectpicker('refresh');
        });
    </script>

    <!-- END View Content Here -->
@endsection

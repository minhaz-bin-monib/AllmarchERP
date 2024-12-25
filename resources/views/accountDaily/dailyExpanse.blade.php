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
            @if(session('errorOfOpenningExpanse'))
            <div class="alert alert-danger">
                {{ session('errorOfOpenningExpanse') }}
            </div>
          @endif
          <div class="col-2">

            <input   id="searchInput" 
                    type="date"  
                   value="{{ \Carbon\Carbon::parse($openingDate)->format('Y-m-d') }}" 
                   {{ $isNewDailyExpanse == true ? '' : 'disabled' }}
                   class="form-control " />

        </div>
            <div class="col-3">
                <button id="searchButton" onClick="Search()"  class="btn btn-sm btn-primary {{ $isNewDailyExpanse == true ? '' : 'disabled' }}">  Opening Daily Expanse</button>

                {{-- <a 
                     href="{{ $isNewDailyExpanse == true ? $urlOpeningDailyExpanse : '#' }}" 
                     class="btn btn-sm btn-primary {{ $isNewDailyExpanse == true ? '' : 'disabled' }}">
                    Opening Daily Expanse
                </a> --}}
            </div>
            <div class="col-4"></div>
            <div class="col-3">
                <a 
                    href="{{ $isNewDailyExpanse != true ? $urlClosingDailyExpanse : '#' }}" 
                    class="btn btn-sm btn-primary {{ $isNewDailyExpanse != true ? '' : 'disabled' }}" 
                    onclick="return confirmAction({{ $isNewDailyExpanse }});">
                    Close Daily Expanse
                </a>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="card col-6 p-2" >
        <div class="row">
            <div class="col-12">
                <h6 
                    class="text-primary 
                    {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">Debit Expanse
                </h6>
            </div>
            <div class="col-12">
                <form action="{{$urlAddOpeningDailyDebit}}" method="post">
                    @csrf
                   
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            {{-- value {{old('expanse_date',$product->expanse_date)}} --}}
                            <label for="expanse_date">Expanse Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="expanse_date" value="" class="form-control" id="expanse_date">
                            <span class="text-danger">
                                {{-- @error('expanse_date')
                                    {{$message}}
                                @enderror --}}
                            </span>
                        </div>
                        <div class="form-group col-md-4">
                            {{-- value {{old('expanse_date',$product->expanse_date)}} --}}
                            <label for="expanse_date">Expanse Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="expanse_date" value="" class="form-control" id="expanse_date">
                            <span class="text-danger">
                                {{-- @error('expanse_date')
                                    {{$message}}
                                @enderror --}}
                            </span>
                        </div>
                        <div class="form-group col-md-4">
                            {{-- value {{old('expanse_date',$product->expanse_date)}} --}}
                            <label for="expanse_date">Expanse Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="expanse_date" value="" class="form-control" id="expanse_date">
                            <span class="text-danger">
                                {{-- @error('expanse_date')
                                    {{$message}}
                                @enderror --}}
                            </span>
                        </div>
                       
                    </div>
                
                
                    <div class="col-12 mt-1">
                        <button type="submit"  class="btn btn-sm btn-primary 
                        {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">Add Debit</button>
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
                        {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">Credit Expanse
                </h6>
            </div>
            <div class="col-12">
                <form action="{{$urlAddOpeningDailyCredit}}" method="post">
                    @csrf
                   
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            {{-- value {{old('expanse_date',$product->expanse_date)}} --}}
                            <label for="expanse_date">Expanse Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="expanse_date" value="" class="form-control" id="expanse_date">
                            <span class="text-danger">
                                {{-- @error('expanse_date')
                                    {{$message}}
                                @enderror --}}
                            </span>
                        </div>
                        <div class="form-group col-md-4">
                            {{-- value {{old('expanse_date',$product->expanse_date)}} --}}
                            <label for="expanse_date">Expanse Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="expanse_date" value="" class="form-control" id="expanse_date">
                            <span class="text-danger">
                                {{-- @error('expanse_date')
                                    {{$message}}
                                @enderror --}}
                            </span>
                        </div>
                        <div class="form-group col-md-4">
                            {{-- value {{old('expanse_date',$product->expanse_date)}} --}}
                            <label for="expanse_date">Expanse Date <span class="text-danger"><b>*</b></span></label>
                            <input type="date" name="expanse_date" value="" class="form-control" id="expanse_date">
                            <span class="text-danger">
                                {{-- @error('expanse_date')
                                    {{$message}}
                                @enderror --}}
                            </span>
                        </div>
                       
                    </div>
                
                    <div class="col-12  mt-1 d-flex justify-content-end">
                        <button type="submit"  class="btn btn-sm btn-primary 
                        {{ $isNewDailyExpanse == true ? 'disabled' : '' }}">Add Credit</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
     <div class="row" style="display: {{$isNewDailyExpanse ? 'none': ''}}">
        <div class="col-12 pt-2 pb-1">
            <h6 class="text-center text-primary" style="letter-spacing: 1px;">All-March Bangladesh Limited</h6>
            <p class="text-center" style="font-size: 12px">Cash Summary As at {{ $oppenningExpanse && $oppenningExpanse->opening_date ? \Carbon\Carbon::parse($oppenningExpanse->opening_date)->format('d-m-Y') : 'N/A' }}</p>
        </div>
        <div class="col-12">
            <table id="myTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th colspan="3">Debit</th>
                        <th colspan="3">Credit</th>
                        <th >Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>22-12-2024</td>
                        <td>Name of cost</td>
                        <td>12300</td>
                        <td colspan="3">Hossing Sir</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>22-12-2024</td>
                        <td>Name of cost</td>
                        <td>12300</td>
                        <td >22-12-2024</td>
                        <td>Name of cost sub</td>
                        <td>3000</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td ></td>
                        <td></td>
                        <td></td>
                        <td>3000</td>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3">Rajib Sir</td>
                        <td></td>
                    </tr>
                    {{-- @foreach($products as  $prod)
                    <tr>
                        <td style="width: 6%">{{ $prod->product_id }}</td>
                        <td style="width: 5%">
                            <a class="" href="{{url('/product/edit')}}/{{$prod->product_id}}"><i class="fa fa-edit"></i></a> 
                        </td>
                        <td>{{$prod->product_name}}</td>
                        <td>{{$prod->product_unit_price}}</td>
                        <td>{{$prod->registration_date}}</td>
                    </tr>
                   @endforeach --}}
                </tbody>
            </table>
        </div>
     </div>
    </div>
</div>
<script>
    document.getElementById('PageName').innerText = '{{$toptitle}}';

    function confirmAction(isEnabled) {
        if (isEnabled != true)
        {
            return confirm('Are you sure you want to close the daily expanse?');
        }
        return false; // Prevent action if disabled
    }
    function Search() {
            let date = document.getElementById('searchInput').value;
            console.log(date);
            window.location.href = "{{$urlOpeningDailyExpanse }}/" + date;
        }
</script>
<!-- END View Content Here -->
@endsection
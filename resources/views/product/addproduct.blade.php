@extends('layouts.main')

<!-- Set Title -->
@push('title')
<title>Product</title>
@endpush

@section('main-section')
<!-- START View Content Here -->

<h5>{{$toptitle}}</h5>
<form action="{{$url}}" method="post">
    @csrf
   
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="registration_date">Registration Date <span class="text-danger"><b>*</b></span></label>
            <input type="date" name="registration_date" value="{{old('registration_date',$product->registration_date)}}" class="form-control" id="registration_date">
            <span class="text-danger">
                @error('registration_date')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="product_name">Product Name <span class="text-danger"><b>*</b></span></label>
            <input type="text" name="product_name" value="{{old('product_name',$product->product_name)}}" class="form-control" id="product_name">
            <span class="text-danger">
                @error('product_name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="form-group col-md-4">
            <label for="product_code">Product Code</label>
            <input type="text" name="product_code" value="{{old('product_code',$product->product_code)}}" class="form-control" id="product_code">
        </div>

        <div class="form-group col-md-4">
            <label for="product_unit_type">Product Unit Type</label>
            <input type="text" name="product_unit_type" value="{{old('product_unit_type',$product->product_unit_type)}}"  class="form-control" id="product_unit_type" value="Kg">
        </div>
        <div class="form-group col-md-4">
            <label for="product_unit_price">Product Unit Price</label>
            <input type="number" name="product_unit_price" value="{{old('product_unit_price',$product->product_unit_price)}}" min="0" class="form-control" id="product_unit_price" >
        </div>
        <div class="form-group col-md-4">
            <label for="product_actual_price">Product Actual Price</label>
            <input type="number" name="product_actual_price" value="{{old('product_actual_price',$product->product_actual_price)}}" min="0" class="form-control" id="product_actual_price" >
        </div>

        <div class="form-group col-md-4">
            <label for="product_unit_price_c">Product Unit Price C</label>
            <input type="number" name="product_unit_price_c" value="{{old('product_unit_price_c',$product->product_unit_price_c)}}" min="0" class="form-control" id="product_unit_price_c" >
        </div>
        <div class="form-group col-md-4">
            <label for="product_net_price">Product Net Price</label>
            <input type="number" name="product_net_price" value="{{old('product_net_price',$product->product_net_price)}}" min="0" class="form-control" id="product_net_price" >
        </div>
        <div class="form-group col-md-4">
            <label for="atv_rate">ATV Rate (%)</label>
            <input type="number" name="atv_rate" value="{{old('atv_rate',$product->atv_rate)}}" class="form-control" min="0" id="atv_rate" placeholder="ATV Rate (%)">
        </div>

        <div class="form-group col-md-4">
            <label for="material_description">Material Description</label>
            <select name="material_description" class="form-control">
                <option value="" selected="">Select</option>
                <option value="SYNTHETIC  ORGANIC  COLORING  MATTER">SYNTHETIC ORGANIC COLORING MATTER</option>
                <option value="ACRYLIC  POLYMER  IN  PRIMARY  FORMS">ACRYLIC POLYMER IN PRIMARY FORMS</option>
                <option value="OTHER MINERAL SUBSTANCES">OTHER MINERAL SUBSTANCES</option>
                <option value="FIXING AGENT">FIXING AGENT</option>
                <option value="PIGMENT / PREPARATIONS BASED ON TITANIUM DIXODE CONT. <80% TITANIUM DIXODIE">PIGMENT / PREPARATIONS BASED ON TITANIUM DIXODE CONT. &lt;80% TITANIUM DIXODIE"&gt;PIGMENT / PREPARATIONS BASED ON TITANIUM DIXODE CONT. &lt;80% TITANIUM DIXODIE"&gt;PIGMENT / PREPARATIONS BASED ON TITANIUM DIXODE CONT. &lt;80% TITANIUM DIXODIE</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="product_packing">Product Packing</label>
            <input type="number" name="product_packing" value="{{old('product_packing',$product->product_packing)}}" min="0" class="form-control" id="product_packing" >
        </div>

        <div class="form-group col-md-4">
            <label for="import_information">Import Information</label>
            <input type="text" name="import_information" value="{{old('import_information',$product->import_information)}}" class="form-control" id="import_information">
        </div>
        <div class="form-group col-md-4">
            <label for="second_material_description">Second Material Description</label>
            <select name="material_description" class="form-control">
                <option value="" selected="">Select</option>
                <option value="ECHODISCHARGE ULTRA WHITE">ECHODISCHARGE ULTRA WHITE</option>
                <option value="ECHODISCHARGE BASE">ECHODISCHARGE BASE</option>
                <option value="PRINTEX BASE G">PRINTEX BASE G</option>
                <option value="TX WHITE">TX WHITE</option>
                <option value="PRINTEX FLOCK BASE">PRINTEX FLOCK BASE</option>
                <option value="PIGMENT PASTE">PIGMENT PASTE</option>
                <option value="ELASTIC WHITE">ELASTIC WHITE</option>
                <option value="ELASTIC BASE">ELASTIC BASE</option>
                <option value="PIGMENT REDY PASTE">PIGMENT REDY PASTE</option>
                <option value="PIGMENT WHITE">PIGMENT WHITE</option>
                <option value="FIXING AGENT">FIXING AGENT</option>
                <option value="PVC-PHTHALATE FREE PLASTISOL">PVC-PHTHALATE FREE PLASTISOL</option>
                <option value="PHTHALATE FREE PLASTISOL">PHTHALATE FREE PLASTISOL</option>
                <option value="PIGMENT BASE">PIGMENT BASE</option>
                <option value="TMN COLORS">TMN COLORS</option>
                <option value="BINDER">BINDER</option>
                <option value="TABLE GUM">TABLE GUM</option>
                <option value="GOTS CERTIFIED ELASTIC WHITE">GOTS CERTIFIED ELASTIC WHITE</option>
                <option value="WATER BASE PUFF">WATER BASE PUFF</option>
                <option value="WATER BASED HIGH CONC FOAM (PUFF)">WATER BASED HIGH CONC FOAM (PUFF)</option>
                <option value="PIGMENT FLUORESCENT COLOR">PIGMENT FLUORESCENT COLOR</option>
                <option value="ECOPLAST DEEP GREEN">ECOPLAST DEEP GREEN</option>
                <option value="ECOPLAST FUSCHIA">ECOPLAST FUSCHIA</option>
                <option value="ECOPLAST GOLDEN YELLOW">ECOPLAST GOLDEN YELLOW</option>
                <option value="ECOPLAST VIOLET">ECOPLAST VIOLET</option>
                <option value="ECOPLAST LIGHT ORANGE">ECOPLAST LIGHT ORANGE</option>
                <option value="ECOPLAST LIGHT YELLOW">ECOPLAST LIGHT YELLOW</option>
                <option value="ECOPLAST FLUO MAGENTA">ECOPLAST FLUO MAGENTA</option>
                <option value="ECOPLAST SCARLET">ECOPLAST SCARLET</option>
                <option value="ECOPLAST WHITE">ECOPLAST WHITE</option>
                <option value="ECOPLAST FOAM CONC">ECOPLAST FOAM CONC</option>
                <option value="ECOPLAST HIGH DENSITY GEL">ECOPLAST HIGH DENSITY GEL</option>
                <option value="ECOPLAST GEL">ECOPLAST GEL</option>
                <option value="ECOPLAST CARMEN">ECOPLAST CARMEN</option>
                <option value="ECOPLAST FLUO COLORS">ECOPLAST FLUO COLORS</option>
                <option value="ECHOPLAST THINNER">ECHOPLAST THINNER</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="h_s_code">Harmonized System (H.S Code)</label>
            <input type="text" name="h_s_code" value="{{old('h_s_code',$product->h_s_code)}}" class="form-control" id="h_s_code">
        </div>
        <div class="form-group col-md-4">
            <label for="low_stock_alert">Low Stock Alert</label>
            <input type="number" name="low_stock_alert" value="{{old('low_stock_alert',$product->low_stock_alert)}}" min="0" class="form-control" id="low_stock_alert" >
        </div>
        <div class="form-group col-md-4">
            <label for="product_description">Product Description</label>
            <input type="text" name="product_description" value="{{old('product_description',$product->product_description)}}" class="form-control" id="product_description">
        </div>
        <div class="form-group col-md-4">
            <label for="product_generic"> Product Generic</label>
            <select name="product_generic" class="form-control">
                <option value="" selected="">Select</option>
                <option value="Turan">Turan</option>
                <option value="Nanoprint">Nanoprint</option>
                <option value="IMPEX">IMPEX</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="product_category"> Product Category</label>
            <select name="product_category" class="form-control">
                <option value="" selected="">Select</option>
                <option value="Printex">Printex</option>
                <option value="Ecoplast">Ecoplast</option>
                <option value="TMN Colors">TMN Colors</option>
                <option value="IMPEX">IMPEX</option>
                <option value="Nanoprint">Nanoprint</option>
                <option value="Pending">Pending</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="product_brand"> Product Brand</label>
            <select name="product_brand" class="form-control">
                <option value="" selected="">Select</option>
                <option value="Turan Kimya">Turan Kimya</option>
                <option value="All-march">All-march</option>
                <option value="IMPEX">IMPEX</option>
                <option value="Philips">Philips</option>
                <option value="Lenovo">Lenovo</option>
                <option value="Nanoprint">Nanoprint</option>
                <option value="Pending">Pending</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="product_grouping">Product Grouping</label>
            <select name="product_grouping" class="form-control">
                <option value="" selected="">Select</option>
                <option value="PAB">PAB</option>
                <option value="PAW">PAW</option>
                <option value="BXSN">BXSN</option>
                <option value="BXSN-B">BXSN-B</option>
                <option value="BINDER">BINDER</option>
                <option value="GUM MTG">GUM MTG</option>
                <option value="CXM">CXM</option>
                <option value="WXM">WXM</option>
                <option value="Nanoprint">Nanoprint</option>
                <option value="IMPEX">IMPEX</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="product_image">Product Image</label>
            <input type="file" name="product_image" class="form-control" id="product_image">
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Save</button>
</form>

<!-- END View Content Here -->
@endsection
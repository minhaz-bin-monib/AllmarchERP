@extends('layouts.main')

<!-- Set Title -->
@push('title')
    <title>Product</title>
@endpush

@section('main-section')
    <!-- START View Content Here -->

    <div class="container mt-4">
        {{-- <h5>{{$toptitle}}</h5> --}}
        <form action="{{ $url }}" method="post">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="registration_date">Registration Date <span class="text-danger"><b>*</b></span></label>
                    <input type="date" name="registration_date"
                        value="{{ old('registration_date', $product->registration_date) }}" class="form-control"
                        id="registration_date">
                    <span class="text-danger">
                        @error('registration_date')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_name">Product Name <span class="text-danger"><b>*</b></span></label>
                    <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}"
                        class="form-control" id="product_name">
                    <span class="text-danger">
                        @error('product_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_code">Product Code</label>
                    <input type="text" name="product_code" value="{{ old('product_code', $product->product_code) }}"
                        class="form-control" id="product_code">
                </div>

                <div class="form-group col-md-4">
                    <label for="product_unit_type">Product Unit Type</label>
                    <input type="text" name="product_unit_type"
                        value="{{ old('product_unit_type', $product->product_unit_type) }}" class="form-control"
                        id="product_unit_type" value="Kg">
                </div>
                <div class="form-group col-md-4">
                    <label for="product_unit_price">Product Unit Price</label>
                    <input type="number" name="product_unit_price" step="0.01"
                        value="{{ old('product_unit_price', $product->product_unit_price) }}" min="0"
                        class="form-control" id="product_unit_price">
                </div>
                <div class="form-group col-md-4">
                    <label for="product_actual_price">Product Actual Price</label>
                    <input type="number" name="product_actual_price" step="0.01"
                        value="{{ old('product_actual_price', $product->product_actual_price) }}" min="0"
                        class="form-control" id="product_actual_price">
                </div>

                <div class="form-group col-md-4">
                    <label for="product_unit_price_c">Product Unit Price C</label>
                    <input type="number" name="product_unit_price_c" step="0.01"
                        value="{{ old('product_unit_price_c', $product->product_unit_price_c) }}" min="0"
                        class="form-control" id="product_unit_price_c">
                </div>
                <div class="form-group col-md-4">
                    <label for="product_net_price">Product Net Price</label>
                    <input type="number" name="product_net_price" step="0.01"
                        value="{{ old('product_net_price', $product->product_net_price) }}" min="0"
                        class="form-control" id="product_net_price">
                </div>
                <div class="form-group col-md-4">
                    <label for="atv_rate">ATV Rate (%)</label>
                    <input type="number" name="atv_rate" step="0.01" value="{{ old('atv_rate', $product->atv_rate) }}"
                        class="form-control" min="0" id="atv_rate" placeholder="ATV Rate (%)">
                </div>

                <div class="form-group col-md-4">
                    <label for="material_description">Material Description</label>
                    <select name="material_description" class="form-control">
                        <option value=""
                            {{ old('material_description', $product->material_description) == '' ? 'selected' : '' }}>
                            Select</option>
                        <option value="SYNTHETIC ORGANIC COLORING MATTER"
                            {{ old('material_description', $product->material_description) == 'SYNTHETIC ORGANIC COLORING MATTER' ? 'selected' : '' }}>
                            SYNTHETIC ORGANIC COLORING MATTER</option>
                        <option value="ACRYLIC POLYMER IN PRIMARY FORMS"
                            {{ old('material_description', $product->material_description) == 'ACRYLIC POLYMER IN PRIMARY FORMS' ? 'selected' : '' }}>
                            ACRYLIC POLYMER IN PRIMARY FORMS</option>
                        <option value="OTHER MINERAL SUBSTANCES"
                            {{ old('material_description', $product->material_description) == 'OTHER MINERAL SUBSTANCES' ? 'selected' : '' }}>
                            OTHER MINERAL SUBSTANCES</option>
                        <option value="FIXING AGENT"
                            {{ old('material_description', $product->material_description) == 'FIXING AGENT' ? 'selected' : '' }}>
                            FIXING AGENT</option>
                        <option value="PIGMENT / PREPARATIONS BASED ON TITANIUM DIOXIDE CONT. <80% TITANIUM DIOXIDE"
                            {{ old('material_description', $product->material_description) == 'PIGMENT / PREPARATIONS BASED ON TITANIUM DIOXIDE CONT. <80% TITANIUM DIOXIDE' ? 'selected' : '' }}>
                            PIGMENT / PREPARATIONS BASED ON TITANIUM DIOXIDE CONT. <80% TITANIUM DIOXIDE</option>
                        <option value="N/A"
                            {{ old('material_description', $product->material_description) == 'N/A' ? 'selected' : '' }}>
                            N/A</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_packing">Product Packing</label>
                    <input type="number" name="product_packing" step="0.01"
                        value="{{ old('product_packing', $product->product_packing) }}" min="0"
                        class="form-control" id="product_packing">
                </div>

                <div class="form-group col-md-4">
                    <label for="import_information">Import Information</label>
                    <input type="text" name="import_information"
                        value="{{ old('import_information', $product->import_information) }}" class="form-control"
                        id="import_information">
                </div>
                <div class="form-group col-md-4">
                    <label for="second_material_description">Second Material Description</label>
                    <select name="second_material_description" class="form-control">
                        <option value=""
                            {{ old('second_material_description', $product->second_material_description) == '' ? 'selected' : '' }}>
                            Select</option>
                        <option value="ECHODISCHARGE ULTRA WHITE"
                            {{ old('second_material_description', $product->second_material_description) == 'ECHODISCHARGE ULTRA WHITE' ? 'selected' : '' }}>
                            ECHODISCHARGE ULTRA WHITE</option>
                        <option value="ECHODISCHARGE BASE"
                            {{ old('second_material_description', $product->second_material_description) == 'ECHODISCHARGE BASE' ? 'selected' : '' }}>
                            ECHODISCHARGE BASE</option>
                        <option value="PRINTEX BASE G"
                            {{ old('second_material_description', $product->second_material_description) == 'PRINTEX BASE G' ? 'selected' : '' }}>
                            PRINTEX BASE G</option>
                        <option value="TX WHITE"
                            {{ old('second_material_description', $product->second_material_description) == 'TX WHITE' ? 'selected' : '' }}>
                            TX WHITE</option>
                        <option value="PRINTEX FLOCK BASE"
                            {{ old('second_material_description', $product->second_material_description) == 'PRINTEX FLOCK BASE' ? 'selected' : '' }}>
                            PRINTEX FLOCK BASE</option>
                        <option value="PIGMENT PASTE"
                            {{ old('second_material_description', $product->second_material_description) == 'PIGMENT PASTE' ? 'selected' : '' }}>
                            PIGMENT PASTE</option>
                        <option value="ELASTIC WHITE"
                            {{ old('second_material_description', $product->second_material_description) == 'ELASTIC WHITE' ? 'selected' : '' }}>
                            ELASTIC WHITE</option>
                        <option value="ELASTIC BASE"
                            {{ old('second_material_description', $product->second_material_description) == 'ELASTIC BASE' ? 'selected' : '' }}>
                            ELASTIC BASE</option>
                        <option value="PIGMENT REDY PASTE"
                            {{ old('second_material_description', $product->second_material_description) == 'PIGMENT REDY PASTE' ? 'selected' : '' }}>
                            PIGMENT REDY PASTE</option>
                        <option value="PIGMENT WHITE"
                            {{ old('second_material_description', $product->second_material_description) == 'PIGMENT WHITE' ? 'selected' : '' }}>
                            PIGMENT WHITE</option>
                        <option value="FIXING AGENT"
                            {{ old('second_material_description', $product->second_material_description) == 'FIXING AGENT' ? 'selected' : '' }}>
                            FIXING AGENT</option>
                        <option value="PVC-PHTHALATE FREE PLASTISOL"
                            {{ old('second_material_description', $product->second_material_description) == 'PVC-PHTHALATE FREE PLASTISOL' ? 'selected' : '' }}>
                            PVC-PHTHALATE FREE PLASTISOL</option>
                        <option value="PHTHALATE FREE PLASTISOL"
                            {{ old('second_material_description', $product->second_material_description) == 'PHTHALATE FREE PLASTISOL' ? 'selected' : '' }}>
                            PHTHALATE FREE PLASTISOL</option>
                        <option value="PIGMENT BASE"
                            {{ old('second_material_description', $product->second_material_description) == 'PIGMENT BASE' ? 'selected' : '' }}>
                            PIGMENT BASE</option>
                        <option value="TMN COLORS"
                            {{ old('second_material_description', $product->second_material_description) == 'TMN COLORS' ? 'selected' : '' }}>
                            TMN COLORS</option>
                        <option value="BINDER"
                            {{ old('second_material_description', $product->second_material_description) == 'BINDER' ? 'selected' : '' }}>
                            BINDER</option>
                        <option value="TABLE GUM"
                            {{ old('second_material_description', $product->second_material_description) == 'TABLE GUM' ? 'selected' : '' }}>
                            TABLE GUM</option>
                        <option value="GOTS CERTIFIED ELASTIC WHITE"
                            {{ old('second_material_description', $product->second_material_description) == 'GOTS CERTIFIED ELASTIC WHITE' ? 'selected' : '' }}>
                            GOTS CERTIFIED ELASTIC WHITE</option>
                        <option value="WATER BASE PUFF"
                            {{ old('second_material_description', $product->second_material_description) == 'WATER BASE PUFF' ? 'selected' : '' }}>
                            WATER BASE PUFF</option>
                        <option value="WATER BASED HIGH CONC FOAM (PUFF)"
                            {{ old('second_material_description', $product->second_material_description) == 'WATER BASED HIGH CONC FOAM (PUFF)' ? 'selected' : '' }}>
                            WATER BASED HIGH CONC FOAM (PUFF)</option>
                        <option value="PIGMENT FLUORESCENT COLOR"
                            {{ old('second_material_description', $product->second_material_description) == 'PIGMENT FLUORESCENT COLOR' ? 'selected' : '' }}>
                            PIGMENT FLUORESCENT COLOR</option>
                        <option value="ECOPLAST DEEP GREEN"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST DEEP GREEN' ? 'selected' : '' }}>
                            ECOPLAST DEEP GREEN</option>
                        <option value="ECOPLAST FUSCHIA"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST FUSCHIA' ? 'selected' : '' }}>
                            ECOPLAST FUSCHIA</option>
                        <option value="ECOPLAST GOLDEN YELLOW"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST GOLDEN YELLOW' ? 'selected' : '' }}>
                            ECOPLAST GOLDEN YELLOW</option>
                        <option value="ECOPLAST VIOLET"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST VIOLET' ? 'selected' : '' }}>
                            ECOPLAST VIOLET</option>
                        <option value="ECOPLAST LIGHT ORANGE"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST LIGHT ORANGE' ? 'selected' : '' }}>
                            ECOPLAST LIGHT ORANGE</option>
                        <option value="ECOPLAST LIGHT YELLOW"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST LIGHT YELLOW' ? 'selected' : '' }}>
                            ECOPLAST LIGHT YELLOW</option>
                        <option value="ECOPLAST FLUO MAGENTA"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST FLUO MAGENTA' ? 'selected' : '' }}>
                            ECOPLAST FLUO MAGENTA</option>
                        <option value="ECOPLAST SCARLET"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST SCARLET' ? 'selected' : '' }}>
                            ECOPLAST SCARLET</option>
                        <option value="ECOPLAST WHITE"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST WHITE' ? 'selected' : '' }}>
                            ECOPLAST WHITE</option>
                        <option value="ECOPLAST FOAM CONC"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST FOAM CONC' ? 'selected' : '' }}>
                            ECOPLAST FOAM CONC</option>
                        <option value="ECOPLAST HIGH DENSITY GEL"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST HIGH DENSITY GEL' ? 'selected' : '' }}>
                            ECOPLAST HIGH DENSITY GEL</option>
                        <option value="ECOPLAST GEL"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST GEL' ? 'selected' : '' }}>
                            ECOPLAST GEL</option>
                        <option value="ECOPLAST CARMEN"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST CARMEN' ? 'selected' : '' }}>
                            ECOPLAST CARMEN</option>
                        <option value="ECOPLAST FLUO COLORS"
                            {{ old('second_material_description', $product->second_material_description) == 'ECOPLAST FLUO COLORS' ? 'selected' : '' }}>
                            ECOPLAST FLUO COLORS</option>
                        <option value="ECHOPLAST THINNER"
                            {{ old('second_material_description', $product->second_material_description) == 'ECHOPLAST THINNER' ? 'selected' : '' }}>
                            ECHOPLAST THINNER</option>
                        <option value="N/A"
                            {{ old('second_material_description', $product->second_material_description) == 'N/A' ? 'selected' : '' }}>
                            N/A</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="h_s_code">Harmonized System (H.S Code)</label>
                    <input type="text" name="h_s_code" value="{{ old('h_s_code', $product->h_s_code) }}"
                        class="form-control" id="h_s_code">
                </div>
                <div class="form-group col-md-4">
                    <label for="low_stock_alert">Low Stock Alert</label>
                    <input type="number" name="low_stock_alert" step="0.01"
                        value="{{ old('low_stock_alert', $product->low_stock_alert) }}" min="0"
                        class="form-control" id="low_stock_alert">
                </div>
                <div class="form-group col-md-4">
                    <label for="product_description">Product Description</label>
                    <input type="text" name="product_description"
                        value="{{ old('product_description', $product->product_description) }}" class="form-control"
                        id="product_description">
                </div>
                <div class="form-group col-md-4">
                    <label for="product_generic"> Product Generic</label>
                    <select name="product_generic" class="form-control">
                        <option value=""
                            {{ old('product_generic', $product->product_generic) == '' ? 'selected' : '' }}>Select</option>
                        <option value="Turan"
                            {{ old('product_generic', $product->product_generic) == 'Turan' ? 'selected' : '' }}>Turan
                        </option>
                        <option value="Nanoprint"
                            {{ old('product_generic', $product->product_generic) == 'Nanoprint' ? 'selected' : '' }}>
                            Nanoprint</option>
                        <option value="IMPEX"
                            {{ old('product_generic', $product->product_generic) == 'IMPEX' ? 'selected' : '' }}>IMPEX
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_category"> Product Category</label>
                    <select name="product_category" class="form-control">
                        <option value=""
                            {{ old('product_category', $product->product_category) == '' ? 'selected' : '' }}>Select
                        </option>
                        <option value="Printex"
                            {{ old('product_category', $product->product_category) == 'Printex' ? 'selected' : '' }}>
                            Printex</option>
                        <option value="Ecoplast"
                            {{ old('product_category', $product->product_category) == 'Ecoplast' ? 'selected' : '' }}>
                            Ecoplast</option>
                        <option value="TMN Colors"
                            {{ old('product_category', $product->product_category) == 'TMN Colors' ? 'selected' : '' }}>TMN
                            Colors</option>
                        <option value="IMPEX"
                            {{ old('product_category', $product->product_category) == 'IMPEX' ? 'selected' : '' }}>IMPEX
                        </option>
                        <option value="Nanoprint"
                            {{ old('product_category', $product->product_category) == 'Nanoprint' ? 'selected' : '' }}>
                            Nanoprint</option>
                        <option value="Pending"
                            {{ old('product_category', $product->product_category) == 'Pending' ? 'selected' : '' }}>
                            Pending</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_brand"> Product Brand</label>
                    <select name="product_brand" class="form-control">
                        <option value=""
                            {{ old('product_brand', $product->product_brand) == '' ? 'selected' : '' }}>Select</option>
                        <option value="Turan Kimya"
                            {{ old('product_brand', $product->product_brand) == 'Turan Kimya' ? 'selected' : '' }}>Turan
                            Kimya</option>
                        <option value="All-march"
                            {{ old('product_brand', $product->product_brand) == 'All-march' ? 'selected' : '' }}>All-march
                        </option>
                        <option value="IMPEX"
                            {{ old('product_brand', $product->product_brand) == 'IMPEX' ? 'selected' : '' }}>IMPEX</option>
                        <option value="Philips"
                            {{ old('product_brand', $product->product_brand) == 'Philips' ? 'selected' : '' }}>Philips
                        </option>
                        <option value="Lenovo"
                            {{ old('product_brand', $product->product_brand) == 'Lenovo' ? 'selected' : '' }}>Lenovo
                        </option>
                        <option value="Nanoprint"
                            {{ old('product_brand', $product->product_brand) == 'Nanoprint' ? 'selected' : '' }}>Nanoprint
                        </option>
                        <option value="Pending"
                            {{ old('product_brand', $product->product_brand) == 'Pending' ? 'selected' : '' }}>Pending
                        </option>
                    </select>

                </div>
                <div class="form-group col-md-4">
                    <label for="product_grouping">Product Grouping</label>
                    <select name="product_grouping" class="form-control">
                        <option value=""
                            {{ old('product_grouping', $product->product_grouping) == '' ? 'selected' : '' }}>Select
                        </option>
                        <option value="PAB"
                            {{ old('product_grouping', $product->product_grouping) == 'PAB' ? 'selected' : '' }}>PAB
                        </option>
                        <option value="PAW"
                            {{ old('product_grouping', $product->product_grouping) == 'PAW' ? 'selected' : '' }}>PAW
                        </option>
                        <option value="BXSN"
                            {{ old('product_grouping', $product->product_grouping) == 'BXSN' ? 'selected' : '' }}>BXSN
                        </option>
                        <option value="BXSN-B"
                            {{ old('product_grouping', $product->product_grouping) == 'BXSN-B' ? 'selected' : '' }}>BXSN-B
                        </option>
                        <option value="BINDER"
                            {{ old('product_grouping', $product->product_grouping) == 'BINDER' ? 'selected' : '' }}>BINDER
                        </option>
                        <option value="GUM MTG"
                            {{ old('product_grouping', $product->product_grouping) == 'GUM MTG' ? 'selected' : '' }}>GUM
                            MTG</option>
                        <option value="CXM"
                            {{ old('product_grouping', $product->product_grouping) == 'CXM' ? 'selected' : '' }}>CXM
                        </option>
                        <option value="WXM"
                            {{ old('product_grouping', $product->product_grouping) == 'WXM' ? 'selected' : '' }}>WXM
                        </option>
                        <option value="Nanoprint"
                            {{ old('product_grouping', $product->product_grouping) == 'Nanoprint' ? 'selected' : '' }}>
                            Nanoprint</option>
                        <option value="IMPEX"
                            {{ old('product_grouping', $product->product_grouping) == 'IMPEX' ? 'selected' : '' }}>IMPEX
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="product_image">Product Image</label>
                    <input type="file" name="product_image" class="form-control" id="product_image">
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <script type="text/javascript">
        document.getElementById('PageName').innerText = '{{ $toptitle }}';
    </script>

    <!-- END View Content Here -->
@endsection

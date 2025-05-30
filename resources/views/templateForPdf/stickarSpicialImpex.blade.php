@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
<title>Special Sticker</title>
@endpush

@section('main-section')
<style>
    .headerPdf {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        padding: 0px 0px;
        margin: 0px 0px;
    }

    .headerPdf p {
        margin: 0px;
        padding: 0px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .tableBox {
        border: 2px solid black;
    }

    .tableBox tr {
        border-bottom: 2px solid black;
    }

    .footerDiv {
        border: 2px solid #ddd;
        height: 643px;
        margin: 0px 5px;
        border-radius: 10px;
        padding: 10px;
    }

    .footerDiv p {
        font-weight: bold;
        font-size: 13px;
    }

    .footerDetailsTable {
        width: 60%;
        margin: 0px auto;
        font-weight: bold;
        ;
    }

    .tableBox td {
        text-align: center;
        font-weight: 300;
        width: 124px;
    }

    .footerDetailsTable td {
        font-size: 16px;
        font-weight: 300;
    }

    .label-instance {
        /* width: 900px; */
        /* Fixed width for the label */
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border: 1px solid #ccc;
        margin-bottom: 20px;
        padding: 0;
        position: relative;
        /* Crucial for absolute positioning of text */
        overflow: hidden;
        /*
              VERY IMPORTANT: Calculate this height!
              1. Find original pixel dimensions of your 'main-background.jpg'
              2. Calculate: (Original Image Height / Original Image Width) * 900
              3. Replace the value below with your calculated height.
                 An incorrect height (like 1500px if not calculated) will cause display issues.
            */
        /* height: 1050px; */
        /* <<<<----- RE-CALCULATE AND ADJUST THIS to match your main-background.jpg's aspect ratio */
    }

    .label-instance:last-child {
        margin-bottom: 0;
    }

    .label-background-image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Or 'fill' if you prefer stretching, but best to get height right */
        z-index: 1;
    }

    .variable-text {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        color: black;
        white-space: nowrap;
        z-index: 2;
        padding: 1px 2px;
        /* background-color: rgba(255, 255, 0, 0.2); /* --- TEMPORARY: For positioning aid, REMOVE LATER --- */
    }

    /* --- Text Styles for the COMBINED IMP GUM Label --- */
    /* --- UPPER SECTION of the Combined Label --- */
    .imp-product-name {
        top: 40px;
        left: 110px;
        font-size: 37px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .imp-product-description {
        top: 85px;
        left: 110px;
        font-size: 25px;
        font-weight: bold;
    }

    /* H.S. CODE VALUE - Assuming "H.S. CODE:" text is on the background image */
    .imp-hs-code-value {
        top: 266px;
        left: 700px;
        font-size: 22px;
        font-weight: bold;
    }

    /* You have values like TIN NO, IRC NO on the image as well.
           If you need to overlay their values, create similar .imp-tin-value, .imp-irc-value spans and CSS */

    .imp-batch-value {
        top: 397px;
        left: 130px;
        font-size: 17px;
        font-weight: bold;
    }

    .imp-prod-date-value {
        top: 395px;
        left: 315px;
        font-size: 18px;
        font-weight: bold;
    }

    /* Adjusted left based on your previous data */
    .imp-exp-date-value {
        top: 395px;
        left: 445px;
        font-size: 18px;
        font-weight: bold;
    }

    /* Adjusted left */
    .imp-net-weight-value {
        top: 395px;
        left: 580px;
        font-size: 18px;
        font-weight: bold;
    }

    /* Adjusted left */
    .imp-gross-weight-value {
        top: 395px;
        left: 710px;
        font-size: 18px;
        font-weight: bold;
    }

    /* Adjusted left */

    .imp-barcode-text-placeholder {
        position: fixed;
        top: 348px;
        right: 30px;
        z-index: 2;
    }

    .barcode-wrapper {
        width: 300px;
        /* Set a fixed size to stabilize layout */
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }



    /* --- LOWER SECTION of the Combined Label --- */
    .imp-lower-product-name-value {
        top: 635px;
        left: 375px;
        font-size: 32px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .imp-lower-batch-value {
        top: 932px;
        left: 430px;
        font-size: 16px;
        font-weight: bold;
    }

    /* Adjusted top & left from your example */
    .imp-lower-proddate-value {
        top: 952px;
        left: 445px;
        font-size: 20px;
        font-weight: bold;
    }

    /* Adjusted top & left */
    .imp-lower-expdate-value {
        top: 979px;
        left: 410px;
        font-size: 20px;
        font-weight: bold;
    }

    /* Adjusted top & left */
    .imp-lower-netweight-value {
        top: 1004px;
        left: 405px;
        font-size: 20px;
        font-weight: bold;
    }
</style>

<div id="printRow" class="row mb-2">
    <div class="col-12 pt-2 pb-1">
    </div>
    <div class="col-10"></div>
    <div class="col-2">
        <!-- <input type="checkbox" name="isFooterVisalbe" onClick="isFooterVisalbe1()" id="isFooterVisalbe"> -->
        <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
    </div>

</div>
<div class="row ">
    {{-- <div class="col-1"></div> --}}
    <div class="col-12">


        <div class="label-instance">
            <img
                class="label-background-image"
                src="{{ asset('img/secondary-bg.jpg') }}"
                alt="IMP GUM Combined Label Background (New)" />

            <!-- UPPER PART TEXT OVERLAYS -->
            <span class="variable-text imp-product-name">{{ $product->product_name }}</span>
            <span class="variable-text imp-product-description">({{ $product->material_description }})</span>

            <!-- HS Code Value -->
            <span class="variable-text imp-hs-code-value">{{ $product->h_s_code }}</span>

            <span class="variable-text imp-batch-value">{{ $salesInvoiceProduct->batch_no }}</span>
            <span class="variable-text imp-prod-date-value">{{ \Carbon\Carbon::parse($batch->production_date)->format('d/m/Y') }}</span>
            <span class="variable-text imp-exp-date-value">{{ \Carbon\Carbon::parse($batch->expire_date)->format('d/m/Y') }}</span>
            <span class="variable-text imp-net-weight-value">{{ str_pad(number_format($salesInvoiceProduct->packing,2), 2, '0', STR_PAD_LEFT) }} KG</span>
            <span class="variable-text imp-gross-weight-value">{{ str_pad(number_format($salesInvoiceProduct->packing+2,2), 2, '0', STR_PAD_LEFT) }} KG</span>

            <span class="variable-text imp-barcode-text-placeholder">
                <div class="barcode-wrapper">
                    <svg id="barcode"></svg>
                </div>
            </span>

            <!-- LOWER PART TEXT OVERLAYS -->
            <span class="variable-text imp-lower-product-name-value">{{ $product->product_name }}</span>

            <span class="variable-text imp-lower-batch-value">{{ $salesInvoiceProduct->batch_no }}</span>
            <span class="variable-text imp-lower-proddate-value">{{ \Carbon\Carbon::parse($batch->production_date)->format('d/m/Y') }}</span>
            <span class="variable-text imp-lower-expdate-value">{{ \Carbon\Carbon::parse($batch->expire_date)->format('d/m/Y') }}</span>
            <span class="variable-text imp-lower-netweight-value">{{ str_pad(number_format($salesInvoiceProduct->packing,2), 2, '0', STR_PAD_LEFT) }} KG</span>
        </div>


    </div>
    {{-- <div class="col-1"></div>
        <div class="col-2"> --}}

</div>
</div>
<script src="{{ asset('bootstrap/js/JsBarcode.all.min.js') }}"></script>
<script type="text/javascript">
    let isFooterVisalbe = false; //
    let dataPelod = {};

    function printPage() {
        console.log('print  page');
        let printHeader = document.getElementById('printRow');
        printHeader.style.visibility = 'hidden';
        printHeader.style.opacity = '0';
        window.print();
        printHeader.style.visibility = 'visible';
        printHeader.style.opacity = '1';
        // window.location.href = "{{ url('salesInvoice/productStickar') }}/" + {{ $salesInvoice->salesInvoice_id }} +
        //     "/" + {{ $salesInvoiceProduct->salesInvoiceProduct_id }} + "/" + dataPelod;
    }
    JsBarcode("#barcode", "{{ $salesInvoiceProduct->batch_no }}", {
        textPosition: "top",
        height: 70,
        fontSize: 20,
        width: 1.5
    });
    // document.getElementById("barcode").style.transform = "rotate(90deg)";
    const barcodeEl = document.getElementById("barcode");
    barcodeEl.style.transform = "rotate(90deg)";
    barcodeEl.style.transformOrigin = "center";
</script>


<!-- END View Content Here -->
@endsection
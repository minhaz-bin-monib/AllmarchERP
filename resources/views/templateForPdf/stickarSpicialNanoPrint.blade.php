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
            /* Back to 900px width */
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border: 3px solid #007bff;
            /* Blue border */
            margin-bottom: 5px;
            /* REDUCED margin between labels */
            padding: 5px;
        }

        .label-instance:last-child {
            margin-bottom: 0;
        }

        .header-image-container {
            width: 100%;
            /* Height will be ~112px for a 900px wide image (orig 1193x149) */
        }

        .header-image-container img {
            width: 100%;
            display: block;
        }

        .main-content-area {
            position: relative;
            width: 100%;
            height: 311px;
            /* Height for 900px width: (411 / 1193) * 900 */
            margin-top: 2px;
        }

        .main-content-area .lower-part-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: block;
            z-index: 1;
        }

        .variable-text {
            position: absolute;
            font-family: Arial, Helvetica, sans-serif;
            color: black;
            white-space: nowrap;
            z-index: 2;
        }

        /* Positions and sizes from the 900px wide version */
        .product-name-value {
            top: 14px;
            left: 400px;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .product-description-value {
            top: 95px;
            left: 300px;
            width: 450px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            white-space: normal;
            text-transform: uppercase;
        }

        .hs-code-value {
            top: 130px;
            left: 275px;
            width: 450px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .batch-no-value {
            top: 181px;
            left: 280px;
            font-size: 20px;
            font-weight: bold;
            margin-top: -5px;
        }

        .net-weight-value {
            top: 181px;
            left: 700px;
            font-size: 20px;
            font-weight: bold;
             margin-top: -5px;
        }

        .production-date-value {
            top: 207px;
            left: 210px;
            font-size: 18px;
            font-weight: bold;
        }

        .expiration-date-value {
            top: 207px;
            left: 545px;
            font-size: 18px;
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
            <div class="header-image-container">
                <img src="{{ asset('img/download.png') }}" alt="Nanoprint Kimya Header">
            </div>
            <div class="main-content-area">
                <img class="lower-part-image" src="{{ asset('img/back-ground.jpg') }}" alt="Label Lower Part">
                <span class="variable-text product-name-value">{{ $product->product_name }}</span>
                <span class="variable-text product-description-value">{{ $product->material_description }}</span>
                <span class="variable-text hs-code-value">H.S CODE {{ $product->h_s_code }}</span>
                <span class="variable-text batch-no-value"> {{ $salesInvoiceProduct->batch_no }}</span>
                <span class="variable-text net-weight-value">{{ str_pad(number_format($salesInvoiceProduct->packing), 2, '0', STR_PAD_LEFT) }} KG.</span>
                <span class="variable-text production-date-value">{{ \Carbon\Carbon::parse($batch->production_date)->format('d/m/Y') }}</span>
                <span class="variable-text expiration-date-value"> {{ \Carbon\Carbon::parse($batch->expire_date)->format('d/m/Y') }}</span>
            </div>
        </div>
        <div class="label-instance" style="margin-top: 30px;">
            <div class="header-image-container">
                <img src="{{ asset('img/download.png') }}" alt="Nanoprint Kimya Header">
            </div>
            <div class="main-content-area">
                <img class="lower-part-image" src="{{ asset('img/back-ground.jpg') }}" alt="Label Lower Part">
                <span class="variable-text product-name-value">{{ $product->product_name }}</span>
                <span class="variable-text product-description-value">{{ $product->material_description }}</span>
                <span class="variable-text hs-code-value">H.S CODE {{ $product->h_s_code }}</span>
                <span class="variable-text batch-no-value"> {{ $salesInvoiceProduct->batch_no }}</span>
                <span class="variable-text net-weight-value">{{ str_pad(number_format($salesInvoiceProduct->packing), 2, '0', STR_PAD_LEFT) }} KG.</span>
                <span class="variable-text production-date-value">{{ \Carbon\Carbon::parse($batch->production_date)->format('d/m/Y') }}</span>
                <span class="variable-text expiration-date-value"> {{ \Carbon\Carbon::parse($batch->expire_date)->format('d/m/Y') }}</span>
            </div>
        </div>
        <div class="label-instance" style="margin-top: 30px;">
            <div class="header-image-container">
                <img src="{{ asset('img/download.png') }}" alt="Nanoprint Kimya Header">
            </div>
            <div class="main-content-area">
                <img class="lower-part-image" src="{{ asset('img/back-ground.jpg') }}" alt="Label Lower Part">
                <span class="variable-text product-name-value">{{ $product->product_name }}</span>
                <span class="variable-text product-description-value">{{ $product->material_description }}</span>
                <span class="variable-text hs-code-value">H.S CODE {{ $product->h_s_code }}</span>
                <span class="variable-text batch-no-value"> {{ $salesInvoiceProduct->batch_no }}</span>
                <span class="variable-text net-weight-value">{{ str_pad(number_format($salesInvoiceProduct->packing), 2, '0', STR_PAD_LEFT) }} KG.</span>
                <span class="variable-text production-date-value">{{ \Carbon\Carbon::parse($batch->production_date)->format('d/m/Y') }}</span>
                <span class="variable-text expiration-date-value"> {{ \Carbon\Carbon::parse($batch->expire_date)->format('d/m/Y') }}</span>
            </div>
        </div>


    </div>
    {{-- <div class="col-1"></div>
        <div class="col-2"> --}}

</div>
</div>

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
</script>


<!-- END View Content Here -->
@endsection
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
            height: 500px;
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
        }
        .footerDetailsTable td {
            font-size: 16px;
            font-weight: 300;
        }
       
    </style>

    <div class="row mb-2">
        <div class="col-12 pt-2 pb-1">
        </div>
        <div class="col-10"></div>
        <div class="col-2">
            <input type="checkbox" name="isFooterVisalbe" onClick="isFooterVisalbe1()" id="isFooterVisalbe">
            <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
        </div>

    </div>
    <div class="row px-5">
        <div class="col-1"></div>
        <div class="col-8">
            <div>
                <img style="width: 100%;" src="{{ asset('img/Turan_header_logo.jpg') }}">
            </div>
            <div class="row headerPdf">
                <p style="font-size: 15px; font-weight: bold; line-height: 9px;">{{ $product->material_description }}</p>
                <p style="font-size: 20px; font-weight: bold;">{{ $product->product_name }}</p>
                <p style="font-size: 14px; font-weight: bold;">H.S CODE : {{ $product->h_s_code }}</p>
                <p>CAUTION!</p>
            </div>
            <div class="row mb-3">
                <div class="col-5">
                    <p style="font-size: 12px; font-weight: bold;letter-spacing: 0px;">
                        IMPORTER: ALL-MARCH BANGLADESH LTD. <br>
                        ADDRESS: 48/A_B, 9TH FLOOR <br>
                        ROOM NO: 901 PURANA PALTAN <br>
                        DHAKA 1000 <br>
                        IRC NO. BA0223304 <br>
                        TIN NO. 457867867901 <br>
                        COUNTRY OF ORIGIN: TURKEY

                    </p>

                </div>
                <div class="col-4">
                    <p style="font-size: 11.5px; word-spacing: 1px; letter-spacing: 1px; line-height: 16px;">
                        Storage in excessive heat and failure to keep containers
                        closed may result in skin formation and separation at the
                        surface of the products. In such cases please stir well
                        before use. Product must be protected from high
                        temperature and freezing.
                    </br>
                        <span  style="letter-spacing: -1px;font-weight:bold; word-spacing: 1px; line-height: 16px;">ALWAYS TEST PRODUCTS BEFORE USING IN
                            PRODUCTON.</span>
                        </br>
                       <span style="letter-spacing: -1px;font-weight:bold; word-spacing: 1px;"> www.turankimya.com . info@turankimya.com </span>
                    </p>
                </div>

                <div class="col-2">

                    <p style="font-size: 23px;line-height: 1px;margin: -15px 0px 23px 0px; letter-spacing: -0.5px;"><b>{{ $salesInvoiceProduct->packing * $salesInvoiceProduct->no_of_packing }} KG</b></p>
                    <table class="tableBox">
                        <tr>
                            <td>Batch No </br>
                                {{ $salesInvoiceProduct->batch_no }}
                            </td>
                        </tr>
                        <tr>
                            <td>Production Date </br>
                                {{ \Carbon\Carbon::parse($batch->production_date)->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Expiry Date </br>
                                {{ \Carbon\Carbon::parse($batch->expire_date)->format('d/m/Y') }}
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="col-1">
                    <div style="margin: 55px 0px 0px -66px;">
                        <svg id="barcode"></svg>
                    </div>

                </div>
            </div>
            <div id="footer" class="row footerDiv">
                <div class="col-10" >
                    <p style="font-size: 19px; font-weight: bold;">PRODUCT NAME: PRINTEX GLITTER BASE</p>
                    <p style="font-size: 17px; font-weight: bold; line-height: 0px; padding-left: 50px">CAUTION !</p>
                    <p style="font-size: 16px; font-weight: bold;">Causes severe skin burns and eye damage. Harmful if swallowed. Harmful in contact with skin. Harmful
                        if inhaled. May cause respiratory irritation.</p>
                    <p style="font-size: 16px; font-weight: bold;">Wear protective gloves/protective clothing/eye protection/ face protection. Wash...thoroughly after
                        handling.
                        Avoid breathing dust/fume/gas/mist/vapours/spray.</p>
                    <table class="footerDetailsTable">
                        <tr>
                            <td>Lot Number</td>
                            <td>: {{ $salesInvoiceProduct->batch_no }}</td>
                        </tr>
                        <tr>
                            <td>Production Date </td>
                            <td>: {{ \Carbon\Carbon::parse($batch->production_date)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Expiration Date</td>
                            <td>: {{ \Carbon\Carbon::parse($batch->expire_date)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>: {{ $salesInvoiceProduct->packing * $salesInvoiceProduct->no_of_packing }} KG</td>
                        </tr>
                    </table>
                </div>
                <div class="col-2">
                    <img style="width: 100%; scale: 1.6;  margin-top: 163px; margin-left: -4px;"
                        src="{{ asset('img/turan_danger.jpg') }}">
                </div>
                <div class="col-12">
                    <img style="width: 100%; scale: 0.8;" src="{{ asset('img/turan_footer.jpg') }}">
                </div>

            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-2">

        </div>
    </div>
    <script src="{{ asset('bootstrap/js/JsBarcode.all.min.js') }}"></script>
    <script type="text/javascript">
        let isFooterVisalbe = false; //
        let dataPelod = {};

        function printPage() {
            console.log('print  page');
            window.print();
            // window.location.href = "{{ url('salesInvoice/productStickar') }}/" + {{ $salesInvoice->salesInvoice_id }} +
            //     "/" + {{ $salesInvoiceProduct->salesInvoiceProduct_id }} + "/" + dataPelod;
        }

        function isFooterVisalbe1() {
            debugger;
            var isFooterVisalbe = document.getElementById('isFooterVisalbe').checked;
            var footer = document.getElementById('footer');
            dataPelod['isFooterVisalbe'] = isFooterVisalbe;
            if (isFooterVisalbe) {
                footer.style.visibility = 'hidden';
                footer.style.opacity = '0';
            } else {
                footer.style.visibility = 'visible';
                footer.style.opacity = '1';
            }
        }
        JsBarcode("#barcode", "{{ $salesInvoiceProduct->batch_no }}", {
            textPosition: "top",
            height: 40,
            fontSize: 16,
            width: 0.9
        });
        document.getElementById("barcode").style.transform = "rotate(90deg)";
    </script>


    <!-- END View Content Here -->
@endsection

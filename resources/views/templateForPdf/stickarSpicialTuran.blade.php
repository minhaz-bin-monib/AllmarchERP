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
            width: 50%;
            margin: 0px auto;
            font-weight: bold;
            ;
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
        <div class="col-8" style="border: 1px solid red">
            <div>
                <img style="width: 100%;" src="{{ asset('img/Turan_header_logo.jpg') }}">
            </div>
            <div class="row headerPdf">
                <p>SYNTHETIC ORGANIC COLORING MATTER (CAFL)</p>
                <p>ECOPLAST FOIL BASE</p>
                <p>H.S CODE : 3204.17.00</p>
                <p>CAUTION!</p>
            </div>
            <div class="row">
                <div class="col-5">
                    <p style="font-size: 12px; font-weight: bold;letter-spacing: 1px;">
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
                    <p style="font-size: 11.5px;font-weight: bold; word-spacing: 1px; letter-spacing: 1px;">
                        Storage in excessive heat and failure to keep containers
                        closed may result in skin formation and separation at the
                        surface of the products. In such cases please stir well
                        before use. Product must be protected from high
                        temperature and freezing.
                    </br>
                   <span style="letter-spacing: -1px;word-spacing: 1px;">ALWAYS TEST PRODUCTS BEFORE USING IN PRODUCTON.</span> 
                </br> 
                   www.turankimya.com . info@turankimya.com</p>
                </div>

                <div class="col-2">

                    <p><b>30 KG</b></p>
                    <table class="tableBox">
                        <tr>
                            <td>Batch No </br>
                                PGB 2012202325
                            </td>
                        </tr>
                        <tr>
                            <td>Production Date </br>
                                20/12/2023
                            </td>
                        </tr>
                        <tr>
                            <td>Expiry Date </br>
                                20/12/2025
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="col-1">
                    <div style="margin: 79px 0px 0px -66px;">
                        <svg id="barcode" ></svg>
                    </div>

                </div>
            </div>
            <div id="footer" class="row footerDiv">
                <div class="col-10">
                    <p>PRODUCT NAME: PRINTEX GLITTER BASE</p>
                    <p>CAUTION !</p>
                    <p >Causes severe skin burns and eye damage. Harmful if swallowed. Harmful in contact with skin. Harmful
                        if inhaled. May cause respiratory irritation.</p>
                    <p>Wear protective gloves/protective clothing/eye protection/ face protection. Wash...thoroughly after
                        handling.
                        Avoid breathing dust/fume/gas/mist/vapours/spray.</p>
                    <table class="footerDetailsTable">
                        <tr>
                            <td>Lot Number</td>
                            <td>: PGB 2012202325</td>
                        </tr>
                        <tr>
                            <td>Production Date </td>
                            <td>: 20/12/2023</td>
                        </tr>
                        <tr>
                            <td>Expiration Date</td>
                            <td>: 20/12/2025</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>: 30 KG</td>
                        </tr>
                    </table>
                </div>
                <div class="col-2">
                    <img style="width: 100%; scale: 1.6;  margin-top: 163px; margin-left: -4px;"
                        src="{{ asset('img/turan_danger.jpg') }}">
                </div>
                <div class="col-12">
                    <img style="width: 100%;" src="{{ asset('img/turan_footer.jpg') }}">
                </div>

            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-2" style="border: 1px solid blue">

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
            var isFooterVisalbe = document.getElementById('isFooterVisalbe').checked;
            if (isFooterVisalbe) {
                dataPelod['isFooterVisalbe'] = isFooterVisalbe;
                document.getElementById('footer').style.display = 'block';
            } else {
                dataPelod['isFooterVisalbe'] = isFooterVisalbe;
                document.getElementById('footer').style.display = 'none';
            }
        }
        JsBarcode("#barcode", "{{ 'Hi world!' }}", {
            textPosition: "top",
            height: 40,
            width: 1
        });
        document.getElementById("barcode").style.transform = "rotate(90deg)";
    </script>


    <!-- END View Content Here -->
@endsection

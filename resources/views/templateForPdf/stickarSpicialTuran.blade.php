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
        .tableBox{
            border: 2px solid black;
        }
        .tableBox tr {
            border-bottom: 2px solid black;
        }
    </style>

    <div class="row mb-2">
        <div class="col-12 pt-2 pb-1">
        </div>
        <div class="col-10"></div>
        <div class="col-2">
            <input type="checkbox" name="isFooterVisalbe" onClick="isFooterVisalbe()" id="isFooterVisalbe">
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
                <div class="col-4">
                    <p>
                        IMPORTER: ALL-MARCH BANGLADESH LTD. <br>
                        ADDRESS: 48/A_B, 9TH FLOOR <br>
                        ROOM NO: 901 PURANA PALTAN <br>
                        DHAKA 1000 <br>
                        IRC NO. BA0223304 <br>
                        TIN NO. 457867867901 <br>
                        COUNTRY OF ORIGIN: TURKEY

                    </p>

                </div>
                <div class="col-5">
                    <p>
                        Storage in excessive heat and failure to keep containers
                        closed may result in skin formation and separation at the
                        surface of the products. In such cases please stir well
                        before use. Product must be protected from high
                        temperature and freezing.
                    </p>
                    <p>ALWAYS TEST PRODUCTS BEFORE USING IN PRODUCTON. </p>
                    <p>www.turankimya.com . info@turankimya.com</p>
                </div>

                <div class="col-3">
                    <table class="tableBox" >
                        <tr>
                            <td>A</td>
                        </tr>
                        <tr>
                            <td>B</td>
                        </tr>
                        <tr>
                            <td>C</td>
                        </tr>
                    </table>
                    
                </div>
            </div>
        </div>
        <div class="col-1"></div>
        <div class="col-2" style="border: 1px solid blue">

        </div>
    </div>

    <script type="text/javascript">
        let isFooterVisalbe = false; //
        let dataPelod = {};

        function printPage() {
            console.log('print  page');
            // window.print();
            window.location.href = "{{ url('salesInvoice/productStickar') }}/" + {{ $salesInvoice->salesInvoice_id }} +
                "/" + {{ $salesInvoiceProduct->salesInvoiceProduct_id }} + "/" + dataPelod;
        }

        function isFooterVisalbe() {
            var isFooterVisalbe = document.getElementById('isFooterVisalbe').checked;
            if (isFooterVisalbe) {
                dataPelod['isFooterVisalbe'] = isFooterVisalbe;
                document.getElementById('footer').style.display = 'block';
            } else {
                dataPelod['isFooterVisalbe'] = isFooterVisalbe;
                document.getElementById('footer').style.display = 'none';
            }
        }
    </script>


    <!-- END View Content Here -->
@endsection

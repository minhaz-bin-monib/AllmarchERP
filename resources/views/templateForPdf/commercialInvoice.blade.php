<!DOCTYPE html>
<html>

<head>
    <title>PDF Document</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            font-size: 14px;
        }

        .container {
            margin: 20px;
            /* border: 1px solid #ddd; */
        }

        .row {
            padding: 3px;
            margin: 2px;
            /* border: 1px solid red; */
        }

        .textC {
            text-align: center;
        }

        .textL {
            text-align: left;
        }

        .textR {
            text-align: right;
        }

        .w-10 {
            width: 12%;
        }

        .w-25 {
            width: 25%;
        }

        .w-30 {
            width: 30%;
        }

        .w-40 {
            width: 40%;
        }

        .w-50 {
            width: 50%;
        }

        .w-60 {
            width: 60%;
        }

        .w-70 {
            width: 70%;
        }

        .w-80 {
            width: 80%;
        }

        .w-90 {
            width: 90%;
        }

        .w-95 {
            width: 95%;
        }

        .w-100 {
            width: 100%;
        }

        .floatL {
            float: left;
        }

        .floatR {
            float: right;
        }

        .floatClear {
            clear: both;
        }

        .middle {
            margin: 0 auto;
        }

        table {
            border-collapse: collapse;
            /* Ensures borders are merged */
            width: 100%;
            /* Full width */
            margin: 20px 0;
            /* Adds some space around the table */
            font-size: 13px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .htable {
            margin-top: 5px;
        }

        .htable p {
            text-align: left;
            padding: 2px;
            padding-left: 3px;
            font-size: 14px;
            border: 1px solid black;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            border-top: 1px solid #000;
            padding: 10px 0;
        }
    </style>
</head>

<body>

    <div class="container">
        @php
            $companylogoName = 'local';
            $companyName = 'All-March Bangladesh Limited';
            $companySubTitle = 'We are always around you';
            $buyerNameImg = '';
            $buyerSignature = '';
            $footerAddress = '';

            if ($transferInvoice->company == 'Allmarch Bangladesh') {
                $companylogoName = 'local';
                $companyName = 'All-March Bangladesh Limited';
                $companySubTitle = 'We are always around you';
                $buyerNameImg = 'turankimya';
                $buyerSignature = 'turansign';
                $footerAddress = 'local';
            } elseif ($transferInvoice->company == 'Allmarch International') {
                $companylogoName = 'international';
                $companyName = 'M/S. ALLMARCH INTERNATIONAL';
                $companySubTitle = '';
                $buyerNameImg = '';
                $buyerSignature = 'turansignnano';
                $footerAddress = 'international';
            }
        @endphp
        <div class="row w-70 middle ">
            <div class="w-10 floatL" style="margin-top: -9px; margin-left:5px">
                <img class="img-responsive pull-left" width="90px" height="80px"
                    src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('img/' . $companylogoName . '.jpg'))) }}"
                    alt="User profile picture">
            </div>
            <div class="w-70 floatL">

                <h1 class="textC" style="font-size: 20px;">{{ $companyName }}</h1>
                <p class="textC" style="color:grey; font: 16px Blackadder ITC, Arial;"><i>{{ $companySubTitle }}</i>
                </p>

            </div>
            <div class="floatClear"></div>
        </div>
        <!-- title row -->
        <div class="row textL" style="border-top: 2px solid rgb(0, 0, 0)">
            <p style="font-size: 14px;">Date: {{ $transferInvoice->invoice_date }}</p>
        </div>
        <div class="row textC" style="margin-bottom: 20px">
            <h2 style="font-size: 16px;">COMMERCIAL INVOICE</h2>
        </div>

        <div class="row middle" style="width: 100%">
            <div class="w-50 floatL">
                {{-- <p>BUYER NAME:</p>
                <p>
                    <br>
                    @if ($buyerNameImg == '')
                        
                        <b style="color:black; font: 16px Arial Narrow, Arial;">Nanoprint Kimya San. A.S</b><br>
                        <b style="color:black; font: 12px Arial Narrow, Arial;">IDOSB Kazlice§me cad. No:20/A
                            Aydnili-Tuzla</b><br>
                        <b style="color:black; font: 12px Arial Narrow, Arial;">34000 Istanbul, TURKEY</b>

                    @elseif($buyerNameImg == 'turankimya')
                        <img class="img-responsive pull-left" width="" height="100px"
                            src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('img/' . $buyerNameImg . '.jpg'))) }}"
                            alt="User profile picture">
                    @endif
                </p> --}}
            </div>
            <div class="w-50 floatL textR">
                <p> COMMERCIAL INVOICE NO : {{ $transferInvoice->transferInvoice_id }}</p>
                <p> PROFORMA INVOICE NO : {{ $transferInvoice->transferInvoice_id }}</p>
                <p> PROFORMA INVOICE DATE : {{ $transferInvoice->invoice_date }} </p>
                <div class="htable">
                    <p style="border-bottom: none">SEND TO:</p>
                    <p style="border-bottom: none">Name: {{ $customer->customer_name }} (Local Agent)</p>
                    <p style="border-bottom: none">Address: {{ $customer->customer_address }}</p>
                    <p>City,Postal Code : GAZIPUR, BANGLADESH</p>
                </div>
            </div>
            <div class="floatClear"></div>
        </div>
        <div class="row middle" style="width: 100%">
            <table style="width: 100%">
                <thead>

                </thead>
                <tbody>

                    @php
                        $totalCost = 0;
                        $totalWeightCount = 0;
                    @endphp
                    @foreach ($transferInvoiceProduct as $salesInvProd)
                        @php
                            $totalWeight = $salesInvProd->packing * $salesInvProd->no_of_packing;
                            $totalPrice = $totalWeight * $salesInvProd->unit_price;
                            $totalWeightCount += $totalWeight;
                            $totalCost += $totalPrice;
                        @endphp

                        <tr>
                            <td width="20%" style="text-align:center;"></td>
                            <td width="20%"></td>
                            <td width="" style="text-align:center;"></td>
                            <td width="" style="text-align:center;"></td>
                            <td width="" colspan="4" style="text-align:left;">No.of pieces</td>
                            <td width="12%" style="text-align:right;">{{ $salesInvProd->no_of_packing }}</td>
                        </tr>
                        <tr>
                            <td width="20%" style="text-align:center;"></td>
                            <td width="20%"></td>
                            <td width="" style="text-align:center;">Gross Weight</td>
                            <td width="" style="text-align:center;"></td>
                            <td width="" colspan="4" style="text-align:left;">Net Weight</td>
                            <td width="12%" style="text-align:right;">{{ number_format($totalWeight) }}</td>
                        </tr>
                        <tr>
                            <td width="20%" style="text-align:center;">Full Description Of Goods</td>
                            <td width="20%" style="text-align:center;">Product Name</td>
                            <td width="" style="text-align:center;">H.S CODE NO.</td>
                            <td width="" style="text-align:center;">Quantity</td>
                            <td width="" style="text-align:center;">Package</td>
                            <td width="3%" style="text-align:center;">Unit</td>
                            <td width="" style="text-align:center;">Net Weight</td>
                            <td width="" style="text-align:center;">Unit Value & currency</td>
                            <td width="12%" style="text-align:center;">Sub Total Value</td>
                        </tr>
                        <tr>
                            <td width="20%" style="text-align:center;"></td>
                            <td width="20%" style="text-align:center;"></td>
                            <td width="" style="text-align:center;"></td>
                            <td width="" style="text-align:center;"></td>
                            <td width="" style="text-align:center;"></td>
                            <td width="3%" style="text-align:center;"></td>
                            <td width="" style="text-align:center;">KG</td>
                            <td width="" style="text-align:center;">USD</td>
                            <td width="12%" style="text-align:center;">USD</td>
                        </tr>
                        <tr>
                            <td>{{ $salesInvProd->material_description }}</td>
                            <td>{{ $salesInvProd->product_name }}</td>
                            <td>{{ $salesInvProd->h_s_code }}</td>
                            <td class="textR">{{ $salesInvProd->no_of_packing }}</td>
                            <td class="textR">{{ $salesInvProd->packing }}</td>
                            <td>KG</td>
                            <td class="textR">{{ $totalWeight }}</td>
                            <td class="textR">{{ $salesInvProd->unit_price }}</td>
                            <td class="textR">{{ number_format($totalPrice) }}</td>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="textR"></td>
                            <td class="textR"></td>
                            <td></td>
                            <td class="textR"></td>
                            <td class="textR">TOTAL:</td>
                            <td class="textR">{{ number_format($totalPrice) }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            Payment Method: FTT

        </div>

        <div class="row  middle" style="margin-top: 150px; width:97%">
            <div class="w-50 textL floatL">
                <p>With Best Regards,</p>
            </div>
            {{-- <div class="w-50 textC floatL" style="margin-top:10px">
                <img class="img-responsive pull-left" width="" height="160px"
                            src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('img/' .$buyerSignature. '.jpg'))) }}"
                            alt="User profile picture">
            </div> --}}
            <div class="floatClear"></div>
        </div>


        <div class="row w-100 middle" style="margin-top: 10px;width:97%">
            <p class="textL">{{$companyName}}</p>
        </div>
        <div class="footer w-100 middle">
            <p>
            @if(  $footerAddress = 'local')
                <b>Reg. Address:</b>  48/A-B, Purana Palton, Baitul Khair building (9TH FLOOR), Dhaka-1000.<br>
                <b>Sales Address:</b> House# 1/C &amp; 1/D, Level# 2nd, Road# 16, Nikunja-2, Khilkhet, Dhaka-1229.
                @elseif($footerAddress = 'international')
                <b>Reg. Address:</b> KA# 142/17, Khilkhet, Dhaka-1229.<br>
                <b>Sales Address:</b> House# 1/C &amp; 1/D, Level# 2nd, Road# 16, Nikunja-2, Khilkhet, Dhaka-1229.
                
                @endIf
            </p>
        </div>

    </div>

</body>

</html>

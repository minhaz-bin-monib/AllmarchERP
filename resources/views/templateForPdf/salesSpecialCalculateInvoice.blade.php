<!DOCTYPE html>
<html>

<head>
    <title>Mushok Calculate {{ $customer->customer_name }}</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            font-size: 14px;
        }

        .container {
            margin: 40px 25px;
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
        }

        th,
        td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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

            $companyName = match ($salesInvoice->company) {
                'Allmarch Bangladesh' => 'All-March Bangladesh Limited',
                'Allmarch International' => 'M/S. Allmarch International',
                'Believers International' => 'M/S. Believers International',
                default => null,
            };
            $companyLogo = match ($salesInvoice->company) {
                'Allmarch Bangladesh' => 'logo',
                'Allmarch International' => 'international',
                'Believers International' => 'believers_logo',
                default => null,
            };
        @endphp
        <div class="row w-70 middle ">
            <div class="w-10 floatL" style="margin-top: -9px; margin-left:5px">
                <img class="img-responsive pull-left" width="90px"
                    src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('img/' . $companyLogo . '.jpg'))) }}"
                    alt="User profile picture">
            </div>
            <div class="w-70 floatL">
                <h1 class="textC" style="font-size: 18px;">{{ $companyName }}</h1>
                @if ($salesInvoice->company == 'Allmarch Bangladesh')
                    <p class="textC" style="color:grey; font: 16px Blackadder ITC, Arial;"><i>We are always
                            around you</i>
                    </p>
                @endif

            </div>
            <div class="floatClear"></div>
        </div>
        <!-- title row -->
        <div class="row textC" style="margin-bottom: 20px">
            <h2 style="font-size: 16px;">Special Calculate</h2>
        </div>

        <div class="row middle" style="width: 97%">
            <div class="w-60 floatL">
                <p> Name: {{ $customer->customer_name }}</p>
                <p> Phone :{{ $customer->customer_phone }} </p>
                <p>{{ $customer->customer_address }}</p>
            </div>
            <div class="w-40 floatL textR">
                <p> Date : {{ $salesInvoice->invoice_date }} </p>
                <p> Invoice No : IN{{ str_pad($salesInvoice->salesInvoice_id, 5, '0', STR_PAD_LEFT)  }}</p>
                <p> Delivery Receipt No : DN{{ str_pad($salesInvoice->salesInvoice_id + 145, 5, '0', STR_PAD_LEFT)  }}</p>
            </div>
            <div class="floatClear"></div>
        </div>
        <div class="row middle textR" style="width: 97%">
            Order Ref : {{ $salesInvoice->order_ref }}
        </div>
        <div class="row middle" style="width: 100%">
            <table style="width: 100%">
                <thead>
                    <tr style="background-color:rgb(240, 240, 240);">
                        <th width="5%" style="text-align:center;">SL.</th>
                        <th width="30%">Product Name</th>
                        <th width="20%" style="text-align:center;">Import Info</th>
                        <th width="10%" style="text-align:center;">Quantity</th>
                        <th width="15%" style="text-align:center;">Unit price</th>
                        <th width="15%" style="text-align:center;">Total Cost</th>
                        <th width="15%" style="text-align:center;">ATV Amount (%)</th>
                        <th width="20%" style="text-align:center;">Total Price(Tk)</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $totalCostSum = 0;
                        $totalATVAmountSum = 0;
                        $totalPriceSum = 0;
                        $totalWeightCount = 0;
                    @endphp
                    @foreach ($salesInvoiceProduct as $salesInvProd)
                        @php
                            $totalWeight = $salesInvProd->packing * $salesInvProd->no_of_packing;
                            $totalCost = $totalWeight * $salesInvProd->product_unit_price_c;
                            $totalATVAmount =  $totalCost * ($salesInvProd->atv_rate/100);
                            $totalPrice = $totalCost + $totalATVAmount;

                            $totalWeightCount += $totalWeight;
                            $totalCostSum += $totalCost;
                            $totalATVAmountSum += $totalATVAmount;
                            $totalPriceSum += $totalPrice;
                            
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td>{{ $salesInvProd->product_name }}</td> --}}
                            <td>{{ $salesInvProd->material_description }}</td>
                            <td>{{ $salesInvProd->import_info }} ({{$salesInvProd->atv_rate}}%)</td>
                            <td>{{ number_format($totalWeight, 2) }} kg</td>
                            {{-- <td class="textC">{{ number_format($salesInvProd->unit_price, 2) }}</td> --}}
                            <td class="textC">{{ number_format($salesInvProd->product_unit_price_c, 2) }}</td>
                            <td style="text-align:right;">{{ number_format($totalCost, 2) }} Tk</td>
                            <td style="text-align:right;">{{ number_format($totalATVAmount, 2) }} Tk</td>
                            <td style="text-align:right;">{{ number_format($totalPrice, 2) }} Tk</td>

                        </tr>
                    @endforeach
                    <tr>
                        <td ></td>
                        <td colspan="2" style="text-align:right;"><strong>Total Amount: </strong></td>
                        <td><strong>{{ number_format($totalWeightCount, 2) }}</strong> Kg</td>
                        <td ></td>
                        <td style="text-align:right;"><strong> {{ number_format($totalCostSum, 2) }}</strong> Tk</td>
                        <td style="text-align:right;"><strong> {{ number_format($totalATVAmountSum, 2) }}</strong> Tk</td>
                        <td style="text-align:right;"><strong> {{ number_format($totalPriceSum, 2) }}</strong> Tk</td>
                    </tr>
                </tbody>
            </table>
            @php
                $amountParts = explode('.', number_format($totalPriceSum, 2, '.', ''));
                $integerPart = $converter->toWords($amountParts[0]);
                $decimalPart = isset($amountParts[1]) ? $converter->toWords($amountParts[1]) : 'zero';
            @endphp
            In Word: <b>{{ ucwords("{$integerPart} Taka & {$decimalPart} Paisa ") }}</b> Only
            {{-- In Word: <b>{{ $converter->toWords($totalCost) }}</b> only --}}

        </div>

        <div class="row  middle" style="margin-top: 100px; width:97%">
            <div class="w-50 textC floatL">
                <div class="">....................................................................</div>
                <div class="">Authorized By</div>
            </div>
            <div class="w-50 textC floatL">
                <div class="">.......................................................</div>
                <div class="">Received By</div>
            </div>
            <div class="floatClear"></div>
        </div>


        <div class="row w-100 middle" style="margin-top: 100px;width:97%">
            <p class="textR">Delivery By:  {{ $employee->nick_name }}</p>
        </div>
        <div class="footer w-100 middle">
            <p>House# 1/A, Road# 15, Nikunju-2, Khilkhet, Dhaka-1229, Contact: +8801713221101-10, E-mail:
                info@all-marchbd.com</p>

        </div>

    </div>

</body>

</html>

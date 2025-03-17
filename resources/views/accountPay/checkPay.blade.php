@extends('layouts.mainFullPage')

<!-- Set Title -->
@push('title')
    <title>Pay Check</title>
@endpush

@section('main-section')
    <style>
        .border_btm {
            width: 762px;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        .fontSize {
            font-size: 30px;
        }

        .dateCom {
            letter-spacing: 14px;
        }
    </style>
    <div id="printRow" class="row mb-2">
        <div class="col-12 pt-2 pb-1">
        </div>
        <div class="col-10"></div>
        <div class="col-2">
            {{-- <input type="checkbox" name="isFooterVisalbe" onClick="isFooterVisalbe1()" id="isFooterVisalbe"> --}}
            <a class="btn btn-primary btn-sm" onClick="printPage()"> <i class="fa fa-print"></i> Print</a>
        </div>

    </div>
    <div class="row ">
        <div class="col-9 mb-5 mt-5"></div>
        <div class="col-3 mb-5 mt-5">
            <input id="checkDate" type="date" id="checkDate">
            <span class="fontSize dateCom" id="checkDateView"></span>
        </div>
        <div class="col-12">
            <p> <span id="checkPayName" class="displayNone"> Pay To
                    <input type="text" class="border_btm" id="checkPayName_input" placeholder="Type Name">
                </span>
                <span class="fontSize" style="padding-left: 100px" id="checkPayNameView"></span>
            </p>
        </div>
        <div class="col-8">
            <p> <span id="checkPayWord"> The Sum of Taka </span>
                <span class="fontSize" style="padding-left: 120px" id="checkPayWordView1"></span> <br />
                <span class="fontSize" style="padding-left: 55px" id="checkPayWordView2"></span>
            </p>
        </div>
        <div class="col-4">
            <input type="number" id="checkPayAmount" oninput="handleInput(this)" placeholder="Type tk">
            <span class="fontSize" id="checkPayAmountView"></span>
        </div>

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

            // display Name 
            let checkPayName = document.getElementById('checkPayName');
            let checkPayName_input = document.getElementById('checkPayName_input');
            document.getElementById('checkPayNameView').innerText = checkPayName_input.value;
            checkPayName.style.display = 'none';

            // display date
            let checkDate_input = document.getElementById('checkDate');
            const [year, month, day] = checkDate_input.value.split('-');
            document.getElementById('checkDateView').innerText = day + month + year;
            checkDate_input.style.display = 'none'

            // display Amount to word
            document.getElementById('checkPayWord').style.display = 'none';

            // display Amount 

            let checkPayAmount_input = document.getElementById('checkPayAmount');
            document.getElementById('checkPayAmountView').innerText = '= ' + formatIndianNumber(checkPayAmount_input
                .value) + '/=';
            checkPayAmount_input.style.display = 'none';

            window.print();
            printHeader.style.visibility = 'visible';
            printHeader.style.opacity = '1';
        }

        // Handle oninput event
        function handleInput(input) {
            console.log('Input value changed:', input.value);
            let words = numberToIndianWords(input.value) + ' only';
            let wordsSentence = words.split(' ').map(function(word) {
                return word.charAt(0).toUpperCase() + word.slice(1);
            }).join(' ');
            let result = splitSentenceByWords(wordsSentence);

            document.getElementById('checkPayWordView1').innerText = result.firstPart;
            document.getElementById('checkPayWordView2').innerText = result.secondPart;

        }

        function splitSentenceByWords(wordsSentence) {
            // Split the sentence into an array of words
            let wordsArray = wordsSentence.trim().split(/\s+/);

            // Get the first 5 words
            let firstPart = wordsArray.slice(0, 5).join(' ');

            // Get the remaining words
            let secondPart = wordsArray.slice(5).join(' ');

            return {
                firstPart: firstPart,
                secondPart: secondPart
            };
        }

        // Handle keydown for Arrow Up and Arrow Down
        // document.getElementById('checkPayAmount').addEventListener('keydown', function(event) {
        //     if (event.key === 'ArrowUp') {
        //         console.log('Arrow Up pressed');

        //         this.value = parseInt(this.value || 0) + 1;

        //         handleInput(this);
        //     } else if (event.key === 'ArrowDown') {
        //         console.log('Arrow Down pressed');

        //         this.value = parseInt(this.value || 0) - 1;

        //         handleInput(this);
        //     }
        // });
        function numberToIndianWords(num) {
            if (num === 0) return "zero";

            const belowTwenty = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten",
                "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen",
                "seventeen", "eighteen", "nineteen"
            ];

            const tens = ["", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];

            function convert_hundred(n) {
                let str = "";
                if (n > 99) {
                    str += belowTwenty[Math.floor(n / 100)] + " hundred ";
                    n = n % 100;
                }
                if (n > 19) {
                    str += tens[Math.floor(n / 10)] + " ";
                    n = n % 10;
                }
                if (n > 0) {
                    str += belowTwenty[n] + " ";
                }
                return str.trim();
            }

            let result = "";

            // Crore
            let crore = Math.floor(num / 10000000);
            if (crore > 0) {
                result += convert_hundred(crore) + " crore ";
                num = num % 10000000;
            }

            // Lakh
            let lakh = Math.floor(num / 100000);
            if (lakh > 0) {
                result += convert_hundred(lakh) + " lakh ";
                num = num % 100000;
            }

            // Thousand
            let thousand = Math.floor(num / 1000);
            if (thousand > 0) {
                result += convert_hundred(thousand) + " thousand ";
                num = num % 1000;
            }

            // Hundred and below
            if (num > 0) {
                result += convert_hundred(num);
            }

            return result.trim();
        }

        function formatIndianNumber(num) {
            // Convert number to string if it's not already
            num = num.toString();

            // Split integer and decimal parts (optional)
            let [integerPart, decimalPart] = num.split('.');

            // First comma after 3 digits from the end
            let lastThree = integerPart.slice(-3);

            // Remaining digits
            let otherNumbers = integerPart.slice(0, -3);

            // Add commas for every two digits
            if (otherNumbers !== '') {
                lastThree = ',' + lastThree;
            }

            let formatted = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;

            // Add decimal part back (optional)
            if (decimalPart !== undefined) {
                formatted += '.' + decimalPart;
            }

            return formatted;
        }
    </script>


    <!-- END View Content Here -->
@endsection

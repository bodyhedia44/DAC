<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Invoice</title>
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    <!-- Favicon -->
{{--    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />--}}

    <!-- Invoice styling -->
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;--}}
{{--            text-align: center;--}}
{{--            color: #777;--}}
{{--        }--}}

{{--        body h1 {--}}
{{--            font-weight: 300;--}}
{{--            margin-bottom: 0px;--}}
{{--            padding-bottom: 0px;--}}
{{--            color: #000;--}}
{{--        }--}}

{{--        body h3 {--}}
{{--            font-weight: 300;--}}
{{--            margin-top: 10px;--}}
{{--            margin-bottom: 20px;--}}
{{--            font-style: italic;--}}
{{--            color: #555;--}}
{{--        }--}}

{{--        body a {--}}
{{--            color: #06f;--}}
{{--        }--}}

{{--        .invoice-box {--}}
{{--            max-width: 800px;--}}
{{--            margin: auto;--}}
{{--            padding: 30px;--}}
{{--            border: 1px solid #eee;--}}
{{--            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);--}}
{{--            font-size: 16px;--}}
{{--            line-height: 24px;--}}
{{--            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;--}}
{{--            color: #555;--}}
{{--        }--}}

{{--        .invoice-box table {--}}
{{--            width: 100%;--}}
{{--            line-height: inherit;--}}
{{--            text-align: left;--}}
{{--            border-collapse: collapse;--}}
{{--        }--}}

{{--        .invoice-box table td {--}}
{{--            padding: 5px;--}}
{{--            vertical-align: top;--}}
{{--        }--}}

{{--        .invoice-box table tr td:nth-child(2) {--}}
{{--            text-align: right;--}}
{{--        }--}}

{{--        .invoice-box table tr.top table td {--}}
{{--            padding-bottom: 20px;--}}
{{--        }--}}

{{--        .invoice-box table tr.top table td.title {--}}
{{--            font-size: 45px;--}}
{{--            line-height: 45px;--}}
{{--            color: #333;--}}
{{--        }--}}

{{--        .invoice-box table tr.information table td {--}}
{{--            padding-bottom: 40px;--}}
{{--        }--}}

{{--        .invoice-box table tr.heading td {--}}
{{--            background: #eee;--}}
{{--            border-bottom: 1px solid #ddd;--}}
{{--            font-weight: bold;--}}
{{--        }--}}

{{--        .invoice-box table tr.details td {--}}
{{--            padding-bottom: 20px;--}}
{{--        }--}}

{{--        .invoice-box table tr.item td {--}}
{{--            border-bottom: 1px solid #eee;--}}
{{--        }--}}

{{--        .invoice-box table tr.item.last td {--}}
{{--            border-bottom: none;--}}
{{--        }--}}

{{--        .invoice-box table tr.total td:nth-child(2) {--}}
{{--            border-top: 2px solid #eee;--}}
{{--            font-weight: bold;--}}
{{--        }--}}

{{--        @media only screen and (max-width: 600px) {--}}
{{--            .invoice-box table tr.top table td {--}}
{{--                width: 100%;--}}
{{--                display: block;--}}
{{--                text-align: center;--}}
{{--            }--}}

{{--            .invoice-box table tr.information table td {--}}
{{--                width: 100%;--}}
{{--                display: block;--}}
{{--                text-align: center;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}

    <style>
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 44mm;
            background: #FFF;
        }
        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }
        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #FFF;
        }
        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }
        #invoice-POS h2 {
            font-size: 0.9em;
        }
        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        #invoice-POS p {
            font-size: 0.7em;
            color: #666;
            line-height: 1.2em;
        }
        #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }
        #invoice-POS #top {
            min-height: 100px;
        }
        #invoice-POS #mid {
            min-height: 80px;
        }
        #invoice-POS #bot {
            min-height: 50px;
        }
        /*#invoice-POS #top .logo {*/
        /*    height: 60px;*/
        /*    width: 60px;*/
        /*    background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;*/
        /*    background-size: 60px 60px;*/
        /*}*/
        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }
        #invoice-POS .title {
            float: right;
        }
        #invoice-POS .title p {
            text-align: right;
        }
        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }
        #invoice-POS .tabletitle {
            font-size: 0.5em;
            background: #EEE;
        }
        /*#invoice-POS .service {*/
        /*    border-bottom: 1px solid #EEE;*/
        /*}*/
        .tr:not(.tabletitle) {
            border-bottom: 1px solid #EEE;
        }
        #invoice-POS .item {
            width: 24mm;
        }
        #invoice-POS .itemtext {
            font-size: 0.5em;
        }
        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }

    </style>
</head>

<body style="direction: rtl">
<script src="https://bundle.run/buffer"></script>

<div id="prinatble">
    <div id="invoice-POS">

        <center id="top">
            <div class="logo">
                @if($s->img == null)
                    <img src="http://michaeltruong.ca/images/logo1.png" height="60" width="60">
                @else
                    <img src="{{asset('storage/'.$s->img)}}" height="60" width="60">
                @endif
            </div>
            <div class="info">
                <h2>{{$s->name}}</h2>
            </div><!--End Info-->
        </center><!--End InvoiceTop-->

        <div id="mid">
            <div class="info">
                <p>
                    العنوان : {{$s->location}}</br>
                    الرقم الضريبي : {{$s->tax_number}}</br>
                    الموظف : {{$invoice->user->name}}</br>
                    التاريخ : {{$invoice->created_at}}</br>
{{--                    Email   : JohnDoe@gmail.com</br>--}}
{{--                    Phone   : 555-555-5555</br>--}}
                </p>
            </div>
        </div><!--End Invoice Mid-->

        <div id="bot">

            <div id="table">
                <table>

                    {!!  $invoice->invoice !!}
                </table>
            </div><!--End Table-->

            <div id="legalcopy">
                <center id="qrcode" class="d-flex justify-content-center"></center>
            </div>

        </div><!--End InvoiceBot-->
    </div><!--End Invoice-->
    </div>

</div>
</div>
<button type="button" onclick='printDiv("prinatble")'> Print </button>
</div>
</body>
<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
<script type="text/javascript">

    const sellerName = 'hedia';
    const registerName = '{{$s->tax_number}}';
    const time = '{{$invoice->created_at}}';
    const total = '{{$invoice->money}}';
    const totalVAT = '{{$invoice->tax}}';
    function toHex(str) {
        var result = '';
        for (var i=0; i<str.length; i++) {
            result += str.charCodeAt(i).toString(16);
        }
        return result;
    }
    function toDigits(str){
        return str.length ===2 ? str :"0"+str
    }

    function hexToBase64(hexstring) {
        return btoa(hexstring.match(/\w{2}/g).map(function(a) {
            return String.fromCharCode(parseInt(a, 16));
        }).join(""));
    }


    const data = `01${toDigits((sellerName.length).toString(16))+toHex(sellerName)}02${toDigits((registerName.length).toString(16))+toHex(registerName)}03${toDigits((time.length).toString(16))+toHex(time)}04${(toDigits(total.length)+toHex(total))}05${toDigits((totalVAT.length))+toHex(totalVAT)}`;
    console.log(data)


    const qrcode = new QRCode(document.getElementById('qrcode'), {
        text: hexToBase64(data),
        // text: window.location.href,
        width: 128,
        height: 128,
        colorDark : '#000',
        colorLight : '#fff',
        correctLevel : QRCode.CorrectLevel.H
    });

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }


</script>
</html>


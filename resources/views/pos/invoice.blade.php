<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ URL::asset('assets/logo.png') }}">
    <title>Invoice</title>
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

<div id="prinatble">
    <div id="invoice-POS">


        <center id="top">
            <h4>
                @if($invoice->invoice_type =="عملية شراء")
                    فاتورة ضريبية مبسطة
                @else
                    اشعار {{$invoice->invoice_type}}
                @endif

            </h4>
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
                    @if($invoice->invoice_type =="عملية شراء")
                        رقم الفاتورة : {{$invoice->id}}</br>
                    @else
                        رقم الاشعار : {{$invoice->id}}</br>
                        رقم الفاتورة : {{$invoice->payment_type}}</br>
                    @endif
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

                    <tr class="tabletitle">
                        @if($invoice->invoice_type =="دائن")
                            <td class="payment"><h2>{{($invoice->money)*-1-$invoice->tax}} SAR</h2></td>
                        @else
                            <td class="payment"><h2>{{$invoice->money-$invoice->tax}} SAR</h2></td>
                        @endif

                        <td class="Rate"><h2>السعر</h2></td>
                        <td></td>


                    </tr>

                    <tr class="tabletitle">

                        <td class="payment"><h2>SAR {{$invoice->tax}}</h2></td> <td class="Rate"><h2>الضريبة</h2></td>
                        <td></td>

                    </tr>
                    <tr class="tabletitle">
                        @if($invoice->invoice_type =="دائن")
                            <td class="payment"><h2>SAR {{$invoice->money *-1}}</h2></td> <td class="Rate"><h2>الاجمالي</h2></td>
                        @else
                            <td class="payment"><h2>SAR {{$invoice->money}}</h2></td> <td class="Rate"><h2>الاجمالي</h2></td>
                        @endif
                        <td></td>

                    </tr>
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
<script src="https://bundle.run/buffer"></script>
<script src="{{asset("assets/js/qr.js")}}"></script>
<script type="text/javascript">

    const sellerName = '{{$s->name}}';
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


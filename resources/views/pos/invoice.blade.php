<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Favicon -->
{{--    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />--}}

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body style="direction: rtl">
<div id="prinatble">
<div class="card-header">
    <strong>{{$invoice->created_at}}</strong>

</div>
<div class="card-body" id="pp">
    <div class="row mb-4">
        <div class="col-sm-6 center">
            <div>
                الموظف:  <strong>{{$invoice->user->name}}</strong>
            </div>
            <div>الجهة: {{$s->name}}</div>
            <div>المكان: {{$s->location}}</div>
            <div>الرقم الضريبي: {{$s->tax_number}}</div>
        </div>



    </div>

    <div class="table-responsive-sm">
        <table class="table table-striped" id="invoice">
           {!! $invoice->invoice !!}
            </table>
        </div>

    <div class="col-lg-4 col-sm-5 ml-auto" id="p">
        <table class="table table-clear">
            <tbody>
            <tr>
                <td class="left">
                    <strong> المجموع بدون الضريبة</strong>
                </td>
                <td class="right">
                    <strong id="invoice_total">${{$invoice->money - $invoice->tax}}</strong>
                </td>
            </tr>

            <tr>
                <td class="left">
                    <strong>الضريبة</strong>
                </td>
                <td class="right">
                    <strong id="invoice_total">${{$invoice->tax}}</strong>
                </td>
            </tr>

            <tr>
                <td class="left">
                    <strong>المجموع بدون الضريبة</strong>
                </td>
                <td class="right">
                    <strong id="invoice_total">${{$invoice->money}}</strong>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="qrcode" class="d-flex justify-content-center"></div>
</div>

    </div>

</div>
</div>
<button type="button" onclick='printDiv("prinatble")'> Print </button>
</div>
</body>
<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
<script type="text/javascript">
    const qrcode = new QRCode(document.getElementById('qrcode'), {
        text: window.location.href,
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
{{--<div class="invoice-box">--}}
{{--    <table>--}}
{{--        <tr class="top">--}}
{{--            <td colspan="2">--}}
{{--                <table>--}}
{{--                    <tr>--}}
{{--                        <td class="title">--}}
{{--                            <img src="{{asset('storage/'.$s->img)}}" alt="" style="width: 100%; max-width: 200px" />--}}
{{--                        </td>--}}

{{--                        <td>--}}
{{--                            Invoice #:{{$invoice->id}}<br />--}}
{{--                            Created:{{\Carbon\Carbon::now()}}<br />--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--            <td></td>--}}
{{--        </tr>--}}

{{--        <tr class="information">--}}
{{--            <td colspan="2">--}}
{{--                <table>--}}
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            Name: {{$s->name}}<br />--}}
{{--                            Location: {{$s->location}}<br />--}}
{{--                        </td>--}}

{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--            <td></td>--}}

{{--        </tr>--}}

{{--        --}}{{--        <tr class="heading">--}}
{{--        --}}{{--            <td>Payment Method</td>--}}

{{--        --}}{{--            <td>Check #</td>--}}
{{--        --}}{{--        </tr>--}}

{{--        --}}{{--        <tr class="details">--}}
{{--        --}}{{--            <td>Check</td>--}}

{{--        --}}{{--            <td>1000</td>--}}
{{--        --}}{{--        </tr>--}}

{{--        --}}{{-- {{$t}}--}}
{{--        --}}{{--        <tr class="heading">--}}
{{--        --}}{{--            <td>الاسم</td>--}}
{{--        --}}{{--            <td>الكمية</td>--}}

{{--        --}}{{--            <td>السعر</td>--}}
{{--        --}}{{--        </tr>--}}

{{--        --}}{{--        <tr class="item">--}}
{{--        --}}{{--            <td>Website design</td>--}}
{{--        --}}{{--            <td>5</td>--}}

{{--        --}}{{--            <td>$300.00</td>--}}
{{--        --}}{{--        </tr>--}}

{{--        --}}{{--        <tr class="item">--}}
{{--        --}}{{--            <td>Hosting (3 months)</td>--}}
{{--        --}}{{--            <td>2</td>--}}
{{--        --}}{{--            <td>$75.00</td>--}}
{{--        --}}{{--        </tr>--}}

{{--        --}}{{--        <tr class="item">--}}
{{--        --}}{{--            <td>Domain name (1 year)</td>--}}
{{--        --}}{{--            <td>4</td>--}}
{{--        --}}{{--            <td>$10.00</td>--}}
{{--        --}}{{--        </tr>--}}

{{--        <tr class="total">--}}
{{--            <td></td>--}}

{{--            <td>Total: $385.00</td>--}}
{{--        </tr>--}}
{{--    </table>--}}
{{--</div>--}}

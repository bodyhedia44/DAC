@extends('layouts.master')
@section('title') نقاط البيع  @endsection
@section('content')
    <link rel="icon" href="{{ URL::asset('assets/images/logo-dark.png') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/styles/app.css') }}" />


        <body id="casher" onload="hide()">
        <form action="{{route('pos.store')}}" method="post" id="form">
            {{csrf_field()}}
            <input type="hidden" name="invoice" id="invoice_table">
            <input type="hidden" name="tax" id="all_tax">
            <div class="page-container">
                <div class="not-footer">
                    <header class="page-header" id="bla">
                        <nav>
                            <div class="navbar-container"></div>
                        </nav>
                    </header>

                    <main class="page-body">
                        <div class="casher-container row">
{{--                            <div class="col-12">--}}
{{--                                <button>--}}
{{--                                    search by code--}}
{{--                                </button>--}}
{{--                            </div>--}}
                        <div class="casher-container row">

                            <div class="col-4 table-container">
                                <table class="casher-table" id="table">
                                    <thead>
                                        <tr>
                                            <th>العنصر</th>
                                            <th>الكمية</th>
                                            <th>المجموع</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>

                            <div class="col-8 products-container">
                                <div class="items">
                                    @foreach( $cats as $x)
                                    <a class="item {{$x->id}} cat" onclick="show({{$x->id}})" >
{{--                                        <img src="{{ URL::asset('assets/images/sandwich.png') }}" alt="" class="item-img">--}}
                                        <h2 class="item-title">
                                            {{$x->name}}
                                        </h2>
                                    </a>
                                    @endforeach

                                        @foreach($prods as $y)
                                            <a id="{{$y->category->id}}" class="item prod {{$y->category->id}}"
                                               onclick="addItem('{{$y->name}}',{{$y->price}},'{{$y->id}}')">
                                                <img src="{{asset('storage/'.$y->img)}}" alt="" class="item-img">
                                                <h2 class="item-title">
                                                    {{$y->name}}
                                                </h2>
                                            </a>
                                        @endforeach
                                    <a class="cancel" id="toggle" onclick="back()">
                                        <h2>
                                            رجوع
                                        </h2>
                                    </a>
                                </div>
                            </div>
{{--                            <div class="col-8 products-container">--}}
{{--                                <form action="">--}}
{{--                                    <div class="form-item col-12">--}}
{{--                                        <div class="text">--}}
{{--                                            <input type="text">--}}
{{--                                        </div>--}}

{{--                                        <button>--}}
{{--                                            bla bla bla--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
                            <div class="col-4 price-container">
                                <div class="col-12">
                                    <span>
                                        الكمية
                                    </span>

                                    <div class="text">
                                        <input type="number" id="quan" value="1" min="1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <span>
                                        المجموع
                                    </span>

                                    <div class="text">
                                        <input type="number" name="total" id="total" required readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <span>
                                        الضريبة
                                    </span>

                                    <div class="text">
                                        <input type="number" id="tax" readonly class="form-control" value="{{$s->tax}}">
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <span>
                                        الاجمالي
                                    </span>

                                    <div class="text">
                                        <input type="number" id="net" name="net" readonly class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 price-container">

                                <div class="col-12">
                                        <span>
                                                خصم
                                            </span>

                                    <div class="text">
                                        <input type="number" id="sale" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mt-3" >
                                        <span>
                                                المدفوع
                                            </span>

                                    <div class="text">
                                        <input type="number" id="paid" onchange="paidChange()" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                        <span>
                                                الباقي
                                            </span>

                                    <div class="text">
                                        <input type="number" id="change" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                        <span>
                                                طريقة الدفع
                                            </span>
                                    <div class="text">
                                        <select name="option" id="option" class="form-control-sm" onchange="cashOrVisa()">
                                            <option value="cash">
                                                cash
                                            </option>
                                            <option value="visa">
                                                visa
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 toolbar-container mt-3">
                                <div class="row-cols-4 buttons-container">
                                    <button>
                                        <i class="fa-solid fa-money-bill-1-wave"></i>
                                        دفع
                                    </button>
{{--                                    <button>--}}
{{--                                        <i class="fa-solid fa-xmark"></i>--}}
{{--                                        الغاء--}}
{{--                                    </button>--}}
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#myModal2">
                                        <i class="fa-solid fa-print"></i>
                                        طباعة
                                    </button>
                                </div>

                            </div>


                        </div>
                        </div>
                    </main>
                </div>
            </div>
    </form>


        <div id="myModal2" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">الفاتورة</h5>
                        <button type="button" style="background-color: white;color: black !important;" data-bs-dismiss="modal" aria-label="Close">x </button>
                    </div>
                    <div class="container">
                        <form action="{{route('invoice')}}" method="post" id="print_form">
                            {{csrf_field()}}
                                    <div id="blaHAbl"></div>
                            <input type="hidden" name="total" id="total_print">
                            <input type="hidden" name="tax" id="total_tax">
                            <input type="hidden" name="i_option" id="i_option" value="cash">
                            <div class="card">
                            <div class="card-header">
                                <strong>{{\Carbon\Carbon::now()}}</strong>

                            </div>
                            <div class="card-body" id="pp">
                                <div class="row mb-4">
                                    <div class="col-sm-6 center">
                                        <div>
                                            الموظف:  <strong>{{auth()->user()->name}}</strong>
                                        </div>
                                         <div>الجهة: {{$s->name}}</div>
                                        <div>المكان: {{$s->location}}</div>
                                        <div>الرقم الضريبي: {{$s->tax_number}}</div>
                                    </div>



                                </div>

                                <div class="table-responsive-sm">
                                    <table class="table table-striped" >
                                        <thead id="invoice">
                                        <tr class="tabletitle">
                                            <td class="item"><h2>العنصر</h2></td>
                                            <td class="Hours"><h2>الكمية</h2></td>
                                            <td class="Rate"><h2>المجموع</h2></td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">

                                    </div>

                                    <div class="col-lg-4 col-sm-5 ml-auto" id="p">
                                        <table class="table table-clear">
                                            <tbody>

                                            <tr>
                                                <td class="left">
                                                    <strong>المجموع</strong>
                                                </td>
                                                <td class="right">
                                                    <strong id="invoice_total"></strong>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="left">
                                                    <strong>الضريبة</strong>
                                                </td>
                                                <td class="right">
                                                    <strong id="invoice_tax"></strong>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="left">
                                                    <strong>الاجمالي</strong>
                                                </td>
                                                <td class="right">
                                                    <strong id="invoice_sum"></strong>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                            <button style="background-color: white;color: black !important;">print</button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        </body>

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        let total =0;

        function addItem(name,price,id){
            const table = document.getElementById("table")
            const invoice = document.getElementById("invoice")
            const quan = document.getElementById("quan")
            const invoice_h = document.getElementById("invoice_table")
            const invoice_tt = document.getElementById("all_tax")
            const invoice_pp = document.getElementById("blaHAbl")

            fillTable(table,name,price,quan)
            fillTable_invoice(invoice,name,price,quan)

            console.log(invoice.innerHTML)

            invoice_pp.innerHTML=`<input type="hidden" name="invoice" value="${invoice.innerHTML.replace(/"/g, "'")}">`;

            total+=price*quan.value;

            const t =document.getElementById("total")
            const n =document.getElementById("net")
            const tax =document.getElementById("tax")
            const sale =document.getElementById("sale")
            const invoice_t =document.getElementById("invoice_total")
            const invoice_tax =document.getElementById("invoice_tax")
            const invoice_sum =document.getElementById("invoice_sum")
            const invoice_p =document.getElementById("total_print")
            const invoice_tax_print =document.getElementById("total_tax")

            t.value = total;
            n.value = total+(tax.value * total / 100) - (sale.value * total / 100)
            invoice_p.value = n.value;
            invoice_tax_print.value=total+(tax.value * total / 100)-total
            invoice_tt.value=total+(tax.value * total / 100)-total;

            invoice_t.innerHTML = total ;
            invoice_tax.innerHTML = total+(tax.value * total / 100)-total ;
            invoice_sum.innerHTML =  n.value ;

            const form_print =document.getElementById("print_form");
            const form =document.getElementById("bla");
            const firstElement = document.querySelector(`input[name="items[${name}][quan]]"`);
            const elementsToDelete = document.querySelectorAll(`input[name="items[${name}][quan]]"`);
            if (firstElement) {
                let new_value=firstElement.value+quan.value
                elementsToDelete.forEach((element) => {
                    element.remove();
                });
                form_print.innerHTML+=`<input type="hidden" name="items[${name}][quan]" value="${new_value}">`
                form.innerHTML+=`<input type="hidden" name="items[${name}][quan]" value="${new_value}">`

            }else{
                form_print.innerHTML+=`<input type="hidden" name="items[${name}][id]" value="${id}">`
                form_print.innerHTML+=`<input type="hidden" name="items[${name}][quan]" value="${quan.value}">`

                form.innerHTML+=`<input type="hidden" name="items[${name}][id]" value="${id}">`
                form.innerHTML+=`<input type="hidden" name="items[${name}][quan]" value="${quan.value}">`
            }



            quan.value=1;


            invoice_h.value=invoice.innerHTML.replace(/"/g, "'");
        }
        function fillTable(table,name,price,quan) {
            var row = table.insertRow(1);

            const cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.innerHTML = name;
            cell2.innerHTML =  price * quan.value;
            cell3.innerHTML =quan.value;

        }

        function fillTable_invoice(table,name,price,quan) {
            console.log(table)
            table.innerHTML+=` <tr>
                        <td><p class='itemtext'>${name}</p></td>
                        <td class='tableitem'><p class='itemtext'>${quan.value}</p></td>
                        <td class='tableitem'><p class='itemtext'>${price}</p></td>
                    </tr>
`
        }
        function hide(){
            document.getElementById("toggle").style.display='none';
            const products =document.getElementsByClassName("prod")
            for (let i =0 ; i<products.length;i++){
                products.item(i).style.display="none"
            }
        }


        function show (id) {
            const targetDiv = document.getElementsByClassName(`${id}`);
            const cat = document.getElementsByClassName(`cat`);
            document.getElementById("toggle").style.display = 'flex';
            for (let i = 0; i < targetDiv.length; i++) {
                if (targetDiv.item(i).style.display !== "none") {
                    targetDiv.item(i).style.display = "none";
                } else {
                    targetDiv.item(i).style.display = "flex";
                }
            }

            for (let i = 0; i < cat.length; i++) {
                cat.item(i).style.display = "none";
            }

        }

        function back(){
            hide();
            const cats =document.getElementsByClassName("cat")
            for (let i =0 ; i<cats.length;i++){
                cats.item(i).style.display="flex"
            }
        }



        function paidChange(){
            if (total===0){}
            else{
                let paid=document.getElementById('paid').value;
                console.log(paid)
                let change=paid-total;
                let i=document.getElementById("change")
                i.value=change
            }
        }

        function cashOrVisa() {
            document.getElementById('i_option').value=document.getElementById('option').value
        }

    </script>

@endsection





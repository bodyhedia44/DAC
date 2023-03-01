@extends('layouts.master')
@section('title') نقاط البيع  @endsection
@section('content')
        <link rel="icon" href="{{ URL::asset('assets/images/logo-dark.png') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/styles/app.css') }}" />

        <body id="casher" onload="hide()">
            <div class="page-container">
                <div class="not-footer">
                    <header class="page-header">
                        <nav>
                            <div class="navbar-container"></div>
                        </nav>
                    </header>

                    <main class="page-body">
                        <div class="casher-container row">

                            <div class="col-4 table-container">
                                <table class="casher-table" id="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>item</th>
                                            <th>QTY</th>
                                            <th>price</th>
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
                                        <img src="{{ URL::asset('assets/images/sandwich.png') }}" alt="" class="item-img">
                                        <h2 class="item-title">
                                            {{$x->name}}
                                        </h2>
                                    </a>
                                    @endforeach

                                        @foreach($prods as $y)
                                            <a id="{{$y->category->id}}" class="item prod {{$x->id}}"
                                               onclick="addItem('{{$y->name}}',{{$y->price}})">
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

                            <div class="col-4 price-container">
                                <div class="col-12">
                                    <span>
                                        المجموع
                                    </span>

                                    <div class="text">
                                        <input type="number" id="total" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span>
                                        الضريبة
                                    </span>

                                    <div class="text">
                                        <input type="number" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span>
                                        الاجمالي
                                    </span>

                                    <div class="text">
                                        <input type="number" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-8 toolbar-container">
                                <div class="col-4 price-container">
                                    <div class="col-12">
                                        <span>
                                                طريقة الدفع
                                            </span>
                                        <div class="text">
                                            <select name="" id="">
                                                <option value="">
                                                    cash
                                                </option>
                                                <option value="">
                                                    visa
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <span>
                                                المدفوع
                                            </span>

                                        <div class="text">
                                            <input type="number" id="paid" onchange="change()">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span>
                                                الباقي
                                            </span>

                                        <div class="text">
                                            <input type="number" id="change" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-8 buttons-container">
{{--                                    <button>--}}
{{--                                        <i class="fa-solid fa-floppy-disk"></i>--}}
{{--                                        save--}}
{{--                                    </button>--}}
                                    <button>
                                        <i class="fa-solid fa-money-bill-1-wave"></i>
                                        pay
                                    </button>
{{--                                    <button>--}}
{{--                                        <i class="fa-solid fa-trash"></i>--}}
{{--                                        remove--}}
{{--                                    </button>--}}
                                    <button>
                                        <i class="fa-solid fa-xmark"></i>
                                        cancel
                                    </button>
{{--                                    <button>--}}
{{--                                        <i class="fa-solid fa-ban"></i>--}}
{{--                                        clear--}}
{{--                                    </button>--}}
{{--                                    <button>--}}
{{--                                        <i class="fa-solid fa-door-open"></i>--}}
{{--                                        exit--}}
{{--                                    </button>--}}
                                    <button>
                                        <i class="fa-solid fa-print"></i>
                                        print
                                    </button>
                                </div>
                            </div>
                        </div>

                    </main>
                </div>
            </div>
        </body>

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script>
        let total =0;
        function hide(){
            document.getElementById("toggle").style.display='none';
            const products =document.getElementsByClassName("prod")
            for (let i =0 ; i<products.length;i++){
                products.item(i).style.display="none"
            }
        }


        function show (id) {
            const targetDiv = document.getElementsByClassName(`${id}`);
            document.getElementById("toggle").style.display='flex';
            for (let i =0 ; i<targetDiv.length;i++){
                if (targetDiv.item(i).style.display !== "none") {
                    targetDiv.item(i).style.display = "none";
                } else {
                    targetDiv.item(i).style.display = "flex";
                }
            }

        }

        function back(){
            hide();
            const cats =document.getElementsByClassName("cat")
            for (let i =0 ; i<cats.length;i++){
                cats.item(i).style.display="flex"
            }
        }

        function addItem(name,price){
            const table = document.getElementById("table");

            var row = table.insertRow(1);

            const cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(2);

            cell1.innerHTML = "";
            cell2.innerHTML = name;
            cell3.innerHTML = price;
            cell4.innerHTML = 1;
            total+=price;
            document.getElementById("total").value = total;

        }

        function change(){
            if (total===0){

            }else{
                let paid=document.getElementById('paid').value;
                console.log(paid)
                let change=paid-total;
                let i=document.getElementById("change")
                i.value=change
            }
        }
    </script>
@endsection






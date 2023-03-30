@extends('layouts.master')
@section('title') المحاسبة  @endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') المحاسبة @endslot
        @slot('title') المحاسبة @endslot
    @endcomponent
    @if(session()->has('add'))
        <div class="alert alert-success" role="alert">
            {{session()->get('add')}}
        </div>
    @endif
    @if(session()->has('del'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('del')}}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0 flex-grow-1">قسم المحاسبة</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <a class="modal-effect btn btn-sm btn-success mb-3" href="/productsReport/export"
                       style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
                    <div id="table-gridjs1"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/gridjs.init.js') }}"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        new gridjs.Grid({
            columns: [
                {
                    name: '#',
                    formatter: (function (cell) {
                        return gridjs.html('' + cell + '');
                    })
                },
                {
                    name: "النوع",
                    width: '100px',
                    formatter: (function (cell) {
                        return gridjs.html(
                            "" + cell+"");
                    })
                },
                {
                    name: "المبلغ",
                    width: '100px',
                    formatter: (function (cell) {
                        return gridjs.html(
                            "" + cell+"");
                    })
                },

                {
                    name: 'الملاحظات',
                    width: '150px',
                    formatter: (function (cell) {
                        return gridjs.html(
                            "" + cell+"");
                    })
                },
            ],
            pagination: {
                limit: 10
            },
            search: true,
            data: [
                    <?php $i=0?>
                @foreach($data as $d)
                        <?php $i++?>
                ["{{$i}}", "{{$d->type}}", "{{$d->amount}}","{{$d->notes}}"

                    ],
                    @endforeach
            ]
        }).render(document.getElementById("table-gridjs1"));
    </script>
@endsection

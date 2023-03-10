@extends('layouts.master')
@section('title') المنتجات  @endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') المنتجات @endslot
        @slot('title') المنتجات @endslot
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
                    <h4 class="card-title mb-0 flex-grow-1">كل المنتجات</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="table-gridjs1"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">تعديل تصنيف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="/productsReport" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                        <h5 class="fs-15">
                            تعديل العدد
                        </h5>
                        <!-- Readonly Input -->

                        <input type="text" class="form-control mb-3" name="name" id="name" readonly disabled>
                        <input type="number" class="form-control" name="sales" id="sales">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary ">تعديل</button>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div><!-- /.modal-dialog --> </form>
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
                "الاسم",
                {
                    name: 'عدد المبيعات',
                    formatter: (function (cell) {
                        return gridjs.html('' + cell + '');
                    })
                },
                {
                    name: 'عمليات',
                    width: '120px',
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
                ["{{$i}}", "{{$d->name}}", "{{$d->sales}}",

                        ' <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-id="{{$d->id}}" data-name="{{$d->name}}"  data-quan="{{$d->sales}}" data-bs-target="#myModal"><i class="ri-edit-line"></i></button>'
                    ],
                    @endforeach
            ]
        }).render(document.getElementById("table-gridjs1"));

        $('#myModal').on('show.bs.modal', function(event) {
            console.log(1);
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var sales = button.data('quan')
            var modal = $(this)
            modal.find('#id').val(id);
            modal.find('#name').val(name);
            modal.find('#sales').val(sales);
        });

    </script>
@endsection

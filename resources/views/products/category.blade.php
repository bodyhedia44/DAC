@extends('layouts.master')
@section('title') التصنيفات  @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') المنتجات @endslot
        @slot('title') التصنيفات @endslot
    @endcomponent
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/dropzone/dropzone.css') }}" type="text/css" />
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
                    <h4 class="card-title mb-0 flex-grow-1">كل التصنيفات</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">ادوات</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i=0?>
                        @foreach($cat as $x)
                                <?php $i++?>
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$x->name}}</td>
                            <td>
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-id="{{$x->id}}" data-name="{{$x->name}}" data-bs-target="#myModal2"><i class="ri-edit-line"></i></button>
                                <button type="button" class="btn btn-danger btn-icon waves-effect waves-light" data-bs-toggle="modal" data-id="{{$x->id}}" data-name="{{$x->name}}" data-bs-target="#myModal"><i class="ri-delete-bin-5-line"></i></button>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <div id="myModal2" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">تعديل تصنيف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="/category/update" method="post">
                    {{method_field('patch')}}
                    {{csrf_field()}}
                    <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                        <h5 class="fs-15">
                           تعديل التصنيف
                        </h5>
                        <!-- Readonly Input -->

                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary ">تعديل</button>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div><!-- /.modal-dialog --> </form>
    </div><!-- /.modal -->

    <!-- Default Modals -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">حذف تصنيف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="/category/destroy" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                    <h5 class="fs-15">
                       هل انت متاكد انك تريد حذف هذا التصنيف سيؤدي هذا لحذف كل المنتجات المرتبطة به
                    </h5>
                    <!-- Readonly Input -->

                    <input type="text" class="form-control" name="name" id="name" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-primary ">حذف</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div><!-- /.modal-dialog --> </form>
    </div><!-- /.modal -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $('#myModal').on('show.bs.modal', function(event) {
            console.log(1);
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('#id').val(id);
            modal.find('#name').val(name);
        });

        $('#myModal2').on('show.bs.modal', function(event) {
            console.log(1);
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('#id').val(id);
            modal.find('#name').val(name);
        })
    </script>
@endsection

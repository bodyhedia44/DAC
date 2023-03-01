@extends('layouts.master')
@section('title') المنتجات  @endsection
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
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">القسم</th>
                            <th scope="col">السعر</th>
                            <th scope="col">الصورة</th>
                            <th scope="col">الكود</th>

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
                                <td>{{$x->category->name}}</td>
                                <td>{{$x->price}}</td>
                                @if($x->img=="")
{{--                                    <td><img src="{{URL::asset('assets/images/products/pp.png')}}"></td>--}}
                                    <td><img src="https://static.thenounproject.com/png/1375593-200.png" width="50"></td>

                                @else
                                    <td><img src="{{asset('storage/'.$x->img)}}" width="50"></td>
                                @endif

                                @if($x->code==null)
                                    <td>----</td>
                                @else
                                    <td>{{$x->code}}</td>
                                @endif

                                <td>
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-id="{{$x->id}}" data-name="{{$x->name}}" data-code="{{$x->code}}" data-price="{{$x->price}}" data-bs-target="#myModal2"><i class="ri-edit-line"></i></button>
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
                <form action="/product/update" method="post">
                    {{method_field('patch')}}
                    {{csrf_field()}}
                    <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                        <h5 class="fs-15">
                            تعديل التصنيف
                        </h5>

                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" class="form-control" placeholder="ادخل اسم المنتج" id="name" name="name">
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">السعر</label>
                                <input type="number" class="form-control" placeholder="ادخل سعر المنتج" id="price" name="price">
                            </div>

                            <label for="code" class="form-label">التصنيف</label>

                            <div class="input-group mb-3">
                                <select class="form-select" name="category">
                                    @foreach($cats as $stuff_type)
                                        <option value="{{ $stuff_type->id }}">{{ $stuff_type->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="code" class="form-label">الكود (اختياري)</label>
                                <input type="text" class="form-control" placeholder="ادخل كود المنتج" id="code" name="code">
                            </div>
                        <!--end col-->

                        <div>
                            <label for="formFile" class="form-label">صورة المنتج (اختياري)</label>
                            <input class="form-control mb-3" type="file" id="formFile" name="img">
                        </div>
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
                    <h5 class="modal-title" id="myModalLabel">حذف منتج</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="/product/destroy" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                        <h5 class="fs-15">
                            هل انت متاكد انك تريد حذف هذا المنتج؟
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
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('#id').val(id);
            modal.find('#name').val(name);
        });

        $('#myModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var price = button.data('price')
            var code = button.data('code')
            var cat = button.data('sel')
            var modal = $(this)
            modal.find('#id').val(id);
            modal.find('#name').val(name);
            modal.find('#price').val(price);
            modal.find('#code').val(code);
            modal.find('#sel').val(cat);
        })
    </script>
@endsection

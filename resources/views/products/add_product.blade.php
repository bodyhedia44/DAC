@extends('layouts.master')
@section('title') اضافة منتج  @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') المنتجات @endslot
        @slot('title') اضافة منتج   @endslot
    @endcomponent
    @if(session()->has('add'))
        <div class="alert alert-success" role="alert">
            {{session()->get('add')}}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        {{@csrf_field()}}
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control" placeholder="ادخل اسم المنتج" id="name" name="name">
                </div>
            </div><!--end col-->
            <div class="col-6">
                <div class="mb-3">
                    <label for="price" class="form-label">السعر</label>
                    <input type="number" class="form-control" placeholder="ادخل سعر المنتج" id="price" name="price">
                </div>
            </div><!--end col-->
            <div class="col-6">
                <label for="code" class="form-label">التصنيف</label>

                <div class="input-group">
                    <select class="form-select" id="inputGroupSelect01" name="category">
                        @foreach($cats as $stuff_type)
                            <option value="{{ $stuff_type->id }}">{{ $stuff_type->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="code" class="form-label">الكود (اختياري)</label>
                    <input type="text" class="form-control" placeholder="ادخل كود المنتج" id="code" name="code">
                </div>
            </div>
            <!--end col-->
            <div class="col-6">
                <div class="mb-3">
                    <label for="code" class="form-label">المخزون (اختياري)</label>
                    <input type="text" class="form-control" placeholder="مخزون المنتج" id="amount" name="amount">
                </div>
            </div>


            <div>
                <label for="formFile" class="form-label">صورة المنتج (اختياري)</label>
                <input class="form-control mb-3" type="file" id="formFile" name="img">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">اضافة</button>
            </div>
        </div><!--end row-->
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

@extends('layouts.master')
@section('title') الاعدادات @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')  @endslot
        @slot('title') الاعدادات   @endslot
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
    <form action="{{route('settings.store')}}" method="post" enctype="multipart/form-data">
        {{@csrf_field()}}
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name" class="form-label">اسم الجهة</label>
                    <input type="text" class="form-control" placeholder="ادخل اسم الجهة" id="name" name="name" value="{{$data->name}}">
                </div>
            </div><!--end col-->
            <div class="col-6">
                <div class="mb-3">
                    <label for="price" class="form-label">عنوان الجهة</label>
                    <input type="text" class="form-control" placeholder="ادخل عنوان المنتج" id="price" name="location" value="{{$data->location}}">
                </div>
            </div><!--end col-->

            <div class="col-6">
                <div class="mb-3">
                    <label for="code" class="form-label">الضريبة (اختياري)</label>
                    <input type="number" class="form-control" placeholder="ادخل الضريبة" id="code" name="tax" value="{{$data->tax}}">
                </div>
            </div>
            <!--end col-->

            <div>
                <label for="formFile" class="form-label">لوجو الجهة (اختياري)</label>
                <input class="form-control mb-3" type="file" id="formFile" name="img">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">تحديث</button>
            </div>
        </div><!--end row-->
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

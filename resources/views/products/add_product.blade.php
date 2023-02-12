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
    <form action="javascript:void(0);" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" placeholder="ادخل سعر المنتج" id="price" name="price">
                </div>
            </div><!--end col-->
            <div class="col-12">
                <div class="mb-3">
                    <label for="code" class="form-label">الكود (اختياري)</label>
                    <input type="text" class="form-control" placeholder="ادخل كود المنتج" id="code" name="code">
                </div>
            </div><!--end col-->
            <label for="img" class="form-label">صورة المنتج (اختياري)</label>
            <input type="file" name="img">

        </div><!--end row-->
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-file-upload.init.js') }}"></script>
    <script>
        var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
        dropzonePreviewNode.id = "";
        var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
        dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
        var dropzone = new Dropzone(".dropzone", {
            url: 'https://httpbin.org/post',
            method: "post",
            previewTemplate: previewTemplate,
            previewsContainer: "#dropzone-preview",
        });
    </script>
@endsection

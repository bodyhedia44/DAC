@extends('layouts.master')
@section('title') المحاسبة  @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') المحاسبة @endslot
        @slot('title') اضافة بند المحاسبة   @endslot
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
    <form action="{{route('accountant.store')}}" method="post" enctype="multipart/form-data">
        {{@csrf_field()}}
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="name" class="form-label">نوع العملية</label>
                    <input type="text" class="form-control" placeholder="ادخل نوع العملية" id="name" name="name">
                </div>
            </div><!--end col-->
            <div class="col-6">
                <div class="mb-3">
                    <label for="price" class="form-label">السعر</label>
                    <input type="number" class="form-control" placeholder="ادخل سعر العملية" id="price" name="price">
                </div>
            </div><!--end col-->
            <div class="col-6">
                <div class="mb-3">
                    <label for="notes" class="form-label">الملاحظات (اختياري)</label>
                    <textarea type="text" class="form-control" placeholder="الملاحظات" id="notes" name="notes"></textarea>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">اضافة</button>
            </div>
        </div><!--end row-->
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

@endsection

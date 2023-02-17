@extends('layouts.master')
@section('title') نقاط الولاء  @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') نقاط الولاء @endslot
        @slot('title') اضافة نقاط ولاء   @endslot
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
    <form action="{{route('loyalty.store')}}" method="post">
        {{csrf_field()}}
        <div class="row">
        <div class="col-4">
        <div class="mb-3">
            <label for="name" class="form-label">اسم العميل</label>
            <input type="text" class="form-control" id="name" placeholder="ادخل اسم العميل" name="name">
        </div>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <label for="name" class="form-label">رقم العميل</label>
                <input type="text" class="form-control" id="name" placeholder="ادخل رقم العميل" name="phone">
            </div>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <label for="name" class="form-label">نقاط العميل الابتدائية</label>
                <input type="number" class="form-control" id="name" placeholder="ادخل نقاط العميل الابتدائية" name="points" value="0">
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">اضافة</button>
        </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

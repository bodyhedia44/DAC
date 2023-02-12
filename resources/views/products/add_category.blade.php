@extends('layouts.master')
@section('title') اضافة تصنيف  @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') المنتجات @endslot
        @slot('title') اضافة تصنيف   @endslot
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
    <form action="{{route('category.store')}}" method="post">
        {{csrf_field()}}
        <div class="mb-3">
            <label for="name" class="form-label">اسم القسم</label>
            <input type="text" class="form-control" id="name" placeholder="ادخل اسم القسم" name="name">
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">اضافة</button>
        </div>
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

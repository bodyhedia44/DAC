@extends('layouts.master')
@section('title') المرتجع @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')  @endslot
        @slot('title') المرتجع   @endslot
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
    <form action="{{route('pos.store')}}" method="post" enctype="multipart/form-data">
        {{@csrf_field()}}
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">رقم الفاتورة</label>
                    <input type="text" class="form-control" placeholder="ادخل رقم الفاتورة" id="number" name="number">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">قيمة المرتجع</label>
                    <input type="number" class="form-control" placeholder="ادخل قيمة المرتجع" id="name" name="money">
                </div>
            </div><!--end col-->
            <!--end col-->

            <div class="text-end">
                <button type="submit" class="btn btn-primary">اضافة</button>
            </div>
        </div><!--end row-->
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

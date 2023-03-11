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
                            <th scope="col">الرقم</th>
                            <th scope="col">النقاط</th>
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
                            <td>{{$x->phone}}</td>
                            <td>{{$x->points}}</td>
                            <td>
                                @can('تعديل نقاط الولاء')
                                    <button type="button" class="btn btn-primary waves-effect waves-light"><i class="ri-edit-line"></i></button>
                                @endcan
                                    @can('حذف نقاط الولاء')
                                        <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>
                                    @endcan
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
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection

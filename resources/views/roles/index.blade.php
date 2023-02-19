@extends('layouts.master')
@section('content')
{{--    @if (session()->has('Add'))--}}
{{--        <script>--}}
{{--            window.onload = function() {--}}
{{--                notif({--}}
{{--                    msg: " تم اضافة الصلاحية بنجاح",--}}
{{--                    type: "success"--}}
{{--                });--}}
{{--            }--}}
{{--        </script>--}}
{{--    @endif--}}

{{--    @if (session()->has('edit'))--}}
{{--        <script>--}}
{{--            window.onload = function() {--}}
{{--                notif({--}}
{{--                    msg: " تم تحديث بيانات الصلاحية بنجاح",--}}
{{--                    type: "success"--}}
{{--                });--}}
{{--            }--}}
{{--        </script>--}}
{{--    @endif--}}

{{--    @if (session()->has('delete'))--}}
{{--        <script>--}}
{{--            window.onload = function() {--}}
{{--                notif({--}}
{{--                    msg: " تم حذف الصلاحية بنجاح",--}}
{{--                    type: "error"--}}
{{--                });--}}
{{--            }--}}
{{--        </script>--}}
{{--    @endif--}}

    @if(session()->has('Add'))
        <div class="alert alert-success" role="alert">
            تم اضافة الصلاحية بنجاح
        </div>
    @endif

@if(session()->has('edit'))
    <div class="alert alert-success" role="alert">
        تم تحديث بيانات الصلاحية بنجاح
    </div>
@endif
    @if(session()->has('delete'))
        <div class="alert alert-danger" role="alert">
            تم حذف الصلاحية بنجاح
        </div>
    @endif

    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                @can('اضافة صلاحية')
                                    <a class="btn btn-primary btn-sm mb-3" href="{{ route('roles.create') }}">اضافة</a>
                                @endcan
                            </div>
                        </div>
                        <br>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mg-b-0 text-md-nowrap table-hover ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                            <a class="btn btn-success btn-sm"
                                               href="{{ route('roles.show', $role->id) }}">عرض</a>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('roles.edit', $role->id) }}">تعديل</a>

                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                $role->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection

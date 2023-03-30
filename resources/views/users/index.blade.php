@extends('layouts.master')
@section('title') المستخدمين  @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') المستخدمين @endslot
        @slot('title') المستخدمين @endslot
    @endcomponent
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0 flex-grow-1 mb-3">كل المستخدمين</h4>
                    <div class="col-sm-1 col-md-2">
                        @can('اضافة مستخدم')
                            <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">اضافة مستخدم</a>
                        @endcan
                    </div>
                </div><!-- end card header -->

                <div class="card-body">

                    <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                        <thead>
                        <tr>
                            <th class="wd-10p border-bottom-0">#</th>
                            <th class="wd-15p border-bottom-0">اسم المستخدم</th>
                            <th class="wd-20p border-bottom-0">البريد الالكتروني</th>
                            <th class="wd-15p border-bottom-0">حالة المستخدم</th>
                            <th class="wd-15p border-bottom-0">نوع المستخدم</th>
                            <th class="wd-10p border-bottom-0">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->status == 'مفعل')
                                         {{ $user->status }}
                                    @else
                                        {{ $user->status }}
                                    @endif
                                </td>

                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                          {{ $v }}
                                        @endforeach
                                    @endif
                                </td>

                                <td>
                                    @can('تعديل مستخدم')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-m btn-info"
                                           title="تعديل"><i class="las la-pen"></i></a>
                                    @endcan   @can('حذف مستخدم')
                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light" data-bs-toggle="modal" data-id="{{$user->id}}" data-name="{{$user->name}}" data-bs-target="#myModal2"><i class="ri-delete-bin-5-line"></i></button>
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
    <!-- Default Modals -->
    <div id="myModal2" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">حذف مستخدم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="{{ route('users.destroy', 'test') }}" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">

                        <input type="hidden" name="id" id="id">

                        <h5 class="fs-15">
                            هل انت متاكد انك تريد حذف هذا المستخدم؟
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

        $('#myModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('#id').val(id);
            modal.find('#name').val(name);
        })
    </script>
@endsection

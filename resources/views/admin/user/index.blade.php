@extends('admin.layouts.app')
@section('title', 'Quản Lý Tài Khoản')

@section('content')
    <!-- DataTales Example -->
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts.notification')
                </div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-2 font-weight-bold text-primary float-left">Danh Sách Tài Khoản</h6>
                <a href="{{ route('user.create') }}" class="btn btn-success btn-sm float-right" data-toggle="tooltip"
                    data-placement="bottom" title="Tạo Tài Khoản"><i class="fas fa-plus"></i> Tạo Mới</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Ngày tạo</th>
                                <th>Chức Vụ</th>
                                <th>Trạng Thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($user->avatar)
                                                <img class="rounded-circle" src="{{ $user->avatar }}" style="max-width:50px"
                                                    alt="{{ $user->photo }}">
                                            @else
                                                <img class="rounded-circle" src="{{ asset('/images/default-avatar.png') }}"
                                                    style="max-width:50px" alt="Avatar">
                                            @endif
                                            <span class="ml-2">{{ $user->lastname }} {{ $user->firstname }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : '' }}</td>
                                    <td>{{ ucwords($user->role) }}</td>
                                    <td>
                                        @if ($user->status == 'active')
                                            <span class="badge badge-success">{{ $user->status }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $user->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="btn btn-info btn-sm float-left mr-1 btn-action" data-toggle="tooltip"
                                            title="Sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('user.destroy', [$user->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm btn-action btnDelete"
                                                data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="bottom"
                                                title="Xoá"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span style="float:right">{{ $users->links() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }

    </style>
@endpush

@push('scripts')

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#user-dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [5, 6]
            }]
        });

        // Sweet alert

        function deleteData(id) {

        }
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.btnDelete').click(function(e) {
                const form = $(this).closest('form');
                const dataID = $(this).data('id');
                e.preventDefault();
                Swal.fire({
                        title: "Bạn có muốn xoá?",
                        text: "Sau khi xóa, bạn sẽ không thể khôi phục dữ liệu này!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: "Huỷ",
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
            })
        })
    </script>
@endpush

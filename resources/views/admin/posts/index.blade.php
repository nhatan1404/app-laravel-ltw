@extends('admin.layouts.app')
@section('title', 'Danh Sách Bài Viết')

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
                <h6 class="mt-2 font-weight-bold text-primary float-left">Danh Sách Bài Viết</h6>
                <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm float-right" data-toggle="tooltip"
                    data-placement="bottom" title="Tạo Bài Viết"><i class="fas fa-plus"></i> Tạo Mới</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (count($posts) > 0)
                        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thumbnail</th>
                                    <th>Tiêu Đề</th>
                                    <th>Mô tả</th>
                                    <th>Danh Mục</th>
                                    <th>Tác Giả</th>
                                    <th>Trạng Thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    @php
                                        $author_info = DB::table('users')
                                            ->selectRaw('CONCAT(lastname, " ",firstname) as fullname')
                                            ->where('id', $post->user_id)
                                            ->get();
                                    @endphp
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            @if ($post->thumbnail)
                                                <img src="{{ $post->thumbnail }}" class="img-fluid zoom"
                                                    style="max-width:80px" alt="{{ $post->thumbnail }}">
                                            @else
                                                <img src="{{ asset('backend/img/thumbnail-default.jpg') }}"
                                                    class="img-fluid" style="max-width:80px" alt="avatar.png">
                                            @endif
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->description }}</td>
                                        <td>{{ $post->category->title }}</td>
                                        <td>
                                            @foreach ($author_info as $data)
                                                {{ $data->fullname }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($post->status == 'active')
                                                <span class="badge badge-success px-2 py-1">Hiển thị</span>
                                            @else
                                                <span class="badge badge-warning px-2 py-1">Ẩn</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="btn btn-info btn-sm float-left mr-1 btn-action" data-toggle="tooltip"
                                                title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{ route('posts.destroy', [$post->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm btn-action btnDelete"
                                                    data-id={{ $post->id }} data-toggle="tooltip"
                                                    data-placement="bottom" title="Delete"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span style="float:right">{{ $posts->links() }}</span>
                    @else
                        <h6 class="text-center">Danh sách bài viết trống</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/sweetalert2.min.css') }}" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }

        .zoom {
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(5);
        }

    </style>
@endpush

@push('scripts')
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
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

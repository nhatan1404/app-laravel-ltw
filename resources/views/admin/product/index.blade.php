@extends('admin.layouts.app')
@section('title', 'Danh Sách Sản Phẩm')

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
                <h6 class="mt-2 font-weight-bold text-primary float-left">Danh Sách Sản Phẩm</h6>
                <a href="{{ route('product.create') }}" class="btn btn-success btn-sm float-right" data-toggle="tooltip"
                    data-placement="bottom" title="Tạo Sản Phẩm"><i class="fas fa-plus"></i> Tạo Mới</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (count($products) > 0)
                        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Danh Mục</th>
                                    <th>Giá</th>
                                    <th>Chiết Khấu</th>
                                    <th>Số Lượng</th>
                                    <th>Đã Bán</th>
                                    <th>Trạng Thái</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->images)
                                                @php
                                                    $photo = explode(',', $product->images);
                                                @endphp
                                                <img src="{{ $photo[0] }}" class="img-fluid zoom" style="max-width:80px"
                                                    alt="{{ $product->photo }}">
                                            @else
                                                <img src="{{ asset('admin/img/thumbnail-default.jpg') }}"
                                                    class="img-fluid" style="max-width:80px"
                                                    alt="{{ $product->title }}">
                                            @endif
                                        </td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->category->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td> {{ $product->discount }}%</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->sold }}</td>
                                        <td>
                                            @if ($product->status == 'active')
                                                <span class="badge badge-success">Hiển thị</span>
                                            @else
                                                <span class="badge badge-warning">Ẩn</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-info btn-sm float-left mr-1 btn-action" data-toggle="tooltip"
                                                title="Sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{ route('product.destroy', [$product->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm btn-action btnDelete"
                                                    data-id={{ $product->id }} data-toggle="tooltip"
                                                    data-placement="bottom" title="Xoá"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span style="float:right">{{ $products->links() }}</span>
                    @else
                        <h6 class="text-center">No Products found!!! Please create Product</h6>
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

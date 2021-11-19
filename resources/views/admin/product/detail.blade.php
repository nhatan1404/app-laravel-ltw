@extends('admin.layouts.app')
@section('title', 'Chi Tiết Sản Phẩm')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-2 font-weight-bold text-primary float-left">Sản Phẩm
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-sm-3">#</th>
                                    <th class="col-sm-9">Thông tin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <td>Ảnh</td>
                                    <td><img class="img-thumbnail" style="width: 144px" src="{{ $product->images }}" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tên sản phẩm</td>
                                    <td>{{ $product->title }}</td>
                                </tr>
                                <tr>
                                    <td>Đường dẫn</td>
                                    <td>{{ $product->slug }}</td>
                                </tr>

                                <tr>
                                    <td>Mô tả</td>
                                    <td>{{ substr($product->description, 0, 420) }}<span id='dot'>...</span><span
                                            id="content_readmore">{{ substr($product->description, 420, strlen($product->description)) }}</span><a
                                            id="readmore">Xem thêm</a></td>
                                </tr>

                                <tr>
                                    <td>Số lượng</td>
                                    <td>{{ $product->quantity }}</td>
                                </tr>

                                <tr>
                                    <td>Đã bán</td>
                                    <td>{{ $product->sold }}</td>
                                </tr>

                                <tr>
                                    <td>Giá</td>
                                    <td>{{ Helpers::formatCurrency($product->price) }} VNĐ</td>
                                </tr>

                                <tr>
                                    <td>Chiết khấu</td>
                                    <td>{{ $product->discount }} %</td>
                                </tr>
                                <tr>
                                    <td>Danh mục</td>
                                    <td>
                                        {{ $product->category->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td>{{ $product->status == 'active' ? 'Hiển thị' : 'Ẩn' }}</td>
                                </tr>

                                <tr>
                                    <td>Ngày tạo</td>
                                    <td>{{ $product->created_at->format('d-m-Y') }}
                                        - {{ $product->created_at->format('g: i a') }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày cập nhật</td>
                                    <td>{{ $product->updated_at->format('d-m-Y') }}
                                        - {{ $product->updated_at->format('g: i a') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer d-flex">
                        <x-Admin.ButtonDetail :id="$product->id" edit="product.edit" delete="product.destroy" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #readmore {
            color: #434c57;
            font-size: 14px;
            font-weight: 500;
        }

    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            const content = $("#content_readmore");
            content.hide();
            $("#readmore").on("click", function() {
                $("#dot").text(content.is(':visible') ? '...' : '')
                $(this).text(content.is(':visible') ? 'Xem thêm' : '[Thu gọn]');
                content.slideToggle(300);
            });
        });
    </script>
@endpush

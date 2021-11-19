@extends('admin.layouts.app')
@section('title', 'Chi Tiết Bài Viết')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-2 font-weight-bold text-primary float-left">Bài Viết
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
                                    <td>{{ $posts->id }}</td>
                                </tr>
                                <tr>
                                    <td>Ảnh</td>
                                    <td><img class="img-thumbnail" style="width: 144px" src="{{ $posts->thumbnail }}" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tiêu đề</td>
                                    <td>{{ $posts->title }}</td>
                                </tr>
                                <tr>
                                    <td>Đường dẫn</td>
                                    <td>{{ $posts->slug }}</td>
                                </tr>

                                <tr>
                                    <td>Mô tả</td>
                                    <td>{{ $posts->description }}</td>
                                </tr>

                                <tr>
                                    <td>Mô tả</td>
                                    <td>{{ substr($posts->content, 0, 420) }}<span id='dot'>...</span><span
                                            id="content_readmore">{{ substr($posts->content, 420, strlen($posts->content)) }}</span><a
                                            id="readmore">Xem thêm</a></td>
                                </tr>

                                <tr>
                                    <td>Tác giả</td>
                                    <td>{{ $posts->author->fullname }}</td>
                                </tr>
                                <tr>
                                    <td>Danh mục</td>
                                    <td>
                                        {{ $posts->category->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td>{{ $posts->status == 'active' ? 'Hiển thị' : 'Ẩn' }}</td>
                                </tr>

                                <tr>
                                    <td>Ngày tạo</td>
                                    <td>{{ $posts->created_at->format('d-m-Y') }}
                                        - {{ $posts->created_at->format('g: i a') }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày cập nhật</td>
                                    <td>{{ $posts->updated_at->format('d-m-Y') }}
                                        - {{ $posts->updated_at->format('g: i a') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer d-flex">
                        <x-Admin.ButtonDetail :id="$posts->id" edit="posts.edit" delete="posts.destroy" />
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

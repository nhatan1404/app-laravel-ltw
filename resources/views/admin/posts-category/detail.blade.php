@extends('admin.layouts.app')
@section('title', 'Chi tiết Danh Mục Bài Viết')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-2 font-weight-bold text-primary float-left">Danh Mục Bài Viết
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
                                    <td>{{ $posts_category->id }}</td>
                                </tr>
                                <tr>
                                    <td>Tên danh mục</td>
                                    <td>{{ $posts_category->title }}</td>
                                </tr>

                                <tr>
                                    <td>Đường dẫn</td>
                                    <td>{{ $posts_category->slug }}</td>
                                </tr>
                                <tr>
                                    <td>Danh Mục Cha</td>
                                    <td>{{ $posts_category->parent ? $posts_category->parent->title : 'Không có' }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày tạo</td>
                                    <td>{{ $posts_category->created_at->format('d-m-Y') }}
                                        - {{ $posts_category->created_at->format('g: i a') }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày cập nhật</td>
                                    <td>{{ $posts_category->updated_at->format('d-m-Y') }}
                                        - {{ $posts_category->updated_at->format('g: i a') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer d-flex">
                        <x-Admin.ButtonDetail :id="$posts_category->id" edit="posts-category.edit"
                            delete="posts-category.destroy" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

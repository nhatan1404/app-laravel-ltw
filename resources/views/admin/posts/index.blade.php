@extends('admin.layouts.app')
@section('title', 'Danh Sách Bài Viết')

@section('content')
    @php
    $columns = [
        'id' => 'ID',
        'thumbnail' => 'Thumbnail',
        'title' => 'Tiêu Đề',
        'description' => 'Mô tả',
        'category' => 'Danh Mục',
        'author' => 'Tác Giả',
        'status' => 'Trạng Thái',
        'action' => '',
    ];
    @endphp

    <x-Admin.Table name="bài viết" :columns="$columns" create="posts.create" :value="$posts">
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
                        <img src="{{ $post->thumbnail }}" class="img-fluid zoom" style="max-width:80px"
                            alt="{{ $post->thumbnail }}">
                    @else
                        <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid"
                            style="max-width:80px" alt="avatar.png">
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
                    <x-Admin.ButtonAction :id="$post->id"  show="posts.show" edit="posts.edit" delete="posts.destroy" />
                </td>
            </tr>
        @endforeach
    </x-Admin.Table>
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
    <script src="{{ asset('admin/js/main.js') }}"></script>
@endpush

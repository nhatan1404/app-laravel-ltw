@extends('admin.layouts.app')
@section('title', 'Danh Sách Bài Viết')

@section('content')
    @php
    $columns = [
        'id' => 'ID',
        'title' => 'Tiêu Đề',
        'thumbnail' => 'Ảnh',
        'description' => 'Mô tả',
        'category' => 'Danh Mục',
        'author' => 'Tác Giả',
        'status' => 'Trạng Thái',
        'action' => '',
    ];
    @endphp

    <x-Admin.Table name="bài viết" :columns="$columns" create="posts.create" :value="$posts">
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>
                    @if ($post->thumbnail)
                        <img src="{{ $post->thumbnail }}" class="img-fluid zoom" style="max-width:80px"
                            alt="{{ $post->thumbnail }}">
                    @else
                        <img src="{{ asset('admin/img/thumbnail-default.jpg') }}" class="img-fluid"
                            style="max-width:80px" alt="avatar.png">
                    @endif
                </td>
                <td>{!! $post->description !!}</td>
                <td>{{ $post->category->title }}</td>
                <td>
                    {{ $post->author->fullname }}
                </td>
                <td>
                    @if ($post->status == 'active')
                        <span class="badge badge-success px-2 py-1">Hiển thị</span>
                    @else
                        <span class="badge badge-warning px-2 py-1">Ẩn</span>
                    @endif
                </td>
                <td class='col-sm-1'>
                    <x-Admin.ButtonAction :id="$post->id" show="posts.show" edit="posts.edit" delete="posts.destroy" />
                </td>
            </tr>
        @endforeach
    </x-Admin.Table>
@endsection

@push('styles')
    <style>
        .zoom {
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(5);
        }

    </style>
@endpush

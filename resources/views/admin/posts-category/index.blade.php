@extends('admin.layouts.app')
@section('title', 'Danh Sách Danh Mục Bài Viết')

@section('content')
    @php
    $columns = [
        'id' => 'ID',
        'title' => 'Tiêu Đề',
        'description' => 'Mô Tả',
        'slug' => 'Đường Dẫn',
        'action' => '',
    ];
    @endphp

    <x-Admin.Table name="danh mục bài viết" :columns="$columns" create="posts-category.create" :value="$posts_categories">
        @foreach ($posts_categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{!! $category->description == null || $category->description == '' ? '...' : $category->description !!}
                </td>
                <td>{{ $category->slug }}</td>
                </td>
                <td>
                    <x-Admin.ButtonAction :id="$category->id" show="posts-category.show" edit="posts-category.edit"
                        delete="posts-category.destroy" />
                </td>
            </tr>
        @endforeach
    </x-Admin.Table>
@endsection

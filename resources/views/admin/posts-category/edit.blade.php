@extends('admin.layouts.app')
@section('title', 'Sửa Danh Mục Bài Viết')

@section('content')
<x-Admin.Form.Edit name="Danh Mục Bài Viết" route="posts-category.update" :id="$posts_category->id">
    <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ $posts_category->title }}" />

    <x-Admin.Form.Textarea name="Mô tả" property="description" placeholder="Nhập mô tả"
        value="{{ $posts_category->description }}" placeholder="Nhập mô tả" />

    @if ($posts_category->parent_id != null)
        <x-Admin.Form.Select name="Danh mục cha" property="parent_id">
            @foreach ($parent_categories as $key => $parent_category)
                <option value='{{ $parent_category->id }}'
                    {{ $parent_category->id == $posts_category->parent_id ? 'selected' : '' }}>
                    {{ $parent_category->title }}
                </option>
            @endforeach
        </x-Admin.Form.Select>
    @endif
</x-Admin.Form.Edit>
@endsection
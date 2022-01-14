@extends('admin.layouts.app')
@section('title', 'Sửa Danh Mục Sản Phẩm')

@section('content')
    <x-Admin.Form.Edit name="Danh Mục Sản Phẩm" route="category.update" :id="$category->id">
        <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ $category->title }}" />

        <x-Admin.Form.Textarea name="Mô tả" property="description" placeholder="Nhập mô tả"
            value="{{ $category->description }}" placeholder="Nhập mô tả" />

        @if ($category->parent_id != null)
            <x-Admin.Form.Select name="Danh mục cha" property="parent_id">
                @foreach ($parent_categories as $key => $parent_category)
                    <option value='{{ $parent_category->id }}'
                        {{ $parent_category->id == $category->parent_id ? 'selected' : '' }}>
                        {{ $parent_category->title }}
                    </option>
                @endforeach
            </x-Admin.Form.Select>
        @endif
    </x-Admin.Form.Edit>
@endsection
@extends('admin.layouts.app')
@section('title', 'Tạo Danh Mục')

@section('content')
    <x-Admin.Form.Create name='Danh Mục' route='category.create'>
        <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ old('title') }}" />

        <x-Admin.Form.Textarea name=" Mô tả" property="description" placeholder="" value="{{ old('description') }}"
            placeholder="Nhập mô tả" />

        <x-Admin.Form.Select name="Danh mục cha" property="parent_id">
            @foreach ($parent_categories as $key => $parent_category)
                <option value='{{ $parent_category->id }}'>{{ $parent_category->title }}</option>
            @endforeach
        </x-Admin.Form.Select>
    </x-Admin.Form.Create>
@endsection

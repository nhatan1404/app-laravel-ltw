@extends('admin.layouts.app')
@section('title', 'Tạo Đơn Hàng')

@section('content')
    <x-Admin.Form.Create name='Đơn Hàng' route='order.create'>
        <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ old('title') }}" />

        <x-Admin.Form.Textarea name="Mô tả" property="description" placeholder="" value="{{ old('description') }}"
            placeholder="Nhập mô tả" />

        <div class="form-group {{ count($parentCategories) == 0 ? 'd-none' : '' }}">
            <label for="parent_id">Danh Mục Lớn: <small>(tuỳ chọn)</small></label>
            <select name="parent_id" class="form-control">
                <option value="">Chọn danh mục</option>
                @foreach ($parentCategories as $key => $parentCategory)
                    <option value='{{ $parentCategory->id }}'>{{ $parentCategory->title }}</option>
                @endforeach
            </select>
        </div>
    </x-Admin.Form.Create>
@endsection

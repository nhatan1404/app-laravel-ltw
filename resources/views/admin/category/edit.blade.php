@extends('admin.layouts.app')
@section('title', 'Sửa Danh Mục Sản Phẩm')

@section('content')
    <x-Admin.Form.Edit name="Danh Mục" route="category.update" :id="$category->id">
        <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ $category->title }}" />

        <x-Admin.Form.Textarea name="Mô tả" property="description" placeholder="Nhập mô tả"
            value="{{ $category->description }}" placeholder="Nhập mô tả" />

        <div class="form-group {{ $category->parent_id == null ? 'd-none' : '' }}">
            <label for="parent_id">Danh Mục Lớn: <small>(tuỳ chọn)</small></label>
            <select name="parent_id" class="form-control">
                <option value="">Chọn danh mục</option>
                @foreach ($parentCategories as $key => $parentCategory)
                    <option value='{{ $parentCategory->id }}'
                        {{ $parentCategory->id == $category->parent_id ? 'selected' : '' }}>{{ $parentCategory->title }}
                    </option>
                @endforeach
            </select>
        </div>
    </x-Admin.Form.Edit>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script>
        $('#is_parent').change(function() {
            var is_checked = $('#is_parent').prop('checked');
            if (is_checked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>
@endpush

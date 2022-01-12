@extends('admin.layouts.app')
@section('title', 'Tạo Bài Viết')

@section('content')
    <x-Admin.Form.Create name='Bài Viết' route='posts.store'>
        <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ old('title') }}" />

        <x-Admin.Form.Textarea name=" Mô tả" property="description" placeholder="" value="{{ old('description') }}"
            placeholder="Nhập mô tả" />

        <x-Admin.Form.Textarea name="Nội dung" property="content" placeholder="" value="{{ old('content') }}"
            placeholder="Nhập nội dung" rows="10" />

        <x-Admin.Form.Select name="Danh mục" property="category_id">
            @foreach ($categories as $parent)
                <optgroup label="{{ $parent->title }}">
                    @foreach ($parent->children as $children)
                        <option value="{{ $children->id }}" {{ old('category_id') == $children->id ? 'selected' : '' }}>
                            {{ $children->title }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </x-Admin.Form.Select>

        <x-Admin.Form.Select name="Tác giả" property="user_id">
            @foreach ($users as $key => $data)
                <option value='{{ $data->id }}' {{ $data->id == $current_user ? 'selected' : '' }}>
                    {{ $data->fullname }}</option>
            @endforeach
        </x-Admin.Form.Select>

        <x-Admin.Form.InputImage name="Thumbnail" property="thumbnail" :value="old('thumbnail')" />

        <x-Admin.Form.Select name="Trạng thái" property="status">
            <option value="active" {{ old('status' == 'active' ? 'selected' : '') }}>Hiển thị</option>
            <option value="inactive" {{ old('status' == 'inactive' ? 'selected' : '') }}>Ẩn</option>
        </x-Admin.Form.Select>
    </x-Admin.Form.Create>
@endsection

@push('scripts')
    <script>
        $('#lfm').filemanager();
    </script>
@endpush

@extends('admin.layouts.app')
@section('title', 'Tạo Sản Phẩm')

@section('content')
    <x-Admin.Form.Create name='Sản Phẩm' route='product.store'>
        <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ old('title') }}" />

        <x-Admin.Form.Textarea name=" Mô tả" property="description" placeholder="" value="{{ old('description') }}"
            placeholder="Nhập mô tả" rows="5"/>


        <x-Admin.Form.Input name="Chiết khấu(%)" property="discount" type="number" placeholder="Nhập chiết khấu"
            value="{{ old('discount') }}" min="0" max="100" />

        <x-Admin.Form.Input name="Số lượng" property="quantity" type="number" placeholder="Nhập số lượng"
            value="{{ old('quantity') }}" />

        <x-Admin.Form.Select name="Danh mục" property="category_id">
            @foreach ($categories as $parent)
                <optgroup label="{{ $parent->title }}">
                    @foreach ($parent->children as $children)
                        <option value="{{ $children->id }}">{{ $children->title }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </x-Admin.Form.Select>

        <x-Admin.Form.Input name="Giá" property="price" type="number" placeholder="Nhập giá" value="{{ old('price') }}" />

        <x-Admin.Form.InputImage name="Ảnh" property="images" />

        <x-Admin.Form.Select name="Trạng thái" property="status">
            <option value="active">Hiển thị</option>
            <option value="inactive">Ẩn</option>
        </x-Admin.Form.Select>
    </x-Admin.Form.Create>
@endsection

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager();
    </script>
@endpush

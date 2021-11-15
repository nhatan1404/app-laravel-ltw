@extends('admin.layouts.app')
@section('title', 'Sửa Sản Phẩm')

@section('content')
    <x-Admin.Form.Edit name="Sản Phẩm" route="product.update" :id="$product->id">
        <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ $product->title }}" />

        <x-Admin.Form.Textarea name=" Mô tả" property="description" placeholder="" value="{{ $product->description }}"
            placeholder="Nhập mô tả" />


        <x-Admin.Form.Input name="Chiết khấu(%)" property="discount" type="number" placeholder="Nhập chiết khấu"
            value="{{ $product->discount }}" min="0" max="100" />

            <x-Admin.Form.Input name="Số lượng" property="quantity" type="number" placeholder="Nhập số lượng"
            value="{{ $product->quantity }}" />

        <x-Admin.Form.Select name="Danh mục" property="category_id">
            @foreach ($categories as $parent)
                <optgroup label="{{ $parent->title }}">
                    @foreach ($parent->children as $children)
                        <option value="{{ $children->id }}"
                            {{ $children->id == $product->category->id ? ' selected' : '' }}>
                            {{ $children->title }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </x-Admin.Form.Select>

        <x-Admin.Form.Input name="Giá" property="price" type="number" placeholder="Nhập giá"
            value="{{ $product->price }}" />

        <x-Admin.Form.InputImage name="Ảnh" property="images" :value="$product->images" />

        <x-Admin.Form.Select name="Trạng thái" property="status">
            <option value="active" {{ $product->status == 'active' ? ' selected' : '' }}>Hiển thị
            </option>
            <option value="inactive" {{ $product->status == 'inactive' ? ' selected' : '' }}>Ẩn
            </option>
        </x-Admin.Form.Select>
    </x-Admin.Form.Edit>
@endsection

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager();
    </script>
@endpush

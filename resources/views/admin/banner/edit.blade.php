@extends('admin.layouts.app')
@section('title', 'Sửa Banner')

@section('content')
    <x-Admin.Form.Edit name="Danh Mục" route="banner.update" :id="$banner->id">
       <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ $banner->title }}" />

  <x-Admin.Form.Textarea name=" Mô tả" property="description" placeholder="" value="{{ $banner->description }}" />placeholder="Nhập mô tả" />

  <x-Admin.Form.InputImage name="Ảnh" property="photo" value="{{$banner->photo}}" />

  <x-Admin.Form.Select name="Trạng thái" property="status">
            <option value="active" {{ $product->status == 'active' ? ' selected' : '' }}>Hiển thị
            </option>
            <option value="inactive" {{ $product->status == 'inactive' ? ' selected' : '' }}>Ẩn
            </option>
        </x-Admin.Form.Select>
    </x-Admin.Form.Edit>
@endsection

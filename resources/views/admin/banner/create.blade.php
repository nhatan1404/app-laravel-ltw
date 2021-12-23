@extends('admin.layouts.app')
@section('title', 'Tạo Banner')

@section('content')
<x-Admin.Form.Create name='Banner' route='banner.store'>
  <x-Admin.Form.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ old('title') }}" />

  <x-Admin.Form.Textarea name=" Mô tả" property="description" placeholder="" value="{{ old('description') }}" placeholder="Nhập mô tả" />

  <x-Admin.Form.InputImage name="Ảnh" property="photo" />

  <x-Admin.Form.Select name="Trạng thái" property="status">
    <option value="active">Hiển thị</option>
    <option value="inactive">Ẩn</option>
  </x-Admin.Form.Select>
</x-Admin.Form.Create>
@endsection
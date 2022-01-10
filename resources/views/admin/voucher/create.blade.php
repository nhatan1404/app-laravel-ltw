@extends('admin.layouts.app')
@section('title', 'Tạo Mã Giảm Giá')

@section('content')
    <x-Admin.Form.Create name="Mã Giảm Giá" route="voucher.store">
        <x-Admin.Form.Input name="Mã" property="code" placeholder="Nhập mã" value="{{ old('code') }}" />

        <x-Admin.Form.Select name="Loại" property="type">
            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Giá tiền</option>
            <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Phần trăm</option>
        </x-Admin.Form.Select>

        <x-Admin.Form.Input name="Giá trị" property="value" type="number" placeholder="Nhập giá trị"
            value="{{ old('value') }}" />

        <x-Admin.Form.Input name="Số lượt sử dụng" property="time" type="number" placeholder="Nhập số lượt"
            value="{{ old('time') }}" />

        <x-Admin.Form.Select name="Trạng thái" property="status">
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Còn hiệu lực</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Hết hạn</option>
        </x-Admin.Form.Select>
    </x-Admin.Form.Create>
@endsection

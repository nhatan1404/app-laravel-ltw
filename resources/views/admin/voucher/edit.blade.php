@extends('admin.layouts.app')
@section('title', 'Sửa Mã Giảm Giá')

@section('content')
    <x-Admin.Form.Edit name="Mã Giảm Giá" route="voucher.update" :id="$voucher->id">
        <x-Admin.Form.Input name="Mã" property="code" placeholder="Nhập mã" value="{{ $voucher->code }}" />

        <x-Admin.Form.Select name="Loại" property="type">
            <option value="fixed" {{ $voucher->type == 'fixed' ? 'selected' : '' }}>Giá tiền</option>
            <option value="percent" {{ $voucher->type == 'percent' ? 'selected' : '' }}>Phần trăm</option>
        </x-Admin.Form.Select>

        <x-Admin.Form.Input name="Giá trị" property="value" type="number" placeholder="Nhập giá trị"
            value="{{ $voucher->value }}" />

        <x-Admin.Form.Select name="Trạng thái" property="status">
            <option value="active" {{ $voucher->status == 'active' ? 'selected' : '' }}>Còn hiệu lực</option>
            <option value="inactive" {{ $voucher->status == 'inactive' ? 'selected' : '' }}>Hết hạn</option>
        </x-Admin.Form.Select>
    </x-Admin.Form.Edit>
@endsection

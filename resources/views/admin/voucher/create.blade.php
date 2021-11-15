@extends('admin.layouts.app')
@section('title', 'Tạo Mã Giảm Giá')

@section('content')
    <x-Admin.Form.Create name="Mã Giảm Giá" route="voucher.store">
        <x-Admin.Form.Input name="Mã" property="code" placeholder="Nhập mã" value="{{ old('code') }}" />

        <x-Admin.Form.Select name="Loại" property="type">
            <option value="fixed">Giá tiền</option>
            <option value="percent">Phần trăm</option>
        </x-Admin.Form.Select>

        <x-Admin.Form.Input name="Giá trị" property="value" type="number" placeholder="Nhập giá trị"
            value="{{ old('value') }}" />

        <x-Admin.Form.Select name="Trạng thái" property="status">
            <option value="active">Còn hiệu lực</option>
            <option value="inactive">Hết hạn</option>
        </x-Admin.Form.Select>
    </x-Admin.Form.Create>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');

        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
        });
    </script>
@endpush

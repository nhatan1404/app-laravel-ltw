@extends('admin.layouts.app')
@section('title', 'Sửa Đơn Đặt Hàng')

@section('content')
    <x-Admin.Form.Edit name="Đơn Đặt Hàng" route="order.update" :id="$order->id">
        <x-Admin.Form.Select name="Trạng thái" property="status">
            @if ($order->status != 'done')
                @if ($order->status != 'delivering' && $order->status != 'accepted')
                    <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>Mới</option>
                    <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Chấp nhận</option>
                @endif
                <option value="delivering" {{ $order->status == 'delivering' ? 'selected' : '' }}>Đang vận chuyển</option>
                <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>Huỷ</option>
            @endif
            @if ($order->status != 'cancel')
                <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Hoàn thành</option>
            @endif
        </x-Admin.Form.Select>

        <x-Admin.Form.Textarea name="Ghi chú" property="note" placeholder="Nhập ghi chú" :value="$order->note" />
    </x-Admin.Form.Edit>
@endsection

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager();
    </script>
@endpush

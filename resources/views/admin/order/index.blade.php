@extends('admin.layouts.app')
@section('title', 'Danh Sách Đơn Đặt Hàng')

@section('content')
    @php
    $columns = [
        'id' => 'ID',
        'order_number' => 'Mã Đơn',
        'fullname' => 'Họ Tên',
        'address' => 'Địa Chỉ',
        'email' => 'Email',
        'telephone' => 'Số Điện Thoại',
        'status' => 'Trạng Thái',
        'total' => 'Tổng',
        'note' => 'Ghi chú',
        '' => '',
    ];
    @endphp

    <x-Admin.Table name="đơn đặt hàng" :columns="$columns" create="order.create" :value="$orders">
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->fullname }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->telephone }}</td>
                <td class="text-center">
                    @if ($order->status == 'new')
                        <span class="badge badge-primary">{{ $order->status }}</span>
                    @elseif($order->status=='accepted')
                        <span class="badge badge-warning">{{ $order->status }}</span>
                    @elseif($order->status=='cancel')
                        <span class="badge badge-danger">{{ $order->status }}</span>
                    @elseif($order->status=='done')
                        <span class="badge badge-success">{{ $order->status }}</span>
                    @else
                        <span class="badge badge-info">{{ $order->status }}</span>
                    @endif
                </td>
                <td>{{ Helpers::formatCurrency($order->total) }} VNĐ </td>
                <td>{{ $order->note != null ? $order->note : 'Trống...' }}</td>
                </td>
                <td>
                    <x-Admin.ButtonAction :id="$order->id"  show="order.show" edit="order.edit" delete="order.destroy" />
                </td>
            </tr>
        @endforeach
    </x-Admin.Table>
    <!-- End Page Content -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/sweetalert2.min.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('admin/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
@endpush

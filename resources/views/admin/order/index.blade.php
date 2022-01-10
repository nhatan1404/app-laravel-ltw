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
                    {!! Helpers::displayStatusOrder($order->status) !!}
                </td>
                <td>{{ Helpers::formatCurrency($order->total) }}</td>
                <td>
                    <a href="{{ route('order.show', $order->id) }}"
                        class="btn btn-primary btn-sm float-left mr-1 btn-circle" data-toggle="tooltip" title="Xem"
                        data-placement="bottom"><i class="fas fa-info-circle"></i></a>
                    <a href="{{ route('order.edit', $order->id) }}"
                        class="btn btn-warning btn-sm float-left mr-1 btn-circle" data-toggle="tooltip" title="Sửa"
                        data-placement="bottom"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        @endforeach
    </x-Admin.Table>
    <!-- End Page Content -->
@endsection

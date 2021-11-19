@extends('admin.layouts.app')
@section('title', 'Chi Tiết Đơn Đặt Hàng')

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

    $orders = [$order];
    @endphp

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Đơn Đặt Hàng
                    <span>
                        <a href="{{ route('order.edit', $order->id) }}"
                            class=" btn btn-sm btn-warning shadow-sm float-right mr-2"><i class="fas fa-edit mr-1"></i>Sửa</a>
                    </span>
                </h5>
            </div>
            <div class="card-body">
                @if ($order)
                    <section class="confirmation_part section_padding">
                        <div class="order_boxes">
                            <div class="row">
                                <div class="col-lg-6 col-lx-4">
                                    <div class="order-info">
                                        <h4 class="text-center pb-4" style="text-transform: uppercase;">Thông Tin Đơn Hàng
                                        </h4>
                                        <table class="table">
                                            <tr class="">
                                                <td>Mã đơn</td>
                                                <td> : {{ $order->order_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày tạo đơn</td>
                                                <td> : Ngày {{ $order->created_at->format('d/m/Y') }} lúc
                                                    {{ $order->created_at->format('g : i a') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Số lượng sản phẩm</td>
                                                <td> : {{ $order->items->count() }}</td>
                                            </tr>
                                            <tr>
                                                <td>Order Status</td>
                                                <td> : {{ $order->status }}</td>
                                            </tr>

                                            <tr>
                                                <td>Giảm giá</td>
                                                <td> : O VNĐ</td>
                                            </tr>
                                            <tr>
                                                <td>Tổng số tiền</td>
                                                <td> : {{ Helpers::formatCurrency($order->total) }} VNĐ</td>
                                            </tr>
                                            <tr>
                                                <td>Ghi chú</td>
                                                <td> : {{ $order->note ? $order->note : 'Không có' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-lx-4">
                                    <div class="shipping-info">
                                        <h4 class="text-center pb-4" style="text-transform: uppercase;">Thông Tin Vận Chuyển
                                        </h4>
                                        <table class="table">
                                            <tr class="">
                                                <td>Họ tên: </td>
                                                <td> : {{ $order->user->fullname }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td> : {{ $order->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Số điện thoại</td>
                                                <td> : {{ $order->telephone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Địa chỉ</td>
                                                <td> : {{ $order->address }}</td>
                                            </tr>
                                            <tr>
                                                <td>Phường/Xã:</td>
                                                <td> : {{ $order->user->address->ward->name_with_type }}</td>
                                            </tr>
                                            <tr>
                                                <td>Thành phố/Quận</td>
                                                <td> : {{ $order->user->address->district->name_with_type }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tỉnh</td>
                                                <td> : {{ $order->user->address->province->name_with_type }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info,
        .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4,
        .shipping-info h4 {
            text-decoration: underline;
        }

    </style>
@endpush

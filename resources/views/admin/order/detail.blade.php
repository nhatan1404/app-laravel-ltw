@extends('admin.layouts.app')
@section('title', 'Chi Tiết Đơn Đặt Hàng')

@section('content')
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
                                                <td>Trạng thái</td>
                                                <td> : {!! Helpers::displayStatusOrder($order->status) !!}</td>
                                            </tr>

                                            <tr>
                                                <td>Giảm giá</td>
                                                <td> : {{ Helpers::formatCurrency($order->discount) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tổng số tiền</td>
                                                <td> : {{ Helpers::formatCurrency($order->total) }}</td>
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
        <div class="card shadow my-4">
            <div class="card-header py-3">
                <h6 class="mt-2 font-weight-bold text-primary float-left">Danh sách sản phẩm</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableCategory" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh</th>
                                <th>Tên</th>
                                <th>Danh Mục</th>
                                <th>Số Lượng</th>
                                <th>Giá</th>
                                <th>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        @if ($item->product->images)
                                            @php
                                                $photo = explode(',', $item->product->images);
                                            @endphp
                                            <img src="{{ $photo[0] }}" class="img-fluid zoom"
                                                style="max-width:80px; max-height: 100px"
                                                alt="{{ $item->product->title }}">
                                        @else
                                            <img src="{{ asset('admin/img/thumbnail-default.jpg') }}"
                                                class="img-fluid" style="max-width:80px"
                                                alt="{{ $item->product->title }}">
                                        @endif
                                    </td>
                                    <td>{{ $item->product->title }}</td>
                                    <td>{{ $item->product->category->title }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ Helpers::formatCurrency($item->price / $item->quantity) }}</td>
                                    <td>{{ Helpers::formatCurrency($item->price) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

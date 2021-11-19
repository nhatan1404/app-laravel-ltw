@extends('shop.layouts.app')
@section('title', 'Giỏ Hàng')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span>
                        <span>Cart</span>
                    </p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        @if (!$carts || $carts->count == 0)
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="card">
                            <div class="card-header cart-empty">
                                <h5 class="my-auto"><span class="icon-shopping-cart mr-1"></span> Giỏ hàng</h5>
                            </div>
                            <div class="card-body cart">
                                <div class="col-sm-12 text-center"> <img src="{{ asset('shop/images/empty-cart.png') }}"
                                        width="130" height="130" class="img-fluid mb-4 mr-3">
                                    <h3>
                                        Giỏ hàng của bạn còn trống
                                    </h3>
                                    <a href="{{ route('product-list') }}" class="btn btn-primary btn-lg m-3">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <x-Shop.Cart.CartList :carts="$carts" />
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Mã giảm giá</h3>
                            <p>Nhập mã giảm giá nều bạn có</p>
                            <form action="#" class="info">
                                <div class="form-group">
                                    <label for="">Mã giảm giá:</label>
                                    <input type="text" class="form-control text-left px-3" placeholder="">
                                </div>
                            </form>
                        </div>
                        <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
                    </div>
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Ước tính phí vận chuyển và thuế</h3>
                            <p>Nhập địa chỉ giao hàng của bạn để tính cước tính vận chuyển</p>
                            <form action="#" class="info">
                                <div class="form-group">
                                    <label for="country">Tỉnh: </label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="" id="province" class="form-control">
                                            @foreach (Helpers::getAllProvince() as $province)
                                                <option value="{{ $province->id }}"
                                                    {{ $province->id == $user->address->province->id ? ' selected' : '' }}>
                                                    {{ $province->name_with_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="country">Thành phố/Quận: </label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="" id="district" class="form-control">
                                            @foreach (Helpers::getDistricts($user->address->province->id) as $district)
                                                <option value="{{ $district->id }}"
                                                    {{ $district->id == $user->address->district->id ? ' selected="selected"' : '' }}>
                                                    {{ $district->name_with_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="country">Phường/Xã: </label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="" id="ward" class="form-control">
                                            @foreach (Helpers::getWards($user->address->district->id) as $ward)
                                                <option value="{{ $ward->id }}"
                                                    {{ $ward->id == $user->address->ward->id ? ' selected' : '' }}>
                                                    {{ $ward->name_with_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <p><a href="{{ route('checkout') }}" class="btn btn-primary py-3 px-4">Estimate</a></p>
                    </div>
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Tổng Giỏ Hàng</h3>
                            <p class="d-flex">
                                <span>Tổng tiền hàng</span>
                                <span id="subtotal">{{ Helpers::formatCurrency($carts->total) }} VNĐ</span>
                            </p>
                            <p class="d-flex">
                                <span>Phí vận chuyển</span>
                                <span>0 VNĐ</span>
                            </p>
                            <p class="d-flex">
                                <span>Mã giảm giá</span>
                                <span>0 VNĐ</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Tổng số tiền</span>
                                <span id="total-price">{{ Helpers::formatCurrency($carts->total) }} VNĐ</span>
                            </p>
                        </div>
                        <p><a href="{{ route('checkout') }}" class="btn btn-primary py-3 px-4">Thanh Toán</a></p>
                    </div>
                </div>
            </div>
        @endif

        @if (!$carts || $carts->count == 0)
            <section class="ftco-section">
                <div class="container">
                    <div class="row justify-content-center mb-3 pb-3">
                        <div class="col-md-12 heading-section text-center ftco-animate">
                            <h2 class="mb-4">Có thể bạn thích</h2>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        @foreach (Helpers::getRandomProduct() as $product)
                            <x-Shop.Product.Item :product="$product" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </section>
@endsection

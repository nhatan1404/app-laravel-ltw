@extends('shop.layouts.app')
@section('title', $product->title)

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Trang
                                chủ</a></span>
                        <span class="mr-2"><a href="{{ route('product-list') }}">Sản phẩm</a></span>
                        {{ $product->title }}<span></span>
                    </p>
                    <h1 class="mb-0 bread">{{ $product->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ $product->images }}" class="image-popup"><img src="{{ $product->images }}"
                            class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->title }}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span
                                    style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">{{ $product->sold }} <span
                                    style="color: #bbb;">đã bán</span></a>
                        </p>
                    </div>
                    <p class="price"><span>{{ $product->origin_price }}đ</span></p>
                    <p>{{ substr($product->description, 0, 420) }}<span id='dot'>...</span><span
                            id="content_readmore">{{ substr($product->description, 420, strlen($product->description)) }}</span><a
                            id="readmore">Xem thêm</a>
                    </p>
                    <div class="row mt-4">
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="ion-ios-remove"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1"
                                min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="ion-ios-add"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <p style="color: #000;">Số lượng: {{ $product->quantity }} có sẵn</p>
                        </div>
                    </div>
                    <p><a href="cart.html" class="btn btn-black py-3 px-5">Thêm Vào Giỏ Hàng</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($related_products as $product)
                    <x-Shop.Product.Item :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        #readmore {
            color: #434c57;
            font-size: 14px;
            font-weight: 500;
        }

    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            const content = $("#content_readmore");
            content.hide();
            $("#readmore").on("click", function() {
                $("#dot").text(content.is(':visible') ? '...' : '')
                $(this).text(content.is(':visible') ? 'Xem thêm' : '[Thu gọn]');
                content.slideToggle(300);
            });


            const quantity = $("#quantity");
            const minus = $(".quantity-left-minus");
            const plus = $(".quantity-right-plus");

            minus.on("click", function() {
                const current = parseInt(quantity.val());
                if (current > 1) {
                    quantity.val(current - 1);
                }
            })

            plus.on("click", function() {
                const current = parseInt(quantity.val());
                if (current <= 99) {
                    quantity.val(current + 1);
                }
            })
        });
    </script>
@endpush

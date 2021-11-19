@extends('shop.layouts.app')
@section('title', 'Trang Chủ')

@section('content')

    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
            <div class="slider-item" style="background-image: url({{ asset('shop/images/bg_1.jpg') }});">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">Chúng tôi bán các loại rau tươi và trái cây sạch</h1>
                            <h2 class="subheading mb-4">Chúng tôi cung cấp rau hữu cơ &amp; trái cây</h2>
                            <p><a href="#" class="btn btn-primary">Xem chi tiết</a></p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="slider-item" style="background-image: url({{ asset('shop/images/bg_2.jpg') }});">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                        <div class="col-sm-12 ftco-animate text-center">
                            <h1 class="mb-2">100% tươi ngon và sạch</h1>
                            <h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
                            <p><a href="#" class="btn btn-primary">Xem chi tiết</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row no-gutters ftco-services">
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Miễn Phí Vận Chuyển</h3>
                            <span>Đơn hàng trên 1.000.000 VNĐ</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-diet"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Sản Phẩm Luôn Tươi Ngon</h3>
                            <span>Luôn được đóng gói tốt</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-award"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Chất Lượng Cao</h3>
                            <span>Sản phẩm chất lượng tốt</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-customer-service"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Hỗ Trợ</h3>
                            <span>Hỗ trợ 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-category ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 order-md-last align-items-stretch d-flex">
                            <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex"
                                style="background-image: url({{ asset('shop/images/category.jpg') }});">
                                <div class="text text-center">
                                    <h2>Rau Củ Quả Sạch</h2>
                                    <p>Bảo vệ sức khỏe mọi nhà</p>
                                    <p><a href="{{route('product-list')}}" class="btn btn-primary">Mua Ngay</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end"
                                style="background-image: url({{ asset('shop/images/category-1.jpg') }});">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="#">Fruits</a></h2>
                                </div>
                            </div>
                            <div class="category-wrap ftco-animate img d-flex align-items-end"
                                style="background-image: url({{ asset('shop/images/category-2.jpg') }});">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="#">Vegetables</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end"
                        style="background-image: url({{ asset('shop/images/category-3.jpg') }});">
                        <div class="text px-3 py-1">
                            <h2 class="mb-0"><a href="#">Juices</a></h2>
                        </div>
                    </div>
                    <div class="category-wrap ftco-animate img d-flex align-items-end"
                        style="background-image: url({{ asset('shop/images/category-4.jpg') }});">
                        <div class="text px-3 py-1">
                            <h2 class="mb-0"><a href="#">Dried</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Sản Phẩm Nổi Bật</span>
                    <h2 class="mb-4">Các Sản Phẩm Của Chúng Tôi</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" id="product-list">
                @foreach ($products as $product)
                    <x-Shop.Product.Item :product="$product" />
                @endforeach
            </div>
            <div class="text-center"><button class="see-more btn btn-primary mx">Xem Thêm</button></div>
        </div>
    </section>

    <section class="ftco-section img" style="background-image: url({{ asset('shop/images/bg_3.jpg') }});">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
                    <span class="subheading">Giá tốt nhất cho bạn</span>
                    <h2 class="mb-4">Ưu đãi trong ngày</h2>
                    <h3><a href="#">Rau xà lách</a></h3>
                    <span class="price">30.000 VNĐ<a href="#">chỉ còn 20.000 VNĐ</a></span>
                    <div id="timer" class="d-flex mt-5">
                        <div class="time" id="days"></div>
                        <div class="time pl-3" id="hours"></div>
                        <div class="time pl-3" id="minutes"></div>
                        <div class="time pl-3" id="seconds"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(function() {
            var pageNumber = 2;
            $(".see-more").click(function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'get',
                    url: `${window.location.origin}/?page= + ${pageNumber}`,
                    success: function(response) {
                        pageNumber += 1;
                        $("#product-list").append(response);
                        contentWayPoint();
                    },
                    error: function(error) {
                        //console.log(error.responseJSON.message)
                    },
                })
            });
        });
    </script>
@endpush

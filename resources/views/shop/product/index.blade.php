@extends('shop.layouts.app')
@section('title', '')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Trang
                                Chủ</a></span>
                        @if (isset($category) && $category->parent != null)
                            <span><a
                                    href="{{ route('product-by-category', $category->parent->slug) }}">{{ $category->parent->title }}</a></span>
                        @endif
                    </p>
                    <h1 class="mb-0 bread">{{ isset($category) ? $category->title : 'Sản Phẩm' }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="{{ route('product-list') }}" class="active">Tất cả</a></li>
                        <li><a href="#">Rau củ</a></li>
                        <li><a href="#">Trái cây</a></li>
                        <li><a href="#">Nước ép</a></li>
                        <li><a href="#">Đồ Khô</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <x-Shop.Product.Item :product="$product" />
                @endforeach
            </div>
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </section>
@endsection

@php
$title = 'Tất cả sản phẩm';
if (Route::currentRouteName() != 'product-list') {
    $title = $category->title;
}
@endphp

@extends('shop.layouts.app')
@section('title', $title)

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
                        <li><a href="{{ route('product-list') }}" {!! Route::currentRouteName() == 'product-list' ? ' class="active"' : '' !!}>Tất cả</a></li>
                        @foreach (Helpers::getListMenuCategory() as $cat)
                            <li><a href="{{ route('product-by-category', $cat->slug) }}"
                                    {!! Route::currentRouteName() == 'product-by-category' && (Route::current()->parameter('slug') == $cat->slug || ($parent_category && $cat->slug == $parent_category->slug)) ? ' class="active"' : '' !!}>{{ $cat->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="filter__item">
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-5">
                        <div class="filter__sort">
                            <span>Sắp xếp</span>
                            <form method="get" action="">
                                @if ($paginate != 8)
                                    <input type="hidden" name="paginate" value="{{ $paginate }}" />
                                @endif
                                <select class='form-control form-filter' id="sort-product" name="sort"
                                    onchange="this.form.submit()">
                                    @foreach (Helpers::getSortList() as $value)
                                        <option value="{{ $value[0] }}" {{ $value[0] == $sort ? 'selected' : '' }}>
                                            {{ $value[1] }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="filter__sort">
                            <span>Số sản phẩm hiển thị</span>
                            <form method="get" action="">
                                @if ($sort != 'new')
                                    <input type="hidden" name="sort" value="{{ $sort }}" />
                                @endif
                                <select class='form-control form-filter' id="paginate-product" name="paginate"
                                    onchange="this.form.submit()">
                                    @foreach (Helpers::getPaginateList() as $value)
                                        <option value="{{ $value }}" {{ $value == $paginate ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
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

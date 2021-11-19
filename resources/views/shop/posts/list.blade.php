@extends('shop.layouts.app')
@section('title', 'Bài Viết')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Trang
                                Chủ</a></span>
                        <span>Tin Tức</span>
                    </p>
                    <h1 class="mb-0 bread">Tin Tức</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <div class="row">
                        @foreach ($posts as $post)
                            <x-Shop.Post.Item :post="$post" />
                        @endforeach
                    </div>
                    {{ $posts->links('vendor.pagination.default') }}
                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon ion-ios-search"></span>
                                <input type="text" class="form-control" placeholder="Tìm kiếm">
                            </div>
                        </form>
                    </div>

                    <x-Shop.Post.ListCategory :categories="$categories" />

                    <x-Shop.Post.ListRecent :posts="$recent_posts" name="Bài Viết Ngẫu Nhiên" />

                </div>

            </div>
        </div>
    </section> <!-- .section -->
@endsection

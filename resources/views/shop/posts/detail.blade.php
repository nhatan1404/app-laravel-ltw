@extends('shop.layouts.app')
@section('title', $post->title)

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Trang
                                chủ</a></span>
                        <span>{{ $post->category->title }}</span>
                    </p>
                    <h1 class="mb-0 bread">{{ $post->title }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <h2 class="mb-3">{{ $post->title }}</h2>
                {{ $post->content }}

                    @if (Auth::check())
                        <div class="pt-5 mt-5">
                            <div class="comment-form-wrap pt-5">
                                <h3 class="mb-5">Bình luận</h3>
                                <form action="#" class="p-5 bg-light">
                                    {{-- <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="url" class="form-control" id="website">
                                </div> --}}

                                    <div class="form-group">
                                        <label for="message">Nội dung:</label>
                                        <textarea name="" id="message" cols="30" rows="10"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Bình luận" class="btn py-3 px-4 btn-primary">
                                    </div>

                                </form>
                            </div>
                        </div>
                    @endif
                    <p>Đăng nhập để bình luận</p>
                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon ion-ios-search"></span>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                    </div>

                    <x-Shop.Post.ListCategory :categories="$categories" />

                    <x-Shop.Post.ListRecent :posts="$recent_posts" name="Bài Viết Gần Đây" />

                </div>
            </div>
    </section> <!-- .section -->
@endsection

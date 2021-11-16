@extends('shop.layouts.app')
@section('title', 'Bài Viết')

@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span>
                        <span>Blog</span>
                    </p>
                    <h1 class="mb-0 bread">Blog</h1>
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
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                    </div>

                    <x-Shop.Post.ListCategory :categories="$categories" />

                    <x-Shop.Post.ListRecent :posts="$recent_posts" name="Bài Viết Ngẫu Nhiên" />

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Tag Cloud</h3>
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">fruits</a>
                            <a href="#" class="tag-cloud-link">tomatoe</a>
                            <a href="#" class="tag-cloud-link">mango</a>
                            <a href="#" class="tag-cloud-link">apple</a>
                            <a href="#" class="tag-cloud-link">carrots</a>
                            <a href="#" class="tag-cloud-link">orange</a>
                            <a href="#" class="tag-cloud-link">pepper</a>
                            <a href="#" class="tag-cloud-link">eggplant</a>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Paragraph</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus
                            voluptate
                            quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique,
                            inventore eos
                            fugit cupiditate numquam!</p>
                    </div>
                </div>

            </div>
        </div>
    </section> <!-- .section -->
@endsection

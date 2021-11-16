<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                class="icon-phone2"></span></div>
                        <span class="text">+ 1235 2355 98</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                class="icon-paper-plane"></span></div>
                        <span class="text">youremail@email.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">3-5 Business days delivery &amp; Free Returns</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Vegefoods</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Trang Chủ</a></li>
                {{ Helpers::getHeaderCategory() }}
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">Giới Thiệu</a></li>
                <li class="nav-item"><a href="{{ route('posts-list') }}" class="nav-link">Tin Tức</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Liên Hệ</a></li>
                {{-- <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span
                            class="icon-heart"></span>[0]</a></li> --}}
                <li class="nav-item cta cta-colored"><a href="{{ route('cart') }}" class="nav-link"><span
                            class="icon-shopping_cart"></span>[0]</a></li>
                <li class="nav-item cta cta-colored"><a
                        href="{{ Auth::check() ? route('profile', Auth::id()) : route('login') }}"
                        class="nav-link"><span
                            class="icon-user mr-2"></span>{{ Auth::check() ? Auth::user()->fullname : '' }}</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

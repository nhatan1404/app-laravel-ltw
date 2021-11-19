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

                <x-Shop.Shared.CategoryMenu :categories="Helpers::getListMenuCategory()" />

                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">Giới Thiệu</a></li>
                <li class="nav-item"><a href="{{ route('posts-list') }}" class="nav-link">Tin Tức</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Liên Hệ</a></li>
                <li class="nav-item cta cta-colored">
                    <a id="cart_count" href="{{ route('cart') }}" class="nav-link">
                        <span class="icon-shopping_cart"></span>
                        @guest
                            [0]
                        @else
                        
                            [{{ Helpers::getCartCount() }}]
                        @endguest
                    </a>
                </li>
                <li class="nav-item cta cta-colored"><a
                        href="{{ Auth::check() ? route('profile', Auth::id()) : route('user-login') }}"
                        class="nav-link"><span
                            class="icon-user mr-2"></span>{{ Auth::check() ? Auth::user()->fullname : '' }}</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<div class="col-md-6 col-lg-3 ftco-animate">
    <div class="product">
        <a href="{{ route('product-detail', $product->slug) }}" class="img-prod"><img class="img-fluid"
                src="{{ $product->images }}" alt="{{ $product->title }}">
            <span class="status">{{ $product->discount }}%</span>
            <div class="overlay"></div>
        </a>
        <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
            <div class="d-flex">
                <div class="pricing">
                    <p class="price"><span class="mr-2 price-dc">{{ $product->origin_price }}</span><span
                            class="price-sale">{{ $product->price_after_discount }}</span></span>
                    </p>
                </div>
            </div>
            <div class="bottom-area d-flex px-3">
                <div class="m-auto d-flex">
                    <a href="javascript:void(0)" onclick="addCart({{ $product->id }})"
                        class="buy-now d-flex justify-content-center align-items-center mx-1">
                        <span><i class="ion-ios-cart"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

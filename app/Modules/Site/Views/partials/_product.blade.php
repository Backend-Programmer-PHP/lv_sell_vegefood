<section class="ftco-section">
    <div class="container">
        @include('Site::partials._notifications')
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Featured Products</span>
                <h2 class="mb-4">Our Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
    </div>
    @if ($products)
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    @php
                        $reducedPrice = (100 - $product->discount) / 100;
                        $discount = $product->price * $reducedPrice;
                    @endphp
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{ route('product.detail', $product->slug) }}" class="img-prod"><img
                                    class="img-fluid" src="{{ $product->photo }}" alt="Colorlib Template">
                                @if ($product->discount > 0)
                                    <span class="status">{{ $product->discount }}%</span>
                                @endif
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <span
                                                class="mr-2 price-dc">{{ number_format($product->price, 0, '.', '') }}K</span>
                                            @if ($product->discount > 0)
                                                <span
                                                    class="price-sale">{{ number_format($discount, 0, '.', '') }}K</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="#"
                                            class="style-custom add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a href="{{ route('cart.add', $product->slug) }}"
                                            class="style-custom buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <form action="{{ route('product.favorite.add', $product->id) }}"
                                            method="post">
                                            @csrf
                                            @if (Auth::user())
                                                @if (App\modules\site\helpers\Helper::checkFavorte($product->id) == 0)
                                                    <button type="submit"
                                                        class="style-custom heart d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-heart"></i></span>
                                                    </button>
                                                @else
                                                    <button type="submit"
                                                        class="style-custom heart d-flex justify-content-center align-items-center">
                                                        <span><i class="ion-ios-trash"></i></span>
                                                    </button>
                                                @endif
                                            @endif

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
</section>

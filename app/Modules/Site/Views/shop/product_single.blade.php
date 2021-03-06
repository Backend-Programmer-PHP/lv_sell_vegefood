@extends('Site::layouts.app')
@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                @if ($product)
                    <div class="col-lg-6 mb-5 ftco-animate">
                        <a href="{{ route('product.detail', $product->slug) }}" class="image-popup">
                            <img src="{{ $product->photo }}" class="img-fluid" alt="Colorlib Template">
                        </a>
                    </div>
                    <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                        <h3>{{ $product->name }}</h3>
                        <div class="rating d-flex">
                            <p class="text-left mr-4">
                                <a href="#" class="mr-2">5.0</a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                            </p>
                            <p class="text-left mr-4">
                                <a href="#" class="mr-2" style="color: #000;">100 <span
                                        style="color: #bbb;">Rating</span></a>
                            </p>
                            <p class="text-left">
                                <a href="#" class="mr-2" style="color: #000;">500 <span
                                        style="color: #bbb;">Sold</span></a>
                            </p>
                        </div>
                        <p class="price"><span>{{ number_format($product->price, 2, '.', '') }}K</span></p>
                        <p>
                            {{ $product->description }}
                        </p>
                        <form action="{{ route('cart.add', $product->slug) }}" method="get">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group d-flex">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">Small</option>
                                                <option value="">Medium</option>
                                                <option value="">Large</option>
                                                <option value="">Extra Large</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="input-group col-md-6 d-flex mb-3">
                                    <span class="input-group-btn mr-2">
                                        <button type="button" class="quantity-left-minus btn" data-type="minus"
                                            data-field="">
                                            <i class="ion-ios-remove"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number"
                                        value="1" min="1" max="100">
                                    <span class="input-group-btn ml-2">
                                        <button type="button" class="quantity-right-plus btn" data-type="plus"
                                            data-field="">
                                            <i class="ion-ios-add"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <p style="color: #000;">{{ $product->mass }} kg available</p>
                                </div>
                            </div>
                            <p>
                                <a class="btn btn-black py-3 px-5">
                                    <button type="submit">
                                        Add to Cart
                                    </button>
                                </a>
                            </p>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Products</span>
                    <h2 class="mb-4">Related Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
        </div>
        <div class="container">
            @if ($product)
                <div class="row">
                    @foreach ($product->relatedProduct as $red)
                        @php
                            $reducedPrice = (100 - $red->discount) / 100;
                            $discount = $red->price * $reducedPrice;
                        @endphp
                        <div class="col-md-6 col-lg-3 ftco-animate">
                            <div class="product">
                                <a href="{{ route('product.detail', $red->slug) }}" class="img-prod"><img
                                        class="img-fluid" src="{{ $red->photo }}" alt="Colorlib Template">
                                    @if ($red->discount > 0)
                                        <span class="status">{{ $red->discount }}%</span>
                                    @endif
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="{{ route('product.detail', $red->slug) }}">{{ $red->name }}</a>
                                    </h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                <span
                                                    class="mr-2 price-dc">{{ number_format($red->price, 0, '.', '') }}K</span>
                                                @if ($red->discount > 0)
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
                                            <a href="{{ route('cart.add', $red->slug) }}"
                                                class="style-custom buy-now d-flex justify-content-center align-items-center mx-1">
                                                <span><i class="ion-ios-cart"></i></span>
                                            </a>
                                            <form action="{{ route('product.favorite.add', $red->id) }}" method="post">
                                                @csrf
                                                @if (Auth::user())
                                                    @if (App\Modules\Site\Helpers\Helper::checkFavorte($red->id) == 0)
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
            @endif
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endpush

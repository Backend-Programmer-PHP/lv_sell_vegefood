@extends('Site::layouts.app')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('public/site/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
                        <span>Cart</span>
                    </p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section ftco-cart">
        <div class="container">
            @include('Site::partials._notifications')
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            @if ($carts->isNotEmpty())
                                <tbody>
                                    <form action="{{ route('cart.update') }}" method="post">
                                        @csrf
                                        @foreach ($carts as $cart)
                                            <tr class="text-center">
                                                <td class="product-remove"><a
                                                        href="{{ route('cart.delete', $cart->carts_id) }}"><span
                                                            class="ion-ios-close"></span></a>
                                                </td>

                                                <td class="image-prod">
                                                    <div class="img"
                                                        style="background-image:url({{ $cart->photo }});">
                                                    </div>
                                                </td>

                                                <td class="product-name">
                                                    <h3>{{ $cart->name }}</h3>
                                                    <p>{{ substr($cart->description, 0, 50) }}</p>
                                                </td>

                                                <td class="price">
                                                    {{ number_format($cart->carts_price, 1, '.', '') }}K</td>

                                                <td class="quantity">
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="quantity[]"
                                                            class="quantity form-control input-number"
                                                            value="{{ $cart->carts_quantity }}" min="1" max="100">
                                                        <input type="hidden" name="cartId[]" value="{{$cart->carts_id}}">
                                                    </div>
                                                </td>

                                                <td class="total">{{ number_format($cart->amount, 1, '.', '') }}K
                                                </td>
                                                <input type="submit" value="submit" hidden>
                                            </tr><!-- END TR-->
                                        @endforeach
                                    </form>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Coupon Code</h3>
                        <p>Enter your coupon code if you have one</p>
                        <form action="#" class="info">
                            <div class="form-group">
                                <label for="">Coupon code</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                        </form>
                    </div>
                    <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
                </div>
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Estimate shipping and tax</h3>
                        <p>Enter your destination to get a shipping estimate</p>
                        <form action="#" class="info">
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">State/Province</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Zip/Postal Code</label>
                                <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                        </form>
                    </div>
                    <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
                </div>
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>$20.60</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>$0.00</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>$3.00</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>$17.60</span>
                        </p>
                    </div>
                    <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
        </div>
    </section>
    @include('Site::partials._subcribe')
@endsection
@push('styles')
    <style>
        button.btn-removie {
            width: 30px;
            font-size: 20px;
            height: 40px !important
        }

        .load-more.mt-2 {
            float: right;
        }

        button.close {
            margin-top: -12px;
            width: 30px;
            height: 30px;
            border: 1px solid;
            border-radius: 50px;
        }

    </style>
@endpush

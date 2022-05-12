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
                                                        <input type="hidden" name="cartId[]"
                                                            value="{{ $cart->carts_id }}">
                                                    </div>
                                                </td>

                                                <td class="total">
                                                    {{ number_format($cart->amount, 1, '.', '') }}K
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
                    <form action="{{ route('cart.coupon') }}" class="info" method="POST">
                        @csrf
                        <div class="cart-total mb-3">
                            <h3>Coupon Code</h3>
                            <p>Enter your coupon code if you have one</p>
                            <div class="form-group">
                                <label for="">Coupon code</label>
                                <input type="text" name="code" class="form-control text-left px-3"
                                    placeholder="Enter your coupon code">
                            </div>
                        </div>
                        <p><button type="submit" class="btn btn-primary py-3 px-4">Apply Coupon</button></p>
                    </form>
                </div>
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <form action="{{ route('cart.shipping') }}" class="info" method="POST">
                        @csrf
                        <div class="cart-total mb-3">
                            <h3>Estimate shipping and tax</h3>
                            <p>Enter your destination to get a shipping estimate</p>
                            <div class="form-group">
                                <label for="">Town/City</label>
                                <div class="select-wrap">
                                    <select name="region" id="filter" class="form-control customer" data-type="region">
                                        <option>__Please choose the city__</option>
                                        @if ($regions)
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}"> {{ $region->title }}</option>
                                            @endforeach
                                        @else
                                            <option>__Please choose the city__</option>
                                        @endif
                                    </select>
                                    @error('region')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="country">County/District</label>
                                <div class="select-wrap">
                                    <select name="district" id="district" class="form-control customer ">
                                        {{-- <option>__Please choose the district__</option> --}}
                                    </select>
                                    @error('district')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <p><button type="submit" class="btn btn-primary py-3 px-4">Estimate</button></p>
                    </form>
                </div>
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            @isset($carts)
                                <span>Subtotal</span>
                                <span> {{ number_format($carts->sum('amount'), 0, '.', '') }}K </span>
                            @endisset
                        </p>
                        @if (session()->has('region'))
                            <p class="d-flex">
                                <span>Delivery</span>
                                <span>{{ number_format(session('region')['shipping'], 0, '.', '') }}K</span>
                            </p>
                        @else
                            <p class="d-flex">
                                <span>Delivery</span>
                                <span>$0.00</span>
                            </p>
                        @endif
                        @if (session()->has('coupon') || session()->has('region'))
                            <p class="d-flex">
                                <span>Discount</span>
                                <span>{{ number_format(session('coupon')['value'], 0, '.', '') }}K</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>{{ number_format($carts->sum('amount') - session('coupon')['value'] + session('region')['shipping'], 0, '.', '') }}K</span>
                            </p>
                        @elseif (session()->has('coupon') && session()->has('region'))
                            <p class="d-flex">
                                <span>Discount</span>
                                <span>{{ number_format(session('coupon')['value'], 0, '.', '') }}K</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>{{ number_format($carts->sum('amount') - session('coupon')['value'] + session('region')['shipping'], 0, '.', '') }}K</span>
                            </p>
                        @else
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>{{ number_format($carts->sum('amount'), 0, '.', '') }}K</span>
                            </p>
                        @endif
                    </div>
                    <p><a href="{{ route('checkout') }}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
        </div>
    </section>
    @include('Site::partials._subcribe')
@endsection
@push('styles')
    <style>
        .customer {
            padding-left: 10px !important;
        }

        .customer {
            text-align: left !important;
        }

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
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- Ajax load tỉnh, quận huyện --}}
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#filter').change(function(event) {
                event.preventDefault();
                let route = "{{ route('city.ajax') }}";
                let $this = $(this);
                let type = $this.attr('data-type');
                let regionId = $this.val();
                $.ajax({
                        method: "GET",
                        url: route,
                        data: {
                            type: type,
                            region: regionId
                        }
                    })
                    .done(function(msg) {
                        if (msg.data) {
                            let html = '';
                            let element = '';
                            if (type == 'region') {
                                html = "<option>__Please choose the district__</option>";
                                element = '#district';
                            }
                            $.each(msg.data, function(index, value) {
                                html += "<option value='" + value.id + "'>" + value.title +
                                    "</option>"
                            });
                            $(element).html('').append(html);
                        }
                    })
            });
        });
    </script>
@endpush

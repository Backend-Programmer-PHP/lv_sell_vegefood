@extends('Site::layouts.app')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('public/site/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
                        <span>Checkout</span>
                    </p>
                    <h1 class="mb-0 bread">Checkout</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            @include('Site::partials._notifications')
            <form action="{{ route('checkout.billing') }}" class="billing-form" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-xl-7 ftco-animate">

                        <h3 class="mb-4 billing-heading">Billing Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Firt Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        placeholder="Your first name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Your last name">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Town / City</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="region_id" id="filter" class="form-control customer" data-type="region">
                                            <option>__Please choose the city__</option>
                                            @if ($regions)
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}"> {{ $region->title }}</option>
                                                @endforeach
                                            @else
                                                <option>__Please choose the city__</option>
                                            @endif
                                        </select>
                                        @error('region_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="towncity">County / District</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="city_id" id="district" class="form-control customer ">
                                            {{-- <option>__Please choose the district__</option> --}}
                                        </select>
                                        @error('city_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Street Address</label>
                                    <input type="text" class="form-control" name="address"
                                        placeholder="House number and street name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        placeholder="Appartment, suite, unit etc: (optional)">
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone"
                                        value="{{ empty(auth()->user()->phone) ? '' : auth()->user()->phone }}"
                                        class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input type="text" name="email"
                                        value="{{ empty(auth()->user()->email) ? '' : auth()->user()->email }}"
                                        class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <div class="radio">
                                        <label><input type="radio" name="" checked> Ship to different address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="row mt-5 pt-3">
                            <div class="col-md-12 d-flex mb-5">
                                <div class="cart-detail cart-total p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Cart Total</h3>
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
                            </div>
                            <div class="col-md-12">
                                <div class="cart-detail p-3 p-md-4">
                                    <h3 class="billing-heading mb-4">Payment Method</h3>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="" class="mr-2">
                                                    Direct Bank Tranfer
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="" class="mr-2">
                                                    Check Payment
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="" class="mr-2">
                                                    Paypal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="status" value="new" class="mr-2">
                                                    I have read and accept the terms and conditions
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Hidden input form --}}
                                    @php
                                        if (session()->has('region')) {
                                            $shippingFree = session('region')['shipping'];
                                        } else {
                                            $shippingFree = 0;
                                        }
                                    @endphp
                                    <input type="hidden" name="sub_total" value="{{ $carts->sum('amount') }}">
                                    <input type="hidden" name="shipping" value="{{ $shippingFree }}">
                                    @if (session()->has('coupon'))
                                        <input type="hidden" name="coupon" value="{{ session('coupon')['value'] }}">
                                        <input type="hidden" name="total"
                                            value="{{ $carts->sum('amount') - session('coupon')['value'] + $shippingFree }}">
                                    @else
                                        <input type="hidden" name="total" value="{{ $carts->sum('amount') + $shippingFree }}">
                                    @endif
                                    <input type="hidden" name="quantity" value="{{$carts->sum('carts_quantity')}}">
                                        <p><button type="submit" name="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .col-md-8 -->
                </div>
            </form><!-- END -->
        </div>
    </section> <!-- .section -->
    @include('Site::partials._subcribe')
@endsection
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

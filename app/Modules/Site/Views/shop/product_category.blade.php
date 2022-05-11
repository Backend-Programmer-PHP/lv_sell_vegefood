@extends('Site::layouts.app')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('public/site/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span>
                        <span>Products</span>
                    </p>
                    <h1 class="mb-0 bread">Categories</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section">
        <div class="container">
            @include('Site::shop.shop_ajax')
            @include('Site::partials._notifications')
            @if ($products)
                <div class="row">
                    @foreach ($products as $product)
                        @php
                            $reducedPrice = (100 - $product->discount) / 100;
                            $discount = $product->price * $reducedPrice;
                        @endphp
                        <div class="col-md-6 col-lg-3 ftco-animate">
                            <div class="product">
                                <a href="{{ route('product.detail', $product->slug) }}" class="img-prod"><img class="img-fluid" src="{{ $product->photo }}"
                                        alt="Colorlib Template">
                                    @if ($product->discount > 0)
                                        <span class="status">{{ $product->discount }}%</span>
                                    @endif
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="{{ route('product.detail', $product->slug) }}">{{ $product->name }}</a></h3>
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
                                            <a href="#"
                                                class="style-custom buy-now d-flex justify-content-center align-items-center mx-1">
                                                <span><i class="ion-ios-cart"></i></span>
                                            </a>
                                            <form action="{{ route('product.favorite.add', $product->id) }}"
                                                method="post">
                                                @csrf
                                                @if (Auth::user())
                                                    @if (App\Modules\Site\Helpers\Helper::checkFavorte($product->id) == 0)
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
                @php
                    $pagePrevious = $products->currentPage() - 1;
                    $pageNext = $products->currentPage() + 1;
                    $total_pages = ceil($products->total() / $products->perPage());
                @endphp
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                @if ($products->currentPage() > 1 && $products->lastPage() > 1)
                                    <li><a href="{{ url('/shop') }}?page={{ $pagePrevious }}">&lt;</a></li>
                                @endif
                                @for ($i = 1; $i <= $total_pages; $i++)
                                    @if ($i == $products->currentPage())
                                        <li class="active"><span>{{ $i }}</span></li>
                                    @else
                                        <li><a
                                                href="{{ url('/shop') }}?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                                @if ($products->currentPage() < $products->lastPage() && $products->lastPage() > 1)
                                    <li><a href="{{ url('/shop') }}?page={{ $pageNext }}">&gt;</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
        <div class="container py-4">
            <div class="row d-flex justify-content-center py-5">
                <div class="col-md-6">
                    <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
                    <span>Get e-mail updates about our latest shops and special offers</span>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <form action="#" class="subscribe-form">
                        <div class="form-group d-flex">
                            <input type="text" class="form-control" placeholder="Enter email address">
                            <input type="submit" value="Subscribe" class="submit px-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

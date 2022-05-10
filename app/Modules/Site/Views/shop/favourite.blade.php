@extends('Site::layouts.app')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('public/site/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
                        <span>Wishlist</span>
                    </p>
                    <h1 class="mb-0 bread">My Wishlist</h1>
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
                                    <th>Product List</th>
                                    <th>&nbsp;</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            @if ($favorites)
                                <tbody id="posts">
                                    @foreach ($favorites as $favorite)
                                        <tr class="text-center">
                                            <td class="product-remove">
                                                <form action="{{ route('product.favorite.add', $favorite->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @if (App\Modules\Site\Helpers\Helper::checkFavorte($favorite->id) == 0)
                                                        <button type="submit" class="btn-removie">
                                                            <span class="ion-ios-heart"></span>
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn-removie">
                                                            <span class="ion-ios-close"></span>
                                                        </button>
                                                    @endif
                                                </form>

                                            </td>
                                            <td class="image-prod">
                                                <div class="img"
                                                    style="background-image:url({{ $favorite->photo }});">
                                                </div>
                                            </td>

                                            <td class="product-name">
                                                <h3>{{ $favorite->name }}</h3>
                                                <p>{{ substr($favorite->description, 0, 50) }}</p>
                                            </td>

                                            <td class="price">{{ number_format($favorite->price, 0, '.', '') }}K
                                            </td>

                                            <td class="quantity">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="quantity"
                                                        class="quantity form-control input-number" value="1" min="1"
                                                        max="100">
                                                </div>
                                            </td>

                                            <td class="total">{{ number_format($favorite->price, 0, '.', '') }}K
                                            </td>
                                        </tr><!-- END TR-->
                                    @endforeach

                                </tbody>
                            @endif
                            @if ($favorites == null)
                                <tbody>
                                    <h2 class="text-center">The list of favorites is empty!</h2>
                                </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="load-more mt-2">
                        <div class="content btn btn-primary py-2 px-4" data-page="2"
                            data-link="{{ route('product.favorite') }}?page=" data-div="#posts">
                            Load more
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@push('scripts')
    <script>
        $(".content").click(function() {
            $div = $($(this).data('div')); //div to append
            $link = $(this).data('link'); //current URL

            $page = $(this).data('page'); //get the next page #
            $href = $link + $page; //complete URL
            $.get($href, function(response) { //append data
                $html = $(response).find("#posts").html();
                $div.append($html);
            });

            $(this).data('page', (parseInt($page) + 1)); //update page #
        });
    </script>
@endpush

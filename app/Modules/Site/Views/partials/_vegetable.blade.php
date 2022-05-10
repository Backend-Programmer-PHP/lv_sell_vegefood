<section class="ftco-section ftco-category ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 order-md-last align-items-stretch d-flex">
                        <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex"
                            style="background-image: url({{ asset('public/site/images/category.jpg') }});">
                            <div class="text text-center">
                                <h2>Vegetables</h2>
                                <p>Protect the health of every home</p>
                                <p><a href="#" class="btn btn-primary">Shop now</a></p>
                            </div>
                        </div>
                    </div>
                    @if ($categoryDesc)
                        <div class="col-md-6">
                            @foreach ($categoryDesc as $category)
                                <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end"
                                    style="background-image: url({{ $category->photo }});">
                                    <div class="text px-3 py-1">
                                        <h2 class="mb-0"><a href="{{ route('product.category', $category->slug) }}">{{ $category->name }}</a></h2>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
            @if ($categoryAsc)
            <div class="col-md-4">
                @foreach ($categoryAsc as $category)
                <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end"
                    style="background-image: url({{ $category->photo }});">
                    <div class="text px-3 py-1">
                        <h2 class="mb-0"><a href="{{ route('product.category', $category->slug) }}">{{ $category->name }}</a></h2>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

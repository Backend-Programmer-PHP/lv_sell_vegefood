<div class="row justify-content-center">
    <div class="col-md-10 mb-5 text-center">
        @if ($categories)
            <ul class="product-category">
                @if (Session::get('all') == 'active')
                    <li>
                        <a href="{{ route('shop') }}" class="active">All</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('shop') }}">All</a>
                    </li>
                @endif

                @foreach ($categories as $category)
                    @if (($category->slug == 'fruits' && Session::get('fruits') == 'active') || ($category->slug == 'juices' && Session::get('juices') == 'active') || ($category->slug == 'vegetables' && Session::get('vegetables') == 'active') || ($category->slug == 'dried' && Session::get('dried') == 'active') || ($category->slug == 'drinks' && Session::get('drinks') == 'active'))
                        <li>
                            <a class="active" href="{{ route('product.category', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('product.category', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </div>
</div>


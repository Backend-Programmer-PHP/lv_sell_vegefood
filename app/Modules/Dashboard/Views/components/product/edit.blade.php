@extends('Dashboard::layouts.app')
@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('product.create') }}">New Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Add Product</h1>
                <p class="mb-0">Dozens of reusable components built to provide buttons, alerts, popovers, and
                    more.</p>
            </div>
            <div>
                <a href="https://themesberg.com/docs/volt-bootstrap-5-dashboard/components/forms/"
                    class="btn btn-outline-gray"><i class="far fa-question-circle me-1"></i> Forms Docs</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <!-- Form -->
                @if($product)
                <form action="{{ route('product.update', $product->slug) }}" method="post" class="navbar-search form-inline" id="navbar-search-main" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label for="usernameValidate">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        id="usernameValidate" value="{{ $product->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label for="usernameValidate">Price</label>
                                    <input type="number" name="price"
                                        class="form-control @error('price') is-invalid @enderror" id="usernameValidate"
                                        value="{{ $product->price }}">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label for="usernameValidate">Discount</label>
                                    <input type="number" name="discount"
                                        class="form-control @error('discount') is-invalid @enderror" id="usernameValidate"
                                        value="{{ $product->discount }}">
                                    @error('discount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label for="usernameValidate">Quantity</label>
                                    <input type="number" name="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror" id="usernameValidate"
                                        value="{{ $product->quantity }}">
                                    @error('quantity')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label for="usernameValidate">Mass</label>
                                    <input type="number" name="mass"
                                        class="form-control @error('mass') is-invalid @enderror" id="usernameValidate"
                                        value="{{ $product->mass }}">
                                    @error('mass')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label class="my-1 me-2" for="country">Protype</label>
                                    <select class="form-select" name="protype" id="country"
                                        aria-label="Default select example">
                                        @if($product->protype == 'small')
                                        <option value="small" selected>SMALL</option>
                                        <option value="edium">EDIUM</option>
                                        <option value="large">LARGE</option>
                                        <option value="extra_large">EXTRA LARGE</option>
                                        @elseif ($product->protype == 'edium')
                                        <option value="small">SMALL</option>
                                        <option value="edium" selected>EDIUM</option>
                                        <option value="large">LARGE</option>
                                        <option value="extra_large">EXTRA LARGE</option>
                                        @elseif ($product->protype == 'large')
                                        <option value="small">SMALL</option>
                                        <option value="edium">EDIUM</option>
                                        <option value="large" selected>LARGE</option>
                                        <option value="extra_large">EXTRA LARGE</option>
                                        @elseif ($product->protype == 'extra_large')
                                        <option value="small">SMALL</option>
                                        <option value="edium">EDIUM</option>
                                        <option value="large">LARGE</option>
                                        <option value="extra_large" selected>EXTRA LARGE</option>
                                        @endif
                                    </select>
                                    @error('protype')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label for="textarea">Description</label>
                                    <textarea class="form-control" name="description"  placeholder="Enter your message..." id="textarea" rows="4">{{ $product->description }}</textarea>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label class="my-1 me-2" for="country">Category</label>
                                    <select class="form-select" name="category" id="country"
                                        aria-label="Default select example">
                                        <option selected>Choose a category</option>
                                        @if ($categories)
                                            @foreach ($categories as $category)
                                                @if($product->categories_id == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="extra_large">No categories</option>
                                        @endif
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Choose image</label>
                                    <input class="form-control" type="file" value="{{ $product->photo }}"  name="photo" id="formFile">
                                </div>
                                @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="mb-3">
                                    @if($product->photo)
                                    <img src="{{ $product->photo }}" width="50" height="50" alt="{{ $product->name }}" multiple="multiple">
                                    @else
                                    <img src="https://yotrip.vn/public/backend/assets/images/pattern.png" width="50" height="50" alt="{{ $product->name }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary d-inline-flex align-items-center">
                            Update
                        </button>
                    </div>
                </form>
                @endif
                <!-- End of Form -->
            </div>
        </div>
    </div>
@endsection

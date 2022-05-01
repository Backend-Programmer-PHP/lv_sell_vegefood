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
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">New Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Add Category</h1>
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
                <form action="{{route('category.store')}}" method="POST" class="navbar-search form-inline" id="navbar-search-main">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-4">

                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <label for="usernameValidate">Category Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="usernameValidate" placeholder="Enter category">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
                            Add
                        </button>
                    </div>
                </form>
                <!-- End of Form -->
            </div>
        </div>
    </div>
@endsection

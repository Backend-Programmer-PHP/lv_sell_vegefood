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
                <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">New Banner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Banners</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Update Banner</h1>
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
                @if ($banner)
                    <form action="{{ route('banner.update', $banner->slug) }}" method="POST" class="navbar-search form-inline" id="navbar-search-main"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-4">
                                        <label for="usernameValidate">Title</label>
                                        <input type="text" name="title" value="{{ $banner->title }}"
                                            class="form-control @error('title') is-invalid @enderror" id="usernameValidate"
                                            placeholder="Enter category">
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="mb-4">
                                        <label for="textarea">Description</label>
                                        <textarea class="form-control" name="description" placeholder="Enter your message..." id="textarea"
                                            rows="4">{{ $banner->description }}</textarea>
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
                                        <input class="form-control" type="file" value="{{ $banner->photo }}"
                                            name="photo" id="formFile">
                                    </div>
                                    @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="mb-3">
                                        @if ($banner->photo)
                                            <img src="{{ $banner->photo }}" width="50" height="50"
                                                alt="{{ $banner->title }}" multiple="multiple" class="img-fuild">
                                        @else
                                            <img src="https://yotrip.vn/public/backend/assets/images/pattern.png" width="50"
                                                height="50" alt="{{ $banner->title }}" class="img-fuild">
                                        @endif
                                    </div>
                                    <div class="form-check form-switch">
                                        @if ($banner->status == 'on')
                                            <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked"
                                                value="on" checked>
                                        @else
                                            <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked"
                                                value="off">
                                        @endif

                                        <label class="form-check-label" for="flexSwitchCheckChecked">On/Off</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-inline-flex align-items-center">
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
@push('styles')
    <style>
        .img-fuild {
            border: 1px solid gray;
            border-radius: 10px;
        }

    </style>
@endpush

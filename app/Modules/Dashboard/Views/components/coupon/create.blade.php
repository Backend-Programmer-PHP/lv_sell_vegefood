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
                <li class="breadcrumb-item"><a href="{{ route('coupon.create') }}">New Coupon</a></li>
                <li class="breadcrumb-item active" aria-current="page">Coupon</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Add Coupon</h1>
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
                <form action="{{ route('coupon.store') }}" method="POST" class="navbar-search form-inline"
                    id="navbar-search-main">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="usernameValidate" class="col-form-label">Code <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                        id="usernameValidate" placeholder="Enter Coupon Code" value="{{ old('code') }}">
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="usernameValidate" class="col-form-label">Start date <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        <input data-datepicker="" name="createdAt" class="form-control" id="birthday"
                                            type="text" placeholder="dd/mm/yyyy" value="{{ date('m/d/Y') }}">
                                    </div>
                                    @error('createdAt')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-4">
                                    <div class="form-group">
                                        <label for="type" class="col-form-label">Type <span
                                                class="text-danger">*</span></label>
                                        <select name="type" class="form-control">
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="usernameValidate" class="col-form-label">End date <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <svg class="icon icon-xs text-gray-600" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                            <input data-datepicker="" name="updatedAt" class="form-control" id="birthday"
                                                type="text" placeholder="dd/mm/yyyy" value="{{ date('m/d/Y', strtotime('+1 day', strtotime(date('m/d/Y')))) }}">
                                        </div>
                                        @error('updatedAt')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="inputTitle" class="col-form-label">Value <span
                                            class="text-danger">*</span></label>
                                    <input id="inputTitle" type="number" name="value" placeholder="Enter Coupon value"
                                        value="{{ old('value') }}" class="form-control">
                                    @error('value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
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

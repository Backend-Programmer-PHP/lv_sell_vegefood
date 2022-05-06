@extends('Site::layouts.app')
@section('content')
    <div class="container">
        @if ($user)
            @php
                $photo = empty($user->photo) ? 'http://vegefoods.local/public/site/images/person_1.jpg' : $user->photo;
                $cover = empty($user->cover_photo) ? 'http://vegefoods.local/public/dashboard/assets/img/profile-cover.jpg' : $user->cover_photo;
            @endphp
            @include('Site::partials._notifications')
            <div class="row">
                <div class="col-12 col-xl-8">
                    {{-- Information --}}
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">General information</h2>
                        <form action="{{ route('update.personal', $user->slug) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="first_name">First Name</label>
                                        <input class="form-control" id="first_name" name="first_name" type="text"
                                            placeholder="Enter your first name" value="{{ $user->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control" id="last_name" name="last_name" type="text"
                                            placeholder="Also your last name"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3">
                                    <label for="birthday">Birthday</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        <input data-datepicker="" class="form-control" id="birthday" name="birthday" type="text"
                                            value="{{  date("m/d/Y", strtotime($user->birthday))  }}"  required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender">Gender</label>
                                    <select class="form-select mb-0" id="gender" name="gender" aria-label="Gender select example">
                                        @if($user->gender == 'male')
                                        <option value="{{$user->gender}}" selected>Male</option>
                                        <option value="female">Female</option>
                                        @elseif($user->gender == 'female')
                                        <option value="{{$user->gender}}" selected>Female</option>
                                        <option value="male">Male</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" id="email" type="email" value="{{ $user->email }}" placeholder="name@company.com"
                                         readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" name="phone" value="<?= empty($user->phone) ? '0123456789' : $user->phone;  ?>" type="number" placeholder="+84-345 678 910"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Save all</button>
                        </form>

                    </div>
                    {{-- Location --}}
                    <div class="card card-body border-0 shadow mb-4">
                        <form action="">
                            <h2 class="h5 my-4">Location</h2>
                            <div class="row">
                                <div class="col-sm-9 mb-3">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input class="form-control" id="address" type="text"
                                            placeholder="Enter your home address" required>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <div class="form-group">
                                        <label for="number">Number</label>
                                        <input class="form-control" id="number" type="number" placeholder="No." required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input class="form-control" id="city" type="text" placeholder="City" required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="zip">ZIP</label>
                                        <input class="form-control" id="zip" type="tel" placeholder="ZIP" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Save all</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card shadow border-0 text-center p-0">
                                <div class="profile-cover rounded-top"
                                    data-background="{{ $cover }}"></div>
                                <div class="card-body pb-5">
                                    <img src="{{ $photo }}" class="avatar-xl rounded-circle mx-auto mt-n7 mb-4"
                                        alt="Neil Portrait">
                                    <h4 class="h3">{{ $user->name }}</h4>
                                    <h5 class="fw-normal">Senior Software Engineer</h5>
                                    <p class="text-gray mb-4">New York, USA</p>
                                    <a class="btn btn-sm btn-gray-800 d-inline-flex align-items-center me-2" href="#">
                                        <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                            </path>
                                        </svg>
                                        Connect
                                    </a>
                                    <a class="btn btn-sm btn-secondary" href="#">Send Message</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('update.photo', $user->slug) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-body border-0 shadow mb-4">
                                    <h2 class="h5 mb-4">Select profile photo</h2>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <!-- Avatar -->
                                            <img class="rounded avatar-xl"
                                                src="{{ $photo }}"
                                                alt="change avatar">
                                        </div>
                                        <div class="file-field">
                                            <div class="d-flex justify-content-xl-center ms-xl-3">
                                                <div class="d-flex">
                                                    <svg class="icon text-gray-500 me-2" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <input type="file" name="photo">
                                                    <div class="d-md-block text-left">
                                                        <div class="fw-normal text-dark mb-1">Choose Image</div>
                                                        <div class="text-gray small">JPG, GIF or PNG. Max size of 800K</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit" name="submit">Save all</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('update.cover', $user->slug) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-body border-0 shadow">
                                    <h2 class="h5 mb-4">Select cover photo</h2>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <!-- Avatar -->
                                            <img class="rounded avatar-xl"
                                                src="{{ $cover }}"
                                                alt="change cover">
                                        </div>
                                        <div class="file-field">
                                            <div class="d-flex justify-content-xl-center ms-xl-3">
                                                <div class="d-flex">
                                                    <svg class="icon text-gray-500 me-2" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <input type="file" name="photo">
                                                    <div class="d-md-block text-left">
                                                        <div class="fw-normal text-dark mb-1">Choose Image</div>
                                                        <div class="text-gray small">JPG, GIF or PNG. Max size of 800K</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit" name="submit">Save all</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        @endif
    </div>
@endsection
@push('styles')
    <style>
        .ftco-navbar-light .navbar-brand {
            color: #82ae46 !important;
        }

        .bg-primary {
            background: #82ae46 !important;
        }

    </style>
    <!-- Notyf -->
    <link type="text/css" href="{{ asset('public/dashboard/vendor/notyf/notyf.min.css') }}" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('public/dashboard/css/volt.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <!-- Vendor JS -->
    <script src="{{ asset('public/dashboard/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ asset('public/dashboard/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('public/dashboard/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <!-- Vanilla JS Datepicker -->
    <script src="{{ asset('public/dashboard/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

    <!-- Simplebar -->
    <script src="{{ asset('public/dashboard/vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Volt JS -->
    <script src="{{ asset('public/dashboard/assets/js/volt.js') }}"></script>
@endpush

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Dashboard::partials._head')

<body>
    <div id="app">
        @include('Dashboard::partials._header')
        {{-- Nav --}}
        @include('Dashboard::partials._nav')
    @show
    <main class="content">
        @include('Dashboard::partials._silder')
        @yield('content')
        @include('Dashboard::partials._footer')
    </main>
</div>

{{-- Footer --}}
<!-- Core -->
<script src="{{ asset('public/dashboard/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('public/dashboard/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Vendor JS -->
<script src="{{ asset('public/dashboard/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

<!-- Slider -->
<script src="{{ asset('public/dashboard/vendor/nouislider/distribute/nouislider.min.js') }}"></script>

<!-- Smooth scroll -->
<script src="{{ asset('public/dashboard/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

<!-- Charts -->
<script src="{{ asset('public/dashboard/vendor/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('public/dashboard/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}">
</script>

<!-- Datepicker -->
<script src="{{ asset('public/dashboard/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

<!-- Sweet Alerts 2 -->
<script src="{{ asset('public/dashboard/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="{{ asset('public/dashboard/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

<!-- Notyf -->
<script src="{{ asset('public/dashboard/vendor/notyf/notyf.min.js') }}"></script>

<!-- Simplebar -->
<script src="{{ asset('public/dashboard/vendor/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="{{ asset('public/dashboard/assets/js/volt.js') }}"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


@stack('scripts')
</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('Site::partials._head');

<body>
    <div id="app">
        {{-- Nav --}}
        @include('Site::partials._nav');
        @show
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- Footer --}}
    @include('Site::partials._footer');
</body>

</html>

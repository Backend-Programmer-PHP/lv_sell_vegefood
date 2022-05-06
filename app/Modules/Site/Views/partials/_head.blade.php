<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vegefoods</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('public/site/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/site/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('public/site/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/site/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/site/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('public/site/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('public/site/css/ionicons.min.css')}}">

    {{-- <link rel="stylesheet" href="{{asset('public/site/css/bootstrap-datepicker.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('public/site/css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('public/site/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('public/site/css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('public/site/css/style.css')}}">
    @stack('styles')
</head>

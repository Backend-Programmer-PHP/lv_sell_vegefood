@extends('Site::layouts.app')
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('public/site/images/bg_1.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span>
                        <span>Blog</span>
                    </p>
                    <h1 class="mb-0 bread">Blog</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <div class="row">
                        <div class="col-md-12 d-flex ftco-animate">
                            <div class="blog-entry align-self-stretch d-md-flex">
                                <a href="blog-single.html" class="block-20"
                                    style="background-image: url('{{ asset('public/site/images/image_1.jpg') }}');">
                                </a>
                                <div class="text d-block pl-md-4">
                                    <div class="meta mb-3">
                                        <div><a href="#">July 20, 2019</a></div>
                                        <div><a href="#">Admin</a></div>
                                        <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
                                        </div>
                                    </div>
                                    <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control
                                            about the blind texts</a></h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                        Consonantia, there live the blind texts.</p>
                                    <p><a href="blog-single.html" class="btn btn-primary py-2 px-3">Read more</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- .col-md-8 -->
                {{-- Left tab--}}
                @include('Site::blog.blog_tab_left')

            </div>
        </div>
    </section> <!-- .section -->
@endsection

@extends('layouts.site')
@section('title')
    <title>{{ env('APP_TITLE') . ' | ' . $page_title }}</title>
    <meta name="description" content="ERHAN GÜZEL">

    <link rel="canonical" href="{{ route('site.gallery.index') }}">

    <!-- Open Graph Etiketleri (Sosyal Medya İçin) -->
    <meta property="og:title" content="ERHAN GÜZEL">
    <meta property="og:description" content="ERHAN GÜZEL">
    <meta property="og:image" content="{{ asset('site/erhanguzellogo.png') }}">
    <meta property="og:url" content="{{ route('site.gallery.index') }}">

    <!-- Twitter Card Etiketleri (Sosyal Medya İçin) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@example">
    <!-- Hreflang Etiketleri (Çoklu Dil İçin) -->
@endsection
@section('content')
    <!-- Page title -->
    <section id="page-title" data-bg-parallax="{{ asset('site/images/parallax/14.jpg') }}">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="page-title">
                <h1 class="text-uppercase text-medium">Galeri</h1>
                <span>Çatalça'dan vatandaşlarımızla anılarımız ve hatıralarımız</span>
            </div>
        </div>
    </section>
    <!--end: Inspiro Slider --><!-- Content -->
    <section id="page-content">
        <div class="container-fluid">
            <div id="blog" class="grid-layout post-4-columns m-b-30" data-item="post-item">
                @foreach ($galleries_pagintaion as $gallery)
                    <!-- Post item-->
                    <div class="post-item " style="border-radius: 20px;">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a data-lightbox="image" href="{{ asset($gallery->img) }}">
                                    <img alt="" style="border-radius: 20px;" src="{{ asset($gallery->img) }}">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- end: Post item-->
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            {{ $galleries_pagintaion->links('vendor.pagination.bootstrap-4') }}

        </div>
    </section>
    <!-- end: Content -->
    @include('site.component.form')
@endsection

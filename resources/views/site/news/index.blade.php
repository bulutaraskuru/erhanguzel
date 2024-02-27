@extends('layouts.site')
@section('title')
    <title>{{ env('APP_TITLE') . ' | ' . $page_title }}</title>
    <meta name="description" content="ERHAN GÜZEL">

    <link rel="canonical" href="{{ route('site.news.index') }}">

    <!-- Open Graph Etiketleri (Sosyal Medya İçin) -->
    <meta property="og:title" content="ERHAN GÜZEL">
    <meta property="og:description" content="ERHAN GÜZEL">
    <meta property="og:image" content="{{ asset('site/erhanguzellogo.png') }}">
    <meta property="og:url" content="{{ route('site.news.index') }}">

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
                <h1 class="text-uppercase text-medium">Haberler</h1>
                @if (isset($text))
                    <h3 style="color:white;">Arama : {{ $text }}</h3>
                @endif
            </div>
        </div>
    </section>
    <!--end: Inspiro Slider --><!-- Content -->
    <section id="page-content">
        <div class="container-fluid">
            @if (count($news) == 0)
                <div class="alert alert-danger text-center">
                    <h3> Aradığınız sonuç ilgili bir sonuç yoktur.</h1>
                </div>
            @endif
            <div id="blog" class="grid-layout row post-4-columns m-b-30" data-item="post-item">
                @foreach ($news as $item)
                    <!-- Post item-->
                    <div class="post-item border">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="{{ route('site.news.detail', ['slug' => $item->slug]) }}">
                                    <img alt="" style="border-radius: 20px;" src="{{ asset($item->img) }}">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <span class="post-meta-date"><i
                                        class="fa fa-calendar-o"></i>{{ date('d.m.Y', strtotime($item->created_at)) }}</span>
                                <h2><a
                                        href="{{ route('site.news.detail', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                </h2>
                                <p>{!! Str::substr(strip_tags($item->description), 0, 150)  !!}</p>
                                <a href="{{ route('site.news.detail', ['slug' => $item->slug]) }}"
                                    class="item-link">Devamını Oku ... <i class="icon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- end: Post item-->
                @endforeach
            </div>
        </div>
        @if (count($news) < 0)
            <div class="d-flex justify-content-center align-items-center">
                {{ $news->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </section>
    <!-- end: Content -->

    @include('site.component.form')
@endsection

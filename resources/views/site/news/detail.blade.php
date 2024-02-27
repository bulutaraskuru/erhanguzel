@extends('layouts.site')
@section('title')
    <title>{{ env('APP_TITLE') . ' | ' . $data->title }}</title>
    <meta name="description" content="{{ $data->seo_description }}">
    @php
        $keys = json_decode($data->seo_keywords, true);
    @endphp
    <meta name="keywords" content="@foreach ($keys as $item) {{ $item['value'] }}, @endforeach">
    <link rel="canonical" href="{{ route('site.news.detail', ['slug' => $data->slug]) }}">

    <!-- Open Graph Etiketleri (Sosyal Medya İçin) -->
    <meta property="og:title" content="{{ $data->seo_title }}">
    <meta property="og:description" content="{{ $data->seo_description }}">
    <meta property="og:image" content="{{ $data->img }}">
    <meta property="og:url" content="{{ route('site.news.detail', ['slug' => $data->slug]) }}">

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
                <h1 class="text-uppercase text-medium">{{ $data->title }}</h1>
                <span>{{ $data->seo_title }}</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->
    <!-- Page Content -->
    <section id="page-content" class="sidebar-right">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <!-- content -->
                <div class="content  col-lg-9">
                    <!-- Blog -->
                    <div id="blog" class="single-post ">
                        <!-- Post single item-->
                        <div class="post-item">
                            <div class="post-item-wrap">
                                <div class="carousel dots-inside arrows-visible" data-items="1" data-lightbox="gallery">
                                    <a href="{{ asset($data->img) }}" data-lightbox="gallery-image">
                                        <img alt="image" src="{{ asset($data->img) }}">
                                    </a>
                                    @foreach (\App\Models\NewsImage::where('new_id', $data->id)->get() as $item)
                                        <a href="{{ asset($item->img) }}" data-lightbox="gallery-image">
                                            <img alt="image" src="{{ asset($item->img) }}">
                                        </a>
                                    @endforeach
                                </div>
                                <div class="post-item-description">
                                    <h2>{{ $data->title }}</h2>
                                    <div class="post-meta">
                                        <span class="post-meta-date"><i
                                                class="fa fa-calendar-o"></i>{{ date('d.m.Y H:i:s', strtotime($data->created_at)) }}</span>
                                        <span class="post-meta-category"><a href=""><i class="fa fa-tag"></i>Haber,
                                                Duyuru</a></span>
                                    </div>
                                    <p>{!! $data->description !!}</p>
                                </div>

                            </div>
                        </div>
                        <!-- end: Post single item-->
                    </div>
                </div>
                <!-- end: content -->
            </div>
        </div>
    </section>
    <!-- end: Page Content -->

    @include('site.component.form')
@endsection
@section('script')
@endsection

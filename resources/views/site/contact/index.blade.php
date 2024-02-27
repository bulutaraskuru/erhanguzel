@extends('layouts.site')
@section('title')
    <title>{{ env('APP_TITLE') . ' | ' . $page_title }}</title>
    <meta name="description" content="ERHAN GÜZEL">

    <link rel="canonical" href="{{ route('site.contact.index') }}">

    <!-- Open Graph Etiketleri (Sosyal Medya İçin) -->
    <meta property="og:title" content="ERHAN GÜZEL">
    <meta property="og:description" content="ERHAN GÜZEL">
    <meta property="og:image" content="{{ asset('site/erhanguzellogo.png') }}">
    <meta property="og:url" content="{{ route('site.contact.index') }}">

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
                <h1 class="text-uppercase text-medium">İletişim</h1>
                <h3 class="text-white">Çatalca için gönüllü ol ya istek, dilek ve şikayet için bize ulaşın.</h3>
                <hr>

                <ul class="top-menu text-white" style="list-style-type: none;">
                    <li><a href="tel:+90 532 227 45 70" style="font-size:22px;">Telefon: <b>+90 532 227 45 70</b> </a></li>
                    <li><a href="mailto:info@erhanguzel.com.tr" style="font-size:22px;">Email:
                            <b>info@erhanguzel.com.tr</b></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--end: Inspiro Slider --><!-- Content -->
    @include('site.component.form')
@endsection

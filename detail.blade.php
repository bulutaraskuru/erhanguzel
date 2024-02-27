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

    <section id="form">
        <div class="container-fluid w-100 blockquote blockquote-color">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-lg-6">
                    <h3 class="text-uppercase text-center text-white">Çatalca Gönüllüsü Ol</h3>
                    <div class="m-t-30">
                        <div id="msgSubmit" class="h3 hidden"></div>
                        <div id="alertDiv" class="alert" role="alert" style="display: none;"></div>

                        <form id="form1" method="POST" action="{{ route('site.contact.voluntarily') }}"
                            class="form-validate" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="text-white">Ad ve Soyad</label>
                                    <input type="text" aria-required="true" name="name" id="name"
                                        class="form-control name" placeholder="Ad ve Soyad yazınız">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tcno" class="text-white">T.C. Kimlik No</label>
                                    <input type="text" aria-required="true" name="tcno" maxlength="11" minlength="11"
                                        id="tcno" class="form-control tcno" placeholder="T.C. Kimlik No yazını">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone" class="text-white">Telefon No</label>
                                    <input type="tel" aria-required="true" name="phone" id="phone"
                                        class="form-control phone" placeholder="Telefon No yazını">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="text-white">E-mail</label>
                                    <input type="email" aria-required="true" name="email" id="email"
                                        class="form-control email" placeholder="Email yazınız">


                                </div>
                                <div class="form-group col-md-6">
                                    <label for="neighbourhood" class="text-white">Mahalle</label>
                                    <select class="form-select" id="neighbourhood" name="neighbourhood">
                                        <option disabled selected>Seçiniz</option>
                                        @foreach (\App\Helpers\bHelper::neighbourhood() as $key => $item)
                                            <option @selected(old('neighbourhood') == $item) value="{{ $item }}">
                                                {{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="year" class="text-white">Doğum Yılı</label>
                                    <select class="form-select" id="year" name="year">
                                        <option disabled selected>Seçiniz</option>
                                        @for ($i = 1940; $i <= 2023; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>

                                </div>
                            </div>
                            <div class="d-flex justify-content-center align-content-center">
                                <button class="btn btn-light btn-rounded mt-5" style="width: 225px;" type="submit"><i
                                        class="fa fa-paper-plane"></i>Gönüllü Ol</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection

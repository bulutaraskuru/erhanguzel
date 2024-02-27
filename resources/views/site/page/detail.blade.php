@extends('layouts.site')
@section('title')
    <title>{{ env('APP_TITLE') . ' | ' . $data->title }}</title>
    <meta name="description" content="{{ $data->seo_description }}">
    @php
        $keys = json_decode($data->seo_keywords, true);
    @endphp
    <meta name="keywords" content="@foreach ($keys as $item) {{ $item['value'] }}, @endforeach">
    <link rel="canonical" href="{{ route('site.page.detail', ['slug' => $data->slug]) }}">

    <!-- Open Graph Etiketleri (Sosyal Medya İçin) -->
    <meta property="og:title" content="{{ $data->seo_title }}">
    <meta property="og:description" content="{{ $data->seo_description }}">
    <meta property="og:image" content="{{ $data->img }}">
    <meta property="og:url" content="{{ route('site.page.detail', ['slug' => $data->slug]) }}">

    <!-- Twitter Card Etiketleri (Sosyal Medya İçin) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@example">
    <!-- Hreflang Etiketleri (Çoklu Dil İçin) -->

    <style>
        @media only screen and (max-width: 767px) {
            .heading-text {
                margin-top: 0 !important;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Page title -->
    <section id="page-title" data-bg-parallax="{{ asset('site/images/parallax/14.jpg') }}">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="page-title">
                <h1 class="text-uppercase text-medium">{{ $data->title }}</h1>
            </div>
        </div>
    </section>
    <!-- end: Page title -->
    <section class="p-b-10">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4 column">
                    <div class="heading-text heading-section text-center text">
                    <p>1979 yılında İstanbul Çatalca’da mübadil bir ailenin ikinci çocuğu olarak dünyaya gelen Erhan Güzel, ilk, orta ve lise yıllarını sırasıyla Ferhatpaşa İlkokulu ve Çatalca Lisesinde tamamladı. Trakya Üniversitesi, Çorlu Mühendislik Fakültesi İnşaat Mühendisliği Bölümünden mezun olduktan sonra mesleki yaşama atıldı. 2005 yılında kurucusu olduğu mühendislik ofisinde proje alanında faaliyet gösteren Güzel, bu süreçte bölgede çok sayıda projeye ve önemli işlere imza attı. </p>
                    </div>
                    <div class="heading-text heading-section text-center text" style="margin-top: 210px;">
                        <p>2009 yılında Cem Kara’nın Belediye Başkanlığı görevine gelişiyle birlikte kurumda Fen İşleri Müdürlüğü ve sonrasında Başkan Yardımcılığı görevini üstlendi. Bu süre içerisinde önemli ve adından söz ettiren projelerde yer alan Erhan Güzel, 2014 Mahalli ve Yerel Seçimlerde Çatalca Belediyesi CHP Meclis Üyeliğine seçildi. Seçim sonrasında Meclis Üyesi olarak, İmar ve Şehircilik Müdürlüğü, Plan ve Proje Müdürlüğü ve Fen İşleri Müdürlüğü’nden sorumlu (Teknik) Başkan Yardımcılığı görevine atandı. Mecliste İmar Komisyon Başkanlığı, Tarım, Orman ve Hayvancılık Komisyon Başkanlığı, Meclis 2.Başkan Vekilliği gibi görevlerde de bulundu.</p>
                    </div>
                </div>

                <div class="col-md-4 column ">
                    <img style="border-radius: 20px; width: 100%;" src="{{ asset('site/erhanfull2.png') }}" alt="">
                </div>
                <div class="col-md-4 column">
                    <div class="heading-text heading-section text-center text" style="margin-top: 200px;">
                        <p>Mesleki ve toplumsal kurumlarda çok sayıda sivil toplum örgütlerinde kuruculuk, yönetim kurulu üyeliği, kongre üyesi ve temsilci olarak görevler almıştır. 2005 yılından bu yana birçok mesleki projede Çatalca’ya ve bölgeye önemli katkılar sağlayan Güzel, sivil toplum çalışmaları ve kentin gelişimine katkı sağlayan değerli çalışmaların içinde sıklıkla yer aldı.</p>
                    </div>   <div class="heading-text heading-section text-center text" style="margin-top: 410px;">
                        <p>Çatalca Belediyesi’nin teknik müdürlüklerinden sorumlu Başkan Yardımcısı olarak görev alan Güzel, önemli projeler ve özellikle halkın içerisinde çalışmalarda sürekli yer aldı. Ekrem İmamoğlu’nun İstanbul Büyükşehir Belediye Başkanlığı görevine gelişinden sonra kurumun içerinde oluşturulan İstanbul Büyükşehir Belediyesi Özel Masalar Koordinatörlüğü’nde Meclis Üyeleri İşlerinden Sorumlu Koordinatör olarak görev aldı.2024 Mahalli ve Yerel Seçimlerinde CHP Çatalca Belediye Başkan Aday Adayı olmuştur.</p>
                    </div>
                </div>


            </div>
        </div>
    </section>

    @include('site.component.form')
@endsection


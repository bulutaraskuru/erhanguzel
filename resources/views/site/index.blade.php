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
@section('style')
    <style>
        .is-invalid {
            color: white;
            font-weight: bold;
        }

        .text-white {
            font-weight: bold;
        }

        @media (max-width: 767px) {
            #slider .slide {
                background-size: cover;
                background-position: center;
            }
        }
    </style>
@endsection
@section('content')
    <div class="mt-3" style="margin-left:10px; margin-right: 10px;">
        <!-- Inspiro Slider -->
        <div id="slider" class="inspiro-slider slider-halfscreen dots" data-height-xs="460" data-height="650"
             dots="true">
            @foreach ($sliders as $slider)
                <div class="slide" data-bg-image="{{ asset($slider->img) }}" style="border-radius: 20px; cursor: pointer;">
                    <div class="container-wide">
                        <!-- Your slide content goes here -->
                        <!-- Add a hidden link to make the entire slide clickable -->
                        <a href="{{ route('site.news.detail', ['slug' => \App\Models\News::get_variable($slider->link, 'slug')]) }}"
                           style="display: none;"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--end: Inspiro Slider --><!-- Content -->
    <section id="page-content" style="padding-top:20px; padding-bottom:0px;">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-11">
                    <h3 class="">HABERLER</h3>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('site.news.index') }}">Tümünü Gör</a>
                </div>
            </div>
            <!-- post content -->

            <div id="blog" class="grid-layout post-4-columns m-b-30" data-item="post-item" data-stagger="10">
                @foreach ($news->take(4) as $item)
                    <div class="post-item border">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="{{ route('site.news.detail', ['slug' => $item->slug]) }}">
                                    <img alt="" src="{{ asset($item->img) }}">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <span class="post-meta-date"><i class="fa fa-calendar-o"></i>{{ date('d.m.Y', strtotime($item->created_at)) }}</span>
                                <h2><a href="{{ route('site.news.detail', ['slug' => $item->slug]) }}">{{$item->title}}</a></h2>
                                <p>{!! Str::substr(strip_tags($item->description), 0, 150)  !!}</p>
                                <a href="{{ route('site.news.detail', ['slug' => $item->slug]) }}"
                                   class="item-link">Devamını Oku ... <i class="icon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- end: Post item-->
                @endforeach

{{--                <div id="blog" class="grid-layout post-4-columns m-b-30" data-item="post-item">--}}
{{--                    <!-- Post item-->--}}

{{--                    <div class="post-item border">--}}
{{--                        <div class="post-item-wrap">--}}
{{--                            <div class="post-image">--}}
{{--                                <a href="{{ route('site.news.detail', ['slug' => $item->slug]) }}">--}}
{{--                                    <img alt="" src="{{ asset($item->img) }}">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="post-item-description">--}}
{{--                                <span class="post-meta-date">--}}
{{--                                    <i class="fa fa-calendar-o">{{ date('d.m.Y', strtotime($item->created_at)) }}</span>--}}
{{--                                <h2><a--}}
{{--                                            href="{{ route('site.news.detail', ['slug' => $item->slug]) }}">{{ $item->title }}</a>--}}
{{--                                </h2>--}}
{{--                                <p>--}}
{{--                                <div>{{Str::substr($item->description, 0, 150) }}</div>--}}
{{--                                ...</p>--}}
{{--                                <a href="{{ route('site.news.detail', ['slug' => $item->slug]) }}"--}}
{{--                                   class="item-link">Devamını Oku ... <i class="icon-chevron-right"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>

        </div>
    </section>
    <!-- end: Content -->
    <!--end: Inspiro Slider --><!-- Content -->
    <section id="page-content" style="padding-top:10px; padding-bottom:0px;">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-11">
                    <h3 class="">GALERİ</h3>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('site.gallery.index') }}">Tümünü Gör</a>
                </div>
            </div>
            <!-- post content -->
            <div id="blog" class="grid-layout post-4-columns m-b-30" data-item="post-item">
                @foreach ($galleries->take(4) as $gallery)
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
    </section>
    <!-- end: Content -->

    @include('site.component.form')
@endsection

@section('script')
    <script src="{{ asset('site/plugins/validate/validate.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.mask.js') }}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.slide').on('click', function () {
                // Simulate the click on the hidden link
                $(this).find('a')[0].click();
            });


            $('#phone').mask('(000) 000-0000');

            var form = $("#form1"); // Use the form ID as the selector

            form.validate({
                errorClass: "is-invalid",
                validClass: "is-valid ",
                errorElement: "div",
                focusInvalid: false,
                rules: {
                    name: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    neighbourhood: {
                        required: true,
                    },
                    year: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    tcno: {
                        required: true,
                        minlength: 11,
                        maxlength: 11,
                        digits: true,
                    },
                },
                messages: {
                    name: {
                        required: "Ad ve Soyad alanı zorunludur.",
                    },
                    phone: {
                        required: "Telefon No alanı zorunludur.",
                    },
                    neighbourhood: {
                        required: "Mahalle alanı zorunludur.",
                    },
                    year: {
                        required: "Doğum Yılı alanı zorunludur.",
                    },
                    email: {
                        required: "E-mail alanı zorunludur.",
                        email: "Geçerli bir e-mail adresi giriniz.",
                    },
                    tcno: {
                        required: "T.C. Kimlik No alanı zorunludur.",
                        minlength: "T.C. Kimlik No 11 haneli olmalıdır.",
                        maxlength: "T.C. Kimlik No 11 haneli olmalıdır.",
                        digits: "T.C. Kimlik No sadece rakamlardan oluşmalıdır.",
                    },
                },
                errorPlacement: function (error, element) {
                    element.parent().append(error);
                },
                invalidHandler: function (elem, validator) {
                    $("html, body")
                        .stop(true, false)
                        .animate({
                                scrollTop: $(validator.errorList[0].element).offset().top -
                                    200,
                            },
                            1500,
                            "easeInOutExpo"
                        );
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: 'POST',
                        url: route('site.contact.voluntarily'),
                        data: $("#form1").serialize(),
                        success: function (response) {
                            // İşlemin başarılı olduğu durumu ele alabilirsiniz
                            console.log(response);
                            $("#form1")[0].reset(); // Form sıfırlama
                            $("#alertDiv").removeClass("alert-info").addClass(
                                "alert-success");
                            $("#alertDiv").html(
                                "İşlem başarılı!"
                            ); // Burada istediğiniz başarılı mesajı ekleyebilirsiniz
                            $("#alertDiv").show(); // Alert div'ini görünür hale getirin
                            $("#form1")[0].reset(); // Form sıfırlama
                            setTimeout(function () {
                                $("#alertDiv").hide(); // Alert div'ini gizle
                            }, 3000); // 3 saniye bekle
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            // İşlem başarısız olduğunda alert div'ini güncelleyin
                            $("#alertDiv").removeClass("alert-success").addClass(
                                "alert-info");
                            $("#alertDiv").html("İşlem başarısız: " +
                                errorThrown); // Hata mesajını ekleyebilirsiniz
                            $("#alertDiv").show(); // Alert div'ini görünür hale getirin
                            console.error(errorThrown);
                        }
                    });
                },
            });
        });
    </script>
@endsection

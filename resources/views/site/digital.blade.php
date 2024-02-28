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
        .custom-link {
            border-bottom: 1px solid gray;
            /* Alt çizginin kalınlığını ve rengini değiştirir */
            padding-bottom: 5px;
            /* Alt çizginin metinden uzaklığını ayarlar */
            width: 65px !important;
            /* Bağlantıların genişliğini belirler */
            text-decoration: none;
            /* Varsayılan metin altı çizgisini kaldırır */
            color: black;
            /* Metin rengini ayarlar */
            transition: border-color 0.3s;
            /* Alt çizginin rengindeki değişimi animasyonla gerçekleştirir */
            display: inline-flex;
            /* Bağlantıları inline-flex olarak ayarlar */
            justify-content: center;
            /* İçeriği yatay olarak merkezler */
            align-items: center;
            /* İçeriği dikey olarak merkezler */
            margin: 0 5px;
            /* Bağlantılar arasında boşluk sağlar */
        }

        .custom-link:hover {
            border-bottom: 1px solid red;
            width: 100px !important;
            transition: border-color 0.5s;

        }

        .d-flex {
            display: flex;
            /* Flex kutusu olarak ayarlar */
            justify-content: center;
            /* İçeriği yatay olarak merkezler */
            align-items: center;
            /* İçeriği dikey olarak merkezler */
        }
    </style>
@endsection
@section('content')
    <!-- Page title -->
    <section id="page-title" data-bg-parallax="{{ asset('site/images/parallax/14.jpg') }}">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="page-title">
                <h1 class="text-uppercase text-medium">{{ $page_title }}</h1>
            </div>
        </div>
    </section>
    <!-- end: Page title -->
    <section id="page-content" style="padding-top:30px; padding-bottom:0px;">
        <div class="container-fluid">
            <div class="content">
                <div>
                    <ul class="grid grid-5-columns">
                        @foreach ($digitals as $digital)
                            <li>
                                <a href="#"><img alt="" src="{{ asset($digital->img) }}"></a>
                                <div class="d-flex justify-content-center text-center mt-4">
                                    <a href="{{ asset($digital->file_url) }}" target="_blank" class="text-dark custom-link"><i class="fa fa-eye"></i></a>
                                    <a href="{{ asset($digital->file_url) }}" download="" class="text-dark custom-link"><i class="fa fa-download"></i></a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="line"></div>
            </div>
        </div>
    </section>
    @include('site.component.form')
@endsection
@section('script')
    <script src="{{ asset('site/plugins/validate/validate.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.mask.js') }}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.slide').on('click', function() {
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
                errorPlacement: function(error, element) {
                    element.parent().append(error);
                },
                invalidHandler: function(elem, validator) {
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
                submitHandler: function(form) {
                    $.ajax({
                        type: 'POST',
                        url: route('site.contact.voluntarily'),
                        data: $("#form1").serialize(),
                        success: function(response) {
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
                            setTimeout(function() {
                                $("#alertDiv").hide(); // Alert div'ini gizle
                            }, 3000); // 3 saniye bekle
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
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

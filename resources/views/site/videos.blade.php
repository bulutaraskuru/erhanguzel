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
@endsection
@section('content')
    <section id="page-content" style="padding-top:30px; padding-bottom:0px;">
        <div class="container-fluid">
            <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
               @foreach ($videos as $video )
                    <!-- Post item-->
                <div class="post-item border">
                    <div class="post-item-wrap">
                        <div class="post-video">
                            <iframe width="560" height="320" src="{{ $video->video_url }}" frameborder="0" allowfullscreen></iframe>
                            <span class="post-meta-category"><a href="">Video</a></span>
                        </div>
                        <div class="post-item-description">
                            <h2 class="text-center" ><a href="{{ route('site.video_detail',['slug' => $video->slug]) }}" style="font-size:27px;">{{ $video->title }}</a></h2>
                        </div>
                    </div>
                </div>
               @endforeach
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

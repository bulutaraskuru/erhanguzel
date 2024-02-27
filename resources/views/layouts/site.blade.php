<!DOCTYPE html>
<html lang="tr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="BULUT KURU" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    @yield('title')

    <link rel="icon" type="image/png" href="images/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Stylesheets & Fonts -->
    <link href="{{ asset('site/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/style.css') }}" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8GK4D9BF1P"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-8GK4D9BF1P');
    </script>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/futura-font@1.0.0/styles.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Futura', sans-serif !important;
        }

        #mainMenu nav>ul>li>a {
            font-family: 'Futura', sans-serif !important;

        }
    </style>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

    <!-- Latest compiled and minified JavaScript -->
    {{--    <style> --}}
    {{--        body { --}}
    {{--            display: none; --}}
    {{--        } --}}
    {{--    </style> --}}

    @yield('style')
    @routes
</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Topbar -->
        @include('site.component.topbar')
        <!-- end: Topbar -->
        <!-- Header -->
        @include('site.component.header')
        <!-- end: Header -->
        @yield('content')
        <!-- Footer -->
        @include('site.component.footer')


        <!-- end: Footer -->
    </div>
    <!-- end: Body Inner -->
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->

    <script src="{{ asset('site/js/jquery.js') }}"></script>
    <script src="{{ asset('site/js/plugins.js') }}"></script>
    <!--Template functions-->
    <script src="{{ asset('site/js/functions.js') }}"></script>
    {{-- <script> --}}
    {{--    var sessionTimeout = 5 * 60 * 1000; // 5 minutes in milliseconds --}}
    {{--    var timeout; --}}
    {{--    var userKey = 'authenticatedUser'; --}}

    {{--    // Sample user credentials stored in JSON --}}
    {{--    var users = [ --}}
    {{--        {username: 'admin', password: '123parola'}, --}}
    {{--        // Add more users as needed --}}
    {{--    ]; --}}

    {{--    function authenticate() { --}}
    {{--        // Check if the user is already authenticated --}}
    {{--        var storedUser = JSON.parse(localStorage.getItem(userKey)); --}}

    {{--        if (storedUser) { --}}
    {{--            // Check if the session is still valid --}}
    {{--            if (Date.now() - storedUser.timestamp < sessionTimeout) { --}}
    {{--                // Show the page after successful authentication --}}
    {{--                document.body.style.display = 'block'; --}}

    {{--                // Set timeout for session expiration --}}
    {{--                timeout = setTimeout(logout, sessionTimeout - (Date.now() - storedUser.timestamp)); --}}
    {{--                return; --}}
    {{--            } --}}
    {{--        } --}}

    {{--        // If not authenticated or session expired, prompt for password --}}
    {{--        var password = prompt('Password:'); --}}
    {{--        var authenticatedUser = users.find(user => user.password === password); --}}

    {{--        if (authenticatedUser) { --}}
    {{--            // Store user information in localStorage --}}
    {{--            localStorage.setItem(userKey, JSON.stringify({timestamp: Date.now()})); --}}

    {{--            // Show the page after successful authentication --}}
    {{--            document.body.style.display = 'block'; --}}

    {{--            // Set timeout for session expiration --}}
    {{--            timeout = setTimeout(logout, sessionTimeout); --}}
    {{--        } else { --}}
    {{--            alert('Incorrect password'); --}}
    {{--        } --}}
    {{--    } --}}

    {{--    function logout() { --}}
    {{--        alert('Session expired. Please log in again.'); --}}
    {{--        // Remove user information from localStorage on logout --}}
    {{--        localStorage.removeItem(userKey); --}}
    {{--        // Hide the page on logout --}}
    {{--        document.body.style.display = 'none'; --}}
    {{--    } --}}

    {{--    // Call the authenticate function when the page loads --}}
    {{--    authenticate(); --}}
    {{-- </script> --}}

    <script src="{{ asset('site/plugins/validate/validate.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.mask.js') }}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '726214596088277');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=726214596088277&ev=PageView&noscript=1" /></noscript>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERHAN GÜZEL</title>
    <!-- Latest compiled and minified CSS -->
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
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
    <style>
        /* Set height to 100% for body and html to enable the background image to cover the whole page: */
        body,
        html {
            height: 100%
        }

        .bgimg {
            /* Background image */
            background-color: white;
            /* Full-screen */
            height: 100%;
            /* Center the background image */
            background-position: center;
            /* Scale and zoom in the image */
            background-size: cover;
            /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
            position: relative;
            /* Add a white text color to all elements inside the .bgimg container */
            color: white;
            /* Add a font */
            font-family: "Courier New", Courier, monospace;
            /* Set the font-size to 25 pixels */
            font-size: 25px;
        }

        /* Position text in the top-left corner */
        .topleft {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Position text in the bottom-left corner */
        .bottomleft {
            position: absolute;
            bottom: 0;
            left: 16px;
        }

        /* Position text in the middle */
        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /* Style the <hr> element */
        hr {
            margin: auto;
            width: 40%;
        }
    </style>
</head>

<body>
    <div class="bgimg">
        <div class="topleft">
            <p><img src="{{ asset('site/erhanguzellogo.png') }}" alt=""></p>
        </div>
        <div class="middle">
            <h1 style="color:black;">YAPIM AŞAMASINDA</h1>
            <hr>
            <p style="color:black;">YAKINDA !</p>
        </div>
    </div>
</body>

</html>

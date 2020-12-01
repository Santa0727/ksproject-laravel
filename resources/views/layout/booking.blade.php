<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Ticket & Promotions | Rasa Melaka</title>

    <!-- ALL CSS CONNECTIONS -->
    <!-- Meta Theme Color -->
    <meta name="theme-color" content="#111111">

    <!-- Favicons -->
    <link rel="shortcut icon" href="images/favicons/favicon.png" type="image/png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome-all.min.css') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/booking/lightbox.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/booking/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/booking/custom.css') }}">

</head>
<body>
    <!-- HEADER SECTION -->
	<nav class="navbar navbar-compact">
        <div class="text-center">
            <a class="logo-link magnetic" href="http://rasamelaka.winnefy.xyz/">
                <img class="logotype" id="logo" src="{{ asset('img/logo.png') }}" alt="Rasa Melaka">
            </a>
        </div>
    </nav>

	<!-- MAIN CONTENTS -->
    <main class="js-scroll">

            @yield('content')

        </div>

        <footer id="footer-bottom">
            <p id="footer-p">© 2019 Rasa Melaka. All Rights Reserved</p>
            <p id="footer-sm-text">
                Powered by <a id="footer-a" href="https://www.winnefy.com/" target="_blank">Winnefy</a> - <a id="footer-a" href="https://www.winnefy.com/web-design" target="_blank">Web Design Malaysia</a>.
            </p>
        </footer>
        <!-- END OF FOOTER SECTION -->
    </main>
    <!-- END OF MAIN CONTENTS -->

	<!-- ALL JS CONNECTIONS -->
	<!-- CURSOR -->
    <div class="node" id="node"></div>
    <div class="cursor" id="cursor"></div>
    <!-- END OF CURSOR -->

    <!-- JavaScripts -->
    <script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/pages/booking/lightbox.min.js') }}"></script>

    @stack('js')

</body>
</html>
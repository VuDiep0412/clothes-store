<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @section('style')
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">


    <!-- Css Styles -->
    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/style.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="/frontend/css/jquery-ui.min.css" type="text/css">


    @show
</head>

<body>
    @include('frontend.layouts.offcanvas')

    @include('frontend.layouts.header')

    @yield('content')

    @include('frontend.layouts.footer')

    @section('script')
      <!-- Js Plugins -->
    <script src="/frontend/js/jquery-3.3.1.min.js"></script>
    <script src="/frontend/js/bootstrap.min.js"></script>
    <script src="/frontend/js/jquery-ui.min.js"></script>
    <script src="/frontend/js/jquery.zoom.min.js"></script>
    <script src="/frontend/js/jquery.dd.min.js"></script>

    <script src="/frontend/js/jquery.nice-select.min.js"></script>
    <script src="/frontend/js/jquery.nicescroll.min.js"></script>
    <script src="/frontend/js/jquery.magnific-popup.min.js"></script>
    <script src="/frontend/js/jquery.countdown.min.js"></script>
    <script src="/frontend/js/jquery.slicknav.js"></script>
    <script src="/frontend/js/mixitup.min.js"></script>
    <script src="/frontend/js/owl.carousel.min.js"></script>
    <script src="/frontend/js/main.js"></script>
    @section('my_javascript')
    @show

</body>

   
</html>
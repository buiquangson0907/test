<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="author">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome-free-6.4.2-web/css/all.min.css">
    <link rel="stylesheet" href="vendor/slick/slick.css">
    <link rel="stylesheet" href="vendor/slick/slick-theme.css">
    <script>
        let myArray = [
            { key: '--color-main', value: '#e10034' },
            { key: '--color-main-hover', value: '#b41f24' }
        ];
        function setRootVariables(data) {
            data.forEach(element => {
                document.documentElement.style.setProperty(element.key, element.value);
            });
        }
        setRootVariables(myArray);
    </script>
    <link rel="stylesheet" href="template/front/css/style.css?v={{ time() }}">
    @stack('livecode-css')
</head>
<body>
    <header>
        @include('front.layout.header')
    </header>
    <section class="m_head_top"></section>
    @yield('content')
    <footer class="footer">
        @include('front.layout.footer')
        @include('front.layout.global-member')
    </footer>
    <div id="js-tooltip" class="global-tooltip"></div>
    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="vendor/slick/slick.js"></script>
    <script type="text/javascript" src="vendor/jquery-lazy/jquery.lazy.min.js"></script>
    <script src="template/front/js/header.js?v={{ time() }}"></script>
    <script src="template/front/js/slick.js?v={{ time() }}"></script>
    <script src="template/front/js/tooltip.js?v={{ time() }}"></script>
    @stack('livecode-js')
</body>
</html>

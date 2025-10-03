<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My E-Shop')</title>
    <link rel="stylesheet" href="{{ asset('modules/product/assets/css/style.css') }}">
       <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
   <link href="{{ asset('modules/product/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('modules/product/css/style.css') }}">
</head>
<body>

    {{-- Header --}}
    @include('product::partials.header')

    {{-- Sidebar (if needed on all pages) --}}


    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('product::partials.footer')

<!-- Custom Script -->
<script src="{{ asset('modules/product/assets/js/script.js') }}"></script>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('modules/product/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('modules/product/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Contact Javascript File -->
<script src="{{ asset('modules/product/mail/jqBootstrapValidation.min.js') }}"></script>
<script src="{{ asset('modules/product/mail/contact.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('modules/product/js/main.js') }}"></script>

</body>
</html>

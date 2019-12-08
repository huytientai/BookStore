<!doctype html>
<html class="no-js" lang="zxx">
@include('exam1.head')
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please
    <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">
    <!-- Header -->
@include('exam1.header')
<!-- End Header -->
    <!-- Start BEst Seller Area -->
@yield('content')
    <!-- Footer Area -->
@include('exam1.footer')
<!-- //Footer Area -->

</div>
<!-- //Main wrapper -->

<!-- JS Files -->
<script src="{{ asset('js/vendor/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/active.js') }}"></script>

</body>
</html>

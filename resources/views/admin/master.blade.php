<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'Dashboard')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @include('admin.partials.styles')

</head>

<body>

    <!-- ======= Header ======= -->
    @include('admin.partials.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('admin.partials.sidebar')
    <!-- End Sidebar-->

    @yield('content')
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('admin.partials.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('admin.partials.scripts')

</body>

</html>

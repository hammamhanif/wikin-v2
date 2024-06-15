<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Wikin | Website Interaktif Komunitas Nuklir Indonesia</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{ asset('img/logo.png') }}"" rel="icon">
    <link href="{{ asset('img/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    {{-- jquery --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style3.css') }}" rel="stylesheet">

    @stack('styles')
    @stack('news')


</head>

<body>


    @include('tamplate.dashboard.header')
    @include('tamplate.dashboard.sidebar')


    @yield('dashboard')


    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Wikin Dev.</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    {{-- <script src="{{ asset('assets/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/chart.js/chart.umd.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/echarts/echarts.min.js') }}"></script> --}}
    <script src="{{ asset('assets/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/php-email-form/validate.js') }}"></script>



    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script>
        tinymce.init({
            selector: '#news', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>

</body>

</html>

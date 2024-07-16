<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Admin</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/assets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet" media="all">
    <link href="{{ asset('admin/assets/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/assets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/assets/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet"
        media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/assets/css/theme.css') }}" rel="stylesheet" media="all">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->

        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        @include('admin.partial.sidebar')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            @include('admin.partial.header')
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/assets/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/assets/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/select2/select2.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>

      <!-- Custom scripts added via  -->
      @stack('scripts')
</body>

</html>

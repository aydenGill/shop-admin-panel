<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard </title>

    <meta name="description" content="" />


    <link rel="icon" type="image/x-icon" href="{{asset("assets/img/favicon/favicon.ico")}}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="{{asset("assets/vendor/fonts/boxicons.css")}}" />

    <link rel="stylesheet" href="{{asset("assets/vendor/css/core.css")}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset("assets/vendor/css/theme-default.css")}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset("assets/css/demo.css")}}" />

    <link rel="stylesheet" href="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css")}}" />

    <link rel="stylesheet" href="{{asset("assets/vendor/libs/apex-charts/apex-charts.css")}}" />

    <script src="{{asset("assets/vendor/js/helpers.js")}}"></script>

    <script src="{{asset("assets/js/config.js")}}"></script>
    @livewireStyles

</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include("partial.menu")
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
                @include("partial.header")
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    {{ $slot }}
                </div>
                <!-- / Content -->

                <!-- Footer -->
                @include("partial.footer")
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>


<!-- Core JS -->
<script src="{{asset("assets/vendor/libs/jquery/jquery.js")}}"></script>
<script src="{{asset("assets/vendor/libs/popper/popper.js")}}"></script>
<script src="{{asset("assets/vendor/js/bootstrap.js")}}"></script>
<script src="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js")}}"></script>

<script src="{{asset("assets/vendor/js/menu.js")}}"></script>

<script src="{{asset("assets/vendor/libs/apex-charts/apexcharts.js")}}"></script>

<script src="{{asset("assets/js/main.js")}}"></script>

<script src="{{asset("assets/js/dashboards-analytics.js")}}"></script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script>
    window.addEventListener('OpenAddModal', function(event){
        $('.OpenAddModals').find('span').html('');
        $('.OpenAddModals').modal('show');
    });

    window.addEventListener('OpenEditModal' , function (event) {
        $('.OpenEditModals').find('span').html('');
        $('.OpenEditModals').modal('show');
    });

    window.addEventListener('OpenSubModal' , function (event) {
        $('.OpenSubModals').find('span').html('');
        $('.OpenSubModal').modal('show');
    });
</script>
@livewireScripts

</body>
</html>

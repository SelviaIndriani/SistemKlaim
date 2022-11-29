<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
    <!-- CSS Files -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/datatables.min.css" rel="stylesheet">
    <link href="/css/select2.min.css" rel="stylesheet">
    <link href="/css/select2-bootstrap-5-theme.min.css" rel="stylesheet">
    <link href="/css/select.dataTables.min.css" rel="stylesheet">
    <link href="/vendor/simple-datatables/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>



    <title>Sistem Klaim Ban | {{ $title }} </title>
</head>

<body>

    @include('layouts.navbar')

    <!--content body-->
    <div class="container mt-4">
        @yield('container')
    </div>


    <!--  JS Files -->

    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/chart.js/chart.min.js"></script>
    <script src="/vendor/echarts/echarts.min.js"></script>
    <script src="/vendor/quill/quill.min.js"></script>
    <script src="/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    <script src="/js/moment-with-locales.min.js"></script>
    <script src="/js/jquery.inputmask.js"></script>
    <script src="/js/inputmask.binding.js"></script>
    <script src="/js/dataTables.select.min.js"></script>
    <script src="/js/pdfmake.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/vfs_fonts.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/scripts.js"></script>

</body>

</html>

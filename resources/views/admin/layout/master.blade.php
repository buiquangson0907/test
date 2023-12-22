<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="author">
    <meta name="keywords" content="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="image/favicon.ico">
    <!-- library -->
    <link rel="stylesheet" href="vendor/fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- plugin datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    {{-- <link rel="stylesheet" href="vendor/DataTables/css/dataTables.bootstrap5.min.css"> --}}
    {{-- <link rel="stylesheet" href="vendor/DataTables/css/dataTables.button2.3.6.min.css"> --}}
    <!-- plugin bootstrap toggle -->
    <link rel="stylesheet" href="vendor/bootstrap-toggle/css/bootstrap4-toggle.css">
    <!-- plugin select2 -->
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/select2/select2-bootstrap-5-theme.min.css">
    <!-- custom -->
    <link href="template/admin/css/style.css?v={{ time() }}" rel="stylesheet">
    @stack('livecode-css')
</head>

<body class="body-fixed fixed theme-light">
    @include('admin.layout.header')
    <div id="layoutSidenav">
        <aside class="main_sidebar" id="sidebar">
            @include('admin.layout.sidebar')
        </aside>
        <div class="resize-handle--x" id="resize-handle" > </div>
        <main class="main_content">
            @yield('content')
            @include('admin.layout.footer')
            @include('admin.layout.swal-alert')
        </main>
    </div>
    <!-- library -->
    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- plugin datatable -->
    <script src="vendor/DataTables/js/jquery.dataTables.js"></script>
    {{-- <script src="vendor/DataTables/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="vendor/DataTables/js/dataTables.button.2.3.6.min.js"></script>
    <!-- plugin bootstrap toggle -->
    <script src="vendor/bootstrap-toggle/js/bootstrap4-toggle.js"></script>
    <!-- plugin sweetalert2-->
    <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- plugin inputmask -->
    <script src="vendor/inputmask/jquery.inputmask.js"></script>
    <!-- plugin select2 -->
    <script src="vendor/select2/select2.min.js"></script>
     <!-- plugin tinymce editor -->
     <script src="/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/tinymce/vhn_tinymce.js?v={{ time() }}"></script>
    <!-- template -->
    <script src="template/admin/js/template_sidebar.js?v={{ time() }}"></script>
    <script src="template/admin/js/template_general.js?v={{ time() }}"></script>
    <script src="template/admin/js/template_datatable.js?v={{ time() }}"></script>
    <script src="template/admin/js/template_sweetalert2_action.js?v={{ time() }}"></script>
    <script src="template/admin/js/template_sweetalert2_session.js?v={{ time() }}"></script>
    @stack('livecode-js')
</body>

</html>

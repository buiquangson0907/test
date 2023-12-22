<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <title>Document</title>
    <link rel="shortcut icon" href="image/favicon.ico">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/fontawesome-free-6.4.2-web/css/all.css">
    <style>
        .bg-login {
            background: url('image/login.svg') no-repeat fixed right #232323;
            background-size: auto 70%;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-login" >

    <div class="container">
        <div class="row justify-content-md-start">
            <div class="col-md-6 p-5 shadow rounded" style="background-color: azure">
                <div class="d-flex flex-wrap justify-content-center align-items-center text-center mb-3">
                    <img src="image/logo.png" height="70px;">
                    <h1 class="h2" style="color: cadetblue;"> Quản trị hệ thống</h1>
                </div>
                <form action="admin/login" method="post" id="login" class="row g-4 " autocomplete="off">
                    @csrf
                    <div class="col-12">
                        <label class="fw-bold" for="email">Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <input type="email" name="txtEmail" value="" id="email" class="form-control" autocomplete="off" placeholder="Email...">
                        </div>
                        <small class="text-danger"> </small>
                    </div>

                    <div class="col-12">
                        <label class="fw-bold" for="password"> Mật khẩu <span class="text-danger">*</span> </label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="password" name="txtPassword" id="password" class="form-control" autocomplete="off" placeholder="Điền mật khẩu...">
                        </div>
                        <small class="text-danger"> </small>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" value="lsRememberMe"  id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Nhớ tài khoản</label>
                        </div>

                        <a href="/" class="float-start link-secondary text-decoration-none fs-6 fw-bold">
                            <i class="fa-solid fa-house"></i> Trang chủ
                        </a>
                    </div>

                    <div class="col-6">
                        <button type="submit" class="btn btn-primary px-4 float-end mt-4" onclick="lsRememberMe()">
                            <i class="fa-solid fa-right-to-bracket"></i> Đăng nhập
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.layout.swal-alert')
    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="template/admin/js/template_sweetalert2_session.js?v={{ time() }}"></script>
    <script src="template/admin/js/account/re.js?v={{ time() }}"></script>
</body>

</html>

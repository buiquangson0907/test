@extends('front.layout.master')
@section('title', 'Sản phẩm')
@section('content')
    <section class="container header-scroll pt-1">
        <div class="global-menu">
            @include('front.layout.global-menu')
        </div>
        <div class="nav-breadcrumb">
            <div class="nav-start">
                <a href="">Trang chủ <i class="fa-solid fa-chevron-right"></i> </a>
                <a href="dang-ky">Đăng ký tài khoản <i class="fa-solid fa-chevron-right"></i></a>
            </div>
        </div>
    </section>
    <section class="container wrap-content">
        <h6 class="title w-100">
            Tạo tài khoản khách hàng cá nhân
        </h6>

        <div class="col-md-6">

            {{-- <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                        value="email@example.com">
                </div>
            </div> --}}
            <div class="mt-3 row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email(*)</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail">
                </div>
            </div>
            <div class="mt-3 row">
                <label for="inputName" class="col-sm-2 col-form-label">Tên</label>
                <div class="col-sm-10">
                    <input type="name" class="form-control" id="inputName">
                </div>
            </div>
            <div class="mt-3 row">
                <label for="inputPhone" class="col-sm-2 col-form-label">Số điện thoại(*)</label>
                <div class="col-sm-10">
                    <input type="phone" class="form-control" id="inputPhone">
                </div>
            </div>
            <div class="mt-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword">
                </div>
            </div>
        </div>
    </section>

@endsection



@push('livecode-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush
@push('livecode-js')
@endpush

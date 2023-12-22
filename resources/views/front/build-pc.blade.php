@extends('front.layout.master')
@section('title', 'Build PC')
@section('content')
    <section class="container header-scroll ">
        <div class="global-menu">
            @include('front.layout.global-menu')
        </div>
        <div class="nav-breadcrumb">
            <div class="nav-start">
                <a href="">Trang chủ <i class="fa-solid fa-chevron-right"></i></a>
                <a href="">xém chủ <i class="fa-solid fa-chevron-right"></i></a>
                <a href="">Trang chủ <i class="fa-solid fa-chevron-right"></i></a>
                <a href="">xém chủ <i class="fa-solid fa-chevron-right"></i></a>
            </div>
            <div class="nav-end">
                <h1 class="highlight"> LAPTOP DELL </h1>
                ( Tổng <span class="highlight"> 148 </span> sản phẩm )
            </div>
        </div>
    </section>
    <section class="container">
        <div class="slider-page mt-3">
            <a href="/" class="p-img">
                <img src="https://minhancomputercdn.com/media/banner/09_Mar26b3c407e8d1ebe43035c6c759805c2f.png">
            </a>
            <a href="/" class="p-img">
                <img src="https://minhancomputercdn.com/media/banner/09_Mar26b3c407e8d1ebe43035c6c759805c2f.png">
            </a>
        </div>
        <div class="build-pc">
            <h1 class="build-pc__title">
                XÂY DỰNG CẤU HÌNH MÁY TÍNH
            </h1>
            <div class="select-build mt-3">
                <div class="nav btn-tabs">
                    <button class="btn-tab active" data-id="1" data-bs-toggle="tab" type="button">
                        Cấu hình 1
                    </button>
                    <button class="btn-tab" data-id="2" data-bs-toggle="tab" type="button">
                        Cấu hình 2
                    </button>
                </div>
                <div class="tab-alert">
                    <div class="btn-alert">
                        <i class="fa-solid fa-arrows-rotate"></i> Làm mới
                    </div>
                    <span class="highlight">Chi phí dự tính: 3.950.000 đ</span>
                </div>
            </div>

            <div class="list-build">
                @for ($i = 0; $i < 10; $i++)
                    <div class="item-build">
                        <div class="item-build__title">
                            1. CPU - Bộ vi xử lý
                        </div>
                        <div class="item-build__checked">
                            <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#popupBuild">
                                <i class="fa-solid fa-plus"></i> Chọn CPU - Bộ vi xử lý
                            </span>
                        </div>
                    </div>
                    <div class="item-build">
                        <div class="item-build__title">
                            2. Mainboard - Bo mạch chủ
                        </div>
                        <div class="item-build__checked">
                            <div class="bc-item">
                                <div class="bc-item-start">
                                    <a target="_blank" href="/eee">
                                        <img src="https://minhancomputercdn.com/media/product/75_4730_4730_cpu_amd_ryzen_5_5600x.jpg">
                                    </a>
                                </div>
                                <div class="bc-item-end">
                                    <a target="_blank" href="/cpu-amd-ryzen-5-5600x.html" class="bc-item__title">
                                        CPU AMD Ryzen 5 5600X (3.7GHz up to 4.6GHz, 6 nhân, 12 luồng, 35MB Cache , 65W) - Socket AM4
                                    </a>
                                    <div class="bc-item__sku">
                                        <span>Mã sản phẩm: <b class="text-success">CPUA062</b> </span>
                                        <span>Bảo hành: <b class="text-success">24</b> </span>
                                        <span>Kho hàng: <b class="text-success">Còn hàng</b></span>
                                    </div>

                                    <p class="bc-item__note">
                                        <span class="fw-bold me-2">Note: Sản phẩm sale dịp sinh nhật số lượng có hạn, khi hết số lượng sale sẽ trở về giá gốc.</span>
                                        <a class="btn-showmore" href="/cpu-amd-ryzen-5-5600x.html" target="_blank">
                                            Xem chi tiết <i class="fa-solid fa-angles-right"></i>
                                        </a>
                                    </p>
                                    <div class="bc-item__calc">
                                        <p class="calc__start">
                                            <span> 3.950.000 </span>
                                            <span>X</span>
                                            <input type="number" max="999" value="2">
                                            <span>=</span>
                                            <span class="text-danger">3.950.000</span>
                                        </p>
                                        <div class="calc__end">
                                            <span class="pointer bg-primary btn-icon btn-icon-small" data-bs-toggle="modal" data-bs-target="#popupBuild">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </span>
                                            <span class="bg-danger btn-icon btn-icon-small"><i class="fa-solid fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

            </div>
        </div>
    </section>
    @include('front.build-pc.popup')
@endsection


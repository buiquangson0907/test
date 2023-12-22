@extends('front.layout.master')
@section('title', 'Danh mục bán sản phẩm')
@section('content')
    <section class="container header-scroll pt-1">
        <div class="global-menu">
            @include('front.layout.global-menu')
        </div>
        <div class="nav-breadcrumb">
            <div class="nav-start">
                <a href=""> Trang chủ <i class="fa-solid fa-caret-right"></i></a>
                <a href=""> Máy tính xách tay - laptop <i class="fa-solid fa-caret-right"></i></a>
                <a href=""> Dell <i class="fa-solid fa-caret-right"></i></a>
                <a href=""> Dell vostro <i class="fa-solid fa-caret-right"></i></a>
            </div>
            <div class="nav-end">
                <h1 class="highlight"> LAPTOP DELL </h1>
                ( Tổng <span class="highlight"> 148 </span> sản phẩm )
            </div>
        </div>
    </section>
    <section class="container wrap-content">
        <div class="col-page-start">
            <div class="list-cat">
                <a href="/laptop-dell-xps.html">
                    <span class="cat-child-thumb"></span>
                    <span class="cat-child-title">Laptop Dell XPS </span>
                </a>

                <a href="/laptop-dell-vostro.html">
                    <span class="cat-child-thumb"></span>
                    <span class="cat-child-title">Laptop Dell Vostro </span>
                </a>

                <a href="/laptop-dell-latitude.html">
                    <span class="cat-child-thumb"></span>
                    <span class="cat-child-title">Laptop Dell Latitude </span>
                </a>

                <a href="/laptop-dell-inspiron.html">
                    <span class="cat-child-thumb"></span>
                    <span class="cat-child-title">Laptop Dell Inspiron </span>
                </a>

                <a href="/laptop-dell-alienware.html">
                    <span class="cat-child-thumb"></span>
                    <span class="cat-child-title">Laptop Dell Alienware </span>
                </a>

                <a href="/laptop-dell-g-series-gaming.html">
                    <span class="cat-child-thumb"></span>
                    <span class="cat-child-title">Laptop Dell G Series Gaming </span>
                </a>
            </div>
            <div class="js-filter">
                @for ($i = 0; $i < 20; $i++)
                    <div class="filter__item">
                        <p class="title"> hãng sản xuất {{ $i }}</p>
                        <div class="filter-list">
                            <div class="form-check filter-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label">
                                    DELL (148)
                                </label>
                            </div>
                            <div class="form-check filter-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label">
                                    DELL (148)
                                </label>
                            </div>
                            <div class="form-check filter-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label">
                                    DELL (148)
                                </label>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="icon-38 btn-filter">
                <i class="fa-solid fa-filter"></i> lọc sản phẩm
            </div>
        </div>
        <div class="col-page-end">
            <div class="slider-page">
                <a href="/" class="p-img">
                    <img src="https://minhancomputercdn.com/media/banner/09_Mar26b3c407e8d1ebe43035c6c759805c2f.png">
                </a>
                <a href="/" class="p-img">
                    <img src="https://minhancomputercdn.com/media/banner/09_Mar26b3c407e8d1ebe43035c6c759805c2f.png">
                </a>
                <a href="/" class="p-img">
                    <img src="https://minhancomputercdn.com/media/banner/09_Mar26b3c407e8d1ebe43035c6c759805c2f.png">
                </a>
            </div>
            <div class="product-content">
                <div class="product-sort">
                    <p class="sort-title">
                        <i class="fa-solid fa-list"></i> SẮP XẾP SẢN PHẨM
                    </p>

                    <div class="sort-container">
                        <div class="sort-option">
                            <a href="https://minhancomputer.com/laptop-may-tinh-xach-tay.html?sort=new">
                                Mới nhất
                            </a>
                            <a href="https://minhancomputer.com/laptop-may-tinh-xach-tay.html?sort=view">
                                XEM NHIỀU
                            </a>
                            <a href="/laptop-may-tinh-xach-tay.html?sort=price-off">Giảm nhiều</a>

                            <a
                                href="https://minhancomputer.com/laptop-may-tinh-xach-tay.html?page=2&amp;other_filter=in-stock">CÒN
                                HÀNG</a>
                        </div>
                        <div class="sort-style">
                            <div class="btn-select-drop">
                                <p class="select-title">
                                    <i class="fa-solid fa-shuffle"></i> Giá sản phẩm
                                </p>
                                <div class="select-content">
                                    <a href="116"><i class="fa-solid fa-shuffle"></i> Giá sản phẩm</a>
                                    <a href="30"><i class="fa-solid fa-arrow-up-wide-short"></i> Giá tăng</a>
                                    <a href="103"><i class="fa-solid fa-arrow-down-wide-short"></i> Giá giảm</a>
                                </div>
                            </div>
                            <div class="icon-38">
                                <i class="fa-solid fa-border-all"></i>
                            </div>
                            <div class="icon-38">
                                <i class="fa-solid fa-list"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="product-list grid-list">
                    @for ($i = 0; $i < 7; $i++)
                        <div class="product-item" data-id="2">
                            <div class="product-item__wrap">
                                <span class="p-discount" data-label="giảm nhiều "></span>
                                <a href="san-pham-2" class="p-img" tabindex="0">
                                    <img src="storage/products/1698771600/1700795225_san-pham-2.jpg?v=1701159592"
                                        alt="sản phẩm 2">
                                </a>
                                <div class="p-text">
                                    <div class="p-star-group">
                                        <div class="p-star">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                        <div class="p-sku"> Mã SP: <span>0</span> </div>
                                    </div>

                                    <a href="san-pham-2" class="p-name" tabindex="0">
                                        sản phẩm 2 sản phẩm 2 sản phẩm 2
                                    </a>
                                    <div class="price-group">
                                        <span class="p-price">111110đ</span>
                                        <del>1222220đ</del>
                                    </div>

                                    <div class="p-button">
                                        <span class="out-of-stocking">
                                            Liên hệ
                                        </span>
                                        <a href="javascript:void(0)" class="p-buy" tabindex="0">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-tooltip">

                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="nav-page">
                    <a href="/laptop-may-tinh-xach-tay.html" class="active">1</a>
                    <a href="/laptop-may-tinh-xach-tay.html?page=2">2</a>
                    <a href="/laptop-may-tinh-xach-tay.html?page=3">3</a>
                    <a href="/laptop-may-tinh-xach-tay.html?page=4">4</a>
                    <a href="/laptop-may-tinh-xach-tay.html?page=5">5</a>
                    <a href="/laptop-may-tinh-xach-tay.html?page=6">6</a>
                    <a href="/laptop-may-tinh-xach-tay.html?page=7">7</a>
                </div>
            </div>

            @include('front.layout.article')

        </div>
        <div class="modal fade activeModal" id="popupFilter" data-bs-backdrop="static" >
            <div class="modal-dialog modal-dialog-scrollable modal-single-scrollable modal-md">
                <div class="modal-content">
                    <div class="popup-header">
                        <h5 class="modal-title fw-bold">Lọc sản phẩm</h5>
                        <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body popup-main" >

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">
                            <i class="fa-solid fa-filter-circle-xmark"></i> Huỷ bộ lọc
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('livecode-js')
    <script>
        $('.js-filter').clone().appendTo('.popup-main');
        $('.btn-filter').click(function (e) {
            var popupFilter = new bootstrap.Modal(document.getElementById('popupFilter'));
                popupFilter.show();
        });
    </script>
@endpush

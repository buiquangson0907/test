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
                @foreach ($breadcrumbs as $item)
                    <a href="{{ $item->slug }}">{{ $item->name }} <i class="fa-solid fa-chevron-right"></i></a>
                @endforeach
            </div>
        </div>
    </section>
    <section class="container wrap-content">
        <div class="col-page-full product-detail__page">
            <h1 class="product-name">
                {{ $product->name }}
            </h1>
            <div class="product-detail-start">
                <div class="large-gallery" id="js-large-image">
                    @if (count($product_galleries) > 0)
                        <a href="{{ 'storage/'.$product_galleries->first()->name }}" class="thumb" data-fancybox="gallery">
                            <img class="lazy" data-src="{{ 'storage/'.$product_galleries->first()->name }}" alt="{{ $product->name }}">
                        </a>
                    @endif
                </div>
                <div class="track-gallery">

                    @if ($product->review_video)
                        @php $minus = 4; @endphp
                        <a href="{{ $product->review_video }}" data-fancybox="video-gallery" class="thumb video-thumb">
                            <i class="fa-solid fa-circle-play"></i>
                            <span>video</span>
                            <span>Review</span>
                        </a>
                    @else
                        @php $minus = 5; @endphp
                    @endif
                    @php $count = count($product_galleries) - $minus; @endphp
                    @foreach ($product_galleries as $item)
                        @if ($item->serial_id < $minus)
                            <a href="{{ 'storage/'.$item->name }}" class="thumb js-thumb" data-fancybox="gallery">
                                <img class="lazy" data-src="{{ 'storage/'.$item->name }}" alt="{{ $product->name }}">
                            </a>
                        @elseif ($item->serial_id == $minus)
                            <a href="{{ 'storage/'.$item->name }}" class="thumb js-thumb" data-fancybox="gallery">
                                <img class="lazy" data-src="{{ 'storage/'.$item->name }}" alt="{{ $product->name }}">
                                <span class="thumb-plus">+{{ $count }}</span>
                            </a>
                        @endif
                    @endforeach

                </div>
            </div>
            <div class="product-detail-middle">
                <div class="product-detail__sku">
                    <span> Mã SP: <b class="text-success"> {{ $product->code }} </b> </span>
                    <span> Bảo hành: <b class="text-success"> {{ $product->warranty }} Tháng </b> </span>
                    <span> Tình trạng: @if($product->quantity > 0)
                        <b class="text-success"> Còn hàng </b>
                        @else <b class="text-danger"> Hết hàng </b> @endif </span>
                </div>
                <div class="product-detail__visit">
                    <div class="p-view">
                        Lượt xem: {{ $product->views }}
                    </div>
                    <div class="p-star" data-rating="4">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="fw-bold">(0 đánh giá)</div>
                </div>
                <div class="product-detail__price">
                    <div class="detail-price">
                        <span class="detail-price-title">Giá gốc :</span>
                        <span class="through-num">
                            {{ currency_vn($product->cost) }} đ
                        </span>
                    </div>

                    <div class="detail-price">
                        <span class="detail-price-title">Giá khuyến mại:</span>
                        <span class="product-price">{{ currency_vn($product->price) }} đ </span>
                        <span class="product-disc">(Tiết kiệm: {{ currency_vn($product->cost - $product->price) }} đ)</span>
                    </div>
                </div>
                <div class="product-detail__summary">
                    <b class="summary-title">Mô tả tóm tắt sản phẩm</b>
                    <div class="summary overflow-hidden" id="js-summary">
                        <div id="js-height-summary">
                            {!! $product->summary !!}
                        </div>
                    </div>
                    <a href="javascript:void(0)" class="btn-showmore" id="js-showmore-summary">
                        <span>Xem thêm</span> <i class="fa fa-angle-double-down"></i>
                    </a>
                </div>
                <div class="product-detail__offer">
                    <div class="title">
                        <i class="fa-solid fa-gift"></i>
                        Quà tặng và ưu đãi
                    </div>
                    <div class="offer-content">
                        {!! $product->offer !!}
                    </div>
                </div>
                <div class="product-detail__buttonbuy">
                    <div class="buttonbuy-quantity">
                        <div class="title">
                            Số lượng:
                        </div>
                        <div class="quantity">
                            <a href="javascript:void(0)" class="js-quantity-change quantity-change" data-value="-1">
                                <i class="fa fa-minus"></i>
                            </a>
                            <input type="text" class="js-buy-quantity js-quantity-change input-quantity"
                                value="1">
                            <a href="javascript:void(0)" class="js-quantity-change quantity-change" data-value="1"> <i
                                    class="fa fa-plus"></i> </a>
                        </div>
                    </div>
                    <div class="buttonbuy__addcart">
                        <a href="javascript:void(0)" class="btncart buyNow" onclick="listenBuyProduct(13657,'cart')">
                            <b>ĐẶT MUA NGAY</b>
                            <span>Giao hàng tận nơi nhanh chóng, thuận tiện</span>
                        </a>
                        <a href="javascript:void(0)" class="btncart addCart" onclick="listenBuyProduct(13657, 'stay')">
                            <b>THÊM VÀO GIỎ HÀNG</b>
                            <span>Thêm vào giỏ để chọn tiếp</span>
                        </a>
                        <a href="javascript:void(0)" class="btncart payInstall"
                            onclick="listenBuyProduct(13657,'payinstall')">
                            <b>TRẢ GÓP CHỈ TỪ 0%</b>
                        </a>
                    </div>
                </div>
                <div class="product-detail__support">
                    <div class="form-support">
                        <input type="text" placeholder="Hãy để lại số điện thoại để được tư vấn" autocomplete="off"
                            id="phone-now" name="contact_tel">
                        <a href="javascript:void(0)" class="icon-submit" onclick="callForMe()">
                            <i class="fa-solid fa-right-long"></i>
                        </a>
                    </div>
                    <div class="button-support">
                        <div class="btn-icon phone-ring">
                            <i class="fa-solid fa-phone-flip"></i>
                        </div>
                        <div class="text-support">
                            <span>Hotline tư vấn</span>
                            <b>0123.456.789</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-detail-end">
                <div class="detail-block">
                    <p class="title">SẢN PHẨM CÒN HÀNG TẠI</p>
                    <div class="list list__store scrollbar-small">
                        @for ($i = 0; $i < 10; $i++)
                            <a href="" class="store-item">
                                <i class="fa-solid fa-shop"></i> 155 Trần Trọng Cung, Quận 7
                            </a>
                        @endfor
                    </div>
                </div>
                <div class="detail-block">
                    <p class="title">CHÍNH SÁCH MUA HÀNG</p>
                    <div class="list list__policy scrollbar-small">
                        @for ($i = 0; $i < 10; $i++)
                            <div class="policy-item">
                                <i class="fa-solid fa-shop"></i> 155 Trần Trọng Cung, Quận 7
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="detail-block">
                    <p class="title">HOTLINE HỖ TRỢ</p>
                    <div class="list list__hotline scrollbar-small">
                        @for ($i = 0; $i < 10; $i++)
                            <div class="hotline-item">
                                <i class="fa-solid fa-circle-dot"></i>
                                155 Trần Trọng Cung, Quận 7 TPHCM
                                <b>0123.456.789</b>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container wrap-content">
        <div class="col-page-full product-info-start">
            <h2 class="product-title">
                {{ $product->name }}
            </h2>
            <div class="product-article overflow-hidden" id="js-article">
                <div id="js-height-article">
                    {!! $product->content !!}
                </div>
            </div>
            <a class="btn-showmore" id="js-showmore-article">
                Xem thêm <i class="fa fa-angle-double-down"></i>
            </a>
        </div>
        <div class="col-page-full product-info-end">
            <h2 class="box-title">Thông số kỹ thuật</h2>
            <div class="spec-table" id="dialog-spec">
                {!! $product->specifications !!}
            </div>
            <div class="spec-button-show" data-fancybox data-src="#dialog-spec">
                Xem thêm thông số
            </div>
        </div>
    </section>
    @include('front.product.rating-comment-ect')
    <section class="container wrap-content">
        <div class="col-page-full w-100">
            <div class="nav btn-tabs" id="myTab" >
                <button class="btn-tab active" id="same-tab" data-bs-toggle="tab" data-bs-target="#same" type="button">
                    Sản phẩm tương tự
                </button>

                <button class="btn-tab" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button">
                    Sản phẩm đã xem
                </button>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="same">
                    <div class="home-product-slider">
                        @for ($i = 0; $i < 7; $i++)
                            <div class="product-item" data-id="2">
                                <div class="product-item__wrap">
                                    <span class="p-discount" data-label="giảm nhiều "></span>
                                    <a href="san-pham-2" class="p-img" tabindex="0">
                                        <img data-lazy="storage/products/1698771600/1700795225_san-pham-2.jpg?v=1701159592"
                                            alt="sản phẩm 2">
                                    </a>
                                    <div class="p-text">
                                        <div class="p-star-group">
                                            <div class="p-star" data-rating="4">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
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
                </div>
                <div class="tab-pane" id="history">
                    <div class="home-product-slider">
                        @for ($i = 0; $i < 7; $i++)
                            <div class="product-item" data-id="1">
                                <div class="product-item__wrap">
                                    <span class="p-discount" data-label="giảm nhiều "></span>
                                    <a href="san-pham-1" class="p-img" tabindex="0">
                                        <img data-lazy="storage/products/1698771600/1700795225_san-pham-2.jpg?v=1701159592"
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
                </div>
            </div>

        </div>
    </section>
@endsection



@push('livecode-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush
@push('livecode-js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="template/front/js/product.js?v={{ time() }}"></script>
    <script>
        $('.spec-button-show').click(function (e) {
            Fancybox.show([{ src: "#dialog-spec", type: "clone" }]);
        });
        $('.video-thumb').click(function (e) {
            e.preventDefault();
            var src = $(this).attr('href');
            Fancybox.show([{
                src: src, width: 640, height: 360,
                },
            ]);
        });
    </script>
    <script>
        $('#myTab button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('.home-product-slider').slick('refresh');
            tooltipShow();
            $('.lazy').Lazy();
        });
    </script>
@endpush

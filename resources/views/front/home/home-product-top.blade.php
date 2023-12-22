<div class="home-product-top">
    <div class="nav justify-content-around btn-tabs" id="myTab" >
        <button class="btn-tab active" id="same-tab" data-bs-toggle="tab" data-bs-target="#same" type="button">
            <span class="text-head">Top sản phẩm</span>
            <span class="text-bottom">mới nhất</span>
        </button>

        <button class="btn-tab" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button">
            <span class="text-head">Top sản phẩm</span>
            <span  class="text-bottom">hot nhất</span>
        </button>

        <button class="btn-tab" id="topkm-tab" data-bs-toggle="tab" data-bs-target="#topkm" type="button">
            <span class="text-head">Top sản phẩm</span>
            <span  class="text-bottom">Khuyến mại</span>
        </button>
        <button class="btn-tab" id="topkm-tab" data-bs-toggle="tab" data-bs-target="#topkm" type="button">
            <span class="text-head">Top sản phẩm</span>
            <span class="text-bottom">Khuyến mại</span>
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

@push('livecode-js')
<script>
    $('#myTab button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('.home-product-slider').slick('refresh');
        tooltipShow();
    });
</script>
@endpush

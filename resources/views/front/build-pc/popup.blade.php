<div class="modal fade activeModal" id="popupBuild" data-bs-backdrop="static" >
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content"  >
        <div class="popup-header">
            <h5 class="popup-header__title res-mobile-none">Chọn linh kiện</h5>
            <div class="popup-header__wrap">
                <div class="popup-search">
                    <input type="text" placeholder="Bạn đang tìm thiết bị gì?">
                    <span class="btn-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
                <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
        <div class="modal-body popup-main" >
            <div class="popup-main__filter">
                <h4 class="filter__title" id="js-filter-close">
                    LỌC SẢN PHẨM THEO
                    <span class="res-desktop-none btn btn-xs btn-light">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </h4>
                <div class="overflow scrollbar-small">
                    @for ($i = 0; $i < 20; $i++)
                    <div class="filter-item">
                        <p class="filter-title"> hãng sản xuất {{ $i }}</p>
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
            </div>
            <div class="popup-main__content">
                <div class="box__paging-sort ">
                    <div class="box__sort">
                        <span>Sắp xếp: </span>
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
                        <div class="box__icon-filter res-desktop-none" id="js-btn-filter">
                            <i class="fa-solid fa-filter"></i> lọc
                        </div>
                    </div>

                    <div class="box__paging">
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
                </div>
                <div class="overflow" >
                    @for ($i = 0; $i < 20; $i++)
                        <div class="bc-item bc-item__popup">
                            <div class="bc-item-start">
                                <a target="_blank" href="/eee" >
                                    <img src="https://minhancomputercdn.com/media/product/75_4730_4730_cpu_amd_ryzen_5_5600x.jpg">
                                </a>
                            </div>
                            <div class="bc-item-end">
                                <a target="_blank" href="/cpu-amd-ryzen-5-5600x.html" class="bc-item__title">
                                    {{ $i }} CPU AMD Ryzen 5 5600X (3.7GHz up to 4.6GHz, 6 nhân, 12 luồng, 35MB Cache , 65W) - Socket AM4
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
                            </div>
                            <div class="bc-item-full">
                                <div class="bc-item__price">
                                    <span class="fw-bold me-2">1.399.000đ</span>
                                    <div class="d-flex align-items-center">
                                        <span class="btn-icon btn-icon-small me-2 pointer bg-primary ">
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                        <span class="btn-icon btn-icon-small me-2 pointer bg-secondary ">
                                            <i class="fa-solid fa-ban"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@push('livecode-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endpush
@push('livecode-js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        // var hasModal = $('#popupBuild').hasClass('activeModal');
        // if (hasModal) {
        //     var popupBuild = new bootstrap.Modal(document.getElementById('popupBuild'));
        //     popupBuild.show();
        // }

        $('#js-btn-filter').click(function (e) {
            $('.popup-main__filter').addClass('active');
            $('.popup-main__content').addClass('res-mobile-none');
        });
        $('#js-filter-close').click(function(e) {
            $('.popup-main__filter').removeClass('active');
            $('.popup-main__content').removeClass('res-mobile-none');
        });
    </script>
@endpush

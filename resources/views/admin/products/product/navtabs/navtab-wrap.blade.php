<div class="wrap-tab tab-column">

    <ul class="nav btn-tabs">
        <a class="btn-tab active" data-bs-toggle="tab" href="#home">TỔNG QUAN</a>
        <a class="btn-tab" data-bs-toggle="tab" href="#introduce">GIỚI THIỆU</a>
        <a class="btn-tab" data-bs-toggle="tab" href="#priceoption">GIÁ & TUỲ CHỌN</a>
        <a class="btn-tab" data-bs-toggle="tab" href="#article">BÀI VIẾT CHO SẢN PHẨM</a>
        <a class="btn-tab" data-bs-toggle="tab" href="#other">XEM VÀ ĐÁNH GIÁ</a>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="home">
            @include('admin.products.product.navtabs.navtab-home')
        </div>
        <div class="tab-pane container fade" id="introduce">
            @include('admin.products.product.navtabs.navtab-introduce')
        </div>
        <div class="tab-pane container fade" id="priceoption">
            @include('admin.products.product.navtabs.navtab-priceoption')
        </div>
        <div class="tab-pane fade" id="article">
            @include('admin.products.product.navtabs.navtab-article')
        </div>
        <div class="tab-pane fade" id="other">
            @include('admin.products.product.navtabs.navtab-other')
        </div>
    </div>
</div>

@push('livecode-js')
    <script>
        $(function() {
            var hash = window.location.hash;
            hash && $('.btn-tab[href="' + hash + '"]').tab('show');

            $('.btn-tabs a').click(function(e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });
        });
    </script>
@endpush

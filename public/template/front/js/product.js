Fancybox.bind('[data-fancybox="gallery"]', {});

$(".js-thumb").mouseover(function() {
    $(".js-thumb").removeClass("active");
    $(this).addClass("active")
    var src = $(this).attr("href");
    $("#js-large-image img").attr("src", src);
    $("#js-large-image a").attr("href", src);
});

function showmore(text) {
    $(`#js-showmore-${text}`).click(function() {
        $(`#js-${text}`).toggleClass("active");
        $(this).toggleClass("active");
        var has = $(this).hasClass('active');
        if (has) {
            $(this).html(`<span>Thu gọn </span> <i class="fa fa-angle-double-up"></i>`);
        } else {
            $(this).html(`<span>Xem thêm </span> <i class="fa fa-angle-double-down"></i>`);
        }
    });
    if ($(`#js-height-${text}`).height() < 150) {
        $(`#js-showmore-${text}`).addClass('d-none');
        $(`#js-${text}`).addClass('active');
    }
}
showmore('summary');
showmore('article');

function listenQuantityChange() {
    var $track_change = $(".js-quantity-change");

    //thay doi so luong sp mua, neu nhap so luong
    $track_change.on("change", function(e) {
        var value = parseInt($(this).val());

        if (Math.floor(value) == value && $.isNumeric(value) && parseInt(value) > 0) {} else $(this).val(1);
    });

    //thay doi so luong sp theo - hoac +
    $track_change.on("click", function(e) {
        if (e.target.nodeName === 'INPUT') return;

        var quantity_change = parseInt(this.getAttribute("data-value"));
        var current_quantity = parseInt($(".js-buy-quantity").val());
        var quantity_stock = 999;

        //loai bo so luong vo ly
        if (current_quantity + quantity_change < 1 && 1 < 2) {
            $(".js-buy-quantity").val(1);
            return;
        }

        if (current_quantity + quantity_change > quantity_stock) {
            alert("Bạn được mua tối đa " + quantity_stock + " sản phẩm này");
            $(".js-buy-quantity").val(quantity_stock);
            return;
        }
        $(".js-buy-quantity").val(current_quantity + quantity_change);
    });
}
listenQuantityChange();

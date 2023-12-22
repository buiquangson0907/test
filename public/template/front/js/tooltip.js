function jstooltip(e) {
    var w_tooltip = $("#js-tooltip").width() + 35;
    var h_tooltip = 0;
    var pad = 10;
    var x_mouse = 0; var y_mouse = 0;
    var wrap_right = 0;
    var wrap_top = 0;
    var wrap_bottom = 0;
    wrap_top = $(window).scrollTop();
    wrap_bottom = $(window).height();
    wrap_right = $(window).width();
    x_mouse = e.pageX;
    y_mouse = e.pageY;
    h_tooltip = $("#js-tooltip").height();
    if (x_mouse + w_tooltip > wrap_right) {
        $("#js-tooltip").css("left", x_mouse - w_tooltip - pad);
    } else {
        $("#js-tooltip").css("left", x_mouse + pad);
    }
    if (y_mouse - h_tooltip < wrap_top) {
        $("#js-tooltip").css("top", wrap_top);
    } else {
        $("#js-tooltip").css("top", y_mouse - h_tooltip - pad);
    }
    $("#js-tooltip").show();
}
function currency_vn(number) {
    var formattedNumber = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
    return formattedNumber;
}
function content(data) {
    return `
    <div class="pro-name">${data.name}</div>
    <div class="pro-content">
        <ul class="tooltip-main-content">
            <li>
                <b>Giá bán:</b>
                <span class="text-20">${currency_vn(data.price)}</span>
            </li>

            <li>
                <b>Giá niêm yết: </b>
                <del class="text-14">${currency_vn(data.cost)}</del>
            </li>
            <li>
                <b>Bảo hành:</b>
                ${data.warranty ? data.warranty : 0} tháng
            </li>

            <li>
                <b>Tình trạng:</b>
                ${data.quantity > 0 ? '<span class="stocking">Còn hàng</span>' : '<span class="out-of-stocking">Liên hệ</span>'}
            </li>
        </ul>

        <div class="tooltip-content-group">
            <p class="title">
                <i class="fa-solid fa-qrcode"></i>
                <span>Thông số sản phẩm</span>
            </p>

            <div class="list">
                ${data.specifications ? data.specifications : 'chưa có thông tin'}
            </div>
        </div>

        <div class="tooltip-content-group">
            <p class="title">
                <i class="fa-solid fa-gift"></i>
                <span>Chương trình khuyến mãi</span>
            </p>

            <div class="list">
                ${data.offer ? data.offer : 'chưa có thông tin'}
            </div>
        </div>
    </div>
    `;
}
function tooltipShow() {
    var hasMouseMoved = false;
    var oldid = false;
    $(".product-item .p-img").mousemove(function (event) {
        if ($(this).parents(".product-item").find(".product-tooltip").length == 0) {
            return false;
        }

        var $element = $(this);
        var id = $element.parents(".product-item").data('id');
        if (!hasMouseMoved && oldid != id) {
            $.ajax({
                type: "GET",
                url: `ajaxTooltip/${id}`,
                success: function (response) {
                    setTimeout(function () {
                        content_tooltip = $element.parents(".product-item").find(".product-tooltip").html(content(response));
                        $("#js-tooltip").html(content_tooltip.html());
                    }, 50);
                },
                error: function () {
                    // alert('rê chuột quá nhanh');
                }
            });
        }
        oldid = id;
        hasMouseMoved = true;
        jstooltip(event);

    });

    $(".product-item .p-img").mouseout(function () {
        $("#js-tooltip").hide();
        hasMouseMoved = false;
    });
}
tooltipShow();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("img").on("error", function() {
    $(this).hide();
  });
$(function() {
    $('.lazy').Lazy({
        delay: 100,
    });
});
/* header */
$(function(){
    // input search
    $('body').on('keypress','#js-global-search',function (e) {
        $('.header-search__automplete').css('display', 'block');
    });
    $('body').on('click', function(e) {
        if (!$(e.target).closest($('.header-search')).length) {
            $('.header-search__automplete').css('display', 'none');
        }
    });
    $(window).scroll(function () {
        if($(window).scrollTop() > $('.mobile-header__top').height()) {
            $(".mobile-header__top").addClass('header-fixed');
            $('.mobile-header__search').addClass('has-header-fixed');
        }
        else {
            $(".mobile-header__top").removeClass('header-fixed');
            $('.mobile-header__search').removeClass('has-header-fixed');
        }
    });
});

$(function(){
    var topHeight = $('header').outerHeight();
    var nodeHeight = $('.nav-banner').innerHeight();
    var scrollHeight = topHeight + nodeHeight;
    var maxHeight = `${nodeHeight}px`;
    var btnHeight  = `5px`;
    var fixedHeight = $('.header-main').height();
    if (!nodeHeight) {
        nodeHeight = $('.header-scroll').outerHeight();
        scrollHeight = topHeight + nodeHeight;
        maxHeight = `calc(100vh - 15px - ${scrollHeight}px)`;
        btnHeight = `${nodeHeight + 10}px`;
        fixedHeight = $('.header-main').height() + 5;
    }
    $('.global-menu__list').css({'min-height': '0px','max-height': `${maxHeight}`});
    $('.sub-menu').css({'height': `calc(100vh - ${btnHeight} - ${topHeight}px)`});

    $(window).scroll(function () {
        if($(window).scrollTop() > scrollHeight) {
            $(".header-main").addClass('header-fixed');
            $(".global-menu").addClass('fixed');
            $('.global-menu__list').css({'max-height': `calc(100vh - 5px - ${fixedHeight}px)`});
            $('.sub-menu').css({'height': `calc(100vh - ${fixedHeight}px)`});
        }
        else {
            $(".header-main").removeClass('header-fixed');
            $(".global-menu").removeClass('fixed');
            $('.global-menu__list').css({'min-height': '0px','max-height': `${maxHeight}`});
            $('.sub-menu').css({'height': `calc(100vh - ${btnHeight} - ${topHeight}px)`});
        }
    });

    if ($(window).width() < 769) {
        $('.global-menu__list').css({'max-height': 'unset'});
        $('.sub-menu').css({'height': 'unset'});
    }
});


// sub menu mobile
$('.item-cart').clone(true).appendTo('.mobile-header__btncart');
$('.header-search').clone(true).appendTo('.mobile-header__search');
$('.banner-slider').clone(true).appendTo('.mobile-banner');
$('.global-menu__list').clone(true).appendTo('.mobile-menu .global-menu__wrap');
$(function(){
    var flagmenu;
    $(document).on('click', function(e) {
        var container = $(".mobile-menu");
        if (!$(e.target).closest($(".mobile-menu")).length && flagmenu == 0) {
            container.removeClass('show');
        }
        flagmenu = 0;
    });
    $('.toggle-menu').on('click', function(params) {
        $('.mobile-menu').addClass('show');
        flagmenu = 1;
    });
    $('.icon-close').click(function (e) {
        e.preventDefault();
        $('.mobile-menu').removeClass('show');
    });
    $('.js-show-cat-menu').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('fa-angle-down')) {
            $(this).removeClass('fa-angle-down');
            $(this).parent('.js-cat-item').find('.sub-menu').slideUp("fast");
        }else{
            $(this).addClass('fa-angle-down');
            $(this).parent('.js-cat-item').find('.sub-menu').slideDown("fast");
        }
    });
    $('.js-cat-2').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('fa-angle-down')) {
            $(this).removeClass('fa-angle-down');
            $(this).parent('.js-cat-2-block').find('.sub-menu-2').slideUp("fast");
        }else{
            $(this).addClass('fa-angle-down');
            $(this).parent('.js-cat-2-block').find('.sub-menu-2').slideDown("fast");
        }
    });
});

if (!$('.global-menu').hasClass('active-menu__home')) {
    $('.mobile-header__toplist').css({
        'display': 'none'
    });
}

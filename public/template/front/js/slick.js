$(function() {

    $('.banner-slider').slick(
        {
            lazyLoad: 'ondemand',
            dots: false,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        arrows: false
                    }
                }
            ]
        }
    );
    $('.home-product-slider').slick(
        {
            lazyLoad: 'ondemand',
            dots: true,
            autoplay: false,
            autoplaySpeed: 10000,
            slidesToShow: 5,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        arrows: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        arrows: false
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                    }
                }
            ]
        }
    );

    $('.slider-page').slick(
        {
            lazyLoad: 'ondemand',
            dots: false,
            autoplay: true,
            autoplaySpeed: 10000,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false
        }
    );
})

$(function () {
    $('.partners-slider__slider').slick({
        infinite: true,
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: ".partners-slider .arrow-prev",
        nextArrow: ".partners-slider .arrow-next",
        responsive: [

            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                    infinite: true,
                }
            }
        ]

    });


    $('.juri__block').slick({
        infinite: true,
        dots: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 9999,
                settings: "unslick"
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false,
                    infinite: true,
                }
            }
        ]

    });

    $('.burger').not('.active').click(function () {
        var nav = $('.mobile-nav-wrapper');
        var burger = $('.burger');
        nav.slideToggle().toggleClass('active');
        $(this).toggleClass('active');

//        $(document).mouseup(function (e) {
//
//            if (!nav.is(e.target) && !nav.is(e.target) && nav.has(e.target).length === 0) {
//                nav.slideUp().removeClass('active');
//            }
//        });

    });
    
    $('.filter__name').click(function(){
        $(this).siblings('.filter__items').slideToggle();
    })

    $('.mobile-nav-wrapper').find('.close').click(function () {
        $('.mobile-nav-wrapper').slideUp().removeClass('active');
        $('.burger').removeClass('active');
    })
    
    $('.filter__item').click(function(){
        $('.filter__items').slideUp();
    })

});

// $(window).on('load', function() {
//     flexsliderStart();
// });

function flexsliderStart() {
    $('.flexslider').flexslider({
    animation: "slide",
    });
}

// $('.project-gallery__item').on('click', function() {
//     flexsliderStart();
// });


$(document).ready(function() {
    $('.filter-buttons__mobile').on('click', function() {
        $('.filter-board').slideToggle();
    });
});


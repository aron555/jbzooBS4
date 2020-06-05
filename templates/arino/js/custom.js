jQuery(function ($) {
    

    $("#orderblock").on('change', function () {
        document.location.href = $(this).val();
    });


    $(document).ready(function () {
        $('.slick').slick({
            lazyLoad: 'ondemand',
            dots: false,
            arrows: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]

        });
    });

    $('.effect-chico')
        .on('mouseenter', function () {
            $(this).children('img').toggleClass('animated pulse');
        })
        .on('mouseout', function () {
            $(this).toggleClass('animated pulse');
        })
    ;
});

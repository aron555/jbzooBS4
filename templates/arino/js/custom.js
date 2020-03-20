jQuery(function ($) {

    $('[data-jplist-control="radio-buttons-text-filter"]').on('change', function () {
        let a = $('body').find('[data-jplist-control="no-results"]'),
            b = $('body').find('[data-jplist-control="pagination"]');
        a.css("display") === 'block' ? b.removeClass('d-flex').addClass('d-none') : b.removeClass('d-none').addClass('d-flex');
    });

    //lazy
    yall({
        observeChanges: true
    });


    $("#orderblock").on('change', function () {
        document.location.href = $(this).val();
    });

    $("body").on("click mouseenter", ".dropdown-convey-width-2", function () {
        var b = $(this),
            e = $("body").find(".mezhkomnatnye-dveri").outerWidth(),
            f = b.find(".dropdown-menu-2");

        f.css("left", -e);
    });


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
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
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

    $('.effect-chico')
        .on('mouseenter', function () {
            $(this).children('img').toggleClass('animated pulse');
        })
        .on('mouseout', function () {
            $(this).toggleClass('animated pulse');
        })
    ;

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});

jQuery(function ($) {

    const button = $(".dropdown-categories"); // Класс кнопки для открытия дропдауна (прописывается в модуле)

    const zooListMegamenuRight = $(".smuzi-megamenu-right .zoo-list-megamenu"); //

    if ($(button)) {

        var delay = 200, setTimeoutConst, // Задержка при наведении
            delayOut = 200, setTimeoutConstOut; // Задержка при уходе мыши

        $(button)
            .on('click mouseenter', function () { // Показываем список первой категории
                var lvl2 = $(zooListMegamenuRight).children('.zoo-list-megamenu:first-child');
                var lvl3 = $(lvl2).children('.zoo-list-megamenu');
                $(lvl2).addClass('d-block');
                $(lvl3).addClass('d-block');
            })
            /*.on('mouseout', function () { // При уходе мыши со списка

                clearTimeout(setTimeoutConst);

                $(document).on('click', function (e) { // Скрываем список при клике, если клик был вне кнопки, вне списка
                    if (!$(button).is(e.target) && !$(zooListMegamenuRight).is(e.target) && $(zooListMegamenuRight).has(e.target).length === 0) {
                        $(zooListMegamenuRight).children('.zoo-list-megamenu').removeClass('d-block');
                    }
                    ;
                });
            })*/
        ;

    }


    /*$('.zoo-list-megamenu .dropdown-item.dropdown-submenu.parent').on('click mouseenter', function (e) {
        if (!$(this).children(".inner").children('dropdown-menu').hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).children(".inner").children(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parents('.show').on('hidden.bs.dropdown', function (e) {
            $('.zoo-list-megamenu .dropdown-menu .show').removeClass("show");
        });

    });*/


    //let list = $('.zoo-list'); // Класс оболочки списка категории (в шаблоне модуля)
    //let containerWidth = $('.container').width(); // Ширина контейнера для дропдауна
    //$(list).css("width", containerWidth); // Задаем ширину списку равной ширине родительского контейнера (не всей ширине экрана)


});
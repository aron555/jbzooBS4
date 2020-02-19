jQuery(function($){

    $('.dropdown-menu a.dropdown-toggle').on('mouseenter', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parents('.show').on('hidden.bs.dropdown', function(e) {
            $('.zoo-list .dropdown-submenu .show').removeClass("show");
        });

        return false;
    });

});
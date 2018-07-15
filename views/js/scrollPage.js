$(function() {
    'use strict';

    /* При прокрутке страницы фиксировать верхнее меню */
    $(".top-menu-navigation").removeClass("default");

    var $body = $( 'body' );

    // Фикcированная шапка при скролле
    $(window).scroll(function() {

        if ( $body.width() >= 767 ) {
            if ( $( this ).scrollTop() > 20 ) {
                $( '.top-menu-navigation' ).addClass( 'default' ).fadeIn('fast');
            } else {
                $( '.top-menu-navigation' ).removeClass( 'default' ).fadeIn('fast');
            };
        }
        
    }); // конец события scroll

    /* При прокрутке страницы фиксировать стрелку-кнопку вверх */
    $( '.goTop' ).fadeOut( 'slow' );

    // Показывать или не показывать кнопку вверх
    $(window).scroll(function(){
        if ( $(this).scrollTop() > 200 ) {
            $( '.goTop' ).fadeIn( 'slow' );
        } else {
            $( '.goTop' ).fadeOut( 'slow' );
        };
    }); // конец события scroll

    /* Плавный переход ( скролл ) к элементам */
    $('a[href^="#"]').mPageScroll2id({
        offset: 80,
        scrollSpeed: 1500,
        pageEndSmoothScroll: true
    });

});
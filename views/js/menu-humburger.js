$(document).ready(function() {
	
	'use strict';
	/* ==== Реализация выдвигающегося гамбургер меню ==== */

	var $humburger 			= $( '.menu-toggle-humburger' ),
		$humburgerIcon 		= $( '.menu-toggle-humburger div' ),
		$slideMenu 			= $( '.slide-menu' ),
		$elementsListMenu 	= $('.slide-menu ul li').not( '.slide-menu ul li:first' ),
		menuIsOpen 			= false; // флаг, для проверки на состояние меню

	/**
	 * Изменяет состояние гамбургер меню с открытого на закрытый и наоборот
	 * @param  { object } elementMenu — Элемент меню
	 * @param  { object } elementIcon — Иконка, которая будет меняться взависимости от состояния меню
	 * @return { void }
	 */
	var changeStateMenu 	= function( elementMenu, elementIcon ) {

		menuIsOpen 			= !menuIsOpen; // изменяем флаг

		elementMenu.toggleClass('menu-open');

		if (menuIsOpen) {
			elementIcon.removeClass('humburger')
				.addClass('close-humburger');
		} else {
			elementIcon.removeClass('close-humburger')
				.addClass('humburger');
		}

	}

	$humburger.click(function( event ) {
		changeStateMenu( $slideMenu, $humburgerIcon );
	}); // конец события click

	$elementsListMenu.hover(function() {
		if (!menuIsOpen) {
			$(this).toggleClass('li-open');
		}
	}, function() {
		if (!menuIsOpen) {
			$(this).toggleClass('li-open');
		}
	}); // конец события hover

}); // конец события ready
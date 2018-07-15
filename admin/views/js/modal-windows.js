$(document).ready(function() {
	'use strict';
	
	var $modalWindow = $( '.modal-container' ), // модульное окно регистрации
		$modalLogIn = $(".modal-login-container"), // модульное окно входа
		$btnRegistragion = $( '.registration' ), // кнопка регистрации
		$btnLogIn = $('.login'), // кнопка входа
		$btnCloseModal = $( '.modal-header i, .close-modal' ); // кнопки закрытия модального окна

	/**
	 * Функция, создающая анимацию перехода от одной формы к другой
	 * @param  {object} $step Изменяющаяся нижняя часть формы
	 * @param  {object} $pag  Индикатор, показывающий номер текущего шага
	 * @return {void}
	 */
	function step1( $step, $pag ) {
	  // animate the step out
	  $step.addClass( 'animate-out' );
	  
	  // animate the step in
	  setTimeout(function() {
	    $step.removeClass( 'animate-out is-showing' )
	         .next().addClass( 'animate-in' );
	    $pag.removeClass( 'is-active' )
	          .next().addClass( 'is-active' );
	  }, 600);
	  
	  // after the animation, adjust the classes
	  setTimeout(function() {
	    $step.next().removeClass('animate-in')
	          .addClass('is-showing');
	    
	  }, 1200);
	}

	/**
	 * Функция, создающая анимацию для последнего шага, т.е. выхода из формы
	 * Также сбрасываются все настройки
	 * @param  {object} $step Изменяющаяся нижняя часть формы
	 * @param  {object} $pag  Индикатор, показывающий номер текущего шага
	 * @return {void}
	 */
	function step3( $step, $pag ) {

		  // animate the step out
		  $step.parents( '.modal-wrap' ).addClass( 'animate-up' );

		  $step.removeClass( 'animate-out is-showing' );
		  $pag.removeClass( 'is-active' );
	}

	/**
	 * События клика по кнопки РЕГИСТРАЦИЯ на выдвигающемся меню
	 * @param  {[type]} event } Объект события
	 * @return {void} Событие ничего не возвращает
	 */
	$btnRegistragion.click(function( event ) {
		$modalWindow.css( 'display', 'block' );

		$('.modal-wrap').removeClass('animate-out').addClass('animate-in');

		setTimeout(function() {
	  	var $step 	= $( '.modal-body-step-1' ),
	      	$pag 	= $( '.modal-header span' ).eq(0);

	    $step.addClass( 'animate-in' )
	    	.addClass( 'is-showing' );
	    $pag.addClass( 'is-active' );
	  }, 600);

	}); // конец события click

	/**
	 * События клика по кнопки ВОЙТИ на выдвигающемся меню
	 * @param  {[type]} event } Объект события
	 * @return {void} Событие ничего не возвращает
	 */
	$btnLogIn.click(function( event ) {
		$modalLogIn.css( 'display', 'block' );

		$('.modal-wrap').removeClass('animate-out').addClass('animate-in');

		setTimeout(function() {
		  	var $step 	= $( '.modal-body-step-1' ),
		      	$pag 	= $( '.modal-header span' ).eq(0);

		    $step.addClass( 'animate-in' )
		    	.addClass( 'is-showing' );

		    $pag.addClass( 'is-active' );
		}, 600);

	}); // конец события click

	/**
	 * Событие нажатия на кнопки закрытия модального окна
	 * @param  {[type]} event } Объект события
	 * @return {void}
	 */
	$btnCloseModal.click(function( event ) {
		var $step = $( '.modal-body-step-1, .modal-body-step-2, .modal-body-step-3' ),
	      	$pag = $( '.modal-header span' );


		$( '.modal-wrap' ).removeClass('animate-in').addClass('animate-out');

		setTimeout(function() {
			$modalWindow.css('display', 'none');
			$modalLogIn.css('display', 'none');
			$step.removeClass('animate-out is-showing');
		  $pag.removeClass('is-active');

		  $step.removeClass('animate-out is-showing');
		  $pag.removeClass('is-active');
		}, 0);
	}); // конец события click

	/**
	 * Событие, срабатывающее по нажатию на кнопку ДАЛЕЕ в первом окне формы
	 * @return {void}
	 */
	$('.first-next-btn.log-in').click(function( event ) {

		var $step 		= $( '.modal-body-step-1' ),
	        stepIndex 	= $step.index(),
	        $pag 		= $( '.modal-header span ').eq( stepIndex );

	    $step.removeClass( 'animate-in' )
	    	 .addClass( 'animate-out' );
	    	 
	}); // конец события click

	/* ==== Форма для регистрации ==== */

	/**
	 * Событие, срабатывающее по нажатию на кнопку ДАЛЕЕ в первом окне формы
	 * @param  {[type]} event } Объект события
	 * @return {void}
	 */
	$( '#get_important_data' ).click(function( event ) {
		var $step = $( '.modal-body-step-1' ),
		    stepIndex = $step.index(),
		    $pag = $( '.modal-header span' ).eq( stepIndex );

    	$step.removeClass( 'animate-in' )
    		 .addClass( 'animate-out' );
	}); // конец события click

	/**
	 * Событие, срабатывающее по нажатию на любую кнопку в окне формы регистрации
	 * @return {void}
	 */
	$( '.button' ).click(function( event ) {
		//event.preventDefault();

		var $btn 			= $(this),
		    $step 			= $btn.parents( '.modal-body' ), 
		    stepIndex 		= $step.index(),
		    $pag 			= $( '.modal-header span' ).eq(stepIndex),
			$inputs 		= $step.children( 'input' );

		if ( stepIndex === 0 || stepIndex === 1 ) {
	  		step1( $step, $pag );
		} else {
		  	step3( $step, $pag );
		}
	}); // конец события click

	/* ==== КОНЕЦ: Форма для регистрации ==== */

}); // конец события ready
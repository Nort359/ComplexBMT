$(function() {
	'use strict';
	
	/**
	 * Проверяет валидность содержимого input по переданному регулярному выражению
	 * @param  { object } $elements    Input'ы, которые нужно проверять на валидность
	 * @param  { object } pattern      Регулярное выражение, по которому производится проверка
	 * @param  { string } successColor Цвет input при правильно введенных данных
	 * @param  { string } errorColor   Цвет input при НЕ правильно введенных данных
	 * @return { bool }                True — если всё прошло успешно, False — если при работе функции произошла ошибка
	 */
	function checkValidInputByBlur( $elements, pattern, successColor, errorColor ) {

		// Прекращаем выполнение функции, если не былы переданы два следующих параметра
		if ( $elements === null ) {
			return false;
		}

		if ( pattern === null ) {
			return false;
		}

		// Значения цветов по умолчанию
		if ( typeof( successColor ) !== 'string'
		  || successColor === null ) {
			successColor = '#53B73F';
		}

		if ( typeof( errorColor ) !== 'string'
		  || errorColor === null ) {
			errorColor = '#ff0000';
		}

		$elements.blur(function() {
	        if ( $( this ).val() !== '' ) {
	            // Поле email заполнено (здесь будем писать код валидации)
	            //var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

	            if ( pattern.test( $( this ).val() ) ) {
	                $( this ).css( { 'border' : '2px solid ' + successColor } );
	                //$( '#valid' ).text( 'Верно' );
	            } else {
	                $( this ).css( { 'border' : '2px solid ' + errorColor } );
	                //$( '#valid' ).text( 'Не верно' );
	            }

	        } else {
	            // Поле email пустое, выводим предупреждающее сообщение
	            $( this ).css( { 'border' : '2px solid ' + errorColor } );
	            //$( ' #valid' ).text( 'Поле email не должно быть пустым' );
	        }
	    }); // конец события blur

	    return true;

	}

	/**
	 * Проверка валидности введённого символа при нажатии клавиши ( событие keypress )
	 * @param  { object } $elements Input'ы, которые нужно проверять на валидность
	 * @param  { object } pattern   Регулярное выражение, по которому производится проверка
	 * @return { bool }           	True — если всё прошло успешно, False — если при работе функции произошла ошибка
	 */
	function preventInputChars( $elements, pattern, toolTipMessage ) {

		// Прекращаем выполнение функции, если не былы переданы два следующих параметра
		if ( $elements === null ) {
			return false;
		}

		if ( pattern === null ) {
			return false;
		}

		// Значения цветов по умолчанию
		if ( typeof( toolTipMessage ) !== 'string'
		  || toolTipMessage === null ) {
			toolTipMessage = 'В этом поле доступны только кирилические символы';
		}

    	$elements.keypress(function( event ) {

	    	if (event.keyCode <= 32) return null; // спец. символ

	    	if ( String.fromCharCode( event.keyCode ).search( pattern ) === -1 ) {
	    		$( this ).attr({
	    			dataToggle: 'tooltip',
	    			dataPlacement: 'bottom',
	    			title: toolTipMessage
	    		});

	    		$( this ).tooltip('show'); // Активирует работу tooltip`ов

	    		return false;
	    	} else {
	    		$( this ).tooltip('hide');
	    	}

	    	return true;

	    }); // конец события keypress

    }
	
	var patternEmail = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i,

		$names 		= $( 'input[ name *= surname ],'
	    			   + 'input[ name *= name ],'
	    			   + 'input[ name *= otch ],'
	    			   + 'input[ name *= otchestvo ]' ),

		$logins 	= $( 'input[ name *= login ]' ),

		$phones 	= $( 'input[ name *= phone ]' );
	
	checkValidInputByBlur( $( 'input[ type = email ]' ), patternEmail );

	checkValidInputByBlur( $names, /[a-zA-Zа-яА-Я]/i );

    preventInputChars( $names, /[а-яА-Я]/i );

    preventInputChars( $logins, /[a-zA-Z0-9]/i, 'Для данного поля доступны только символы латинского алфавита и цифры 0-9' );

    preventInputChars( $phones, /[0-9+]/i, 'Размер данного поля не должен превышать 12 символом и допускает для ввода только цифры 0-9 и символ "+"' );

}); // конец события ready
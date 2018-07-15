$(document).ready(function() {
	'use strict';
	
	/* ==== AJAX запрос на отправки заявки в базу данных по кнопке ОТПРАВИТЬ ==== */
	
	$('#make-statement').click(function( event ) {
		event.preventDefault();

		$.post('/functions/put_ajax_statement.php',
			{
				userSurname: 		$( '#user-surname' ).val(),
				userName: 			$( '#user-name' ).val(),
				userOtch: 			$( '#user-otch' ).val(),
				userBirthDay: 		$( '#user-birthday' ).val(),
				emailUser: 			$( '#user-email' ).val(),
				userPhone: 			$( '#user-phone' ).val(),
				userOrganization: 	$( '#user-organization' ).val(),
				userCompitation: 	$( '#user-compitation' ).val()
			},
			function( data, textStatus, xhr ) {
				var $resultMessage = $( '.query-is-success' ), // место для текста об успехе или неудаче
					icon,// тип иконки уведомления
					iconClass;

				if ( data === '<p class="large-text" style="color: #53B73F;">Вы успешно записались на конкурс</p>' ) {
					icon = 'glyphicon glyphicon-ok';
					iconClass = 'success-flash-message';
				} else {
					icon = 'glyphicon glyphicon-remove';
					iconClass = 'error-flash-message';
				}
				// Создание разметки для уведомления о ошибке записи или успехе
				var message = 	'<div class="alert-element">'
				              +		'<div class="icon ' + iconClass + '"><i class="' + icon + '"></i></div>'
				              +		'<div class="text"><span>' + data + '</span></div>'
				              +	'</div>';

				$resultMessage.css( 'display', 'none' )
							  .empty()
							  .append( message )
							  .fadeIn();

				var $notification 		= $( '.alert-element' );

				setTimeout(function() {
					$notification.toggleClass( 'is-active' );
				}, 500);

				// Закрываем сообщение через 15 секунд
				setTimeout(function() {
					$resultMessage.fadeOut( 1000 );
				}, 15000);

			});
	}); // конец события клик по кнопке ОТПРАВИТЬ

	/* ==== КОНЕЦ: AJAX запрос на отправки заявки в базу данных по кнопке ОТПРАВИТЬ  ==== */

}); // конец события ready
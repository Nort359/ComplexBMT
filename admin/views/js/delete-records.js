$(document).ready(function() {
	
	/**
	 * Узнаёт хочет ли пользователь удалить запись
	 * @param  { object } $deleteContainer — Контейнер для ссылки на удаление
	 * @param  { string } message          — Сообщения для пользовтеля
	 * @return { bool }                  	 TRUE если всё прошло удачно, иначе FALSE
	 */
	function delete_record( $deleteContainer, message ) {

		// Проверка переданных параметров функции
		if ( $deleteContainer === null || typeof( $deleteContainer ) !== 'object'
		  || message === null || typeof( message ) !== 'string' ) {
			return false
		}

		$deleteContainer.click(function( event ) {

			event.preventDefault();

			var to = $( this ).children( 'a' ).attr( 'href' );
			
			if ( confirm( message ) === true ) {
				window.location = to;
			}

		}); // конец события click

		return true;

	}

	// Подтверждение удаления эксперта
	delete_record( $( '.expert-delete' ), 'Вы действительно жеаете удалить этого эксперта?' );

	// Подтверждение удаления документа у текущей компитенции
	delete_record( $( '.doc-delete' ), 'Вы действительно жеаете удалить этот документ?' );

	// Подтверждение удаления текущей компитенции
	delete_record( $( '.delete-compitation' ), 'Вы действительно жеаете удалить эту компитенцию?' );
	
	// Подтверждение удаления текущей компитенции
	delete_record( $( '.block-delete' ), 'Вы действительно жеаете удалить этот информационный блок?' );

}); // конец события ready
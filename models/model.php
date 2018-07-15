<?php

	if ( !defined( 'ABLE' ) ) {
		die( 'Доступ к контенту данной страницы запрещён' );
	}

	/**
	 * Регистрация нового админа
	 * @return [ void ]
	 */
	function put_admin_db() {
		$admins 						= R::dispense( 'admins' );
		
		$admins->surname 				= $_POST[ 'admin-surname' ];
		$admins->name 					= $_POST[ 'admin-name' ];
		$admins->otchestvo 				= $_POST[ 'admin-otch' ];
		$admins->email 					= $_POST[ 'admin-email' ];
		$admins->login 					= $_POST[ 'admin-login' ];
		$admins->password 				= password_hash( $_POST[ 'admin-password' ], PASSWORD_DEFAULT );
		$admins->admin 					= false;

		R::store( $admins );
	}

	/**
	 * Помещение нового информационного блока в Базу Данных
	 * @param  [ string ] $path — Путь к файлу, который будет храниться в БД
	 * @return [ void ]
	 */
	function add_new_information_block( $path ) {

		$information_block 						= R::dispense( 'informationblock' );
		
		$information_block->title 				= $_POST[ 'information-block-title' ];
		$information_block->short_description 	= $_POST[ 'information-block-short-description' ];
		$information_block->description 		= $_POST[ 'information-block-description' ];

		$information_block->path 				= $path;

		R::store( $information_block );
	}

	/**
	 * Помещение нового информационного блока в Базу Данных
	 * @param  [ int ] 	  $id   — ID информационного блока, который необходимо изменить
	 * @param  [ string ] $path — Путь к файлу, который будет храниться в БД
	 * @return [ void ]
	 */
	function update_information_block( $id, $path ) {

		$information_block 						= R::load( 'informationblock', $id );
		
		$information_block->title 				= $_POST[ 'information-block-title' ];
		$information_block->short_description 	= $_POST[ 'information-block-short-description' ];
		$information_block->description 		= $_POST[ 'information-block-description' ];

		if ( !empty( $path ) ) {
			$information_block->path 			= $path;
		}

		R::store( $information_block );
	}

	/**
	 * Удаляет информационный блок из БД
	 * @param  [ int ] 	$id — ID документа, который нужно удалить
	 * @return [ bool ] 	  TRUE, если удалось удалить информационный блок из БД, FALSE, если нет
	 */
	function delete_current_block( $id ) {
		if ( !$id ) {
			return false;
		}

		$document = R::load( 'informationblock', $id );

		R::trash( $document );

		return true;
	}

    /**
     * Получает список всех информационных блоков из Базы Данных
     * @return array [ array ] Возвращает массив всех информационных блоков
     */
	function get_all_information_block() {
		return R::findAll( 'informationblock' );
	}

    /**
     * Получает список всех компетенций из Базы Данных
     * @param  [ int ]      $id — ID блока, который необходимо изменить
     * @return \RedBeanPHP\OODBBean [ array ]        Возвращает массив текущего блока
     */
	function get_current_block( $id ) {
		return R::findOne( 'informationblock', 'id = ?', [ $id ] );
	}

	/**
	 * Помещение новой компетенции в Базу Данных
	 * @param  [ string ] $path — Путь к файлу, который будет храниться в БД
	 * @return [ int ] 			  Возвращает id добавленной записи
	 */
	function add_new_compitation( $path ) {
		$compitation 					= R::dispense( 'compitation' );
		
		$compitation->title 			= $_POST[ 'compitation-title' ];
		$compitation->short_description = $_POST[ 'compitation-short-description' ];
		$compitation->description 		= $_POST[ 'compitation-description' ];

		if ( !empty( $_POST[ 'compitation-date-begin' ] ) ) {
			$compitation->date_begin 		= $_POST[ 'compitation-date-begin' ];
		}

		if ( !empty( $_POST[ 'compitation-date-end' ] ) ){
			$compitation->date_end 			= $_POST[ 'compitation-date-end' ];
		}

		$compitation->path 				= $path;

		return R::store( $compitation ); // Возвращаем id записи
	}

	/**
	 * Получает список всех компетенций из Базы Данных
	 * @return [ array ] Возвращает массив всех компетенций
	 */
	function get_all_compitations() {
		return R::findAll( 'compitation' );
	}

	/**
	 * Получает список всех компетенций из Базы Данных
	 * @param  [ int ] 	  $id — ID компетенции, которую необходимо изменить
	 * @return [ array ] 	   	Возвращает массив текущей компетенции компетенций
	 */
	function get_current_compitation( $id ) {
		return R::findOne( 'compitation', 'id = ?', [ $id ] );
	}

	/**
	 * Помещение новой компетенции в Базу Данных
	 * @param  [ int ] 		$id   	— ID компетенции, которую следует обновить
	 * @param  [ string ] 	$path 	— Путь к файлу, который будет храниться в БД
	 * @param  [ array ] 	$compit — Массив всех компетенций
	 * @return [ int ] 				  Возвращает id добавленной записи
	 */
	function update_exist_compitation( $id, $path, $compit ) {
		$compitation 						= R::load( 'compitation', $id );

		$compitation->title 				= $_POST[ 'compitation-title' ];
		$compitation->short_description 	= $_POST[ 'compitation-description' ];
		$compitation->description 			= $_POST[ 'compitation-description' ];
		
		if ( !empty( $_POST[ 'compitation-date-begin' ] ) ) {
			$compitation->date_begin 		= $_POST[ 'compitation-date-begin' ];
		}

		if ( !empty( $_POST[ 'compitation-date-end' ] ) ){
			$compitation->date_end 			= $_POST[ 'compitation-date-end' ];
		}

		if ( !empty( $path ) ) {
			$compitation->path 				= $path;
		}

		return R::store( $compitation ); // Возвращаем id записи
	}

	/**
	 * Удаляет компетенцию из БД
	 * @param  [ int ] 	$id — ID компетенции, которую нужно удалить
	 * @return [ bool ] 	  TRUE, если удалось удалить компетенцию из БД, FALSE, если нет
	 */
	function delete_compitation( $id ) {
		if ( !$id ) {
			return false;
		}

		// Для начала следует удалить все связанные с компетенцией документы
		R::exec( "DELETE FROM documents WHERE compitation_id = $id" );
		R::exec( "DELETE FROM expert WHERE compitation_id = $id" );
		
		$compitation = R::load( 'compitation', $id );
		R::trash( $compitation );

		return true;
	}

	/**
	 * Добавляем все документы, которые пользователь внесёт, при добавлении новой компетенции
	 * @param 	[ int ] 	$id 	   — ID компетенции, к которой необходимо прикрепить данные документы
	 * @param 	[ array ] 	$documents — Массив документов, который будет непосредственно помещён в БД
	 * @return 	[ void ]
	 */
	function add_documents_compitation( $id, $documents ) {
		$count = 1;

		while ( !empty( $documents[ $count ][ 'compitation-document-title' ] )
			AND !empty( $documents[ $count ][ 'compitation-document-file' ] ) ) {

			$document 					= R::dispense( 'documents' );
			$document->title 			= $documents[ $count ][ 'compitation-document-title' ];
			$document->path 			= $documents[ $count ][ 'compitation-document-file' ];
			$document->compitation_id 	= $id;

			R::store( $document );

			$count++;
			
		}
	}
	
	/**
	 * Получает документ из Базы Данных
	 * @param  [ int ] 	  $id — ID документа, которой нужно получить
	 * @return [ array ]  Возвращает массив документа
	 */
	function get_current_document( $id ) {
		return R::findOne( 'documents', 'id = ?', [ $id ] );
	}

	/**
	 * Получает список всех документов из Базы Данных
	 * @param  [ int ] 	  $id — ID компетенции, которой принадлежат документы
	 * @return [ array ] 	 	Возвращает массив всех документов
	 */
	function get_all_docs( $id ) {
		return R::findAll( 'documents', 'compitation_id = ?', [ $id ] );
	}

	/**
	 * Удаляет документ из БД
	 * @param  [ int ] 	$id — ID документа, который нужно удалить
	 * @return [ bool ] 	  TRUE, если удалось удалить документ из БД, FALSE, если нет
	 */
	function delete_document( $id ) {
		if ( !$id ) {
			return false;
		}

		$document = R::load( 'documents', $id );

		R::trash( $document );

		return true;
	}

	/**
	 * Помещение нового эксперта в Базу Данных
	 * @param  [ string ] $path — Путь к файлу, который будет храниться в БД
	 * @return [ void ]
	 */
	function add_new_expert( $path ) {
		$expert						= R::dispense( 'expert' );
		
		$expert->surname			= $_POST[ 'expert-surname' ];
		$expert->name  				= $_POST[ 'expert-name' ];
		$expert->otchestvo 			= $_POST[ 'expert-otchestvo' ];
		$expert->status				= $_POST[ 'expert-status' ];
		$expert->path_photo 		= $path;
		$expert->compitation_id 	= $_POST[ 'expert-compitation' ];

		R::store( $expert );
	}

	/**
	 * Выбирает список всех экспертов из БД
	 * @return [ array ] Список экспертов
	 */
	function get_all_experts() {
		return R::findAll( 'expert' );
	}

	/**
	 * Получает компиенцию, которая закреплена за экспертом
	 * @param  [ int ] 	$id — ID компетенции у эксперта
	 * @return [ void ]
	 */
	function get_compitation_of_expert( $id ) {
		return R::findOne( 'compitation', 'id = ?', [ $id ] );
	}

	/**
	 * Удаляет эксперта из БД
	 * @param  [ int ] 	$id — ID эксперта, которого нужно удалить
	 * @return [ bool ] 	  TRUE, если удалось удалить эксперта из БД, FALSE, если нет
	 */
	function delete_expert( $id ) {
		if ( !$id ) {
			return false;
		}

		$expert = R::load( 'expert', $id );

		R::trash( $expert );

		return true;
	}

	/**
	 * Получает эксперта по переданному id
	 * @param  [ int ] 		$id — ID эксперта, которого нужно получить
	 * @return [ mixed ] 	  	  Массив, с информацией о эксперте если удалось получить эксперта, FALSE, если нет
	 */
	function get_current_expert( $id ) {
		if ( !$id ) {
			return false;
		}

		return R::findOne( 'expert', 'id = ?', [ $id ] );
	}

	/**
	 * Изменение существующего эксперта
	 * @param  [ int ] 	  $id 	— ID текущего эксперта
	 * @param  [ string ] $path — Путь к файлу, который будет храниться в БД
	 * @return [ bool ]			  TRUE если удалось изменить эксперта, FALSE если нет
	 */
	function change_current_expert( $id, $path ) {

		if ( !$id ) { // если ID пуст, прерываем выполнение функции
			return false;
		}

		$expert						= R::load( 'expert', $id );
		
		$expert->surname			= $_POST[ 'expert-surname' ];
		$expert->name  				= $_POST[ 'expert-name' ];
		$expert->otchestvo 			= $_POST[ 'expert-otchestvo' ];
		$expert->status				= $_POST[ 'expert-status' ];

		if ( $path ) { // если путь к изображению не пустой
			$expert->path_photo 		= $path;
		}

		$expert->compitation_id 	= $_POST[ 'expert-compitation' ];

		R::store( $expert );

		return true;
	}

	/**
	 * Получает список всех участников из Базы Данных
	 * @return [ array ] 	 	Возвращает массив всех участников
	 */
	function get_all_participants() {
		return R::findAll( 'participant' );
	}
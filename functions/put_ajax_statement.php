<?php

	//require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/DataBase.php';
	//require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

	// Данные для подключения к базе данных
	define( 'HOST', 'localhost' );
	define( 'USER', 'root' );
	define( 'PASSWORD', '' );
	define( 'DB', 'bmt-wsr-complex' );

	require_once $_SERVER['DOCUMENT_ROOT'] . '/libs/rb.php';

	R::setup( 'mysql:host=' . HOST . ';dbname=' . DB ,
        USER, PASSWORD ); // for both mysql or mariaDB

	/**
	 * Посылает заявку пользователя в базу данных
	 * @return [bool] true если всё прошло удачно, иначе — false
	 */
	function send_record_db() {

		$participant					= R::dispense( 'participant' );
		
		$participant->surname 			= $_POST[ 'userSurname' ];
		$participant->name 				= $_POST[ 'userName' ];
		$participant->otchestvo 		= $_POST[ 'userOtch' ];
		$participant->birth_day 		= $_POST[ 'userBirthDay' ];
		$participant->email 			= $_POST[ 'emailUser' ];
		$participant->phone_number		= ( string )$_POST[ 'userPhone' ];
		$participant->organization 		= $_POST[ 'userOrganization' ];
		$participant->date_record		= date( 'Y-m-d H:i:s' );
		$participant->compitation_id 	= $_POST[ 'userCompitation' ];

		return R::store( $participant );
	}

	$errors_add_participant = array(); // Массив ошибок при записи пользователя

	if ( empty( $_POST[ 'userSurname' ] ) ) {
		$errors_add_participant[] 		= 'Вы не ввели свою фамилию';
	}

	if ( empty( $_POST[ 'userName' ] ) ) {
		$errors_add_participant[] 		= 'Вы не ввели своё имя';
	}

	if ( empty( $_POST[ 'userOtch' ] ) ) {
		$errors_add_participant[] 		= 'Вы не ввели своё отчество';
	}

	if ( empty( $_POST[ 'emailUser' ] ) ) {
		$errors_add_participant[] 		= 'Вы не ввели свой email';
	}

	if ( R::count( 'participant', "email = ?", array( $_POST[ 'emailUser' ] ) ) > 0 ) {
		$errors_add_participant[] 		= 'Такой Email уже существует';
	}

	if ( empty( $_POST[ 'userPhone' ] ) ) {
		$errors_add_participant[] 		= 'Вы не ввели свой телефон';
	}

	if ( empty( $_POST[ 'userOrganization' ] ) ) {
		$errors_add_participant[] 		= 'Вы не ввели свою организацию';
	}

	// Если все поля были заполнены
	if ( empty( $errors_add_participant ) ) {
		// Заносим все поля в Базу данных
		if ( send_record_db() ) {
			echo '<p class="large-text" style="color: #53B73F;">Вы успешно записались на конкурс</p>';
		} else {
			echo '<p class="large-text" style="color: #e23838;">Неудалось записать пользователя в БД</p>';
		}
		
	} else {
		echo '<p class="large-text" style="color: #e23838;">' . array_shift( $errors_add_participant ) . '</p>';;
	}

?>
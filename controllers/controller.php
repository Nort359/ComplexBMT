<?php

	if ( !defined( 'ABLE' ) ) {
		die( 'Доступ к контенту данной страницы запрещён' );
	}

	session_start();

	require_once 'config.php';
	require_once 'functions/functions.php';
	require_once 'models/model.php';

	if( !empty( $_GET[ 'view' ] ) ) {
		$_GET[ 'view' ] 	= htmlspecialchars( trim( $_GET[ 'view' ] ) );
	} else {
		$_GET[ 'view' ] 	= 'index';
	}

	/**
	 * Отдаёт файл на закачку пользователю
	 * @param  [ string ] $file — Путь к нужному файлу
	 * @return [ void ]
	 */
	function file_force_download( $file ) {
	  if ( file_exists( $file ) ) {
	    // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
	    // если этого не сделать файл будет читаться в память полностью!
	    if ( ob_get_level() ) {
	      ob_end_clean();
	    }
	    // заставляем браузер показать окно сохранения файла
	    header( 'Content-Description: File Transfer' );
	    header( 'Content-Type: application/octet-stream' );
	    header( 'Content-Disposition: attachment; filename=' . basename( $file ) );
	    header( 'Content-Transfer-Encoding: binary' );
	    header( 'Expires: 0');
	    header( 'Cache-Control: must-revalidate' );
	    header( 'Pragma: public' );
	    header( 'Content-Length: ' . filesize( $file ) );
	    // читаем файл и отправляем его пользователю
	    readfile( $file );
	    die;
	  }
	}

	// Вход админа
	if ( isset( $_POST[ 'admin-send-login' ] ) ) {
		$errors_log_in = array(); // массив возможных ошибок при входе

		$admin = R::findOne( 'admins', "login = ?", array( $_POST[ 'admin-login' ] ) );

		if ( $admin ) {
			// Пользователь найден, проверяем пароль
			// 
			if ( password_verify( $_POST[ 'admin-password' ], $admin->password ) ) {
				// Пароль совпадает, проверям, является ли пользователь админом
				
				// Стоит оператор ==, а не === потому, что в БД true — 1
				if ( $admin->admin == true ) {
					// Всё правильно, производим вход
					
					if ( empty( $_POST[ 'admin-remember-me' ] == true ) ) {
						$_SESSION[ 'admin_logged' ] = $admin;
					} else {
						setcookie( 'admin_logged', $admin->login, time() + 3600 * 24 * 31 * 3 );  /* срок действия 3 месяца */
					}

					// Избавляемся от проблемы F5
					header( "Location: {$_SERVER[ 'HTTP_REFERER' ]}" );
					die();
				} else {
					$errors_log_in[] = 'Извините, Вы не являетесь администратором';
				}				
			} else {
				// Пароль не совпадает, выводим ошибку
				$errors_log_in[] = 'Неверно введён пароль';
			}

		} else {
			// Пользователь не найден, выводим ошибку
			$errors_log_in[] = 'Пользователя с таким Login не существует';
		}

		if ( !empty( $errors_log_in ) ) {
			// При входе были ошибки, выводим их
			$message_error_log_in = '<p class="col-md-6 large-text" style="color: red;">' . array_shift( $errors_log_in ) . '</p>';
		}
	}

	if ( ( isset( $_GET[ 'action' ] )
	   AND $_GET[ 'action' ] === 'get_document' )
	 AND ( isset( $_GET[ 'document_id' ] )
	   AND $_GET[ 'document_id' ] > 0 ) ) {
		// Отдаём документ на скачивание

		$document_id 		= $_GET[ 'document_id' ];
		$document_id 		= handle_number_parameter( $document_id );

		if ( $document_id > 0 ) {
			$document 				= get_current_document( $document_id );
		}

		if( !empty( $document ) ) {
			file_force_download( $document->path );
		}

	}

	switch ( $_GET[ 'view' ] ) {
		// Главная страница
		case 'index':
			$view 					= 'index';

			$information_blocks 	= get_all_information_block();
			$list_compitations 		= get_all_compitations();
			$experts 				= get_all_experts();

			break;

		case 'more-compitation':
			$view 					= 'more-compitation';

			$compitation_id 		= $_GET[ 'compitation_id' ];

			$compitation_id 		= handle_number_parameter( $compitation_id );

			if ( $compitation_id > 0 ) {
				$current_compitation  	= get_current_compitation( $compitation_id );
				$docs 					= get_all_docs( $compitation_id );
			}

			break;

		case 'admin':
			$view 					= 'admin/index.php';
			break;

		// Главная страница
		default:
			$view 					= 'index';

			$information_blocks 	= get_all_information_block();
			$list_compitations 		= get_all_compitations();
			$experts 				= get_all_experts();


			break;
	}

	if ( file_exists( "views/$view.php" ) ) {
		require_once "views/$view.php";
	} else if ( $view === 'admin/index.php' AND file_exists( $view ) ) {
		require_once $view;
	} else {
		die( 'Запрошенной Вами страницы не существует!' );
	}

?>
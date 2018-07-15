<?php

	if ( !defined( 'ABLE' ) ) {
		die( 'Доступ к контенту данной страницы запрещён' );
	}

	require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/functions/translit.php';
	
	/**
	 * Удаляет существующую запись из БД
	 * @param  [ string ] 	$get_parameter — Имя параметра массива $_GET
	 * @param  [ mixed ] 	$function_name — Имя функции, которую следует вызвать для удаления записи
	 * @return [ bool ]                		 FALSE если были переданы не все параметры или последний параметр не функция
	 */
	function delete_record( $get_parameter, $function_name ) {

		if ( empty( $get_parameter ) OR empty( $function_name )
		  OR !is_string( $function_name ) OR !function_exists( $function_name ) ) {
			return false;
		}

		$expert_id = $_GET[ $get_parameter ];
		$expert_id = handle_number_parameter( $expert_id );

		if ( $expert_id !== false ) {
			$function_name( $expert_id );
		}

		// Избавляемся от проблемы F5
		@header( "Location: " . $_SERVER[ 'HTTP_REFERER' ] ); // редирект на предыдущую страницу
		die();

	}

	$view = !empty( $_GET[ 'view' ] ) ? // Если существует параметр view в HTTP запросу
		htmlspecialchars( trim( $_GET[ 'view' ] ) ) : // тогда присваиваем его переменной вида
		'index'; // иначе устанавливаем значение по умолчаниюs

	$errors_by_send_img = array(
		1 => 'Превышен максимальный размер фала, указанный в php.ini',
		2 => 'Превышен максимальный размер фала, указанный в форме HTML',
		3 => 'Была отправлена только часть файла',
		4 => 'Файл для отправки не был выбран'
	); // массив возможных ошибок при отправки изображения на сервер

	// Регистрация нового админа
	if ( isset( $_POST[ 'admin-registration' ] ) ) {
		$errors_sing_up = array(); // массив возможных ошибок при регистрации

		/* ==== Отлавливание ошибок при регистрации ==== */
		if ( trim( $_POST[ 'admin-surname' ] ) === '' ) {
			$errors_sing_up[] = 'Вы не ввели свою фамилию';
		}

		if ( trim( $_POST[ 'admin-name' ] ) === '' ) {
			$errors_sing_up[] = 'Вы не ввели своё имя';
		}

		if ( trim( $_POST[ 'admin-otch' ] ) === '' ) {
			$errors_sing_up[] = 'Вы не ввели своё отчество';
		}

		if ( trim( $_POST[ 'admin-email' ] ) === '' ) {
			$errors_sing_up[] = 'Вы не ввели свой email';
		}

		if ( trim( $_POST[ 'admin-login' ] ) === '' ) {
			$errors_sing_up[] = 'Вы не ввели свой Login';
		}

		if( mb_strlen( trim( $_POST[ 'admin-login' ] ), 'utf-8' ) < 3 ) {
			$errors_sing_up[] = 'Введённый вами Login слишком мал, он должен содержать хотя бы 3 символа';
		}

		if( mb_strlen( $_POST[ 'admin-password' ], 'utf-8' ) < 6 ) {
			$errors_sing_up[] = 'Введённый вами пароль слишком мал, он должен содержать хотя бы 6 символов';
		}

		if( $_POST[ 'admin-password-again' ] !== $_POST[ 'admin-password' ] ) {
			$errors_sing_up[] = 'Ваши пароли не совпадают';
		}

		// Если такой Email уже существует
		if( R::count( 'admins', "email = ?", array( $_POST[ 'admin-email' ] ) ) > 0 ) {
			$errors_sing_up[] = 'Такой Email уже зарегистрирован';
		}

		// Если такой Login уже существует
		if ( R::count( 'admins', "login = ?", array( $_POST[ 'admin-login' ] ) ) > 0 ) {
			$errors_sing_up[] = 'Такой Login уже зарегистрирован';
		}

		if ( empty( $errors_sing_up ) ) {
			// Регистрируем админа
			
			put_admin_db();

			$_SESSION[ 'errors' ][ 'message_success_add_admin' ] = '<p class="large-text" style="color: #53B73F;">Заявка успешно отправлена. Ожидайте одобрения, с Вами свяжутся</p>';
		} else {
			// Выводим ошибку
			$_SESSION[ 'errors' ][ 'message_error_add_admin' ] = '<p class="large-text" style="color: #e23838;">' . array_shift( $errors_sing_up ) . '</p>';
		}
	}

	// Вход админа
	if ( isset( $_POST[ 'admin-send-login' ] ) ) {
		$errors_log_in = array(); // массив возможных ошибок при входе

		$admin = R::findOne( 'admins', "login = ?", array( $_POST[ 'admin-login' ] ) );

		if ( $admin ) {
			// Пользователь найден, проверяем пароль
			
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

	// Выход из панели администратора
	if ( isset( $_GET[ 'action' ] ) AND $_GET[ 'action' ] === 'logout' ) {
		unset( $_SESSION[ 'admin_logged' ] );
		setcookie( 'admin_logged', 0, time() - 1 );

		header( "Location: {$_SERVER[ 'PHP_SELF' ]}" );
		die();
	}

	// Создание нового информационного блока
	if ( isset( $_POST[ 'information-block-add-new' ] ) ) {
		$errors_add_information_blocks = array(); // массив возможных ошибок при создании нового информационного блока

		if ( empty( trim( $_POST[ 'information-block-title' ] ) ) )
			$errors_add_information_blocks[] = 'Заполните поле заголовка блока';

		if ( empty( trim( $_POST[ 'information-block-short-description' ] ) ) )
			$errors_add_information_blocks[] = 'Заполните краткое описание блока';

		if ( mb_strlen( trim( $_POST[ 'information-block-short-description' ] ), 'utf-8' ) < 20 )
			$errors_add_information_blocks[] = 'Длина поля "краткое описание блока" должно быть не менее хотя бы 20 символов';

		if ( empty( trim( $_POST[ 'information-block-description' ] ) ) )
			$errors_add_information_blocks[] = 'Заполните полное описание блока';

		if ( mb_strlen( trim( $_POST[ 'information-block-description' ] ), 'utf-8' ) < 50 )
			$errors_add_information_blocks[] = 'Длина поля "полное описание блока" должно быть не менее хотя бы 50 символов';
		
		// Если название такой компитенции уже существует
		if( R::count( 'informationblock', "title = ?", array( $_POST[ 'information-block-title' ] ) ) > 0 ) {
			$errors_add_information_blocks[] = 'Название такого уже существует. Пожалуйста, измените название, или работайте, с уже существующим блоком';
		}

		// Проверка файла на то, является ли он изображением
		if ( !$_FILES[ 'information-block-img' ][ 'type' ] === 'image/jpeg'
		  OR !$_FILES[ 'information-block-img' ][ 'type' ] === 'image/jpg'
		  OR !$_FILES[ 'information-block-img' ][ 'type' ] === 'image/png' ) {
			$errors_add_information_blocks[] = 'Загруженный файл не является изображением. Пожалуйста, вставьте изображение только с одним следующих расширений: [ ".jpeg", ".jpg", ".png" ]';
		}

		$title_compitation = $_POST[ 'information-block-title' ];
		$title_compitation = str2translit( $title_compitation ); // Переводим названим папки в транслит
		$path_folder = $_SERVER['DOCUMENT_ROOT'] . "/user_files/information-block/$title_compitation";

		// Создаём папку с названием компитенции
		if ( !file_exists( $path_folder ) ) { // если такая папка ещё не существует
			if ( !mkdir( $path_folder, 0777 ) ) {
				// Неудалось создать папку
				$errors_add_information_blocks[] = 'Неудалось создать папку с названием которое Вы ввели в поле заголовка, вероятно в названии блока присутствуют запрещённые символы';
			}
		}

		$name_file = basename( $_FILES[ 'information-block-img' ][ 'name' ] );
		$final_path = "$path_folder/$name_file";
		$final_path = str2translit( $final_path ); // Переводим названим изображения в транслит

		// Перемещаем изображение в созданную папку с блоком
		if ( !move_uploaded_file( $_FILES[ 'information-block-img' ][ 'tmp_name' ], $final_path ) ) {
			$errors_add_information_blocks[] = 'Неудалось переместить Ваше изображение в папку с блоком, вероятно изображение содержит недопустимый формат';
		}

		if ( empty( $errors_add_information_blocks ) ) {
			// Добавляем новый информационный блок
			
			$path_img = substr( $final_path , mb_strpos( $final_path, 'user_files', 0, 'utf-8' ) );

			add_new_information_block( $path_img );

			$_SESSION[ 'errors' ][ 'message_success_information-block' ] = '<p class="large-text" style="color: #53B73F;">Информационный блок успешно добавлен</p>';
		} else {
			// Есть ошибка, выводим её
			$_SESSION[ 'errors' ][ 'message_error_information-block' ] = '<p class="large-text" style="color: #e23838;">' . array_shift( $errors_add_information_blocks ) . '</p>';
		}

		// Избавляемся от проблемы F5
		@header("Location: ". $_SERVER["REQUEST_URI"]); // редирект
		die();
	}

	// Измненение существующего информационного блока
	if ( isset( $_POST[ 'information-block-change' ] ) ) {
		$errors_change_information_blocks = array(); // массив возможных ошибок при создании нового информационного блока

		if ( empty( trim( $_POST[ 'information-block-title' ] ) ) )
			$errors_change_information_blocks[] = 'Заполните поле заголовка блока';

		if ( empty( trim( $_POST[ 'information-block-short-description' ] ) ) )
			$errors_change_information_blocks[] = 'Заполните краткое описание блока';

		if ( mb_strlen( trim( $_POST[ 'information-block-short-description' ] ), 'utf-8' ) < 20 )
			$errors_change_information_blocks[] = 'Длина поля "краткое описание блока" должно быть не менее хотя бы 20 символов';

		if ( empty( trim( $_POST[ 'information-block-description' ] ) ) )
			$errors_change_information_blocks[] = 'Заполните полное описание блока';

		if ( mb_strlen( trim( $_POST[ 'information-block-description' ] ), 'utf-8' ) < 50 )
			$errors_change_information_blocks[] = 'Длина поля "полное описание блока" должно быть не менее хотя бы 50 символов';

		$title_compitation 	= $_POST[ 'information-block-title' ];
		$title_compitation 	= str2translit( $title_compitation ); // Переводим названим папки в транслит
		$path_folder 		= $_SERVER['DOCUMENT_ROOT'] . "/user_files/information-block/$title_compitation";

		// Создаём папку с названием компитенции
		if ( !file_exists( $path_folder ) ) { // если такая папка ещё не существует
			if ( !mkdir( $path_folder, 0777 ) ) {
				// Неудалось создать папку
				$errors_change_information_blocks[] = 'Неудалось создать папку с названием которое Вы ввели в поле заголовка, вероятно в названии блока присутствуют запрещённые символы';
			}
		}

		if ( !empty( $_FILES[ 'information-block-img' ][ 'name' ] ) ) { // если изображение было загружено

			// Проверка файла на то, является ли он изображением
			if ( !$_FILES[ 'information-block-img' ][ 'type' ] === 'image/jpeg'
			  OR !$_FILES[ 'information-block-img' ][ 'type' ] === 'image/jpg'
			  OR !$_FILES[ 'information-block-img' ][ 'type' ] === 'image/png' ) {
				$errors_change_information_blocks[] = 'Загруженный файл не является изображением. Пожалуйста, вставьте изображение только с одним следующих расширений: [ ".jpeg", ".jpg", ".png" ]';
			}

			$name_file 	= basename( $_FILES[ 'information-block-img' ][ 'name' ] );
			$final_path = "$path_folder/$name_file";
			$final_path = str2translit( $final_path ); // Переводим названим изображения в транслит

			// Перемещаем изображение в созданную папку с блоком
			if ( !move_uploaded_file( $_FILES[ 'information-block-img' ][ 'tmp_name' ], $final_path ) ) {
				$errors_change_information_blocks[] = 'Неудалось переместить Ваше изображение в папку с блоком, вероятно изображение содержит недопустимый формат';
			}

		}

		if ( empty( $errors_change_information_blocks ) ) {
			// Добавляем новый информационный блок
			
			if ( !empty( $final_path ) ) {
				$path_img = substr( $final_path , mb_strpos( $final_path, 'user_files', 0, 'utf-8' ) );
			} else {
				$path_img = NULL;
			}

			$block_id = $_GET[ 'block_id' ];

			$block_id = handle_number_parameter( $block_id );

			if ( $block_id > 0 ) {
				update_information_block( $block_id, $path_img );

				$_SESSION[ 'errors' ][ 'message_success_information-block' ] = '<p class="large-text" style="color: #53B73F;">Информационный блок успешно изменён</p>';
			} else {
				$_SESSION[ 'errors' ][ 'message_error_information-block' ] = '<p class="large-text" style="color: #e23838;">Передан неверный ID блока</p>';
			}
		} else {
			// Есть ошибка, выводим её
			$_SESSION[ 'errors' ][ 'message_error_information-block' ] = '<p class="large-text" style="color: #e23838;">' . array_shift( $errors_change_information_blocks ) . '</p>';
		}

		// Избавляемся от проблемы F5
		@header( "Location: " . $_SERVER["REQUEST_URI"] ); // редирект
		die();
	}

	// Удаление существующей компетенции
	if ( isset( $_GET[ 'action' ] ) AND $_GET[ 'action' ] === 'delete-block' ) {
		delete_record( 'block_id', 'delete_current_block' );
	}

	// Создание новой компитенции
	if ( isset( $_POST[ 'compitation-add-new' ] ) ) {
		$errors_add_compitation = array(); // массив возможных ошибок при создании новой компитенции

		if ( empty( trim( $_POST[ 'compitation-title' ] ) ) )
			$errors_add_compitation[] = 'Заполните название компитенции';

		if ( empty( trim( $_POST[ 'compitation-short-description' ] ) ) )
			$errors_add_compitation[] = 'Заполните краткое описание компитенции';

		if ( mb_strlen( trim( $_POST[ 'compitation-short-description' ] ), 'utf-8' ) < 20 )
			$errors_add_compitation[] = 'Длина поля "краткое описание компитенции" должно быть не менее хотя бы 20 символов';

		if ( empty( trim( $_POST[ 'compitation-description' ] ) ) )
			$errors_add_compitation[] = 'Заполните полное описание компитенции';

		if ( mb_strlen( trim( $_POST[ 'compitation-description' ] ), 'utf-8' ) < 50 )
			$errors_add_compitation[] = 'Длина поля "полное описание компитенции" должно быть не менее хотя бы 50 символов';

		// Проверка на отсутсвие ошибки при отправке изображения
		if ( $_FILES[ 'compitation-img' ][ 'error' ] !== 0 ) {
			$errors_add_compitation[] = $errors_by_send_img[ $_FILES[ 'compitation-img' ][ 'error' ] ];
		}

		// Если название такой компитенции уже существует
		if( R::count( 'compitation', "title = ?", array( $_POST[ 'compitation-title' ] ) ) > 0 ) {
			$errors_add_compitation[] = 'Название такой компитенции уже существует. Пожалуйста, измените название, или работайте, с уже существующей компитенцией';
		}

		$ext_type = array( 'jpg','jpe','jpeg','png' );

		// Проверка файла на то, является ли он изображением
		if ( !$_FILES[ 'compitation-img' ][ 'type' ] === 'image/jpeg'
		  OR !$_FILES[ 'compitation-img' ][ 'type' ] === 'image/jpg'
		  OR !$_FILES[ 'compitation-img' ][ 'type' ] === 'image/png' ) {
			$errors_add_compitation[] = 'Загруженный файл не является изображением. Пожалуйста, вставьте изображение только с одним следующих расширений: [ ".jpeg", ".jpg", ".png" ]';
		}

		$title_compitation = $_POST[ 'compitation-title' ];
		$title_compitation = str2translit( $title_compitation ); // Переводим названим папки в транслит
		$path_folder = $_SERVER['DOCUMENT_ROOT'] . "/user_files/compitations/$title_compitation";

		// Создаём папку с названием компитенции
		if ( !file_exists( $path_folder ) ) { // если такая папка ещё не существует
			if ( !mkdir( $path_folder, 0777 ) ) {
				// Неудалось создать папку
				$errors_add_compitation[] = 'Неудалось создать папку с названием Вашей компитенции, вероятно в названии компитенции присутствуют запрещённые символы';
			}
		}

		$name_file = basename( $_FILES[ 'compitation-img' ][ 'name' ] );
		$final_path = "$path_folder/$name_file";
		$final_path = str2translit( $final_path ); // Переводим названим изображения в транслит

		// Перемещаем изображение в созданную папку с компитенцией
		if ( !move_uploaded_file( $_FILES[ 'compitation-img' ][ 'tmp_name' ], $final_path ) ) {
			$errors_add_compitation[] = 'Неудалось переместить Ваше изображение в папку с компитенцией, вероятно изображение содержит недопустимый формат';
		}

		if ( empty( $errors_add_compitation ) ) {
			// Добавляем новую компитенцию
			
			$path_img = substr( $final_path , mb_strpos( $final_path, 'user_files', 0, 'utf-8' ) );

			$id_compitation = add_new_compitation( $path_img );

			$warnings_add_document = array(); // массив возможных предупреждений при создании нового документа

			$path_folder_doc = "$path_folder/documents";

			$path_folder_doc = str2translit( $path_folder_doc ); // Переводим названим директивы в транслит

			if ( !file_exists( $path_folder_doc ) ) {
				if ( !mkdir( $path_folder_doc, 0777 ) ) {
					$warnings_add_document[] = 'Неудалось создать директиву, которая должна хранить загруженные документы';
				}
			}

			$count = 1;
			$documents = array();

			// Добавление всех необходимых данных о загруженных документов в отдельный массив
			while ( !empty( $_POST[ 'compitation-document-title-' . $count ] )
				AND !empty( $_FILES[ 'compitation-document-file-' . $count ] ) ) {
				$name_document = basename( $_FILES[ 'compitation-document-file-' . $count ][ 'name' ] );
				$path_document = "$path_folder_doc/$name_document";

				$path_document = str2translit( $path_document ); // Переводим названим документа в транслит

				// Проверка на отсутсвие ошибки при отправке изображения
				if ( $_FILES[ 'compitation-document-file-' . $count ][ 'error' ] !== 0 ) {
					$warnings_add_document[] = $errors_by_send_img[ $_FILES[ 'compitation-document-file-' . $count ][ 'error' ] ];
				}

				if ( !move_uploaded_file( $_FILES[ 'compitation-document-file-' . $count ][ 'tmp_name' ], $path_document ) ) {
					$warnings_add_document[] = "Неудалось переместить документ под названием: \"$name_document\" в папку, возможно в названии файла содержатся недопустимые символы";
				}

				$sub_path_doc = @substr( $path_document , @mb_strpos( $path_document, 'user_files', 0, 'utf-8' ) );

				$documents[ $count ][ 'compitation-document-title' ] = $_POST[ 'compitation-document-title-' . $count ];
				$documents[ $count ][ 'compitation-document-file' ] = $sub_path_doc;

				$count++;
			}

			if ( empty( $warnings_add_document ) ) {
				// Предупреждений нет, помещаем документы в БД
				add_documents_compitation( $id_compitation, $documents );

				$_SESSION[ 'warnings' ][ 'message_success_add_document' ] = '<p class="large-text" style="color: #53B73F;">Все документы успешно добавлены</p>';
			} else {
				// Есть предупреждения, помещаем все возможные документы в БД
				add_documents_compitation( $id_compitation, $documents );

				$_SESSION[ 'warnings' ][ 'message_warnings_add_document' ] = '<p class="large-text" style="color: orange;">' . array_shift( $warnings_add_document ) . '</p>';
			}
			

			$_SESSION[ 'errors' ][ 'message_success_add_compit' ] = '<p class="large-text" style="color: #53B73F;">Новая компитенция успешно создана</p>';
		} else {
			// Есть ошибка, выводим её
			$_SESSION[ 'errors' ][ 'message_error_add_compit' ] = '<p class="large-text" style="color: red;">' . array_shift( $errors_add_compitation ) . '</p>';
		}

		// Избавляемся от проблемы F5
		@header("Location: ". $_SERVER["REQUEST_URI"]); // редирект
		die();

	}

	// Изменение существующей компитенции
	if ( isset( $_POST[ 'compitation-change' ] ) ) {
		$errors_add_compitation = array(); // массив возможных ошибок при создании новой компитенции

		$errors_by_send_img = array(
			1 => 'Превышен максимальный размер фала, указанный в php.ini',
			2 => 'Превышен максимальный размер фала, указанный в форме HTML',
			3 => 'Была отправлена только часть файла',
			4 => 'Файл для отправки не был выбран'
		); // массив возможных ошибок при отправки изображения на сервер

		if ( empty( trim( $_POST[ 'compitation-title' ] ) ) )
			$errors_add_compitation[] = 'Заполните название компитенции';

		if ( empty( trim( $_POST[ 'compitation-short-description' ] ) ) )
			$errors_add_compitation[] = 'Заполните краткое описание компитенции';

		if ( mb_strlen( trim( $_POST[ 'compitation-short-description' ] ), 'utf-8' ) < 20 )
			$errors_add_compitation[] = 'Длина поля "краткое описание компитенции" должно быть не менее хотя бы 20 символов';

		if ( empty( trim( $_POST[ 'compitation-description' ] ) ) )
			$errors_add_compitation[] = 'Заполните полное описание компитенции';

		if ( mb_strlen( trim( $_POST[ 'compitation-description' ] ), 'utf-8' ) < 50 ) {
			$errors_add_compitation[] = 'Длина поля "полное описание компитенции" должно быть не менее хотя бы 50 символов';
		}

		// Если изображение было загружено
		if ( !empty( $_FILES[ 'compitation-img' ][ 'name' ] ) ) {
			// Проверка на отсутсвие ошибки при отправке изображения
			if ( $_FILES[ 'compitation-img' ][ 'error' ] !== 0 ) {
				$errors_add_compitation[] = $errors_by_send_img[ $_FILES[ 'compitation-img' ][ 'error' ] ];
			}

			$ext_type = array( 'jpg','jpe','jpeg','png' );

			// Проверка файла на то, является ли он изображением
			if ( !$_FILES[ 'compitation-img' ][ 'type' ] === 'image/jpeg'
			  OR !$_FILES[ 'compitation-img' ][ 'type' ] === 'image/jpg'
			  OR !$_FILES[ 'compitation-img' ][ 'type' ] === 'image/png' ) {
				$errors_add_compitation[] = 'Загруженный файл не является изображением. Пожалуйста, вставьте изображение только с одним следующих расширений: [ ".jpeg", ".jpg", ".png" ]';
			}
		}

		$title_compitation = $_POST[ 'compitation-title' ];
		$compit = get_current_compitation( ceil( (int)$_GET[ 'compitation_id' ] ) );

		$old_title_compitation = str2translit( $compit->title );

		$title_compitation = str2translit( $title_compitation ); // Переводим названим папки в транслит
		$path_folder = $_SERVER['DOCUMENT_ROOT'] . "/user_files/compitations/$title_compitation";
		$path_old_folder = $_SERVER['DOCUMENT_ROOT'] . "/user_files/compitations/$old_title_compitation";

		$path_old_folder = str2translit( $path_old_folder );

		// Создаём папку с названием компитенции
		if ( !file_exists( $path_folder ) ) { // если такая папка ещё не существует
			if( file_exists( $path_old_folder ) ) {
				if( !rename ( $path_old_folder, $path_folder ) ) {
					$errors_add_compitation[] = 'Неудалось переименовать папку с названием Вашей компитенции, вероятно в названии компитенции присутствуют запрещённые символы';
				}
			}
		}

		// Если изображение было загружено
		if ( !empty( $_FILES[ 'compitation-img' ][ 'name' ] ) ) {

			$name_file = basename( $_FILES[ 'compitation-img' ][ 'name' ] );
			$final_path = "$path_folder/$name_file";
			$final_path = str2translit( $final_path ); // Переводим названим изображения в транслит

			// Перемещаем изображение в созданную папку с компитенцией
			if ( !move_uploaded_file( $_FILES[ 'compitation-img' ][ 'tmp_name' ], $final_path ) ) {
				$errors_add_compitation[] = 'Неудалось переместить Ваше изображение в папку с компитенцией, вероятно изображение содержит недопустимый формат';
			}

			$path_img = substr( $final_path , mb_strpos( $final_path, 'user_files', 0, 'utf-8' ) );
		}

		if ( empty( $errors_add_compitation ) ) {
			// Добавляем новую компитенцию

			$id = ceil( (int)$_GET[ 'compitation_id' ] );

			$id_compitation = update_exist_compitation( $id, $path_img, get_current_compitation( $id ) );

			$warnings_add_document = array(); // массив возможных предупреждений при создании нового документа

			$path_folder_doc = "$path_folder/documents";

			$path_folder_doc = str2translit( $path_folder_doc ); // Переводим названим директивы в транслит

			if ( !file_exists( $path_folder_doc ) ) {
				if ( !mkdir( $path_folder_doc, 0777 ) ) {
					$warnings_add_document[] = 'Неудалось создать директиву, которая должна хранить загруженные документы';
				}
			}

			$count = 1;
			$documents = array();

			// Добавление всех необходимых данных о загруженных документов в отдельный массив
			while ( !empty( $_POST[ 'compitation-document-title-' . $count ] )
				AND !empty( $_FILES[ 'compitation-document-file-' . $count ] ) ) {
				$name_document = basename( $_FILES[ 'compitation-document-file-' . $count ][ 'name' ] );
				$path_document = "$path_folder_doc/$name_document";

				$path_document = str2translit( $path_document ); // Переводим названим документа в транслит

				// Проверка на отсутсвие ошибки при отправке изображения
				if ( $_FILES[ 'compitation-document-file-' . $count ][ 'error' ] !== 0 ) {
					$warnings_add_document[] = $errors_by_send_img[ $_FILES[ 'compitation-document-file-' . $count ][ 'error' ] ];
				}

				if ( !move_uploaded_file( $_FILES[ 'compitation-document-file-' . $count ][ 'tmp_name' ], $path_document ) ) {
					$warnings_add_document[] = "Неудалось переместить документ под названием: \"$name_document\" в папку, возможно в названии файла содержатся недопустимые символы";
				}

				$sub_path_doc = @substr( $path_document , @mb_strpos( $path_document, 'user_files', 0, 'utf-8' ) );

				$documents[ $count ][ 'compitation-document-title' ] = $_POST[ 'compitation-document-title-' . $count ];
				$documents[ $count ][ 'compitation-document-file' ] = $sub_path_doc;

				$count++;
			}

			if ( empty( $warnings_add_document ) ) {
				// Предупреждений нет, помещаем документы в БД
				add_documents_compitation( $id_compitation, $documents );

				$_SESSION[ 'warnings' ][ 'message_success_add_document' ] = '<p class="large-text" style="color: #53B73F;">Все документы успешно добавлены</p>';
			} else {
				// Есть предупреждения, помещаем все возможные документы в БД
				add_documents_compitation( $id_compitation, $documents );

				$_SESSION[ 'warnings' ][ 'message_warnings_add_document' ] = '<p class="large-text" style="color: orange;">' . array_shift( $warnings_add_document ) . '</p>';
			}
			

			$_SESSION[ 'errors' ][ 'message_success_add_compit' ] = '<p class="large-text" style="color: #53B73F;">Компитенция успешно изменина</p>';
		} else {
			// Есть ошибка, выводим её
			$_SESSION[ 'errors' ][ 'message_error_add_compit' ] = '<p class="large-text" style="color: red;">' . array_shift( $errors_add_compitation ) . '</p>';
		}

		// Избавляемся от проблемы F5
		@header("Location: ". $_SERVER["REQUEST_URI"]); // редирект
		die();

	}

	// Удаление существующей компитенции
	if ( isset( $_GET[ 'action' ] ) AND $_GET[ 'action' ] === 'delete-compitation' ) {

		delete_record( 'compitation_id', 'delete_compitation' );

	}

	// Удаление существующего документа
	if ( isset( $_GET[ 'action' ] ) AND $_GET[ 'action' ] === 'delete_doc' ) {

		delete_record( 'doc_id', 'delete_document' );

	}

	// Добавление нового эксперта
	if ( isset( $_POST[ 'expert-add-new' ] ) ) {
		$errors_add_expert = array(); // массив возможных ошибок при добавлении нового эксперта

		/* ==== Отлавливание ошибок при добавлении нового эксперта ==== */
		if ( trim( $_POST[ 'expert-surname' ] ) === '' ) {
			$errors_add_expert[] = 'Вы не ввели фамилию эксперта';
		}

		if ( trim( $_POST[ 'expert-name' ] ) === '' ) {
			$errors_add_expert[] = 'Вы не ввели имя эксперта';
		}

		if ( trim( $_POST[ 'expert-otchestvo' ] ) === '' ) {
			$errors_add_expert[] = 'Вы не ввели отчество эксперта';
		}

		if ( trim( $_POST[ 'expert-status' ] ) === '' ) {
			$errors_add_expert[] = 'Вы не ввели статус эксперта';
		}

		if ( trim( $_POST[ 'expert-compitation' ] ) === '' ) {
			$errors_add_expert[] = 'Вы не выбрали статус эксперта';
		}

		$folder_experts = $_SERVER['DOCUMENT_ROOT'] . '/user_files/experts'; // путь к папку, где хранятся фото всех экспертов

		if ( empty( $_FILES[ 'expert-photo' ][ 'name' ] ) ) {

			if ( $_GET[ 'block' ] === 'change-expert' ) {

				$path_photo_expert = NULL;

			} else if ( $_GET[ 'block' ] === 'add-expert' ) {
				$path_photo_expert = 'user_files/experts/NoPhoto.jpg'; // путь к изображению по умолчанию

				$path_photo_expert = str2translit( $path_photo_expert );
			}

		} else {
			// Проверка на отсутсвие ошибки при отправке изображения
			if ( $_FILES[ 'expert-photo' ][ 'error' ] !== 0 ) {
				$errors_add_expert[] = $errors_by_send_img[ $_FILES[ 'expert-photo' ][ 'error' ] ];
			}

			// Проверка файла на то, является ли он изображением
			if ( !$_FILES[ 'expert-photo' ][ 'type' ] === 'image/jpeg'
			  OR !$_FILES[ 'expert-photo' ][ 'type' ] === 'image/jpg'
			  OR !$_FILES[ 'expert-photo' ][ 'type' ] === 'image/png' ) {
				$errors_add_expert[] = 'Загруженный файл не является изображением. Пожалуйста, вставьте изображение только с одним следующих расширений: [ ".jpeg", ".jpg", ".png" ]';
			}

			$name_file = basename( $_FILES[ 'expert-photo' ][ 'name' ] );
			$path_photo_expert = "$folder_experts/$name_file";
			$path_photo_expert = str2translit( $path_photo_expert ); // Переводим названим изображения в транслит

			// Перемещаем изображение в созданную папку с компитенцией
			if ( !move_uploaded_file( $_FILES[ 'expert-photo' ][ 'tmp_name' ], $path_photo_expert ) ) {
				$errors_add_expert[] = 'Неудалось переместить Ваше изображение в папку с компитенцией, вероятно изображение содержит недопустимый формат';
			}

			$path_photo_expert = substr( $path_photo_expert, mb_strpos( $path_photo_expert, 'user_files', 0, 'utf-8' ) );
		}

		if ( empty( $errors_add_expert ) ) {
			// Помещаем эксперта в БД
			
			if ( $_GET[ 'block' ] === 'change-expert' ) {

				$expert_id 				= ceil( ( int )$_GET[ 'expert_id' ] );

				if ( empty( $expert_id ) OR $expert_id <= 0 ) {
					$expert_id 			= 1;
				}

				change_current_expert( $expert_id, $path_photo_expert );

				$_SESSION[ 'errors' ][ 'message_success_add_expert' ] = '<p class="col-md-6 large-text" style="color: #53B73F;">Данные о эксперте успешно изменены</p>';

			} else {

				add_new_expert( $path_photo_expert );

				$_SESSION[ 'errors' ][ 'message_success_add_expert' ] = '<p class="large-text" style="color: #53B73F;">Новый эксперт успешно добавлен</p>';

			}
		} else {
			// Выводим ошибку
			$_SESSION[ 'errors' ][ 'message_error_add_expert' ] = '<p class="large-text" style="color: red;">' . array_shift( $errors_add_expert ) . '</p>';
		}

		// Избавляемся от проблемы F5
		@header( "Location: ". $_SERVER["REQUEST_URI"] ); // редирект
		die();

	}

	// Удаление эксперта
	if ( isset( $_GET[ 'action' ] ) AND $_GET[ 'action' ] === 'delete_expert' ) {

		delete_record( 'expert_id', 'delete_expert' );

	}

	// Получение списка всех компитенций
	$list_compitations 				= get_all_compitations();

	if( !empty( $_GET[ 'block' ] ) ) {
		$_GET[ 'block' ] 	= htmlspecialchars( trim( $_GET[ 'block' ] ) );
	} else {
		$_GET[ 'block' ] 	= 'compitation';
	}

	switch ( $_GET[ 'block' ] ) {
		case 'information-blocks':
			$block 					= 'information-blocks';
			$blockCaption 			= 'Список информационных блоков';

			$information_blocks 	= get_all_information_block();

			break;

		case 'change-information-block':

			$block 					= 'change-information-block';
			$blockCaption 			= 'Изменение информационного блока';

			$block_id = $_GET[ 'block_id' ];

			$block_id = handle_number_parameter( $block_id );

			if ( $block_id > 0 ) {
				$inf_block 			= get_current_block( $block_id );
			}

			break;

		case 'add-information-block':
			$block 					= 'add-information-block';
			$blockCaption 			= 'Добавьте новый блок';
			break;

		// Список всех компитеций
		case 'compitation':
			$block 					= 'compitation';
			$blockCaption 			= 'Список компитенций';
			break;

		// Добавление новой компитенции
		case 'add-compitation':
			$block 					= 'add-compitation';
			$blockCaption 			= 'Добавление новой компитенции';
			break;

		// Изменение существующей компитенции
		case 'change-compitation':
			$block 					= 'change-compitation';
			$blockCaption 			= 'Изменение компитенции';

			$id 					= ceil( (int)$_GET[ 'compitation_id' ] );

			$current_compitation 	= get_current_compitation( $id );
			$docs 					= get_all_docs( $id );

			break;

		// Список всех экспертов
		case 'experts':
			$block 					= 'experts';
			$blockCaption 			= 'Список экспертов';

			$experts 				= get_all_experts();

			break;

		// Добавление нового эксперта
		case 'add-expert':
			$block 					= 'add-expert';
			$blockCaption 			= 'Добавление нового эксперта';
			break;

		// Изменение существующего эксперта
		case 'change-expert':
			$block 					= 'change-expert';
			$blockCaption 			= 'Изменение эксперта';

			$expert_id 				= ceil( ( int )$_GET[ 'expert_id' ] );

			if ( empty( $expert_id ) OR $expert_id <= 0 ) {
				$expert_id 			= 1;
			}

			$current_expert 		= get_current_expert( $expert_id );

			break;

		// Список всех записавшихся участников
		case 'participant':
			$block 					= 'participant';
			$blockCaption 			= 'Список участников';

			$participants 			= get_all_participants();

			break;
		
		// По умолчанию выводится список компитенций
		default:
			$block 					= 'compitation';
			$blockCaption 			= 'Список компитенций';
			break;
	}

	if ( file_exists( "admin/views/index.php" ) ) {
		require_once "admin/views/index.php";
	} else {
		die( 'Запрошенной Вами страницы не существует!' );
	}

?>
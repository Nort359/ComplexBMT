<?php
	
	/**
	 * Распечатывает массив, нужен только для тестирования
	 * @param  [ array ] $array — Массив, который нужно распечатать
	 * @return [ void ]
	 */
	function print_arr( $array ) {
		echo '<pre>';
		print_r( $array );
		echo '</pre>';
	}

	/**
	 * Обрабатывает номерной параметр, делая его безопасным
	 * @param  [ int ] 	 $number — Номерной параметр, который следует обработать
	 * @return [ mixed ]           Число, которое было обработано, если функция выполнена удачно и FALSE в обратном случае
	 */
	function handle_number_parameter( $number ) {

		if ( empty( $number ) ) {
			return false;
		}

		$result = ceil( ( int )$number );

		if ( empty( $result ) OR $result <= 0 ) {
			$result = 1;
		}

		return $result;
	}

	/**
	 * Функция, подключающая все необходимые стили стили
	 * @return [void]
	 */
	function print_styles() {
		$styleLinks = array(
			'css/bootstrap.min.css',
			'https://fonts.googleapis.com/css?family=Roboto:400,400i,500,700&amp;subset=cyrillic',
			'css/styles.css',
			'css/notification.css'
		);

		foreach ($styleLinks as $link) {
			if ( @mb_strpos( $link, 'http', 0, 'utf-8' ) !== false ) {
				echo '<link rel="stylesheet" href="' . $link . '">';
			} else {
				echo '<link rel="stylesheet" href="' . TEMPLATE . $link . '">';
			}
		}
	}

	/**
	 * Функция, подключающая все необходимые стили стили
	 * @return [void]
	 */
	function print_scripts() {
		$scripts = array(
			'js/jquery-1.11.3.min.js',
			'js/bootstrap.min.js"',
			'js/ajax-put-participant.js',
			'js/parallax.min.js',
			'js/jquery.malihu.PageScroll2id.min.js',
			'js/scripts.js',
			'js/scrollPage.js',
			'js/menu-humburger.js',
			'js/modal-windows.js',
			'js/form-animate-effect.js',
			'js/form-validation.js',
			'js/notification.js'
		);

		foreach ($scripts as $script) {
			echo '<script src="' . TEMPLATE . $script . '"></script>';
		}
	}

	/**
	 * Функция, подключающая все необходимые стили стили
	 * @return [void]
	 */
	function print_styles_admin() {
		$styleLinks = array(
			'css/bootstrap.css',
			'css/admin_style.css',
			'css/notification.css'
		);

		foreach ($styleLinks as $link) {
			echo '<link rel="stylesheet" href="' . 'admin/' . TEMPLATE . $link . '">';
		}
	}

	/**
	 * Функция, подключающая все необходимые стили стили
	 * @return [void]
	 */
	function print_scripts_admin() {
		$scripts = array(
			'js/jquery-1.11.3.min.js',
			'js/jquery-ui.min.js',
			'js/bootstrap.min.js',
			'js/admin-panel-accordeon.js',
			'js/add-new-document.js',
			'js/scripts.js',
			'js/form-validation.js',
			'js/delete-records.js',
			'js/notification.js',
			'js/form-animate-effect.js'
		);

		foreach ($scripts as $script) {
			echo '<script src="' . 'admin/' . TEMPLATE . $script . '"></script>';
		}
	}

?>
<?php

	if ( !defined( 'ABLE' ) ) {
		die( 'Доступ к контенту данной страницы запрещён' );
	}

	// Путь к видам
	define( 'TEMPLATE', 'views/' );
	
	// Путь к панели администратора
	define( 'ADMIN_PANEL', 'admin/' );
	
	// Данные для подключения к базе данных
	define( 'HOST', 'localhost' );
	define( 'USER', 'root' );
	define( 'PASSWORD', '' );
	define( 'DB', 'bmt-wsr-complex' );

	require_once 'libs/rb.php';

	R::setup( 'mysql:host=' . HOST . ';dbname=' . DB ,
        USER, PASSWORD ); // for both mysql or mariaDB
<?php

	error_reporting( -1 );

	define( 'ABLE', true );

	if ( !defined( 'ABLE' ) ) {
		die( 'Доступ к контенту данной страницы запрещён' );
	}
	
	require_once 'controllers/controller.php';

?>
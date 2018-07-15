<?php

	/**
	* Реализация патерна SingleTon
	* Статический класс возвращающий соединение с базой данных
	*/
	class DataBase {
		private static $connection;

		const HOST = 'localhost';
		const USER = 'root';
		const PASSWORD = '';
		const DB = 'bmt-wsr-complex';

		private function __construct() {}

		public static function getConnectionDb() {
			if ( self::$connection === NULL ) {
				self::$connection = mysqli_connect( self::HOST, self::USER, self::PASSWORD, self::DB )
					or die( 'Неудалось соединиться с базой данных. Ошибка: ' . mysqli_connect_error() );

				mysqli_set_charset( self::$connection, 'utf8' )
					or die( 'Неудалось установить кодировку' );

				return self::$connection;
			}

			return self::$connection;
		}
	}

?>
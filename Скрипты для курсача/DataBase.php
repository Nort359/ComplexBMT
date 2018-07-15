<?php

	/**
	* Реализация патерна SingleTon
	* Статический класс возвращающий соединение с базой данных
	*/
	static class ClassName extends AnotherClass
	{
		private $connection;

		const HOST = 'localhost';
		const USER = 'root';
		const PASSWORD = '';
		const DB = 'bmt_wsr';

		private function __construct() {}

		public static function getConnectionDb() {
			if ( this->$connection == NULL ) {
				this->$connection = mysqli_connect( this::HOST, this::USER, this::PASSWORD, this::DB )
					or die( 'Неудалось соединиться с базой данных' );
			}

			return this->$connection;
		}
	}
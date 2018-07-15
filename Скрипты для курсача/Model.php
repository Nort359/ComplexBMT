<?php

	/**
	* Реализация модели
	*/
	class Model
	{
		function __construct()
		{
			
		}

		public static function getRows( $query, $limit ) {
			if ( empty( $limit ) ) {
				if ( is_integer( (int)$limit ) ) {
					if ( !empty( $query ) ) {
						$query .= " LIMIT $limit";
					} else {
						throw new Error( 'Переменная $query должна быть заполнена' );
					}
				} else {
					throw new Error( 'Переменная $limit должна быть цифрой' );
				}
			}

			$resultQuery = mysqli_query( DataBase::getConnectionDB(), $query )
				or die( 'Неудалось отправить запрос с БД. Ошибка: '
						. mysqli_error( DataBase::getConnectionDB() ) );

			return $rows = mysqli_fetch_all( $result, MYSQLI_ASSOC )
				or die( 'Неудалось выбрать данные. Ошибка: '
						. mysqli_error( DataBase::getConnectionDB() ) );
		}

		public static function rowsCRUD( $query ) {
			if ( !empty( $query ) ) {
				$resultQuery = mysqli_query( DataBase::getConnectionDB(), $query )
					or die( 'Неудалось отправить запрос с БД. Ошибка: '
							. mysqli_error( DataBase::getConnectionDB() ) );

				return mysqli_affected_rows( $resultQuery ) > 0 ? true : false;
			} else {
				throw new Error( 'Переменная $query должна быть заполнена' );
			}
		}
	}

?>
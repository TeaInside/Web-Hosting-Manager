<?php

use Hub\Singleton;

class DB
{	
	use Singleton;

	/**
	 * @var \PDO
	 */
	private $pdo;

	/**
	 * Constructor.
	 */
	final public function __construct()
	{
		$this->pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PASS);
	}

	/**
	 * @param string $method
	 * @param array $parameters
	 * @return mixed
	 */
	final public static function __callStatic($method, $parameters)
	{
		return self::getInstance()->pdo->{$method}(...$parameters);
	}

	/**
	 * @return \PDO
	 */
	final public static function pdo()
	{
		return self::getInstance()->pdo;
	}
}

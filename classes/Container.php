<?php

class Container implements ArrayAccess
{
	use \Hub\Singleton;

	private $container = [];

	protected function __construct($username)
	{
		$this->container = json_decode(file_get_contents(data."/users/{$username}"), true);
	}

	public static function &gi()
	{
		return self::$instance;
	}

	public static function init($user)
	{
		self::getInstance($user);
	}

	public function &offsetGet($offset)
	{
		return $this->container[$offset];
	}

	public function offsetSet($offset, $value)
	{
		$this->container[$offset] = $value;
	}

	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->container);
	}

	public function offsetUnset($offset)
	{
		unset($this->container[$offset]);
	}

	private static function offsetHash($offset)
	{
		return is_object($offset) ? spl_object_hash($offset) : json_encode($offset, JSON_UNESCAPED_SLASHSES);
	}
}

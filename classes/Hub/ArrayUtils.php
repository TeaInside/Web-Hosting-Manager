<?php

namespace Hub;

trait ArrayUtils
{
	/**
	 * @var string
	 */
	private $___arrayContainerName = "__arrayContainer";

	/**
	 * @var array
	 */
	private $__arrayContainer = [];

	/**
	 * @param mixed $offset
	 * @return mixed
	 */
	public function &offsetGet($offset)
	{
		return $this->{$this->___arrayContainerName}[$offset];
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 * @return void
	 */
	public function offsetSet($offset, $value)
	{
		$this->{$this->___arrayContainerName}[$offset] = $value;
	}

	/**
	 * @param mixed $offset
	 * @return bool
	 */
	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->{$this->___arrayContainerName});
	}

	/**
	 * @param mixed $offset
	 * @return void
	 */
	public function offsetUnset($offset)
	{
		unset($this->{$this->___arrayContainerName}[$offset]);
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return $this->__toArray();
	}

	/**
	 * @param string|int $name
	 * @return null
	 */
	public function __get($name)
	{
		return null;
	}

	/**
	 * @return array
	 */
	public function __toArray()
	{
		return $this->{$this->___arrayContainerName}; 
	}

	/**
	 * @param mixed $offset
	 * @return string
	 */
	private static function offsetHash($offset)
	{
		return is_object($offset) ? spl_object_hash($offset) : json_encode($offset, JSON_UNESCAPED_SLASHSES);
	}
}

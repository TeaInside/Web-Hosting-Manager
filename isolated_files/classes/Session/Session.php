<?php

namespace Session;

use Countable;
use ArrayAccess;
use Serializable;
use JsonSerializable;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @package \Session
 * @license MIT
 * @version 0.0.1
 */
final class Session implements Countable, ArrayAccess, JsonSerializable
{
	/**
	 * @var self
	 */
	private static $self;

	/**
	 * @var array
	 */
	private $container = [];

	/**
	 * @var string
	 */
	private $sessionId;

	/**
	 * @var string
	 */
	private $sessionFile;

	/**
	 * @var bool
	 */
	private $destroy = false;

	/**
	 * @param string $sessionId
	 *
	 * Constructor.
	 */
	public function __construct(string $sessionId)
	{
		$this->sessionId = $sessionId;
		if (file_exists($this->sessionFile = SESSION_PATH."/{$this->sessionId}.ses")) {
			$this->container = @unserialize(file_get_contents($this->sessionFile));
			if (! is_array($this->container)) {
				$this->container = [];
			}
		}
	}

	/**
	 * @param string $sessionId
	 * @return self
	 */
	public static function &getInstance($sessionId = null)
	{
		if (self::$self == null) {
			self::$self = new self($sessionId);
		}
		return self::$self;
	}

	/**
	 * @param string $sessionId
	 * @return self
	 */
	public static function &gi($sessionId)
	{
		return self::getInstance($sessionId);
	}

	/**
	 * @return void
	 */
	public function destroy()
	{
		$this->destroy = true;
		$this->container = [];
	}

	/**
	 * @param mixed $offset
	 * @param mixed $value
	 * @return void
	 */
	public function offsetSet($offset, $value)
	{
		$this->container[$offset] = $value;
	}

	/**
	 * @param mixed $offset
	 * @return mixed
	 */
	public function &offsetGet($offset)
	{
		if ($this->offsetExists($offset)) {
			return $this->container[$offset];
		} else {
			return $this->__;
		}
	}

	/**
	 * @param mixed $offset
	 * @return bool
	 */
	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->container);
	}

	/**
	 * @param mixed $offset
	 * @return void
	 */
	public function offsetUnset($offset)
	{
		unset($this->container[$offset]);
	}

	/**
	 * @return int
	 */
	public function count()
	{
		return count($this->container);
	}

	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		return $this->container;
	}

	public function __destruct()
	{
		if ($this->destroy) {
			file_exists($this->sessionFile) and unlink($this->sessionFile);
		} else {
			file_put_contents($this->sessionFile, serialize($this->container));
		}
	}
}

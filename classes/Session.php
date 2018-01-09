<?php

use Hub\Singleton;
use Hub\ArrayUtils;
use Hub\SerializableUtils;
use Security\Encryption\IceCrypt;

final class Session implements ArrayAccess, Serializable, JsonSerializable
{
	use Singleton, ArrayUtils, SerializableUtils;

	/**
	 * @var string
	 */
	private $sessionName;

	/**
	 * @var array
	 */
	private $sessionContainer = [];

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->___arrayContainerName = "sessionContainer";
		if (isset($_COOKIE[SESSION_COOKIE_NAME])) {
			$this->sessionName = $_COOKIE[SESSION_COOKIE_NAME];
			$this->sessionContainer = file_exists(SESSION_PATH."/".$this->sessionName) ? unserialize(IceCrypt::decrypt(file_get_contents(SESSION_PATH."/".$this->sessionName), $this->sessionName, false)) : [];
			$this->sessionContainer = is_array($this->sessionContainer) ? $this->sessionContainer : [];
		} else {
			$this->sessionContainer = [];
			setcookie(SESSION_COOKIE_NAME, $this->sessionName = rstr(72), time() + (SESSION_EXPIRED_TIME));
		}
	}

	/**
	 * @param mixed $key
	 * @param mixed $val
	 * @return mixed
	 */
	public static function set($key, $val)
	{
		$ins = self::getInstance();
		$ins[$key] = $val;
		return $val;
	}

	/**
	 * @return array
	 */
	public static function getAll()
	{
		return self::getInstance()->__toArray();
	}

	/**
	 * @param mixed $key
	 */
	public static function get($key, $default = null)
	{
		$ins = self::getInstance();
		if (array_key_exists($key, $ins)) {
			return $ins[$key];
		}
		return $default;
	}

	/**
	 * Destroy session.
	 */
	public static function destroy()
	{
		$ins = self::getInstance();
		if (file_exists(SESSION_PATH."/".$ins->sessionName)) {
			unlink(SESSION_PATH."/".$ins->sessionName);
		}
		$ins->sessionContainer = [];		
		setcookie(SESSION_COOKIE_NAME, null, 0);
	}

	/**
	 * Destructor.
	 */
	public function __destruct()
	{
		if ($this->sessionContainer) {
			file_put_contents(SESSION_PATH."/".$this->sessionName, IceCrypt::encrypt(serialize($this->sessionContainer), $this->sessionName, false));
		}
	}
}

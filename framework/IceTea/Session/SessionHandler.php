<?php

namespace IceTea\Session;

use IceTea\Hub\Singleton;

class SessionHandler
{
	use Singleton;

	private $sessionId;

	private $sessionFile;

	private $sesContainer = [];

	public function __construct()
	{
		if (isset($_COOKIE['icetea_session'])) {
			$this->sessionId = $_COOKIE['icetea_session'];
			if (file_exists($this->sessionFile = basepath("storage/framework/session/".$this->sessionId))) {
				$this->sesContainer = unserialize(file_get_contents($this->sessionFile));
			} else {
				$this->sesContainer = [];
			}
		} else {
			setcookie("icetea_session", $this->sessionId = time()."_".rstr(32), time() + (3600*24*14));
			$this->sessionFile = basepath("storage/framework/session/".$this->sessionId);
		}
	}

	public static function get($key)
	{
		$ins = self::getInstance();
		return array_key_exists($key, $ins->sesContainer) ? $ins->sesContainer[$key] : null;
	}

	public static function set($key, $value)
	{
		$ins = self::getInstance();
		$ins->sesContainer[$key] = $value;
	}

	public function __destruct()
	{
		file_put_contents($this->sessionFile, serialize($this->sesContainer), LOCK_EX);
	}
}

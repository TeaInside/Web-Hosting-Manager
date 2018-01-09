<?php

namespace Hub;

trait Singleton
{
	/**
	 * @var self
	 */
	private static $instance;

	/**
	 * @param mixed ...$parameters
	 */
	public static function getInstance(...$parameters)
	{
		if (self::$instance === null) {
			self::$instance = new self(...$parameters);
		}
		return self::$instance;
	}

	final private function __clone()
	{
	}
}

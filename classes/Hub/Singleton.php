<?php

namespace Hub;

trait Singleton
{
	private static $instance;

	public static function getInstance(...$parameters)
	{
		if (self::$instance === null) {
			self::$instance = new self(...$parameters);
		}
		return self::$instance;
	}
}
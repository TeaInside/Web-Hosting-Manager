<?php

namespace ConfigGenerator;

use Contracts\ConfigGenerator as ConfigGeneratorContract;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @package \Session
 * @license MIT
 * @version 0.0.1
 */
final class Nginx implements ConfigGeneratorContract
{
	/**
	 * @var array
	 */
	private $container = [];

	/**
	 * Constructor.
	 */
	public function __construct()
	{
	}
}

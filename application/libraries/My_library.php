<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_library {

	private $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
	}

	public function my_function($arg1, $arg2)
	{
		// Do your stuff!
	}
}

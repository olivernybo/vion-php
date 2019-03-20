<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		$my_class = new My_class('var');
		
		$this->vion->setData(get_class($this->vion), 'library')
			->setData(VIEWPATH.strtolower(get_class($this)).'/'.$this->router->fetch_method().'.php', 'view')
			->setData(APPPATH.'controllers/'.get_class($this).'.php', 'controller')
			->view();
	}
}

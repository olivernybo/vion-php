<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index()
	{
		$this->vion->set_data(get_class($this->vion), 'library')
			->set_data(VIEWPATH.get_class($this).'/'.$this->router->fetch_method().'.php', 'view')
			->set_data(APPPATH.'controllers/'.get_class($this).'.php', 'controller')
			->view();
	}
}
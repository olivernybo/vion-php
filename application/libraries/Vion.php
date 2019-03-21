<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vion {

	private $ci;

	public $views;
	public $data;

	public function __construct()
	{
		$this->ci = &get_instance();

		$this->ci->config->load('vion');
		$this->ci->load->database();
		$this->ci->load->library('session');
		$this->ci->load->library('parser');
		
		$this->data = array();
		$this->views = array();

		$this->define();

		foreach ($this->ci->config->item('constants') as $key => $value) {
			$this->setData($value, $key);
		}

		if ($this->ci->config->item('load_sessions')) {
			$this->loadDataFromSessions();
		}
		
		foreach ($this->ci->config->item('autoload')['libraries'] as $library => $args) {
			if (is_string($args)) {
				$library = $args;
				$args = array();
			}
			$alias = $args['alias'] ?: null;
			if (!$this->ci->load->is_loaded($library)) {
				$this->ci->load->library($library, null, $alias);
			}
			foreach ($args['methods'] as $method => $arguments) {
				$lib = $alias ? strtolower($alias) : strtolower($library);
				call_user_func_array(array($this->ci->$lib, $method), $arguments);
			}
		}

		$this->loadClass($this->ci->config->item('autoload')['classes']);
	}

	private function define()
	{
		define('VION_VERSION', file_get_contents(FCPATH.'.vion_version'));

		$class_folder = APPPATH.$this->ci->config->item('class_folder');
		define('VION_CLASS_PATH', $class_folder{-1} == '/' ? $class_folder : $class_folder.'/');

		define('VION_LOAD_TYPE_SESSION', 'VION_LOAD_TYPE_SESSION');
	}
	
	public function view($template = null)
	{
		$this->addView($this->ci->router->fetch_method(), $this->ci->router->fetch_class())
			->addTemplate($template)
			->parseViews();
	}

	public function addView($html, $folder = '')
	{
		if (is_array($html)) {
			foreach ($html as $value) {
				if (is_string($value)) {
					$this->views[] = ($folder ? $folder.'/' : '').$value;
				} else {
					throw new Exception('Array must be made of type string.');
				}
			}
		} else if (is_string($html)) {
			$this->views[] = ($folder ? $folder.'/' : '').$html;
		} else {
			throw new Exception('First argument must be type string or array.');
		}

		return $this;
	}

	public function parseView($html)
	{
		$this->ci->parser->parse($html, $this->data);

		return $this;
	}

	public function parseViews()
	{
		foreach ($this->views as $html) {
			$this->parseView($html);
		}

		return $this;
	}

	public function loadDataFromSessions()
	{
		foreach ($this->ci->config->item('sessions') as $session => $path) {
			$data = $this->ci->session->userdata($session);
			if ($data) {
				call_user_func_array(array($this, 'setData'), array_merge(array($data), $path));
			}
		}

		return $this;
	}

	public function addTemplate($template = null)
	{
		$template_top = array();
		$template_bottom = array();

		$templates = $this->ci->config->item('templates');
		$t = $template ?: $this->ci->config->item('standard_template');
		$temp = $templates[$t];
		$folder = $this->ci->config->item('template_folder').'/';

		foreach ($temp['top'] as $html) {
			$template_top[] = $folder.$html;
		}

		foreach ($temp['bottom'] as $html) {
			$template_bottom[] = $folder.$html;
		}

		$this->views = array_merge($template_top, $this->views, $template_bottom);

		return $this;
	}

	public function setData($data, string ...$path)
	{
		$curr = &$this->data;

		foreach ($path as $key) {
			if ($key) {
				$curr = &$curr[$key];
			} else {
				$curr = &$curr[];
			}
		}

		$curr = $data;

		return $this;
	}

	public function loadClass($class)
	{
		if (is_array($class)) {
			foreach ($class as $c) {
				$this->loadClass($c);
			}
		} else if (is_string($class)) {
			$class_path = VION_CLASS_PATH.$class.'.php';
			include $class_path;
		}
	}

	public function update()
	{
		$github_version = file_get_contents('https://raw.githubusercontent.com/olivernybo/vion/master/.vion_version?f='.date('Ymdhis'));
		$vion = file_get_contents('https://raw.githubusercontent.com/olivernybo/vion/master/application/libraries/Vion.php?f='.date('Ymdhis'));

		file_put_contents(__FILE__, $vion);
		file_put_contents(FCPATH.'/.vion_version', $github_version);
	}

	public function updatesAvailable()
	{
		$github_version = file_get_contents('https://raw.githubusercontent.com/olivernybo/vion/master/.vion_version?f='.date('Ymdhis'));

		return $github_version === VION_VERSION ? false : $github_version;
	}
}

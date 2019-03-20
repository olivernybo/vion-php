<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['load_sessions'] = true;

$config['sessions'] = array(
	'session_name' => array(
		'data',
		'index',
		'path'
	)
);

$config['template_folder'] = 'templates';

$config['templates'] = array(
	'main' => array(
		'top' => array(
			'main/head',
			'main/nav'
		),
		'bottom' => array(
			'main/footer',
			'main/end'
		)
	)
);

$config['standard_template'] = 'main';

$config['constants'] = array(
	'css' => array(
		array(
			'style' => base_url('assets/css/main.css')
		)
	)
);

$config['autoload'] = array(
	'libraries' => array(
		'My_library' => array(
			'alias' => 'my_lib',
			'methods' => array(
				'my_function' => array(
					'my_arg1',
					'my_arg1'
				)
			)
		)
	),
	'classes' => array(
		'My_class'
	)
);

$config['class_folder'] = 'classes';
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// User database table
$config['user_db_table'] = 'users';
// What key to search in the database
$config['user_db_search_key'] = 'u_email';

// What to set the user data key as
$config['data_user_key'] = 'user';
// What key to search in the sessions
$config['session_user_key'] = 'user';

// The template folder the loader should look for
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
	'My_library' => array(
		'alias' => 'my_lib',
		'methods' => array(
			'my_function' => array(
				'my_arg1',
				'my_arg1'
			)
		)
	)
);
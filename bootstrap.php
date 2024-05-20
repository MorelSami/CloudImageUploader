<?php

use Dotenv\Dotenv;

require_once  'vendor/autoload.php';

//load environmental variable file [.env]
$dotenv = Dotenv::createImmutable(__DIR__);
if(file_exists(".env")) {
    $dotenv->load();
}
define('APP_ENV', $_ENV['APP_ENV']);

switch (APP_ENV)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
		ini_set('file_uploads', 'on');
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		ini_set('file_uploads', 'on');
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

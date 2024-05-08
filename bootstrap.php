<?php
require_once  vendor/autoload.php;

//load environmental variable file [.env]
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
define('ENVIRONMENT', $_ENV['ENVIRONMENT']);

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

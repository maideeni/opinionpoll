<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}


// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);


// Database
$db = new DB(DB_DRIVER, DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$registry->set('db', $db);


$url = new Url(HTTP_SERVER);
$registry->set('url', $url);


// Log
$log = new Log('error.log');
$registry->set('log', $log);

function error_handler($errno, $errstr, $errfile, $errline) {
	global $log, $config;

	// error suppressed with @
	if (error_reporting() === 0) {
		return false;
	}

	switch ($errno) {
		case E_NOTICE:
		case E_USER_NOTICE:
			$error = 'Notice';
			break;
		case E_WARNING:
		case E_USER_WARNING:
			$error = 'Warning';
			break;
		case E_ERROR:
		case E_USER_ERROR:
			$error = 'Fatal Error';
			break;
		default:
			$error = 'Unknown';
			break;
	}

	
	echo '<b>' . $error . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b>';


	$log->write('PHP ' . $error . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);
	

	return true;
}

// Error Handler
set_error_handler('error_handler');

// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$response->setCompression(0);
$registry->set('response', $response);

// Session
$session = new Session();
$registry->set('session', $session);


// Front Controller
$controller = new Front($registry);

//echo '<pre>'.print_r($controller, true).'</pre>';


// Router
if (isset($request->get['route'])) {
	//echo 'test1';
	$action = new Action($request->get['route']);
} else {
	//echo 'test2';
	$action = new Action('opinionpoll/opinion');
}

//echo '<pre>'.print_r($action, true).'</pre>';


// Dispatch
$controller->dispatch($action, new Action('error/not_found'));

// Output
$response->output();

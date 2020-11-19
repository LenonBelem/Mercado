<?php
	header('Content-Type: application/json; charset=UTF-8');
	
	require_once 'vendor/autoload.php';

	use App\Http\Route;


	if(isset($_REQUEST)){
		$url = array();
		$url['url'] = str_replace("/api/", "", $_SERVER["REQUEST_URI"]);
		$route = new Route($url);
		echo $route->run();
	}
<?php 

	require_once __DIR__.'/../vendor/autoload.php';

	$request = new \App\Core\Request();

	print (new \App\Core\Application($request))->output();
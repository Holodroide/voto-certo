<?php
	

	# Start the session 
	session_start();
	
	# Autoload the required files
	require_once __DIR__ . '/vendor/autoload.php';

	# Set the default parameters
	$fb = new Facebook\Facebook([
	  'app_id' => '1790983760956083',
	  'app_secret' => '0fa9970e23f3c2c977b10e234bb27653',
	  'default_graph_version' => 'v2.9',
	]);
	$redirect = 'https://www.holodroide.com/';

	# Create the login helper object
	$helper = $fb->getRedirectLoginHelper();
var_dump($helper);
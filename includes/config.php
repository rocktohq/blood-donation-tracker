<?php
	
	/*
	#	Application by 
	#	Design & Developed by 
	#	Contact: 
	*/
	
	// Database Information
	$host = "localhost";
	$dbname = "donation";
	$dbuser = "donation";
	$dbpass = "donation";
	
	
	// Let's try to Connect
	$con = new mysqli($host, $dbuser, $dbpass, $dbname);

	// If there is any Error
	if($connect -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $connect -> connect_error;
	  exit();
	}
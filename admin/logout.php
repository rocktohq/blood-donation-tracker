<?php
	
	/*
	#	Application by 
	#	Design & Developed by 
	#	Contact: 
	*/
	
	
	# Session Start
	session_start();

	# Destroy the Sesson
	session_destroy();
	
	# Redirect to Login page
	header("Location: login.php");


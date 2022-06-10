<?php
	
	/*
	#	Application by 
	#	Design & Developed by 
	#	Contact: 
	*/
	
	# Destroy the Sesson
	session_destroy();
	
	# Redirect to Login page
	header("Location: login.html");

?>
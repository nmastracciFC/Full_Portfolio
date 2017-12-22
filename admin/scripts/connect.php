<?php
//this file will connect us to the database

	$user = "root";
	$pass = "root";
	$url = "localhost";
	$db = "db_movies";

//key to access the database
	$link = mysqli_connect($url, $user, $pass, $db, "8888"); //must be in this order and port must be divorced from the URL path

	//incase the connection fails.. error!
	if(mysqli_connect_errno()) {
		//forces it into a formatted string whereas echo could be anything
		printf("Connection Failed: %s\n", mysqli_connect_error());
		exit();
	}



?>
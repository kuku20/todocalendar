<?php 
	session_start();

	// connect to database
    $link = mysqli_connect("localhost", "root", "mysql", "calender");

	if (!$link) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
// 	define('BASE_URL', 'http://localhost/complete-blog-php/');
?>

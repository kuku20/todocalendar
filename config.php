<?php 
	session_start();

	// connect to database
    $link = mysqli_connect("localhost", "root", "mysql", "dataclass");
    // $link = mysqli_connect("sql209.epizy.com", "epiz_25705134", "XfQ146m0SP", "epiz_25705134_calendartodo");
	if (!$link) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
// 	define('BASE_URL', 'http://localhost/complete-blog-php/');
?>

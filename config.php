<?php
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	error_reporting(0);
	require ('vendor/autoload.php');
	try {
	    $client = new MongoDB\Client('mongodb+srv://web123:sKipVYtASpVkYKCh@cluster0.uscd7.azure.mongodb.net/todocalender');
	    // $client = new MongoDB\Client('mongodb+srv://grabriel:lT2NJ49bghV8gTF5@data2u.f9hzo.mongodb.net/todo');
	} catch (Exception $e) {
		echo "<p>Check you connection</p>";
	    echo $e->getMessage();
	}
	// session_start();
	
?>
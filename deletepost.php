<!-- call through ajax form todoClock.js -->
<?php
	require ('vendor/autoload.php');
 	require_once('config.php');
	if($_GET['delete']){
		// $id=$_GET['id'];
		$id=  new \MongoDB\BSON\ObjectId($_GET['id']);
      	$collection = $client->todocalender->userdiary;
      	$collection->deleteOne(['_id' => $id]);
		header('location: mainpage.php');
	}
	exit();
?>
<?php require_once('../config.php') ?>
<?php  require ('../vendor/autoload.php')?>
<?php require_once('../session.php') ?>

<?php 
	$userdiary = $_SESSION['username']; 
	$userdiaryDB = $client->todocalender->userdiary;

// for video only===========
	$videolinks=array();
	$videodates=array();
	$videos = $userdiaryDB->find(['userdiary' => $userdiary, 'category' => 'video']);
	foreach ($videos as $key) {
		array_push($videolinks,$key['note']);
		array_push($videodates,$key['date_post']);
	}
	$videolinks = array_reverse($videolinks);
	$videodates = array_reverse($videodates);
	if(isset($_GET['start']) && isset($_GET['end'])){
	  	$start = $_GET['start'];
	  	$end = $_GET['end'];
	  	for ($x = $start; $x <$end; $x++){
			echo '<h3>';
			// echo $videodates[$x];
			echo ' :</h3>'; 
			echo $videolinks[$x];
			echo '<hr>';
		}
}
 ?>
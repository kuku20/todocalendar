<?php require_once('../config.php') ?>
<?php  require ('../vendor/autoload.php')?>
<?php require_once('../session.php') ?>
<?php 
	$userdiary = $_SESSION['username']; 
	$userdiaryDB = $client->todocalender->userdiary;
	$date = $userdiaryDB->find(['userdiary' => $userdiary]);
		// to have the array to put data from the database
	$data=array();
	foreach ($date as $key) {
		$date_post = $key['date_post'];
		// to push the data to array data
		array_push($data,$date_post);
	}
		// reverse and unique the array
	$result = array_reverse(array_unique($data));
 ?>
	<!-- <div id="displayAll"> -->
	  	<?php
	  	// get from secret.php in ajax
	  	if(isset($_GET['start']) && isset($_GET['end'])){
	  		$start = $_GET['start'];
	  		$end = $_GET['end'];
	  	
			//  use the foreach to print the array
			// foreach ($result as &$value) {
	  		for ($x = $start; $x <$end; $x++){
			//  select each data form array to select on the database
		?>
			<h1 style=" text-align: center;" ><? echo $result[$x] ?> </h1>

		<?php	
			$detail = $userdiaryDB->find(['userdiary' => $userdiary, 'date_post'=> $result[$x]]);
		?> 
		<div class=''> 
			<?php
				foreach ($detail as $key) {    
				    $note = $key['note'];
			?>
			        <div >   
						<span >  You wrote: <span class="delete" id="<? echo $row["id"] ?>" ></span>
				        <span class="note"><? echo $note ?></span>
				        </span>        			
			        </div>
				<hr>
			<?php }}}?>
		</div>
	<!-- </div> -->

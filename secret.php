<!-- calling form diary.php -->

<?php require_once('config.php') ?>
<?php  require ('vendor/autoload.php')?>
<?php require_once('session.php') ?>
<?php require_once( ROOT_PATH . '/secretincludes/header.php') ?>
<title>Your Diary </title>
<style>
	body{
	    font-family: 'Roboto', sans-serif;
		background: #dd3e54;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to right, #6be585, #dd3e54);  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to right, #6be585, #dd3e54); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    .delete {
	    color: red;
	    position: absolute;
	    right: 150px;
	    cursor: pointer;
    }
	.note{
  		font-size:1.5em;
	}
	/* Style the tab content */
	.tab {
		overflow: hidden;
		font-size: 50px;
		/*border: 1px solid #ccc;*/
		/*background-color: #f1f1f1;*/
	}
	.tab button {
  	background-color: inherit;
  	font-size: 30px;
  	float: center;
  	border: none;
  	outline: none;
  	cursor: pointer;
  	padding: 14px 16px;
  	transition: 0.3s;
}
	.tabcontent {
	  	display: none;
	  	padding: 12px 12px;

	  	/*border-top: none;*/
	}

</style>
</head>
<body>
	<!-- container - wraps whole page -->
	<!-- navbar -->
	<?php include( ROOT_PATH . '/secretincludes/navbar.php') ?>
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
	// for link only===========
		$link=array();
		$linkdate=array();
		$videos = $userdiaryDB->find(['userdiary' => $userdiary, 'category' => 'link']);
		foreach ($videos as $key) {
			array_push($link,$key['note']);
			array_push($linkdate,$key['date_post']);
		}
		$link = array_reverse($link);	
		$linkdate = array_reverse($linkdate);	
	// for video only===========
		$text=array();
		$textdate=array();
		$videos = $userdiaryDB->find(['userdiary' => $userdiary, 'category' => 'text']);
		foreach ($videos as $key) {
			array_push($text,$key['note']);
			array_push($textdate,$key['date_post']);
		}
		$text = array_reverse($text);
		$textdate = array_reverse($textdate);
	?>

	<!-- // navbar -->
	<!-- Tab links -->
	<div class="tab">
		<a href="secret.php">Hello <?php echo $_SESSION['username']; ?></a>
	  	<button class="tablinks" onclick="openOption(event, 'Video')">Video</button>
	  	<button class="tablinks" onclick="openOption(event, 'Links')">Links</button>
	  	<button class="tablinks" onclick="openOption(event, 'Notes')">Notes</button>
	</div>
	<hr>
	<div id="Video" class="tabcontent">
	  	<?php
			foreach (array_combine($videolinks,$videodates) as $key=>$date) {
			echo '<h3>';
			echo $date;
			echo ' :</h3>'; 
			echo $key;
			echo '<hr>';
			}
		?>
	</div>
	<div id="Links" class="tabcontent">
	  	<?php 
  		foreach(array_combine($link,$linkdate) as $key=>$date) {
			echo '<h3>';
			echo $date;
			echo ' :</h3>'; 
			echo $key;
			echo '<hr>';
		}
		?>	
	</div>
	<div id="Notes" class="tabcontent">
	  	<?php
	  	// foreach ($result as $date) {
	  		// $links = $userdiaryDB->find(['userdiary' => $userdiary,'category' => 'text']);
			foreach(array_combine($text,$textdate) as $key=>$date) {
				echo '<h3>';
				echo $date;
				echo ' :</h3>'; 
				echo $key;
				echo '<hr>';
		}?>	
	</div>
	<div id="displayAll">
	  	<?php
			//  use the foreach to print the array
			foreach ($result as &$value) {
	  		// for ($x = 0; $x <=3; $x++){
			//  select each data form array to select on the database
		?>
			<h1 style=" text-align: center;" ><? echo $value ?> </h1>
			<hr>
		<?php	
			$detail = $userdiaryDB->find(['userdiary' => $userdiary, 'date_post'=> $value]);
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
			<?php }}?>
		</div>
	</div>
	<!-- footer -->
	<?php include( ROOT_PATH . '/includes/footer.php') ?>
	<!-- // footer -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
function openOption(evt, Option) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(Option).style.display = "block";
	evt.currentTarget.className += " active";
	document.getElementById("displayAll").style.display = "none";;
}
// $(document).ready(function(){
// 	$(window).scroll(function(){
// 		if($(window).scrollTop() >=$(document).height() -$(window).height()){
// 			alert();
// 		}
// 	});
// });
</script>
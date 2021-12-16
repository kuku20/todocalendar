

<?php require_once('config.php') ?>
<?php require_once('session.php') ?>
<?php require_once( ROOT_PATH . '/secretincludes/header.php') ?>
	<title>Your Diary </title>
	<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">	 -->
<style>
	body{
    font-family: 'Roboto', sans-serif;
	background: #dd3e54;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #6be585, #dd3e54);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #6be585, #dd3e54); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
</style>

</head>
<body>
	<!-- container - wraps whole page -->
	
		<!-- navbar -->
		<?php include( ROOT_PATH . '/secretincludes/navbar.php') ?>
		<!-- // navbar -->
		

<h1>Hello <?php echo $_SESSION['username']; ?></h1>
<div class="ui raised very padded text contenner segment">
  

  <?php
$userdiary = $_SESSION['username']; 
$sql = "SELECT *  FROM user WHERE userdiary='$userdiary'  ";
$result = mysqli_query($link,$sql);
// to have the array to put data from the database
$data=array();
while($row = mysqli_fetch_array($result)) {     
	$date_post =$row['date_post'];
	// to push the data to array data
	array_push($data,$date_post);
	}
	// reverse and unique the array
	$result = array_reverse(array_unique($data));
	//  print_r($result);
	//  use the foreach to print the array
	 foreach ($result as &$value) {
		//  select each data form array to select on the database
	?>
	<h1 style=" text-align: center;" ><? echo $value ?> </h1>
	<hr>
	<?php	
	 $sql1 = "SELECT *  FROM user WHERE userdiary='$userdiary' AND date_post= '$value' ";
    $result1 = mysqli_query($link,$sql1);

    ?> <div class='main-container'> <?php
      
      while($row = mysqli_fetch_array($result1)) {  
      // $ids=$row['id'];     
      $note = $row['note'];
      
           ?>
        <div >  
            
		<span >  You wrote: <span class="delete" id="<? echo $row["id"] ?>" ></span>
                <span class="note"><? echo $note ?></span>
                 </span>
                
				
        </div>
		<hr>
     <?php }

}

    ?>
	<style>
      .delete {
                color: red;
                position: absolute;
                right: 150px;
                cursor: pointer;
                }
.note{
  font-size:1.5em;
}
	</style>
	
	

</div>






		<!-- footer -->
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
		<!-- // footer -->
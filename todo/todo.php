<?php 
	session_start();

	// connect to database
    $link = mysqli_connect("localhost", "root", "mysql", "calender");

	if (!$link) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/complete-blog-php/');
?>

<?php include('todo/server.php'); ?>
<h1>Todo Day Lists <a href="todo/editdaylist.php">Edit</a> <i class="fa fa-plus"></i></h1>


<input type="text" name="" id="tododay" placeholder="Add New Todo">
<ul>
    <!-- <li> <span class="halo"><i class="fa fa-trash"></i></span> wake up at 6h30</li> -->
<?php
// session_start();
// include ("connection.php");

$link = mysqli_connect("localhost", "root","mysql","calender");

// Check connection
if ($link->connect_error) {
die("Connection failed: " . $link->connect_error);
}
$sql = "SELECT id, tododay  FROM todo WHERE usertodo ='Loc' AND donedate != CURRENT_DATE() ";
$result = mysqli_query($link,$sql);

?>  

<?php
while($row = mysqli_fetch_array($result)) {  
$ids=$row['id'];     

$tododay = $row['tododay'];
// $created =$row['created_at'];
   ?>
<li> <span id="<? echo $row['id'] ?>" class="halo"  ><i class="fa fa-trash"></i></span> 
<? echo $tododay ?>   
</li>

<?php }


?>


</ul>

<h1> Specical Todo</h1>
<ul>

<?php

$sql = "SELECT *  FROM events WHERE userEvent ='kuku20' AND start = CURRENT_DATE()  ";
$result = mysqli_query($link,$sql);

?>  

<?php
while($row = mysqli_fetch_array($result)) {  
$ids=$row['id'];     
$start = $row['start'];
$tododay = $row['title'];
   ?>
   <p>
<li> <span id="<? echo $row['id'] ?>" class="halo"  ><i class="fa fa-trash"></i></span> 
<strong><? echo $tododay ?>,6) </strong>  <span><? echo $start ?></span> 
</li>
</p>
<?php }


?>

</ul>
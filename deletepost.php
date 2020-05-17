
<?php
$link = mysqli_connect("localhost", "root","mysql","calender");
  
if($link === false){ 
    die("ERROR: Could not connect. " . mysqli_connect_error()); 
} 
if($_GET['delete'])
{

$id=$_GET['id'];
$delete = "DELETE FROM `user` WHERE id=".$id;
mysqli_query( $link,$delete);
}
exit();
?>
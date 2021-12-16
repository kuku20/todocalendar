
<?php
 require_once('config.php');
if($_GET['delete'])
{

$id=$_GET['id'];
$delete = "DELETE FROM `user` WHERE id=".$id;
mysqli_query( $link,$delete);
header('location: mainpage.php');
}
exit();
?>
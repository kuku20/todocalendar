<?php 

  $link = mysqli_connect("localhost", "root","mysql","calender");
  if (!$link) {
    die('Connection failed ' . mysqli_error($link));
  }
  if (isset($_POST['save'])) {
    $usertodo = 'Loc';
  	$tododay = $_POST['tododay'];
  	$sql = "INSERT INTO todo (usertodo, tododay, donedate) VALUES ('{$usertodo}', '{$tododay}','toidl')";
  mysqli_query($link, $sql);
   echo "You've been posted up!";
    header('location: index.php');
  	exit();
  }

 if (isset($_POST['update'])) {

$id = $_POST['id'];
date_default_timezone_set('America/Phoenix');
 $donedate = date('Y-m-d');

$update = "UPDATE todo SET donedate =  CURRENT_DATE() WHERE `id` =".$id;
mysqli_query( $link,$update);

echo "You've been delete up!";

}
echo $donedate;

    ?>
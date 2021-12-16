<?php 	


require_once('config.php') ?>
<?php 

  session_start([
    'cookie_lifetime'=>2592000,
  ]); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: index.php');
  }
  if ($_GET["logout"]== 1 AND $_SESSION['id']) {
  	session_destroy();
      
      header('location: index.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
?>
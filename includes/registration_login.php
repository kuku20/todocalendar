<?php require_once('config.php') ?>
<?php//  require ('vendor/autoload.php')?>
<?php
session_start([
    'cookie_lifetime'=>2592000,
  ]);
if($_GET["logout"]== 1 AND $_SESSION['id']) {
  session_destroy();
  $message = "You have been logged out. Have a nice day!";

}

// initializing variables
// require_once ('../config.php');
$username = "";
$password = "";
$email    = "";
$errors = array(); 


// REGISTER USER
if (isset($_POST['reg_user'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];
  $collection = $client->todocalender->users;

  // receive all input values from the form
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $_SESSION['username'] = $username;
    $password = md5($password_1);//encrypt the password before saving in the database

    $insertOneResult = $collection->insertOne([
        'username'  => $username,
        'email'   => $email,
        'password' => $password,
      ]);
    $getnewuser = $collection->findOne(['username' => $username]);
    echo "You've been signed up!";
    $_SESSION['id'] = $getnewuser['_id'];
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: mainpage.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
      $collection = $client->todocalender->users;
      $document = $collection->findOne(['username' => $username]);
      $password = md5($password);
      if($document['password']==$password){
        $_SESSION['id']=$document['_id'];
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
          header('location: mainpage.php');
      }else{
        array_push($errors, "Wrong username/password combination");
      }
    }
  }
  
  ?>
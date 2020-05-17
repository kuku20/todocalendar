<!-- this is the login -->
<style>
</style>
<?php
session_start();
if($_GET["logout"]== 1 AND $_SESSION['id']) {
    session_destroy();
    $message = "You have been logged out. Have a nice day!";

}
?>
<?php  include('config.php'); ?>
<!-- Source code for handling registration and login -->
<?php  include('includes/registration_login.php'); ?>
<div class="banner">
	<div class="welcome_msg">
		<h1>Today's Inspiration</h1>
		<p> 
		  
		 	Do today <br> 
			what should be done.. <br> 
		    Your tomorrow may never come. <br>
			<span>~ Harry F.Banks</span>
		</p>
		<a href="register.php" class="btn">Join us!</a>
	</div>
	<div class="login_div">
		<form action="index.php" method="post" >
		
			<h2>Login</h2>
			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password"  placeholder="Password"> 
			<button class="btn" type="submit" name="login_user">Sign in</button>
		</form>
	</div>
</div>

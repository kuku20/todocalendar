

<!doctype html>
<html lang="en"><head>
    <title>jkj</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
    
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    </style>
  </head>
  <body  >

  <link rel="stylesheet" type="text/css" href="css/todoClock.css">
	<!-- google font -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
	<!-- font-awesome -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

  
  




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >




<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


<div id="out"> 
    <!-- calender show here -->
	<div class="bigBox">
        <!-- add calander in this div -->
        <button class="hide">Full Calandar</button>
        <button class="hiden">Full Calandar</button>
        <div class="calbox">
        <div class="row">
            <div id="calendar"></div>
        </div>
        </div>
<!-- ===============clock====================== -->
<div>
			<!-- clock -->
			<p style="text-align: center;">Time is everythings</p>
		<div class="clock">
			<div class="hand hour" data-hour-hand></div>
			<div class="hand minute" data-minute-hand></div>
			<div class="hand second" data-second-hand></div>
			
			<div class="number number1">|</div>
			<div class="number number2">|</div>
			<div class="number number3">I</div>
			<div class="number number4">|</div>
			<div class="number number5">|</div>
			<div class="number number6">I</div>
			<div class="number number7">|</div>
			<div class="number number8">|</div>
			<div class="number number9">I</div>
			<div class="number number10">|</div>
			<div class="number number11">|</div>
			<div class="number number12">I</div>
		</div>
		</div>
	<!-- ======================================== -->

	</div>

	<!-- todolist show here -->
	<div id="container">
		<h3>Todo Day Lists <i class="fa fa-plus"></i></h3>
		<input type="text" name="" placeholder="Add New Todo">
		<ul>
			<li> <span class="halo"><i class="fa fa-trash"></i></span> wake up at 6h30</li>
			<li> <span class="halo"><i class="fa fa-trash"></i></span>workoout atleast 30m</li>
			<li> <span class="halo"><i class="fa fa-trash"></i></span> read out loud atleast 30m</li>
			<li> <span class="halo"><i class="fa fa-trash"></i></span> read any book for 30m such as read theory</li>
			<li> <span class="halo"><i class="fa fa-trash"></i></span> study vocabulary on anki</li>
			<li> <span class="halo"><i class="fa fa-trash"></i></span> viet nhat ky</li>
			<li> <span class="halo"><i class="fa fa-trash"></i></span> study build webside 2h</li>
			<li> <span class="halo"><i class="fa fa-trash"></i></span> study python</li>
		</ul>

		<h3> Specical Todo<i class="fa fa-plus"></i></h3>
		<input type="text" name="" placeholder="Add New Todo">

	</div>

	<!-- diary show here -->
	<div class="bigBox">
		<p>Write your dairy or your thought here</p>
		<textarea name="" id="" cols="60" rows="20"></textarea>
	</div>
</div>


<?php
include("popup.php");
?>


</div>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/todoClock.js"></script>
  </body>
</html>
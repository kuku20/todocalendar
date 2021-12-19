<!-- for connect to the database -->
<?php require_once('config.php') ?>
<?php  require ('vendor/autoload.php')?>
<!-- for check login -->
<?php require_once('session.php') ?>
<?php require_once('includes/header.php') ?>


<!-- ======================================== -->
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >
  <link rel="stylesheet" type="text/css" href="mainpage/css/todoClock.css">
    <!-- google font -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
    <!-- font-awesome -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<!-- ============================= -->

</head>
<body>
<!-- navbar -->
 <!-- navbar -->
 <?php include( ROOT_PATH . '/mainpage/navbar.php') ?>
<!-- navbar -->

<?php echo $_SESSION['username']; ?>
<div id="out"> 
    <!-- calender show here -->
  <div class="bigBox">
        <!-- add calander in this div -->
        
        <!-- <div class="calbox">
          <div class="row"> -->
            <div id="calendar"></div>
       <!--  </div>
        </div> -->
<!-- =============================================================clock===================================================== -->
      
  </div>
<!-- ===============================================MIDLE=========================================================== -->
<div id="container">
      <?php
          include("todo/todo.php");
      ?>
      <div>
        <?php
            include("clock/clock.php");
        ?>
      </div>
</div>
<!-- ============================================MIDLE================================================================== -->
  <!-- diary show here -->
  <div class="bigBox">
      
      <?php
        include("diary/diary.php");
      ?>
      
  </div>
<!-- ============================================= -->
  

</div>

<?php
include("mainpage/popup.php");
?>

</div>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<script type="text/javascript" src="mainpage/js/script.js"></script>
<script type="text/javascript" src="mainpage/js/todoClock.js"></script>
  </body>
</html>

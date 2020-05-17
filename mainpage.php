<?php require_once('config.php') ?>
<?php require_once('includes/header.php') ?>

<?php 
  session_start(); 

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

<!-- ======================================== -->
	<link rel="stylesheet" type="text/css" href="mainpage/css/todoClock.css">
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

<!-- ============================= -->

</head>
<body>
<!-- navbar -->
<?php include('includes/navbar.php') ?>
<div class="header">
	<h2>Welcome
     <strong><?php echo $_SESSION['username']; ?></strong>
      <a href="index.php?logout=1" style="color: red;">Logout</a> 
    </h2>
</div>


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
	</div>
<!-- ===============================================MIDLE=========================================================== -->
  <div id="container">
  <h3>Todo Day Lists <a href="todo/editdaylist.php">Edit</a> <i class="fa fa-plus"></i></h3>
  <input type="text" name="" id="tododay" placeholder="Add New Todo">
  <ul class ="todo" id="tdo">
  <?php
  $usertodo = $_SESSION['username'];
  $sql = "SELECT id, tododay  FROM todo WHERE usertodo ='$usertodo' AND donedate != CURRENT_DATE() ";
  $result = mysqli_query($link,$sql);
 while($row = mysqli_fetch_array($result)) {  
  $ids=$row['id'];     
  $tododay = $row['tododay'];
  // $created =$row['created_at'];
       ?>
    <li class ="todo" > <span id="<? echo $row['id'] ?>" class="halo"  ><i class="fa fa-trash"></i></span> 
   <? echo $tododay ?>   
   </li>
  <?php }?>
  </ul >
 

  <h3> Specical Todo</h3>
  <ul class ="todo">
      <?php
// thiis for special
      $userEvent = $_SESSION['username'];
      $sql2 = "SELECT *  FROM events WHERE userEvent ='$userEvent' AND start = CURRENT_DATE()  ";
      $result = mysqli_query($link,$sql2);
      ?>  
    <?php
    while($row = mysqli_fetch_array($result)) {  
      $ids=$row['id'];     
      $start = $row['start'];
      $tododay = $row['title'];
          ?>
          
        <li class ="todo"> <span id="<? echo $row['id'] ?>" class="special" ><i class="fa fa-trash"></i></span> 
        <strong><? echo $tododay ?>,6) </strong>  <span><? echo $start ?></span> 
      </li>
      
    <?php }
    ?>
  </ul>
  </div>
  <?php 
  // put in server
      if (isset($_POST['save'])) {
        $usertodo = $_SESSION['username'];
        $tododay = $_POST['tododay'];
        $sql = "INSERT INTO todo (usertodo, tododay, donedate) VALUES ('{$usertodo}', '{$tododay}','toidl')";
      mysqli_query($link, $sql);
      echo "You've been posted up!";
        header('location: mainpage.php');
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
      if($_GET['delete'])
      {
      
      $id=$_GET['id'];
      $delete = "DELETE FROM `events` WHERE id=".$id;
      mysqli_query( $link,$delete);
      }

  ?>

<!-- ============================================MIDLE================================================================== -->
	<!-- diary show here -->
	<div class="bigBox">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
		<div>
			<form method="post">
				
				<h1>Write your dairy or your thought here</h1>
				<textarea name="noteS" id="note" ></textarea>
			<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	<script>CKEDITOR.replace('note');</script>
	<a href="secret.php">GoToSecretPage</a>
<!-- ////////////////////////////================================ -->
<?php
session_start();
$userdiary = $_SESSION['username']; 

if($_POST['submit']=="Submit"){
    
    $note = trim($_POST['noteS']);

  // Check username is exists or not
  $query = "SELECT count(*) as allcount FROM user  WHERE note='".$note."'";
  $result = mysqli_query($link,$query);
  $row = mysqli_fetch_array($result);
  $allcount = $row['allcount'];

  // insert new record
  if($allcount == 0){
     $insert_query = "INSERT INTO 
        user (note, userdiary, created_at, date_post) VALUES('$note','$userdiary', now(), CURRENT_DATE())";
		mysqli_query($link,$insert_query);
}
 
}

    $sql = "SELECT id,note,userdiary, created_at  FROM user WHERE userdiary='$userdiary' AND date_post= CURRENT_DATE() ";
    $result = mysqli_query($link,$sql);

    ?> <div class='main-container'> <?php
      
      while($row = mysqli_fetch_array($result)) {  
      // $ids=$row['id'];     
      $note = $row['note'];
      $created =$row['created_at'];
           ?>
        <div >  
            <div class="border">
                <span > At : <?echo $created?>  You wrote: <span class="delete" id="<? echo $row["id"] ?>" >delete</span>
                <span class="note"><? echo $note ?></span>
                 </span>
                
            </div>  
        </div>
   
     <?php }

    ?>
    <style>
      .delete {
                color: red;
                position: absolute;
                right: 50px;
                cursor: pointer;
                }
.note{
  font-size:1.5em;
}
    </style>

<script>

    
          $(".delete").on("click",function(){
              var idstr = this.id;
              //  var firstDivID = $(this).getElementByTagName("button").id;
            console.log(idstr);
            if(confirm("Are you sure you want to delete this?"))
          {
              $.ajax({
                  type: "GET",
                  url: 'deletepost.php',
                  data: {
                    'delete':1,
                    'id':idstr,
                  },
                  success: function(){
                  }
              });
              $(this).parent().remove();
          }



            });
</script>

<!-- ============================================= -->
	</div>



</div>

<?php
include("mainpage/popup.php");
?>

</div>
<script type="text/javascript" src="mainpage/js/script.js"></script>
<script type="text/javascript" src="mainpage/js/todoClock.js"></script>
  </body>
</html>

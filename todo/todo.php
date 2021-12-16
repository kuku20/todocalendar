
  <h3> special list</h3>
  <ul class ="todo">
      <?php
// thiis for special
      $userEvent = $_SESSION['username'];
      // $start = date("Y-m-d");
      // echo $start;
      $sql2 = "SELECT *  FROM events WHERE userEvent ='$userEvent' AND datestart <= CURRENT_DATE() AND dateend >= CURRENT_DATE() ";
      $result = mysqli_query($link,$sql2);
      ?>  
    <?php
    while($row = mysqli_fetch_array($result)) {  
      $ids=$row['id'];     
      $start = $row['start'];
      $tododay = $row['title'];
          ?>
          
        <li class ="todo"> <span id="<? echo $row['id'] ?>" class="special" ><i class="fa fa-trash"></i></span> 
        <strong><? echo $tododay ?> </strong>  <span><? echo $start ?></span> 
      </li>
      
    <?php }
    ?>
  </ul>
  
  
  

  <h3>today's to-do list <a href="todo/editdaylist.php">Edit</a> <i class="fa fa-plus"></i></h3>
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

<h1>Helllo to the daylist</h1>
<h2>You can permanant delete your day do</h2>
<?php require_once('../config.php') ?>
<?php  require ('../vendor/autoload.php')?>
<!-- for check login -->
<?php require_once('../session.php') ?>
<?php 
  if($_GET['delete'])
{

$id=$_GET['id'];
$delete = "DELETE FROM `todo` WHERE id=".$id;
mysqli_query( $link,$delete);
}
    $usertodo = $_SESSION['username'];
    $sql = "SELECT id, tododay  FROM todo WHERE usertodo ='$usertodo'";
    $result = mysqli_query($link,$sql);

    ?>  

    <?php
     while($row = mysqli_fetch_array($result)) {  
      $ids=$row['id'];     
    
      $tododay = $row['tododay'];
      // $created =$row['created_at'];
           ?>
        <div>
          <li> <span class="halo"  ><i class="fa fa-trash"></i></span> 
         <? echo $tododay ?>   <button id="<? echo $row['id'] ?>" >&times;</button>
         </li>
         
       </div>
     <?php }
     
   
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



<a href="../mainpage.php">Go Back</a>

<script type="text/javascript">
  $("button").on("click",function(){
     var idstr = this.id;
    //  var firstDivID = $(this).getElementByTagName("button").id;
  console.log(idstr);
  
    $.ajax({
        type: "GET",
        url: 'editdaylist.php',
        data: {
          'delete':1,
          'id':idstr,
        },
        success: function(){
        }
    });
    $(this).parent().remove();
  
  });


</script>



<h1>Helllo to the daylist</h1>
<h2>You can permanant delete your day do</h2>
<?php 

  $link = mysqli_connect("localhost", "root","mysql","calender");
 
  if($_GET['delete'])
{

$id=$_GET['id'];
$delete = "DELETE FROM `todo` WHERE id=".$id;
mysqli_query( $link,$delete);
}
    $link = mysqli_connect("localhost", "root","mysql","calender");

    // Check connection
    if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
    }
    $sql = "SELECT id, tododay  FROM todo WHERE usertodo ='Loc'";
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
	       <? echo $tododay ?>   
	       </li>
	       <button id="<? echo $row['id'] ?>" >X</button>
       </div>
     <?php }
     
   
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



<a href="index.php">Go Back</a>

<script type="text/javascript">
	$("button").on("click",function(){
     var idstr = this.id;
    //  var firstDivID = $(this).getElementByTagName("button").id;
  console.log(idstr);
  if(confirm("Are you sure you want to delete this?"))
 	{
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
 	}
  });


</script>



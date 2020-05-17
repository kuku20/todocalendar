

<?php
session_start();
// include("database.php");
// $connection = mysqli_connect("localhost", "root", "mysql", "calender") or die(mysqli_error($connection));
// $userEvent = $_SESSION['username'];  // set your user id settings
$link = mysqli_connect("localhost", "root","mysql","calender");

if($_POST['submit']=="Submit"){
    
    $note = trim($_POST['noteS']);
    $query = "INSERT INTO user (note, userdiary, created_at, date_post) VALUES('$note','Loc', now(), CURRENT_DATE())";
    mysqli_query($link, $query);
    echo "You've been posted up!";
    // Redirect to another page
  header('location: call.php');
}

    $sql = "SELECT id,note,userdiary, created_at  FROM user WHERE userdiary='Loc' AND date_post= CURRENT_DATE() ";
    $result = mysqli_query($link,$sql);

    ?> <div class='main-container'> <?php
      
      while($row = mysqli_fetch_array($result)) {  
      // $ids=$row['id'];     
      $note = $row['note'];
      $created =$row['created_at'];
           ?>
        <div >  
            <div class="border">
                <span > At : <?echo $created?>  You wrote: <span class="delete" id="<? echo $row["id"] ?>" >delete</span><? echo $note ?> </span>
                
            </div>  
        </div>
   
     <?php }

    ?>
    <style>
      .delete {
                color: red;
                position: absolute;
                right: 3px;
                cursor: pointer;
                }
      .border{
        border:1px solid purple;
        margin-top:2px;
      }
    </style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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

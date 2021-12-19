<?php require_once('../config.php') ?>
<?php require_once('../session.php') ?>
<?php  require_once ('../vendor/autoload.php');$usertodo = $_SESSION['username'];?>

<h1>Helllo to the daylist</h1>
<h2>You can permanant delete your day do</h2>

<!-- for check login -->

<?php 
  if($_GET['delete']){
    $id=  new \MongoDB\BSON\ObjectId($_GET['id']);
    $todoDB = $client->todocalender->todo;
    $todoDB->deleteOne(['_id' => $id]);
  } 
    $todoDB = $client->todocalender->todo;
    
    $tododaylist = $todoDB->find(['usertodo' => $usertodo]);
    foreach ($tododaylist as $key) {
      $ids=$key['_id'];     
      $tododay = $key['tododay'];
      // $created =$row['created_at'];
           ?>
        <div>
          <li> <span class="halo"  ><i class="fa fa-trash"></i></span> 
         <? echo $tododay ?>   <button id="<? echo $key['_id'] ?>" >&times;</button>
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



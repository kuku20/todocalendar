<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
    <div>
    <h2>Write your diary or your thought <a data-modal-target="#modal1" style="color: red;
            cursor: pointer;">here</a></h2
            
            >
    <div class="modal1" id="modal1">
        <div class="modal1-header">
        <div class="title">Write Something Fun Here</div>
        <button data-close-button class="close-button">&times;</button>
        </div>
        <div class="modal1-body">
            <!-- the text editor show here -->
            <form method="post">
            <textarea name="noteS" id="note" ></textarea>
            <input type="submit" name="submit" value="submit">
            </form>
        </div>
    </div>
    <div id="overlay1"></div>
    </div>   
  <script>CKEDITOR.replace('note');</script>
  <h4><a href="secret.php">GoToSecretPage</a></h4>
<!-- ////////////////////////////================================ -->
<?php

$userdiary = $_SESSION['username']; 

if($_POST['submit']=="submit"){
    
    $note = trim($_POST['noteS']);

  // Check username is exists or not
  $query = "SELECT count(*) as note FROM user  WHERE note='".$note."'";
  $result = mysqli_query($link,$query);
  $row = mysqli_fetch_array($result);
  $allcount = $row['note'];

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
            
                <span > At : <?echo $created?>  You wrote: <span class="delete" id="<? echo $row["id"] ?>" >delete</span>
                <span class="note"><? echo $note ?></span>
                 </span>
                
             
        </div>
   
     <?php }

    ?>

<!-- calling form mainpage.php line 66 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
<div>
  <h2>Write your diary or your thought <a data-modal-target="#modal1" style="color: red;
              cursor: pointer;">here</a></h2>
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
  $created_at = date('Y-m-d h:i:s a');
  $date_post  = date("Y-m-d");
  if($_POST['submit']=="submit"){
      $note = trim($_POST['noteS']);
      $collection = $client->todocalender->userdiary;
      $insertOneResult = $collection->insertOne([
          'note'        => $note,
          'userdiary'   => $userdiary,
          'created_at'  => $created_at,
          'date_post'   => $date_post,
      ]);
  }
  $collection = $client->todocalender->userdiary;
  $document = $collection->find(['userdiary' => $userdiary, 'date_post'=> $date_post]);
  ?> <div class='main-container'> <?php
  foreach ($document as $key) {            
    $note = $key['note'];
    $created =$key['created_at'];
    ?>
    <!-- send through ajax todoClock.js to deletepost.php -->
    <div >  
      <span > At : <?echo $created?>  You wrote: <span class="delete" id="<? echo $key['_id'] ?>" >delete</span>
      
      <span class="update" data-modal-target="#modal1"> update</span>



      <span class="note"><? echo $note ?></span>
       </span>    
    </div>
    <?php }
?>

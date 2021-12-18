
  <h3> special list</h3>
  <ul class ="todo">
      <?php
    // thiis for special
      $userEvent = $_SESSION['username'];
      // $start = date("Y-m-d");
      // echo $start;
      $collection = $client->todocalender->events;
      date_default_timezone_set('America/Phoenix');
      $date = date('Y-m-d');
      $listtododaily = $collection ->find(['userEvent'=> $userEvent]);
      foreach ($listtododaily as $key) {
        if($key['datestart'] <= $date and $key['datestart'] >= $date){
          $ids= $key['_id'];
          $tododay = $key['title'];    
          $start = $key['start'];
          ?>
          <li class ="todo"> <span id="<? echo $ids ?>" class="special" ><i class="fa fa-trash"></i></span> 
          <strong><? echo $tododay ?> </strong>  <span><? echo $start ?></span> 
          </li>
      <?php }}?>
  </ul>
  
  
  

  <h3>today's to-do list <a href="todo/editdaylist.php">Edit</a> <i class="fa fa-plus"></i></h3>
  <input type="text" name="" id="tododay" placeholder="Add New Todo">
  <ul class ="todo" id="tdo">
    <?php
      $usertodo = $_SESSION['username'];

      $collection = $client->todocalender->todo;
      date_default_timezone_set('America/Phoenix');
      $date = date('Y-m-d');
      $listtododaily = $collection ->find(['usertodo'=> $usertodo]);
      foreach ($listtododaily as $key) {
        if($key['donedate'] != $date ){
          $ids= $key['_id'];
          $tododay = $key['tododay'];
          ?>
          <li class ="todo" > <span id="<? echo $ids ?>" class="halo"  ><i class="fa fa-trash"></i></span> 
          <? echo $tododay ?>   
          </li>
      <?php }}?>
  </ul >
  
  
  <?php 
  // put in server
      if (isset($_POST['save'])) {
        $usertodo = $_SESSION['username'];
        $tododay = $_POST['tododay'];
        $collection = $client->todocalender->todo;

        $insertOneResult = $collection->insertOne([
        'usertodo'  => $usertodo,
        'tododay'   => $tododay,
        'donedate' => 'toidl',
      ]);
      echo "You've been posted up!";
        header('location: mainpage.php');
        exit();
      }



      if (isset($_POST['update'])) {

      $id = new \MongoDB\BSON\ObjectId($_POST['id']);
      $collection = $client->todocalender->todo;
      date_default_timezone_set('America/Phoenix');
      $donedate = date('Y-m-d');
      $collection->updateOne(  
        ['_id' => $id],
        ['$set' => ['donedate' => $donedate]],
      );
      echo "You've been delete up!";

      }
      // not fix yet
      if($_GET['delete'])
      {
      
      $id=  new \MongoDB\BSON\ObjectId($_GET['id']);
      $collection = $client->todocalender->events;
      $collection->deleteOne(['_id' => $id]);
      }

  ?>
<?php include('../config.php') ?>
<?php  require ('../vendor/autoload.php')?>
<?php
session_start();

$userEvent = $_SESSION['username'];  // set your user id settings
// $datetime_string = date('c',time());    
if(isset($_POST['action']) or isset($_GET['view']))
{   
    if(isset($_GET['view']))
    {   
        
        header('Content-Type: application/json');
        
        $eventsDB = $client->todocalender->events;
        $start = $_GET["start"];
        $end = $_GET["end"];

        $listtododaily = $eventsDB ->find(['userEvent'=> $userEvent]);
        foreach ($listtododaily as $key) {
            $events[] = $key; 
            // $events[] = $key['_id']; 
             
        }
        echo json_encode($events);
        // echo $events; 
        exit;
    }
    elseif($_POST['action'] == "add")
    {   
        $title      =   $_POST["title"];
        $start      =   date('Y-m-d H:i:s',strtotime($_POST["start"]));
        $end        =   date('Y-m-d H:i:s',strtotime($_POST["end"]));
        $datestart  =   date('Y-m-d',strtotime($_POST["start"]));
        $dateend    =   date('Y-m-d',strtotime($_POST["end"]));
        $color      =   $_POST["color"];

        
        $eventsDB = $client->todocalender->events;
        $insertOneResult = $eventsDB->insertOne([
            'title'  => $title,
            'start'   => $start,
            'end' => $end,
            'userEvent' => $userEvent,
            'color' => $color,
            'datestart' => $datestart,
            'dateend' => $dateend,
          ]);
        $newid = $insertOneResult->getInsertedId();        
        // $newid = 5;
        echo '{"_id":"'.$newid.'" }';
        // echo '{"id":"'.mysqli_insert_id($link).'"}';
        // var_dump($insertOneResult->getInsertedId());
        header('Content-Type: application/json');
        exit;
    }
    elseif($_POST['action'] == "update")
    {   
        $eventsDB = $client->todocalender->events;
        $id = new \MongoDB\BSON\ObjectId($_POST['id']);
        $start = date('Y-m-d H:i:s',strtotime($_POST["start"]));
        $end = date('Y-m-d H:i:s',strtotime($_POST["end"]));
        $datestart = date('Y-m-d',strtotime($_POST["start"]));
        $dateend = date('Y-m-d',strtotime($_POST["end"]));
        $eventsDB->updateOne(  
            ['_id' => $id],
            ['$set' => ['start' => $start,
                        'end' =>$end,
                        'datestart' =>$datestart,
                        'dateend' =>$dateend,]
        ],
        );
        exit;
    }
    elseif($_POST['action'] == "delete") 
    {   
        $eventsDB = $client->todocalender->events;
        $id = new \MongoDB\BSON\ObjectId($_POST['id']);
        $eventsDB->deleteOne(['_id' => $id]);
        echo "1";
        exit;
    }
}
?>
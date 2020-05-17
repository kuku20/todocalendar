<?php
session_start();
include("database.php");

$userEvent = $_SESSION['username'];  // set your user id settings
$datetime_string = date('c',time());    
    
if(isset($_POST['action']) or isset($_GET['view']))
{
    if(isset($_GET['view']))
    {
        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($link,$_GET["start"]);
        $end = mysqli_real_escape_string($link,$_GET["end"]);
        
        $result = mysqli_query($link,"SELECT `id`, `start` ,`end` ,`title`,`color` FROM  `events` where (date(start) >= '$start' AND date(start) <= '$end') and userEvent='".$userEvent."'");
        while($row = mysqli_fetch_assoc($result))
        {
            $events[] = $row; 
        }
        echo json_encode($events); 
        exit;
    }
    elseif($_POST['action'] == "add")
    {   
        mysqli_query($link,"INSERT INTO `events` (
                    `title` ,
                    `start` ,
                    `end` ,
                    `userEvent` ,
                    `color`
                    )
                    VALUES (
                    '".mysqli_real_escape_string($link,$_POST["title"])."',
                    '".mysqli_real_escape_string($link,date('Y-m-d H:i:s',strtotime($_POST["start"])))."',
                    '".mysqli_real_escape_string($link,date('Y-m-d H:i:s',strtotime($_POST["end"])))."',
                    '".mysqli_real_escape_string($link,$userEvent)."',
                    '".mysqli_real_escape_string($link,$_POST["color"])."'
                    )");
        header('Content-Type: application/json');
        echo '{"id":"'.mysqli_insert_id($link).'"}';
        exit;
    }
    elseif($_POST['action'] == "update")
    {
        mysqli_query($link,"UPDATE `events` set 
            `start` = '".mysqli_real_escape_string($link,date('Y-m-d H:i:s',strtotime($_POST["start"])))."', 
            `end` = '".mysqli_real_escape_string($link,date('Y-m-d H:i:s',strtotime($_POST["end"])))."' 
            where userEvent = '".mysqli_real_escape_string($link,$userEvent)."' and id = '".mysqli_real_escape_string($link,$_POST["id"])."'");
        exit;
    }
    elseif($_POST['action'] == "delete") 
    {
        mysqli_query($link,"DELETE from `events` where userEvent = '".mysqli_real_escape_string($link,$userEvent)."' and id = '".mysqli_real_escape_string($link,$_POST["id"])."'");
        if (mysqli_affected_rows($link) > 0) {
            echo "1";
        }
        exit;
    }
}

?>
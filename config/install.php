<?php 
include_once '../db/db.class.php';
include_once '../controllers/sms.controller.php';

function getMessages(){
$url = '../messages.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$info = json_decode($data); // decode the JSON feed
$messages = $info->messages;
    return $messages;
}

try 
{
  $dbclass = new DBClass();
  $connection = $dbclass->getConnection();
  $sms = new SMS($connection);
  $messages = getMessages();
  foreach($messages as $msg){
    $sms->content = $msg;
    if($sms->create()){
    echo '{';
        echo '"message": "message was created."';
    echo '}';
}
else{
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}
  }
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>

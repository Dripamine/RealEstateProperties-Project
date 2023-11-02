<?php

require "resources/connect.php";

//get all login data
$sql = "SELECT * FROM logins WHERE LoginID = :id";
$query = $db->prepare($sql);
$query->execute(["id"=> $_SESSION['user_id']]);
$data = $query->fetch();

if ($data["Permission"] == 1){
  echo "How did you get in here? Bad user. GO AWAY.";
  die();
} else {
  //check if item is set
  if (array_key_exists('item', $_GET) ){
    Echo "error 404";
    ?>
    <a href="index.php">Return to home</a>
    <a href="admin.php">Return to admin Panel</a>
    <? die();
  }

  //check if item exists
  $propertyID = $_GET['item'];
  $sql = "SELECT * FROM properties WHERE propertyID = :id";
  $query = $db->prepare($sql);
  $query->execute(["id" => $propertyID]);
  $data = $query->fetch();

  if (!$data) {
    Echo "error 404";
    ?>
    <a href="index.php">Return to home</a>
    <a href="admin.php">Return to admin Panel</a>
    <? die();
  }
  
  //if item exists and permission is admin
  if ($data["Permission"] == 3){
  

    //delete item
    $sql = "DELETE FROM properties WHERE propertyID = :id";
    $query = $db->prepare($sql);
    $query->execute(["id" => $propertyID]);
  
    //return to admin panel
    header("location: admin.php");
    die();

  //if item exists and permission is agent
  } else if ($data["Permission"] == 2){
 

    //check login-agent-id vs item-agent-id
    $propertyID = $_GET['item'];
    $sql = "SELECT agentID FROM properties WHERE propertyID = :id";
    $query = $db->prepare($sql);
    $query->execute(["id" => $propertyID]);
    $data = $query->fetch();
    $agentIDfromP = $data['agentID'];
    $sql = "SELECT agentID FROM Agents WHERE LoginID = :id";
    $query = $db->prepare($sql);
    $query->execute(["id" => $_SESSION['user_id']]);
    $data = $query->fetch();
    $agentID = $data['agentID'];

    //if agent id matches
    if ($agentID == $agentIDfromP){
      //delete item
      $sql = "DELETE FROM properties WHERE propertyID = :id";
      $query = $db->prepare($sql);
      $query->execute(["id" => $propertyID]);
  
      //return to admin panel
      header("location: admin.php");
      die();
    }
  }
}
?>
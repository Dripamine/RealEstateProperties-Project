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
  //check for item
  if (!isset($_GET['item']) || $_GET['item'] == ""){
    Echo "error 404";
    ?>
    <a href="index.php">Return to home</a>
    <a href="admin.php">Return to admin Panel</a>
    <? die();
  }

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
    $propertyID = $_GET['item'];
    $sql = "DELETE FROM properties WHERE propertyID = :id";
    $query = $db->prepare($sql);
    $query->execute(["id" => $propertyID]);
  
    //return to admin panel
    header("location: admin.php");
    die();

  //if item exists and permission is agent
  } else if ($data["Permission"] == 2){
 

    //check login agent id vs item agent id
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

    //matching agent
    if ($agentID == $agentIDfromP){
      $propertyID = $_GET['item'];
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
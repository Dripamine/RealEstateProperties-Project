<?php

require "resources/connect.php";

function validateIsEmptyData($array, $key){

  //if ( !array_key_exists('txtTitle', $_POST) || $_POST['txtTitle'] == ""){
    if (!array_key_exists($key, $array) || $array[$key] ==  ""){
      return true; 
    } else 
    return false;
  
  }

$errorMsgs = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  //add validate Empty to a functions php
  if (validateIsEmptyData($_POST, 'username')) $errorMsgs .= "Username is required. <br>";

  if (validateIsEmptyData($_POST, 'password')) $errorMsgs .= "Password is required. <br>";

  if ($errorMsgs == ""){
    $sql = "SELECT * FROM logins WHERE username = :username";
		$query = $db->prepare($sql);
		$query->execute(["username"=> $_POST['username']]);
		$data = $query->fetch();

    if ($data != NULL){

      if (password_verify($_POST['username'], $data['password'])){
        //addlog here

        //addcookie

        //redirect - i dont think this works
        header("location: home.php");
        die();
      } else {
        $errorMsgs .= "Invalid password.";
      }
    } else {
      $errorMsgs .= "Unknown username.";
    }
  }
}

include "resources/header.php";
?>

<p class="error"><?=$errorMsgs; ?></p>

<div class="login">
  <form action="login.php" method="POST">
    <p>Username: </p>
    <input id="username" name="username" type="text" />
    <p>Password: </p>
    <input id="password" name="password" type="text" />
    <p>Don't have an account? <a href="registration.php"> Register now!</a> </p>
    <input type="submit" value="Log in!" /> 
  </form>
</div>

<?php include "resources/footer.php"; ?>

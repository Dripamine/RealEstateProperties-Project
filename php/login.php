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

<div class="home">
  <section class="center">
  <form action="login.php" method="POST">
    <div class="box">
      <p>Username: </p>
      <input id="username" name="username" type="text" />
    </div>
    <div class="box">
      <p>Password: </p>
      <input id="password" name="password" type="text" />
      </div>
    <h3>Don't have an account? <a href="registration.php"> Register now!</a> </h3>
    <input class="btn" type="submit" value="Log in!" /> 
  </form>
  </section>
</div>

<?php include "resources/footer.php"; ?>

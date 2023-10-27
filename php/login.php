<?php

require "resources/connect.php";

if ($IsLogIn){
  //redirect
  header("location: index.php");
  die();
}

$errorMsgs = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  //add validate Empty to a functions php
  if (IsEmpty($_POST, 'username')) $errorMsgs .= "Username is required. <br>";

  if (IsEmpty($_POST, 'password')) $errorMsgs .= "Password is required. <br>";

  if ($errorMsgs == ""){
    $sql = "SELECT * FROM logins WHERE username = :username";
		$query = $db->prepare($sql);
		$query->execute(["username"=> $_POST['username']]);
		$data = $query->fetch();

    print_r($data);

    if ($data != NULL){

      if (password_verify($_POST['password'], $data['Password'])){
        //addlog here

        $_SESSION['login'] = true;

        //redirect
        header("location: index.php");
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
      <input class="input" id="username" name="username" type="text" />
    </div>
    <div class="box">
      <p>Password: </p>
      <input class="input" id="password" name="password" type="password" />
      </div>
    <h3>Don't have an account? <a href="registration.php"> Register now!</a> </h3>
    <input class="btn" type="submit" value="Log in!" /> 
  </form>
  </section>
</div>

<?php include "resources/footer.php"; ?>

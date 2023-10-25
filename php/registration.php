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
$fName = "";
$lName = "";
$email = "";
$username = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  //if a form was submitted

  //validate the form
  if (validateIsEmptyData($_POST, 'fName')) $errorMsgs .= "First name is missing. <br>";
  else $fName = $_POST['fName'];

  if (validateIsEmptyData($_POST, 'lName')) $errorMsgs .= "Last name is missing. <br>";
  else $lName = $_POST['lName'];

  if (validateIsEmptyData($_POST, 'email')) $errorMsgs .= "Email is missing. <br>";
  else $email = $_POST['email'];

  if (validateIsEmptyData($_POST, 'username')) {
    $errorMsgs .= "Username is missing. <br>";
  } else { //query db to see if username is already in use
    $sql = "SELECT * FROM logins WHERE Username=:username";
    $query = $db->prepare($sql);
    $query->execute(['username' => $_POST['username']]);
    $result = $query->fetch();
    if ($result != null) {
      $errorMsgs .= "Username is already in use. <br>";
      } else {
      $username = $_POST['username'];
    }
  }

  if (validateIsEmptyData($_POST, 'password'))
    $errorMsgs .= "Password is missing. <br>";
  else if (strlen($_POST['password']) < 7) 
    $errorMsgs .= "That Password is too short. <br>";
  else if ($_POST['password'] != $_POST['passcomf'])
    $errorMsgs .= "Password does not match. <br>";
  else $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
  if ($errorMsgs == ""){
    //if no errors save to DB
    $data = [
      'username' => $username,
      'password' => $password,
    ];

    // Create login
    $sql = "INSERT INTO logins (Username, Password) VALUES (:username, :password);";
    $query = $db->prepare($sql);
    $query->execute($data);

    //take loginID from created login
    $sql = "SELECT LoginID FROM logins WHERE Username=:username";
    $query = $db->prepare($sql);
    $query->execute(['username' => $username]);
    $result = $query->fetch();

    $data = [
      'LoginID' => $result['LoginID'],
      'FirstName' => $fName,
      'LastName' => $lName,
      'Email' => $email,
    ];

    //create user
    $sql = "INSERT INTO users (LoginID, FirstName, LastName, Email) VALUES (:LoginID, :FirstName, :LastName, :Email)";
    $query = $db->prepare($sql);
    $query->execute($data);

  }
}

include "resources/header.php";
?>

<p> <?=$errorMsgs ?> </p>
<div class="regi-box">
  <div class="form">
<h1>Create An Account!</h1>  
<form action="registration.php" method="POST">
  <p>First Name: </p>
  <input type="text" name="fName" id="fName" value="<?=$fName; ?>"/><br>
  <p>Last Name: </p>
  <input type="text" name="lName" id="lName" value="<?=$lName; ?>"/><br>
  <p>Email: </p>
  <input type="email" name="email" id="email" value="<?=$email; ?>"/><br>
  <p>Username: </p>
  <input type="text" name="username" id="username" value="<?=$username; ?>"/><br>
  <p>Password: </p>
  <input type="text" name="password" id="password"/><br>
  <p>Confirm Password: </p>
  <input type="text" name="passcomf" id="passcomf"/><br>
  <p>already have an account? <a href="login.php">Log in here!</a></p>
  <input type="submit" value="Register Now" />
  </div>
</div>

<?php
include "resources/footer.php"
?>
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
  else $fName = $_POST['lName'];

  if (validateIsEmptyData($_POST, 'email')) $errorMsgs .= "Email is missing. <br>";
  else $fName = $_POST['email'];

  if (validateIsEmptyData($_POST, 'username')) $errorMsgs .= "Username is missing. <br>";
  // else if ($_POST['username'] == "I guess we have to query the db_users to see if that user name is taken?") 
  // $errorMsgs .= "That Username is taken.";
  else $fName = $_POST['username'];

  if (validateIsEmptyData($_POST, 'password'))
    $errorMsgs .= "Password is missing. <br>";
   else if (stnlen($_POST['password']) < 7) 
    $errorMsgs .= "That Password is too short.";
   else $fName = $_POST['password'];
  
  if ($errorMsgs = ""){
    //if no errors save to DB
    $data = [
      'fName' => $fName,
      'lName' => $lName,
      'email' => $email,
      'username' => $username,
      'password' => $password, //IMPORTANT this is not hashed. THIS NEEDS TO BE HASHED
    ];
    
    $sql = "INSERT INTO logins (Username, Password) VALUES (:username, :password);";
    $query = $db->prepare($sql);
    $query->execute($data);
  } else {
    echo $errorMsgs;
  }
}

include "resources/header.php";
?>

<div class="regi-box">
  <div class="form">
<h1>Create An Account!</h1>  
<form action="" method="">
  <input type="text" name="fName"/><br>
  <input type="text" name="lName"/><br>
  <input type="email" name="email"/><br>
  <input type="text" name="username"/><br>
  <input type="text" name="pass"/><br>
  <input type="text" name="passcomf"/><br>
  <p?>already have an account? <a href="#login">login now</a></p>
  <input type="submit" value="Register Now" />
  </div>
</div>

<?php
include "resources/footer.php"
?>
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

    //TBD send User to homepage.

  }
}

include "resources/header.php";
?>

<p> <?=$errorMsgs ?> </p>
<div class="home">
  <section class="center">
    <form action="registration.php" method="POST">
      <h3>Create An Account!</h3>  
      <div class="box">
        <p>First Name: </p>
        <input class="input" type="text" name="fName" id="fName" value="<?=$fName; ?>"/>
      </div>
      <div class="box">
        <p>Last Name: </p>
        <input class="input" type="text" name="lName" id="lName" value="<?=$lName; ?>"/>
      </div>
      <div class="box">
        <p>Email: </p>
        <input class="input" type="email" name="email" id="email" value="<?=$email; ?>"/>
      </div>
      <div class="box">
        <p>Username: </p>
        <input class="input" type="text" name="username" id="username" value="<?=$username; ?>"/>
      </div>
      <div class="box">
        <p>Password: </p>
        <input class="input" type="text" name="password" id="password"/>
      </div>
      <div class="box">
        <p>Confirm Password: </p>
        <input class="input" type="text" name="passcomf" id="passcomf"/>
      </div>
      <h3>Already have an account? <a href="login.php">Log in here!</a></h3>
      <input class="btn" type="submit" value="Register Now" />
    </form>
  </section>
</div>

<?php
include "resources/footer.php"
?>
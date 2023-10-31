<?php

require "resources/connect.php";

include "resources/header.php";

if (!$IsLogIn){
  echo "Please Log in to access the Admin panel.";
}
if ($IsLogIn){


  $sql = "SELECT * FROM logins WHERE LoginID = :id";
	$query = $db->prepare($sql);
	$query->execute(["id"=> $_SESSION['user_id']]);
  $data = $query->fetch();

  if ($data['Permission'] == 1){
    echo "You are unauthorized to access this panel.";
  }
  if ($data['Permission'] == 2){
    echo "Welcome to the agent panel.";
  }
  if ($data['Permission'] == 3){
    echo "Welcome to the admin panel";
  }
}

include "resources/footer.php";

?>
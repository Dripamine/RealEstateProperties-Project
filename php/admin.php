<?php

require "resources/connect.php";

include "resources/header.php";

if (!$IsLogIn){
  echo "Please Log in to access the Admin panel.";
}
if ($IsLogIn){


  //get all login data
  $sql = "SELECT * FROM logins WHERE LoginID = :id";
	$query = $db->prepare($sql);
	$query->execute(["id"=> $_SESSION['user_id']]);
  $data = $query->fetch();


  if ($data['Permission'] == 1){
    echo "You are unauthorized to access this panel.";
  }
  if ($data['Permission'] == 2){
    echo "Welcome to the agent panel.";
    //fetch Agent ID
    $sql = "SELECT AgentID FROM agents WHERE LoginID = :id";
    $query = $db->prepare($sql);
    $query->execute(["id"=> $_SESSION['user_id']]);
    $data = $query->fetch();
    $agentID = $data['AgentID'];

    //fetch all agent listings
    $sql = "SELECT * FROM properties WHERE AgentID = :id";
    $query = $db->prepare($sql);
    $query->execute(["id"=> $agentID]);
    
    ?>
    <div class="home">
      <section class="center">
        <?php while($data = $query->fetch()) : ?>
        <div class="box">
          <p>Property Number: <?=$data['PropertyID'];?> </p>
          <p>Address: <?=$data['StreetNum'];?>, <?=$data['StreetName'];?>, <?=$data['Postal'];?></p>
          <p>Price: <?=$data['Price'];?></p>
          <a href="add.php?item=<?=$data['PropertyID'];?>">Edit</a>
          <a href="delete.php?item=<?=$data['PropertyID'];?>">Delete</a>
        </div>
          <? endwhile?>
          <h3>Add a listing</h3>
      </section>
      <section class="center">
        <?php
        //fetch all offers
        $sql = "SELECT o.*, p.AgentID FROM `propertyoffers` o JOIN `properties` p ON o.PropertyID = p.PropertyID WHERE AgentID = :id";
        $query = $db->prepare($sql);
        $query->execute(["id"=> $agentID]);

        while($data = $query->fetch()) : ?>
          <div class="box">
            <p>Offer for Property Number: <?=$data['PropertyID'];?></p>
            <p>Amount: <?=$data['OfferAmount'];?></p>
            <p>Status:<?=$data['OfferStatus'];?></p>
            <p>Accept / Reject / Delete</p>
          </div>
        <? endwhile?>
      </section>

    </div>
    <?php
  } else if ($data['Permission'] == 3){
    echo "Welcome to the admin panel";
    //fetch adminID -wait, i dont need to do this

    /*$sql = "SELECT AdminID FROM admins WHERE LoginID = :id";
    $query = $db->prepare($sql);
    $query->execute(["id"=> $_SESSION['user_id']]);
    $data = $query->fetch();
    $adminID = $data['AgentID'];
    */

    //fetch all  listings
    $sql = "SELECT * FROM properties";
    $query = $db->prepare($sql);
    $query->execute();
    
    ?>
    <div class="home">
      <section class="center">
        <?php while($data = $query->fetch()) : ?>
        <div class="box">
          <p>Property Number: <?=$data['PropertyID'];?> </p>
          <p>Address: <?=$data['StreetNum'];?>, <?=$data['StreetName'];?>, <?=$data['Postal'];?></p>
          <p>Price: <?=$data['Price'];?></p>
          <a href="add.php?item=<?=$data['PropertyID'];?>">Edit</a>
          <a href="delete.php?item=<?=$data['PropertyID'];?>">Delete</a>
        </div>
          <? endwhile?>
          <h3><a href="add.php">Add a listing</a></h3>
      </section>
      <section class="center">
        <?php
        //fetch all offers
        $sql = "SELECT * FROM propertyoffers";
        $query = $db->prepare($sql);
        $query->execute();

        while($data = $query->fetch()) : ?>
          <div class="box">
            <p>Offer for Property Number: <?=$data['PropertyID'];?></p>
            <p>Amount: <?=$data['OfferAmount'];?></p>
            <p>Status:<?=$data['OfferStatus'];?></p>
            <p>Accept / Reject / Delete</p>
          </div>
        <? endwhile?>
      </section>
      <section class="center">
        <?php
        //fetch all users
        $sql = "SELECT * FROM users";
        $query = $db->prepare($sql);
        $query->execute();

        while($data = $query->fetch()) : ?>
          <div class="box">
            <p>User: <?=$data['FirstName'];?> <?=$data['LastName'];?></p>
            <p>Email: <?=$data['Email'];?></p>
            <p>Postal:<?=$data['Postal'];?></p>
            <p>Edit / Delete</p>
          </div>
        <? endwhile?>
      </section>
    <?php
  }
}

include "resources/footer.php";

?>
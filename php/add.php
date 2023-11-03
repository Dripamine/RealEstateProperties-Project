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
}
  $errorMsgs = [];
  $id = "";
  $agent = "";
  $stNum = "";
  $stName = "";
  $city = "";
  $prov = "";
  $postal = "";
  $desc = "";
  $price = "";
  $bath = "";
  $bed = "";
  $flr = "";
  $size = "";
  $furn = "";

  if (array_key_exists('item', $_GET)){
    $sql = "SELECT * FROM properties where propertyID = :id";
    $query = $db->prepare($sql);
    $query->execute(['id' => $_GET['item']]);

    $data = $query->fetch();
    if (!$data){
      echo "error 404";
      die();
    }

    $id = $data['PropertyID'];
    $agent = $data['AgentID'];
    $stNum = $data['StreetNum'];
    $stName = $data['StreetName'];
    $city = $data['City'];
    $prov = $data['Province'];
    $postal = $data['Postal'];
    $desc = $data['Description'];
    $price = $data['Price'];
    $bath = $data['Bathrooms'];
    $bed = $data['Bedrooms'];
    $flr = $data['Floors'];
    $size = $data['size'];
    $furn = $data['furnished'];
  }

  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    //if post method is true validate the form data
    if (IsEmpty($_POST, 'StreetNum')) $errorMsgs['StreetNum'] = "Street Number is required.";
    else $stNum = $_POST['StreetNum'];

    if (IsEmpty($_POST, 'StreetName')) $errorMsgs['StreetName'] = "Street Name is required.";
    else $stName = $_POST['StreetName'];

    if (IsEmpty($_POST, 'City')) $errorMsgs['City'] = "City is required.";
    else $city = $_POST['City'];

    if (IsEmpty($_POST, 'Province')) $errorMsgs['Province'] = "Province is required.";
    else $prov = $_POST['Province'];

    if (IsEmpty($_POST, 'Postal')) $errorMsgs['Postal'] = "Postal code is required.";
    else $postal = $_POST['Postal'];

    if (IsEmpty($_POST, 'Description')) $errorMsgs['Description'] = "A description is required.";
    else $desc = $_POST['Description'];

    if (IsEmpty($_POST, 'Price')) {
      $errorMsgs['Price'] = "Price is required.";
    } else if ($_POST['Price'] <= 0){
      $errorMsgs['Price'] = "Invalid Price.";
    } else {
      $price = $_POST['Price'];
    }

    if (IsEmpty($_POST, 'Bathrooms')) $bath = 1;
    else $bath = $_POST['Bathrooms'];

    if (IsEmpty($_POST, 'Bedrooms')) $bed = 1;
    else $bed = $_POST['Bedrooms'];

    if (IsEmpty($_POST, 'Floors')) $flr = 1;
    else $flr = $_POST['Floors'];

    if (IsEmpty($_POST, 'size')) $size = NULL;
    else $size = $_POST['size'];
    
    $furn = $_POST['furnished'] ?? "0";
    $id = $_POST['propertyID'] ?? "";

    if (IsEmpty($_POST, 'AgentID')){
      $errorMsgs['AgentID'] = "Agent ID is required.";
    } else {
      $sql = "SELECT AgentID FROM Agents";
      $query = $db->prepare($sql);
      $query->execute();
      $results = $query->fetchall();

      if (in_array($_POST['AgentID'], array_column($results, 'AgentID'))){
        $agent = $_POST['AgentID'];
      } else {
        $errorMsgs['AgentID'] = "Agent not found.";
      }
    }
  
    if ($errorMsgs == ""){
      $data = [
        "AgentID" => $agent,
        "StreetNum" => $stNum,
        "StreetName" => $stName,
        "City" => $city,
        "Province" => $prov,
        "Postal" => $postal,
        "Description" => $desc,
        "Price" => $price,
        "Bathrooms" => $bath,
        "Bedrooms" => $bed,
        "Floors" => $flr,
        "size" => $size,
        "furnished" => $furn,
      ];

      if ($id == ""){
        $sql = "INSERT INTO properties (AgentID, StreetNum, StreetName, City, Province, Postal, Description, Price, Bathrooms, Bedrooms, Floors, size, furnished) 
        VALUES (:AgentID, :StreetNum, :StreetName, :City, :Province, :Postal, :Description, :Price, :Bathrooms, :Bedrooms, :Floors, :size, :furnished);";
      } else {
        $sql = "UPDATE properties SET StreetNum = :stNum, StreetName = :stName, City = :city, Province = :province, Postal = :postal, Description = :desc, Price = :price, Bathrooms = :bath, Bedrooms = :bed, Floors = :floors, Size = :size, Furnished = :furn WHERE PropertyID = :id";
        $data['propertyID'] = $id; 
      }
      $query = $db->prepare($sql);
      $query->execute($data);

      if ($id == "") $id = $db->lastInsertId();

      header("location: details.php?item={$id}");
    }
  }
  include "resources/header.php";
  ?>
  <div class="home">
  <section class="center">
    <form action="add.php" method="POST">
      <h3>Property Listing</h3>  
      <div class="box">
        <p>Agent: </p>
        <input class="input" type="number" name="AgentID" value="<?=$agent; ?>"/>
      </div>
      <p class="error" style="color: red; text-align: center;"><?=$errorMsgs['AgentID'] ?? ''; ?></p>
      <div class="box">
        <p>Street Number: </p>
        <input class="input" type="text" name="StreetNum" value="<?=$stNum; ?>"/>
      </div>
      <p class="error" style="color: red; text-align: center;"><?=$errorMsgs['StreetNum'] ?? ''; ?></p>
      <div class="box">
        <p>Street Name: </p>
        <input class="input" type="text" name="StreetName" value="<?=$stName; ?>"/>
      </div>
      <p class="error" style="color: red; text-align: center;"><?=$errorMsgs['StreetName'] ?? ''; ?></p>
      <div class="box">
        <p>City: </p>
        <input class="input" type="text" name="City" value="<?=$city; ?>"/>
      </div>
      <p class="error" style="color: red; text-align: center;"><?=$errorMsgs['City'] ?? ''; ?></p>
      <div class="box">
        <p>Province: </p>
        <input class="input" type="text" name="Province" value="<?=$prov; ?>"/>
      </div>
      <p class="error" style="color: red; text-align: center;"><?=$errorMsgs['Province'] ?? ''; ?></p>
      <div class="box">
        <p>Postal </p>
        <input class="input" type="text" name="Postal" value="<?=$postal; ?>"/>
      </div>
      <p class="error" style="color: red; text-align: center;"><?=$errorMsgs['Postal'] ?? ''; ?></p>
      <div class="box">
        <p>Description: </p>
        <input class="input" type="text" name="Description" value="<?=$desc; ?>"/>
      </div>
      <p class="error" style="color: red; text-align: center;"><?=$errorMsgs['Description'] ?? ''; ?></p>
      <div class="box">
        <p>Price: </p>
        <input class="input" type="Number" name="Price" value="<?=$price; ?>"/>
      </div>
      <p class="error" style="color: red; text-align: center;"><?=$errorMsgs['Price'] ?? ''; ?></p>
      <div class="box">
        <p>Bathroom: </p>
        <input class="input" type="Number" name="Bathrooms" value="<?=$bath; ?>"/>
      </div>
      <div class="box">
        <p>Bedrooms: </p>
        <input class="input" type="Number" name="Bedrooms" value="<?=$bed; ?>"/>
      </div>
      <div class="box">
        <p>Floors: </p>
        <input class="input" type="Number" name="Floors" value="<?=$flr; ?>"/>
      </div>
      <div class="box">
        <p>Size: </p>
        <input class="input" type="Number" name="size" value="<?=$size; ?>"/>
      </div>
      <div class="box">
        <p>Furnished: </p>
        <input class="input" type="checkbox" name="Furnished" value="<?=$furn; ?>"/>
      </div>
      <input class="btn" type="submit" value="Submit" />
    </form>
  </section>
  </div>
<?

include "resources/footer.php"; ?>
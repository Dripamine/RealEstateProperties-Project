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
  $errorMsgs = "";
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
    $id = $data['propertyID'];
    $agent = $data['agentID'];
    $stNum = $data['StreetNum'];
    $stName = $data['Streetname'];
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
    if (IsEmpty($_POST, 'StreetNum')) $errorMsgs .= "Street Number is required. <br>";
    else $stNum = $_POST['StreetNum'];

    if (IsEmpty($_POST, 'StreetName')) $errorMsgs .= "Street Name is required. <br>";
    else $stName = $_POST['StreetName'];

    if (IsEmpty($_POST, 'City')) $errorMsgs .= "City is required. <br>";
    else $city = $_POST['City'];

    if (IsEmpty($_POST, 'Province')) $errorMsgs .= "Province is required. <br>";
    else $prov = $_POST['Province'];

    if (IsEmpty($_POST, 'Postal')) $errorMsgs .= "Postal code is required. <br>";
    else $postal = $_POST['Postal'];

    if (IsEmpty($_POST, 'Description')) $errorMsgs .= "A description is required. <br>";
    else $desc = $_POST['Description'];

    if (IsEmpty($_POST, 'Price')) $errorMsgs .= "Price is required. <br>";
    else $price = $_POST['Price'];

    $bath = $_POST['Bathrooms'] ?? "";
    $bed = $_POST['Bedrooms'] ?? "";
    $flr = $_POST['Floors'] ?? "";
    $size = $_POST['size']?? "";
    $furn = $_POST['furnished'] ?? "";
    $id = $_POST['propertyID'] ?? "";
  }
  if ($errorMsgs == ""){
    $data = [
      "StreetNum" => $stNum,
      "StreetName" => $stName,
      "City" => $city,
      "Province" => $prov,
      "Postal" => $postal,
      "Description" => $desc,
      "Price" => $price,
      "Bathrooms" => $bath,
      "Bedrooms" => $bed,
      "Floor" => $flr,
      "size" => $size,
      "furnished" => $furn,
    ];

    if ($id == ""){//IMPORTANT ADD THE AGENT ID THING.
      $sql = "INSERT INTO properties (StreetNum, StreetName, City, Province, Postal, Description, Price, Bathrooms, Bedrooms, Floors, size, furnished) 
      VALUES (:StreetNum, :StreetName, :City, :Province, :Postal, :Description, :Price, :Bathrooms, :Bedrooms, :Floors, :size, :furnished);";
    } else {
      $sql = "UPDATE properties SET StreetNum = :stNum, StreetName = :stName, City = :city, Province = :province, Postal = :postal, Description = :desc, Price = :price, Bathrooms = :bath, Bedrooms = :bed, Floors = :floors, Size = :size, Furnished = :furn WHERE propertyID = :id";
      $data['propertyID'] = $id; 
    }
    $query = $db->prepare($sql);
    $query->execute($data);

    if ($id == "") $id = $db->lastInsertId();

    header("location: details.php?item={$id}");
  }
  ?>
  <div class="home">
  <section class="center">
    <form action="add.php" method="POST">
      <h3>Property Listing</h3>  
      <div class="box">
        <p>Street Number: </p>
        <input class="input" type="text" name="StreetNum" value="<?=$stName; ?>"/>
      </div>
      <div class="box">
        <p>Street Name: </p>
        <input class="input" type="text" name="StreetName" value="<?=$stName; ?>"/>
      </div>
      <div class="box">
        <p>City: </p>
        <input class="input" type="text" name="City" value="<?=$city; ?>"/>
      </div>
      <div class="box">
        <p>Province: </p>
        <input class="input" type="text" name="Province" value="<?=$prov; ?>"/>
      </div>
      <div class="box">
        <p>Postal </p>
        <input class="input" type="text" name="Postal" value="<?=$postal; ?>"/>
      </div>
      <div class="box">
        <p>Description: </p>
        <input class="input" type="text" name="Description" value="<?=$desc; ?>"/>
      </div>
      <div class="box">
        <p>Price: </p>
        <input class="input" type="Number" name="Price" value="<?=$price; ?>"/>
      </div>
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
}
<?php
//connect to db
require 'resources/connect.php';

//fetch all properties
$sql = "SELECT * FROM properties";
$query = $db->query($sql);

//include header
include "resources/header.php";
?>

<div class="mainfeed">

<?php
//show all properties
while($row = $query->fetch()){
  $link = "property.php?item=" . $row['propertyid'];
  ?>
  <div class="box">
    <?php if ($row['image'] != ""){ ?>
      <a href="<?=$link; ?>">
        <img src="<?=$row['image_01'];?>" alt="Image.<?=$row['propertyid'];?>">
      </a>
      <?php
    } ?>
  <h3>
    <a href="<?$link; ?>"><?=$row['address']; ?></a>
  </h3>
  <p><?=$row['Descpription']; ?></p>
  </div>
<?php
} ?>

</div>

<?php
include "resources/footer.php"
?>
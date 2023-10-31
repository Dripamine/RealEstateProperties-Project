<?php
require "resources/connect.php";

include "resources/header.php";
?>


<!-- all listings section starts  -->

<section class="listings">

   <h1 class="heading">All Listings</h1>

   <div class="box-container">
      <?php
         //$total_images = 0;
         $select_properties = $db->prepare("SELECT properties.*, image.* FROM properties LEFT JOIN image ON properties.PropertyID = image.PropertyID ORDER BY properties.PropertyID DESC;");
         $select_properties->execute();
         if($select_properties->rowCount() > 0){
            while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){
      ?>

      <form action="" method="POST">
         <div class="box">
            <input type="hidden" name="PropertyID" value="<?= $fetch_property['PropertyID']; ?>">
            <?php
               }
            ?>

            <div class="thumb">                      
               <!-- <img src="images/PropertiesImages/<?= $fetch_property['ImageFileName']; ?>" alt=""> -->
               <img src="images/PropertiesImages/ComercialBuilding_01 (1).png" alt="Commercial Building Image"> 
            </div>
            <!-- <div class="admin">
               <h3>JS</h3>
               <div>
                  <p>Description</p>
                  <span>Description from $db</span>
               </div>
            </div> -->
         </div>
         <div class="box">
            <div class="price"><i class="fas fa-dollar-sign"></i><span><?= $fetch_property['Price']; ?></span></div>
            <h3 class="name"><?= $fetch_property['PropertyType']; ?></h3>
            <p class="location"><i class="fas fa-map-marker-alt"></i><span><?= $fetch_property['City']; ?></span></p>
            <div class="flex">
               <p><i class="fas fa-house"></i><span><?= $fetch_property['PropertyType']; ?></span></p>
               <!--<p><i class="fas fa-tag"></i><span><?= $fetch_property['YearOfBuilt']; ?></span></p> -->
               <p><i class="fas fa-bed"></i><span><?= $fetch_property['Bedrooms']; ?></span></p>
               <p><i class="fas fa-trowel"></i><span><?= $fetch_property['Construction Status']; ?></span></p>
               <p><i class="fas fa-couch"></i><span><?= $fetch_property['furnished']; ?></span></p>
               <p><i class="fas fa-maximize"></i><span><?= $fetch_property['size']; ?>sqft</span></p>
            </div>
            <div class="flex-btn">
               <a href="details.php?get_id=<?= $fetch_property['PropertyID']; ?>" class="btn">View Details</a>
               <a href="make_offer.php?get_id=<?= $fetch_property['PropertyID']; ?>" class="btn">Send Offer</a>
            </div>
         </div>
      </form>
      <?php
         }
      ?>
      
   </div>

</section>

<!-- all listings section ends -->




<?php include "resources/footer.php" ?>

</body>
</html>
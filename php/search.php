<?php
require "resources/connect.php";

include "resources/header.php";
?>
<!-- search filter section starts  -->

<section class="filters" style="padding-bottom: 0;">

   <form action="" method="post">
      <div id="close-filter"><i class="fas fa-times"></i></div>
      <h3>Filter your search</h3>
         
         <div class="flex">
            <div class="box">
               <p>Location</p>
               <input type="text" name="Location" required maxlength="50" placeholder="Search by city or Postal code" class="input">
            </div>
            <div class="box">
               <p>Offer type</p>
               <select name="sellOption" class="input" required>
                  <option value="sale">Sale</option>
                  <option value="resale">Resale</option>
                  <option value="rent">Leasing</option>
               </select>
            </div>
            <div class="box">
               <p>Property type</p>
               <select name="PropertyType" class="input" required>
                  <option value="Apartment">Apartment</option>
                  <option value="House">House</option>
                  <option value="Duplex or Triplex">Duplex or Triplex</option>
                  <option value="Condo">Condo</option>
                  <option value="Comercial Building">Comercial Building</option>
               </select>
            </div>
            <div class="box">
               <p>Bedrooms</p>
               <select name="Bedrooms" class="input" required>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6+</option>
                  
               </select>
            </div>
            <div class="box">
               <p>Minimum budget</p>
               <select name="min" class="input" required>
                  <option value="50000">50k</option>
                  <option value="100000">100k</option>
                  <option value="150000">150k</option>
                  <option value="200000">200k</option>
                  <option value="300000">300k</option>
                  <option value="400000">400k</option>
                  <option value="450000">450k</option>
                  <option value="500000">500k</option>
                  <option value="1000000">1M</option>
               </select>
            </div>
            <div class="box">
               <p>Maximum budget</p>
               <select name="max" class="input" required>
                  <option value="50000">50k</option>
                  <option value="100000">100k</option>
                  <option value="150000">150k</option>
                  <option value="200000">200k</option>
                  <option value="300000">300k</option>
                  <option value="400000">400k</option>
                  <option value="450000">450k</option>
                  <option value="500000">500k</option>
                  <option value="1000000">1M</option>
               </select>
            </div>
         </div>
         <input type="submit" value="search property" name="filter_search" class="btn">
   </form>

</section>

<!-- search filter section ends -->

<div id="filter-btn" class="fas fa-filter"></div>

<?php

if(isset($_POST['h_search'])){

   $h_location = $_POST['Location'];
   $h_location = filter_var($h_location, FILTER_SANITIZE_STRING);
   $h_type = $_POST['PropertyType'];
   $h_type = filter_var($h_type, FILTER_SANITIZE_STRING);
   $h_offer = $_POST['sellOption'];
   $h_offer = filter_var($h_offer, FILTER_SANITIZE_STRING);
   $h_min = $_POST['min'];
   $h_min = filter_var($h_min, FILTER_SANITIZE_STRING);
   $h_max = $_POST['max'];
   $h_max = filter_var($h_max, FILTER_SANITIZE_STRING);

   $select_properties = $db->prepare("SELECT * FROM `properties` WHERE address LIKE '%{$h_location}%' AND type LIKE '%{$h_type}%' AND offer LIKE '%{$h_offer}%' AND price BETWEEN $h_min AND $h_max ORDER BY date DESC");
   $select_properties->execute();

}elseif(isset($_POST['filter_search'])){

   $location = $_POST['location'];
   $location = filter_var($location, FILTER_SANITIZE_STRING);
   $type = $_POST['type'];
   $type = filter_var($type, FILTER_SANITIZE_STRING);
   $offer = $_POST['offer'];
   $offer = filter_var($offer, FILTER_SANITIZE_STRING);
   $bhk = $_POST['bhk'];
   $bhk = filter_var($bhk, FILTER_SANITIZE_STRING);
   $min = $_POST['min'];
   $min = filter_var($min, FILTER_SANITIZE_STRING);
   $max = $_POST['max'];
   $max = filter_var($max, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $furnished = $_POST['furnished'];
   $furnished = filter_var($furnished, FILTER_SANITIZE_STRING);

   $select_properties = $db->prepare("SELECT * FROM `property` WHERE address LIKE '%{$location}%' AND type LIKE '%{$type}%' AND offer LIKE '%{$offer}%' AND bhk LIKE '%{$bhk}%' AND status LIKE '%{$status}%' AND furnished LIKE '%{$furnished}%' AND price BETWEEN $min AND $max ORDER BY date DESC");
   $select_properties->execute();

}

?>

<!-- Listing Details section starts  -->

<section class="listings">

   <?php 
      if(isset($_POST['h_search']) or isset($_POST['filter_search'])){
         echo '<h1 class="heading">Search Results</h1>';
      }else{
         echo '<h1 class="heading">Listing Details</h1>';
      }
   ?>

   <div class="box-container">
      <?php
         $total_images = 0;
         if(false){ 
            while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){
            $select_user = $db->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_user->execute([$fetch_property['user_id']]);
            $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

            if(!empty($fetch_property['image_02'])){
               $image_coutn_02 = 1;
            }else{
               $image_coutn_02 = 0;
            }
            if(!empty($fetch_property['image_03'])){
               $image_coutn_03 = 1;
            }else{
               $image_coutn_03 = 0;
            }
            if(!empty($fetch_property['image_04'])){
               $image_coutn_04 = 1;
            }else{
               $image_coutn_04 = 0;
            }
            if(!empty($fetch_property['image_05'])){
               $image_coutn_05 = 1;
            }else{
               $image_coutn_05 = 0;
            }

            $total_images = (1 + $image_coutn_02 + $image_coutn_03 + $image_coutn_04 + $image_coutn_05);

      ?>
      <form action="" method="POST">
         <div class="box">
            <input type="hidden" name="property_id" value="<?= $fetch_property['id']; ?>">
            <?php
               if($select_saved->rowCount() > 0){
            ?>
            <button type="submit" name="save" class="save"><i class="fas fa-heart"></i><span>saved</span></button>
            <?php
               }else{ 
            ?>
            <button type="submit" name="save" class="save"><i class="far fa-heart"></i><span>save</span></button>
            <?php
               }
            ?>
            <div class="thumb">
               <p class="total-images"><i class="far fa-image"></i><span><?= $total_images; ?></span></p> 
               <img src="uploaded_files/<?= $fetch_property['image_01']; ?>" alt="">
            </div>
            <div class="admin">
               <h3><?= substr($fetch_user['name'], 0, 1); ?></h3>
               <div>
                  <p><?= $fetch_user['name']; ?></p>
                  <span><?= $fetch_property['date']; ?></span>
               </div>
            </div>
         </div>
         <div class="box">
            <div class="price"><i class="fas fa-indian-rupee-sign"></i><span><?= $fetch_property['price']; ?></span></div>
            <h3 class="name"><?= $fetch_property['property_name']; ?></h3>
            <p class="location"><i class="fas fa-map-marker-alt"></i><span><?= $fetch_property['address']; ?></span></p>
            <div class="flex">
               <p><i class="fas fa-house"></i><span><?= $fetch_property['type']; ?></span></p>
               <p><i class="fas fa-tag"></i><span><?= $fetch_property['offer']; ?></span></p>
               <p><i class="fas fa-bed"></i><span><?= $fetch_property['bhk']; ?> BHK</span></p>
               <p><i class="fas fa-trowel"></i><span><?= $fetch_property['status']; ?></span></p>
               <p><i class="fas fa-couch"></i><span><?= $fetch_property['furnished']; ?></span></p>
               <p><i class="fas fa-maximize"></i><span><?= $fetch_property['carpet']; ?>sqft</span></p>
            </div>
            <div class="flex-btn">
               <a href="view_property.php?get_id=<?= $fetch_property['id']; ?>" class="btn">view property</a>
               <input type="submit" value="send enquiry" name="send" class="btn">
            </div>
         </div>
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no results found!</p>';
      }
      ?>
      
   </div>

</section>

<!-- Listing Details section ends -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script>

document.querySelector('#filter-btn').onclick = () =>{
   document.querySelector('.filters').classList.add('active');
}

document.querySelector('#close-filter').onclick = () =>{
   document.querySelector('.filters').classList.remove('active');
}

</script>

</body>
</html>


<?php include "resources/footer.php" ?>
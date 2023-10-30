<?php
require "resources/connect.php";
include "resources/header.php";
?>

<style>
  #confirmation {
    display: none;
  }
</style>

<!-- search filter section starts  -->
<section class="filters" style="padding-bottom: 70px;">
   <form action="" method="post" style="width: 700px; margin: 0 auto;">
      <div id="close-filter"><i class="fas fa-times"></i></div>
      <h3>Send Offer</h3>
      <?php
         $sql_selected_property = $db->prepare("SELECT * FROM `properties` WHERE PropertyID = 1");
         if ($sql_selected_property->execute()) {
            $selected_property = $sql_selected_property->fetch(PDO::FETCH_ASSOC);
         } else {
            $errorInfo = $sql_selected_property->errorInfo();
            echo 'Error: ' . $errorInfo[2];
         }
      ?>
      <div class="flex">
         <div class="box" style="padding: 25px 0 0 25px; display: block;">
            <p name="lblPropertyid" style="font-weight: bold;">PropertyId: <?= $selected_property['PropertyID'] ?></p>
         </div>
         <div class="box" style="padding: 15px 0 0 25px; display: block;">
            <p name="lblAskingprice" style="font-weight: bold;">Asking Price: $<?= number_format($selected_property['Price'], 2, '.', ',') ?></p>
         </div>
         <div class="box" style="padding: 25px; display: block;">
            <p style="font-weight: bold;">Your offer</p>
            <input type="text" name="txtOffer" required placeholder="0.00" class="input" style="width: 200px;">
         </div>
      </div>
      <input type="submit" value="Submit offer" name="btnSubmitoffer" class="btn" style="width: 400px; margin: 0 auto;" id="submitOfferButton">
   </form>
</section>

<section id="confirmation" class="filters" style="padding-bottom: 200px; text-align: center;">
   <form style="width: 900px; margin: 0 auto;">
      <div class="flex">
         <div class="box" style="padding: 25px 0 0 25px; display: inline-block;">
            <p name="lblmessage1" style="font-weight: bold; font-size: 25px"></p>
         </div>
      </div>

      <div class="flex">
         <div class="box" style="padding: 25px 0 15px 25px; display: inline-block;">
            <p name="lblmessage2" style="font-weight: bold; font-size: 25px">Would you like to continue?</p>
         </div>
      </div>

      <div style="align-items: center; padding-top: 25px">
         <input type="button" value="Yes" class="btn" style="width: 150px; display: inline-block;" id="yesButton">
         <input type="button" value="No" class="btn" style="width: 150px; display: inline-block;" id="noButton">
      </div>
   </form>
</section>

</body>
</html>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- JavaScript to handle the form submission and display the confirmation section -->
<script>
   document.addEventListener("DOMContentLoaded", function () {
      var confirmationSection = document.getElementById("confirmation");
      var flexSection = document.querySelector('.flex');

      //alert("style display = " confirmationSection.style.display);
      
      // When the "Submit Offer" button is clicked
      document.querySelector("#submitOfferButton").addEventListener("click", function (e) {
         e.preventDefault();
         // Show the confirmation section
         confirmationSection.style.display = 'block';

         console.log(confirmationSection);
         console.log(document.querySelector("#submitOfferButton"));

         // Set the message and button actions
         var selectedPropertyPrice = <?= $selected_property['Price'] ?>; // Set the selected property price
         var txtOfferValue = parseFloat(document.querySelector("input[name='txtOffer']").value);

         if (!isNaN(txtOfferValue)) {
            var difference = txtOfferValue - selectedPropertyPrice;
            if (difference < 0) {
               document.querySelector("p[name='lblmessage1']").textContent = "Your offer is $" + Math.abs(difference).toFixed(2) + " below the asking price.";
            } else if (difference > 0) {
               document.querySelector("p[name='lblmessage1']").textContent = "Your offer is $" + difference.toFixed(2) + " above the asking price.";
            } else {
               document.querySelector("p[name='lblmessage1']").textContent = "Your offer matches the asking price.";
            }
            //document.querySelector("p[name='lblmessage2']").textContent = "Would you like to continue?";
         } else {
            document.querySelector("p[name='lblmessage1']").textContent = "Please enter a valid numeric offer.";
            document.querySelector("p[name='lblmessage2']").textContent = "";
         }
      });

      document.getElementById("yesButton").addEventListener("click", function () {
         // Handle "Yes" button action
         alert("You clicked Yes. Continue your action here.");
         // Hide the confirmation section
         confirmationSection.style.display = 'none';
      });

      document.getElementById("noButton").addEventListener("click", function () {
         // Handle "No" button action
         alert("You clicked No. Cancel your action here.");
         // Hide the confirmation section
         confirmationSection.style.display = 'none';
      });
   });
</script>

<?php include "resources/footer.php" ?>
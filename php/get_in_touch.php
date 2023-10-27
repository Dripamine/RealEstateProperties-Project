<?php  

// include 'components/connect.php';

// if(isset($_COOKIE['user_id'])){
//    $user_id = $_COOKIE['user_id'];
// }else{
//    $user_id = '';
// }

// if(isset($_POST['send'])){

//    $msg_id = create_unique_id();
//    $name = $_POST['name'];
//    $name = filter_var($name, FILTER_SANITIZE_STRING);
//    $email = $_POST['email'];
//    $email = filter_var($email, FILTER_SANITIZE_STRING);
//    $number = $_POST['number'];
//    $number = filter_var($number, FILTER_SANITIZE_STRING);
//    $message = $_POST['message'];
//    $message = filter_var($message, FILTER_SANITIZE_STRING);

//    $verify_contact = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
//    $verify_contact->execute([$name, $email, $number, $message]);

//    if($verify_contact->rowCount() > 0){
//       $warning_msg[] = 'message sent already!';
//    }else{
//       $send_message = $conn->prepare("INSERT INTO `messages`(id, name, email, number, message) VALUES(?,?,?,?,?)");
//       $send_message->execute([$msg_id, $name, $email, $number, $message]);
//       $success_msg[] = 'message send successfully!';
//    }

// }

?>

<?php
include "resources/header.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="css/styleHome.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   
      <title>JustSell</title>

      <!-- Favicons -->
      <link href="assets/img/favicon.png" rel="icon">
  </head> 

<!-- contact section starts  -->

<section class="contact">

   <div class="row">
      <div class="image">
         <img src="images/getInTouch.png" alt="GetInTouch">
      </div>
      <form action="process_contact.php" method="post">
         <h3>get in touch</h3>
         <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="number" name="phone" required maxlength="10" max="9999999999" min="0" placeholder="enter your number" class="box">
         <textarea name="message" placeholder="enter your message" required maxlength="1000" cols="30" rows="10" class="box"></textarea>
         <input type="submit" value="send message" name="contact_submit" class="btn">
      </form>
   </div>

</section>

<!-- contact section ends -->


<div style="padding-bottom: 100px;">

</div>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'message.php'; ?>

</body>
</html>

<?php
include "resources/footer.php"
?>


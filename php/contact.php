<?php
include "resources/header.php";
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Just Sell</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/styleContact.css">

</head>


<body>

    <!-- section starts  -->

    <div class="home">

        <section class="center">
            <div class="background-image"></div>
            <form action="process_contact.php" method="post">
                <h3>Contact Us</h3>

                <div class="box">
                    <p>Your Name <span>*</span></p>
                    <input type="text" name="name" required maxlength="100" placeholder="Enter your name" maxlength="100" class="input">
                </div>

                <div class="box">
                    <p>Your Email <span>*</span></p>
                    <input type="email" name="email" required placeholder="Enter your email" maxlength="100" class="input">
                </div>

                <div class="box">
                    <p>Your Phone Number</p>
                    <input type="text" name="phone" placeholder="Enter your phone number" maxlength="10" class="input">
                </div>

                <div class="box">
                    <p>Your Message <span>*</span></p>
                    <textarea name="message" placeholder="Enter your message" rows="4" required maxlength="5000"
                        class="input"></textarea>
                        
                </div>

                <input type="submit" value="Send Message" name="contact_submit" class="btn">
            </form>

        </section>

        <div class="reply-box">
            <p>We will reply as soon as possible!</p>
        </div>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <?php //include 'components/footer.php'; ?>
    <?php //include "resources/footer.php" ?>


    <!-- custom js file link  -->
    <script src="js/script.js"></script>


</body>

</html>
<?php

include 'include.php';

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>

    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' .
            $message .
            '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
} ?>

    <header class="header">

        <div class="flex">

            <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

            <nav class="navbar">
                <a href="admin_page.php">home</a>
                <a href="#">producten</a>
                <a href="#">Bestelling</a>
                <a href="#">users</a>
                <a href="#">messages</a>
            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="user-btn" class="fas fa-user"></div>
            </div>

            <div class="account-box">
                <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <a href="logout.php" class="delete-btn">logout</a>
                <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
            </div>

        </div>

    </header>

    <!-- admin dashboard section start  -->

    <section class="dashboard">

        <h1 class="title">Admin Panel</h1>

        <div class="box-container">

            <div class="box">
                <?php
         $total_pendings = 0;
         ($select_pending = mysqli_query(
             $conn,
             "SELECT total_price FROM `orders` WHERE payment_status = 'pending'"
         )) or die('query failed');
         if (mysqli_num_rows($select_pending) > 0) {
             while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                 $total_price = $fetch_pendings['total_price'];
                 $total_pendings += $total_price;
             }
         }
         ?>
                <h3>€<?php echo $total_pendings; ?>/-</h3>
                <p>totaal in behandeling</p>
            </div>

            <div class="box">
                <?php
         $total_completed = 0;
         ($select_completed = mysqli_query(
             $conn,
             "SELECT total_price FROM `orders` WHERE payment_status = 'completed'"
         )) or die('query failed');
         if (mysqli_num_rows($select_completed) > 0) {
             while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                 $total_price = $fetch_completed['total_price'];
                 $total_completed += $total_price;
             }
         }
         ?>
                <h3>€<?php echo $total_completed; ?>/-</h3>
                <p>completed Betalling</p>
            </div>

            <div class="box">
                <?php
         ($select_orders = mysqli_query($conn, 'SELECT * FROM `orders`')) or
             die('query failed');
         $number_of_orders = mysqli_num_rows($select_orders);
         ?>
                <h3><?php echo $number_of_orders; ?></h3>
                <p>Bestelling platsen</p>
            </div>

            <div class="box">
                <?php
         ($select_products = mysqli_query(
             $conn,
             'SELECT * FROM `product_items`'
         )) or die('query failed');
         $number_of_products = mysqli_num_rows($select_products);
         ?>
                <h3><?php echo $number_of_products; ?></h3>
                <p>Add producten</p>
            </div>

            <div class="box">
                <?php
         ($select_users = mysqli_query(
             $conn,
             "SELECT * FROM `users` WHERE user_type = 'user'"
         )) or die('query failed');
         $number_of_users = mysqli_num_rows($select_users);
         ?>
                <h3><?php echo $number_of_users; ?></h3>
                <p>normale users</p>
            </div>

            <div class="box">
                <?php
         ($select_admins = mysqli_query(
             $conn,
             "SELECT * FROM `users` WHERE user_type = 'admin'"
         )) or die('query failed');
         $number_of_admins = mysqli_num_rows($select_admins);
         ?>
                <h3><?php echo $number_of_admins; ?></h3>
                <p>admin users</p>
            </div>

            <div class="box">
                <?php
         ($select_account = mysqli_query(
             $conn,
             'SELECT * FROM `gebruikers`'
         )) or die('query failed');
         $number_of_account = mysqli_num_rows($select_account);
         ?>
                <h3><?php echo $number_of_account; ?></h3>
                <p>total accounts</p>
            </div>

            <div class="box">
                <p>nieuw message</p>
            </div>

        </div>

    </section>

    <!-- admin dashboard klaar -->









    <!-- custom admin js file link  -->
    <script src="script.js"></script>

</body>

</html>
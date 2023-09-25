<?php

include 'include.php';

$user_id = $_SESSION['user_id'];

//if (!isset($user_id)) {
// header('location:login.php');
//}

if (isset($_POST['add_to_cart'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];

    ($check_cart_numbers = mysqli_query(
        $conn,
        "SELECT * FROM `cart` WHERE name = '$name' AND user_id = '$user_id'"
    )) or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'U heeft al bestelde!';
    } else {
        mysqli_query(
            $conn,
            "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$name', '$price', '$quantity', '$image')"
        ) or die('query failed');
        $message[] = 'U heeft een product in de kaar toe gevoegd!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>winkel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- css link  -->
    <link rel="stylesheet" href="register.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>ons winkel</h3>
        <p> <a href="winkel.php">home</a> / shop </p>
    </div>
    <div class="w3-content w3-display-container">
        <img class="mySlides" src="img/1.png" style="width:100%">
        <img class="mySlides" src="img/2.png" style="width:100%">
        <img class="mySlides" src="img/3.png" style="width:100%">
        <img class="mySlides" src="img/4.png" style="width:100%">

        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>

    <section class="products">

        <h1 class="title">producten</h1>

        <div class="box-container">

            <?php
            ($select_products = mysqli_query(
                $conn,
                'SELECT * FROM `product_items`'
            )) or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while (
                    $fetch_products = mysqli_fetch_assoc($select_products)
                ) { ?>
            <form action="winkel.php" method="post" class="box">
                <div class="image"><input type="image" name="image" src="img/<?php echo $fetch_products[
                    'image'
                ]; ?>"></div>
                <input type="hidden" name="image" value="<?php echo $fetch_products[
                    'image'
                ]; ?>">
                <div class="name"><?php echo $fetch_products['name']; ?></div>
                <div class="price"><?php echo $fetch_products['price']; ?></div>
                <input type="number" min="1" name="quantity" value="1" class="qty">
                <input type="hidden" name="name" value="<?php echo $fetch_products[
                    'name'
                ]; ?>">
                <input type="hidden" name="price" value="<?php echo $fetch_products[
                    'price'
                ]; ?>">

                <input type="submit" value="voeg aan winkelwagen" name="add_to_cart" class="btn">
            </form>

            <?php }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>

    </section>


    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="home.php">home</a>
                <a href="#">about</a>
                <a href="#">shop</a>
                <a href="#">contact</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="login.php">login</a>
                <a href="register.php">register</a>
                <a href="cart.php">cart</a>
                <a href="orders.php">orders</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <p> <i class="fas fa-phone"></i> +123-456-7890 </p>
                <p> <i class="fas fa-phone"></i> +111-222-3333 </p>
                <p> <i class="fas fa-envelope"></i>nmaghsoody@gmail.com </p>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            </div>

        </div>

        <p class="credit"> Gemaakt @ by <span>najibee@maghsoody</span> </p>

    </section>
    </div>
    <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        };
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex - 1].style.display = "block";
    }
    </script>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
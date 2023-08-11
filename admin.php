<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="navbar">
    <div class="hamburger-menu">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
                <span></span>
            </label>
            <ul class="menu__box">
                <h2>Menu</h2>
                <li><a class="menu__item" href="">View Products</a></li>
                <li><a class="menu__item" href="">View Categories</a></li>
                <li><a class="menu__item" href="admin.php?insert_product">Insert Products</a></li>
                <li><a class="menu__item" href="admin.php?insert_category">Insert Categories</a></li>
                <li><a class="menu__item" href="">All orders</a></li>
                <li><a class="menu__item" href="">All payments</a></li>
                <li><a class="menu__item" href="">List users</a></li>
            </ul>
        </div>    
    <div class="logo">
            <img src="../img/logo.png" alt="" srcset="">
            <p>SS Store</p>
        </div>
        <div class="logout">
            <img src="../img/logout.png" alt="">
        </div>
    </div>
    <div class="options">
        <div class="profile">
            <img src="../img/user.png" alt="">
            <p>Hello Akshit !!</p>
        </div>
        <!-- <h1>Manage Details</h1>
        <div class="select">
            <button class="btn"><a href="">View Products</a></button>
            <button class="btn"><a href="">View Categories</a></button>
            <button class="btn"><a href="admin.php?insert_product">Insert Products</a></button>
            <button class="btn"><a href="admin.php?insert_category">Insert Categories</a></button>
            <button class="btn"><a href="">All orders</a></button>
            <button class="btn"><a href="">All payments</a></button>
            <button class="btn"><a href="">List users</a></button>
        </div> -->
    </div>
    <div class="result">
        <?php
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_product'])){
                include('insert_product.php');
            }
        ?>
    </div>
    <div class="footer">
        <div class="up">
            <div class="about">
                <h3>ABOUT</h3>
                <a href="">Contact Us</a>
                <a href="">About Us</a>
                <a href="">Corporate information</a>
            </div>
            <div class="help">
                <h3>HELP</h3>
                <a href="">Payments</a>
                <a href="">Shipping</a>
                <a href="">Cancellation & Returns</a>
                <a href="">FAQ</a>
            </div>
            <div class="policy">
                <h3>CONSUMER POLICY</h3>
                <a href="">Return Policy</a>
                <a href="">Terms of Use</a>
                <a href="">Security</a>
                <a href="">Privacy</a>
            </div>
            <div class="social">
                <h3>SOCIAL</h3>
                <a href="">Facebook</a>
                <a href="">Instagram</a>
                <a href="">Youtube</a>
                <a href="">Twitter</a>
            </div>
        </div>
        <div class="down">
            <hr>
            <p>Copyright 2023,SS Store. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
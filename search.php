<?php
include('includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/indexstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>
<body>
    <div class="navbar">
        <div class="hamburger-menu">
            <input id="menu__toggle" type="checkbox" />
            <label class="menu__btn" for="menu__toggle">
                <span></span>
            </label>
            <ul class="menu__box">
                <h2>Categories</h2>
                <?php
                    $query1="select * from categories";
                    $result1=mysqli_query($con,$query1);
                    while($row1=mysqli_fetch_assoc($result1)){
                        $category_title=$row1['category_title'];
                        $category_id=$row1['category_id'];
                        echo "<li><a class='menu__item' href='index.php?category=$category_id'>$category_title</a></li>";
                    }
                ?>
                <!-- <li><a class="menu__item" href="#product-1">Mobile Phones</a></li>
                <li><a class="menu__item" href="#product-2">Tshirts/Shirts</a></li>
                <li><a class="menu__item" href="#product-3">Jeans</a></li>
                <li><a class="menu__item" href="#product-4">Footwear</a></li> -->
                <!-- <li><a class="menu__item" href="#">Medicine</a></li> -->
            </ul>
        </div>
        <div class="logo">
            <img src="img/logo.png" alt="" srcset="">
            <p>SS Store</p>
        </div>
        <div class="cart">
            <!-- <i class="fa-solid fa-cart-shopping fa-3x" style="color: #ffffff;"></i> -->
            <a href=""><img src="img/icons8-shopping-cart-24.png" alt="" srcset=""></a>
            <p class="sup">1</p>
        </div>
        
        <div class="wrap">
            <form action="search.php" method="get">
                    <div class="search">
               <input type="text" name="search_data" class="searchTerm" placeholder="What are you looking for?">
               <button type="submit" name="search-btn" class="searchButton">
                 <img src="img/search.png" alt="">  
              </button>
            </div>
              </form>
         </div>

        <div class="login-btn">
            <button class="button_slide slide_left login">Login</button>
            <!-- <button class="button_slide slide_left signup">Sign Up</button> -->
        </div>
    </div>
    <div class="product-container" style="margin-top:150px">
    <?php
                    if(isset($_GET['search-btn'])){
                        $search_data=$_GET['search_data'];
                    $search_query="select * from products where product_title like '%$search_data%'";
                    $result2=mysqli_query($con,$search_query);
                    $num2=mysqli_num_rows($result2);
                    if($num2==0){
                        echo "<h2 class='no'>No result found</h2>";
                    }
                    else{
                    while($row2=mysqli_fetch_assoc($result2)){
                        $product_id=$row2['product_id'];
                        $product_title=$row2['product_title'];
                        $product_description=$row2['product_description'];
                        $product_image=$row2['product_image'];
                        $product_price=$row2['product_price'];
                        $actual_price=$row2['actual_price'];

                        echo "<div class='product-card'>
                        <div class='product-image'>
                            <img src='admin/product_image/$product_image' class='product-thumb' alt=''>
                            <button class='card-btn'><a href='index.php?add_to_cart=$product_id'>Add to cart</a></button>
                        </div>
                        <div class='product-info'>
                            <h2 class='product-brand'>$product_title</h2>
                            <p class='product-short-description'>$product_description</p>
                            <span class='price'>Rs. $product_price</span><span class='actual-price'>Rs. $actual_price</span>
                        </div>
                    </div>";
                    }
                }
                }
                ?>
                </div>
    <div class="footer" style="margin-top:500px">
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            // Optional parameters
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },


        });

        // For card slider
        const productContainers = [...document.querySelectorAll('.product-container')];
        const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
        const preBtn = [...document.querySelectorAll('.pre-btn')];

        productContainers.forEach((item, i) => {
            let containerDimensions = item.getBoundingClientRect();
            let containerWidth = containerDimensions.width;

            nxtBtn[i].addEventListener('click', () => {
                item.scrollLeft += containerWidth;
            })

            preBtn[i].addEventListener('click', () => {
                item.scrollLeft -= containerWidth;
            })
        })
    </script>
</body>
</html>
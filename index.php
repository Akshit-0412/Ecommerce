<?php
include('includes/connect.php');
function getIPAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// $ip=getIPAddress();
// echo 'User IP-'.$ip;
// add to cart
    if(isset($_GET['add_to_cart'])){
        $ip_add=getIPAddress();
        $prod_id=$_GET['add_to_cart'];
        $query3="select * from cart_details where ip_address='$ip_add' and product_id=$prod_id";
        $result3=mysqli_query($con,$query3);
        $num3=mysqli_num_rows($result3);
        if($num3>0){
            echo "<script>alert('Item already exists in cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
        else{
            $query4="insert into cart_details (product_id,ip_address,quantity) values ($prod_id,'$ip_add',0)";
            $result4=mysqli_query($con,$query4);
            echo "<script>alert('Item added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }

function cart_count(){
    if(isset($_GET['add_to_cart'])){
        $ip_add=getIPAddress();
        $query5="select * from cart_details where ip_address='$ip_add'";
        $result5=mysqli_query($con,$query5);
        $num5=mysqli_num_rows($result5);
    }
    else{
        global $con;
        $ip_add=getIPAddress();
        $query5="select * from cart_details where ip_address='$ip_add'";
        $result5=mysqli_query($con,$query5);
        $num5=mysqli_num_rows($result5);
    }
    echo $num5;
}
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
            <p class="sup"><?php cart_count();?></p>
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
    <div class="add">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="img/dis1.jpg" alt="" srcset=""></div>
                <div class="swiper-slide"><img src="img/dis2.jpg" alt="" srcset=""></div>
                <div class="swiper-slide"><img src="img/dis3.png" alt="" srcset=""></div>
                <div class="swiper-slide"><img src="img/dis4.jpg" alt="" srcset=""></div>

            </div>
            <div class="swiper-pagination"></div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </div>

    <div class="product-1" id="product-1">
        <section class="product">
            <h2 class="product-category">Mobile phones</h2>
            <button class="pre-btn"><img src="img/left.png" alt="pre"></button>
            <button class="nxt-btn"><img src="img/right.png" alt="nxt"></button>
            <div class="product-container">
            <?php
                    $query2="select * from products where category_id='1'";
                    $result2=mysqli_query($con,$query2);
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
                ?>
                <!-- <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobil1.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Apple 14</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 100000</span><span class="actual-price">Rs. 120000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobile2.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Redmi</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 20000</span><span class="actual-price">Rs. 22000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobile3.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">One plus</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 30000</span><span class="actual-price">Rs. 33000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobile4.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Poco</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 15000</span><span class="actual-price">Rs. 17000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobile5.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Xiomi</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 18000</span><span class="actual-price">Rs. 19000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobile6.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Vivo</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 22000</span><span class="actual-price">Rs. 25000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobile7.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Samsung</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 19000</span><span class="actual-price">Rs. 22000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobile8.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Motorola</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 25000</span><span class="actual-price">Rs. 28000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/mobile9.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">one+</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 40000</span><span class="actual-price">Rs. 44000</span>
                    </div>
                </div> -->
            </div>
        </section>
    </div>
    <div class="product-2" id="product-2">
        <section class="product">
            <h2 class="product-category">T-shirts/Shirts </h2>
            <button class="pre-btn"><img src="img/left.png" alt="pre"></button>
            <button class="nxt-btn"><img src="img/right.png" alt="nxt"></button>
            <div class="product-container">
            <?php
                    $query2="select * from products where category_id='2'";
                    $result2=mysqli_query($con,$query2);
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
                ?>
                <!-- <div class="product-card">
                    <div class="product-image">
                        <span class="discount-tag">50% off</span>
                        <img src="img/t1.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Nike</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1000</span><span class="actual-price">Rs. 1200</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/t2.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Adidas</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1500</span><span class="actual-price">Rs. 1600</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/t3.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Reebok</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 500</span><span class="actual-price">Rs. 600</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/t4.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Allen Solly</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 500</span><span class="actual-price">Rs. 800</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/t5.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Calvin Klein</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 400</span><span class="actual-price">Rs. 500</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/t6.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">H&M</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 700</span><span class="actual-price">Rs. 1000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/t7.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Levi’s</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1000</span><span class="actual-price">Rs. 1200</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/t8.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">LP</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 500</span><span class="actual-price">Rs. 800</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/t9.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Pepe</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1000</span><span class="actual-price">Rs. 1200</span>
                    </div>
                </div> -->
            </div>
        </section>
    </div>
    <div class="product-3" id="product-3">
        <section class="product">
            <h2 class="product-category">Jeans</h2>
            <button class="pre-btn"><img src="img/left.png" alt="pre"></button>
            <button class="nxt-btn"><img src="img/right.png" alt="nxt"></button>
            <div class="product-container">
            <?php
                    $query2="select * from products where category_id='3'";
                    $result2=mysqli_query($con,$query2);
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
                ?>
                <!-- <div class="product-card">
                    <div class="product-image">
                        <img src="img/j1.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Raymond</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 2000</span><span class="actual-price">Rs. 2300</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/j5.jpeg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Peter</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1500</span><span class="actual-price">Rs. 1700</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/j10.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Wrogn</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 2700</span><span class="actual-price">Rs. 3000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/j4.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Levi</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 2500</span><span class="actual-price">Rs. 2800</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/j6.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Provogue</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1000</span><span class="actual-price">Rs. 1200</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/j9.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">U.S. Polo</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1700</span><span class="actual-price">Rs. 1800</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/j2.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">UCB</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1000</span><span class="actual-price">Rs. 1200</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/j3.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Van Heusen</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 2300</span><span class="actual-price">Rs. 2800</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/j7.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Wrangler</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1600</span><span class="actual-price">Rs. 1900</span>
                    </div>
                </div> -->
            </div>
        </section>
    </div>
    <div class="product-4" id="product-4">
        <section class="product">
            <h2 class="product-category">Footwear</h2>
            <button class="pre-btn"><img src="img/left.png" alt="pre"></button>
            <button class="nxt-btn"><img src="img/right.png" alt="nxt"></button>
            <div class="product-container">
            <?php
                    $query2="select * from products where category_id='4'";
                    $result2=mysqli_query($con,$query2);
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
                ?>
                <!-- <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe1.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Nike</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 2000</span><span class="actual-price">Rs. 3000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe4.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">ABC</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 700</span><span class="actual-price">Rs. 1000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe2.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Nike neon</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 2700</span><span class="actual-price">Rs. 3000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe5.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Casual</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 500</span><span class="actual-price">Rs. 800</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe3.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Nike sprts</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 4000</span><span class="actual-price">Rs. 5000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe6.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">High Heels</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 700</span><span class="actual-price">Rs. 1000</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe7.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Man</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1000</span><span class="actual-price">Rs. 1200</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe9.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Sandal</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 500</span><span class="actual-price">Rs. 800</span>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">
                        <img src="img/shoe8.jpg" class="product-thumb" alt="">
                        <button class="card-btn">Add to cart</button>
                    </div>
                    <div class="product-info">
                        <h2 class="product-brand">Bridal</h2>
                        <p class="product-short-description">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
                        <span class="price">Rs. 1000</span><span class="actual-price">Rs. 1200</span>
                    </div>
                </div> -->
            </div>
        </section>
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
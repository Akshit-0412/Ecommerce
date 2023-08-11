<?php
    include('../includes/connect.php');
    if(isset($_POST['sub_prod'])){
        $product_title=$_POST['product-title'];
        $poduct_description=$_POST['desc'];
        $product_category=$_POST['product_category'];
        $product_price=$_POST['prod_price'];
        $actual_price=$_POST['aprice'];
        $product_status='true';

        // accessing image
        $product_image=$_FILES['product_image']['name'];

        // accessing image tmp name
        $temp_image=$_FILES['product_image']['tmp_name'];

        // checking empty condition
        if($product_title=='' or $poduct_description=='' or $product_category=='' or $product_price=='' or $actual_price=='' or $product_image==''){
            echo "<script>alert('Please fill in all details')</script>";
            exit();
        }
        else{
            move_uploaded_file($temp_image,"./product_image/$product_image");

            $query2="insert into products (product_title,product_description,category_id,product_image,product_price,actual_price,date,status) values ('$product_title','$poduct_description','$product_category','$product_image','$product_price','$actual_price',NOW(),'$product_status')";
            $result2=mysqli_query($con,$query2);
            if($result2){
                echo "<script>alert('Product inserted successfully')</script>";
            }
        }
    }
?>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Insert Product</h1>
            <div class="product-title">
                <label for="product-title">Product Title</label><br>
                <input type="text" name="product-title" id="product-title" placeholder="Enter product title" required>
            </div>
            <div class="description">
                <label for="desc">Product Description</label><br>
                <input type="text" name="desc" id="desc" placeholder="Enter product Description" required>
            </div>
            <div class="product-category">
                <select name="product_category" id="">
                    <option value="">Select a category</option>
                    <?php
                        $query1="select * from categories";
                        $result1=mysqli_query($con,$query1);
                        while($row1=mysqli_fetch_assoc($result1)){
                            $category_title=$row1['category_title'];
                            $category_id=$row1['category_id'];

                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                    <!-- <option value="">Category 1</option>
                    <option value="">Category 2</option>
                    <option value="">Category 3</option>
                    <option value="">Category 4</option> -->
                </select>
            </div>
            <div class="product_image">
                <label for="product_image">Product Image</label><br>
                <input type="file" name="product_image" id="product_image" required>
            </div>
            <div class="price">
                <label for="prod_price">Product Price</label><br>
                <input type="text" name="prod_price" id="prod_price" placeholder="Enter product price" required>
            </div>
            <!-- <div class="price">
                <label for="price">Product Price</label><br>
                <input type="text" name="price" id="price" placeholder="Enter product Price" required>
            </div> -->
            <div class="actual_price">
                <label for="aprice">Actual Price</label><br>
                <input type="text" name="aprice" id="aprice" placeholder="Enter product Price" required>
            </div>
            <div class="submit-btn">
                <input type="submit" name="sub_prod" value="Insert Product" class="sub-btn">
            </div>
        </form>
    </div>

    <!-- 
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
        $ip=getIPAddress();
        echo 'User IP-'.$ip;
     -->
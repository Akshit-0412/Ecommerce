<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    $query1="select * from categories where category_title='$category_title'";
    $result1=mysqli_query($con,$query1);
    $num1=mysqli_num_rows($result1);
    if($num1>0){
        echo "<script>alert('This category already exists in database.')</script>";
    }
    else{
        $query2="insert into `categories` (category_title) values('$category_title')";
        $result2=mysqli_query($con,$query2);
        if($result2){
            echo "<script>alert('Category inserted successfully.')</script>";
        }
    }
}
?>
<h2 class="ic">Insert Categories</h2>
<form action="" method="post">
    <input type="text" name="cat_title" class="in_cat" placeholder="Insert Categories" id="">
    <input type="submit" name="insert_cat" class="in_cat_btn" value="Insert Categories">
</form>
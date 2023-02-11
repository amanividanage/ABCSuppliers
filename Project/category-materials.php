<?php include('partials-front/menu.php'); ?>
    <?php 
        //check whether the id is passed or not
        if(isset($_GET['category_id'])){
            //category is set
            $category_id =$_GET['category_id'];
            //get the category title according to id
            $sql = "SELECT title FROM tbl_category WHERE id=?";

            // //execute the query 
            // $res = mysqli_query($conn,$sql);
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $category_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$res = mysqli_stmt_execute($stmt);




            //get the values from database
            $row = mysqli_fetch_assoc($res);
            //get the title
            $category_title = $row['title'];
        }
        else{
            //category not passed
            //redirect to home page
            header('location:'.SITEURL);
        }
    ?>

    <!-- Material sEARCH Section Starts Here -->
    <section class="material-search text-center">
        <div class="container">
            
            <h2>Materials on <a href="#" class="text-black">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- Material sEARCH Section Ends Here -->



    <!-- Material MEnu Section Starts Here -->
    <section class="material-menu">
        <div class="container">
            <h2 class="text-center">Materials Menu</h2>
            <?php 
                //create sql querey to get materials based category
                // $sql2 = "SELECT * FROM tbl_materials WHERE category_id=$category_id";
                // //execute the query
                // $res2 = mysqli_query($conn,$sql2);

                // $count2 = mysqli_num_rows($res2);

                $sql2 = "SELECT * FROM tbl_materials WHERE category_id=?";
$stmt = mysqli_prepare($conn, $sql2);
mysqli_stmt_bind_param($stmt, "i", $category_id);
mysqli_stmt_execute($stmt);
$res2 = mysqli_stmt_get_result($stmt);
$count2 = mysqli_num_rows($res2);


                //check whether material is available or not
                if($count2>0){
                    //material is available
                    while($row2=mysqli_fetch_assoc($res2)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        <div class="material-menu-box">
                            <div class="material-menu-img">
                                <?php 
                                 if($image_name==""){
                                     //image is not available
                                     echo "<div class='error'>Image Not Available</div>";
                                 }
                                 else{
                                     //image is available
                                     ?>
                                    <img src="<?php echo SITEURL;?>images/material/<?php echo $image_name;?>" class="img-responsive img-curve">
                                     <?php
                                 }
                                ?>
                                
                            </div>

                            <div class="material-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="material-price">$<?php echo $price; ?></p>
                                <p class="material-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?material_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else{
                    //not available
                    echo "<div class='error'>Material Is Not Available.</div>";
                }
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Material Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>

</body>
</html>
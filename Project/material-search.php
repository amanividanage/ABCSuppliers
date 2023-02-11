<?php include('partials-front/menu.php'); ?>

    <!-- sEARCH Section Starts Here -->
    <section class="material-search text-center">
        <div class="container">
        <?php 
            //get the search key word
            $search = mysqli_real_escape_string($conn,$_POST['search']);
            ?>
            <h2>Materials on Your Search "<?php echo $search; ?>"</h2>

        </div>
    </section>
    <!-- sEARCH Section Ends Here -->



    <!-- MEnu Section Starts Here -->
    <section class="material-menu">
        <div class="container">
            
            <?php 
            

            //sql query to get materials based on search keyword
            $sql = "SELECT * FROM tbl_materials WHERE title like '%$search%' OR description LIKE '%$search%' ";

            //execute the query 
            $res = mysqli_query($conn, $sql);
            
            $count = mysqli_num_rows($res);
            //check whether materils available or not
            if($count>0){
                //material available
                while($row = mysqli_fetch_assoc($res)){
                    //get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="material-menu-box">
                        <div class="material-menu-img">
                            <?php 
                                //check whether image is available or not 
                                if($image_name ==""){
                                    //image not available
                                    echo "<div class='error'>Image Not Available. </div>";
                                }
                                else{
                                    //image is available
                                    ?>
                                        <img src="<?php echo SITEURL;?>images/material/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                echo "<div class='error'> Material is not available.</div>";
            }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>

</body>
</html>
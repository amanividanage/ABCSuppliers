<?php include('partials-front/menu.php'); ?>

    <!-- material sEARCH Section Starts Here -->
    <section class="materials-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>material-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Materials.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Material sEARCH Section Ends Here -->



    <section class="material-menu">
        <div class="container">
            <h2 class="text-center">Materials</h2>
            <?php 
            //getting materials from database which are featured and active
            $sql2 = "SELECT * FROM tbl_materials WHERE active='Yes'";

            $res2 = mysqli_query($conn,$sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2>0){
                //materials are available
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
                                //image availability
                                if($image_name==""){
                                    //image is not available
                                    echo "<div class='error'>Image is not available.</div>";

                                }
                                else{
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/material/<?php echo $image_name; ?>" class="img-responsive img-curve">


                                    <?php
                                }

                            ?>
                            
                        </div>

                        <div class="material-menu-desc">
                            <h4><?php echo $title; ?> </h4>
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
                //materials are not available
                echo "<div class='error'>Material IS Not Availabale</div>";
            }


            ?>

    
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Materials</a>
        </p>
    </section>
    <!-- Material Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

</body>
</html>
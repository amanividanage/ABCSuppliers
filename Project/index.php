<?php include('partials-front/menu.php'); ?>

    <!-- Material sEARCH Section Starts Here -->
    <section class="materials-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>material-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Materials.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Material sEARCH Section Ends Here -->
    <?php 
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Materials</h2>
            <?php 
                //sql query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //execute the query
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);

                if($count>0){
                    //categories are available
                    while($row=mysqli_fetch_assoc($res)){
                        //get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL;?>category-materials.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php 
                                //check tha availability of the image
                                    if($image_name==""){
                                        //display the message
                                        echo "<div class='error'>Image Not Availabale</div>";
                                    }
                                    else{
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }

                                ?>
                                

                                <h3 class="float-text text-black"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else{
                    //no categories
                    echo "<div class='error'>Category Not Added</div>";
                }
            ?>

            

            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Materials MEnu Section Starts Here -->
    <section class="material-menu">
        <div class="container">
            <h2 class="text-center">Materials</h2>
            <?php 
            //getting materials from database which are featured and active
            $sql2 = "SELECT * FROM tbl_materials WHERE active='Yes' AND featured='Yes' LIMIT 6";

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
            <a href="<?php echo SITEURL;?>/materials.php">See All Materials</a>
        </p>
    </section>
    <!-- Material Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
<?php include('partials-front/menu.php'); ?>
    <?php
        //check whether material id is set or not 
        if(isset($_GET['material_id'])){
            //get the material id
            $material_id = $_GET['material_id'];

            // //get the details of the material
            // $sql = "SELECT * FROM tbl_materials WHERE id=$material_id";
            // //execute the query
            // $res = mysqli_query($conn,$sql);
            // $count = mysqli_num_rows($res);

            $sql = "SELECT * FROM tbl_materials WHERE id=?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $material_id);

mysqli_stmt_execute($stmt);

$res = mysqli_stmt_get_result($stmt);

$count = mysqli_num_rows($res);


            //check whether the dat is available or not
            if($count==1){
                //data available
                //get teh data from database
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else{
                //not available
                //redirect to homepage
                header("location:".SITEURL);
            }
        }
        else{
            //redirect to homepage
            header('location:'.SITEURL);
        }
    ?>
    <!-- material sEARCH Section Starts Here -->
    <section class="materials-search1">
        <div class="container">
            
            <h2 class="text-center text-black">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order"> 
                <fieldset>
                    <legend>Selected Material</legend>

                    <div class="material-menu-img">
                        <?php 
                         //check whether the image is available or not
                         if($image_name==""){
                             //not available
                             echo "<div class='error'>Image Not Available</div>";
                         }
                         else{
                             //available
                             ?>
                             <img src="<?php echo SITEURL;?>images/material/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                             <?php
                         }
                        
                        ?>
                        
                    </div>
    
                    <div class="material-menu-desc">
                        <h3><?php echo $title; ?> </h3>
                        <input type="hidden" name="material" value="<?php echo $title; ?>" >

                        <p class="material-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Chris Perera" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +9477xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. cp@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php 
                //checking whether the submit button is clicked
                if(isset($_POST['submit'])){
                    //get the details
                    $material = $_POST['material'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    date_default_timezone_set('Asia/Colombo');
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Ordered"; //ordered, on delivery,delivered, cancelled
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //save the order in database
                    $sql2 = "INSERT INTO tbl_order SET 
                        material = ?,
                        price = ?,
                        qty = ?,
                        total = ?,
                        order_date = ?,
                        status =?,
                        customer_name = ?,
                        customer_contact = ?,
                        customer_email = ?,
                        customer_address = ?

                    ";
                    

                    // //execute the query
                    // $res2 = mysqli_query($conn,$sql2);
                    $stmt = mysqli_prepare($conn, $sql2);
                    mysqli_stmt_bind_param($stmt, "sddssssss", $material, $price, $qty, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address);
                    mysqli_stmt_execute($stmt);
                    $res2 = mysqli_stmt_get_result($stmt);





                    
                    //check whether the query executed successfully
                    if($res2==true){
                        //query executed and order is saved
                        $_SESSION['order'] = "<div class='success text-center'>Material Ordered Successfully</div>";
                        header('location:'.SITEURL);
                    }
                    else{
                        //failed to save order
                        $_SESSION['order'] = "<div class='error text-center'>Order Failed</div>";
                        header('location:'.SITEURL);
                    }


                }
            
            ?>
            

        </div>
    </section>
    <!-- material sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

</body>
</html>
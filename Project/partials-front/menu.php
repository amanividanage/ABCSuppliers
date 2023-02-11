<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Project</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo" style="display: flex;flex-direction: row;width:auto;">
                <img src="images/logo.png" alt="Restaurant Logo" class="logo-img" >
                
                <h1 style="margin-left:35px;font-size: 2rem;"> ABC Suppliers </h1>
                
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>materials.php">Materials</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Help</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>admin/index.php">Admin</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br />
        <br />
        <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="table-30">
                <tr>
                    <td>
                        Current Password:
                    </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">

                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>
                        Confirm Password: 
                    </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php  echo htmlspecialchars($id,  ENT_QUOTES, 'UTF-8'); ?>">
                        
                        <input type="submit" name="submit" value="Change Password" class="btn-update">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php 
    //check whether the submit button is click
    if(isset($_POST['submit'])){
        //get the data
        $id =$_POST['id'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        
        //check whether the current password holder exists

        $hashed_current_password = password_hash($current_password, PASSWORD_BCRYPT);
        $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

       // SELECT query to check if the provided password matches the one in the database
$sql = "SELECT * FROM tbl_admin WHERE id = ? AND password = ?";

// prepare statement
$stmt = mysqli_prepare($conn, $sql);

// bind parameters
mysqli_stmt_bind_param($stmt, "is", $id, $hashed_current_password);

// execute statement
mysqli_stmt_execute($stmt);

// get the result
$result = mysqli_stmt_get_result($stmt);

// check if the query execution was successful
if ($result) {
    // check if a record was returned
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        // check if the new password and confirm password match
        if ($new_password == $confirm_password) {
            // update the password
            $sql2 = "UPDATE tbl_admin SET password = ? WHERE id = ?";
            
            // prepare statement
            $stmt2 = mysqli_prepare($conn, $sql2);
            
            // bind parameters
            mysqli_stmt_bind_param($stmt2, "si", $new_password, $id);
            
            // execute statement
            $res2 = mysqli_stmt_execute($stmt2);
            
            // check if the query execution was successful
            if ($res2 == TRUE) {
                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
                header("location:".SITEURL.'admin/manage-admin.php');
            } else {
                $_SESSION['change-pwd'] = "<div class='error'>Failed to change password</div>";
                header("location:".SITEURL.'admin/manage-admin.php');
            }
        } else {
            // redirect to manage admin
            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
    } else {
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }
}

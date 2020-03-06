<?php
// Initialize the session
session_start(); 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config/config.php";
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
      // Prepare an update statement
      $sql = "UPDATE tbl_b2b SET password = ? WHERE register_id = ?";
      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "si", $param_password, $param_register_id);
          // Set parameters
          $param_password = password_hash($new_password, PASSWORD_DEFAULT);
          $param_register_id = $_SESSION["register_id"];
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              // Password updated successfully. Destroy the session, and redirect to login page
              session_destroy();
              header("location: login.php");
              exit();
          }else{
              echo "Oops! Something went wrong. Please try again later.";
          }
          // Close statement
          mysqli_stmt_close($stmt);
      }
    }
    // Close connection
    mysqli_close($link);
}
include_once('header.php');
?>
<section class="welcome-section">
    <div class="container">
        <div class="sec-title-two">
            <h2>Change Password</h2>
            <i class="fa fa-user" style="font-size: 20px; color: black;">Welcome <?php echo $_SESSION['register_id']; ?></i>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 col-sm-12">
            	<div class="row">
            		<div class="col-md-8">
		                <div class="wrapper" style="width: 450px; padding: 20px; margin: 0 auto;margin-bottom: 50px; box-shadow: 0 0 10px rgba(0,0,0,0.6);">
                        <h2>Reset Password</h2>
                        <p>Please fill out this form to reset your password.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                          <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                            <span class="help-block"><?php echo $new_password_err; ?></span>
                          </div>
                          <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Submit">
                          </div>
                        </form>
                    </div>
		            </div>
		        </div>
	        </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
            	<ul class="categories-menu">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="delegates-list.php">List of Delegates</a></li>
                    <li><a href="#">Meeting Request(s) received</a></li>
                    <li><a href="#">Meeting Request(s) sent</a></li>
                    <li><a href="#"><i class="fas fa-caret-right"></i>Change Password</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php include_once('footer.php'); ?>

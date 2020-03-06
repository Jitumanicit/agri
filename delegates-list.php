<?php
// Initialize the session
session_start(); 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include_once('header.php');
?>
<section class="welcome-section">
    <div class="container">
        <div class="sec-title-two">
            <h2>Delegates</h2>
            <i class="fa fa-user" style="font-size: 20px; color: black;">Welcome <?php echo $_SESSION['register_id']; ?></i>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 col-sm-12">
            	<div class="row">
            		<div class="col-md-8">
		                <div class="icon-holder">
		                    <div class="item text-center" style="background-color: blue;">
		                        <a href="b2b-delegates.php"><i class="fa fa-user" aria-hidden="true"></i></a>
		                        <h6>B2B DELEGATES</h6>
		                    </div>
		                    <div class="item text-center" style="background-color: green;">
		                        <a href="B2G-delegates.php"><i class="fa fa-users" aria-hidden="true"></i></a>
		                        <h6>B2G DELEGATES</h6>
		                    </div>
		                </div>
		            </div>
		        </div>
	        </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
            	<ul class="categories-menu">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="delegates-list.php"><i class="fas fa-caret-right"></i>List of Delegates</a></li>
                    <li><a href="meeting-received.php">Meeting Request(s) received</a></li>
                    <li><a href="meeting-sent.php">Meeting Request(s) sent</a></li>
                    <li><a href="change-password.php">Change Password</a></li>
                </ul>
            </div>
            <!-- Modal -->
        </div>
    </div>
</section>
<?php include_once('footer.php'); ?>
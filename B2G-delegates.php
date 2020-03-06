<?php
// Initialize the session
session_start(); 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include_once('header.php');
include_once("admin-4668/class/fetch-data.php");
    $b2b_list=new fetch_data();
?>
<section class="welcome-section" style="padding-top: 30px;">
    <div class="container">
        <div class="sec-title-two">
            <h2 style="font-size: 20px;">Please send desired meeting request</h2>
            <i class="fa fa-user" style="font-size: 20px; color: black;">Welcome <?php echo $_SESSION['register_id']; ?></i>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 col-sm-12">
            	<div class="table-responsive">
                    <table class="table table-bordered able-striped" id="table1" width="100%" cellspacing="0">
                    <thead style="font-size: 13px;">
                        <tr>
                            <th>Name</th>
                            <th>Organisation</th>
                            <th>Designation</th>
                            <th>Sector</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        <?php
                            $sql=$b2b_list->all_b2b_list();
                            while($row=mysqli_fetch_array($sql))
                            {
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
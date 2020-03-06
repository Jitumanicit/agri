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
            <h2>Dashboard</h2>
            <i class="fa fa-user" style="font-size: 20px; color: black;">Welcome <?php echo $_SESSION['register_id']; ?></i>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 col-sm-12">
            	<div class="row">
            		<div class="col-md-8">
		                <div class="icon-holder">
		                    <div class="item text-center" style="background-color: #59993b;">
		                        <a data-toggle="modal" data-target="#staticBackdrop" href="#"><i class="fa fa-user" aria-hidden="true"></i></a>
		                        <h6>VIEW PROFILE</h6>
		                    </div>
		                    <div class="item text-center" style="background-color: #ff6600;">
		                        <a href="#"><i class="fa fa-handshake-o" aria-hidden="true"></i></a>
		                        <h6>SCHEDULE A MEETING</h6>
		                    </div>
		                </div>
		            </div>
		        </div>
	        </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
            	<ul class="categories-menu">
                    <li><a href="#"><i class="fas fa-caret-right"></i>Dashboard</a></li>
                    <li><a href="delegates-list.php">List of Delegates</a></li>
                    <li><a href="meeting-received.php">Meeting Request(s) received</a></li>
                    <li><a href="meeting-sent.php">Meeting Request(s) sent</a></li>
                    <li><a href="change-password.php">Change Password</a></li>
                </ul>
            </div>
            <!-- Modal -->
            <?php
                include 'config/config.php';                
                $qry=mysqli_query($link,"SELECT * FROM tbl_users, tbl_b2b WHERE tbl_users.register_id ='".$_SESSION['register_id']."' AND tbl_users.register_id = tbl_b2b.register_id");
                while($row=mysqli_fetch_array($qry)){
            ?>
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Your Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Name: <?= $row['fname']. $row['mname']. $row['lname'] ?></p>
                    <p>Mobile Number: <?= $row['mobile'] ?></p>
                    <p>Email Id: <?= $row['email'] ?></p>
                    <p>Register Id: <?= $row['register_id'] ?></p>
                    <p>Designation: <?= $row['designation'] ?></p>
                    <p>Organisation: <?= $row['organisation'] ?></p>
                    <p>Organisation Profile: <?= $row['organisation_profile'] ?></p>
                    <p>Organisation Turnover: <?= $row['organisation_turnover'] ?></p>
                    <p>Organisation Profile: <?= $row['organisation_profile'] ?></p>
                    <p>Sector: <?= $row['sector'] ?></p>
                    <p>Address Line 1: <?= $row['address1'] ?></p>
                    <p>Address Line 2: <?= $row['address2'] ?></p>
                    <p>City: <?= $row['city'] ?></p>
                    <p>State: <?= $row['state'] ?></p>
                    <p>Pin: <?= $row['pin'] ?></p>
                    <p>Country: <?= $row['country'] ?></p>
                    <p>Interested Area in B2B: <?= $row['interest'] ?></p>
                    <p>Expectation from B2B: <?= $row['expectation'] ?></p>
                    <p>Assigned Category: <?= $row['delegates_category'] ?></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php include_once('footer.php'); ?>

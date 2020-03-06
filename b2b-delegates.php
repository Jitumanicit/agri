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
                    <tbody style="font-size: 12px;">
                        <?php
                            include_once("config/config.php");
                            $sql="SELECT tbl_users.id, tbl_users.fname, tbl_users.mname, tbl_users.lname,tbl_users.organisation, tbl_users.designation, tbl_users.sector FROM tbl_users, tbl_b2b WHERE tbl_users.register_id = tbl_b2b.register_id AND tbl_users.register_id != '".$_SESSION['register_id']."'";
                            $res = $link->query($sql);
                            while($row=$res->fetch_assoc()){
                        ?>
                        <tr>
                            <td style="padding: 0.5rem;"><?= $row['fname']. $row['mname']. $row['lname'] ?><i class="fa fa-info-circle" style="color: red; font-size: 18px;"></i></td>
                            <td style="padding: 0.5rem;"><?= $row['organisation'] ?></td>
                            <td style="padding: 0.5rem;"><?= $row['designation'] ?></td>
                            <td style="padding: 0.5rem;"><?= $row['sector'] ?></td>
                            <td style="padding: 0.5rem;"><a href="meeting-request.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger btn-sm">Request</a></td>
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
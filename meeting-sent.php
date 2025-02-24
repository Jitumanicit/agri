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
            <h2 style="font-size: 20px;">List of users respond you for meeting</h2>
            <i class="fa fa-user" style="font-size: 20px; color: black;">Welcome <?php echo $_SESSION['register_id']; ?></i>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 col-sm-12">
            	<div class="table-responsive">
                    <table class="table table-bordered able-striped" id="table1" width="100%" cellspacing="0">
                    <thead style="font-size: 13px;">
                        <tr>
                            <th>Name</th>
                            <th>Schedule Date</th>
                            <th>Start Time</th>
                            <th>Your Note</th>
                            <th>Reciver Comment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        <?php
                            include_once("config/config.php");
                            $sql="SELECT * FROM tbl_users, tbl_meeting WHERE tbl_users.register_id = tbl_meeting.reciver_register_id AND tbl_meeting.sender_register_id = '".$_SESSION['register_id']."'";
                            $res = $link->query($sql);
                            while($row=$res->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?= $row['fname'].$row['mname']. $row['lname']?></td>
                            <td><?= $row['meeting_date'] ?></td>
                            <td><?= $row['meeting_time_slot'] ?></td>
                            <td><?= $row['meeting_send_note'] ?></td>
                            <td><?= $row['meeting_reply_note'] ?></td>
                            <td>
                                <?php 
                                    if($row['activation_status'] == 1){
                                        echo "<span class='badge badge-pill badge-success'>Approved</span>";
                                    } else{
                                        echo "<span class='badge badge-pill badge-danger'>Not-Approved</span>";
                                    }

                             ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
	        </div>
            <div class="col-xl-4 col-md-6 col-sm-12">
            	<ul class="categories-menu">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="delegates-list.php">List of Delegates</a></li>
                    <li><a href="meeting-received.php">Meeting Request(s) received</a></li>
                    <li><a href="#"><i class="fas fa-caret-right"></i>Meeting Request(s) sent</a></li>
                    <li><a href="change-password.php">Change Password</a></li>
                </ul>
            </div>
            <!-- Modal -->
        </div>
    </div>
</section>
<?php include_once('footer.php'); ?>
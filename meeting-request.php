<?php
// Initialize the session
session_start(); 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include_once('header.php');
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    require_once "config/config.php";
    $sql = "SELECT * FROM tbl_users WHERE id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["id"]);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);    
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            } else{
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Oops...","Some errors found","error");';
                echo '}, 200);</script>';
                exit();
            }            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Oops!","Something went wrong.Please try again later","error");';
            echo '}, 200);</script>';
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else{
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Oops...","Some errors found","error");';
    echo '}, 200);</script>';
    exit();
}
?>
<section class="welcome-section" style="padding-top: 30px;">
    <div class="container">
        <div class="sec-title-two">
            <h2 style="font-size: 20px;">Request for Meeting</h2>
            <i class="fa fa-user" style="font-size: 20px; color: black;">Welcome <?php echo $_SESSION['register_id']; ?></i>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 col-sm-12">
            	<form class="form-group">
                    <p>Username: <?= $row['fname'] ?> <?= $row['mname'] ?> <?= $row['lname'] ?> <i class="fa fa-search-plus" data-toggle="modal" data-target="#exampleModalCenter" style="font-size:18px;color:red"></i></p>
                    <p id="error_message" style="color: red;"></p>
                    <div class="form-group">
                        <label>Select date of meeting : </label>
                        <input type="date" min="2020-04-03" max="2020-04-06" id="meeting_date"  name="meeting_date" class="form-control" required>
                        <input type="hidden" id="sender_register_id" name="sender_register_id" value="<?= $_SESSION['register_id'] ?>">
                        <input type="hidden" id="reciver_register_id" name="reciver_register_id" value="<?= $row['register_id'] ?>">
                        <input type="hidden" id="reciver_mobile" name="reciver_mobile" value="<?= $row['mobile'] ?>">
                        <input type="hidden" id="reciver_email" name="reciver_email" value="<?= $row['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Select meeting slot : </label>
                        <select name="meeting_time_slot" id="meeting_time_slot" class="form-control" required>
                            <option value="">--Select Time--</option>
                            <option value="10.00AM">10.00AM</option>
                            <option value="10.20AM">10.20AM</option>
                            <option value="10.40AM">10.40AM</option>
                            <option value="11.00AM">11.00AM</option>
                            <option value="11.20AM">11.20AM</option>
                            <option value="11.40AM">11.40AM</option>
                            <option value="12.00PM">12.00PM</option>
                            <option value="12.20PM">12.20PM</option>
                            <option value="12.40PM">12.40PM</option>
                            <option value="01.00PM">01.00PM</option>
                            <option value="01.20PM">01.20PM</option>
                            <option value="01.40PM">01.40PM</option>
                            <option value="02.00PM">02.00PM</option>
                            <option value="02.20PM">02.20PM</option>
                            <option value="02.40PM">02.40PM</option>
                            <option value="03.00PM">03.00PM</option>
                            <option value="03.20PM">03.20PM</option>
                            <option value="03.40PM">03.40PM</option>
                            <option value="04.00PM">04.00PM</option>
                            <option value="04.20PM">04.20PM</option>
                            <option value="04.40PM">04.40PM</option>
                            <option value="05.00PM">05.00PM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Comment (if any)</label>
                        <textarea name="meeting_send_note" id="meeting_send_note" class="form-control"></textarea>
                    </div>
                    <div class="alert alert-danger" role="alert">
                      Note: Duration of meeting is 20 Minutes.
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" id="scheduleMeeting" class="btn btn-success btn-block">Schedule Meeting</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger btn-block">Back</button>
                            </div>
                        </div>
                    </div>
	        	</form>
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
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Profile Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Name: <?= $row['fname'] ?> <?= $row['mname'] ?> <?= $row['lname'] ?></p>
                    <p>Designation: <?= $row['designation'] ?></p>
                    <p>Organisation: <?= $row['organisation'] ?></p>
                    <p>Organisation Profile: <?= $row['organisation_profile'] ?></p>
                    <p>Organisation Turnover: <?= $row['organisation_turnover'] ?></p>
                    <p>Organisation Address Line1: <?= $row['address1'] ?></p>
                    <p>Organisation Address Line2: <?= $row['address2'] ?></p>
                    <p>Sector: <?= $row['sector'] ?></p>
                    <p>City: <?= $row['city'] ?></p>
                    <p>State: <?= $row['state'] ?></p>
                    <p>Pin: <?= $row['pin'] ?></p>
                    <p>Country: <?= $row['country'] ?></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
        </div>
    </div>
</section>
<?php include_once('footer.php'); ?>
<script>
        $(document).ready(function(){
            $("#scheduleMeeting").click(function(){
                var meeting_date=$("#meeting_date").val();
                var sender_register_id=$("#sender_register_id").val();
                var reciver_register_id=$("#reciver_register_id").val();
                var reciver_mobile=$("#reciver_mobile").val();
                var reciver_email=$("#reciver_email").val();
                var meeting_time_slot=$("#meeting_time_slot").val();
                var meeting_send_note=$("#meeting_send_note").val();
                if(meeting_date == '' || sender_register_id == '' || reciver_register_id == '' || reciver_mobile == '' || reciver_email == '' || meeting_time_slot == '') 
                {  
                    $('#error_message').html("All Fields are required");
                }
                else{
                    $.ajax({
                        url:'webservice/ajax_user.php',
                        method:'POST',
                        data:{
                            meeting_date:meeting_date,
                            sender_register_id:sender_register_id,
                            reciver_register_id:reciver_register_id,
                            reciver_mobile:reciver_mobile,
                            reciver_email:reciver_email,
                            meeting_time_slot:meeting_time_slot,
                            meeting_send_note:meeting_send_note
                        },
                       success:function(data){
                            $("form").trigger("reset");
                            swal(data);
                       }
                    });
                }
            });
        });
</script>

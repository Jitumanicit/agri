<?php
require_once "../config/config.php";
$meeting_reply_note = $mobile = "";
$meeting_reply_note_err = $mobile_err = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];   
    // Validate activation status
    $input_meeting_reply_note = trim($_POST["meeting_reply_note"]);
    if(empty($input_meeting_reply_note)){
        $meeting_reply_note_err = "Please enter an reply note.";     
    } else{
        $meeting_reply_note = $input_meeting_reply_note;
    }
    // Validate activation status
    $input_mobile = trim($_POST["mobile"]);
    if(empty($input_mobile)){
        $mobile_err = "Please enter an mobile number.";     
    } else{
        $mobile = $input_mobile;
    }
    // Check input errors before inserting in database
    if(empty($activation_status_err)){
        $sql = "UPDATE tbl_meeting SET meeting_reply_note=? WHERE id=?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_meeting_reply_note, $param_id);
            $param_meeting_reply_note = $meeting_reply_note;
            $mobile_number = $mobile;
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                // send SMS
                $username = "mobisoftguwahati";
                $password = "65a31c";
                $sender   = "AIAHSW";
                $messages = urlencode('Response about your meeting request - '.$param_meeting_reply_note.'');
                $api_url  = "http://makemysms.in/api/sendsms.php?username=".$username."&password=".$password."&sender=".$sender."&mobile=".$mobile_number."&type=1&product=1&message=".$messages;
                $output   = file_get_contents($api_url);
                header("location: b2g-schedule-meeting.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
    } else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        $sql = "SELECT * FROM tbl_meeting, tbl_users WHERE tbl_meeting.id = ? AND tbl_meeting.sender_register_id = tbl_users.register_id";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $meeting_reply_note = $row['meeting_reply_note'];
                    $mobile = $row['mobile'];
                } else{
                    header("location: error.php");
                    exit();
                }                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }  else{
        header("location: error.php");
        exit();
    }
}
include_once('header.php');
?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">B2G Meeting Request- Suggest another time</h6>
        </div>
        <div class="card-body">
        	<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>"method="post">
                <p>Sender Details : <?= $row['fname'].$row['mname']. $row['lname'] ?>&nbsp;<i class="fa fa-search-plus" data-toggle="modal" data-target="#exampleModalCenter" style="font-size:18px;color:red"></i></p>
                <p>Meeting Details : &nbsp;<i class="fa fa-search-plus" data-toggle="modal" data-target="#exampleModalCenter1" style="font-size:18px;color:red"></i></p>
                <div class="form-group <?php echo (!empty($activation_status_err)) ? 'has-error' : ''; ?>">
                    <label>Meeting Reply Note(Suggest another time):</label>
                    <textarea name="meeting_reply_note" class="form-control" value="<?php echo $meeting_reply_note; ?>"></textarea>
                    <span class="help-block"><?php echo $meeting_reply_note_err;?></span>
                </div>
                <input type="hidden" name="mobile" value="<?= $mobile ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <div class="alert alert-danger" role="alert">
                    Note: Duration of meeting is 20 Minutes.
                </div>
                <input type="submit" class="btn btn-success" value="Suggest another time">
                <a href="b2g-schedule-meeting.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
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
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Meeting Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Meeting Date: <?= $row['meeting_date'] ?></p>
                    <p>Meeting Time Slot: <?= $row['meeting_time_slot'] ?></p>
                    <p>Meeting Send Note: <?= $row['meeting_send_note'] ?></p>
                    <div class="alert alert-danger" role="alert">
                      Note: Duration of meeting is 20 Minutes.
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
</div>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
           <span>Copyright &copy; Your Website 2019</span>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
   <i class="fas fa-angle-up"></i>
</a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
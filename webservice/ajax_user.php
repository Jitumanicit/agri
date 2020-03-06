<?php
	include_once("../config/config.php");
	$meeting_date=$_POST['meeting_date'];
	$sender_register_id=$_POST['sender_register_id'];
	$reciver_register_id=$_POST['reciver_register_id'];
	$reciver_mobile=$_POST['reciver_mobile'];
	$reciver_email=$_POST['reciver_email'];
	$meeting_time_slot = $_POST['meeting_time_slot'];
	$meeting_send_note = $_POST['meeting_send_note'];
	$sql_find = "SELECT id FROM tbl_meeting WHERE meeting_date = '$meeting_date' AND meeting_time_slot = '$meeting_time_slot' AND 	activation_status = 1";
	$sql_find_reciver = "SELECT id FROM tbl_meeting WHERE reciver_register_id = '$reciver_register_id' AND  meeting_date = '$meeting_date' AND meeting_time_slot = '$meeting_time_slot' AND activation_status = 1";
	$sql_find_sender = "SELECT id FROM tbl_meeting WHERE sender_register_id = '$sender_register_id' AND  meeting_date = '$meeting_date' AND meeting_time_slot = '$meeting_time_slot' AND activation_status = 1";
	$sql_find_both = "SELECT id FROM tbl_meeting WHERE sender_register_id = '$reciver_register_id' AND  meeting_date = '$meeting_date' AND meeting_time_slot = '$meeting_time_slot' AND activation_status = 1";
	$result = mysqli_query($link, $sql_find);
	$result_reciver = mysqli_query($link, $sql_find_reciver);
	$result_sender = mysqli_query($link, $sql_find_sender);
	$result_both = mysqli_query($link, $sql_find_both);
	$rowcount=mysqli_num_rows($result);
	$rowcount_reciver=mysqli_num_rows($result_reciver);
	$rowcount_sender=mysqli_num_rows($result_sender);
	$rowcount_both=mysqli_num_rows($result_both);
	if (mysqli_num_rows($result) > 24) {
		echo "All the tables are booked already in this time slot. Please select another time. Thank You.";
	} 
	else if(mysqli_num_rows($result_reciver) == 1){
		echo "This delegates are not available in this time slot. Please select another time. Thank You";
	}
	else if(mysqli_num_rows($result_sender) == 1){
		echo "You already booked a meeting in this time slot. Please select in another time. Thank You";
	}
	else if(mysqli_num_rows($result_both) == 1){
		echo "This delegates are not available in this time slot. Please select another time. Thank You";
	}
	else{
		$sql = "INSERT INTO `tbl_meeting` (`sender_register_id`, `reciver_register_id`, `meeting_date`, `meeting_time_slot`, `meeting_send_note`) VALUES ('$sender_register_id', '$reciver_register_id', '$meeting_date', '$meeting_time_slot', '$meeting_send_note')";
		if(mysqli_query($link, $sql)){
			$username = "mobisoftguwahati";
            $password = "65a31c";
            $sender   = "AIAHSW";
            $messages = urlencode('You receive a meeting request on '.$meeting_date.' at '.$meeting_time_slot.'. Give your response on meeting approval. Thank you!');
            $api_url  = "http://makemysms.in/api/sendsms.php?username=".$username."&password=".$password."&sender=".$sender."&mobile=".$reciver_mobile."&type=1&product=1&message=".$messages;
            $output   = file_get_contents($api_url);
			echo "Your meeting request sent to the delegates. You recive a confirmation message once your request accepted!";
		}
	}
?>
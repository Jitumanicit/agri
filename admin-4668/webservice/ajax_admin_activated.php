<?php
	include_once("../../config/config.php");
	if (isset($_POST['data'])) {
		$dataArr = $_POST['data'];
		foreach($dataArr as $id){
			mysqli_query($link, "UPDATE tbl_users SET activation_status = '1' WHERE mobile='$id'");
			$username = "mobisoftguwahati";
            $password = "65a31c";
            $sender   = "VALMSG";
            $messages = urlencode('Thank You!, Your account has approved for B2B Registration. Register Now.');
            $api_url  = "http://makemysms.in/api/sendsms.php?username=".$username."&password=".$password."&sender=".$sender."&mobile=".$id."&type=1&product=1&message=".$messages;
            $output   = file_get_contents($api_url);
		}
	}
?>
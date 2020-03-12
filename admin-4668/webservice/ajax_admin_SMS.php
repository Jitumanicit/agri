<?php
	include_once("../../config/config.php");
	if (isset($_POST['data'])) {
		$dataArr = $_POST['data'];
		$send_mobile_sms = $_POST['send_mobile_sms'];
		foreach($dataArr as $id){
			$username = "mobisoftguwahati";
            $password = "65a31c";
            $sender   = "VALMSG";
            $messages = urlencode($send_mobile_sms);
            $api_url  = "http://makemysms.in/api/sendsms.php?username=".$username."&password=".$password."&sender=".$sender."&mobile=".$id."&type=1&product=1&message=".$messages;
            $output   = file_get_contents($api_url);
		}
	}
?>
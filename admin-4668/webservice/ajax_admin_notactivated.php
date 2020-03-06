<?php
	include_once("../../config/config.php");
	if (isset($_POST['data'])) {
		$dataArr = $_POST['data'];
		foreach($dataArr as $id){
			mysqli_query($link, "UPDATE tbl_users SET activation_status = '0' WHERE mobile='$id'");
		}
	}
?>
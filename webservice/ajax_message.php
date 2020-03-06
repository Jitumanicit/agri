<?php
	include_once("../config/config.php");
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	$sql="INSERT INTO `tbl_message` (`name`, `email`, `mobile`, `subject`, `message`) VALUES ('$name', '$email', '$mobile', '$subject', '$message')";
	if ($link->query($sql) === TRUE) {
    	echo "data inserted";
	}
	else 
	{
    	echo "failed";
	}
?>
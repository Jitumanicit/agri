<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'event');
class fetch_data
	{
 		function __construct()
 		{
			$mysqli = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
			$this->dbh=$mysqli;
			// Check connection
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
 			}
 		}

 		public function all_delegate_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_users WHERE branch = '' ORDER BY id DESC");
 			return $result;
 		}

 		public function all_b2b_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_b2b, tbl_users WHERE tbl_users.register_id = tbl_b2b.register_id ORDER BY tbl_b2b.id DESC");
 			return $result;
 		}

 		public function all_approved_delegates_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_users WHERE activation_status = 1 AND branch = ''  ORDER BY id DESC");
 			return $result;
 		}

 		public function all_unapproved_delegates_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_users WHERE activation_status != 1 AND branch =''  ORDER BY id DESC");
 			return $result;
 		}

 		public function all_student_academia_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_users WHERE sector = 'Academia' OR sector = 'Students'  ORDER BY id DESC");
 			return $result;
 		}
 		public function all_message_query()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_message ORDER BY id DESC");
 			return $result;
 		}
 		public function approved_meeting_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_meeting WHERE activation_status = 1 ORDER BY id DESC");
 			return $result;
 		}
 		public function unapproved_meeting_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_meeting WHERE activation_status != 1 ORDER BY id DESC");
 			return $result;
 		}
 		public function all_b2g_delegates_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_users WHERE branch = 'b2g' ORDER BY id DESC");
 			return $result;
 		}
 		public function b2g_schedule_meeting_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_users, tbl_meeting WHERE tbl_users.branch = 'b2g'");
 			return $result;
 		}
 		public function b2g_all_meeting_list()
 		{
 			$result=mysqli_query($this->dbh,"SELECT * FROM tbl_users, tbl_meeting WHERE tbl_users.branch = 'b2g' AND tbl_meeting.activation_status = 1");
 			return $result;
 		}
	}
?>
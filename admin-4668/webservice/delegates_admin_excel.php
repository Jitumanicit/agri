<?php
	include_once("../../config/config.php");
	$output = '';
	if (isset($_POST["export_excel"])) {
			$sql = "SELECT * FROM tbl_users";
			$result = mysqli_query($link, $sql);
			if(mysqli_num_rows($result) > 0){
				$output .= '<table class="table" bordered="1">
								<tr>
									<th>ID</th>
									<th>First Name</th>
									<th>Middle Name</th>
									<th>Last Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>RegisterId</th>
									<th>Address1</th>
									<th>Address2</th>
									<th>Designation</th>
									<th>Organisation</th>
									<th>Sector</th>
									<th>Organisation Turnover</th>
									<th>Organisation Profile</th>
									<th>Activation Status</th>
									<th>Category</th>
									<th>City</th>
									<th>State</th>
									<th>Pin</th>
									<th>Country</th>
									<th>Register At</th>
								</tr>
				';
				while($row = mysqli_fetch_array($result))
				{
					$output .='
						<tr>
							<td>'.$row["id"].'</td>
							<td>'.$row["fname"].'</td>
							<td>'.$row["mname"].'</td>
							<td>'.$row["lname"].'</td>
							<td>'.$row["mobile"].'</td>
							<td>'.$row["email"].'</td>
							<td>'.$row["register_id"].'</td>
							<td>'.$row["address1"].'</td>
							<td>'.$row["address2"].'</td>
							<td>'.$row["designation"].'</td>
							<td>'.$row["organisation"].'</td>
							<td>'.$row["sector"].'</td>
							<td>'.$row["organisation_turnover"].'</td>
							<td>'.$row["organisation_profile"].'</td>
							<td>'.$row["activation_status"].'</td>
							<td>'.$row["delegates_category"].'</td>
							<td>'.$row["city"].'</td>
							<td>'.$row["state"].'</td>
							<td>'.$row["pin"].'</td>
							<td>'.$row["country"].'</td>
							<td>'.$row["created_at"].'</td>
						</tr>';
				}
				$output .='</table>';
				header("Content-Type: application/xls");
				header("Content-Disposition: attachment; filename=all_delegates.xls");
				echo $output;
			}
		}
?>
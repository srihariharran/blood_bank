<?php
	//Starting Session
	session_start();
	//Checking Request Method and key
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['key']) && $_POST['key']=="EDMASLFF")
	{
		//Database Connection
		include 'db.php';
		//Getting Form values
		$blood_group=$_POST['blood_group'];
		$city=$_POST['city'];
		//Checking Values whether empty or not
		if($blood_group=='#' && $city=='#')
		{
			//Checking for session to get values from db
			if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="HSHAAES1")
			{
				$email_id=$_SESSION['email_id'];
				$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id WHERE bbud.email_id='$email_id'";
			}
			else
			{
				$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id";
			}
			//Exceuting Query
			if($res=mysqli_query($con,$sql))
			{
				//Fteching db values in Array
				while($row=mysqli_fetch_array($res))
				{
					//Printing Values
					?>
					<div class="col-sm-4 p-3">
					<div class="box text-center p-2">
					<table class="table table-bordered ">
					<tr>
					<td colspan="2"><img src="Logo/<?php echo $row['hospital_logo']; ?>" width="100%" height="150px"></td>
					</tr>
					<tr>
					<th>Hospital</th>
					<td><?php echo $row['name']; ?></td>
					</tr>
					<tr>
					<th>Hospital City</th>
					<td><?php echo $row['city']; ?></td>
					</tr>
					<tr>
					<th>Available Blood Group</th>
					<td><?php echo $row['blood_group']; ?></td>
					</tr>
					<?php
					if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="RSHAAES7")
					{
						?>
						<tr>
						<th>Email Id</th>
						<td><?php echo $row['email_id']; ?></td>
						</tr>
						<tr>
						<th>Contact No</th>
						<td><?php echo $row['contact_no']; ?></td>
						</tr>
						<tr>
						<td colspan="2">
						<form class="request_form" id="request-form<?php echo $i; ?>">
						<input type="hidden" name="hospital_id" value="<?php echo $row['email_id']; ?>" />
						<input type="hidden" name="blood_group" value="<?php echo $row['blood_group'] ?>" />
						<input type="hidden" name="receiver_email_id" value="<?php echo $email_id ?>" />
						<input type="hidden" name="key" value="MDU7" />
						<input type="submit" id="<?php echo $i; ?>" class="btn btn-success" value="Request Blood Sample">
						</form>
						</td>
						</tr>
						<?php
					}
					?>
					</table>
					</div>
					</div>
					<?php

				}
			}
		}
		else
		{
			if($city!='#' && $blood_group!='#')
			{
				if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="HSHAAES1")
				{
					$email_id=$_SESSION['email_id'];
					$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id WHERE bbud.city=? AND bbbd.blood_group=? AND bbud.email_id=?";
					$sql_stmt = mysqli_prepare($con, $sql);
					mysqli_stmt_bind_param($sql_stmt, 'sss',$city,$blood_group,$email_id);
				}
				else
				{
					$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id WHERE bbud.city=? AND bbbd.blood_group=?";
					$sql_stmt = mysqli_prepare($con, $sql);
					mysqli_stmt_bind_param($sql_stmt, 'ss',$city,$blood_group);
				}
			}
			else if($blood_group!='#' && $city=='#')
			{
				if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="HSHAAES1")
				{
					$email_id=$_SESSION['email_id'];
					$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id WHERE bbbd.blood_group=? AND bbud.email_id=?";
					$sql_stmt = mysqli_prepare($con, $sql);
					mysqli_stmt_bind_param($sql_stmt, 'ss',$blood_group,$email_id);
				}
				else
				{
					$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id WHERE bbbd.blood_group=?";
					$sql_stmt = mysqli_prepare($con, $sql);
					mysqli_stmt_bind_param($sql_stmt, 's',$blood_group);
				}
			}
			else if($blood_group=='#' && $city!='#')
			{
				if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="HSHAAES1")
				{
					$email_id=$_SESSION['email_id'];
					$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id WHERE bbud.city=? AND bbud.email_id=?";
					$sql_stmt = mysqli_prepare($con, $sql);
					mysqli_stmt_bind_param($sql_stmt, 'ss',$city,$email_id);
				}
				else
				{
					$sql="SELECT DISTINCT(bbbd.blood_group),bbud.email_id,bbud.name,bbud.city,bbud.hospital_logo,bbud.contact_no  FROM blood_bank_blood_details bbbd JOIN blood_bank_user_details bbud ON bbbd.hospital_id = bbud.email_id WHERE bbud.city=?";
					$sql_stmt = mysqli_prepare($con, $sql);
					mysqli_stmt_bind_param($sql_stmt, 's',$city);
				}
			}
			mysqli_stmt_execute($sql_stmt);
			if($res=mysqli_stmt_get_result($sql_stmt))
			{
				if(mysqli_num_rows($res)!=0)
				{
					$i=0;
					while($row=mysqli_fetch_array($res))
					{

						?>
						<div class="col-sm-4 p-3">
						<div class="box text-center p-2">
						<table class="table table-bordered ">
						<tr>
						<td colspan="2"><img src="Logo/<?php echo $row['hospital_logo']; ?>" width="100%" height="150px"></td>
						</tr>
						<tr>
						<th>Hospital</th>
						<td><?php echo $row['name']; ?></td>
						</tr>
						<tr>
						<th>Hospital City</th>
						<td><?php echo $row['city']; ?></td>
						</tr>
						<tr>
						<th>Available Blood Group</th>
						<td><?php echo $row['blood_group']; ?></td>
						</tr>

						<?php
						if(isset($_SESSION['login_key']) && $_SESSION['login_key']=="RSHAAES7")
						{
							?>
							<tr>
							<th>Email Id</th>
							<td><?php echo $row['email_id']; ?></td>
							</tr>
							<tr>
							<th>Contact No</th>
							<td><?php echo $row['contact_no']; ?></td>
							</tr>
							<tr>
							<td colspan="2">
							<form class="request_form" id="request-form<?php echo $i; ?>">
							<input type="hidden" name="hospital_id" value="<?php echo $row['email_id']; ?>" />
							<input type="hidden" name="blood_group" value="<?php echo $row['blood_group'] ?>" />
							<input type="hidden" name="receiver_email_id" value="<?php echo $email_id ?>" />
							<input type="hidden" name="key" value="MDU7" />
							<input type="submit" id="<?php echo $i; ?>" class="btn btn-success" value="Request Blood Sample">
							</form>
							</td>
							</tr>
							<?php
						}
						?>
						</table>
						</div>
						</div>
						<?php
						$i++;
					}
				}
			}
			else
			{
				echo "No Records Found";
			}


		}

	}
	else
	{
		if(isset($_SESSION['login_key']))
		{
		header("location:available-blood-samples.php");
		}
		else
		{
		header("location:index.php");
		}
	}

?>
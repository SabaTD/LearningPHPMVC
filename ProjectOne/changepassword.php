<?php 
	session_start();
	require_once "functions.php";
	$user = new LoginRegistration();
	$uid = $_SESSION['uid'];

	if(!$user->getSession()){
		header('Location: login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html Lang = "en">
	<head>
		<meta charset="UTF-8">
		<title>Change Password</title>
		<link rel="stylesheet" type="text/css" href="style/style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<h3>PHP OOP Login-Registre System</h3>
			</div>

			<div class="mainmenu">
				<ul>
					<?php if($user->getSession()){ ?>

					<li><a href="index.php">Home</a></li>
					<li><a href="profile.php">Show Profile</a></li>
					<li><a href="changepassword.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>

					<?php } else{ ?>

					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Register</a></li>
					
					<?php } ?>
				</ul>
			</div><!-- end of mainmenu-->

			<div class="content">

				<h2> Update your profile</h2>
			
				<p class="msg"> 
					<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							$old_pass     = $_POST['old_password'];
							$new_pass     = $_POST['new_password'];
							$confirm_pass = $_POST['confirm_password'];

							if (empty($old_pass) or empty($new_pass) or empty($confirm_pass)) {
								echo "<span style='color:#e53d37'> All fields must not be empty</span>";
							}	
							else if($new_pass != $confirm_pass){
								echo "<span style='color:#e53d37'> Passwords do not match</span>";
							}
							else{
								$old_pass = md5($old_pass);
								$new_pass = md5($new_pass);
								$passUpdate = $user->updatePassword($uid, $new_pass, $old_pass);
							}
							
						}
					?>
				</p>
				

				<div class="login_reg">
					<form action="" method="post">
						<table>
							<tr>
								<td>Old password:</td>
								<td><input type="password" name="old_password" placeholder="Enter your old password" /></td>
							</tr>
						
							<tr>
								<td>New password:</td>
								<td><input type="password" name="new_password" placeholder="Enter your new password" /></td>
							</tr>

							<tr>
								<td>Confirm new password:</td>
								<td><input type="password" name="confirm_password" placeholder="Confirm your new password"/></td>
							</tr>

							<tr>
								<td colspan="2">
									<span style="float: right;">
										<input style="width: 141px; background: #888 none repeat scroll 0 0; border: 1px solid #626262; border-radius: 3px; color: #fff; cursor: pointer; font-size: 15px; font-weight: bold; padding: 2px 5px;" type="submit" name="update" value="Update"/>
										<input style="width: 140px; background: #888 none repeat scroll 0 0; border: 1px solid #626262; border-radius: 3px; color: #fff; cursor: pointer; font-size: 15px; font-weight: bold; padding: 2px 5px;"  type="reset" value="Reset"/>
									</span>
								</td>	
							</tr>
						</table>
					</form>
				</div><!--end of loginreg -->
				
			</div><!-- end of content-->

			<div class="back">
				<a href="index.php"><img src="images/back.png" alt="back"/></a>
			</div>

			<div class="footer">
				<h3>Copyright</h3>
			</div><!-- end of footer-->


		</div><!-- end of wrapper-->
	</body>

</html>
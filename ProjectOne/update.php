<?php 
	session_start();
	require_once "functions.php";
	$user = new LoginRegistration();
	$uid = $_SESSION['uid'];
	$username = $_SESSION['uname'];

/*
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
	}
	else{
		header("Location: index.php");
		exit();
	}
*/

	if(!$user->getSession()){
		header('Location: login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html Lang = "en">
	<head>
		<meta charset="UTF-8">
		<title>Update Profile</title>
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
							$username = $_POST['username'];
							$name     = $_POST['name'];
							$email    = $_POST['email'];
							$website  = $_POST['website'];

							if (empty($username) or empty($name) or empty($email) or empty($website)) {
								echo "<span style='color:#e53d37'> All fields must not be empty</span>";
							}	
							else{
								$update = $user->updateUser($uid, $username, $name, $email, $website);
								if($update){
									echo "<span style='color:green'>Information updated succesfully. </span>";
								}
							}
						}
					?>
				</p>
				
				<?php   
					$result = $user->getUserDetails($uid);
					foreach ($result as $row){
				?>

				<div class="login_reg">
					<form action="" method="post" name="reg">
						<table>
							<tr>
								<td>Username:</td>
								<td><input type="text" name="username" value="<?php echo $row['username'] ?>" /></td>
							</tr>
						
							<tr>
								<td>Name:</td>
								<td><input type="text" name="name" value="<?php echo $row['name'] ?>" /></td>
							</tr>

							<tr>
								<td>Email:</td>
								<td><input type="email" name="email" value="<?php echo $row['email'] ?>" /></td>
							</tr>

							<tr>
								<td>Website:</td>
								<td><input type="text" name="website" value="<?php echo $row['website'] ?>" /></td>
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
				<?php } ?>
				
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
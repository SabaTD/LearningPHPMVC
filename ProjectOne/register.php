<?php 
	session_start();
	require_once "functions.php";
	$user = new LoginRegistration();
	if($user->getSession()){
		header('Location: index.php');
		exit();
	}
?>


<!DOCTYPE html>
<html Lang = "en">
	<head>
		<meta charset="UTF-8">
		<title>Registration Page</title>
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
			</div>

			<div class="content">
				<h2>Register</h2>
			</div>

			<p class="msg">
				<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {
						$username = $_POST['username'];
						$password = $_POST['password'];
						$name     = $_POST['name'];
						$email    = $_POST['email'];
						$website  = $_POST['website'];

						if (empty($username) or empty($password) or empty($name) or empty($email) or empty($website)) {
							echo "<span style='color:#e53d37'> All fields must not be empty</span>";
						}
						else{
							$password = md5($password);
							$register = $user->registerUser($username, $password, $name, $email, $website);
							if($register){
								echo "<span style='color:green'>Registration succesfull <a href='login.php'>Clic here</a> for login.</span>";
							}
							else{
								echo "<span style='color:#e53d37'>Username or Email already exist. </span>";
							}
						}
					}
				?>
			</p>

			<div class="login_reg">
				<form action="" method="post">
					<table>
						<tr>
							<td>Username:</td>
							<td><input type="text" name="username" placeholder="Enter username" /></td>
						</tr>
						<tr>
							<td>Password:</td>
							<td><input type="password" name="password" placeholder="Enter password" /></td>
						</tr>
						<tr>
							<td>Name:</td>
							<td><input type="text" name="name" placeholder="Enter name" /></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="email" name="email" placeholder="Enter email adress" /></td>
						</tr>
						<tr>
							<td>Website:</td>
							<td><input type="text" name="website" placeholder="Enter website adress" /></td>
						</tr>
						<tr>
							<td colspan="2">
								<span style="float: right;">
									<input style="width: 141px; background: #888 none repeat scroll 0 0; border: 1px solid #626262; border-radius: 3px; color: #fff; cursor: pointer; font-size: 15px; font-weight: bold; padding: 2px 5px;" type="submit" name="register" value="Register"/>
									<input style="width: 140px; background: #888 none repeat scroll 0 0; border: 1px solid #626262; border-radius: 3px; color: #fff; cursor: pointer; font-size: 15px; font-weight: bold; padding: 2px 5px;"  type="reset" value="Reset"/>
								</span>
							</td>	
						</tr>
					</table>
				</form>
			</div><!--end of loginreg -->

			<div class="back">
				<a href="login.php"><img src="images/back.png" alt="back"/></a>
			</div>

			<div class="footer">
				<h3>Copyright</h3>
			</div>


		</div>
	</body>

</html>
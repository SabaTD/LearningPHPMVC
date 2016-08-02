<?php 
	session_start();
	require_once "functions.php";
	$user = new LoginRegistration();
	@$uid = $S_SESSION['uid'];
	$username = $_SESSION['uname'];
	if(!$user->getSession()){
		header('Location: login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html Lang = "en">
	<head>
		<meta charset="UTF-8">
		<title>Home Page</title>
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
			
				<span class="login_msg">
					<?php
						if(isset($_SESSION['login_msg'])){
							echo $_SESSION['login_msg'];
							unset($_SESSION['login_msg']);
						}
					?>
				</span>

				<h2>Welcome, <?php echo $username; ?></h2>
				<p class="userlist">All User's list.</p>
				<table class="tbl_one">
					<tr>
						<th>Serial</th>
						<th>Name</th>
						<th>Profile</th>
					</tr>

					<?php
						$i = 0;
						$alluser = $user->getAllusers();
						foreach ($alluser as $user) {
							$i++;
						
					?>

					<tr>
						<td><?php echo $i; ?> </td>
						<td><?php echo $user['name']; ?></td>
						<td><a href="userprofile.php?id=<?php echo $user['id'];?>"> View Details </a></td>
					</tr>

					<?php } ?>
				</table>

			</div>

			<div class="footer">
				<h3>Copyright</h3>
			</div>


		</div>
	</body>

</html>
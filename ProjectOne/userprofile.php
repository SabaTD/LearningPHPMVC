<?php 
	session_start();
	require_once "functions.php";
	$user = new LoginRegistration();
	$uid = $_SESSION['uid'];
	$username = $_SESSION['uname'];

	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
	}
	else{
		header("Location: index.php");
		exit();
	}

	if(!$user->getSession()){
		header('Location: login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html Lang = "en">
	<head>
		<meta charset="UTF-8">
		<title>User Profile</title>
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
			
				<span class="login_msg">
					<?php
						
					?>
				</span>

				<h2>Welcome, <?php echo $username; ?></h2>
				<p class="userlist">Profile of: <?php $user->getUsername($id);  ?></p>
				<table class="tbl_one"> 
					<?php
						$getUsers = $user->getUserById($id);
						foreach ($getUsers as $user) {
					?>
					<tr>
						<td>Username</td>
						<td style="width: 293px;"><?php echo $user['username']; ?></td>
					</tr>

					<tr>
						<td>Name</td>
						<td><?php echo $user['name']; ?></td>
					</tr>

					<tr>
						<td>Email</td>
						<td><?php echo $user['email']; ?></td>
					</tr>

					<tr>
						<td>Website</td>
						<td><?php echo $user['website']; ?></td>
					</tr>

						<?php if($user['id'] == $uid){ ?>
					<tr>
						<td colspan="2"><a href="update.php?id=<?php echo $user['id']; ?>">Edit Profile</a></td>
					</tr>

					<?php } }?>
				</table>
				
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
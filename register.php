<?php 
	include("includes/php-global.php");
	$CURRENT_PAGE = "Register";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Registration<?php print $SITE_TITLE;?></title>
</head>
<body id="register">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-register">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<?php
						require('includes/db.php');
						// When form submitted, insert values into the database.
						$userCreated = false;
					    if (isset($_REQUEST['username'])) {
					        // removes backslashes
					        $newUsername = stripslashes($_REQUEST['username']);
					        //escapes special characters in a string
					        $newUsername = mysqli_real_escape_string($conn, $newUsername);
					        $email    = stripslashes($_REQUEST['email']);
					        $email    = mysqli_real_escape_string($conn, $email);
					        $password = stripslashes($_REQUEST['password']);
					        $password = mysqli_real_escape_string($conn, $password);
					        $encryptedPassword = md5($password);
					        $Date = date("Y-m-d H:i:s");
							$create_datetime = date("Y-m-d H:i:s",strtotime($Date));
							// check if the user exists
							$datatable = "users_gym";
							$sql = "SELECT * FROM $datatable WHERE username='$newUsername'";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								$userExists = true;
							} else {
						        // insert values into users db
						        $stmt = $conn->prepare("insert into $datatable(username, password, email, create_datetime)
		values(?, ?, ?, ?)");
								$stmt->bind_param("ssss", $newUsername, $encryptedPassword, $email, $create_datetime);
								if($stmt->execute()) {
									$userCreated = true;
									include('includes/register-submit.php');
								}
								$stmt->close();
							}
					        if ($userCreated) {
					            echo "<div class='widget'>
					                  <h1>You are registered successfully.</h1><br/>
					                  <p class='link'><a href='login'>Click here to Login</a></p>
					                  </div>";
					        } elseif($userExists) {
					        	echo "<div class='widget'>
					                  <h1>User already exists.</h1><br/>
					                  <p class='link'><a href='register'>Click here to try again.</a></p>
					                  </div>";
					        } else {
					            echo "<div class='widget'>
					                  <h1>Required fields are missing.</h1><br/>
					                  <p class='link'><a href='register'>Click here to register again.</a></p>
					                  </div>";
					        }
					    } elseif($_SESSION['userLoggedIn']) {
				        	echo "<div class='form'>
				        		  <h1>You are already logged in.</h1><br />
				        		  <p class='link'><a href='logout'>Click here to log out first.</p>
				        		  </div>";
				        } else {
					?>
						<div class="widget">
							<div class="text-center">
								<h1 class="login-title">Registration</h1>
								<p>Usernames have to be simple, no special characters.</p>
							</div>
							<div class="col-md-6 text-center mx-auto">
							    <form class="form form-group" action="" method="post">
							        <div class="form-group">
								        <input type="text" pattern="[A-Za-z0-9]{2,25}" class="form-control login-input" name="username" placeholder="Username" required />
								    </div>
							        <div class="form-group">
								        <input type="text" class="form-control login-input" name="email" placeholder="Email Adress" required />
								    </div>
							        <div class="form-group">
								        <input type="password" class="form-control login-input" name="password" placeholder="Password" required />
								    </div>
							        <div class="form-group">
								        <input type="submit" name="submit" value="Register" class="btn btn-primary login-button">
								    </div>
							        <p><a href="login.php">Click to Login</a></p>
							    </form>
							</div>
						</div>
					<?php
					    }
					?>
				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>
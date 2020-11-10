<?php 
	include("includes/php-global.php");
	$CURRENT_PAGE = "Login";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Login<?php print $SITE_TITLE;?></title>
</head>
<body id="login">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-login">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<?php
					    require('includes/db.php');
					    // When form submitted, check and create user session.
					    if (isset($_POST['username'])) {
					        $username = stripslashes($_REQUEST['username']);    // removes backslashes
					        $username = mysqli_real_escape_string($conn, $username);
					        $password = stripslashes($_REQUEST['password']);
					        $password = mysqli_real_escape_string($conn, $password);

					        // Check user is exist in the database
					        $query    = "SELECT * FROM users_gym WHERE username='$username'
					                     AND password='" . md5($password) . "'";
					        $result = mysqli_query($conn, $query) or die(mysql_error());
					        $rows = mysqli_num_rows($result);
					        if ($rows == 1) {
					            $_SESSION['username'] = $username;
					            // Redirect to user dashboard page
					            header("Location: /");
					        } else {
					            echo "<div class='widget'>
					                  <h1>Incorrect Username/password.</h1><br/>
					                  <p class='link'><a href='login.php'>Click here to Login again.</a></p>
					                  </div>";
					        }
					    } elseif($_SESSION['userLoggedIn'] == true) {
				        	echo "<div class='widget'>
				        		  <h1>You are already logged in.</h1><br />
				        		  <p class='link'><a href='logout'>Click here to log out first.</p>
				        		  </div>";
				        } else {
					?>
					<div class="widget">
						<div class="col-md-6 text-center mx-auto">
						    <form class="form form-group" action="" method="post">
						        <h1 class="login-title">Login</h1>
						        <div class="form-group">
						        	<input type="text" class="form-control login-input" name="username" placeholder="Username" autofocus="true" required />
						        </div>
						        <div class="form-group">
							        <input type="password" class="form-control login-input" name="password" placeholder="Password" required/>
							    </div>
							    <div class="form-group">
							        <input type="submit" value="Login" name="submit" class="btn btn-primary login-button"/>
							    </div>
						        <p class="link"><a href="register">Create a new account</a></p>
						        <p>Having trouble logging in? <a href="http://dnwebdesigns.com.au/contact" target="_blank">Contact me for assistance.</a></p>
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
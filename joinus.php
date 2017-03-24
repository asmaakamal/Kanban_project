<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	$user_name = mysqli_real_escape_string($link, $_POST['user_name']);
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$password = mysqli_real_escape_string($link, $_POST['password']);
	$cpassword = mysqli_real_escape_string($link, $_POST['cpassword']);

	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$user_name)) {
		$error = true;
		$user_name_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 3) {
		$error = true;
		$password_error = "Password must be minimum of 3 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error) {
		if(mysqli_query($link, "INSERT INTO users(user_name,email,password) VALUES('" . $user_name . "', '" . $email . "', '" . md5($password) . "')")) {
			//$successmsg = "Successfully Registered! <a href='./login.php'>Click here to Login</a>";
			header('Location: login.php');
		} else {
			$errormsg = "Error in registering...Please try again later!";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>A2Team</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="" method="post" name="form">
                <fieldset>
                    <legend>Join Us</legend>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="user_name" placeholder="Enter Full Name" required value="<?php if($error) echo $user_name; ?>" class="form-control">
                        <span class="text-danger"><?php if (isset($user_name_error)) echo $user_name_error; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control">
                        <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Password" required class="form-control">
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Confirm Password</label>
                        <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control">
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="signup" value="Sign Up" class="btn btn-primary">
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        Already Registered? <a href="./login.php">Login Here</a>
        </div>
    </div>
</div>

</body>
</html>

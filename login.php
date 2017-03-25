<?php
include_once './getTasks.php';

if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}


//check if form is submitted
if (isset($_POST['login'])) {

    login($_POST);
	
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>A2Team</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">A2Team</a>
        </div>
      
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="./login.php">Login</a></li>
                <li><a href="./joinus.php">Join Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="" method="post" name="loginform">
                <fieldset>
                    <legend>Login</legend>
                    
                    <div class="form-group">
                        <label for="user_name">Name:</label>
                        <input type="text" name="user_name" placeholder="Your User Name" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary">
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        	<a href="./joinus.php">if you want to join us</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
         <a href="./dashboard.php">Dashboard</a>
        </div>
    </div>
</div>

    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>


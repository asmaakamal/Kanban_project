<?php

include_once "./getTasks.php";


if (! isset ( $_SESSION ["usr_id"] )) {
	header ( "Location: login.php" );
}

if (isset ( $_SESSION ["tasks"] )) {
	$tasks = $_SESSION ["tasks"];
}


if(isset($_POST['add'])){
  $tasks = addTask($_POST["task_title"]);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>A2Team</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	type="text/css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h3>Dashboard</h3>
				<form method="post">
					<label>Task Title</label> 
          <input type="text" name="task_title">
					<button name="add">Create Task</button>
				</form>
				<div class="row">
					<div class="col-md-3 ">
						<div class="panel panel-default panel-primary">
							<div class="panel-heading">To DO</div>
							<div class="panel-body">
            <?php
												
							foreach ( $tasks as $i => $task ) {
								if ($task ['task_status'] == 'todo') {
									?>
  				
				<div class="panel-heading panel-danger"><?php echo $task['task_title']; ?></div>
            <?php }} ?>
          
							</div>
						</div>
					</div>




					<div class="col-md-3 ">
						<div class="panel panel-default panel-primary">
							<div class="panel-heading">Doing</div>
							<div class="panel-body">
            <?php
												
												foreach ( $tasks as $i => $task ) {
													if ($task ['task_status'] == 'doing') {
														?>
  				
				<div class="panel-heading panel-danger"><?php echo $task['task_title']; ?></div>
            <?php }} ?>
          
							</div>
						</div>
					</div>





					<div class="col-md-3 ">
						<div class="panel panel-default panel-primary">
							<div class="panel-heading">Testing</div>
							<div class="panel-body">
            <?php
												
												foreach ( $tasks as $i => $task ) {
													if ($task ['task_status'] == 'testing') {
														?>
  				
				<div class="panel-heading panel-danger"><?php echo $task['task_title']; ?></div>
            <?php }} ?>
          
							</div>
						</div>
					</div>







					<div class="col-md-3 ">
						<div class="panel panel-default panel-primary">
							<div class="panel-heading">Done</div>
							<div class="panel-body">
            <?php
												
												foreach ( $tasks as $i => $task ) {
													if ($task ['task_status'] == 'done') {
														?>
  				
				<div class="panel-heading panel-danger"><?php echo $task['task_title']; ?></div>
            <?php }} ?>
          
							</div>
						</div>
					</div>






				</div>

			</div>
		</div>
	</div>
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	<script type="text/javascript"
		src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
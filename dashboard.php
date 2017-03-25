<?php

include_once "./getTasks.php";


if (!isset ( $_SESSION ["usr_id"] )) {
	header ( "Location: login.php" );
}

if (isset ( $_SESSION ["tasks"] )) {
	$tasks = $_SESSION ["tasks"];
}


if(isset($_POST['add']) && trim($_POST['task_title'])!=""){
  $tasks = addTask($_POST["task_title"]);
}


/* if(isset($_POST['btnX'])){
	$tasks = delete_task($_POST["task_title"]);
} */
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	/* .buttons {
	display: block;
	float: right;
	width: 48%;
	padding: 0 1%;
}
	.inputs {
	
	float: left;
	width: 48%;
	padding: 0 1%;
	clear: both;
} */

</style>
<title>A2Team</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	type="text/css">


</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h3>Dashboard</h3>
				<div class="row">
					<div class="clearfix">
						<form method="post">
							<div class="form-group">
								<label for="task_title">Task Title</label>
			          			<input type="text" name="task_title" class="form-control"><br>
			          			<button name="add" class="btn btn-primary">Create Task</button>
							</div>									
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="panel panel-default panel-primary">
							<div class="panel-heading">To DO</div>
							<div  id="todo" ondrop="drop(event)" ondragover="allowDrop(event)" class="panel-body">
            <?php
												
							foreach ( $tasks as $i => $task ) {
								if ($task ['task_status'] == 'todo') {
									?>
  				
				<div id="<?php echo $task['Task_No']?>" draggable="true"
ondragstart="drag(event)" class="panel panel-body panel-default"><?php echo $task['task_title']; ?></div>
			  <?php }} ?>
            
          
							</div>
						</div>
					</div>
					<div class="col-md-3 ">
						<div class="panel panel-default panel-primary">
							<div class="panel-heading">Doing</div>
							<div  id="doing" ondrop="drop(event)" ondragover="allowDrop(event)" class="panel-body">
            <?php
												
												foreach ( $tasks as $i => $task ) {
													if ($task ['task_status'] == 'doing') {
														?>
  				
				<div class="panel panel-body panel-default" id="<?php echo $task['Task_No']?>" draggable="true" ondragstart="drag(event)" ><?php echo $task['task_title']; ?></div>
				

            <?php }} ?>
          
							</div>
						</div>
					</div>
					<div class="col-md-3 " >
						<div class="panel panel-default panel-primary">
							<div class="panel-heading">Testing</div>
							<div id="testing" ondrop="drop(event)" ondragover="allowDrop(event)"  class="panel-body">
            <?php
												
												foreach ( $tasks as $i => $task ) {
													if ($task ['task_status'] == 'testing') {
														?>
  				
				<div class="panel panel-body panel-default" id="<?php echo $task['Task_No']?>" draggable="true"
ondragstart="drag(event)" ><?php echo $task['task_title']; ?></div>
				
            <?php }} ?>
          
							</div>
						</div>
					</div>
					<div  class="col-md-3 ">
						<div class="panel panel-default panel-primary">
							<div class="panel-heading">Done</div>
							 <div  id="done" ondrop="drop(event)" ondragover="allowDrop(event)" class="panel-body">
							
            <?php
												
												foreach ( $tasks as $i => $task ) {
													if ($task ['task_status'] == 'done') {
														?>
  				
				<div class="panel panel-body panel-default" id="<?php echo $task['Task_No']?>" draggable="true"
ondragstart="drag(event)" ><?php echo $task['task_title']; ?></div>
				
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

<script>
var task_no, task_status;

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    task_no = ev.target.id;
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {

    ev.preventDefault();
    task_status = ev.target.id;
    var data = ev.dataTransfer.getData("text");
  
    $(ev.target).after(document.getElementById(data));
  //  console.log(data ,);
    console.log("Task_no", task_no, "status", task_status);
    
  $.ajax({
    url : "drag.php",
    method : "post",
    data : {"task_no" : task_no, "task_status" : task_status, "drap" : "drag"},
    success : function(data){
      console.log(data);
      data = JSON.parse(data);
      console.log(data);
    },
    error : function (error){
      console.log(error);
      error = JSON.parse(error);
      console.log(error);
    }
  });
    
}

</script>

</body>
</html>
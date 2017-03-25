<?php
session_start();

if(isset($_POST)){

  update_task($_POST["task_no"], $_POST["task_status"]);
  exit;
}


function update_task($taskid, $taskstatus){
	
	$link = mysqli_connect("localhost", "root", "", "project_managment") or die("Error " . mysqli_error($link));
	$taskstatus= mysqli_real_escape_string($link, $taskstatus);
	$user_id = $_SESSION['usr_id'];
	$query = "update user_task set task_status='$taskstatus' where Task_No=$taskid";
	$sql = mysqli_query($link, $query);
	
	if($sql){
	  echo json_encode(true);
      exit;
 	}else{
      echo json_encode(false);
      exit;
  	}
}


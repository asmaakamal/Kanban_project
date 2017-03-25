<?php


session_start();

if(isset($_POST["drag"])){
  echo json_encode("hellp");
  exit;
  update_task($_POST["task_no"], $_POST["task_status"]);
  return;
}



function getTasks(){
	$user_id = $_SESSION["usr_id"];
	$link = mysqli_connect("localhost", "root", "", "project_managment") or die("Error " . mysqli_error($link));
	$query2 = "SELECT * FROM user_task where task_uid=$user_id";
	$sql2 = mysqli_query($link, $query2);
	$tasks=[];
	while($record=mysqli_fetch_assoc($sql2)){
		$tasks[]=$record;
	}

	return $tasks;
}

function addTask($task_title){

	$link = mysqli_connect("localhost", "root", "", "project_managment") or die("Error " . mysqli_error($link));
	$task_title= mysqli_real_escape_string($link, $task_title);
	$user_id = $_SESSION['usr_id'];
	$query = "INSERT INTO user_task(task_title, task_status, task_uid) VALUES('$task_title', 'todo',$user_id)";
	$sql = mysqli_query($link, $query);

	if($sql){
		return getTasks();
	}else{
		return false;
	}
}

function update_task($taskid, $taskstatus){
	
	$link = mysqli_connect("localhost", "root", "", "project_managment") or die("Error " . mysqli_error($link));
	$task_title= mysqli_real_escape_string($link, $task_title);
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





function delete_task($task_title){
	
	$link = mysqli_connect("localhost", "root", "", "project_managment") or die("Error " . mysqli_error($link));
	$task_title= mysqli_real_escape_string($link, $task_title);
	$user_id = $_SESSION['usr_id'];
	$query = "delete Task_No, task_title, task_status, task_uid from user_task where task_title=\"$task_title\" ";
	$sql = mysqli_query($link, $query);
	
	if($sql){
		echo "Task has Deleted";
	}else{
		return false;
	}
}

function login($data){

	$link = mysqli_connect("localhost", "root", "", "project_managment") or die("Error " . mysqli_error($link));
	$user_name = mysqli_real_escape_string($link, $data['user_name']);
	$password = mysqli_real_escape_string($link, $data['password']);
	$result = mysqli_query($link, "SELECT * FROM users WHERE user_name = '" . $user_name. "' and password = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $row['user_name'];
		$_SESSION['tasks'] = getTasks();
		header("Location: dashboard.php");
	} else {
		$errormsg = "Incorrect User Name or Password !";
	}

}

?>
<?php
session_start();


include_once './dbconnect.php';
include_once './functions.php';


$task_title= mysqli_real_escape_string($link, $_POST['task_title']);
//$task_status = mysqli_real_escape_string($link, $_POST['task_status']);

// function create_task(){
	//$result = mysqli_query($link, "SELECT * FROM users WHERE user_name = '" . $user_name. "');
	$user_id = $_SESSION['usr_id'];
	
	$query = "INSERT INTO user_task(task_title, task_status, task_uid) VALUES('$task_title', 'todo',$user_id)";
	$sql = mysqli_query($link, $query);
// }
$query2 = "SELECT * FROM user_task where task_uid='$user_id'";
// $query2 = "SELECT * FROM user_task ";
$sql2 = mysqli_query($link, $query2);
$tasks=[];
while($record=mysqli_fetch_assoc($sql2)){
	$tasks[]=$record;
}
echo '<pre>';
//print_r($tasks);
echo '</pre>';
// exit;
 echo load_view('./dashboard.php', ['tasks' => $tasks]);
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
	<select name="task-status">
		<option value="inprogress">In progress</option>
		<option value="testing">Testing</option>
		<option value="Done">Done</option>
	</select>
</body>
</html>
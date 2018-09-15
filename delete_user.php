<?php

	session_start();


	
	header('Location: http://lab1/');
	
	$servername = "localhost";
$database = "lab1";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
 
	
	
	
 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
	$sql = "DELETE FROM user_info WHERE id=".$id;
	mysqli_query($conn, $sql);
	$sql = "DELETE FROM login_table WHERE id=".$id;
	mysqli_query($conn, $sql);
	var_dump($sql);
}
	
	
	
	
	

?>
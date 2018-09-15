<?php

	session_start();


	
	header('Location: http://lab1/');
	
	$servername = "localhost";
$database = "lab1";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
 
	if (isset($_POST['save'])) {
    print_r($_POST);
    echo $_SESSION['change_id']."<br>";
	$login=$_POST['login'];
	$name=$_POST['name'];
	$surname=$_POST['surname'];
	$password=$_POST['password'];
	$role=$_POST['role'];
	$sql = "INSERT INTO user_info (first_name, last_name, role) VALUES ('".$name."','". $surname."','".$role."')";
mysqli_query($conn, $sql);
	$sql = "INSERT INTO login_table (login, password) VALUES ('".$login."','". $password."')";

mysqli_query($conn, $sql);
	var_dump($sql);
	//mysqli_query($conn, $sql);
	if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
	} else {
    echo "Error updating record: " . mysqli_error($conn);
	}
	}
	
	
 
if (isset($_POST['edit'])) {
    $id = 555;
    $name = 'vasyaaa1234';
	print_r($_POST);
    //mysqli_query("UPDATE user_info SET id = $id, first_name = $name WHERE id = 6");
		echo"123456\n";
				echo $_SESSION['change_id']."<br>";

	//$sql = "UPDATE user_info SET first_name = "."'".$name."'";
	$sql = "UPDATE user_info SET ";
	if (isset($_POST['name'])) 
		$sql =$sql. "first_name = "."'".$_POST['name']."'";
	if (isset($_POST['surname'])) 
		$sql =$sql. ",last_name = "."'".$_POST['surname']."'";
	if (isset($_POST['role'])) 
		$sql= $sql.",role = "."'".$_POST['role']."'";
	$sql = $sql." WHERE id =". $_SESSION['change_id'] ;
		
	var_dump($sql);
	//mysqli_query($conn, $sql);
	if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
	} else {
    echo "Error updating record: " . mysqli_error($conn);
	}
	}
	
	
	
	
	

?>
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
		
		if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
	{
    $name_img = $_FILES['filename']['name'];
    move_uploaded_file($_FILES['filename']['tmp_name'], $name_img);
    echo "Файл загружен";
	echo " $name_img";
	}
	
    print_r($_POST);
    echo $_SESSION['change_id']."<br>";
	$login=$_POST['login'];
	$name=$_POST['name'];
	$surname=$_POST['surname'];
	$password=$_POST['password'];
	$role=$_POST['role'];
	$sql = "INSERT INTO user_info (first_name, last_name, role, photo) VALUES ('".$name."','". $surname."','".$role."','".$name_img."')";
	mysqli_query($conn, $sql);
	$sql = "INSERT INTO login_table (login, password) VALUES ('".$login."','". $password."')";

	mysqli_query($conn, $sql);
	var_dump($sql);
	//mysqli_query($conn, $sql);

	}
	
	
 
if (isset($_POST['edit'])) {
    print_r($_POST);
    echo $_SESSION['change_id']."<br>";

	if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
	{
    $name_img = $_FILES['filename']['name'];
    move_uploaded_file($_FILES['filename']['tmp_name'], $name_img);
    echo "Файл загружен";
	echo " $name_img";
	}
	$sql = "UPDATE user_info SET ";
	if (isset($_POST['name'])) 
		$sql =$sql. "first_name = "."'".$_POST['name']."'";
	if (isset($_POST['surname'])) 
		$sql =$sql. ",last_name = "."'".$_POST['surname']."'";
	if (isset($name_img)) 
		$sql =$sql. ",photo = "."'".$name_img."'";
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
	
	
	
	$sql = "UPDATE login_table SET ";
	if (isset($_POST['login'])) 
		$sql =$sql. "login = "."'".$_POST['login']."'";
	if (isset($_POST['password'])) 
		$sql= $sql.",password = "."'".$_POST['password']."'";
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
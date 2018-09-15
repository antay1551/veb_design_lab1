<?php
	session_start();
	//setcookie('login', '', time() - 60, '/');
	session_destroy();
	//$_SESSION["login"]=NULL;
	//print_r($_SESSION);
	//unset($_SESSION["login"]);
	header('Location: http://lab1/');


?>
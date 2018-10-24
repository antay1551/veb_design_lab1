<?php  
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
       <title>Форма и progressive enhancement</title>
	   	<meta charset="UTF-8">
		<link href = "main.css" rel="stylesheet" type="text/css"/>
        <script src="js/login.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>
    <body>
        <form class="login" >
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" />
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" />
			<input type="button" id="submit" value="Submit" onclick="loginFunction()"/>
            <?php
				if( $_SESSION['not_right_login']!='ok' ){
					print($_SESSION['not_right_login']);
				}
				//print_r($_SESSION);
			?>
		</form>
    </body>
</html>
<?php  
	session_start();
?>

<!DOCTYPE html>
<html>
    <head>
       <title>Форма и progressive enhancement</title>
	   	<meta charset="UTF-8">
		<link href = "main.css" rel="stylesheet" type="text/css"/>
	</head>
    <body>
        <form class="login" method="post" action="connection_user.php">
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" />
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" />
			<input type="submit" value="Войти" />
			<?php  
				if( $_SESSION['not_right_login']!='ok' ){
					print($_SESSION['not_right_login']);
				}
				//print_r($_SESSION);
			?>
		</form>
    </body>
</html>
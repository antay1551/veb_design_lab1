<?php


	class sessionClass {
    
		public function add($login, $role){
			setcookie ("Test", '123456789');
											echo $_COOKIE["Test"];

			//session_start();
			//$_SESSION['role1'] = 'qwefhihi';		
		}

    
    }
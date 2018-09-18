<?php
	session_start();


?>
<?php



abstract class Getter {
		public function __get($id){
			return($this->$id);
		}
	}
	
	
	class ConnectionClass extends Getter{
		public $db;
		public $login;
		public $password;
		public $id;
		
		function __construct( $login_in_constract, $password_in_constract ){
			$this->db = mysqli_connect('localhost', 'root', '', 'lab1');
			$this->login = $login_in_constract;
			$this->password = $password_in_constract;
			
			$this->set_login( $this->login );
			$this->set_password( $this->password );
			
		}
				
		public function set_login( $login ){
			//если логин введен, то обрабатываем, чтобы теги и скрипты не работали, мало ли что люди могут ввести
			$this->login = stripslashes($login);
			$this->login = htmlspecialchars($this->login);
			
			//удаляем лишние пробелы
			$this->login = trim($this->login);
		}
		
		public function set_password( $password ){
			//если логин введен, то обрабатываем, чтобы теги и скрипты не работали, мало ли что люди могут ввести
			$this->password = stripslashes($password);
			$this->password = htmlspecialchars($this->password);
			
			//удаляем лишние пробелы
			$this->password = trim($this->password);
		}
		public function set_id( $id_from_class ){
			$this->id =  $id_from_class;
		}
		public function get_db(){  
			return($this->db);
		}
				
		public function get_login( ){
			return ($this->login);
		}
		
		
		public function get_password( ){
			return ($this->password);
		}
		
		function connect(){
		
		//что бы было удобнее работать со значением
		$log=$this->login;
		$pas=$this->password;
		
		$result = mysqli_query($this->db,"SELECT id FROM login_table WHERE login='$log' and password='$pas' ");
		$myrow = mysqli_fetch_array($result);
		
		//если мы нашли юзера с таким логином и паролем то сохраняеи в переменную ид
			if (!empty($myrow['id'])) {
				$this->set_id( $myrow['id'] );
			}
		
		}
		
	}

	
	class selectLoginUser {

    static public $con;
   function __construct(  ){
        self::$con = Connection::get_instance()->dbh;
    }

    static public function get_login($id){
        $records = [];
        $res = self::$con->query("SELECT * FROM login_table WHERE id='$id'");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)){
            $records[] = $row;
        }
        return $records;
    }
	static public function get_all($id){
        $records = [];
        $res = self::$con->query("SELECT * FROM user_info WHERE id='$id'");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)){
            $records[] = $row;
        }
        return $records;
    }

}

	
	
	
	
	if( ! isset($_SESSION['login'])){
		if (isset($_POST['login']) && isset($_POST['password'] )) { 
			$obj_class_Connection =  new ConnectionClass( $_POST['login'],  $_POST['password'] );
		}else{
			header('Location: http://lab1/login.php');
		}
		
		$obj_class_Connection->connect();
		
		
			$id_users = $obj_class_Connection->id;
			$db_from_class = $obj_class_Connection->get_db();
			$result = mysqli_query($db_from_class,"SELECT * FROM login_table WHERE id='$id_users'");
			$result_user_info = mysqli_query($db_from_class,"SELECT * FROM user_info WHERE id='$id_users'");
			
			$row = mysqli_fetch_row($result);
			$row_user_info = mysqli_fetch_row($result_user_info);
			//массив со значениями о пользователе ид имя фам и тд
			//print_r($row);
			//print_r($row_user_info);
			if((! isset($row)) || ((! isset($row_user_info)))){
				header('Location: http://lab1/login.php');
				$_SESSION['not_right_login']='not right password or email';
			}else {
				$_SESSION['not_right_login']='ok';
			}
			//require_once 'session1.php';
			//$obj_class_session = new sessionClass();
			//$obj_class_session->add($row_user_info[1],$row_user_info[2]);

			$_SESSION['login'] = $row[1];
			$_SESSION['role'] = $row_user_info[3];
			$_SESSION['id'] = $row_user_info[0];
			$_SESSION['change_id'] = $row[0];

			//echo $_SESSION['login']."<br>";
			//echo $_SESSION['role']."<br>";
			//echo $_SESSION['id']."<br>";
			//echo $_SESSION['change_id']."<br>";


			
			
			$user_name = $row_user_info[1];
			$user_last_name = $row_user_info[2];
			$user_login = $row[1];

			//нужно для того что-бы вывести картинку в html
			$img_adress = $row_user_info[4];
			
			}else {
				$res_selectLogin=[];
				$res_selectInfo=[];
				
				if ( ! isset($_GET['id']) ){
				require_once 'connection.php';
				$id = $_SESSION['id'];
				$obj_selectLoginUser= new selectLoginUser();
				$res_selectLogin=$obj_selectLoginUser->get_login($id);
				$res_selectInfo=$obj_selectLoginUser->get_all($id);
						
				}else{
				$id = $_GET['id'];
				//echo"$id";
				require_once 'connection.php';
				$obj_selectLoginUser= new selectLoginUser();
				$res_selectLogin=$obj_selectLoginUser->get_login($id);
				$res_selectInfo=$obj_selectLoginUser->get_all($id);
				}
				$user_name = $res_selectInfo[0]['first_name'];
				$user_last_name = $res_selectInfo[0]['last_name'];
				$user_login = $res_selectLogin[0]['login'];
				$img_adress = $res_selectInfo[0]['photo'];
				$_SESSION['change_id'] = $res_selectInfo[0]['id'];
				//echo $_SESSION['change_id']."<br>";

				//echo"$user_name";
				//echo"some";
				//$user_last_name = $res_selectInfo[2];
				//$user_login = $res_selectLogin[1];

			//нужно для того что-бы вывести картинку в html
			//$img_adress = $row_user_info[4];
				
				//print_r($res_selectLogin);
				//print_r($res_selectInfo);
			
			}
			?>
			
			
			
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="UTF-8">
    
  <title>address ::: user office ::: foodclub</title>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
  <link href="css/default.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/send.js"></script>

</head>

<body  onload="load()">
<script>
    //location.reload();
</script>
	<div class="cbc">
		<div class="main">
			<header>
			
				<div class="center_box">
				<a href="login.html">Login</a>
				<a href="index.html">Home page</a>
					<div class="wrapper">
						<div class="logo_box">
							<a href="index.html"><img src="img/logo.png" alt="foodclub" /></a>
						</div>
						
						<div class="lng_box">
							<a href="#" class="flag_ar"></a>
						</div>
						
						
						<div class="orders_counter">
							<span class="num">2<span class="line"></span></span>
							<span class="num">1<span class="line"></span></span>
							<span class="num">7<span class="line"></span></span>
							<span class="num">0<span class="line"></span></span>
							
							<span class="label">orders<br/>today</span>
						</div>
						
						<div class="r_box">
							<a href="tel:8800117117" class="h_phone"><span class="ico"></span><span>800 117-117</span></a>
							
							<div class="upan">
								<div class="notice">
									<a href="#" class="ico_notice nftoggle"></a>
									
									<nav class="utnav">
										<ul>
											<li class="item">
												<span class="ico ico_1"></span>
												<div class="text_box">
													<h3>5 points</h3>
													<p>Thank you for visiting FoodClub.<br/>You got 5 more points on your balance!</p>
												</div>
												<a href="#" class="gcross"></a>
											</li>
											<li class="item">
												<span class="ico ico_2"></span>
												<div class="text_box">
													<h3>5 points</h3>
													<p>Thank you for visiting FoodClub.<br/>You got 5 more points on your balance!</p>
												</div>
												<a href="#" class="gcross"></a>
											</li>
											<li class="item">
												<span class="ico ico_3"></span>
												<div class="text_box">
													<h3>5 points</h3>
													<p>Thank you for visiting FoodClub.<br/>You got 5 more points on your balance!</p>
												</div>
												<a href="#" class="gcross"></a>
											</li>
											<li><a href="#" class="more">Show more notifications</a></li>
										</ul>
									</nav>
								</div>
								<div class="navbox">
									<a href="#" class="midbox nftoggle">
										<img src="imgc/user_ava_1_40.jpg" alt="" />
										<span class="warrd"></span>
									</a>
									<nav class="utnav">
										<ul>
											<li class="points">600 points</li>
											<li class="sepor"></li>
											<li><a href="#">Profile</a></li>
											<li><a href="#">Orders</a></li>
											<li><a href="#">Address</a></li>
											<li><a href="#">Settings</a></li>
											<li class="sepor"></li>
											<li><a href="#" class="logout">Log Out</a></li>
										</ul>
									</nav>
									

								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</header>
			
			<div class="center_box cb">
				<div class="uo_tabs cf">
					<a href="#"><span>profile</a>
					<a href="#"><span>Reviews</span></a>
					<a href="#"><span>orders</span></a>
					<a href="#" class="active"><span>My Address</span></a>
					<a href="#"><span>Settings</span></a>
				</div>
				<div class="page_content bg_gray">
					<div class="uo_header">
						<div class="wrapper cf">
							<div class="wbox ava">
								<figure><img src="<?php echo"$img_adress";?>" alt="Helena Afrassiabi" /></figure>
							</div>
							<div class="main_info">
								<h1>Helena Afrassiabi</h1>
								<div class="midbox">
									<h4>560 points</h4>
									<div class="info_nav">
										<a href="#">Get Free Points</a>
										<span class="sepor"></span>
										<a href="#">Win iPad</a>
									</div>
								</div>
								<div class="stat">
									<div class="item">
										<div class="num">30</div>
										<div class="title">total orders</div>
									</div>
									<div class="item">
										<div class="num">14</div>
										<div class="title">total reviews</div>
									</div>
									<div class="item">
										<div class="num">0</div>
										<div class="title">total gifts</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="uo_body">
						<div class="wrapper">
							<div class="uofb cf">
								<div class="l_col adrs">
									<h2>Add New Address</h2>
									
									<form action="change.php" method="post" enctype='multipart/form-data'>
										<div class="field">
											<label>Login *</label>
											<input type="text" id="login" name="login" value="<?php echo"$user_login";?>" palceholder="" class="vl_empty" />
										</div>
										<div class="field">
											<label>Name *</label>
											<input type="text" id="name" name="name" value="<?php echo"$user_name";?>" palceholder="" class="vl_empty" />
										</div>
										<div class="field">
											<label>Surname *</label>
											<input type="text" id="surname" name="surname" value="<?php echo"$user_last_name";?>" palceholder="" class="vl_empty" />
										</div>
										<div class="field">
											<label>Password *</label>
											<input type="text" id="password" name="password" value="" palceholder="" class="vl_empty" />
										</div>
										<div class="field">
											<label>report Password *</label>
											<input type="text"  name="report_password" value="" palceholder="" class="vl_empty" />
										</div>
										<div class="field">
											<label>Role *</label>
											<select class="vl_empty"  id="role" name="role"  value="admin">
												<option class="plh"></option>
												<option value="admin">admin</option>
												<option value="user">user</option>
											</select>
										</div>
										Выберите файл: <input type='file' name='filename' size='10' /><br /><br />							
										<div class="field">
											<input type="submit" name = "edit" value="add address" class="green_btn" />
										</div>
									</form>
								</div>

                                <div class="r_col">
                                    <h2>My Addresses</h2>
                                    
                                </div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<footer>
			<div class="center_box">
				<div class="wrapper">
					
					<nav class="f_nav">
						<ul>
							<li>
								<a href="#">
									<span class="fadv_ico"><span class="ico_1"></span></span>
									<span class="title">Rewards Program</span>
									<span class="descr">We’re empowering businesses and teams to put Design first by helping them roll up their sleeves and apply customer-centric product.</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="fadv_ico"><span class="ico_2"></span></span>
									<span class="title">monthly lottery</span>
									<span class="descr">We’re empowering businesses and teams to put Design first by helping them roll up their sleeves and apply customer-centric product.</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="fadv_ico"><span class="ico_3"></span></span>
									<span class="title">Restaurant Owners</span>
									<span class="descr">We’re empowering businesses and teams to put Design first by helping them roll up their sleeves and apply customer-centric product.</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="fadv_ico"><span class="ico_4"></span></span>
									<span class="title">about foodclub</span>
									<span class="descr">We’re empowering businesses and teams to put Design first by helping them roll up their sleeves and apply customer-centric product.</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<div class="bt_box">
				<div class="center_box">
					<div class="wrapper">
						<div class="soc_link">
							<a href="#" class="apple"></a>
							<a href="#" class="android"></a>
							<a href="#" class="email"></a>
							<a href="#" class="fb"></a>
						</div>
						<div class="copyright">
							<div>© 2014 Zomlex Inc. All rights reserved.</div>
							<nav>
								<a href="#">Partner Agreement</a>
								<span>|</span>
								<a href="#">User Agreement</a>
								<span>|</span>
								<a href="#">FAQ</a>
								<span>|</span>
								<a href="#">Careers</a>
							</nav> 
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
</body>

</html>
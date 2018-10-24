<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">

    <title>address ::: user office ::: foodclub</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic&subset=latin,latin-ext'
          rel='stylesheet' type='text/css'>
    <link href="css/default.css" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/send.js"></script>
    <script src="js/sort.js"></script>
</head>

<body onload="load()">
<script>
    //location.reload();
</script>
<div class="cbc">
    <div class="main">
        <header>

            <div class="center_box">
                <a href="login.php">Login</a>
                <a href="logout.php">Log out</a>

                <div class="wrapper">


                    <div class="logo_box">
                        <a href="index.html"><img src="img/logo.png" alt="foodclub"/></a>
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
                                                <p>Thank you for visiting FoodClub.<br/>You got 5 more points on your
                                                    balance!</p>
                                            </div>
                                            <a href="#" class="gcross"></a>
                                        </li>
                                        <li class="item">
                                            <span class="ico ico_2"></span>
                                            <div class="text_box">
                                                <h3>5 points</h3>
                                                <p>Thank you for visiting FoodClub.<br/>You got 5 more points on your
                                                    balance!</p>
                                            </div>
                                            <a href="#" class="gcross"></a>
                                        </li>
                                        <li class="item">
                                            <span class="ico ico_3"></span>
                                            <div class="text_box">
                                                <h3>5 points</h3>
                                                <p>Thank you for visiting FoodClub.<br/>You got 5 more points on your
                                                    balance!</p>
                                            </div>
                                            <a href="#" class="gcross"></a>
                                        </li>
                                        <li><a href="#" class="more">Show more notifications</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="navbox">
                                <a href="#" class="midbox nftoggle">
                                    <img src="imgc/user_ava_1_40.jpg" alt=""/>
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


                <div class="uo_body">
                    <div class="wrapper">
                        <div class="uofb cf">
                            <form action="" method="post"  >
                                <div class="field">
                                    <input type="text" id="find" name="find" value="" palceholder="" class="vl_empty" />
                                </div>
                                    <div class="field">
                                        <input type="submit" name = "save" value="find" class="green_btn" />
                                    </div>
                            </form>
                            <form action="index.php" method="post"  >
                                <div class="field">
                                    <input type="submit" name = "sort" value="sort" id ="sort" class="green_btn"  />
                                </div>
                            </form>



                            <?php
                            require_once 'connection.php';

                            if ($_POST['find']!=''){
                                //print_r(selectUser::get_all_like($_POST['find']));
                                //require 'connection.php';
                                $obj_selectUserLike = new selectUser();
                                $res_select = $obj_selectUserLike->get_all_like($_POST['find']);
                                //print_r($res_select);
                                ?>
                                 <table border="1">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>name</th>
                                    <th>surname</th>
                                    <th>role</th>
                                    <th>photo</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                for ($i = 0; $i < count($res_select); $i++) {
                                    $id = $res_select[$i]['id'];
                                    $all_str = '<tr>  <td>' . $res_select[$i]['id'] .'</td><td>' . $res_select[$i]['first_name'] . ' </td> <td> ' . $res_select[$i]['last_name'] . ' </td> <td> ' . $res_select[$i]['role'] . ' </td> <td> ' . '<img src=' . $res_select[$i]['photo'] . ' width=100 height=150/>  </td>';
                                    echo "$all_str" . "<br>";

                                }
                                ?>
                            </tbody>

                               <?php



                            }
                            ?>
                            <?php

                            class selectUser
                            {
                                static public $con;

                                function __construct()
                                {
                                    self::$con = Connection::get_instance()->dbh;
                                }

                                static public function get_all()
                                {
                                    $records = [];
                                    if(!isset($_SESSION['count'])) {
                                        $_SESSION['count'] = 0;
                                    }
                                    if(isset($_POST['sort'])){
                                        $_SESSION['count'] ++;
                                        if ($_SESSION['count'] % 2 == 0 ) {
                                            $res = self::$con->query("SELECT * FROM user_info order by id ASC ");
                                        }else{
                                            $res = self::$con->query("SELECT * FROM user_info order by id DESC ");
                                        }
                                    }else {
                                        $res = self::$con->query("SELECT * FROM user_info");
                                    }
                                    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                        $records[] = $row;
                                    }
                                    return $records;
                                }

                                static public function get_all_like($name)
                                {
                                    $records = [];
                                    $res = self::$con->query("SELECT * FROM user_info where first_name like'". "%$name%'");
                                    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                                        $records[] = $row;
                                    }
                                    return $records;
                                }

                            }

                            require_once 'connection.php';
                            $obj_selectUser = new selectUser();
                            $res_select = $obj_selectUser->get_all();
                            print($_POST['sort']);

                            ?>
                            <table border="1">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>name</th>
                                    <th>surname</th>
                                    <th>role</th>
                                    <th>photo</th>
                                    <th>delete user</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                            if ($_SESSION['role'] == 'admin') {
                                for ($i = 0; $i < count($res_select); $i++) {
                                    $id = $res_select[$i]['id'];
                                    $all_str = '<tr>  <td><a href="connection_user.php?id=' . $id . '">' . $res_select[$i]['id'] .'</a> '.'</td><td>' . $res_select[$i]['first_name'] . ' </td> <td> ' . $res_select[$i]['last_name'] . ' </td> <td> ' . $res_select[$i]['role'] . ' </td> <td> ' . '<img src=' . $res_select[$i]['photo'] . ' width=100 height=150/>  </td>';
                                    $all_str = $all_str . ' <td><a href="delete_user.php?id=' . $id . '">delete</a>  </td></tr>';
                                    //var_dump($all_str);
                                    echo "$all_str" . "<br>";

                                }
                                ?>
                                </tbody>
                                    <form action="insertnew.php" method="post">
                                    <input type="submit" value="add new" class="green_btn"></form>
                                <?php
                            } else {

                            //<tr></tr>
                                ?>
                            <table border="1">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>name</th>
                                    <th>surname</th>
                                    <th>role</th>
                                    <th>photo</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                for ($i = 0; $i < count($res_select); $i++) {
                                    if ($res_select[$i]['id'] == $_SESSION['change_id']) {
                                         $all_str =  '<tr> <td> <a href="connection_user.php?id=' . $_SESSION['change_id'] . '">' . $res_select[$i]['id'] . '</a> . ' .'</td> <td>'. $res_select[$i]['first_name'] . ' </td><td>' . $res_select[$i]['last_name'] . '</td><td>' . $res_select[$i]['role'] . '</td><td>' .  '<img src=' . $res_select[$i]['photo'] . ' width=100 height=150/> </td></tr>';
                                    } else {
                                        $all_str = '<tr> <td>' . $res_select[$i]['id'] . '</td> <td>' . $res_select[$i]['first_name'] . '</td> <td>' . $res_select[$i]['last_name'] . '</td> <td> ' . $res_select[$i]['role'] . '</td>  <td>' . '<img src=' . $res_select[$i]['photo'] . ' width=100 height=150/> </td></tr>';
// . '<img src=' . $res_select[$i]['photo']
                                    }
                                    $resultOutput = $all_str;
                                    echo "$resultOutput <br>";
                                }
                                ?>
                                </tbody>
                            <?php
                            }
                            ?>
                            </table>
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

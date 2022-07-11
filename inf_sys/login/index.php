<?php
require_once("../main/classes.php");
$UpdateUpgrade = new UpdateUpgrade();
$agent = new AgentAccountData(1);
$UpdateBalances = new UpdateBalances(1);
new RunUpdateBalances();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>INFINITY|LOGIN</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="INFINITY GLOBAL PARTNERS is a company  founded in 2019 in Rwanda with the aim of becoming the number 1 distribution channel to connect Rwanda and the rest of the world through the innovative and creative system.">
<meta name="keywords" content="Best Services,Good Product,Wealth,Network Marketing,Direct Selling,Made in Rwanda, channel to connet Rwanda to the Whole World,Innovation,Login">
<meta name="robots" content="index, follow">
<meta name="copyright" content="INFINITY GLOBAL PARTNERS LTD">
<link rel="shortcut icon" href="../img/final_logo.png" type="ximage/x-icon" />
<link rel="stylesheet" type="text/css" href="../assests/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assests/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assests/fonts/iconic/css/material-design-iconic-font.min.css">
<link rel="stylesheet" type="text/css" href="../assests/animate/animate.css">
<link rel="stylesheet" type="text/css" href="../assests/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="../assests/animsition/css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="../assests/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="../assests/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="../assests/css/util.css">
<link rel="stylesheet" type="text/css" href="../assests/css/main.css">
</head>
<body>
	<div class="limiter">
<div class="container-login100" style="background-image:url('../img/background1.jpg');">
<img src="../img/final_logo_blue.png" style="width:300px;height:90px;" class="imglogoxx"><br>
<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54" style="background-image:url('images/bg-01.jpg');">
                <form class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
	<p id="resp_n"></p><span id="resp"></span>
					</span>
<div class="wrap-input100 validate-input m-b-23" data-validate = "Invalid Username">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" id="username" valid="names" name="uname" placeholder="Type your username ,ex:infinity!134">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

				<div class="wrap-input100 validate-input" data-validate="Invalid Password">
			<span class="label-input100">Password</span>
	<input class="input100" type="password" id="pass" valid="password" name="upass" placeholder="Type your password">
			<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="p-t-8 p-b-31">
<a href="#">Forgot password?</a> |
<a class="ahref-link" href="Sign-up">Register</a>
					</div>


					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
		<button class="login100-form-btn" id="button-login">Login</button>
						</div>
					</div>

					<div class="text-center p-t-13 p-b-31">
		<a href="../../homepage">Visit our website</a> |
		<a href="#">Privacy policy</a>
					</div>
</form>
			</div>
		</div>

	</div>

		 <div style="height:50px;width:100%;background:white;padding:10px;" class="footer-h">
<center><p> Copyright &copy;2019 Infinity Global Partners Ltd. All Rights Reserved</p></center>
		 </div>


<script src="../assests/jquery/jquery-3.2.1.min.js"></script>
<script src="../assests/animsition/js/animsition.min.js"></script>
<script src="../assests/bootstrap/js/popper.js"></script>
<script src="../assests/bootstrap/js/bootstrap.min.js"></script>
<script src="../assests/select2/select2.min.js"></script>
<script src="../assests/daterangepicker/moment.min.js"></script>
<script src="../assests/daterangepicker/daterangepicker.js"></script>
<script src="../assests/countdowntime/countdowntime.js"></script>
<script src="../assests/js/main.js"></script>
</body>
</html>

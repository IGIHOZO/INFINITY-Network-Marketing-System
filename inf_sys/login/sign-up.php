<!DOCTYPE html>
<html lang="en">
<head>
<title>INFINITY|Sign Up</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../img/final_logo.png" type="ximage/x-icon" />
<link rel="stylesheet" type="text/css" href="../assests/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assests/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../assests/fonts/iconic/css/material-design-iconic-font.min.css">
<link rel="stylesheet" type="text/css" href="../assests/animate/animate.css">
<link rel="stylesheet" type="text/css" href="../assests/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="../assests/animsition/css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="../assests/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="../assests/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="../assests/datepicker/datepicker3.css">
<link rel="stylesheet" type="text/css" href="../assests/css/util.css">
<link rel="stylesheet" type="text/css" href="../assests/css/main.css">
</head>
<body>
	<div class="limiter"><!-- style="background-image:url('images/bg-01.jpg');" -->
		<div class="container-login100"  style="background-image:url('../img/background1.jpg');" >
			<div class="error-label3" style="">
				<p class="error-p-title">Confirm Registration</p>
				<p class="repon"></p>
				<span style="" class="flex-cont">
			 <span class="display-first">
				<button class='btn btn-success btnss' id='confirm-this'>Confirm</button>&nbsp;
				<button class='btn btn-danger btnss' id='cancel-this'>Cancel</button></span>
		    <span class="display-before">
				<a href="login" class='btn btn-success btnss'>Login</a>&nbsp;
<a href="Sign-up"  class='btn btn-danger btnss' id='new-memberse'>Add Another</a></span>
				</span>
				</div>
			<img src="../img/final_logo_blue.png" style="height:80px;width:300px;" class="imglogoxx"><br>

			<div class="wrap-signup p-l-55 p-r-55 p-t-10 p-b-54">

	<form class="login100-form validate-form-sign" SignUp="form-1" id="sign-up-form" action="javascript:;">
		<span class="login100-form-title p-b-20"> CREATE AN ACCOUNT
						<hr>

<p class="error-label2" style="display:none;"></p>
					</span>

 <span style="" class="flex-cont">
 	<div class="wrap-input100 validate-input" data-validate="Invalid Firstname">
	<span class="label-input100">Firstname</span>
<input class="input100" type="text" maxlength="50" name="d_fname" valid="fname" placeholder="Type your new  Firstname here">
<span class="focus-input100" data-symbol="&#xf1a6;"></span>
    </div>
		<div class="wrap-input100 validate-input" data-validate="Invalid Lastname" style="display:block;"><span class="label-input100">Lastname</span>
<input class="input100" type="text" maxlength="50" valid="fname" name="d_lname" placeholder="Type your Lastname here" valid="fname">
		<span class="focus-input100" data-symbol="&#xf1a6;"></span>
		</div>
 </span>

 <span style="" class="flex-cont">
 <div class="wrap-input100 validate-input" data-validate="choose Gender" style="display:block;">
	<span class="label-input100">Gender</span>
	<select class="input100"   name="d_gender">
					<option value="">---Choose Gender---</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
			<span class="focus-input100" data-symbol="&#xf254;"></span>
					</div>
</span>



<div class="form-group data-custon-pick wrap-input100 validate-input" data-validate="invalid date of birth" id="data_3" style="display:;">
  <label class="label-input100">Date of birth</label>
  <div class="input-group date">
  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
  <input type="text" valid="dob" maxlength="15"  placeholder="Select date of birth" class="input100" id="dob-house" name="d_dob" autocomplete="off">
  </div>
  </div>

  <div class="wrap-input100 validate-input" style="display:" data-validate="Invalid National ID">
				<span class="label-input100">National ID</span>
	<input class="input100" type="text" maxlength="25" valid="rwanda-id" name="d_nid" placeholder="Type here the correct national ID Number">
		<span class="focus-input100" data-symbol="&#xf162;"></span>
    </div>


 <span style="" class="flex-cont">
<div class="wrap-input100 validate-input m-b-1" data-validate="Invalid Pincode">
<span class="label-input100">Your Pincode</span>
<input class="input100" type="text" maxlength="10" valid="names" name="d_pin" placeholder="Type your Pincode here">
		<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

<div class="wrap-input100 validate-input" data-validate="Invalid Pincode">
<span class="label-input100">Upline Pincode</span>
<input class="input100" type="text" maxlength="10" valid="names" name="d_upline" placeholder="Type your Upline Pincode here"><span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
	</span>
	 <span style="" class="flex-cont">

<div class="wrap-input100 validate-input" data-validate="Invalid Pincode">
<span class="label-input100">Sponsor Pincode</span>
<input class="input100" type="text" maxlength="10" valid="names" name="d_sponsor" placeholder="Type your Sponsor Pincode here"><span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

<div class="wrap-input100 validate-input" data-validate="Invalid Pincode">
<span class="label-input100">Your upline Side</span>
		<select class="input100"  name="d_side">
		<option value="">---Choose Side---</option>
		<option value="Left">Left</option>
		<option value="Right">Right</option>
	</select>
<span class="focus-input100" data-symbol="&#xf2f0;"></span>
					</div>
                  </span>

                   <span style="" class="flex-cont">

<div class="wrap-input100 validate-input" data-validate="Invalid Country" style="display:block;">
			<span class="label-input100">Country</span>
	<select class="input100"  id="countries" name="d_cntry">
					<option value="">---Choose Country---</option>
				</select>
			<span class="focus-input100" data-symbol="&#xf162;"></span>
					</div>


<div class="wrap-input100 validate-input" data-validate="Invalid City">
	<span class="label-input100">City,Address</span>
<input class="input100" type="text" maxlength="50" valid="names" name="d_city" placeholder="Type your city or adress here">
<span class="focus-input100" data-symbol="&#xf299;"></span>
					</div>
</span>

	

 <span style="" class="flex-cont">
<div class="wrap-input100 validate-input" data-validate="Invalid new Password format">
	<span class="label-input100">New Password</span>
<input class="input100" id="confirmpwd" maxlength="32" type="password" valid="password" name="pwordx" placeholder="Type your new password here"><span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

<div class="wrap-input100 validate-input" data-validate="New password is invalid">
	<span class="label-input100">Confirm New Password</span>
<input class="input100" type="password" maxlength="32" confirmPw="#confirmpwd" valid="confirm-password" name="d_upass" placeholder="Type confirmed your password here">
<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
		</span>


<div class="wrap-input100 validate-input" data-validate="Invalid Email">
	<span class="label-input100">Email</span>
<input class="input100" type="text" maxlength="70" valid="email" name="d_email" placeholder="Type valid email address">
	<span class="focus-input100" data-symbol="&#xf15a;"></span>
		</div>



					<div class="p-t-8 p-b-31">
				<a href="#">Lost your Pincode?</a> |
			<a class="ahref-link" href="login" style="color:black;">Login</a>
					</div>


					<div class="container-login100-form-btn">
						<span id="resp_n"></span>
						<span id="resp_y"></span>
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
		<button class="login100-form-btn" id="signUpClick">Sign Up</button>
						</div>
					</div>

					<div class="text-center p-t-13 p-b-31">
		<a href="../../homepage">Visit our website</a> |
		<a href="#">Privacy policy</a>
					</div>
				</form>
			</div>
<div style="height:50px;width:100%;background:white;padding:10px;margin-top:50px;" class="footer-h">
<center><p>Copyright &copy;2019 INFINITY  GLOBAL PARTNERS LTD. All Rights Reserved</p></center>
			</div>
		</div>
	</div>








<script src="../assests/jquery/jquery-3.2.1.min.js"></script>
<script src="../assests/animsition/js/animsition.min.js"></script>
<script src="../assests/bootstrap/js/popper.js"></script>
<script src="../assests/bootstrap/js/bootstrap.min.js"></script>
<script src="../assests/select2/select2.min.js"></script>
<script src="../assests/daterangepicker/moment.min.js"></script>
<script src="../assests/daterangepicker/daterangepicker.js"></script>
<script src="../assests/datepicker/bootstrap-datepicker.js"></script>
<script src="../assests/datepicker/datepicker-active.js"></script>
<script src="../assests/countdowntime/countdowntime.js"></script>
<script src="../assests/js/main.js"></script>
</body>
</html>

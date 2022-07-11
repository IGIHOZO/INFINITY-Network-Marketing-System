<?php
require_once("../main/classes.php");
require_once("sessions.php");
ver_session();
$agent = new AgentAccountData($my_acount_id);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agent|Change Password</title>
<link rel="shortcut icon" href="../img/final_logo.png" type="ximage/x-icon" />
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../assests/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assests/css/main-all.css">
<link rel="stylesheet" type="text/css" href="../assests/css/util.css">
 <link rel="stylesheet" href="../assests/metismenu/metisMenu.css">
 <link rel="stylesheet" href="../assests/fonts/iconic/css/material-design-iconic-font.min.css">
 <link rel="stylesheet" href="../assests/tel/intlTelInput.css">
</head>
<body>
	<div class="display">
		<?php
	require_once('../agent/includes/top.php');
	require_once('../agent/includes/left.php');
	?>
	<div class="contents">
	<div class="contents-inner">
       <div class="row">
       	<div class="col-md-12">
       			<div class="limiter">
          <div class="breadcrumb">
  <a href="#" >Settings</a>
  <a href="#" class="active">Change Password</a>
</div>
       				<div class="dash-cont">
       					<div class="row">

       						<div class="col-lg-10 col-md-12 col-sm-12" style="background:">
       							<div class="dash-one-cont" style="background:;">

<style>
#sign-up-form{width:100%;border:5px solid white;border:10px solid #F2F3F4;padding:10px;background:#F2F3F4;}
.dash-widget{background:#F2F3F4;}
.flex-cont{display:flex;}.label-left{margin-left:40%;}
.inputs{min-height:40px;color:white;border:1px solid #909497;color:#383838;font-weight:normal;}
.inputs:focus{border:1px solid #787878;box-shadow:0 0 10px #787878;border-radius:10px;}
.login100-form-btn{background:#943126;box-shadow:0px 0px 5px #943126;width:40%;height:40px;}
.login100-form-btn:active{{background:#909497;}
.inputs2{background:#2b7de1;}
.display-becouse2{display:flex;}
</style>

<div class="dash-widget" style="min-height:400px;">

  <form class="login100-form  validate-form-sign" id="sign-up-form" action="javascript:;">
<label class="label-input100">Your new password</label>
<input class="form-control inputs" maxlength="32" minlength="8" placeholder="Enter your Current password here" type="password" name="d_fname" valid="fname">
<label class="label-input100">Your new password</label>
<input class="form-control inputs" maxlength="32" minlength="8" placeholder="Enter the new password here" type="password" name="d_fname" valid="fname">
<label class="label-input100">Confirm your New password</label>
<input class="form-control inputs" maxlength="32" minlength="8" placeholder="Confirm the new password here" type="password" name="d_fname" valid="fname">

<br>

<br><br>
    <button class="login100-form-btn">Change Password</button>


        </form>
       </div>




       							</div>
       						</div>
                  <div class="col-lg-2 col-md-12 col-sm-12"></div>



       					</div>



</div>

		<div class="container-login100" style="background-image:url('images/bg-01.jpg');display:none;" >


		</div>
	</div>

       	</div>
       </div>

	</div> <!-- contents inner -->
	</div><!-- contents -->

<!-- <p>Copyright &copy; RS Empire Ltd-2019 All rights reserved Terms of use</p>  -->



<?php
require_once('../agent/includes/footer.php');
?>
</body>
<script type="text/javascript" src="../assests/js/main.js"></script>
<script src="../assests/tel/intlTelInput-jquery.min.js"></script>


<script>
  $("#phone-number").intlTelInput({
        allowDropdown: true,
        preferredCountries:["rw","gb","us","ke","bi","tz","ug"],
        autoPlaceholder:"polite",
        excludeCountries: ["af","al","dz"],
       autoHideDialCode: false,
      geoIpLookup: function(callback) {
      $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "";
      callback(countryCode);
      });
      },
       placeholderNumberType: "MOBILE",
       separateDialCode: true,
      utilsScript: "utils.js",
      });
</script>
</style>
</html>
<style>
	.greater{margin-left:0%;width:100%;}
</style>

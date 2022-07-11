<?php
require_once("../main/classes.php");
require_once('../assests/abdu/matching-class.php');
require_once("sessions.php");
ver_session();
$UpdateUpgrade = new UpdateUpgrade();
$agent = new AgentAccountData($my_acount_id);
$UpdateBalances = new UpdateBalances(1);

$fname= isset($_GET['nm'])? base64_decode($_GET['nm']):"No Ordered Pincode";
$lname= isset($_GET['nms'])? base64_decode($_GET['nms']):"No Ordered Pincode";
$code= isset($_GET['cd'])? base64_decode($_GET['cd']):" ";
new RunUpdateBalances();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Member|Add Member</title>
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
  <a href="#" >Members</a>
  <a href="#" class="active">Add new Member</a>
</div>
       				<div class="dash-cont">
       					<div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12"></div>
       						<div class="col-lg-7 col-md-12 col-sm-12" style="background:">
       							<div class="dash-one-cont" style="background:;">

<style>
#sign-up-form{width:100%;border:5px solid white;border:10px solid #F2F3F4;padding:10px;background:#F2F3F4;}
.dash-widget{background:#F2F3F4;}
.flex-cont{display:flex;}.label-left{margin-left:40%;}
.inputs{min-height:40px;color:white;border:1px solid #909497;color:#383838;font-weight:normal;transition:500ms;}
.inputs:focus{border:1px solid #787878;box-shadow:0 0 10px #787878;border-radius:10px;}
.login100-form-btn{background:#CD361F;box-shadow:0px 0px 5px #CD361F;width:40%;height:40px;}
</style>




<div class="dash-widget" style="min-height:400px">
  <p class="widget-title" style="padding:0px;">Add New Member</p>

  <form class="login100-form  validate-form-sign vl-sign" SignUp="form-2" id="sign-up-form" action="javascript:;">
          <span class="login100-form-title p-b-20">
  <p class="error-label2" style="display:none;"></p>
          </span>

  <label class="label-input100">Names</label>
  <span style="" class="flex-cont">
  <input class="form-control inputs" id="fnames" placeholder="Enter the firstname here" type="text" name="d_fname" valid="fname"  value="<?= $fname;?>" disabled>
&nbsp;&nbsp;
<input class="form-control inputs" value="<?= $lname;?>" type="text" valid="fname" placeholder="Enter the lastname here" id="lnames" name="d_lname" valid="fname" disabled>
  </span>

<span class="label-input100">Gender</span>
<label class="label-input100 label-left">Date of birth</label>
<span class="flex-cont">
<select class="form-control inputs" id="side" valid="fname" name="d_gender">
  <option value="">---Choose Gender---</option>
  <option value="Male">Male</option>
  <option value="Female">Female</option>
    </select>
&nbsp;&nbsp;
  <div class="input-group date">
  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
  <input type="date" valid="dob" placeholder="Choose date of birth" class="form-control inputs" name="d_dob" autocomplete="off">
  </div>
</span>

    <span class="label-input100">National ID</span>
<input class="form-control inputs" placeholder="Enter a valid National ID" type="text" valid="rwanda-id" name="d_nid">


<span class="label-input100">New Member Pincode</span>
<span class="label-input100 label-left">Sponsor Pincode</span>
  <span style="" class="flex-cont">
  <input class="form-control inputs" type="text" placeholder="Enter a valid  new member pincode"value="<?= $code;?>" id="nmPin" valid="names" name="d_pin" disabled>&nbsp;&nbsp;
  <input class="form-control inputs" type="text" placeholder="Enter a valid sponsor Pincode" valid="names" name="d_sponsor">
  </span>

  <span class="label-input100">Upline Pincode</span>
  <span class="label-input100 label-left">Upline Side</span>
   <span style="" class="flex-cont">
       <input class="form-control inputs" type="text" placeholder="Enter the upline pincode here" valid="names" name="d_upline">
  &nbsp;&nbsp;
    <select class="form-control inputs" valid="fname"  id="side" name="d_side">
    <option value="">---Choose Side---</option>
    <option value="Left">Left</option>
    <option value="Right">Right</option>
  </select>
  </span>

  <span class="label-input100">Country</span>
  <span class="label-input100 label-left">City,Address</span>
<span style="" class="flex-cont">
  <select class="form-control inputs" valid="names"  id="countries" name="d_cntry">
    <option value="">---Choose Country---</option>
        </select>&nbsp;&nbsp;
  <input class="form-control inputs" type="text" valid="names" name="d_city" placeholder="Type your city or adress here">
  </span>


  <span class="label-input100">New Password</span>
    <span class="label-input100 label-left">Confirm New Password</span>
  <span style="" class="flex-cont">
  <input class="form-control inputs" id="confirmpwd" type="password" valid="password" name="" placeholder="Type your new password here">&nbsp;&nbsp;
  <input class="form-control inputs" type="password" confirmPw="#confirmpwd" valid="confirm-password" name="d_upass" placeholder="Type your password here">
    </span>


<span class="label-input100">Email(Optional)</span>
  <input class="form-control inputs" type="text" valid="email" name="d_email" placeholder="Type valid email address">
<br>

    <button class="login100-form-btn" id="signUpClick">Add Member</button>

        </form>




       </div>




       							</div>
       						</div>
                  <div class="col-lg-3 col-md-12 col-sm-12"></div>


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


<!-- modals -->
<style>
  .error-label3{position:fixed;min-height:100px;width:50%;background:white;z-index:100;top:30%;left:30%;border:1px solid #787878;border-radius:5px;padding:7px;display:none;}
  .btnvcs{min-height:30px;background:#E74C3C;padding:5px 30px;color:white;border:1px solid #641E16;border-radius:5px;margin-right:5px;}
  .m-top{width:100%;height:30px;}
  .repon{min-height:50px;width:100%;background:#AAB7B8;border:1px solid #909497;}
  .m-bottom{padding-top:15px;padding-bottom:5px;}
</style>
<div class="error-label3">
  <div class="m-top">Confirm Registration</div>
   <div class="repon"></div>
  <div class="m-bottom">
    <span class="display-first">
    <button href="javascript:;" id="confirm-this" class="btnvcs">Confirm</button>
    <button href="javascript:;" id="cancel-this"  class="btnvcs">Cancel</button>
    </span>
    <span class="display-before">
    <a href="downlines" class="btnvcs">View Tree</a>
    <a href="dashboard" class="btnvcs">Add Another</a>
    </span>
  </div>

  
</div>



<?php
require_once('../agent/includes/footer.php');
?>
</body>
<script type="text/javascript" src="../assests/js/main.js"></script>
<script src="../assests/tel/intlTelInput-jquery.min.js"></script>


<script>
  $("#telephone").intlTelInput({
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

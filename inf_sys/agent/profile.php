<?php
require_once("../main/classes.php");
require_once("sessions.php");
ver_session();
$agent = new AgentAccountData($my_acount_id);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agent|Profile</title>
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
  <a href="#" class="active">My Profile</a>
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
.login100-form-btn{background:#CD361F;box-shadow:0px 0px 5px #CD361F;width:40%;height:40px;}
.inputs2{background:#2b7de1;}
.display-becouse{display:none;}
</style>

<div class="dash-widget" style="min-height:400px;">


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

<?php
require_once("sessions.php");
ver_session();
require_once("../main/classes.php");
$admin = new AdminAccountData($my_acount_id);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard|Admin</title>
<link rel="shortcut icon" href="../img/logo.png" type="ximage/x-icon" />
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index, follow">
<meta name="copyright" content="RS EMPIRE LTD">
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
	require_once('includes/top.php');
	require_once('includes/left.php');
	?>

	<div class="contents">
	<div class="contents-inner">
       <div class="row">
       	<div class="col-md-12">
       			<div class="limiter">
          <div class="breadcrumb">
  <a href="#" >Members</a>
  <a href="#" class="active">Generating new pincode</a>

</div>
       				<div class="dash-cont">
       					<div class="row">
       						<div class="col-lg-8 col-md-8 col-sm-12" style="background:">
       							<div class="dash-one-cont" style="background:;">

<style>
.form-generate-pincode{width:90%;margin-left:5%;}
.dash-widget{background:#F2F3F4;}
.btn3432{width:40%;border-radius:0 5px 5px 0px;padding:5px;box-shadow:0 0 5px #ccc;border:3px solid #049796;background:#049796;
	margin-top:-1.5px;}
.resp_upl{width:60%;font-weight:bold;}
.input-btn{border-radius:5px 0px 0px 5px;}
.inputs{background:white;border:1px solid #424949;}
.inputs:focus{box-shadow:0 0 10px #424949;border:2px solid #1B2631;}
.inputs:active{box-shadow:0 0 10px #424949;border:2px solid #1B2631;}
.span-error{background:#ed292a;padding:3px;color:white;border-radius:5px;display:none;}
.printer{padding:5px;font-weight:bold;font-size:20px;box-shadow:0px 0px 5px #787878;position:absolute;cursor:pointer;top:5px;
background:white;left:46%;}
.printer:active{font-weight:bold;font-size:23px;}
</style>

<div class="dash-widget" style="min-height:400px">
  <p class="widget-title" style="padding:0px;">Generate Pincodes</p><br>
    <form class="form-generate-pincode" action="javascript:;">
         <span id="resp_n"></span><span id="resp_y"></span>

<span class="form-element">
  <span class="label-input100">Reference Pincode</span>
  <span class="span-error" valid-data="Invalid Pincode"></span>
      <span style="display:flex;">
      <input class="form-control inputs input-btn" placeholder="Input His/her recruiter Pinncode here" name="ref" id="ref_id" type="text">
      <p class="btn btn-success btn3432">Check</p>
      </span>
</span>

      <span class="form-element">
          <span class="label-input100" id="">Member names</span>
          <span class="span-error" valid-data="Invalid Names"></span>
         <span style="display:flex;">
 <input class="form-control inputs" id="fname-v" valid="fname" name="dist_fname" placeholder="Enter new  member Firstname here"  type="text">&nbsp;&nbsp;
 <input class="form-control inputs" id="lname-v" valid="lname" name="dist_lname" placeholder="Enter new  member Lastname here"  type="text">
         </span>
       </span>


          <span class="form-element">
        <span class="label-input100" id="">Member Phone</span>
         <span class="span-error" valid-data="Invalid Phone number"></span>
    <input type="tel" valid="rwanda-phone" class="form-control inputs" name="dist_phone" placeholder="" id="telephone">
    </span>

<span class="form-element">
      <span class="label-input100" id="">Number of Accounts</span>
       <span class="span-error" valid-data="Invalid Number of Accounts"></span>
  <input class="form-control inputs" valid="number" name="dist_accounts" placeholder="Enter his/her accounts to register"  type="number">
</span>

         <br>
<button class="btn btn-primary inputs" style="background:#21618C;color:white;">Generate</button>

          </form>




          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
            </div>
          </div>




       </div>




       							</div>
       						</div>
<div class="col-lg-4 col-md-4 col-sm-12" style="background:;" >
  <div class="dash-one-cont p-t-3 p-b-3 p-l-3 p-r-3">
           								<div class="dash-widget">
           <p class="widget-title">Check Upline</p><br>
           <span class="label label-info timev">Results</span>
            <span id="resp_upl"></span>
            <span id="resp_upl_y" style="color:green"></span>
           </div>

          <div class="dash-widget2">
           <p class="widget-title" style="background:#293D47;color:white;padding:3px;">Pincodes generated</p><br>
					 <span class="fa fa-print printer" ref=".pincode-response" id="printerBtn"></span>
           <span class="label label-info timev">Not activated pincode</span>

      <span id="resp_pincodes" class="pincode-response">

      </span>
           </div>
  </div>
</div>
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

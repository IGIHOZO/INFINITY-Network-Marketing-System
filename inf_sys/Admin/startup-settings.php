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
<meta name="description" content="RSEmpire is...........">
<meta name="keywords" content="...............">
<meta name="robots" content="index, follow">
<meta name="copyright" content="RS EMPIRE LTD">
<link rel="stylesheet" type="text/css" href="../assests/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assests/css/main-all.css">
<link rel="stylesheet" type="text/css" href="../assests/css/util.css">
 <link rel="stylesheet" href="../assests/metismenu/metisMenu.css">
 <link rel="stylesheet" href="../assests/fonts/iconic/css/material-design-iconic-font.min.css">
 <link rel="stylesheet" href="../assests/tel/intlTelInput.css">

 <style type="text/css">
   #resp_n{color: red;font-weight: bolder;float: right;text-align: center;}
   #resp{text-align: center;font-weight: bolder;color: red;}
   #resp_upl_y{font-weight: bolder;color: green;align-content: center;text-align: center;}
 </style>
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
  <a href="#" >Settings</a>
  <a href="#" class="active">Startup settings</a>

</div>
       				<div class="dash-cont">
       					<div class="row">
       						<div class="col-lg-8 col-md-8 col-sm-12" style="background:">
       							<div class="dash-one-cont" style="background:;">

<style>
  .form-generate-pincode{width:90%;margin-left:5%;border:5px solid white;}
  .btn3432{width:40%;border-radius:0 5px 5px 0px;}
  .input-btn{border-radius:5px 0px 0px 5px;}
  .inputs{background:none;box-shadow:0 0 3px #383838;}
.inputs:focus{border:2px solid red;box-shadow:0 0 10px #2b7da1;}
</style>

<div class="dash-widget" style="min-height:400px">
  <p class="widget-title" style="padding:0px;">Set bussiness prices</p><br>
    <form class="form-generate-pincode" action="javascript:;">


         <span id="resp_n"></span>
         <span id="resp_y"></span>

  <span class="label-input100">Commission income</span>
  <input class="form-control inputs input-btn" placeholder="" valid="number" name="commission" type="text">

  <span class="label-input100">Matching Bonus</span>
  <input class="form-control inputs input-btn" placeholder="" valid="number" name="" type="text">



  <span class="label-input100">First Level Upgrade Price</span>
  <input class="form-control inputs input-btn" placeholder="" valid="number" name="" type="text">

  <span class="label-input100">Seconnd Level Upgrade Price</span>
  <input class="form-control inputs input-btn" placeholder="" valid="number" name="" type="text">


  <span class="label-input100">Flashout Points</span>
  <input class="form-control inputs input-btn" placeholder="" valid="number" name="" type="text">




         <br>
<button class="btn btn-primary inputs" style="background:#21618C;color:white;">Save</button>

          </form>

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
           <span class="label label-info timev">Not activated pincode</span>

      <span id="resp_pincodes">

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

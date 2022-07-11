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
<meta name="copyright" content="INFINITY LTD">
<link rel="stylesheet" type="text/css" href="../assests/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assests/css/main-all.css">
<link rel="stylesheet" type="text/css" href="../assests/css/util.css">
 <link rel="stylesheet" href="../assests/metismenu/metisMenu.css">
 <link rel="stylesheet" href="../assests/fonts/iconic/css/material-design-iconic-font.min.css">
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
  <a href="#" >Dashboard</a>
  <a href="#" class="active">Sales Monitoring</a>

</div>
       				<div class="dash-cont">
       					<div class="row">
       						<div class="col-lg-8 col-md-8 col-sm-12" style="background:">
       							<div class="dash-one-cont" style="background:;">


<div class="dash-widget" style="min-height:400px">
  <p class="widget-title">ADMIN DATAS</p><br>

       </div>




       							</div>
       						</div>
<div class="col-lg-4 col-md-4 col-sm-12" style="background:;" >
  <div class="dash-one-cont p-t-3 p-b-3 p-l-3 p-r-3">
           								<div class="dash-widget">
           <p class="widget-title">whattapp</p><br>
           <span class="label label-info timev">whattapp</span>
            <span id="resp_upl"></span>
            <span id="resp_upl_y" style="color:green"></span>
           </div>

          <div class="dash-widget2">
           <p class="widget-title" style="background:#293D47;color:white;padding:3px;">
           hey</p><br>
           <span class="label label-info timev">hello</span>

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
</html>
<style>
	.greater{margin-left:0%;width:100%;}
</style>

<?php 
require_once("../main/classes.php");
require_once('../assests/abdu/matching-class.php');
require_once("sessions.php");
ver_session();
$agent = new AgentAccountData($my_acount_id);
//$UpdateBalances = new UpdateBalances(1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agent|History</title>
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
<style>
.topone{width:60px;height:60px;padding:1px;border-radius:5px;}
.imgsss{width:30px;height:30px;border-radius:3px;}
.encashment-tbl{width:98%;border:0px solid #787878;border-collapse:collapse;}
.encashment-tbl td{min-height:40px;height:35px;max-height:200px;border-bottom:1px solid #787878;padding-left:4px;text-align:center;font-size:13px;font-family:segoe ui;}
.encashment-tbl th{height:40px;border-bottom:3px solid #A93226;background:#A93226;color:white;border-left:5px solid #641E16;padding:5px;text-align:center;}
.encashment-tbl th:nth-child(1){border-left:0px solid #ddd;}
.boldred{color:#154360;}
.encashment-tbl tr:nth-child(even){background:#BDC3C7;}
.encashment-tbl tr td:nth-child(1){width:20px;}
.dash-widget{overflow-y:hidden;overflow-x:auto;min-height:400px;max-height:2000px;}


  </style>



</style>
	<div class="contents">
	<div class="contents-inner">
       <div class="row">
       	<div class="col-md-12">
       			<div class="limiter">
          <div class="breadcrumb">
  <a href="#" >Encashment</a>
  <a href="#" class="active">Encashment History</a>

</div>
<span style="display:none"><a href="#" class="zooms">+</a>&nbsp;&nbsp;<a href="#" class="zooms1">-</a></span>
       				<div class="dash-cont">
       					<div class="row">
       						<div class="col-lg-12 col-md-12 col-sm-12" style="background:">
       							<div class="dash-one-cont" style="background:;">

<div class="dash-widget" style="min-height:500px">
  <p class="widget-title" style="padding:0px;">View your encashment History</p><br>

<?php $agent->encashment_history($my_acount_id);?>

       </div>




       							</div>
       						</div>




       					</div>



</div>


	</div>

       	</div>
       </div>

	</div> <!-- contents inner -->
	</div><!-- contents -->


<?php
require_once('../agent/includes/footer.php');
?>
</body>
<script type="text/javascript" src="../assests/js/main.js"></script>
<script src="../assests/tel/intlTelInput-jquery.min.js"></script>
</html>
<style>
	.greater{margin-left:0%;width:100%;}
</style>

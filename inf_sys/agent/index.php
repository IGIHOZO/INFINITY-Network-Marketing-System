<?php 
require_once("../main/classes.php");
require_once('../assests/abdu/matching-class.php');
require_once("sessions.php");
ver_session();
$UpdateUpgrade = new UpdateUpgrade();
$agent = new AgentAccountData($my_acount_id);
$UpdateBalances = new UpdateBalances(1);
new RunUpdateBalances();
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard|Member</title>
<link rel="shortcut icon" href="../img/final_logo.png" type="ximage/x-icon" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  ?>
  <?php
  require_once('includes/left.php'); 
  ?>


  <div class="contents">
  <div class="contents-inner">
       <div class="row">
        <div class="col-md-12">
          <form>
            <style>
 .dash-widget{width:100%;min-height:150px;border:1px solid #787878;background:white;border-radius:5px;padding:5px;position:relative;display:inline-block;margin-left:3px;margin-bottom:5px;margin-top:3px;}
.dash-widget11{width:100%;min-height:150px;border:1px solid #787878;background:white;border-radius:5px;padding:5px;position:relative;display:inline-block;margin-left:3px;margin-bottom:5px;margin-top:3px;}
.dash-widget3{width:100%;height:auto;border:1px solid #787878;background:white;border-radius:5px;padding:5px;position:relative;display:inline-block;margin-left:3px;margin-bottom:5px;margin-top:3px;}
.widget-title{width:100%;}.widget-content{padding-top:;padding-bottom:10px;margin-top:-5px;font-weight:bold;}
.timev{position:absolute;right:5px;top:5px;background:#BA2E5E;padding:4px;}
.dash-cont{width:98%;}
.best-color{color:#2b7de1;}.ticker{}
.dash-widget2{width:100%;min-height:440px;border:1px solid #787878;background:white;border-radius:5px;padding:5px;position:relative;display:inline-block;margin-left:3px;margin-bottom:5px;}
.uls-acc{width:100%;list-style:none;text-align:left;}
.money-box{padding:10px;background:#CACFD2;border:1px solid #383838;font-weight:bold;font-size:14px;}
.spantopx{padding:3px;font-weight:bold;font-size:14px;}
.uls-acc li{width:100%;list-style:none;text-align:left;}
.fixed{ position: fixed;top:0; left:0;width: 100%; }
.theary{width:100%;}
.tickerx-img{width:100px;height:40px;}
.upgrades-litle{position:absolute;right:0px;font-size:13px;top:25px;}
.theary thead{font-weight:bold;}
.strng{padding:2px;border:1px solid #383838;background:#787878;}
.dash-one-cont{width:100%;position:relative;height:auto;}
.TR-2{background:#502B38;color:white;border:1px solid #381F27;}
.money-box2{background:#ccc;padding:15px;padding-left:40%;padding-right:35%;font-size:18px;font-weight:bold;border:1px solid #787878;text-align:center;}
.pincode-table{min-width:50%;max-width:100%;height:auto;border-collapse:collapse;border:0px solid #ddd;text-align:center;}
.pincode-table thead{height:40px;font-weight:bold;}
.pincode-table td{border:1px solid #ccc;}
.pincode-table tr:nth-child(even){background:#ddd;}
.pincodesx{overflow-x:hidden;overflow-y:auto;padding-bottom:7px;}
.addAcc{min-height:20px;background:#E74C3C;padding:5px 30px;color:white;border:1px solid #641E16;border-radius:5px;}
            </style>
            <div class="limiter">
              <div class="breadcrumb">
  <a href="#" >Dashboard</a>
  <a href="#" class="active">General</a>
</div>
              <div class="dash-cont">
                <div class="row">
                  <div class="col-lg-8 col-md-8 col-sm-12" style="background:">
                    <div class="dash-one-cont   " style="background:;">
                      <div class="row" style="display:;">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="dash-widget11">
        <p class="widget-title">TOTAL EARNINGS(Gross Income)</p><br>
       <span class="label label-info timev">All Accounts</span>
 
 <span class="upgrades-litle">
  Upgrades <br><strong class="strng" style="">RWF <?php echo $agent->my_all_accounts_upgrades($my_acount_id);?></strong> <br>
  Commission <br><strong class="strng">RWF <?php echo $agent->my_all_accounts_commission($my_acount_id);?></strong> <br>
  Matching  <br><strong class="strng">RWF <?php echo $agent->my_all_accounts_matching($my_acount_id);?></strong> 
 </span>
  <h4 class="widget-content"><strong>RWF <br><?php echo $agent->my_all_accounts_remain($my_acount_id);?></strong></h4>
<h6><strong class="best-color">RWF <?php echo $agent->my_all_accounts_remain($my_acount_id);?></strong> This month</h6>
        <h6><strong class="best-color">RWF <?php echo $agent->my_all_accounts_remain($my_acount_id);?></strong> Last month</h6>
       </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                         <div class="dash-widget">
       <p class="widget-title">AVAILABLE</p><br>
       <span class="label label-info timev">All Income</span>
      <span class="ticker"></span>
       <h4 class="widget-content" style="padding:15px;">RWF <?php echo $agent->my_all_accounts_balance($my_acount_id);?></h4>
      </div>
                        </div>
                          </div>
                          
                        </div>
                        

                      </div>
                       

       


<div class="dash-widget pincodesx" style="height:400px">
       <p class="widget-title">Your Ordered Pincode</p><br>
       <span class="label label-info timev">All Pincode</span>
          <?php
          $agent->unconfimed_accounts($my_acount_id);
          ?>
  <?php
//var_dump( gearman_version() );
?>

       </div>       


<div class="dash-widget3">
       <p class="widget-title">ACCOUNTS</p><br>
       <span class="label label-info timev">All Accounts</span>
       <?php echo $agent->my_accounts_table($my_acount_id);?>
      
      
</div>

        


                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12" style="background:;" >
                    <div class="dash-one-cont p-t-3 p-b-3 p-l-3 p-r-3">
                      <div class="dash-widget" style="display:;">
       <p class="widget-title">ENCASHED</p><br>
       <span class="label label-info timev">All accounts</span>
      
      <span class="upgrades-litle">
  Tax<br><strong class="strng TR-2">RWF <?php echo $agent->my_all_fee_tax($my_acount_id);?></strong> <br>
  Transactions fees <br><strong class="strng TR-2">RWF <?php echo $agent->my_all_fee_transaction_fees($my_acount_id);?></strong> <br>
  Received balance <br><strong class="strng TR-2">RWF <?php echo $agent->my_all_encash_gross($my_acount_id);?></strong> 
 </span>
       <h4 class="widget-content">RWF <br ><?php echo $agent->my_all_accounts_encashed($my_acount_id);?></h4>
       <h6><strong class="best-color"><?php echo $agent->my_all_accounts_encashed($my_acount_id);?></strong> Encashed last month</h6>
       </div>

                      <div class="dash-widget2">
       <p class="widget-title" style="background:#293D47;color:white;padding:3px;">Current Account: <?php echo $agent->my_pincode($my_acount_id);?> INFO</p><br>
       <span class="label label-info timev">Current Account</span>
       <ul class="uls-acc">

        <li>
          <h4 class="spantopx">Right matching Points</h4>
          <h5 class="money-box">POINTS: <?= $pointRt?></h5>
        </li>

        <li>
          <h4 class="spantopx">Left matching Points </h4>
          <h5 class="money-box">POINTS: <?= $pointLt ?></h5>
        </li>

        <li>
          <h4 class="spantopx">Daily sponsoring bonus(17%)</h4>
  <h5 class="money-box">
    RWF <?php echo $agent->my_daily_sponsiring_bonus($my_acount_id);?></h5>
        </li>

      <li>
        <h4 class="spantopx">Multiple acc bonus (17%)</h4>
  <h5 class="money-box">
    RWF <?php echo $agent->my_dorect_sponsiring_bonus($my_acount_id);?></h5>
        </li>

        <li>
          <h4 class="spantopx">Direct referral bonus</h4>
          <h5 class="money-box">RWF <?php echo $agent->my_commissions($my_acount_id);?></h5>
        </li>

        <li>
          <h4 class="spantopx">Matching bonus</h4>
          <h5 class="money-box"><?= $matching_amount;?></h5>
        </li>

        <li>
          <h4 class="spantopx">Indirect  Bonus</h4>
          <h5 class="money-box">RWF <?php echo $agent->my_upgrades($my_acount_id);?></h5>
        </li>
        
        

        <li>
          <h4 class="spantopx">Total Earnings</h4>
          <h5 class="money-box">RWF <?php echo $agent->my_total_earn($my_acount_id);?></h5>
        </li>

        <li>
          <h4 class="spantopx">Encashed</h4>
          <h5 class="money-box">RWF <?php echo $agent->my_encashed($my_acount_id);?></h5>
        </li>

        <li>
          <h4 class="spantopx">Available Income</h4>
          <h5 class="money-box">RWF <?php echo $agent->my_available($my_acount_id);?></h5>
        </li>

         <li>
          <h4 class="spantopx">Gift points</h4>
          <h5 class="money-box"><?= $car_points; ?></h5>
        </li>
        
       </ul>
     
       </div>
                    </div>
                  </div>
                </div>
      

       

       

       

      

    <center>
  <p style="text-align:center;font-weight:bold;font-size:14px;padding:10px;min-height:40px;background:white;">
    Copyright &copy; Enfiniti Global Ltd-2019 All rights reserved Terms of use.| 
    </center>   


       

      

</div>


  </div>
          </form>

        </div>
       </div>
    
  </div> <!-- contents inner -->
  </div><!-- contents -->



<?php
require_once('includes/footer.php');
?>
</body>
</html>
<style>
  .greater{margin-left:0%;width:100%;}
</style>


<?php 
require_once("../main/classes.php");
require_once('../assests/abdu/matching-class.php');
require_once("sessions.php");
ver_session();
$agent = new AgentAccountData($my_acount_id);
$UpdateBalances = new UpdateBalances(1);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Agent|Encash</title>
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
  <a href="#" >Encashment</a>
  <a href="#" class="active">Make encashment</a>
</div>
              <div class="dash-cont">
                <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12"></div>
                  <div class="col-lg-7 col-md-12 col-sm-12" style="background:">
                    <div class="dash-one-cont" style="background:;">

<style>
#encash-form{width:100%;border:5px solid white;border:10px solid #F2F3F4;padding:10px;background:#F2F3F4;}
.dash-widget{background:#F2F3F4;padding:10px;}
.flex-cont{display:flex;}.label-left{margin-left:40%;}
.inputs{min-height:40px;color:white;border:1px solid #909497;color:#383838;font-weight:normal;}
.inputs:focus{border:1px solid #787878;box-shadow:0 0 10px #787878;border-radius:10px;}
.login100-form-btn{background:#CD361F;box-shadow:0px 0px 5px #CD361F;width:40%;height:40px;}
.inputs2{background:#2b7de1;}
.account-number{background:#B7950B;padding:2px;border:3px solid #B7950B;color:#;}
.display-becouse{display:none;}
.acoounts-number{width:100%;}
.dv-encash-bank{width:100%;min-height:70px;padding:10px;align-content:center;padding:20px;border:1px solid #ddd;margin-top:15px;
font-weight:bold;}
.choose-account-ul{width:100%;background:#F4F6F7;}
.choose-account-ul li{width:100%;min-height:35px;background:#F4F6F7;padding:5px;box-shadow:0 0 5px #787878;position:relative;
  border-radius:5px}
.choose-account-ul li ul{width:90%;min-height:35px;background:white;display:none;position:absolute;margin-top:-50px;
border-radius:10px;box-shadow:0 0 5px #787878;left:5%;max-height:300px;overflow-x:hidden;overflow-y:auto;padding:10px;}
.choose-account-ul li:hover ul{display:block;}
.choose-account-ul li ul li{background:#F4F6F7;height:100%;padding-left:30px;border-bottom:2px solid #F0F3F4;
cursor:pointer;box-shadow:0 0 0px #ccc;border-radius:0px;}
.choose-account-ul li ul li:active{background:#D0D3D4;}
.check2{padding:5px;}.money-li{border-bottom:2px solid #ccc;}
.dowx{position:absolute;font-weight:bolder;font-size:30px;top:5%;right:2%;}
.buttonbvcd{height:40px;width:40%;border-radius:5px;border:3px solid #1C2833;background:#2E4053;padding:5px;margin-bottom:5px;color:white;}
.buttonbvcd:active{background:#1C2833;box-shadow:0px 0px 5px #1C2833;}
.ulcv{width:100%;height:100px;}
.response-rs{width:100%;background:#F31A0C;padding:6px;color:white;min-height:30px;display:none;}
.response-rs2{width:100%;background:#059A33;padding:6px;color:white;min-height:30px;
border:1px solid #034718;display:none;}

</style>

<div class="dash-widget" style="min-height:400px">
  <p class="widget-title" style="padding:5px;">Make encashment</p>

<br><p class="response-rs"></p><p class="response-rs2"></p><br>


  <ul class="choose-account-ul">
    <li class="li-all" style="cursor:pointer;" nn="" account="">
      <a href="#" style=""><center><span class="account-label">-----Click to Choose an Account-----</span></center> <span class="fa fa-angle-down dowx"></span></a>
      <div class="">
      <ul class="all-lixs">

<?php $agent->my_mbr_accounts_with_pin($my_acount_id);?>
      
      <!-- 
        <br><center><button class="buttonbvcd ">Choose</button></center>
       -->
        
      </ul>
      </li>

  </ul>
  <br>
  <span class="label-input100"> Balance</span>
  <input class="form-control inputs inputs2" id="input-balance" type="text" vl=""  value="" valid="names" name="d_upline" disabled>
   

  <form class="login100-form  " id="encash-form" action="javascript:;">
  
  <label class="label-input100">Withdraw Amount</label>
<input class="form-control inputs" maxlength="11" id="inputsamount" placeholder="Enter the firstname here" type="number" name="encash_amount" valid="number">
<span class="label-input100">Encashment Method</span>
<select class="form-control inputs" valid="fname" id="typex"  name="encash_type">
    <option value="">---Choose the Encashment Method---</option>
    <option value="Cash">By Cash</option>
    <option value="Equity">Equity Bank</option>
    <option value="MobileMoney">Mobile Money Account</option>
    </select>
<div class="dv-encash-bank">
      Bank  , Mobile Money  Account
     <p class="account-number">XXX-XXXX-XXXXXX-XXXXX</p>
    </div>
<br>
    <button class="login100-form-btn" id="make-encash">Encash</button>

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

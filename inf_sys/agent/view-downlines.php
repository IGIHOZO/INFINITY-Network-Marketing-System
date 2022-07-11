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
	<title>Agent|Your Member tree</title>
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
.tf-tree{font-size:16px;overflow:auto;}
.tf-tree *{box-sizing:border-box;margin:0;padding:0}
.tf-tree ul{display:inline-flex;}
.tf-tree li{align-items:center;display:flex;flex-direction:column;flex-wrap:wrap;padding:0 1em;position:relative;cursor:pointer;}
.tf-tree li ul{margin:2em 0}
.tf-tree li li:before{border-top:3px solid #383838;content:"";display:block;height:2px;left:-.03125em;position:absolute;top:-1.03125em;width:100%}
.tf-tree li li:first-child:before{left:calc(50% - .03125em);max-width:calc(50% + .0625em)}
.tf-tree li li:last-child:before{left:auto;max-width:calc(50% + .0625em);right:calc(50% - .03125em)}
.tf-tree li li:only-child:before{display:none}
.tf-tree li li:only-child>.tf-nc:before,.tf-tree li li:only-child>.tf-node-content:before{height:1.0625em;top:-1.0625em}
.tf-tree .tf-nc,.tf-tree .tf-node-content{border:0px solid #383838;display:inline-block;padding:.5em 1em;position:relative;box-shadow:0px 0px 5px  #787878;border-radius:5px;}
.tf-tree .tf-nc:before,.tf-tree .tf-node-content:before{top:-1.03125em}
.tf-tree .tf-nc:after,.tf-tree .tf-nc:before,.tf-tree .tf-node-content:after,.tf-tree .tf-node-content:before{border-left:2px solid #383838;content:"";display:block;height:1.2em;left:calc(50% - .03125em);position:absolute;width:.0625em}
.tf-tree .tf-nc:after,.tf-tree .tf-node-content:after{top:calc(100% + .03125em)}
.tf-tree .tf-nc:only-child:after,.tf-tree .tf-node-content:only-child:after,.tf-tree>ul>li>.tf-nc:before,.tf-tree>ul>li>.tf-node-content:before{display:none}
.tf-tree.tf-gap-sm li{padding:0 .6em}.tf-tree.tf-gap-sm li>.tf-nc:before,.tf-tree.tf-gap-sm li>.tf-node-content:before{height:.6em;top:-.6em}
.tf-tree.tf-gap-sm li>.tf-nc:after,.tf-tree.tf-gap-sm li>.tf-node-content:after{height:.6em}
.tf-tree.tf-gap-sm li ul{margin:1.2em 0}
.tf-tree.tf-gap-sm li li:before{top:-.63125em}
.tf-tree.tf-gap-sm li li:only-child>.tf-nc:before,.tf-tree.tf-gap-sm li li:only-child>.tf-node-content:before{height:.6625em;top:-.6625em}
.tf-tree.tf-gap-lg li{padding:0 1.5em}.tf-tree.tf-gap-lg li>.tf-nc:before,.tf-tree.tf-gap-lg li>.tf-node-content:before{height:1.5em;top:-1.5em}
.tf-tree.tf-gap-lg li>.tf-nc:after,.tf-tree.tf-gap-lg li>.tf-node-content:after{height:1.5em}
.tf-tree.tf-gap-lg li ul{margin:3em 0}
.tf-tree.tf-gap-lg li li:before{top:-1.53125em}
.tf-tree.tf-gap-lg li li:only-child>.tf-nc:before,.tf-tree.tf-gap-lg li li:only-child>.tf-node-content:before{height:1.5625em;top:-1.5625em}
.tf-tree li.tf-dotted-children .tf-nc:after,.tf-tree li.tf-dotted-children .tf-nc:before,.tf-tree li.tf-dotted-children .tf-node-content:after,.tf-tree li.tf-dotted-children .tf-node-content:before{border-left-style:dotted}
.tf-tree li.tf-dotted-children li:before{border-top-style:dotted}
.tf-tree li.tf-dotted-children>.tf-nc:before,.tf-tree li.tf-dotted-children>.tf-node-content:before{border-left-style:solid}
.tf-tree li.tf-dashed-children .tf-nc:after,.tf-tree li.tf-dashed-children .tf-nc:before,.tf-tree li.tf-dashed-children .tf-node-content:after,.tf-tree li.tf-dashed-children .tf-node-content:before{border-left-style:dashed}
.tf-tree li.tf-dashed-children li:before{border-top-style:dashed}
.tf-tree li.tf-dashed-children>.tf-nc:before,.tf-tree li.tf-dashed-children>.tf-node-content:before{border-left-style:solid}

.tf-tree li a:hover,
.tf-tree li a:hover~ul li a {background:#049796;color:white;border:0px solid #2b7de1;}
.tf-tree li a:hover~ul li::after,
.tf-tree li a:hover~ul li::before,
.tf-tree li a:hover~ul::before,
.tf-tree li a:hover~ul ul::before {border-color:#049796;}


.topone{width:60px;height:60px;padding:1px;border-radius:5px;}
.imgsss{width:30px;height:30px;border-radius:3px;}
.middle-body{background:#ed292a;}
.zooms,.zooms1{border-radius:3px solid #2b7de1;color:white;text-align:center;background:#2b7de1;align-content:center;
  font-size:20px;padding:4px;border-radius:50%;text-decoration:none;}

  <style>
.tooltips {position: relative;display:inline-block;}
.tooltips .tooltiptext {visibility:hidden;width:150px;background-color:#17202A;color:#fff;text-align:center;padding: 5px 0;
  border-radius:6px;position:absolute;z-index:1;bottom: 100%;left:50%;margin-left:-70px;}
.tooltiptext::after{content: '';height:30px;border-left:10px solid transparent;border-right:10px solid transparent;border-bottom:10px solid transparent;border-top:10px solid #17202A;left:40%;
position:absolute;top:100%;}
.tooltips:hover .tooltiptext {visibility:visible;}
  </style>



</style>
	<div class="contents">
	<div class="contents-inner">
       <div class="row">
       	<div class="col-md-12">
       			<div class="limiter">
          <div class="breadcrumb">
  <a href="#" >Members</a>
  <a href="#" class="active">Members tree</a>
</div>
<span style="display:none"><a href="#" class="zooms">+</a>&nbsp;&nbsp;<a href="#" class="zooms1">-</a></span>
       				<div class="dash-cont">
       					<div class="row">
       						<div class="col-lg-12 col-md-12 col-sm-12" style="background:">
       							<div class="dash-one-cont" style="background:;">

<div class="dash-widget" style="min-height:500px">
  <p class="widget-title" style="padding:0px;">View your  Tree</p><br>

  <div class="tf-tree example">
  <ul class="tree-ul">
             </ul>
           </div>


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

<!-- <p>Copyright &copy; RS Empire Ltd-2019 All rights reserved Terms of use</p>  -->

<?php
require_once('../agent/includes/footer.php');
?>
</body>
<script type="text/javascript" src="../assests/js/main.js"></script>
<script src="../assests/tel/intlTelInput-jquery.min.js"></script>
<script>

$(".tf-tree").animate({'zoom':0.8},400);
var datc="myTree=1&ds=<?php echo $my_acount_id?>";
/*"*/
var req=$.ajax({type:'get',url:'../assests/ajax/YYUIUTYTGFSDJFKSDRHKHFJFHSKRODJSKRJDKSKRDSSKDFDSFPOLLIJUYSDSD',data:datc,cache:false,async:true});
req.done(function(res){$(".tree-ul").html(res);});
//alert($(".tf-tree .tree-ul").width());

  $("#telephone").intlTelInput({
        allowDropdown: true,
        preferredCountries:["rw","gb","us","ke","bi","tz","ug"],
        autoPlaceholder:"polite",
        excludeCountries: ["af","al","dz"],
       autoHideDialCode: false,
      geoIpLookup:function(callback) {
      $.get("http://ipinfo.io",function() {}, "jsonp").always(function(resp) {
      var countryCode =(resp && resp.country) ? resp.country : "";
      callback(countryCode);
      });
      },
       placeholderNumberType:"MOBILE",
       separateDialCode: true,
      utilsScript: "utils.js",
      });
</script>
</style>
</html>
<style>
	.greater{margin-left:0%;width:100%;}
</style>

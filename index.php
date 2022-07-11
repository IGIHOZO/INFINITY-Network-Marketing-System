<!DOCTYPE html>
<html lang="en">
<head>
<title>INFINITY|HOMEPAGE</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<link rel="shortcut icon" href="img/final_logo.png" type="ximage/x-icon" />
<script type="application/x-javascript"> addEventListener("load", function() {setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<link href="//fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
</head>
<style>
	.f-logot{width:30%;height:30%;position:absolute;opacity:0.3;top:10%;left:35%;}
	.slides{background:#1B2631;padding:20px;border-radius:20px;}
	.slides h5{color:#651FF7;}
	.slides h4{color:#651FF7;text-decoration:none;}
	.sign-in-dvs{position:absolute;width:8%;right:2%;top:2%;}
	.sign-in-dvs li{padding:5px;width:100%;background:white;color:black;margin-bottom:5px;list-style:none;text-align:center;border-radius:10px;border:1px solid #ddd;transition:1s;}
	.sign-in-dvs li:hover{background:#2b7de1;color:white;}
	.sign-in-dvs li:hover a{color:white;}
	.hyt{}
	@media (max-width: 576px) {
.sign-in-dvs{top:90%;left:10%;float:left;width:1000%;width:40%;}
}
</style>
	
<body>
<?php
require_once 'includes/top1.php';
?>
<div class="welcome">
	 <div class="container">
		 <div class="welcome-top">
			<h2 class="w3ls_head" style="text-decoration:none;">Welcome</h2>
			
			 <p><strong>INFINITY GLOBAL PARTNERS</strong> is a company  founded in 2019 in Rwanda with the aim of becoming the number 1 distribution channel to connect Rwanda and the rest of the world through the innovative and creative system.</p>
		 </div>
		  <div class="charitys" style="display:none;">
			  <div class="col-md-4 chrt_grid" style="visibility:visible; -webkit-animation-delay: 0.4s;">
				   <div class="chrty">
						<figure class="icon">
							<span class="glyphicon-icon glyphicon-asterisk" aria-hidden="true"></span>
						</figure>						
						<h3>INFINITY GLOBAL PARTNERS LTD</h3>
						<p>Curabitur convallis rutrum erat nec vestibulum. Sed iaculis hendrerit lectus sit amet lobortis vulputate magna finibus molestie tellus.</p>
				  </div>
			  </div>
			  <div class="col-md-4 chrt_grid" style="visibility: visible; -webkit-animation-delay: 0.4s;">
				   <div class="chrty">
						 <figure class="icon">
							<span class="glyphicon-icon glyphicon-flag" aria-hidden="true"></span>
						</figure>						
						<h3>REACH US</h3>
						<p></p>
				  </div>
			  </div>
			  <div class="clearfix"></div>
		 </div>	
						 
	 </div>
</div>
<!-- //welcome -->

<?php
require_once 'includes/footer.php';
?>

<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>
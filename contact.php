<!DOCTYPE html>
<html lang="en">
<head>
<title>INFINITY| CONTACT</title>
<?php
require_once 'includes/top.php';
?>
<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
	<h1>
<a style="font-size:20px;" class="navbar-brand" href="homepage">
INFINITY GLOBAL PARTNERS LTD</a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
<li class="menu__item"><a href="homepage" class="menu__link">Home</a></li>
<li class="menu__item"><a href="about" class="menu__link">About</a></li>
<li class="menu__item "><a href="product" class="menu__link">Product</a></li>
<li class="dropdown menu__item"><a href="blog" class="menu__link">Blog</a></li>
<li class="menu__item menu__item--current"><a href="contact" class="menu__link">Contact</a></li>
						</ul>
					</nav>
				</div>
			</nav>		
		</div>
	</div>
</head>
	<style>
		.tyv input{border:1px solid #787878;}
	</style>
<body>
<!-- contact -->
	<div class="contact">
		<div class="container">
			<h2 class="w3ls_head" style="text-decoration:none;">Contact</h2>
			<p class="w3layouts_para"  style="width:60%;">You liked our products, you liked our marketing plan , have a suggestion or want to join us in distribution, send a message below</p>
			<div class="contact-right-w3-agile">
			<form action="#" method="post" class="tyv">
				<input type="text" name="Name" placeholder="Name" required="">
				<input type="text" name="Number" placeholder="Phone" required="">
				<textarea name="Comments" placeholder="Message" required=""></textarea>
				<input type="submit" value="Submit">
			</form>
		</div>
		</div>
	</div>

<?php
require_once 'includes/footer.php';
?>
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {		
			$().UItoTop({ easingType: 'easeOutQuart' });				
			});
	</script>
</body>
</html>
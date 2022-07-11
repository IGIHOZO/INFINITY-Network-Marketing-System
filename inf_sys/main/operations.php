<?php
session_start();

//==================================================================== CHANGING ACCOUNT
if (isset($_GET['chngAcnt']) AND isset($_GET['acnt'])) {
	$_SESSION['member']['id'] = $_GET['acnt'];
	header("location:../agent");
}else{
session_destroy();
	echo "<script>window.location='../login'</script>";
}
?>
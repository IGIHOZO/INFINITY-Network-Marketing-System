<?php
@session_start();
function ver_session(){
	if (!isset($_SESSION['member']['id'])) {
	return header("location:../login");
}
}
?>
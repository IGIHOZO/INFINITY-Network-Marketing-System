<?php
session_start();
function ver_session(){
	if (!isset($_SESSION['admin']['id'])) {
	return header("location:../login");
}
}
?>

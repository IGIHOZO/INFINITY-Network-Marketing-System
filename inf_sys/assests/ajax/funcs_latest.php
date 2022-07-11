<?php

//GETTING SAFE INPUT VARIABLES
function get_input($inpt){
	return$_GET[$inpt];
}
//GENERATE AUTOMATIC PASSWORD
function gen_pass(){
  return str_replace("=", "", base64_encode(rand(1, 9999)));
}
function logout(){
	return session_destroy();
	}
	?>

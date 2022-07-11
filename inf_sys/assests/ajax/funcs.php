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
//GROUP STRINGS INTO GROUPS OF ANY NUMBER
function break_string($string,  $group = 1, $delimeter = ' ', $reverse = true){
        $string_length = strlen($string);
        $new_string = [];
        while($string_length > 0){
            if($reverse) {
                array_unshift($new_string, substr($string, $group*(-1)));
            }else{
                array_unshift($new_string, substr($string, $group));
            }
            $string = substr($string, 0, ($string_length - $group));
            $string_length = $string_length - $group;
        }
        $result = '';
        foreach($new_string as $substr){
            $result.= $substr.$delimeter;
        }
        return trim($result, " ");
}
    ?>

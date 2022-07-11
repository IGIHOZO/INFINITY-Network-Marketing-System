<?php
class Quick{
	public $connect;public $left_downlines;public $right_downlines;
	public $downs;public $matching_bonus=10000;public $matching_points=50;
	 function __construct(){
try{
//$this->connect=new PDO('mysql:host=localhost;dbname=dnuaefvp_enfinity','dnuaefvp','WAE=+gLTm)vc');
$this->connect=new PDO('mysql:host=localhost;dbname=dnuaefvp_enfinity','root','');
$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //$this->connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
}catch(PDOException $e){echo('Connection Failed..1');}
	}
function crypt($data,$key){
$encrypted_text = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $data, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted_text;}
function dcrypt($data,$key){
$decrypted_text = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($data), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted_text; }

	public function rows($query,$ag){
try{
   $host2=$this->connect;
	$fetc=$host2->prepare($query);$args=explode("#",$ag);//print_r($args);
	$fetc->execute($args);
return $fetc->rowCount();
	}catch(PDOException $e){
	    //echo "Failed";
	    
	}
}


	public function FetchData($quer,$ar){
	try{
   $host2=$this->connect;
	$fetc=$host2->prepare($quer);$args=explode("#",$ar);//print_r($args);
	$fetc->execute($args);
if ($fetc->rowCount() >=1){
 //echo $fetc->rowCount();
 $fetch=$fetc->fetchAll(PDO::FETCH_ASSOC);
	return $fetch;
}
else{ return $error="No Such Data Available"; }
	}catch(PDOException $e){ echo "Failed"; }
	}

public function recurse($account_id,$counter){
    
	$status="E#".$account_id;
	$selectv="SELECT accounts.*,member.member_id,CONCAT(member.member_fname,' ',member.member_lname) AS names FROM accounts,member WHERE member.member_id=accounts.account_member AND  accounts.account_status=? AND accounts.account_upline=?";
	$fetchx=$this->FetchData($selectv,$status);
	$rows=$this->rows($selectv,$status);
	if (is_array($fetchx)) {
		foreach ($fetchx as $key => $value) {
			$side=$fetchx[$key]['account_side'];
			$code=$fetchx[$key]['account_pincode'];$member_name=$fetchx[$key]['names'];
			$acc_id=$fetchx[$key]['account_id'];
               	if ($side=='Left'){
             if ($counter=='Left'){$this->left_downlines=$this->left_downlines+1;}
             elseif($counter=='Right'){$this->right_downlines=$this->right_downlines+1;}
                //echo "L : ".$member_name.": ".$code."<br>";
				$this->recurse($acc_id,$counter);
               	}
               	elseif ($side=='Right'){
    if ($counter=='Left'){$this->left_downlines=$this->left_downlines+1;}
    elseif($counter=='Right'){$this->right_downlines=$this->right_downlines+1;}
         // echo "R: ".$this->left_downlines."-".$member_name.": ".$code."<br>";
				$this->recurse($acc_id,$counter);
               	}

		}

		
	}
}

public function flashOut($accounts_id,$left_dwn,$right_dwn){
$starting_day=date("Y-m-d")." 00:00:00";
$ending_day=date("Y-m-d")." 23:59:59";
$selectvy="SELECT * FROM points WHERE dates >= '$starting_day' AND dates <= '$ending_day' AND account_id=? ORDER BY points_id ASC LIMIT 1";
	$ixv=$this->FetchData($selectvy,$accounts_id);
	if (is_array($ixv)) {
foreach ($ixv as $key => $value) {$start_match=$ixv[$key]['matched_account']; } }
else{$start_match=0;}


$selct="SELECT * FROM points WHERE dates >= '$starting_day' AND dates <= '$ending_day' AND account_id=? ORDER BY points_id DESC LIMIT 1";
	$vyt=$this->FetchData($selct,$accounts_id);
if (is_array($vyt)) {
foreach ($vyt as $key => $value) {
   $end_match=$vyt[$key]['matched_account']; 
	$left_flashed=$vyt[$key]['rem_left_points'];
	$right_flashed=$vyt[$key]['rem_right_points'];

} }
else{$end_match=0;$left_flashed=0;$right_flashed=0;}
    $general_match=($end_match-$start_match);
if ($general_match>=7){
$sel_flash="SELECT SUM(left_flashed_points) AS leftPoint_flashed,SUM(right_flashed_points) AS rightPoints_flashed FROM flashout WHERE flashed_accounts=? AND flashout_status='E'";

$selfX="SELECT flashout_id,left_dwnlines,right_dwnlines FROM flashout WHERE flashed_accounts=? AND flashout_status='E' ORDER BY flashout_id DESC LIMIT 1";

$flct=$this->FetchData($selfX,$accounts_id);
if (is_array($flct)) {
	foreach ($flct as $key => $value) {
   $left_fdw=$flct[$key]['left_dwnlines'];
   $right_fdw=$flct[$key]['right_dwnlines'];  
	}
}else{$left_fdw=0;$right_fdw=0;}

	$fetchxv=$this->FetchData($sel_flash,$accounts_id);
	$rowss=$this->rows($sel_flash,$accounts_id);
	if ($rowss>=1) {
		if (is_array($fetchxv)) {
		foreach ($fetchxv as $key => $value) {
   
$left_f_points=$fetchxv[$key]['leftPoint_flashed']/$this->matching_points;
 $right_f_points=$fetchxv[$key]['rightPoints_flashed']/$this->matching_points;
 if ($left_fdw==$left_dwn) {$left_flashed=0;}
 else{
$new_left_fdw=($left_dwn-$end_match)-$left_f_points;
$left_flashed=$new_left_fdw*$this->matching_points;
 }

 if ($right_fdw==$right_dwn) {
 	$right_flashed=0;
 }else{
$new_right_fdw=($right_dwn-$end_match)-$right_f_points;
$right_flashed=$new_right_fdw*$this->matching_points;
 }

		
		
		
		

	if ($left_fdw==$left_dwn && $right_dwn==$right_fdw) {
		//if no change do nothing  
	}else{
		//add flashout points
		 if ($left_flashed==0 && $right_flashed==0) {
   }else{
   $datc=$left_flashed."#".$right_flashed."#".$left_dwn."#".$right_dwn."#E#".$accounts_id;
 $insertT="INSERT INTO flashout (`flashout_id`,`left_flashed_points`,`right_flashed_points`,`left_dwnlines`,`right_dwnlines`,`flashout_status`,`dates`,`flashed_accounts`) VALUES (NULL,?,?,?,?,?, CURRENT_TIMESTAMP,?)";
	$QUERY=$this->rows($insertT,$datc);
   }

	}
		}
	}
    
	}else{
   if ($left_flashed==0 && $right_flashed==0) {
   }else{
  $datc=$left_flashed."#".$right_flashed."#".$left_dwn."#".$right_dwn."#E#".$accounts_id;
   	$insertT="INSERT INTO flashout (`flashout_id`,`left_flashed_points`,`right_flashed_points`,`left_dwnlines`,`right_dwnlines`,`flashout_status`,`dates`,`flashed_accounts`) VALUES (NULL,?,?,?,?,?, CURRENT_TIMESTAMP,?)";
	$QUERY=$this->rows($insertT,$datc);
   }


	}



return true;


}else{return false;}
}




public function updateBalance($accounts_id,$total_matching){
$SEL="SELECT * FROM balance WHERE balance_account=? AND balance_status='E'";
$fetchdat=$this->FetchData($SEL,$accounts_id);
$rowsx=$this->rows($SEL,$accounts_id);
$fith_matching=floor(($total_matching/$this->matching_bonus)/5)*$this->matching_bonus;
$total_matching=$total_matching-$fith_matching;

if ($rowsx==1) {
	foreach ($fetchdat as $key => $value) {
	$total_commission=$fetchdat[$key]['balance_commission'];
	$total_upgrades=$fetchdat[$key]['balance_upgrade'];
	$total_mlt_accounts=$fetchdat[$key]['balance_daily_sponsor'];
	$total_sponsors=$fetchdat[$key]['balance_direct_sponsors'];
	$balance_all=$total_upgrades+$total_commission+$total_matching+$total_mlt_accounts+$total_sponsors;
	$balance_available=$balance_all-$fetchdat[$key]['balance_encashed'];
	
$datyi=$total_matching."#".$balance_all."#".$balance_available."#".$accounts_id."#E";
if ($total_matching>0) {
$updatesY="UPDATE balance SET balance_matching=?,balance_all=?,balance_total=? WHERE balance_account=? AND balance_status=?";
$updateRw=$this->rows($updatesY,$datyi);
}
	}
}else if($rowsx<1){
$DTY=$accounts_id."#".$total_matching."#0#0#".$total_matching."#0#".$total_matching."#E";
if ($total_matching>0) {
 $Insert="INSERT INTO balance(balance_id,balance_account,balance_matching,balance_commission,balance_upgrade,balance_all,balance_encashed,balance_total,balance_status) VALUES(NULL,?,?,?,?,?,?,?,?)";
 $rowsInser=$this->rows($Insert,$DTY);
}
}

}

public function fithMatching($matching_count){
	if ($matching_count>=1) {
	if ($matching_count%5==0){return true;}else{return false;}	
	}else{return false;}
	
}


public function insertPoints($accounts_id){
  $select_flash="SELECT SUM(left_flashed_points) AS leftFlashed,SUM(right_flashed_points) AS rightFlashed FROM flashout WHERE flashed_accounts=? AND flashout_status='E'";
    $Ex_flash=$this->FetchData($select_flash,$accounts_id);
    if (is_array($Ex_flash)) {
    	foreach ($Ex_flash as $key => $value) {
     	$leftFlashed=$Ex_flash[$key]['leftFlashed']/$this->matching_points;
     $rightFlashed=$Ex_flash[$key]['rightFlashed']/$this->matching_points;	
    	}
    }else{$leftFlashed=0;$rightFlashed=0;}

$selectVv="SELECT * FROM points WHERE account_id=? ORDER BY points_id DESC LIMIT 1";
$rowsVf=$this->rows($selectVv,$accounts_id);

$leftDownlines=$this->left_downlines-$leftFlashed;
$rightDownlines=$this->right_downlines-$rightFlashed;

if ($leftDownlines>$rightDownlines){
$leftpoints=($leftDownlines-$rightDownlines)*$this->matching_points;
$rightpoints=0;$matching=$rightDownlines;
}else{
$rightpoints=($rightDownlines-$leftDownlines)*$this->matching_points;
$leftpoints=0;$matching=$leftDownlines;
}
if ($rowsVf==1) {
$fetchdx=$this->FetchData($selectVv,$accounts_id);
foreach ($fetchdx as $key => $value) {
   $rght=$fetchdx[$key]['rem_right_points'];
   $lft=$fetchdx[$key]['rem_left_points'];
}
	if ($rght==$rightpoints && $lft==$leftpoints){
	}else{
if ($this->fithMatching($matching)==true){$stats='Fith';}else{$stats='E';}
if ($this->flashOut($accounts_id,$this->left_downlines,$this->right_downlines)==true){
	$leftPt=0;$rightPt=0;$stats='F';}
	else{$leftPt=$leftpoints;$rightPt=$rightpoints;}
$dats=$accounts_id."#".$this->left_downlines."#".$this->right_downlines."#".$leftPt."#".$rightPt."#".$matching."#".$stats;
$insert="INSERT INTO points(points_id,account_id,left_downlines,right_downlines,rem_left_points,rem_right_points,matched_account,status) VALUES (NULL,?,?,?,?,?,?,?)";
$rowxv=$this->rows($insert,$dats);
$matching_blc=$matching*$this->matching_bonus;
$this->updateBalance($accounts_id,$matching_blc);
	}
	
}elseif($rowsVf<=0){
	if ($leftDownlines==0 && $rightDownlines==0){
	}else{
if ($this->fithMatching($matching)==true){$stat='Fith';}else{$stat='E';}
if ($this->flashOut($accounts_id,$this->left_downlines,$this->right_downlines)==true){$leftPt=0;$rightPt=0;$stat='F';}
else{$leftPt=$leftpoints;$rightPt=$rightpoints;}

$dats=$accounts_id."#".$this->left_downlines."#".$this->right_downlines."#".$leftPt."#".$rightPt."#".$matching."#".$stat;

$insert="INSERT INTO points(points_id,account_id,left_downlines,right_downlines,rem_left_points,rem_right_points,matched_account,status) VALUES (NULL,?,?,?,?,?,?,?)";

$rowxv=$this->rows($insert,$dats);
$matching_blc=$matching*$this->matching_bonus;
$this->updateBalance($accounts_id,$matching_blc);

	}

}

}

 public function matching(){
 	$nodata="0";
 	$select_dt="SELECT accounts.*,member.member_id,CONCAT(member.member_fname,' ',member.member_lname) AS names FROM accounts,member WHERE member.member_id=accounts.account_member AND  accounts.account_status='E'";
 	$selrow=$this->FetchData($select_dt,$nodata);
 	$rows=$this->rows($select_dt,$nodata);
 	if (is_array($selrow)) { $ivx=1;
 		foreach ($selrow as $key => $value) {
 		$this->left_downlines=0;$this->right_downlines=0;
			$accounts_code1=$selrow[$key]['account_pincode'];
			$accounts_id=$selrow[$key]['account_id'];
			$member_name=$selrow[$key]['names'];
//echo '<p style="background:#ccc;border:5px solid #ddd;">'.$ivx." ".$member_name.':'.$accounts_code1.'<p>';

$statusx="E#".$accounts_id;
$sel2="SELECT accounts.*,member.member_id,CONCAT(member.member_fname,' ',member.member_lname) AS names FROM accounts,member WHERE member.member_id=accounts.account_member AND  accounts.account_status=? AND accounts.account_upline=?";
$dats=$this->FetchData($sel2,$statusx);
if (is_array($dats)) { $sizes=1; 
/*loop the first 3 downlines to determine left and right*/
	foreach ($dats as $key => $value) { 
   $side_main=$dats[$key]['account_side'];
	$code_main=$dats[$key]['account_pincode'];$member_main=$dats[$key]['names'];
	$acc_main=$dats[$key]['account_id'];
	if ($side_main=='Left'){
		//echo "<br>""Left: ".$member_main." ".$code_main;echo "<br>";
		$cou="Left";
		$this->recurse($acc_main,$cou);
		$this->left_downlines=$this->left_downlines+1;
        //echo "-------------------------";
	}else if ($side_main=='Right'){
		//echo "<br>".$sizes."Right:".$member_main." ".$code_main;echo "<br>";
		$cou="Right";
         $this->right_downlines=$this->right_downlines+1;  
		$this->recurse($acc_main,$cou);
	}
       $sizes++;   
	} //echo "<br>";
}

//echo "Left downlines: ".$this->left_downlines;echo "<br><br>";
//echo "Right downlines: ".$this->right_downlines;echo "<br><br>";

$this->insertPoints($accounts_id);



			 	$ivx++;
 		}
 	}else{
 		
 	}

 }

 public function selPoints($accounts_id){
 $sel="SELECT * FROM points WHERE account_id=? ORDER BY points_id DESC LIMIT 1";
 $Selvy=$this->FetchData($sel,$accounts_id);
 if (is_array($Selvy)) {
 	foreach ($Selvy as $key => $value) {
   $points_left=$Selvy[$key]['rem_left_points'];
 	$points_right=$Selvy[$key]['rem_right_points'];
 	$matching=$Selvy[$key]['matched_account'];
 	$fith=floor($matching/5)*$this->matching_bonus;
 	$matching=($matching*$this->matching_bonus)-$fith;

 	}
 } else{$points_left=0;$points_right=0;$matching=0;}
 return $points_left."#".$points_right."#".$matching;
 }


}

$matching=new Quick();
 $matching->matching();
 @$match_array=explode("#",$matching->selPoints($my_acount_id));
 if (is_array($match_array)) {
 	foreach ($match_array as $key => $value) {
 		$pointLt=number_format($match_array[0],2);
 		$pointRt=number_format($match_array[1],2);
 		$matching_amount=number_format($match_array[2],2);
 	}
 }else{$pointLt=number_format(0,2);$pointRt=number_format(0,2);
  $matching_amount=number_format(0,2);
}
$car_points=number_format(floor(($matching_amount/10)/5)*250,2);
  

?>

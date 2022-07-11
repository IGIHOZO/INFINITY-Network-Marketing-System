<?php
require_once('../assests/ajax/main.php');
if (isset($_SESSION['member']['id'])) {
	$my_acount_id= $_SESSION['member']['id'];
}else if (isset($_SESSION['admin']['id'])) {
	$my_acount_id= $_SESSION['admin']['id'];
}
//====================================================================================================== CONNECTION
class DbConnects
{
	 //private $host='localhost';
	 //private $dbName = 'dnuaefvp_enfinity';
	 //private $user = 'dnuaefvp';
	 //private $pass = 'WAE=+gLTm)vc';
	 //public $conn;

	private $host='localhost';
	private $dbName = 'dnuaefvp_enfinity';
	private $user = 'root';
	private $pass = '';
	public $conn;
	
	public function connect()
	{
		try {
		 $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->user, $this->pass);
		 return $conn;
		} catch (PDOException $e) {
			return "Database Error 2";
		//	return null;
		}
	}
}
//====================================================================================================== Agent Data

class AgentAccountData extends DbConnects
{
	
/*
 	Display unconfirmed accounts				
 */
function unconfimed_accounts($me_acc){
	$conn =parent::connect();
	$sel_unc=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_referee='$me_acc' AND accounts.account_status='NY'");
	$cnt_sel_unc=$sel_unc->rowCount();
	if ($cnt_sel_unc<1) {
		echo "<center>No New Accounts Available</center>";
	}else{
		echo "<table width=100% class='pincode-table'>
		<theader><th>#</th><th>Names</th><th>Pincodes</th>
		<th>Options</th>
		</theader>";
		$cnt=1;
		while ($ft_sel_unc=$sel_unc->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			echo "<td>$cnt. </td>";
			echo"<td>".strtoupper($ft_sel_unc['member_fname']).' '.ucfirst($ft_sel_unc['member_lname']).": </td>";
			$fnames=$ft_sel_unc['member_fname'];
		$lnames=$ft_sel_unc['member_lname'];$code=$ft_sel_unc['account_pincode'];
			echo "<td>&nbsp;&nbsp;".$ft_sel_unc['account_pincode']."</td>";
			echo '<td>
			<a href="add-member?nm='.base64_encode($fnames).'&nms='.base64_encode($lnames).'&cd='.base64_encode($code).'"S><span class="fa fa-plus addAcc">Add</a>
			</td>';
			echo "</tr>";
			$cnt++;
		}
		echo "</table>";
	}
}
//=================================== GETTING MY ACCOUNT
function my_pincode($me_acc){
	$conn =parent::connect();
	$sel_pin=$conn->query("SELECT account_pincode FROM accounts WHERE account_id='$me_acc'");
	$ft_sel_pin=$sel_pin->fetch(PDO::FETCH_ASSOC);
	$my_ant_pin=$ft_sel_pin['account_pincode'];
	return $my_ant_pin;
}
//=================================== GETTING MY LEFT MATCHING
function my_match_left($me_acc){
	$conn =parent::connect();
	$sel_my_left=$conn->query("SELECT matching_rem_left,matching_owner FROM matching WHERE matching_owner='$me_acc' ORDER BY matching_id DESC LIMIT 1");
		$my_left_match;
	if ($sel_my_left->rowCount()==0) {
		$my_left_match=0;
	}else{
		$ft_sel_my_left=$sel_my_left->fetch(PDO::FETCH_ASSOC);
		$my_left_match = $ft_sel_my_left['matching_rem_left'];
	}

	return number_format(($my_left_match*40),2);
}
//=================================== GETTING MY RIGHT MATCHING
function my_match_right($me_acc){
	$conn =parent::connect();
	$sel_my_right=$conn->query("SELECT matching_rem_right,matching_owner FROM matching WHERE matching_owner='$me_acc' ORDER BY matching_id DESC LIMIT 1");
		$my_right_match;
	if ($sel_my_right->rowCount()==0) {
		$my_right_match=0;
	}else{
		$ft_sel_my_right=$sel_my_right->fetch(PDO::FETCH_ASSOC);
		$my_right_match = $ft_sel_my_right['matching_rem_right'];
	}
	return number_format(($my_right_match*40),2);
}
//=================================== GETTING TOTAL MATCHING MATCHING
function my_match_total($me_acc){
	$conn =parent::connect();
	$sel_my_ttl=$conn->query("SELECT SUM(balance_matching) AS my_bal_match_total,balance_account FROM balance WHERE balance_account='$me_acc'");
		$my_total_match;
	if ($sel_my_ttl->rowCount()==0) {
		$my_total_match=0;
	}else{
		$ft_sel_my_ttl=$sel_my_ttl->fetch(PDO::FETCH_ASSOC);
		$my_total_match = $ft_sel_my_ttl['my_bal_match_total'];
	}
	return number_format(($my_total_match),2);
}

//==================================== GETTING MY COMMISSION
function my_commissions($me_acc){
	$conn =parent::connect();
	$sel_my_commission=$conn->query("SELECT SUM(balance_commission) AS my_commission,balance_account FROM balance WHERE balance_account='$me_acc'");
	$my_commissions;
	if ($sel_my_commission->rowCount()==0) {
		$my_commissions=0;
	}else{
		$ft_sel_my_commission=$sel_my_commission->fetch(PDO::FETCH_ASSOC);
		$my_commissions = $ft_sel_my_commission['my_commission'];
	}
	return number_format(($my_commissions*1),2);
}

//===================================== MY UPGRADES
function my_upgrades($me_acc){
	$conn = parent::connect();
	$sel_my_upgrades=$conn->query("SELECT SUM(balance_upgrade) AS balance_upgrades,balance_account FROM balance WHERE balance_account='$me_acc'");
	$my_upgrades;
	if ($sel_my_upgrades->rowCount()==0) {
		$my_upgrades=0;
	}else{
		$ft_sel_my_upgrades=$sel_my_upgrades->fetch(PDO::FETCH_ASSOC);
		$my_upgrades = $ft_sel_my_upgrades['balance_upgrades'];
	}
	return number_format(($my_upgrades*1),2);
}


//===================================== MY TOTAL EARNING
function my_total_earn($me_acc){
	$conn = parent::connect();
	$sel_my_ttl_ern=$conn->query("SELECT SUM(balance_all) AS balance_all,balance_account FROM balance WHERE balance_account='$me_acc'");
	$my_ttl_ern;
	if ($sel_my_ttl_ern->rowCount()==0) {
		$my_ttl_ern=0;
	}else{
		$ft_sel_my_ttl_ern=$sel_my_ttl_ern->fetch(PDO::FETCH_ASSOC);
		$my_ttl_ern = $ft_sel_my_ttl_ern['balance_all'];
	}
	return number_format(($my_ttl_ern*1),2);
}
//===================================== MY TOTAL EARNING
function my_encashed($me_acc){
	$conn = parent::connect();
	$sel_my_encashed=$conn->query("SELECT SUM(balance_encashed) AS balance_encash,balance_account FROM balance WHERE balance_account='$me_acc'");
	$my_encashed;
	if ($sel_my_encashed->rowCount()==0) {
		$my_encashed=0;
	}else{
		$ft_sel_my_encashed=$sel_my_encashed->fetch(PDO::FETCH_ASSOC);
		$my_encashed = $ft_sel_my_encashed['balance_encash'];
	}
	return number_format(($my_encashed*1),2);
}

//===================================== MY TOTAL AVAILABLE REMAINING
function my_available($me_acc){
	$conn = parent::connect();
	$sel_my_available=$conn->query("SELECT SUM(balance_total) AS balance_available,balance_account FROM balance WHERE balance_account='$me_acc'");
	$my_available;
	if ($sel_my_available->rowCount()==0) {
		$my_available=0;
	}else{
		$ft_sel_my_available=$sel_my_available->fetch(PDO::FETCH_ASSOC);
		$my_available = $ft_sel_my_available['balance_available'];
	}
	return number_format(($my_available*1),2);
}

//========================================  NUMBER OF MY ACCOUNTS
function return_my_accounts($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.account_id,accounts.account_member,member.member_id FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	 if (($se_my_acnt->rowCount())>0) {
	 	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	 	$mbr_id = $ft_se_my_acnt['member_id'];
	 	$sel_accounts_mbr=$conn->query("SELECT accounts.account_member,accounts.account_id FROM accounts,member WHERE accounts.account_member=member.member_id AND member.member_id='$mbr_id'");
	 	$nmb_accounts = $sel_accounts_mbr->rowCount();
	 	return $nmb_accounts;
	 }
}
//========================================  DISPLAY MY ACCOUNTS AND THEIR BALANCE IN <LI></LI> (in encashment)
function my_mbr_accounts_with_pin($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.account_id,accounts.account_member,member.member_id FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	 if (($se_my_acnt->rowCount())>0) {
	 	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	 	$mbr_id = $ft_se_my_acnt['member_id'];
	 	$sel_accounts_mbr=$conn->query("SELECT accounts.account_member,accounts.account_id,accounts.account_pincode FROM accounts,member WHERE accounts.account_member=member.member_id AND member.member_id='$mbr_id'");
	 	$nmb_accounts = $sel_accounts_mbr->rowCount();
	 	if ($nmb_accounts>=1) {
	 		$account_balance;
	 		while ($ft_sel_accounts_mbr = $sel_accounts_mbr->fetch(PDO::FETCH_ASSOC)) {
	 			$my_aacnt=$ft_sel_accounts_mbr['account_id'];
	 			$account_pincode=$ft_sel_accounts_mbr['account_pincode'];
	 			$sel_bal = $conn->query("SELECT balance_total,balance_account FROM balance WHERE balance_account='$my_aacnt' ORDER BY balance_id DESC LIMIT 1");
	 			$cnt_sel_bal = $sel_bal->rowCount();
	 			if ($cnt_sel_bal>0) {
	 				$ft_sel_bal= $sel_bal->fetch(PDO::FETCH_ASSOC);
	 				$account_balance = $ft_sel_bal['balance_total'];
	 			}else{
	 				$account_balance = "0.00";
	 			}
	 			if (is_numeric($account_balance)) {
	 				$account_balance1=$account_balance;
	 				$account_balance = number_format($account_balance,2);
	 			}
echo "<li class='lixs' currentli='false' account='".$account_pincode."' nn='".$account_balance1."'><span class='fa fa-check check2'></span> ".$account_pincode." : <span class='money-li'>RWF: ".$account_balance."</span></li>";
	 		}
	 	}
	 }
}
//========================================  PROFILE MEMBER NAME
function member_name($me_acc){
$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt= $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$mbr_name = strtoupper($ft_se_my_acnt['member_fname']).' '.ucfirst($ft_se_my_acnt['member_lname']);
	return $mbr_name;
}

//========================================  ALL MEMBER ACCOUNTS BALANCE

function my_all_accounts_balance($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,balance.* FROM accounts,balance WHERE balance.balance_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_balance = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['balance_total'];
			$all_balance+=$av_balance;
		}
	}
	return number_format($all_balance,2);
}

//========================================  ALL MEMBER ACCOUNTS ENCASHED BALANCE

function my_all_accounts_encashed($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,balance.* FROM accounts,balance WHERE balance.balance_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_bal_encashed = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['balance_encashed'];
			$all_bal_encashed+=$av_balance;
		}
	}
	return number_format($all_bal_encashed,2);
}

//========================================  ALL MEMBER ACCOUNTS UPGRADE BALANCE

function my_all_accounts_upgrades($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,balance.* FROM accounts,balance WHERE balance.balance_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_bal_encashed = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['balance_upgrade'];
			$all_bal_encashed+=$av_balance;
		}
	}
	return number_format($all_bal_encashed,2);
}

//========================================  ALL MEMBER ACCOUNTS COMMISSION BALANCE

function my_all_accounts_commission($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,balance.* FROM accounts,balance WHERE balance.balance_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_bal_encashed = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['balance_commission'];
			$all_bal_encashed+=$av_balance;
		}
	}
	return number_format($all_bal_encashed,2);
}


//========================================  ALL MEMBER ACCOUNTS MATCHING BALANCE

function my_all_accounts_matching($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,balance.* FROM accounts,balance WHERE balance.balance_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_bal_encashed = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['balance_matching'];
			$all_bal_encashed+=$av_balance;
		}
	}
	return number_format($all_bal_encashed,2);
}




//========================================  ALL MEMBER ACCOUNTS TOTAL REMAINING

function my_all_accounts_remain($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,balance.* FROM accounts,balance WHERE balance.balance_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_bal_encashed = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['balance_all'];
			$all_bal_encashed+=$av_balance;
		}
	}
	return number_format($all_bal_encashed,2);
}



//========================================  ALL MEMBER ACCOUNTS TAX FEES

function my_all_fee_tax($me_acc ){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,encashment.encash_tax FROM accounts,encashment WHERE encashment.encash_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_bal_encashed = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['encash_tax'];
			$all_bal_encashed+=$av_balance;
		}
	}
	return number_format($all_bal_encashed,2);
}


//========================================  ALL MEMBER ACCOUNTS ENCASHMENT TRANSACTION FEES

function my_all_fee_transaction_fees($me_acc ){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,encashment.encash_sys_fees FROM accounts,encashment WHERE encashment.encash_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_bal_encashed = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['encash_sys_fees'];
			$all_bal_encashed+=$av_balance;
		}
	}
	return number_format($all_bal_encashed,2);
}

//========================================  ALL MEMBER ACCOUNTS ENCASHMENT GROSS

function my_all_encash_gross($me_acc ){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	$my_member_id = $ft_se_my_acnt['member_id'];
	$se_acnts = $conn->query("SELECT accounts.*,encashment.encash_gross_income FROM accounts,encashment WHERE encashment.encash_account=accounts.account_id AND accounts.account_member='$my_member_id'");
	$cnt_se_acnts = $se_acnts->rowCount();
	$all_bal_encashed = 0;
	if ($cnt_se_acnts>=1) {
		while ($ft_se_acnts = $se_acnts->fetch(PDO::FETCH_ASSOC)) {
			$av_balance = $ft_se_acnts['encash_gross_income'];
			$all_bal_encashed+=$av_balance;
		}
	}
	return number_format($all_bal_encashed,2);
}


//======================================================== DISPLAYING DOWNLINES TABLE
function my_all_wons($id){
	$conn = parent::connect();
	$downs = $conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline='$id'");
	if ($downs->rowCount()>=1) {
		while ($ft_downs= $downs->fetch(PDO::FETCH_ASSOC)) {
			echo "<li>".strtoupper($ft_downs['member_fname'])." ".ucfirst($ft_downs['member_lname'])."  <b>  -  ".$ft_downs['account_pincode']."</b></li>";
			if ($downs->rowCount()>=1) {
				//return self::my_all_wons($ft_downs['account_id']);
				$up_nt = $ft_downs['account_id'];
				$sel_ant = $conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline='$up_nt'");
				if ($sel_ant->rowCount()>=1) {
					 $this->my_all_wons($up_nt);
				}
			}
			
		}
	}else{
		// echo $downs->rowCount();
	}
}
function my_downlines_table($me_acc){
$conn  = parent::connect();
	$sel_direct_l = $conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline='$me_acc' AND accounts.account_side='Left'");
	$sel_direct_m = $conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline='$me_acc' AND accounts.account_side='Middle'");
	$sel_direct_r = $conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline='$me_acc' AND accounts.account_side='Right'");
	//$cnt_sel_direct_d = $sel_direct_d->rowCount();
	if (($sel_direct_l->rowCount()>=1) OR ($sel_direct_m->rowCount()>=1) OR ($sel_direct_r->rowCount()>=1)) {
		echo "<table width='100%'align='center'><thead style='text-decoration:underline'> <th>Left Side<br></th> <th>Right Side<br></th> </thead><tbody><br><tr>";
		if ($sel_direct_l->rowCount()==1) {
			$ft_sel_direct_l = $sel_direct_l->fetch(PDO::FETCH_ASSOC);
			$id_up_l = $ft_sel_direct_l['account_id'];
			echo "<td>";
			echo "<li>".strtoupper($ft_sel_direct_l['member_fname'])." ".ucfirst($ft_sel_direct_l['member_lname'])."  <b>  -  ".$ft_sel_direct_l['account_pincode']."</b></li>";
			echo self::my_all_wons($id_up_l);


			echo "</td>";
		}else{
			echo "<td> - </td>";
		}
		// if ($sel_direct_m->rowCount()==1) {
		// 	$ft_sel_direct_m = $sel_direct_m->fetch(PDO::FETCH_ASSOC);
		// 	$id_up_m = $ft_sel_direct_m['account_id'];
		// 	echo "<td>";
		// 	echo "<li>".strtoupper($ft_sel_direct_m['member_fname'])." ".ucfirst($ft_sel_direct_m['member_lname'])."  <b>  -  ".$ft_sel_direct_m['account_pincode']."</b></li>";
		// 	echo self::my_all_wons($id_up_m);

		// 	echo "</td>";
		// }else{
		// 	echo "<td> - </td>";
		// }
		if ($sel_direct_r->rowCount()==1) {
			$ft_sel_direct_r = $sel_direct_r->fetch(PDO::FETCH_ASSOC);
			$id_up_r = $ft_sel_direct_r['account_id'];
			echo "<td>";
			//echo strtoupper($ft_sel_direct_r['member_fname']).' '.ucfirst($ft_sel_direct_r['member_lname']).'  ('.$ft_sel_direct_r['account_pincode'].')<br>';
			echo "<li>".strtoupper($ft_sel_direct_r['member_fname'])." ".ucfirst($ft_sel_direct_r['member_lname'])."  <b>  -  ".$ft_sel_direct_r['account_pincode']."</b></li>";
			echo self::my_all_wons($id_up_r);


			echo "</td>";
		}else{
			echo "<td> - </td>";
		}



	
				echo "</tr></tbody><table>";	
	}else{
		return "<center>Zero downlines</center>";;
	}
}


//========================================  Switching Accounts for agent (if available)
function my_accounts_table($me_acc){
	$conn = parent::connect();
	$se_my_acnt=$conn->query("SELECT accounts.account_id,accounts.account_member,member.member_id FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$me_acc'");
	 if (($se_my_acnt->rowCount())>0) {
	 	$ft_se_my_acnt = $se_my_acnt->fetch(PDO::FETCH_ASSOC);
	 	$mbr_id = $ft_se_my_acnt['member_id'];
	 	$sel_accounts_mbr=$conn->query("SELECT accounts.* FROM accounts,member WHERE accounts.account_member=member.member_id AND member.member_id='$mbr_id' AND account_status!='NY'");
	 	$nmb_accounts = $sel_accounts_mbr->rowCount();
	 	if ($nmb_accounts>=1) {
	 		
	 		echo "<table class='theary'><thead> <th>#</th> <th>Account</th> <th>Left</th> <th>Right</th> <th>All</th> </thead><tbody>";
	 		$cnt =1;
	 		while ($ft_sel_accounts_mbr = $sel_accounts_mbr->fetch(PDO::FETCH_ASSOC)) {
	 			global $cnt_dwn,$m_arr,$lnth,$cnt_dwn_r,$m_arr_r,$lnth_r;	// PAY ATTENTION !!
			 	$cnt_dwn=$m_arr=$lnth=$cnt_dwn_r=$m_arr_r=$lnth_r=0; 		// PAY ATTENTION !!

	 			$accnt_id = $ft_sel_accounts_mbr['account_id'];
	 			$agentt = new AgentAccountData($accnt_id);
			 	echo "<tr>";

			 	echo "<td> <span class='label label-success' style='padding:5px;'>";
			 		echo $cnt.'.';
			 	echo "</span></td>";

			 	echo "<td> <a href='../main/operations.php?chngAcnt=true&acnt=$accnt_id'style='color:blue;font-weight:bolder;' >";
			 		echo $ft_sel_accounts_mbr['account_pincode'];
			 	echo "</a></td>";

			 	echo "<td>";
			 		echo $all_left = $agentt->my_big_side_cont_left($accnt_id)."<br>";

			 	echo "</td>";

				echo "<td> ";
					echo $all_right = $agentt->my_big_side_cont_right($accnt_id)."<br>";
			 	echo "</td>";

				echo "<td> ";
					echo $all_left+$all_right;
			 	echo "</td>";

			 	echo "</tr>";
			 $cnt++;
	 		}
	 echo "</tbody></table>";
	 	}
	 }
}

//========================================================================== FIND MY All MY NUMBER OF DOWNLINES PER SIDE

		//============================ COUNTINOUES COUNTING LEFT
function my_down_side_cont($up_id){
	global $cnt_dwn,$m_arr,$lnth;
	$cnt_dwn+=1;
	if ($cnt_dwn==1) {
		$cnt_dwn=2;
		$m_arr = array(2);
	}
	$conn = parent::connect();
	$sel_don = $conn->query("SELECT account_id,account_pincode,account_upline FROM accounts WHERE account_upline='$up_id'");
	$cnt_sel_don = $sel_don->rowCount();
	if ($cnt_sel_don>0) {
		while ($ft_sel_don = $sel_don->fetch(PDO::FETCH_ASSOC)) {
			//$cnt_dwn+=1;
			array_push($m_arr, $cnt_dwn);
			$lnth =count($m_arr);
			//echo '('.$lnth.')';
			$up_idd = $ft_sel_don['account_id'];
			self::my_down_side_cont($up_idd);
		}
		
	}else{
		//array_push($m_arr, $cnt_dwn);
		return "No";
	}
}

			//============================ COUNTING LEFT SIDE
function my_big_side_cont_left($my_id_lft){
	$conn = parent::connect();
	$sel_left = $conn->query("SELECT account_id,account_pincode,account_upline FROM accounts WHERE account_upline='$my_id_lft' AND account_side='Left'");
	$cnt_sel_left = $sel_left->rowCount();
	if ($cnt_sel_left>0) {
		$cnt_dwn = 0;		
		while ($ft_sel_left = $sel_left->fetch(PDO::FETCH_ASSOC)) {
			$cnt_dwn++;
			$my_idd = $ft_sel_left['account_id'];
			//array_push($m_arr, $cnt_dwn);
			$m_arr = array($cnt_dwn);
			self::my_down_side_cont($my_idd);
			//echo "-".$cnt_dwn."-";
			global $lnth;
			if ($cnt_dwn>=$lnth) {
				return $cnt_dwn;
			}else{
				return $lnth;
			}
			}
	}else{
		return 0;
	}
}


		//============================ COUNTINOUES COUNTING RIGHT
function my_down_side_cont_r($up_id_r){
	global $cnt_dwn_r,$m_arr_r,$lnth_r;
	$cnt_dwn_r+=1;
	if ($cnt_dwn_r==1) {
		$cnt_dwn_r=2;
		$m_arr_r = array(2);
	}
	$conn_r = parent::connect();
	$sel_don_r = $conn_r->query("SELECT account_id,account_pincode,account_upline FROM accounts WHERE account_upline='$up_id_r'");
	$cnt_sel_don_r = $sel_don_r->rowCount();
	if ($cnt_sel_don_r>0) {
		while ($ft_sel_don_r = $sel_don_r->fetch(PDO::FETCH_ASSOC)) {
			//$cnt_dwn+=1;
			array_push($m_arr_r, $cnt_dwn_r);
			$lnth_r =count($m_arr_r);
			//echo '('.$lnth.')';
			$up_idd_r = $ft_sel_don_r['account_id'];
			self::my_down_side_cont_r($up_idd_r);
		}
		
	}else{
		//array_push($m_arr, $cnt_dwn);
		return "No";
	}
}

			//============================ COUNTING RIGHT SIDE
function my_big_side_cont_right($my_id_lft_r){
	$conn_r = parent::connect();
	$sel_left_r = $conn_r->query("SELECT account_id,account_pincode,account_upline FROM accounts WHERE account_upline='$my_id_lft_r' AND account_side='Right'");
	$cnt_sel_left_r = $sel_left_r->rowCount();
	if ($cnt_sel_left_r>0) {
		$cnt_dwn_r = 0;		
		while ($ft_sel_left_r = $sel_left_r->fetch(PDO::FETCH_ASSOC)) {
			$cnt_dwn_r++;
			$my_idd_r = $ft_sel_left_r['account_id'];
			//array_push($m_arr, $cnt_dwn);
			$m_arr_r = array($cnt_dwn_r);
			self::my_down_side_cont_r($my_idd_r);
			//echo "-".$cnt_dwn."-";
			global $lnth_r;
			if ($cnt_dwn_r>=$lnth_r) {
				return $cnt_dwn_r;
			}else{
				return $lnth_r;
			}
			}
	}else{
		return 0;
	}
}


//============================================================ MY  DAILY SPONSORING BONUS

function my_daily_sponsiring_bonus($myId){
	$conn = parent::connect();
	$sel_bla_sponso_bonus = $conn->query("SELECT SUM(balance_daily_sponsor) AS ttl_balance,balance_account FROM balance WHERE balance_account='$myId'");
	if ($sel_bla_sponso_bonus->rowCount()>=1) {
		$ft_sel_bla_sponso_bonus = $sel_bla_sponso_bonus->fetch(PDO::FETCH_ASSOC);
		$all_my_spons = $ft_sel_bla_sponso_bonus['ttl_balance'];
		return number_format($all_my_spons,2);
	}else{
		return number_format(0,2);
	}
}
//============================================================ MY DIRECT SPONSORING BONUS

function my_dorect_sponsiring_bonus($myId){
	$conn = parent::connect();
	$sel_bla_sponso_bonus = $conn->query("SELECT SUM(balance_direct_sponsors) AS ttl_blnc_drct,balance_account FROM balance WHERE balance_account='$myId'");
	if ($sel_bla_sponso_bonus->rowCount()>=1) {
		$ft_sel_bla_sponso_bonus = $sel_bla_sponso_bonus->fetch(PDO::FETCH_ASSOC);
		$all_my_spons = $ft_sel_bla_sponso_bonus['ttl_blnc_drct'];
		return number_format($all_my_spons,2);
	}else{
		return number_format(0,2);
	}
}


//================================================================ ENCASHMENT HISTORY
function encashment_history($myId){
	$conn = parent::connect();
	$sel_enc = $conn->query("SELECT * FROM encashment  WHERE encash_account='$myId' ORDER BY encash_status DESC,encash_id DESC");
	if ($sel_enc->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax (17%)</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";

		echo "</thead><tbody>";
		$cntt = 1;
		while ($ft_sel_enc = $sel_enc->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc['encash_date'];
			$enc_net_income = $ft_sel_enc['encash_net_income'];
			$enc_tax = $ft_sel_enc['encash_tax'];
			$enc_sys_fs = $ft_sel_enc['encash_sys_fees'];
			$enc_before = $ft_sel_enc['encash_before'];
			$enc_remain = $ft_sel_enc['encash_remain'];
			$enc_earned = $ft_sel_enc['encash_gross_income'];
			$enc_meth = $ft_sel_enc['encash_type'];
			$enc_status = $ft_sel_enc['encash_status'];
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$enc_tax."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
					}
		echo "</tbody></table>";
	}else{
		echo "<center><h3>No Encashment Available for this activated account</h3></center>";
	}
}





}











//==================================================================================================================================
//==================================================================================================================================
//=============================================================          ===========================================================
//======================================================    ADMIN DATA ANALYSIS    =================================================
//==============================================================         ===========================================================
//==================================================================================================================================
//==================================================================================================================================

class AdminAccountData extends DbConnects
{
//====================================================================================== DISPLAY ADMIN NAME
	function admin_name($admin_id)
	{
		$conn = parent::connect();
		$sel_adm = $conn->query("SELECT * FROM staff WHERE staff_category='Admin' AND staff_id = '$admin_id'");
		$ft_sel_adm = $sel_adm->fetch(PDO::FETCH_ASSOC);
		$dmin_name = strtoupper($ft_sel_adm['staff_fname']).' '.ucfirst($ft_sel_adm['staff_lname']);
		return $dmin_name;
	}


//====================================================================================== ADMIN ENCASHMENT LIST (REQUEST)

function admin_encashment_list_request(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead class='th_1'>";
		echo "<th colspan=13>All encashment list</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";
		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";
		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Encashment Available</h3></center>";
	}
}

//====================================================================================== EQUITY_BANK ADMIN ENCASHMENT LIST (REQUEST)

function equity_admin_encashment_list_request(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_type=2 ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead class='th_1'>";
		echo "<th colspan=13>Equity bank encashment list</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";
		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Encashment Available for Equity-Bank payment </h3></center>";
	}
}

//====================================================================================== MTN MOMO ADMIN ENCASHMENT LIST (REQUEST)

function mtn_admin_encashment_list_request(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_type=1 ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead class='th_1'>";
		echo "<th colspan=13>MTN-MobileMoney encashment list</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";
		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Encashment Available for MTN Mobile-Money payment.</h3></center>";
	}
}


//====================================================================================== CASH ADMIN ENCASHMENT LIST (REQUEST)

function cash_admin_encashment_list_request(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_type='' OR encash_type=0 OR encash_type=null ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead class='th_1'>";
		echo "<th colspan=13>Cash encashment list</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";
		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Cash encashment available.</h3></center>";
	}
}


//====================================================================================== REGISTER ON BALANCE ADMIN ENCASHMENT LIST

function register_on_balance_encashment_list(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_type=-1 ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead class='th_1'>";
		echo "<th colspan=13>Balance-Registration encashment list</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";
		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Balance Registration Encashment Available.</h3></center>";
	}
}

//====================================================================================== CONFIRMED ENCASHMENT LIST  (Done)

function confirmed_encashment_list(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_status='E' ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead class='th_1'>";
		echo "<th colspan=13>Terminated encashment list</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";
		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Terminated Encashment Available.</h3></center>";
	}
}


//====================================================================================== PENDING ENCASHMENT LIST

function pending_encashment_list(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_status='NY' ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl' id='encashment1'>
		<thead class='th_1'>";
		echo "<th colspan=13>Pending encashment list
		<button class='prints printer' ref='#encashment1'>Print</button>
		</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";
		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Pending Encashment Available.</h3></center>";
	}
}

//====================================================================================== PENDING EQUITY ENCASHMENT LIST

function pending_equity_encashment_list(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_status='NY' AND encash_type=2 ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead class='th_1'>";
		echo "<th colspan=13>Equity-Bank (Pending) encashment list</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";
		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Equity-Bank (Pending) Encashment available.</h3></center>";
	}
}

//====================================================================================== PENDING MTN ENCASHMENT LIST

function pending_mtn_encashment_list(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_status='NY' AND encash_type=1 ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Sys-Fees</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";

		echo "</thead><tbody>";
		$cntt=1;
$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;

		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;
		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No MTN Mobile-Money (Pending) encashment available.</h3></center>";
	}
}

//====================================================================================== PENDING CASH ENCASHMENT LIST

function pending_cash_encashment_list(){
	$conn = parent::connect();
	$sel_enc_lst = $conn->prepare("SELECT * FROM encashment WHERE encash_status='NY' AND (encash_type='' OR encash_type=0 OR encash_type=null) ORDER BY encash_status DESC, encash_id DESC");
	$sel_enc_lst->execute();
	if ($sel_enc_lst->rowCount()>0) {
		echo "<table class='encashment-tbl'><thead class='th_1'>";
		echo "<th colspan=13>Cash (Pending) encashment list</th>";
		echo "</thead>";
		echo "<thead class='th_2'>";

		echo "<th>#</th>";
		echo "<th>Time</th>";
		echo "<th>User names</th>";
		echo "<th>Account-pincode</th>";
		echo "<th>Encashed Value</th>";
		echo "<th>Tax</th>";
		echo "<th>Sys-Fees</th>";
		echo "<th>Trans-Fees</th>";
		echo "<th>Encash fees</th>";
		echo "<th>Earned</th>";
		echo "<th>Balance before encashment</th>";
		echo "<th>Balance Remaining</th>";
		echo "<th>Encashment Method</th>";
		echo "<th>Request Status</th>";

		echo "</thead><tbody>";
		$cntt=1;
		$enc_net_income_ttl=$enc_sys_fs_ttl=$enc_before_ttl=$enc_remain_ttl=$enc_earned_ttl=$en_tx_ttl=$en_trns_ttl=0;
		while ($ft_sel_enc_lst = $sel_enc_lst->fetch(PDO::FETCH_ASSOC)) {
			$enc_date = $ft_sel_enc_lst['encash_date'];
			$enc_net_income = $ft_sel_enc_lst['encash_net_income'];
			$enc_tax = $ft_sel_enc_lst['encash_tax'];
			$enc_sys_fs = $ft_sel_enc_lst['encash_sys_fees'];
			$enc_before = $ft_sel_enc_lst['encash_before'];
			$enc_remain = $ft_sel_enc_lst['encash_remain'];
			$enc_earned = $ft_sel_enc_lst['encash_gross_income'];
			$enc_meth = $ft_sel_enc_lst['encash_type'];
			$enc_status = $ft_sel_enc_lst['encash_status'];
			$enc_acc_id = $ft_sel_enc_lst['encash_account'];
			$en_tx = $enc_tax*15/17;
			$en_trns = $enc_tax*2/17;
			$sel_en_accnt_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$enc_acc_id'");
			$sel_en_accnt_mbr->execute();
			if ($sel_en_accnt_mbr->rowCount()==1) {
				$ft_sel_en_accnt_mbr = $sel_en_accnt_mbr->fetch(PDO::FETCH_ASSOC);
				$account_ppincode = $ft_sel_en_accnt_mbr['account_pincode'];
				$account_full_name = strtoupper($ft_sel_en_accnt_mbr['member_fname'])."_".ucfirst($ft_sel_en_accnt_mbr['member_lname']);
			}else{
				echo "Unexpected system error. Please contact system administrator for help.";
			}
			switch ($enc_meth) {
				case -1:
					$enc_meth = "On Balance Reg";
					break;
				case 0 or null:
					$enc_meth = "By Cash";
					break;
				case 1:
					$enc_meth = "By MTN";
					break;
				case 2:
					$enc_meth = "By Equit";
					break;
				
				default:
					# code...
					break;
			}
			$stts_res;
			switch ($enc_status) {
				case 'E':
					$stts_res = "<span style='color:green'>Done</span>";
					break;
				case 'NY':
					$stts_res = "<span style='color:#4a1d79;'>Pending</span>";
					break;
				
				default:
					$stts_res = "<span style='color:red'>--</span>";
					break;
			}
			//$enc_status = $ft_sel_enc['encash_status'];
			echo "<tr>";

			echo "<td>".$cntt.". </td>";
			echo "<td><i style='font-size:14px;'>".date('D, d/m/Y-H:i:s',strtotime($enc_date))."</i></td>";
			echo "<td><b>".$account_full_name."</b></td>";
			echo "<td>".$account_ppincode."</td>";
			echo "<td><i><u>".number_format($enc_net_income,2)."</u></i></td>";
			echo "<td>".$en_tx."</td>";
			echo "<td>".$en_trns."</td>";
			echo "<td>".number_format($enc_sys_fs,2)."</td>";
			echo "<td><b>".number_format($enc_earned,2)."</b></td>";
			echo "<td>".number_format($enc_before,2)."</td>";
			echo "<td>".number_format($enc_remain,2)."</td>";
			echo "<td>".$enc_meth."</td>";
			echo "<td><i><b>".$stts_res."</b></i></td>";

			echo "</tr>";
			$cntt++;
			$enc_net_income_ttl+=$enc_net_income;
			
			$enc_sys_fs_ttl+=$enc_sys_fs;
			$enc_before_ttl+=$enc_before;
			$enc_remain_ttl+=$enc_remain;
			$enc_earned_ttl+=$enc_earned;
			$en_tx_ttl+=$en_tx;
			$en_trns_ttl+=$en_trns;		}
		echo "</tbody><tfoot>";
		echo "<th colspan=4> Total: #(Rwf)</th>";
		echo "<th>".number_format($enc_net_income_ttl,2)."</th>";
		echo "<th>".$en_tx_ttl."</th>";
		echo "<th>".$en_trns_ttl."</th>";

		echo "<th>".number_format($enc_sys_fs_ttl,2)."</th>";
		echo "<th>".number_format($enc_earned_ttl,2)."</th>";
		echo "<th>".number_format($enc_before_ttl,2)."</th>";
		echo "<th>".number_format($enc_remain_ttl,2)."</th>";
		echo "<th>-</th>";
		echo "<th>-</th>";


		echo "</tfoot></table>";
	}else{
		echo "<center><h3>No Cash (Pending) encashment available.</h3></center>";
	}
}





















}












?>
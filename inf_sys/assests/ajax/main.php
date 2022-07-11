<script type='text/javascript' src='../assests/jquery/jquery.min.js'></script>
<?php
@session_start();
require_once("funcs.php");
if (isset($_SESSION['member']['id'])) {
	$my_acount_id= $_SESSION['member']['id'];
}else if (isset($_SESSION['admin']['id'])) {
	$my_acount_id= $_SESSION['admin']['id'];
}

//====================================================================================================== CONNECTION
class DbConnect
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
			echo "Database Error ".$e->getMessage();
			return null;
		}
	}
}

//================================================================================================================ AUTOLOADS
//================================================ SELECT COUNTRIES
class CountriesSel extends DbConnect
{

	function __construct()
	{
		$conn=parent::connect();
		$cnts=$conn->query("SELECT num_code,en_short_name FROM countries");
		if (($cnts->rowCount())>=1) {
			echo "<option value=''>---Select Country---</option>";
			while ($ft_cnts=$cnts->fetch(PDO::FETCH_ASSOC)) {
				if ($ft_cnts['num_code']==646) {
					echo "<option selected='true' value='".$ft_cnts['num_code']."'>".$ft_cnts['en_short_name']."</option>";
				}else{
					echo "<option value='".$ft_cnts['num_code']."'>".$ft_cnts['en_short_name']."</option>";
				}
			}
		}
	}
}
if (isset($_GET['selCountry'])) {
	$CountriesSel = new CountriesSel();
}
// ======================================================================================================================= LOGIN

class Login extends DbConnect{
	function __construct($unm,$upss){
		$conn=parent::connect();
		$lgn_admin = $conn->prepare("SELECT * FROM staff WHERE staff_username=? AND staff_password=? AND staff_category=?");
		$lgn_admin->bindValue(1,$unm);
		$lgn_admin->bindValue(2,$upss);
		$lgn_admin->bindValue(3,'Admin');
		$lgn_admin->execute();
		$cnt_lgn_admin = $lgn_admin->rowCount();
		$ftc_lgn_admin = $lgn_admin->fetch(PDO::FETCH_ASSOC);
		if ($cnt_lgn_admin==1) {
			echo "Login successful | Redirecting ...";
			$_SESSION['category']="Admin";
			$_SESSION['admin']['id'] = $ftc_lgn_admin['staff_id'];
			$_SESSION['admin']['status'] = $ftc_lgn_admin['staff_category'];
				//====UPDATE DISTRIBUTERS UPGRADES
				$UpdateUpgrade = new UpdateUpgrade();
				//====UPDATE DISTRIBUTERS MATCHINGS
				//$UpdateMatching = new UpdateMatching();	
			echo "<script>window.location='../Admin/'</script>";
		}else{
			$lgn_agent = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_pincode=? AND member.member_password=?");
			$lgn_agent->bindValue(1,$unm);
			$lgn_agent->bindValue(2,$upss);
			$lgn_agent->execute();
			$cnt_lgn_agent = $lgn_agent->rowCount();
			$ftc_lgn_agent = $lgn_agent->fetch(PDO::FETCH_ASSOC);
			if ($cnt_lgn_agent==1) {
				echo "Login successful | Redirecting ...";
				$_SESSION['category']="Agent";
				$_SESSION['member']['id'] = $ftc_lgn_agent['account_id'];
				$_SESSION['member']['name'] = $ftc_lgn_agent['member_fname']." ".$ftc_lgn_agent['member_lname'];
					//====UPDATE DISTRIBUTERS UPGRADES
					$UpdateUpgrade = new UpdateUpgrade();
					//====UPDATE DISTRIBUTERS MATCHINGS
					//$UpdateMatching = new UpdateMatching();	
				echo "<script>window.location='../agent/'</script>";
			}else{
						$lgn_shareholder = $conn->prepare("SELECT * FROM staff WHERE staff_username=? AND staff_password=? AND staff_category=?");
						$lgn_shareholder->bindValue(1,$unm);
						$lgn_shareholder->bindValue(2,$upss);
						$lgn_shareholder->bindValue(3,'Shareholder');
						$lgn_shareholder->execute();
						$cnt_lgn_shareholder = $lgn_shareholder->rowCount();
						$ftc_lgn_shareholder = $lgn_shareholder->fetch(PDO::FETCH_ASSOC);
				if ($cnt_lgn_shareholder==1) {
						echo "Login successful | Redirecting ...";
						$_SESSION['category']="Shareholder";
						$_SESSION['shareholder']['id'] = $ftc_lgn_shareholder['staff_id'];
						$_SESSION['shareholder']['status'] = $ftc_lgn_shareholder['staff_category'];
						echo "<script>window.location='../shareholder/'</script>";
					}else{
							$lgn_reception = $conn->prepare("SELECT * FROM employee WHERE employee_username=? AND employee_password=? AND employee_category=?");
							$lgn_reception->bindValue(1,$unm);
							$lgn_reception->bindValue(2,$upss);
							$lgn_reception->bindValue(3,'Reception');
							$lgn_reception->execute();
							$cnt_lgn_reception = $lgn_reception->rowCount();
							$ftc_lgn_reception = $lgn_reception->fetch(PDO::FETCH_ASSOC);
							if ($cnt_lgn_reception==1) {
								echo "Login successful | Redirecting ...";
								$_SESSION['category']="Reception";
								$_SESSION['reception']['id'] = $ftc_lgn_reception['employee_id'];
								$_SESSION['reception']['status'] = $ftc_lgn_reception['employee_category'];
								echo "<script>window.location='../reception/'</script>";
						}else{
								$lgn_accoutant = $conn->prepare("SELECT * FROM employee WHERE employee_username=? AND employee_password=? AND employee_category=?");
								$lgn_accoutant->bindValue(1,$unm);
								$lgn_accoutant->bindValue(2,$upss);
								$lgn_accoutant->bindValue(3,'Accoutant');
								$lgn_accoutant->execute();
								$cnt_lgn_accoutant = $lgn_accoutant->rowCount();
								$ftc_lgn_accoutant = $lgn_accoutant->fetch(PDO::FETCH_ASSOC);
								if ($cnt_lgn_accoutant==1) {
									echo "Login successful | Redirecting ...";
									$_SESSION['category']="Accoutant";
									$_SESSION['accoutant']['id'] = $ftc_lgn_accoutant['employee_id'];
									$_SESSION['accoutant']['status'] = $ftc_lgn_accoutant['employee_category'];
									echo "<script>window.location='../accoutant/'</script>";
							}else{
								echo "<script>setContN('resp_n','Wrong Username or Password ...');</script>";
							}
						}
				}

		}
	}
}
}
if (isset($_GET['mLogin'])) {
	$name = get_input("uname");
	$pass = get_input("upass");
	$Login = new Login($name,$pass);
}



//============================================================================================================================ LOGOUT
if (isset($_GET['lg'])) {
	switch ($_GET['cat']) {
		case 'Admin':
			logout();
			header("location:../../login");
			break;
		case 'Agent':
			logout();
			header("location:../../login");
			break;
		case 'Shareholder':
			logout();
			header("location:../../login");
			break;
		case 'Reception':
			logout();
			header("location:../../login");
			break;
		case 'Accoutant':
			logout();
			header("location:../../login");
			break;

		default:
			logout();
			header("location:../../login");
			break;
	}
}

//======================================================================================================= CHECK UPLINE  (Admin)
class PinCheck extends DbConnect
{

	function __construct($pincode)
	{
		$conn = parent::connect();
		$sele = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_pincode=?");
		$sele->bindValue(1,$pincode);
		$sele->execute();
		$cnt_sele = $sele->rowCount();
		if ($cnt_sele==1) {
			$ftc_sele = $sele->fetch(PDO::FETCH_ASSOC);
			if ($ftc_sele['account_status']!='E') {
				echo "<center><b>".ucfirst('unverified Referee-PINCODE')."</b></center>";
			}else{
				echo "<table><tr><td>Pincode:</td><td> <b>".$ftc_sele['account_pincode']."</b></td></tr>";
				echo "<tr><td>Name:</td><td> <b>".$ftc_sele['member_fname']." ".$ftc_sele['member_lname']."</b></td></tr>";
				echo "<tr><td>Level:</td><td> <b>".$ftc_sele['account_level']."</b></td></tr>";
			}
		}else{
			echo "<center><b>Invalid Referee-PINCODE</b></center>";
		}
	}
}
if (isset($_GET['checkUpline'])) {
		$PinCheck = new PinCheck(get_input('upcode'));
}


//===================================================================================================== ADD DISTRIBUTOR  (Admin)

class AddDistributor extends DbConnect
{

	function __construct($upline,$d_fname,$d_lname,$d_phone,$d_acnts)
	{
		$conn = parent::connect();
		$sele = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_pincode=? AND account_status=?");
		$sele->bindValue(1,$upline);
		$sele->bindValue(2,'E');
		$sele->execute();
		$cnt_sele = $sele->rowCount();
		if ($cnt_sele==1) {
			$ftc_sele = $sele->fetch(PDO::FETCH_ASSOC);
			$fname= $d_fname;
			$lname= $d_lname;
			$ins_distr = $conn->prepare("INSERT INTO member(member_fname,member_lname,member_status,member_phone) VALUES(?,?,?,?)");
			$ins_distr->bindValue(1,$fname);
			$ins_distr->bindValue(2,$lname);
			$ins_distr->bindValue(3,'NY');
			$ins_distr->bindValue(4,$d_phone);
			$ins_ok=$ins_distr->execute();
			if ($ins_ok) {
				$sel_mbr=$conn->prepare("SELECT * FROM member WHERE member_fname=? AND member_lname=? AND member_phone=? AND member_status=? ORDER BY member_id DESC LIMIT 1");
				$sel_mbr->bindValue(1,$d_fname);
				$sel_mbr->bindValue(2,$d_lname);
				$sel_mbr->bindValue(3,$d_phone);
				$sel_mbr->bindValue(4,'NY');
				$sel_mbr->execute();
				$cnt_sel_mbr=$sel_mbr->rowCount();
				if ($cnt_sel_mbr==1) {
					$ft_sel_mbr=$sel_mbr->fetch(PDO::FETCH_ASSOC);
					$sel_all_act =$conn->prepare("SELECT * FROM accounts");
					if ($d_acnts==1) {		//================= if account is one
						$pincde;
						$fft=$sel_all_act->fetch(PDO::FETCH_ASSOC);
						$scnt_pincde = $fft['account_pincode'];
						if ($scnt_pincde!=("IF".rand(100000,999999))) {
							$pincde = rand(100000,999999);
						}else{
							while ($scnt_pincde!=("IF".rand(100000,999999))) {
								$pincde = rand(100000,999999);
							}
						}
						$new_pincode="IF".$pincde;
							try{
								$ins_acnt=$conn->prepare("INSERT INTO accounts(account_member,account_referee,account_pincode,account_status) VALUES(?,?,?,?)");
								$ins_acnt->bindValue(1,$ft_sel_mbr['member_id']);
								$ins_acnt->bindValue(2,$ftc_sele['account_id']);
								$ins_acnt->bindValue(3,$new_pincode);
								$ins_acnt->bindValue(4,'NY');
								$ins_acnt_ok = $ins_acnt->execute();
								if ($ins_acnt_ok) {
									echo "<script>setContN('resp_upl_y','<center><span style=\'color:green;text-align:center\'>Pincode generated successful ...</span></center>');document.getElementById('distr_name').value=' ';</script>";
									//=================================================== DISPLAYING GENERATED MEMBERS PINCODES
									$sel_gen = $conn->prepare("SELECT member.*,accounts.* FROM member,accounts WHERE accounts.account_member=member.member_id AND accounts.account_referee=? AND accounts.account_status=? ORDER BY accounts.account_registration_date DESC");
									$sel_gen->bindValue(1,$ftc_sele['account_id']);
									$sel_gen->bindValue(2,'NY');
									$sel_gen_ok = $sel_gen->execute();
									echo "<table><thead> <th>#</th>  <th>Names</th>  <th>Pincode</th>  </thead>";
									$cnnntt =1;
									while ($ft_sel_gen = $sel_gen->fetch(PDO::FETCH_ASSOC)) {
										echo "<tr><td>".$cnnntt.". </td><td>".strtoupper($ft_sel_gen['member_fname'])." ".ucfirst($ft_sel_gen['member_lname']).": </td><td><b>".$ft_sel_gen['account_pincode']."<b></td></tr>";
										$cnnntt++;
									}
									echo "</table>";

								}else{
									echo "Failed to generate PIncode ...";
								}
							}catch(PDOException $ee){
								$ee->getMessage();
							}
					}else if ($d_acnts>1){			// ACOUNTS ARE MORE THAT MORE THAN ONE
						$mypin = array();
						$mypin_code = array();
						for ($i=0; $i <$d_acnts ; $i++) {
								$pincde;
								$fft=$sel_all_act->fetch(PDO::FETCH_ASSOC);
								$scnt_pincde = $fft['account_pincode'];
								if ($scnt_pincde!=("IF".rand(100000,999999))) {
									$pincde = rand(100000,999999);
									$mypin[$i]=$pincde;
								}else{
									while ($scnt_pincde!=("IF".rand(100000,999999))) {
										$pincde = rand(100000,999999);
										$mypin[$i]=$pincde;
									}
								}
								$new_pincode="IF".$pincde;
								$mypin_code[$i]="IF".$mypin[$i];

						}
//===============================================
								$str=0;
								foreach ($mypin_code as $key_pin => $value_pin) {
							try{
								$ins_acnt=$conn->prepare("INSERT INTO accounts(account_member,account_referee,account_pincode,account_status) VALUES(?,?,?,?)");
								$ins_acnt->bindValue(1,$ft_sel_mbr['member_id']);
								//$ins_acnt->bindValue(2,$ftc_sele['account_sponsor']);
								$ins_acnt->bindValue(2,$ftc_sele['account_id']);
								$ins_acnt->bindValue(3,$value_pin);
								$ins_acnt->bindValue(4,'NY');
								$ins_acnt_ok = $ins_acnt->execute();
								$str;
								if ($ins_acnt_ok) {
									echo "<script>setContN('resp_upl_y','<center><span style=\'color:green;text-align:center\'>Pincode generated successful ...</span></center>');</script>";
									echo "<script>document.getElementById('distr_name').value=' ';</script>";
									$str = 1;
								}else{
									$str = 0;
									echo "Generated Pincode has been taken, try again...<br>";
									//print_r($ins_acnt->errorInfo());
								}
							}catch(PDOException $ee){
								$ee->getMessage();
							}
								}
//================================================
					if ($str==1) {
						//=================================================== DISPLAYING GENERATED MEMBERS PINCODES
						$sel_gen = $conn->prepare("SELECT member.*,accounts.* FROM member,accounts WHERE accounts.account_member=member.member_id AND accounts.account_referee=? AND accounts.account_status=? ORDER BY accounts.account_registration_date DESC");
						$sel_gen->bindValue(1,$ftc_sele['account_id']);
						$sel_gen->bindValue(2,'NY');
						$sel_gen_ok = $sel_gen->execute();
						echo "<table><thead> <th>#</th>  <th>Names</th>  <th>Pincode</th>  </thead>";
						$cnnnt =1;
						while ($ft_sel_gen = $sel_gen->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr><td>".$cnnnt.". </td><td>".strtoupper($ft_sel_gen['member_fname'])." ".ucfirst($ft_sel_gen['member_lname']).": </td><td><b>".$ft_sel_gen['account_pincode']."<b></td></tr>";
							$cnnnt++;
						}
						echo "</table>";
					}else{
						echo "Something went wrong";
					}
					}else{							// ======================= WHEN THE ENTERED NUMBER IS LESS THA ZERO
						echo "Invalid account number";
					}


					}else{
						echo $sel_mbr->errorInfo();
					}
			}else{
				echo $ins_distr->errorInfo();
			}
		}else{
			echo "<center id='resp'><b>Invalid Referee-PINCODE</b></center>";
		}
	}
}
if (isset($_GET['addDistributor'])) {
	$AddDistributor = new AddDistributor(get_input('ref'),get_input('dist_fname'),get_input('dist_lname'),get_input('dist_phone'),get_input('dist_accounts'));
}



//==================================================================================== REGISTERING DISTRIBUTOR

class Distributor extends DbConnect
{

	function __construct($fnm,$lnm,$pin,$upl,$spnsr,$side,$nid,$dob,$gndr,$email,$cntry,$city,$unme,$upss)
	{
		$conn=parent::connect();
		$sel_upln=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_pincode='$upl'");
		$cnt_upln=$sel_upln->rowCount();
		$ftc_upln=$sel_upln->fetch(PDO::FETCH_ASSOC);
		if ($cnt_upln==1) {
			$sel_spnsr=$conn->query("SELECT * FROM accounts WHERE account_pincode='$spnsr'");
			$cnt_spr=$sel_spnsr->rowCount();
			$ftc_spr=$sel_spnsr->fetch(PDO::FETCH_ASSOC);
			if ($cnt_spr==1) {
					$sel_pin=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_pincode='$pin'");
					$cnt_pin=$sel_pin->rowCount();
					$ftc_pin=$sel_pin->fetch(PDO::FETCH_ASSOC);
					if ($cnt_pin==1) {
						$ft_pin=$sel_pin->fetch(PDO::FETCH_ASSOC);
						$ft_pin_id=$ft_pin['account_id'];
						$sel_pin_3=$conn->query("SELECT * FROM accounts WHERE account_sponsor='$ft_pin_id' AND account_status='E'");
						$cnt_pin_3=$sel_pin_3->rowCount();
						if ($cnt_pin_3<3) {
									$pin_member_id = $ft_pin['account_member'];
									$supr_member_id = $ftc_spr['account_member'];
									
									$upl_level=$ftc_upln['account_level'];
									$spnsr_level=$ftc_spr['account_level'];
									$pin_level=$upl_level+1;
									$pin_iid=$ftc_pin['account_id'];
									$member_id=$ftc_pin['account_member'];
									$upl_id=$ftc_upln['account_id'];
									$spr_id=$ftc_spr['account_id'];
									if ($ftc_pin['account_level']!=null) {
										echo "Unsupported Upline Level";
									}else{
										$sel_upl_side=$conn->query("SELECT * FROM accounts WHERE account_upline='$upl_id' AND account_side='$side'");
										$cnt_sside=$sel_upl_side->rowCount();
										if (($cnt_sside)>=1) {
											echo "This upline side has taken";
										}else{
											if (!isset($_GET['confirmed'])) {
												if(strtolower($fnm)!=strtolower($ftc_pin['member_fname'])){
											echo "Unrecognized names..";
										}elseif(strtolower($lnm)!=strtolower($ftc_pin['member_lname'])){
											echo "Unrecognized names";
										}else{
											echo "Do you really want to register <b><u>".ucfirst($fnm.' '.$lnm)."</u></b> on <u>".ucfirst($ftc_upln['member_fname'].' '.$ftc_upln['member_lname'])."</u> 's ".$side." side ?";
										}

											}else{
												//$pin_level+=1;
												$upd_acnt=$conn->prepare("UPDATE accounts SET account_upline=?,account_sponsor=?,account_level=?,account_side=?,account_status=? WHERE account_id =?");
												$upd_acnt->bindValue(1,$upl_id);
												$upd_acnt->bindValue(2,$spr_id);
												$upd_acnt->bindValue(3,$pin_level);
												$upd_acnt->bindValue(4,$side);
												$upd_acnt->bindValue(5,'E');
												$upd_acnt->bindValue(6,$pin_iid);
												$upd_acnt_ok = $upd_acnt->execute();
												if ($upd_acnt_ok) {
													$upd_membr=$conn->prepare("UPDATE member SET member_dob=?,member_nid=?,member_gender=?,member_email=?,member_country=?,member_city=?,member_password=?,member_password_key=?,member_status=? WHERE member_id=?");
													$upd_membr->bindValue(1,$dob);
													$upd_membr->bindValue(2,$nid);
													$upd_membr->bindValue(3,$gndr);
													$upd_membr->bindValue(4,$email);
													$upd_membr->bindValue(5,$cntry);
													$upd_membr->bindValue(6,$city);
													//$upd_membr->bindValue(7,$unme);
													$upd_membr->bindValue(7,$upss);
													$upd_membr->bindValue(8,$upss);
													$upd_membr->bindValue(9,'E');
													$upd_membr->bindValue(10,$member_id);
													$upd_membr_ok=$upd_membr->execute();
													if ($upd_membr_ok) {
															//====GIVING COMMISSION TO DISTRUBUTOR
														$upline_ac_id=$ftc_upln['account_id'];
														$dist_ac_id=$ftc_pin['account_id'];
														$give_com=$conn->prepare("INSERT INTO gain(gain_owner,gain_category,gain_origin,gain_status) VALUES(?,?,?,?)");
														$give_com->bindValue(1,$spr_id);
														$give_com->bindValue(2,1);
														$give_com->bindValue(3,$dist_ac_id);
														$give_com->bindValue(4,'NY');
														$give_com_ok=$give_com->execute();
														if ($give_com_ok) {
															
															//====UPDATE DISTRIBUTERS UPGRADES
															//$UpdateUpgrade = new UpdateUpgrade();
															//====UPDATE DISTRIBUTERS MATCHINGS
															//$UpdateMatching = new UpdateMatching();	
															//====UPDATE BALANCES
															// if ($spr_id==$_SESSION['member']['id']) {
															// 	new DailySponsor();
															// }
														//======================== UPDATE DALIY SPONSORING BONUS
															$sel_dl = $conn->query("SELECT * FROM accounts WHERE account_id='$spr_id'");
															if ($sel_dl->rowCount()==1) {
																$sel_today = $conn->query("SELECT * FROM accounts WHERE account_sponsor='$spr_id' AND LEFT(account_registration_date,10)='".date("Y-m-d")."'");
																if ($sel_today->rowCount()>1) {
																	$ft_sel_dl = $sel_dl->fetch(PDO::FETCH_ASSOC);
																	$pprz_ac = $ft_sel_dl['account_id'];
																	$sel_prz_bl = $conn->query("SELECT * FROM balance WHERE balance_account='$pprz_ac' ORDER BY balance_id DESC LIMIT 1");
																	if ($sel_prz_bl->rowCount(PDO::FETCH_ASSOC)>0) {
																		$ft_sel_prz_bl = $sel_prz_bl->fetch(PDO::FETCH_ASSOC);

																		$sdly_av_bl_dr_spns = $ft_sel_prz_bl['balance_daily_sponsor'];
																		$sdly_av_bl_all = $ft_sel_prz_bl['balance_all'];
																		$sdly_av_bl_ttl = $ft_sel_prz_bl['balance_total'];

																		$upd_dly_blprz = $conn->prepare("UPDATE balance SET balance_daily_sponsor=?,balance_all=?,balance_total=? WHERE balance_account='$pprz_ac'");
																		$upd_dly_blprz->bindValue(1,($sdly_av_bl_dr_spns+1000));
																		$upd_dly_blprz->bindValue(2,($sdly_av_bl_all+1000));
																		$upd_dly_blprz->bindValue(3,($sdly_av_bl_ttl+1000));
																		$upd_dly_blprz_ok = $upd_dly_blprz->execute();
																		// if ($upd_dly_blprz_ok) {

																		// 						}
																	}
																}

															}
															//======================== GIVE DIRECT SPONSORING BONUS
															if ($pin_member_id==$supr_member_id) {
															$sel_spp = $conn->query("SELECT * FROM accounts WHERE account_id='$spr_id'");
															if ($sel_spp->rowCount()==1) {
																$ft_sel_spp = $sel_spp->fetch(PDO::FETCH_ASSOC);
																$prize_acc = $ft_sel_spp['account_sponsor'];
																$sel_pr_bal = $conn->query("SELECT * FROM balance WHERE balance_account = '$prize_acc' ORDER BY balance_id DESC LIMIT 1");
																if ($sel_pr_bal->rowCount()>0) {
																	$ft_sel_pr_bal = $sel_pr_bal->fetch(PDO::FETCH_ASSOC);
																	$spr_av_bl_dr_spns = $ft_sel_pr_bal['balance_direct_sponsors'];
																	$spr_av_bl_all = $ft_sel_pr_bal['balance_all'];
																	$spr_av_bl_ttl = $ft_sel_pr_bal['balance_total'];
																	$upd_spr_sponsor_bal = $conn->prepare("UPDATE balance SET balance_direct_sponsors=?,balance_all=?,balance_total=? WHERE balance_account='$prize_acc'");
																	$upd_spr_sponsor_bal->bindValue(1,($spr_av_bl_dr_spns+1000));
																	$upd_spr_sponsor_bal->bindValue(2,($spr_av_bl_all+1000));
																	$upd_spr_sponsor_bal->bindValue(3,($spr_av_bl_ttl+1000));
																	$upd_spr_sponsor_bal_ok = $upd_spr_sponsor_bal->execute();
																				// if ($upd_spr_sponsor_bal_ok) {

																				// }
																					
																}
															}
														}

															echo "<b><u>".ucfirst($fnm.' '.$lnm)."</u></b> has been registered on <i>".ucfirst($ftc_upln['member_fname'].' '.$ftc_upln['member_lname'])."</i> 's <u>".$side."</u> side";

															if (isset($_SESSION['member']['id'])) {	//=== INSIDE THE SYSTEM
																	echo "<script>setTimeout(function () {window.location='index.php';}, 1000);</script>";
																}else{	//======= ON SIGNUP 		(login)
																	echo "<script>setTimeout(function () {window.location='index.php';}, 1000);</script>";
															}
														}else{
															echo "Thing went Wrong...";
														}
													}else{
														echo "Something went wrong";
													}
												}else{
													echo "Failed ...";
												}
											}
										}
									}
								}else{
									echo "Upline exceeded downline quantity";
								}
					}else{
						echo "Invalid PINCODE ...";
					}
			}else{
				echo "Invalid Sponsor Code";
			}
		}else{
			echo "Invalid Upline Code";
		}
	}
}

if (isset($_GET['registerDistr'])) {
	$Distributor = new Distributor(get_input('d_fname'),get_input('d_lname'),get_input('d_pin'),get_input('d_upline'),get_input('d_sponsor'),get_input('d_side'),get_input('d_nid'),get_input('d_dob'),get_input('d_gender'),get_input('d_email'),get_input('d_cntry'),get_input('d_city'),get_input('d_uname'),get_input('d_upass'));
}


//============================================================================================================
//==================================            TREE         =================================================
//============================================================================================================

class MyTree extends DbConnect{

	function __construct($distr){

		$ccc = parent::connect();
		$sel_me =$ccc->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_id='$distr'");
		$ft_sel_me = $sel_me->fetch(PDO::FETCH_ASSOC);
		$me_name = strtoupper($ft_sel_me['member_fname'])." ".ucfirst($ft_sel_me['member_lname']);
		$me_pincode = $ft_sel_me['account_pincode'];
		echo '<li>
      <span class="tf-nc tooltips"><img class="topone" src="../img/user.png">
      <span class="tooltiptext">
								'.$me_name.'<br>
								'.$me_pincode.'<br>
									Side: Left
								</span></span>';

	function kabaka($conn,$dd){
		cont_sel($conn,$dd);
	}
function in_array_data($side,$data){
	foreach($data as $obj){
	foreach($obj as $k=>$v){
		if($k=='account_side' && $v==$side){
			return array($obj);
		}
	}
}
	return array();
}

function cont_sel($conn,$ddst){

		$sel_dst=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline=$ddst ORDER BY accounts.account_side ASC");
		$cnt_sel_dist=$sel_dst->rowCount();
		if ($cnt_sel_dist>=1) {
			
			$ft_sel_dst=$sel_dst->fetchAll(PDO::FETCH_ASSOC);
			$left=in_array_data('Left',$ft_sel_dst);
			$middle=in_array_data('Middle',$ft_sel_dst);
			$right=in_array_data('Right',$ft_sel_dst);
            echo '<ul>';
            if(count($left)==0){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) {
            		//full_ul();
            	}

            }else{//real person name
            	echo ' 	<li >
							<a href="#" class="tf-nc tooltips"><img class="imgsss" src="../img/user3.png">
							  <span class="tooltiptext">
								'.$left[0]['member_fname'].' '.$left[0]['member_lname'].'<br>
								'.$left[0]['account_pincode'].'<br>
									Side: Left
								</span></a>
							';
				kabaka($conn,$left[0]['account_id']);

				echo "</li>";
			}
            if(count($middle)==0){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) {
            		//full_ul();
            	}

            }else{//real person name
            	echo ' 	<li class="">
							<a href="#" class="tf-nc tooltips"><img class="imgsss" src="../img/user1.jpg">';
							echo '
							  <span class="tooltiptext">
								'.$middle[0]['member_fname'].' '.$middle[0]['member_lname'].'<br>
								'.$middle[0]['account_pincode'].'
								</span></a>';
				kabaka($conn,$middle[0]['account_id']);
				echo "</li>";
			}
            if(count($right)==0){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) {
            		//full_ul();
            	}
            }else{//real person name
            	echo ' 	<li class="">
							<a href="#" class="tf-nc tooltips"><img class="imgsss" src="../img/user.png">';
							echo '
							  <span class="tooltiptext">
								'.$right[0]['member_fname'].' '.$right[0]['member_lname'].'<br>
								'.$right[0]['account_pincode'].'
								<br>
									Side: Right
								</span></a>';
				kabaka($conn,$right[0]['account_id']);
				echo "</li>";
			}
			echo'</ul>';
            }else{
            	//full_ul();
            }


}
		$conn=parent::connect();

		cont_sel($conn,$distr);
		?>
	<script>
		$(".tooltips").hover(function(){
			$(".tooltiptext").hide();
			$(this).children('.tooltiptext').show();
		});
	</script>
		<?php
		echo '</li>';

	}
}
 if (isset($_GET['myTree'])) {
 	$MyTree = new MyTree(get_input('ds'));
 }



//============================================================================================================
//==================================            UPGRADE        =================================================
//============================================================================================================

class Upgrade extends DbConnect{

	function __construct($distr){

		$ccc = parent::connect();
		$sel_me =$ccc->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_id='$distr'");
		$ft_sel_me=$sel_me->fetch(PDO::FETCH_ASSOC);
		$myid=$ft_sel_me['account_id'];
		    echo "<div class='tree'>";
            echo " <ul class='tree-ul'>";
		echo '<li  class="$overallli">
        <a href="#" title=""><a href="#"><img class="topone" src="../../img/user.png"></a>
       ';

	function repeat_till_end($conn,$dd,$overall,$myid){
		cont_sel($conn,$dd,$overall,$myid);
	}
function in_array_data($side,$data){
	foreach($data as $obj){
	foreach($obj as $k=>$v){
		if($k=='account_side' && $v==$side){
			return array($obj);
		}
	}
}
	return array();
}

function upgrade_queries($conn,$level,$default,$myid,$category,$status){
	$sel_upgr=$conn->prepare("SELECT * FROM gain WHERE gain_level=? AND gain_default=? AND gain_owner=? AND gain_category=? AND gain_origin=?");
	$sel_upgr->bindValue(1,$level);//$level
	$sel_upgr->bindValue(2,$default);//$default
	$sel_upgr->bindValue(3,$myid);//$myid
	$sel_upgr->bindValue(4,$category);//$category
	$sel_upgr->bindValue(5,$default);//$default
	$sel_upgr->execute();
	$cnt_sel_upgr=$sel_upgr->rowCount();
	if ($cnt_sel_upgr==0) {
		$ins_upgr=$conn->prepare("INSERT INTO gain(gain_owner,gain_category,gain_origin,gain_level,gain_default,gain_status) VALUES(?,?,?,?,?,?)");
		$ins_upgr->bindValue(1,$myid);//$myid
		$ins_upgr->bindValue(2,$category);//$category
		$ins_upgr->bindValue(3,$default);//$default
		$ins_upgr->bindValue(4,$level);//$level
		$ins_upgr->bindValue(5,$default);//$default
		$ins_upgr->bindValue(6,$status);//$status;
		$ins_upgr->execute();
	}
}
function full_ul(){
            	echo ' 	<li><a href="#"><img class="imgsss" src="../../img/user.png"></a>
<ul>
		<li>
			<a href="#"><img class="imgsss" src="../../img/user.png"></a>
		</li>
		<li>
			<a href="#"><img class="imgsss" src="../../img/user.png"></a>
		</li>

</ul>
							</li>';
}
$general=1;
//$overall=0;

function cont_sel($conn,$ddst,$overall,$myid){
	global $general;
	//global $overall;
		$sel_dst=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline=$ddst ORDER BY accounts.account_side ASC");
		$cnt_sel_dist=$sel_dst->rowCount();
		if ($cnt_sel_dist>=1) {
			$ft_sel_dst=$sel_dst->fetchAll(PDO::FETCH_ASSOC);
			$left=in_array_data('Left',$ft_sel_dst);
			//$middle=in_array_data('Middle',$ft_sel_dst);
			$right=in_array_data('Right',$ft_sel_dst);
            //echo '<ul>';
            if((count($left)==0)){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) { 
            		//full_ul();
            	}

            }else{//real person name
       //      	echo ' 	<li title="'.$left[0]['member_fname'].' '.$left[0]['member_lname'].' - '.$left[0]['account_pincode'].' - '.($left[0]['account_level']-$overall).'">
							// <a href="#"><img class="imgsss" src="../../img/user1.jpg"></a>';
							if ((count($ft_sel_dst)==2) AND (($left[0]['account_level']-$overall)==2)) {
								//echo "G-- ".$left[0]['account_id']." --G";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,3,'NY');
							}else if ((count($ft_sel_dst)==2) AND (($left[0]['account_level']-$overall)==4)) {
								//echo "H-- ".$left[0]['account_id']." --H";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,4,'NY');
							}else if ((count($ft_sel_dst)==2) AND (($left[0]['account_level']-$overall)==6)) {
								//echo "I-- ".$left[0]['account_id']." --I";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,5,'NY');
							}else if ((count($ft_sel_dst)==2) AND (($left[0]['account_level']-$overall)==8)) {
								//echo "J-- ".$left[0]['account_id']." --J";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,6,'NY');
							}else if ((count($ft_sel_dst)==2) AND (($left[0]['account_level']-$overall)==10)) {
								//echo "K-- ".$left[0]['account_id']." --K";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,7,'NY');
							}else if ((count($ft_sel_dst)==2) AND (($left[0]['account_level']-$overall)==12)) {
								//echo "L-- ".$left[0]['account_id']." --L";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,8,'NY');
							}else{
								//echo "None";
								//echo $left[0]['account_level']." - ".count($ft_sel_dst);
							}
				repeat_till_end($conn,$left[0]['account_id'],$overall,$myid);
			}
   //          if(count($middle)==0){//empty-->person cartoon
   //          	for ($i=1; $i <=$sel_dst->rowCount(); $i++) { 
   //          		full_ul();
   //          	}

   //          }else{//real person name
   //          	echo ' 	<li title="'.$middle[0]['member_fname'].' '.$middle[0]['member_lname'].' - '.$middle[0]['account_pincode'].' - '.($middle[0]['account_level']-$overall).'">
			// 				<a href="#"><img class="imgsss" src="../../img/user1.jpg"></a>';

			// 	repeat_till_end($conn,$middle[0]['account_id'],$overall,$myid);
			// }
            if(count($right)==0){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) { 
            		full_ul();
            	}
            }else{//real person name
       //      	echo ' 	<li title="'.$right[0]['member_fname'].' '.$right[0]['member_lname'].' - '.$right[0]['account_pincode'].' - '.($right[0]['account_level']-$overall).'">
							// <a href="#"><img class="imgsss" src="../../img/user1.jpg"></a>';

				repeat_till_end($conn,$right[0]['account_id'],$overall,$myid);
			}
			//echo'</ul>';
            }else{
            	//full_ul();
            }
          //  echo "</ul>";
            $general++;
}
$ccc = parent::connect();
		$sel_me =$ccc->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_id='$distr'");
$dd=$sel_me->fetch(PDO::FETCH_ASSOC)['account_level'];
		cont_sel($ccc,$distr,$dd,$myid);
		//echo '</ul></div></li>';
//break;
		//continue;
		ob_start();
	}
}




class UpdateUpgrade extends DbConnect{
	function __construct(){
		$conn=parent::connect();
		$all_accounts=$conn->query("SELECT * FROM accounts");
		$ct_al_ant = $all_accounts->rowCount();
		if ($ct_al_ant >= 1) {
			while ($ft_all_accounts=$all_accounts->fetch(PDO::FETCH_ASSOC)) {
				$acnt_id=$ft_all_accounts['account_id'];

					?>
					<script type="text/javascript">
						var Upgrade=true;
						var ds="<?php echo $acnt_id?>";
					     $.ajax({
					        url: "../assests/ajax/main.php",data:{Upgrade:Upgrade,ds:ds},
					        success:   function(result){ 
					                      /* Parse the result and do whatever you want to do here */
					        }
					      });
					</script>
					<?php
			}
		}
	}
}


 if (isset($_GET['DoUpgrade'])) {
 	$UpdateUpgrade = new UpdateUpgrade();
 }
 if (isset($_GET['Upgrade'])) {
 	new Upgrade(get_input('ds'));
 }






//==================================================================================================================================
//==================================================================================================================================
//=============================================================          ===========================================================
//======================================================    AGENT DATA ANALYSIS    =================================================
//==============================================================         ===========================================================
//==================================================================================================================================
//==================================================================================================================================

//==================================================== UPDATE BALANCES

 class UpdateBalances extends DbConnect
{
			 	function balance_commission($myId){
			  		$conn=parent::connect();
			 		$sel_sum_comm=$conn->prepare("SELECT gain.*,accounts.account_id FROM gain,accounts WHERE gain.gain_category=? AND accounts.account_id=gain.gain_owner AND accounts.account_id=?");
			 		$sel_sum_comm->bindValue(1,1);
			 		$sel_sum_comm->bindValue(2,$myId);
			 		$sel_sum_comm->execute();
			 		$ft_sel_sum_comm=$sel_sum_comm->rowCount();
			 		$sel_com_value=$conn->query("SELECT * FROM incomes WHERE imcome_id=1");
			 		$cnt_sel_com_value=$sel_com_value->rowCount();
			 		if ($cnt_sel_com_value==1) {		
			 			$ft_sel_com_value=$sel_com_value->fetch(PDO::FETCH_ASSOC);
			 			$comm_value=$ft_sel_com_value['imcome_value'];
			 			$all_balance=$comm_value*$ft_sel_sum_comm;
			 			$sel_bal=$conn->query("SELECT balance.*,accounts.* FROM balance,accounts WHERE balance.balance_account=accounts.account_id AND balance.balance_account=$myId");
			 			$cnt_sel_bal=$sel_bal->rowCount();
			 			if ($cnt_sel_bal<1) {		//==== If no balance exists
			 				$in_balanc=$conn->prepare("INSERT INTO balance(balance_account,balance_commission,balance_all,balance_total,balance_status) VALUES(?,?,?,?,?)");
			 				$in_balanc->bindValue(1,$myId);
			 				$in_balanc->bindValue(2,$all_balance);
			 				$in_balanc->bindValue(3,$all_balance);
			 				$in_balanc->bindValue(4,$all_balance);
			 				$in_balanc->bindValue(5,"E");
			 				$in_balanc_ok = $in_balanc->execute();
			 				if ($in_balanc_ok) {		//====== new commision balance inserted
			 					
			 				}else{
			 						
			 				}
			 			}else{
			 				$ft_sel_bal=$sel_bal->fetch(PDO::FETCH_ASSOC);
			 				$av_com=$ft_sel_bal['balance_commission'];
			 				$av_match=$ft_sel_bal['balance_matching'];
			 				$av_upgrade=$ft_sel_bal['balance_upgrade'];
			 				$av_dail_spns=$ft_sel_bal['balance_daily_sponsor'];
			 				$av_drct_spns=$ft_sel_bal['balance_direct_sponsors'];
			 				$av_all=$ft_sel_bal['balance_all'];
			 				$av_encashe=$ft_sel_bal['balance_encashed'];
			 				$av_total=$ft_sel_bal['balance_total'];
			 				if ($av_com!=$all_balance) {	//====== Checking if there is any commission changes
			 					// $new_comm_bal=$all_balance+$av_com;
			 					$new_com=$all_balance;
			 					$new_all=$av_match+$av_upgrade+$new_com+$av_dail_spns+$av_drct_spns;
			 					$new_ttl=$new_all-$av_encashe;
			 					$upd_bal=$conn->query("UPDATE balance SET balance_commission='$new_com',balance_all='$new_all',balance_total='$new_ttl' WHERE balance_account='$myId'");
			 					if ($upd_bal) {			//======== New balance records updated
			 						//echo "Yesssss";
			 					}else{
			 						//echo "";
			 					}
			 				}else{		//============= Nothing changed
			 					
			 				}
			 			}
			 		}else{
			 			echo "FR 12 Error Found, Please contact administrator for help";
			 		}
			 	}

			function balance_upgrades($myId){
			 $conn=parent::connect();
			$sel_acc=$conn->query("SELECT * FROM gain WHERE gain_owner='$myId' AND ((gain_category='2') OR(gain_category='3') OR (gain_category='4') OR (gain_category='5') OR (gain_category='6'))");
			$cnt_sel_acc = $sel_acc->rowCount();
			if ($cnt_sel_acc>=1) {
				$ft_sel_acc=$sel_acc->fetchAll(PDO::FETCH_ASSOC);
				$new_bal=0;
				$new_all_bal=$new_bal;
				foreach ($ft_sel_acc as $key => $value) {
					$upg_bal=$value['gain_category']."---";
					switch ($upg_bal) {
						case 3:
							$new_bal=8000;
							break;
						case 4:
							$new_bal=8000;
							break;
						case 5:
							$new_bal=8000;
							break;
						case 6:
							$new_bal=8000;
							break;
						case 7:
							$new_bal=8000;
							break;
						case 8:
							$new_bal=8000;
							break;
						default:
							//echo $value['gain_category'];
							break;
					}
			$new_all_bal+=$new_bal;

				}
				//echo $new_all_bal;
			$sel_bal=$conn->query("SELECT balance.*,accounts.* FROM balance,accounts WHERE balance.balance_account=accounts.account_id AND balance.balance_account=$myId");
			 			$cnt_sel_bal=$sel_bal->rowCount();
			 if ($cnt_sel_bal<1) {		//==== If no balance exists
			 				$in_balanc=$conn->prepare("INSERT INTO balance(balance_account,balance_upgrade,balance_all,balance_total,balance_status) VALUES(?,?,?,?,?)");
			 				$in_balanc->bindValue(1,$myId);
			 				$in_balanc->bindValue(2,$new_all_bal);
			 				$in_balanc->bindValue(3,$new_all_bal);
			 				$in_balanc->bindValue(4,$new_all_bal);
			 				$in_balanc->bindValue(5,"E");
			 				$in_balanc_ok = $in_balanc->execute();
			 				if ($in_balanc_ok) {		//============ New balance Inserted
			 					
			 				}else{
			 				}

			 			}else{		//======If Balance exists
			 				$ft_sel_bal=$sel_bal->fetch(PDO::FETCH_ASSOC);
			 				$av_comm=$ft_sel_bal['balance_commission'];
			 				$av_match=$ft_sel_bal['balance_matching'];
			 				$av_upgrade=$ft_sel_bal['balance_upgrade'];
			 				$av_dail_spns=$ft_sel_bal['balance_daily_sponsor'];
			 				$av_drct_spns=$ft_sel_bal['balance_direct_sponsors'];
			 				$av_all=$ft_sel_bal['balance_all'];
			 				$av_encashe=$ft_sel_bal['balance_encashed'];
			 				$av_total=$ft_sel_bal['balance_total'];
			 				if ($av_upgrade!=$new_all_bal) {	//====== Checking if there is any commission changes
			 					// $new_comm_bal=$all_balance+$av_com;
			 					$new_upgr=$new_all_bal;
			 					$new_all=$av_match+$av_comm+$new_upgr+$av_dail_spns+$av_drct_spns;
			 					$new_ttl=$new_all-$av_encashe;
			 					$upd_bal=$conn->query("UPDATE balance SET balance_upgrade='$new_upgr',balance_all='$new_all',balance_total='$new_ttl' WHERE balance_account='$myId'");
			 					if ($upd_bal) {			//======== New balance records updated
			 						//echo "Yesssss";
			 					}else{
			 						//echo "Nooo";
			 					}
			 				}else{		//============= Nothing changed
			 					
			 				}
			 			}
			}else{
				//echo "No";
			}
			 	}

			 	//===================================================== UPDATESPONSOR COMMUTION

			 	function __construct($myId)
			 	{
			 //============================== UPDATE FROM ALL ACCOUNTS
			 		$conn=parent::connect();
			 		$sel_all_acnts=$conn->query("SELECT account_id FROM accounts");
			 		$cnt_sel_all_acnts = $sel_all_acnts->rowCount();
			 		if ($cnt_sel_all_acnts>=1) {
			 			while ($ft_sel_all_acnts=$sel_all_acnts->fetch(PDO::FETCH_ASSOC)) {
			 				$ant_id = $ft_sel_all_acnts['account_id'];
								self::balance_upgrades($ant_id);
								self::balance_commission($ant_id);
			 			}
			 		}
			 	}
}

 if (isset($_GET['UpdateBalances'])) {
 	$UpdateBalances = new UpdateBalances(get_input('ds'));
 }
/**
 * 
 */
class RunUpdateBalances extends DbConnect
{
	
	function __construct()
	{
													 		$conn=parent::connect();
													 		$sel_all_acnts=$conn->query("SELECT account_id FROM accounts");
													 		$cnt_sel_all_acnts = $sel_all_acnts->rowCount();
													 		if ($cnt_sel_all_acnts>=1) {
													 			while ($ft_sel_all_acnts=$sel_all_acnts->fetch(PDO::FETCH_ASSOC)) {
													 					$bal_acnt_id=$ft_sel_all_acnts['account_id'];
													 					new UpdateBalances($bal_acnt_id);
																		
																		
													 			}
													 		}
	}
}

//==================================================================================================================================
//==================================================================================================================================
//=============================================================          ===========================================================
//====================================================    AGENT ACCOUNT ANALYSIS    ================================================
//==============================================================         ===========================================================
//==================================================================================================================================
//==================================================================================================================================





//========================================  Displaying based on Encashment Method
class Display_based_encash extends DbConnect{
	function __construct($my_ac_idd,$type){
	$conn = parent::connect();
	$sel_en_method = $conn->query("SELECT * FROM encash_method WHERE encash_method_account='$my_ac_idd' AND ((encash_method_equity is not null) OR (encash_method_mobile is not null))");
	$cnt_sel_en_method = $sel_en_method->rowCount();
	if ($cnt_sel_en_method==1) {
		$ft_sel_en_method = $sel_en_method->fetch(PDO::FETCH_ASSOC);
		$my_enc_type;
		switch ($type) {
			case 'Equity':
				$my_enc_type = $ft_sel_en_method['encash_method_equity'];
				$sel_if_exist_eqt = $conn->query("SELECT * FROM encash_method WHERE encash_method_account='$my_ac_idd' AND encash_method_equity is not null");
				$cnt_sel_if_exist_eqt=$sel_if_exist_eqt->rowCount();
				if ($cnt_sel_if_exist_eqt==1) {
					echo "Bank Account:<p class='account-number'>".$ft_sel_en_method['encash_method_equity']."</p>";
				}else{
					echo "No Equity account assigned to your account";
				}
				break;
			case 'MobileMoney':
				$my_enc_type = $ft_sel_en_method['encash_method_mobile'];
				$sel_if_exist_mbl = $conn->query("SELECT * FROM encash_method WHERE encash_method_account='$my_ac_idd' AND encash_method_mobile is not null");
				$cnt_sel_if_exist_mbl = $sel_if_exist_mbl->rowCount();
				if ($cnt_sel_if_exist_mbl==1) {
					echo "Mobile Account:<p class='account-number'>".$ft_sel_en_method['encash_method_mobile']."</p>";
					}else{

				}
				break;
			case 'Cash':
				$my_enc_type = "Cash";
				break;
			
			default:
				$my_enc_type = null;
				break;
		}
	}else{
		if ($type!="Cash") {
			echo "No such Encashment method for your account";
		}else{
			echo "";
		}
	}
	}
}
if (isset($_GET['onSelectEncash'])) {
	new Display_based_encash($my_acount_id,get_input('encash-type'));
}


//============================================================================================= ON SUBIMT ENCASHMENT
class SubEncashment extends DbConnect
{
	
	function __construct($amnt,$enc_tp,$pin)
	{
		$conn = parent::connect();
		$sel_acnt = $conn->query("SELECT * FROM accounts WHERE account_pincode='$pin'");
		$cnt_sel_acnt = $sel_acnt->rowCount();
		if ($cnt_sel_acnt==1) {
			$ft_sel_acnt = $sel_acnt->fetch(PDO::FETCH_ASSOC);
			$acnt_id = $ft_sel_acnt['account_id'];
			$sel_enc_meth = $conn->query("SELECT * FROM encash_method WHERE encash_method_account='$acnt_id' AND ((encash_method_mobile is not null) OR (encash_method_equity is not null))");
			$cnt_sel_enc_meth = $sel_enc_meth->rowCount();
			// if ($cnt_sel_enc_meth<=0) {
			// 	echo "Encashment type is not assigned to your account";
			// }else{
				$sel_balance = $conn->query("SELECT * FROM balance WHERE balance_total>=$amnt AND balance_account='$acnt_id'");
				$cnt_sel_balance = $sel_balance->rowCount();
				if ($cnt_sel_balance!=1) {
					echo "Low Balance ...";
				}else{
					$ftsel_balance = $sel_balance->fetch(PDO::FETCH_ASSOC);
					$old_bal_ttl = $ftsel_balance['balance_total'];
					$old_bal_encash = $ftsel_balance['balance_encashed'];

					if ($amnt>=8000) {
						$new_bal_ttl = $old_bal_ttl-$amnt;
						$new_bal_encash = $old_bal_encash+$amnt;
						$sel_fees = $conn->query("SELECT * FROM fees WHERE fees_status='E' AND fees_system is not null AND fees_tax is not null");
						$cnt_sel_fees = $sel_fees->rowCount(); 	//===MUST BE ALWAYS BE EQUAL TO 1		(Enabled)
						if ($cnt_sel_fees==1) {
							$ft_sel_fees=$sel_fees->fetch(PDO::FETCH_ASSOC);
							$fee_tax=$ft_sel_fees['fees_tax'];			//=====  SYSTEM TAX RATE
							$fee_sys=$ft_sel_fees['fees_system'];		//=====  SYSTEM FEES
							$upd_balance=$conn->prepare("UPDATE balance SET balance_encashed=?,balance_total=? WHERE balance_account=?");
							$upd_balance->bindValue(1,$new_bal_encash);
							$upd_balance->bindValue(2,$new_bal_ttl);
							$upd_balance->bindValue(3,$acnt_id);
							$upd_balance_ok = $upd_balance->execute();
							if ($upd_balance_ok) {
								$encash_tax=$fee_tax*$amnt;			//=====YOUR ENCASH TAX FEES
								$encash_sys=$fee_sys;		     	//=====YOUR ENCASH SYS FEES

								//=========== ENCASHMENT TABLE DATA

								$net_income = $amnt;						//=== All ENCASHED
								$tax = $encash_tax;							//=== TAX CHARGED FOR THIS ENCASH
								$sys_fees = $encash_sys;					//=== SYSTEM CHARGEES FOR THIS ENCASH
								$before = $old_bal_ttl;						//=== TAX CAHERGED FOR THIS ENCASH
								$remain = $new_bal_ttl;						//=== BALANCE REMAINED
								$gross_income = $net_income-($tax+$sys_fees);	//===BALANCE ENCASHED WITHOUT FEES

								//============  INSERTING ENCASHMENT TRANSACTIONN RECORDS
								$pay_met;
								switch ($enc_tp) {
									case 'MobileMoney':
										$pay_met = 1;
										break;
									case 'Equity':
										$pay_met = 2;
										break;
									
									default:
										$pay_met = null;
										break;
								}
								$ins_tr_rec = $conn->prepare("INSERT INTO encashment(encash_account,encash_net_income,encash_tax,encash_sys_fees,encash_before,encash_remain,encash_gross_income,encash_status,encash_type) VALUES(?,?,?,?,?,?,?,?,?)");
								$ins_tr_rec->bindValue(1,$acnt_id);
								$ins_tr_rec->bindValue(2,$net_income);
								$ins_tr_rec->bindValue(3,$tax);
								$ins_tr_rec->bindValue(4,$sys_fees);
								$ins_tr_rec->bindValue(5,$before);
								$ins_tr_rec->bindValue(6,$remain);
								$ins_tr_rec->bindValue(7,$gross_income);
								$ins_tr_rec->bindValue(8,'NY');
								$ins_tr_rec->bindValue(9,$pay_met);
								$ins_tr_rec_ok = $ins_tr_rec->execute();
								if ($ins_tr_rec_ok) {
									echo "Your Transaction for Balance: <b><u>".number_format($net_income,2)."</u></b> Rwf has been requested successfully.";
									echo "<br> Visit your <i><a href='encashment-history' style='color:white;background:#2b7de1;border:5px solid #2b7de1;padding:3px;border-radius:5px;'>Encashement History</a><i/> to view more Details.";
								}else{
									echo "Error H-1 Found. Please contact system-administrator for support";
								}


							}else{
								echo "Encashment Failed Unexpectedly || Try Agian";
							}
						}else{
							echo "Unexpected error occured. Please contact system-administrator for support";
						}

					}else{
						echo "Minimum value to incashe is ".number_format(8000,2)." Rwf";
					}
				}
			//}


		}else{
			echo "Unrecognized Account Pincode, Contact administrator for help";
		}
	}
}


if (isset($_GET['setEncashment'])) {
	$SubEncashment = new SubEncashment(get_input('encash_amount'),get_input('encash_type'),get_input('encash-account'));
}



//==================================================== DAILY SPONSOR 
class DailySponsor extends DbConnect{
	function __construct(){
		$conn = parent::connect();
$my_acount_id=$_SESSION['member']['id'];
$sel_acnts = $conn->query("SELECT * FROM accounts WHERE account_sponsor='$my_acount_id' AND LEFT(account_registration_date,10)='".date("Y-m-d")."'");
	if ($sel_acnts->rowCount()>1) {
		if ($sel_acnts->rowCount()==2) {
			$val = 1000;
		}else{
			$val = 1000;
		}
		$sel_bl = $conn->query("SELECT * FROM balance WHERE balance_account='$my_acount_id'");
			if ($sel_bl->rowCount()==1) {
				$ft_sel_bl = $sel_bl->fetch(PDO::FETCH_ASSOC);
				$av_bl_dyl_sp = $ft_sel_bl['balance_daily_sponsor'];
				$av_bl_all = $ft_sel_bl['balance_all'];
				$av_bl_ttl = $ft_sel_bl['balance_total'];
				$upd_blnc = $conn->prepare("UPDATE balance SET balance_daily_sponsor=?,balance_all=?,balance_total=? WHERE balance_account=?");
				$upd_blnc->bindValue(1,($av_bl_dyl_sp+$val));
				$upd_blnc->bindValue(2,($av_bl_all+$val));
				$upd_blnc->bindValue(3,($av_bl_ttl+$val));
				$upd_blnc->bindValue(4,($my_acount_id));
				$upd_blnc->execute();
			}else{
				$insert_bala = $conn->prepare("INSERT INTO balance(balance_daily_sponsor,balance_all,balance_total) VALUES(?,?,?)");
				$insert_bala->bindValue(1,$val);
				$insert_bala->bindValue(2,$val);
				$insert_bala->bindValue(3,$val);
				$insert_bala->execute();
			}
		}
	}
}



/**
 * ============================================================================================ ON BALANCE REGISTRATION
 */
class OnBalanceRegistration extends DbConnect
{
	
	function __construct($acc_id,$owner,$qnty,$fnm,$lnm,$pne)
	{
		switch ($owner) {
				case 'Me':
					self::register_on_me($qnty);
					break;
				case 'New':
					self::register_on_new_one($qnty,$fnm,$lnm,$pne);
					break;
				
				default:
					echo "Something Wrong ....";
					break;
			}	
	}


	function register_on_me($qnty){		//=============================== IF THE OWNER IS ME
		$conn = parent::connect();
		$my_acount_id = $_SESSION['member']['id'];
		$sel_acnt_mbr = $conn->query("SELECT account_member,account_id FROM accounts WHERE account_id='$my_acount_id'");
		$ft_sel_acnt_mbr=$sel_acnt_mbr->fetch(PDO::FETCH_ASSOC);
		$my_member_id = $ft_sel_acnt_mbr['account_member'];			//=== Acount Member

		$sel_acnt = $conn->query("SELECT * FROM accounts");

		$sel_reg_fees = $conn->query("SELECT * FROM fees ORDER BY fees_id DESC LIMIT 1");
		if ($sel_reg_fees->rowCount()==1) {
			$ft_sel_reg_fees = $sel_reg_fees->fetch(PDO::FETCH_ASSOC);
			$reg_fees = $ft_sel_reg_fees['fees_register']; 		//  Registration fees per one account
			$tax_fees = $ft_sel_reg_fees['fees_tax']; 		//  Tax fees per one account
			$sys_fees = $ft_sel_reg_fees['fees_system']; 		//  System fees per one account

			$ttl_ffes = $reg_fees*$qnty;			// === Total (NET) requested accounts fees
			$ttl_tax_fees = $ttl_ffes*$tax_fees;	// === TAX requested accounts fees
			$ttl_sys_fees = $sys_fees;	// === SYS requested accounts fees
			$total_fees = $ttl_ffes+$ttl_tax_fees+$ttl_sys_fees;	 //========= All Required Fees
			$sel_bal_req = $conn->prepare("SELECT * FROM balance WHERE balance_account = '$my_acount_id' AND balance_total>='$total_fees'");
			$sel_bal_req_ok = $sel_bal_req->execute();
			if ($sel_bal_req_ok) {
				if ($sel_bal_req->rowCount()==1) {
					$ft_sel_bal_req = $sel_bal_req->fetch(PDO::FETCH_ASSOC);
					$av_ttl_bal = $ft_sel_bal_req['balance_total'];
					$av_enc_bal = $ft_sel_bal_req['balance_encashed'];

					$new_ttl_bal = $av_ttl_bal-$total_fees;
					$new_enc_bal = $av_enc_bal+$total_fees;

					$upd_bal = $conn->prepare("UPDATE balance SET balance_encashed=?, balance_total=? WHERE balance_account=?");

					$upd_bal->bindValue(1,$new_enc_bal);
					$upd_bal->bindValue(2,$new_ttl_bal);
					$upd_bal->bindValue(3,$my_acount_id);

					$upd_bal_ok = $upd_bal->execute();
					if ($upd_bal_ok) {
							
							//========= INSERTING INENCASHMENT
						$bal_remain = $av_ttl_bal-$total_fees;
						$ins_enc = $conn->prepare("INSERT INTO encashment(encash_account,encash_net_income,encash_tax,encash_sys_fees,encash_before,encash_remain,encash_gross_income,encash_type,encash_status) VALUES(?,?,?,?,?,?,?,?,?)");
						$ins_enc->bindValue(1,$my_acount_id);
						$ins_enc->bindValue(2,$total_fees);
						$ins_enc->bindValue(3,$ttl_tax_fees);
						$ins_enc->bindValue(4,$ttl_sys_fees);
						$ins_enc->bindValue(5,$av_ttl_bal);
						$ins_enc->bindValue(6,$bal_remain);
						$ins_enc->bindValue(7,$ttl_ffes);
						$ins_enc->bindValue(8,-1);	//==== showing that is Balance registration
						$ins_enc->bindValue(9,'E');	
						$ins_enc_ok = $ins_enc->execute();
						if ($ins_enc_ok) {
							$mypin = array();
							$mypin_code = array();
							for ($ii=0; $ii < $qnty; $ii++) { 
									$pincde;
									$fft=$sel_acnt->fetch(PDO::FETCH_ASSOC);
									$scnt_pincde = $fft['account_pincode'];
									if ($scnt_pincde!=("IF".rand(100000,999999))) {
										$pincde = rand(100000,999999);
										$mypin[$ii]=$pincde;
									}else{
										while ($scnt_pincde!=("IF".rand(100000,999999))) {
											$pincde = rand(100000,999999);
											$mypin[$ii]=$pincde;
										}
									}
									$new_pincode="IF".$pincde;
									$mypin_code[$ii]="IF".$mypin[$ii];
							}
								//===============================================
								$str=0;
								foreach ($mypin_code as $key_pin => $value_pin) {
							try{
								$ins_acnt=$conn->prepare("INSERT INTO accounts(account_member,account_referee,account_pincode,account_status) VALUES(?,?,?,?)");
								$ins_acnt->bindValue(1,$my_member_id);
								//$ins_acnt->bindValue(2,$ftc_sele['account_sponsor']);
								$ins_acnt->bindValue(2,$my_acount_id);
								$ins_acnt->bindValue(3,$value_pin);
								$ins_acnt->bindValue(4,'NY');
								$ins_acnt_ok = $ins_acnt->execute();
								$str;
								if ($ins_acnt_ok) {
									echo "<script>setContN('resp_upl_y','<center><span style=\'color:green;text-align:center\'>Pincode generated successful ...</span></center>');</script>";
									echo "<script>document.getElementById('distr_name').value=' ';</script>";
									$str = 1;
								}else{
									$str = 0;
									echo "Generated Pincode has been taken, try again...<br>";
									//print_r($ins_acnt->errorInfo());
								}
							}catch(PDOException $ee){
								$ee->getMessage();
							}
								}
								//================================================
							if ($str==1) {
								//=================================================== DISPLAYING GENERATED MEMBERS PINCODES
								$sel_gen = $conn->prepare("SELECT member.*,accounts.* FROM member,accounts WHERE accounts.account_member=member.member_id AND accounts.account_referee=? AND accounts.account_status=? ORDER BY accounts.account_registration_date DESC");
								$sel_gen->bindValue(1,$my_acount_id);
								$sel_gen->bindValue(2,'NY');
								$sel_gen_ok = $sel_gen->execute();
								echo "<table><thead> <th>#</th>  <th>Names</th>  <th>Pincode</th>  </thead>";
								$cnnnt =1;
								while ($ft_sel_gen = $sel_gen->fetch(PDO::FETCH_ASSOC)) {
									echo "<tr><td>".$cnnnt.". </td><td>".strtoupper($ft_sel_gen['member_fname'])." ".ucfirst($ft_sel_gen['member_lname']).": </td><td><b>".$ft_sel_gen['account_pincode']."<b></td></tr>";
									$cnnnt++;
								}
								echo "</table>";
							}else{
								echo "Things went wrong";
							}
						}else{
							echo "Error H-4 occured. Plese contact system administrator fo help";
						}
					}else{
						echo "Balance-Transfer failed unexpectedly. Plese contact system administrator fo help";
					}
				}else{
					echo "Low Balance . ".number_format($total_fees)." Rwf  is required for this action. ";
				}
			}else{
				echo "System error 'H-3' occured. Please contact System-Administrator for help.";
			}
		}else{
			echo "System error 'H-2' occured. Please contact System-Administrator for help.";
		}
	}


	function register_on_new_one($qnty,$fname,$lname,$phone){		//=============================== IF THE OWNER IS NEW ONE
		$conn = parent::connect();
		$my_acount_id = $_SESSION['member']['id'];
		$sel_acnt_mbr = $conn->query("SELECT account_member,account_id FROM accounts WHERE account_id='$my_acount_id'");
		$ft_sel_acnt_mbr=$sel_acnt_mbr->fetch(PDO::FETCH_ASSOC);
		$my_member_id = $ft_sel_acnt_mbr['account_member'];			//=== Acount Member

		$sel_acnt = $conn->query("SELECT * FROM accounts");

		$sel_reg_fees = $conn->query("SELECT * FROM fees ORDER BY fees_id DESC LIMIT 1");
		if ($sel_reg_fees->rowCount()==1) {
			$ft_sel_reg_fees = $sel_reg_fees->fetch(PDO::FETCH_ASSOC);
			$reg_fees = $ft_sel_reg_fees['fees_register']; 		//  Registration fees per one account
			$tax_fees = $ft_sel_reg_fees['fees_tax']; 		//  Tax fees per one account
			$sys_fees = $ft_sel_reg_fees['fees_system']; 		//  System fees per one account

			$ttl_ffes = $reg_fees*$qnty;			// === Total (NET) requested accounts fees
			$ttl_tax_fees = $ttl_ffes*$tax_fees;	// === TAX requested accounts fees
			$ttl_sys_fees = $sys_fees;	// === SYS requested accounts fees
			$total_fees = $ttl_ffes+$ttl_tax_fees+$ttl_sys_fees;	 //========= All Required Fees
			$sel_bal_req = $conn->prepare("SELECT * FROM balance WHERE balance_account = '$my_acount_id' AND balance_total>='$total_fees'");
			$sel_bal_req_ok = $sel_bal_req->execute();
			if ($sel_bal_req_ok) {
				if ($sel_bal_req->rowCount()==1) {
					$ft_sel_bal_req = $sel_bal_req->fetch(PDO::FETCH_ASSOC);
					$av_ttl_bal = $ft_sel_bal_req['balance_total'];
					$av_enc_bal = $ft_sel_bal_req['balance_encashed'];

					$new_ttl_bal = $av_ttl_bal-$total_fees;
					$new_enc_bal = $av_enc_bal+$total_fees;

					$upd_bal = $conn->prepare("UPDATE balance SET balance_encashed=?, balance_total=? WHERE balance_account=?");

					$upd_bal->bindValue(1,$new_enc_bal);
					$upd_bal->bindValue(2,$new_ttl_bal);
					$upd_bal->bindValue(3,$my_acount_id);

					$upd_bal_ok = $upd_bal->execute();
					if ($upd_bal_ok) {
							
							//========= INSERTING INENCASHMENT
						$bal_remain = $av_ttl_bal-$total_fees;
						$ins_enc = $conn->prepare("INSERT INTO encashment(encash_account,encash_net_income,encash_tax,encash_sys_fees,encash_before,encash_remain,encash_gross_income,encash_type,encash_status) VALUES(?,?,?,?,?,?,?,?,?)");
						$ins_enc->bindValue(1,$my_acount_id);
						$ins_enc->bindValue(2,$total_fees);
						$ins_enc->bindValue(3,$ttl_tax_fees);
						$ins_enc->bindValue(4,$ttl_sys_fees);
						$ins_enc->bindValue(5,$av_ttl_bal);
						$ins_enc->bindValue(6,$bal_remain);
						$ins_enc->bindValue(7,$ttl_ffes);
						$ins_enc->bindValue(8,-1);	//==== showing that is Balance registration
						$ins_enc->bindValue(9,'E');	
						$ins_enc_ok = $ins_enc->execute();
							if ($ins_enc_ok) {
								$ins_new_mbr = $conn->prepare("INSERT INTO member(member_fname,member_lname,member_phone,member_status) VALUES(?,?,?,?)");
								$ins_new_mbr->bindValue(1,$fname);
								$ins_new_mbr->bindValue(2,$lname);
								$ins_new_mbr->bindValue(3,$phone);
								$ins_new_mbr->bindValue(4,'NY');
								$ins_new_mbr_ok = $ins_new_mbr->execute();
								if ($ins_new_mbr_ok) {
									$sel_nw_mbr = $conn->prepare("SELECT * FROM member WHERE member_fname=? AND member_lname=? AND member_phone=? AND member_status=? ORDER BY member_id DESC LIMIT 1");
									$sel_nw_mbr->bindValue(1,$fname);
									$sel_nw_mbr->bindValue(2,$lname);
									$sel_nw_mbr->bindValue(3,$phone);
									$sel_nw_mbr->bindValue(4,'NY');
									$sel_nw_mbr_ok = $sel_nw_mbr->execute();
									if ($sel_nw_mbr_ok==1) {
										$ft_sel_nw_mbr = $sel_nw_mbr->fetch(PDO::FETCH_ASSOC);
										$member_iid = $ft_sel_nw_mbr['member_id'];
										$mypin = array();
										$mypin_code = array();
										for ($ii=0; $ii < $qnty; $ii++) { 
												$pincde;
												$fft=$sel_acnt->fetch(PDO::FETCH_ASSOC);
												$scnt_pincde = $fft['account_pincode'];
												if ($scnt_pincde!=("IF".rand(100000,999999))) {
													$pincde = rand(100000,999999);
													$mypin[$ii]=$pincde;
												}else{
													while ($scnt_pincde!=("IF".rand(100000,999999))) {
														$pincde = rand(100000,999999);
														$mypin[$ii]=$pincde;
													}
												}
												$new_pincode="IF".$pincde;
												$mypin_code[$ii]="IF".$mypin[$ii];
										}
																//===============================================
																$str=0;
																foreach ($mypin_code as $key_pin => $value_pin) {
															try{
																$ins_acnt=$conn->prepare("INSERT INTO accounts(account_member,account_referee,account_pincode,account_status) VALUES(?,?,?,?)");
																$ins_acnt->bindValue(1,$member_iid);
																//$ins_acnt->bindValue(2,$ftc_sele['account_sponsor']);
																$ins_acnt->bindValue(2,$my_acount_id);
																$ins_acnt->bindValue(3,$value_pin);
																$ins_acnt->bindValue(4,'NY');
																$ins_acnt_ok = $ins_acnt->execute();
																$str;
																if ($ins_acnt_ok) {
																	echo "<script>setContN('resp_upl_y','<center><span style=\'color:green;text-align:center\'>Pincode generated successful ...</span></center>');</script>";
																	echo "<script>document.getElementById('distr_name').value=' ';</script>";
																	$str = 1;
																}else{
																	$str = 0;
																	echo "Generated Pincode has been taken, try again...<br>";
																	//print_r($ins_acnt->errorInfo());
																}
															}catch(PDOException $ee){
																$ee->getMessage();
															}
																}
																//================================================
															if ($str==1) {
																//=================================================== DISPLAYING GENERATED MEMBERS PINCODES
																$sel_gen = $conn->prepare("SELECT member.*,accounts.* FROM member,accounts WHERE accounts.account_member=member.member_id AND accounts.account_referee=? AND accounts.account_status=? ORDER BY accounts.account_registration_date DESC");
																$sel_gen->bindValue(1,$my_acount_id);
																$sel_gen->bindValue(2,'NY');
																$sel_gen_ok = $sel_gen->execute();
																echo "<table><thead> <th>#</th>  <th>Names</th>  <th>Pincode</th>  </thead>";
																$cnnnt =1;
																while ($ft_sel_gen = $sel_gen->fetch(PDO::FETCH_ASSOC)) {
																	echo "<tr><td>".$cnnnt.". </td><td>".strtoupper($ft_sel_gen['member_fname'])." ".ucfirst($ft_sel_gen['member_lname']).": </td><td><b>".$ft_sel_gen['account_pincode']."<b></td></tr>";
																	$cnnnt++;
																}
																echo "</table>";
															}else{
																echo "There is something went wrong";
															}
									}else{
										echo "Unexpected error T-1 found. Please contact system administrator fo help.";
									}
								}else{
									echo "Failed to register a distributer ...";
								}

						}else{
							echo "Error T-4 occured. Please contact system administrator fo help.";
						}
					}else{
						echo "Balance-Transfer failed unexpectedly. Please contact system administrator fo help.";
					}
				}else{
					echo "Low Balance . ".number_format($total_fees)." Rwf  is required for this action. ";
				}
			}else{
				echo "System error 'T-3' occured. Please contact System-Administrator for help.";
			}
		}else{
			echo "System error 'T-2' occured. Please contact System-Administrator for help.";
		}
	}
}



if (isset($_GET['OnBalanceRegistration'])) {
	new OnBalanceRegistration(1,"New",3,'UMUBAKA','Kabaka','788121233');
}




/**
 * =================================================================================== Agent CHANGE PASSWORD
 */
class AgentChangePaswword extends DbConnect
{
	
	function __construct($old_p,$npass,$cpass)
	{
		$conn = parent::connect();
		$my_acount_id = $_SESSION['member']['id'];
		$sel_my_mbr = $conn->prepare("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_id='$my_acount_id'");
		$sel_my_mbr->execute();
		if ($sel_my_mbr->rowCount()==1) {
			$ft_sel_my_mbr = $sel_my_mbr->fetch(PDO::FETCH_ASSOC);
			$mbr_pass = $ft_sel_my_mbr['member_password'];
			$mbr_id = $ft_sel_my_mbr['member_id'];
			if ($old_p==$mbr_pass) {
				if ($npass==$cpass) {
					if (strlen($npass)>8) {
						if (strlen($npass)<32) {
							if ($mbr_pass!=$npass) {
								$upd_agent_pass = $conn->prepare("UPDATE member SET member_password=?, member_password_key=? WHERE member_id=?");
								$upd_agent_pass->bindValue(1,$npass);
								$upd_agent_pass->bindValue(2,$npass);
								$upd_agent_pass->bindValue(3,$mbr_id);
								$upd_agent_pass_ok = $upd_agent_pass->execute();
								if ($upd_agent_pass_ok) {
									echo "Password updated successfully for all your accounts. Try to <b><u>'Login-again'</u></b> with new password.";
								}else{
									echo "Failed to update Password. Try again...";
								}
							}else{
								echo "<b>New Password</b> must be differ from <b>Current Password</b>";
							}
						}else{
							echo "A Valid <u>'Password-Length'</u> must be less than <b> 32 characters</b>";
						}
					}else{
						echo "A Valid <u>'Password-Length'</u> must be greater than <b> 8 characters</b>";
					}
				}else{
					echo "Passwords do not match ...";
				}
			}else{
				echo "Wrong Password ...";
			}
		}else{
			echo "System Error. Contact system administrator.";
		}
	}
}

if (isset($_GET['AgentChangePaswword'])) {
							//cur_pass		Nw_pass		Cmf_pass
	new AgentChangePaswword(get_input(''),get_input(''),get_input(''));
}

/**
 * ============================================================================ ADD MY OTHER ACCOUNT
 */
class AddMyOtherAccount extends DbConnect
{
	
	function __construct($my_acount_pin,$qnty)
	{
		$conn = parent::connect();
		$sel_mbr_cct = $conn->prepare("SELECT accounts.account_member,accounts.account_id,member.member_id FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_pincode='$my_acount_pin'");
		$sel_mbr_cct->execute();
		if ($sel_mbr_cct->rowCount()==1) {
			$ft_sel_mbr_cct = $sel_mbr_cct->fetch(PDO::FETCH_ASSOC);
			$my_member_id = $ft_sel_mbr_cct['member_id'];
		$sel_acnt = $conn->prepare("SELECT * FROM accounts");
		$sel_acnt->execute();
		$my_acount_id = $ft_sel_mbr_cct['account_id'];
							$mypin = array();
							$mypin_code = array();
							for ($ii=0; $ii < $qnty; $ii++) { 
									$pincde;
									$fft=$sel_acnt->fetch(PDO::FETCH_ASSOC);
									$scnt_pincde = $fft['account_pincode'];
									if ($scnt_pincde!=("IF".rand(100000,999999))) {
										$pincde = rand(100000,999999);
										$mypin[$ii]=$pincde;
									}else{
										while ($scnt_pincde!=("IF".rand(100000,999999))) {
											$pincde = rand(100000,999999);
											$mypin[$ii]=$pincde;
										}
									}
									$new_pincode="IF".$pincde;
									$mypin_code[$ii]="IF".$mypin[$ii];
							}
								//===============================================
								$str=0;
								foreach ($mypin_code as $key_pin => $value_pin) {
							try{
								$ins_acnt=$conn->prepare("INSERT INTO accounts(account_member,account_referee,account_pincode,account_status) VALUES(?,?,?,?)");
								$ins_acnt->bindValue(1,$my_member_id);
								//$ins_acnt->bindValue(2,$ftc_sele['account_sponsor']);
								$ins_acnt->bindValue(2,$my_acount_id);
								$ins_acnt->bindValue(3,$value_pin);
								$ins_acnt->bindValue(4,'NY');
								$ins_acnt_ok = $ins_acnt->execute();
								$str;
								if ($ins_acnt_ok) {
									echo "<script>setContN('resp_upl_y','<center><span style=\'color:green;text-align:center\'>Pincode generated successful ...</span></center>');</script>";
									echo "<script>document.getElementById('distr_name').value=' ';</script>";
									$str = 1;
								}else{
									$str = 0;
									echo "Generated Pincode has been taken, try again...<br>";
									//print_r($ins_acnt->errorInfo());
								}
							}catch(PDOException $ee){
								$ee->getMessage();
							}
								}
								//================================================
							if ($str==1) {
								//=================================================== DISPLAYING GENERATED MEMBERS PINCODES
								$sel_gen = $conn->prepare("SELECT member.*,accounts.* FROM member,accounts WHERE accounts.account_member=member.member_id AND accounts.account_referee=? AND accounts.account_status=? ORDER BY accounts.account_registration_date DESC");
								$sel_gen->bindValue(1,$my_acount_id);
								$sel_gen->bindValue(2,'NY');
								$sel_gen_ok = $sel_gen->execute();
								echo "<table><thead> <th>#</th>  <th>Names</th>  <th>Pincode</th>  </thead>";
								$cnnnt =1;
								while ($ft_sel_gen = $sel_gen->fetch(PDO::FETCH_ASSOC)) {
									echo "<tr><td>".$cnnnt.". </td><td>".strtoupper($ft_sel_gen['member_fname'])." ".ucfirst($ft_sel_gen['member_lname']).": </td><td><b>".$ft_sel_gen['account_pincode']."<b></td></tr>";
									$cnnnt++;
								}
								echo "</table>";
							}else{
								echo "Things went wrong";
							}
		}else{
			echo "Unrecognized account-pincode.";
		}
	}
}


if (isset($_GET['AddMyOtherAccount'])) {
						//===account   	//======acount_quantity
	//new AddMyOtherAccount(get_input('12'),get_input('1'));
						//===account   	//======acount_quantity
	new AddMyOtherAccount('IF3322231','1');
}



//==================================================================================================================================
//==================================================================================================================================
//=============================================================          ===========================================================
//====================================================   ADMIN DATA ANALYSIS        ================================================
//==============================================================         ===========================================================
//==================================================================================================================================
//==================================================================================================================================















































































































?>
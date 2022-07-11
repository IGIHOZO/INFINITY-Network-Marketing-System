<script type='text/javascript' src='../assests/jquery/jquery.min.js'></script>
<?php
@session_start();
require_once("funcs.php");
$my_acount_id= $_SESSION['member']['id'];

//====================================================================================================== CONNECTION
class DbConnect
{
	private $host='localhost';
	private $dbName = 'empire_db';
	private $user = 'root';
	private $pass = '';
	public $conn;
	public function connect()
	{
		try {
		 $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->user, $this->pass);
		 return $conn;
		} catch (PDOException $e) {
			echo "Database Error ".$e->getMeassage();
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
				echo "<option value='".$ft_cnts['num_code']."'>".$ft_cnts['en_short_name']."</option>";
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
			$_SESSION['category']="admin";
			$_SESSION['admin']['id'] = $ftc_lgn_admin['staff_id'];
			$_SESSION['admin']['status'] = $ftc_lgn_admin['staff_category'];
				//====UPDATE DISTRIBUTERS UPGRADES
				$UpdateUpgrade = new UpdateUpgrade();
				//====UPDATE DISTRIBUTERS MATCHINGS
				$UpdateMatching = new UpdateMatching();	
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
					$UpdateMatching = new UpdateMatching();	
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
				echo "<center><b>".ucfirst('unverified Upline-PINCODE')."</b></center>";
			}else{
				echo "<table><tr><td>Pincode:</td><td> <b>".$ftc_sele['account_pincode']."</b></td></tr>";
				echo "<tr><td>Name:</td><td> <b>".$ftc_sele['member_fname']." ".$ftc_sele['member_lname']."</b></td></tr>";
				echo "<tr><td>Level:</td><td> <b>".$ftc_sele['account_level']."</b></td></tr>";
			}
		}else{
			echo "<center><b>Invalid Upline-PINCODE</b></center>";
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
			//$ins_distr->bindValue(3,$ftc_sele['account_id']);
			$ins_distr->bindValue(3,'NY');
			$ins_distr->bindValue(4,$d_phone);
			$ins_ok=$ins_distr->execute();
			if ($ins_distr) {
				$sel_mbr=$conn->prepare("SELECT * FROM member ORDER BY member_id DESC LIMIT 1");
				$sel_mbr->execute();
				$cnt_sel_mbr=$sel_mbr->rowCount();
				if ($cnt_sel_mbr==1) {
					$ft_sel_mbr=$sel_mbr->fetch(PDO::FETCH_ASSOC);
					$sel_all_act =$conn->prepare("SELECT * FROM accounts");
					if ($d_acnts==1) {		//================= if account is one
						$pincde;
						$fft=$sel_all_act->fetch(PDO::FETCH_ASSOC);
						$scnt_pincde = $fft['account_pincode'];
						if ($scnt_pincde!=rand(100000,999999)) {
							$pincde = rand(100000,999999);
						}else{
							while ($scnt_pincde!=rand(100000,999999)) {
								$pincde = rand(100000,999999);
							}
						}
						$new_pincode="RS".$pincde;
							try{
								$ins_acnt=$conn->prepare("INSERT INTO accounts(account_member,account_referee,account_pincode,account_status) VALUES(?,?,?,?)");
								$ins_acnt->bindValue(1,$ft_sel_mbr['member_id']);
								$ins_acnt->bindValue(2,$ftc_sele['account_id']);
								$ins_acnt->bindValue(3,$new_pincode);
								$ins_acnt->bindValue(4,'NY');
								$ins_acnt_ok = $ins_acnt->execute();
								if ($ins_acnt_ok) {
									echo "<script>setContN('resp_upl_y','<center><span style=\'color:green;text-align:center\'>Pincode generated successful ...</span></center>');</script>";
									echo "<script>document.getElementById('distr_name').value=' ';</script>";
									//=================================================== DISPLAYING GENERATED MEMBERS PINCODES
									$sel_gen = $conn->prepare("SELECT member.*,accounts.* FROM member,accounts WHERE accounts.account_member=member.member_id AND accounts.account_sponsor=? AND accounts.account_status=? ORDER BY accounts.account_registration_date DESC");
									$sel_gen->bindValue(1,$ftc_sele['account_sponsor']);
									$sel_gen->bindValue(2,'NY');
									$sel_gen_ok = $sel_gen->execute();
									echo "<table>";
									while ($ft_sel_gen = $sel_gen->fetch(PDO::FETCH_ASSOC)) {
										echo "<tr><td>".$ft_sel_gen['member_fname']." ".$ft_sel_gen['member_lname'].": </td><td><b>".$ft_sel_gen['account_pincode']."<b></td></tr>";
									}

								}else{
									echo "Generated Pincode has been taken, try again<br>";
								}
							}catch(PDOException $ee){
								$ee->getMeassage();
							}
					}else if ($d_acnts>1){			// ACOUNTS ARE MORE THAT MORE THAN ONE
						$mypin = array();
						$mypin_code = array();
						for ($i=0; $i <$d_acnts ; $i++) {
								$pincde;
								$fft=$sel_all_act->fetch(PDO::FETCH_ASSOC);
								$scnt_pincde = $fft['account_pincode'];
								if ($scnt_pincde!=rand(100000,999999)) {
									$pincde = rand(100000,999999);
									$mypin[$i]=$pincde;
								}else{
									while ($scnt_pincde!=rand(100000,999999)) {
										$pincde = rand(100000,999999);
										$mypin[$i]=$pincde;
									}
								}
								$new_pincode="RS".$pincde;
								$mypin_code[$i]="RS".$mypin[$i];

						}
//===============================================
								$str=0;
								foreach ($mypin_code as $key_pin => $value_pin) {
							try{
								$ins_acnt=$conn->prepare("INSERT INTO accounts(account_member,account_sponsor,account_referee,account_pincode,account_status) VALUES(?,?,?,?,?)");
								$ins_acnt->bindValue(1,$ft_sel_mbr['member_id']);
								$ins_acnt->bindValue(2,$ftc_sele['account_sponsor']);
								$ins_acnt->bindValue(3,$ftc_sele['account_id']);
								$ins_acnt->bindValue(4,$value_pin);
								$ins_acnt->bindValue(5,'NY');
								$ins_acnt_ok = $ins_acnt->execute();
								if ($ins_acnt_ok) {
									echo "<script>setContN('resp_upl_y','<center><span style=\'color:green;text-align:center\'>Pincode generated successful ...</span></center>');</script>";
									echo "<script>document.getElementById('distr_name').value=' ';</script>";
									$str = 1;
								}else{
									$str = 0;
									echo "Generated Pincode has been taken, try again...<br>";
								}
							}catch(PDOException $ee){
								$ee->getMeassage();
							}
								}
//================================================
					if ($str=1) {
						//=================================================== DISPLAYING GENERATED MEMBERS PINCODES
						$sel_gen = $conn->prepare("SELECT member.*,accounts.* FROM member,accounts WHERE accounts.account_member=member.member_id AND accounts.account_sponsor=? AND accounts.account_status=? ORDER BY accounts.account_registration_date DESC");
						$sel_gen->bindValue(1,$ftc_sele['account_sponsor']);
						$sel_gen->bindValue(2,'NY');
						$sel_gen_ok = $sel_gen->execute();
						echo "<table>";
						while ($ft_sel_gen = $sel_gen->fetch(PDO::FETCH_ASSOC)) {
							echo "<tr><td>".$ft_sel_gen['member_fname']." ".$ft_sel_gen['member_lname'].": </td><td><b>".$ft_sel_gen['account_pincode']."<b></td></tr>";
						}
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
			echo "<center id='resp'><b>Invalid Upline-PINCODE</b></center>";
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
															echo "<b><u>".ucfirst($fnm.' '.$lnm)."</u></b> has been registered on <i>".ucfirst($ftc_upln['member_fname'].' '.$ftc_upln['member_lname'])."</i> 's <u>".$side."</u> side";
															//====UPDATE DISTRIBUTERS UPGRADES
															$UpdateUpgrade = new UpdateUpgrade();
															//====UPDATE DISTRIBUTERS MATCHINGS
															$UpdateMatching = new UpdateMatching();	
															//====UPDATE BALANCES
													 		$conn=parent::connect();
													 		$sel_all_acnts=$conn->query("SELECT account_id FROM accounts");
													 		$cnt_sel_all_acnts = $sel_all_acnts->rowCount();
													 		if ($cnt_sel_all_acnts>=1) {
													 			while ($ft_sel_all_acnts=$sel_all_acnts->fetch(PDO::FETCH_ASSOC)) {
													 					$bal_acnt_id=$ft_sel_all_acnts['account_id'];
													 					new UpdateBalances($bal_acnt_id);
																		
																		
													 			}
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
		echo '<li>
      <span class="tf-nc"><img class="topone" src="../img/user.png"></span>';

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
								'.$left[0]['account_pincode'].'

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







?>
<!-- <style>
.tree ul {padding-top:20px;-webkit-transition:all 0.5s;-moz-transition:all 0.5s;transition:all 0.5s;position:relative;}
.tree li {float:left;text-align:center;list-style-type:none;position:relative;padding:15px 5px 0 5px;-webkit-transition:all 0.5s;-moz-transition:all 0.5s;transition:all 0.5s;}
.tree{
	width: 20000px;
}
.tree li::before,
.tree li::after {content:'';position:absolute;top:0;right:50%;border-top:3px solid #787878;width: 50%;height:30px;z-index: -1;}
.tree li::after {left:50%;border-left:3px solid #787878;}
.tree li:only-child::after,
.tree li:only-child::before {display:none;}
.tree li:only-child {padding-top:0;}
.tree li:first-child::before,
.tree li:last-child::after {border:none;}
.tree li:last-child::after {border-left:3px solid #787878;margin-top:3px;margin-left:-2.5px;}
.tree li:last-child::before {border-right:border-top:3px solid #787878;border-radius:0 5px 0 0;-webkit-transform: translateX(1px);-moz-transform: translateX(1px);transform:translateX(1px);-webkit-border-radius:0 5px 0 0;-moz-border-radius:0 5px 0 0;border-radius:0 5px 0 0;}
.tree li:first-child::after {border-radius:5px 0 0 0;-webkit-border-radius:5px 0 0 0;-moz-border-radius:5px 0 0 0;}
.tree ul ul::before {content: '';position:absolute;top:-12px;left:50%;border-left: 3px solid #787878;width: 0;height: 32px;z-index: -1;}
.tree li a {border:3px solid white;text-decoration:none;color:#666;font-family: arial, verdana, tahoma;font-size:11px;display:inline-block;background:white;color:white;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;-webkit-transition:all 0.5s;-moz-transition: all 0.5s;transition: all 0.5s;padding:2px 2px;box-shadow:0 0 5px #383838;border:1px solid #383838;}
.tree li a+a {margin-left:-20px;position:relative;}
.tree li a::before{content: '';position:absolute;border-top: 1px solid #ccc;top: 50%;left: width:20px;}
.tree li a:hover,
.tree li a:hover~ul li a {background:#049796;color:white;border:1px solid #049796;}
.tree li a:hover~ul li::after,
.tree li a:hover~ul li::before,
.tree li a:hover~ul::before,
.tree li a:hover~ul ul::before {border-color:#049796;}
.topone{width:60px;height:60px;padding:1px;border-radius:5px;}
.imgsss{width:30px;height:30px;border-radius:3px;}
.middle-body{background:#ed292a;}
                      </style> -->
<?php



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
			$middle=in_array_data('Middle',$ft_sel_dst);
			$right=in_array_data('Right',$ft_sel_dst);
            echo '<ul>';
            if((count($left)==0)){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) { 
            		full_ul();
            	}

            }else{//real person name
            	echo ' 	<li title="'.$left[0]['member_fname'].' '.$left[0]['member_lname'].' - '.$left[0]['account_pincode'].' - '.($left[0]['account_level']-$overall).'">
							<a href="#"><img class="imgsss" src="../../img/user1.jpg"></a>';
							if ((count($ft_sel_dst)==3) AND (($left[0]['account_level']-$overall)==3)) {
								//echo "G-- ".$left[0]['account_id']." --G";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,2,'NY');
							}else if ((count($ft_sel_dst)==3) AND (($left[0]['account_level']-$overall)==6)) {
								//echo "H-- ".$left[0]['account_id']." --H";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,3,'NY');
							}else if ((count($ft_sel_dst)==3)  AND (($left[0]['account_level']-$overall)==10)) {
								//echo "I-- ".$left[0]['account_id']." --I";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,4,'NY');
							}else if ((count($ft_sel_dst)==3)  AND (($left[0]['account_level']-$overall)==15)) {
								//echo "J-- ".$left[0]['account_id']." --J";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,5,'NY');
							}else if ((count($ft_sel_dst)==3) AND (($left[0]['account_level']-$overall)==21)) {
								//echo "K-- ".$left[0]['account_id']." --K";
								upgrade_queries($conn,$left[0]['account_level'],$left[0]['account_id'],$myid,6,'NY');
							}else{
								//echo $left[0]['account_id'];
							}
				repeat_till_end($conn,$left[0]['account_id'],$overall,$myid);
			}
            if(count($middle)==0){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) { 
            		full_ul();
            	}

            }else{//real person name
            	echo ' 	<li title="'.$middle[0]['member_fname'].' '.$middle[0]['member_lname'].' - '.$middle[0]['account_pincode'].' - '.($middle[0]['account_level']-$overall).'">
							<a href="#"><img class="imgsss" src="../../img/user1.jpg"></a>';

				repeat_till_end($conn,$middle[0]['account_id'],$overall,$myid);
			}
            if(count($right)==0){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) { 
            		full_ul();
            	}
            }else{//real person name
            	echo ' 	<li title="'.$right[0]['member_fname'].' '.$right[0]['member_lname'].' - '.$right[0]['account_pincode'].' - '.($right[0]['account_level']-$overall).'">
							<a href="#"><img class="imgsss" src="../../img/user1.jpg"></a>';

				repeat_till_end($conn,$right[0]['account_id'],$overall,$myid);
			}
			echo'</ul>';
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
		echo '</ul></div></li>';
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



//============================================================================================================
//==================================            MATCHING          ============================================
//============================================================================================================

class Maching extends DbConnect
{


	function __construct($distr,$m_code){

		$ccc = parent::connect();
		$sel_me =$ccc->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_id='$distr'");
		$ft_sel_me=$sel_me->fetch(PDO::FETCH_ASSOC);
		$myid=$ft_sel_me['account_id'];


	function repeat_till_end($conn,$dd,$overall,$myid,$m_code){
		cont_sel($conn,$dd,$overall,$myid,$m_code);
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


$general=1;
$general_all=1;
$left_general;
//$overall=0;

function cont_sel($conn,$ddst,$overall,$myid,$m_code){
	global $general,$general_all,$left_general;
	//global $overall;
		$sel_dst=$conn->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline=$ddst ORDER BY accounts.account_side ASC");
		$cnt_sel_dist=$sel_dst->rowCount();
		if ($cnt_sel_dist>=1) {
			$ft_sel_dst=$sel_dst->fetchAll(PDO::FETCH_ASSOC);
			$left=in_array_data('Left',$ft_sel_dst);
			$middle=in_array_data('Middle',$ft_sel_dst);
			$right=in_array_data('Right',$ft_sel_dst);
            //echo '<ul>';
            if((count($left)==0)){//empty-->person cartoon
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) { 
            		//full_ul();
            	}


            }else{//real person name

							$general++;
	
				repeat_till_end($conn,$left[0]['account_id'],$overall,$myid,$m_code);
			}

            if(count($right)==0){
            	for ($i=1; $i <=$sel_dst->rowCount(); $i++) { 

            	}
            }else{


							if (($right[0]['account_level']-$overall)==1) {
								
								if (!isset($general)) {
									$general=0;
								}

//================================================================================ INSERT INTO LEFT MATCHING
$sel_mat=$conn->query("SELECT * FROM matching WHERE matching_owner='$myid' AND matching_left='$general'");
$cnt_sel_mat=$sel_mat->rowCount();
if ($cnt_sel_mat==0) {
$ins_mat=$conn->prepare("INSERT INTO matching(matching_owner,matching_left,matching_code,matching_status) VALUES(?,?,?,?)");
$ins_mat->bindValue(1,$myid);
$ins_mat->bindValue(2,$general);
$ins_mat->bindValue(3,$m_code);
$ins_mat->bindValue(4,"NY");
$ins_mat->execute();
}
								$general_all=$general;
								$left_general=$general;
								$general=1;
								//echo $general;
								//echo "-".$general_all;
							}else{
								$general++;
								//$general_all++;
								//echo $general;
							}

				repeat_till_end($conn,$right[0]['account_id'],$overall,$myid,$m_code);
			}
			//echo'</ul>';
            }else{
            	
            }

         //  $general++;
           
}
$ccc = parent::connect();
		$sel_me =$ccc->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_id='$distr'");
$dd=$sel_me->fetch(PDO::FETCH_ASSOC)['account_level'];
		cont_sel($ccc,$distr,$dd,$myid,$m_code);
		//echo '</ul></div></li>';




	}	
}








//=============================================================== Right matching








class Maching_right_l extends DbConnect
{


	function __construct($distr_l,$m_code_l){

		$ccc_l = parent::connect();
		$sel_me_l =$ccc_l->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_id='$distr_l' ORDER BY accounts.account_side DESC");
		$ft_sel_me_l=$sel_me_l->fetch(PDO::FETCH_ASSOC);
		$myid_l=$ft_sel_me_l['account_id'];
		//     echo "<div class='tree'>";
  //           echo " <ul class='tree-ul'>";
		// echo '<li  class="$overall_lli">
  //       <a href="#" title=""><a href="#"><img class="topone" src="../../img/user.png"></a>
  //      ';

	function repeat_till_end_l($conn_l,$dd_l,$overall_l,$myid_l,$m_code_l){
		cont_sel_l($conn_l,$dd_l,$overall_l,$myid_l,$m_code_l);
	}
function in_array_data_l_l($side_l,$data_l){
	foreach($data_l as $obj_l){
	foreach($obj_l as $k_l=>$v_l){
		if($k_l=='account_side' && $v_l==$side_l){
			return array($obj_l);
		}
	}
}
	return array();
}


$general_l=1;
$general_all_l=1;
$left_l_general_l;
//$overall_l=0;

function cont_sel_l($conn_l,$dd_lst,$overall_l,$myid_l,$m_code_l){
	global $general_l,$general_all_l,$left_l_general_l;
	//global $overall_l;
		$sel_dst_l=$conn_l->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND accounts.account_upline=$dd_lst ORDER BY accounts.account_side DESC");
		$cnt_sel_dist_l=$sel_dst_l->rowCount();
		if ($cnt_sel_dist_l>=1) {
			$ft_sel_dst_l=$sel_dst_l->fetchAll(PDO::FETCH_ASSOC);
			$left_l=in_array_data_l_l('Left',$ft_sel_dst_l);
			$middle_l=in_array_data_l_l('Middle',$ft_sel_dst_l);
			$right_l=in_array_data_l_l('Right',$ft_sel_dst_l);
            //echo '<ul>';


            if(count($right_l)==0){
            	for ($i_l=1; $i_l <=$sel_dst_l->rowCount(); $i_l++) { 

            	}
            }else{


							$general_l++;

				repeat_till_end_l($conn_l,$right_l[0]['account_id'],$overall_l,$myid_l,$m_code_l);
			}
            if((count($left_l)==0)){//empty-->person cartoon
            	for ($i_l=1; $i_l <=$sel_dst_l->rowCount(); $i_l++) { 
            	}


            }else{//real person name

						if (($left_l[0]['account_level']-$overall_l)==1) {

							if (!isset($general_l)) {
									$general_l=0;
								}

//================================================================================ INSERT INTO LEFT MATCHING
$sel_mat_left=$conn_l->query("SELECT * FROM matching WHERE matching_owner='$myid_l' AND matching_code='$m_code_l'");
$cnt_sel_mat_left=$sel_mat_left->rowCount();
if ($cnt_sel_mat_left==1) {
	$ft_sel_mat_left=$sel_mat_left->fetch(PDO::FETCH_ASSOC);
	$match_left=$ft_sel_mat_left['matching_left'];
	$remain_left=0;
	$remain_right=0;
	$remain_earn=0;
	if ($match_left>$general_l) {
		$remain_left=$match_left-$general_l;
		$remain_right=0;
		$remain_earn=$general_l;
	}elseif ($match_left<$general_l) {
		$remain_left=0;
		$remain_right=$general_l-$match_left;
		$remain_earn=$match_left;
	}else{
		$remain_right=0;
		$remain_left=0;
		$remain_earn=$match_left;
	}
	// if ($remain_earn==0) {
	// 	$conn->query("DELETE FROM matching WHERE matching_owner='$myid_l' AND matching_code='$m_code_l'");
	// }else{
		$sel_mat_left=$conn_l->prepare("UPDATE matching SET matching_rem_left=?,matching_rem_right=?,matching_earn=?,matching_status=?,matching_right=? WHERE matching_owner=? AND matching_code=? AND matching_status =? AND matching_left=? AND matching_right!=?");
		$sel_mat_left->bindValue(1,$remain_left);
		$sel_mat_left->bindValue(2,$remain_right);
		$sel_mat_left->bindValue(3,$remain_earn);
		$sel_mat_left->bindValue(4,"E");
		$sel_mat_left->bindValue(5,$general_l);
		$sel_mat_left->bindValue(6,$myid_l);
		$sel_mat_left->bindValue(7,$m_code_l);
		$sel_mat_left->bindValue(8,"NY");
		$sel_mat_left->bindValue(9,$match_left);
		$sel_mat_left->bindValue(10,$general_l);

		$ok_sel_mat_left = $sel_mat_left->execute();
		if ($ok_sel_mat_left) {
			$conn->query("UPDATE balance SET balance_matching=8000 WHERE balance_account='$myId' AND balance_matching=0");

		}else{
			//echo "Nooooooooooooooooooooooooooooooooooooooooo";
		}
	//}

}else{
	//echo "Hhhhhhhhhhhhhhhhhhhhhhhhhhhh";
}
								
								$general_all_l=$general_l;
								$left_l_general_l=$general_l;
								$general_l=1;

							}else{
								$general_l++;

							}
	
				repeat_till_end_l($conn_l,$left_l[0]['account_id'],$overall_l,$myid_l,$m_code_l);
			}
            }else{
            	
            }

           
}
$ccc_l = parent::connect();
		$sel_me_l =$ccc_l->query("SELECT accounts.*,member.* FROM accounts,member WHERE accounts.account_member=member.member_id AND account_id='$distr_l' ORDER BY accounts.account_side DESC");
$dd_l=$sel_me_l->fetch(PDO::FETCH_ASSOC)['account_level'];
		cont_sel_l($ccc_l,$distr_l,$dd_l,$myid_l,$m_code_l);
	//	echo '</ul></div></li>';



	}	
}




class UpdateMatching extends DbConnect{
	function __construct(){
		$conn=parent::connect();
		$all_accounts=$conn->query("SELECT * FROM accounts");
		$ct_al_ant = $all_accounts->rowCount();
		if ($ct_al_ant >= 1) {
			while ($ft_all_accounts=$all_accounts->fetch(PDO::FETCH_ASSOC)) {
				$acnt_id=$ft_all_accounts['account_id'];

					?>
					<script type="text/javascript">
						var Maching=true;
						var ds="<?php echo $acnt_id?>";
					     $.ajax({
					        url: "../assests/ajax/main.php",data:{Maching:Maching,ds:ds},
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





 if (isset($_GET['DoMaching'])) {
 	$UpdateMatching = new UpdateMatching();
 }

 if (isset($_GET['Maching'])) {
 	$match_code=rand(0,1000000000);
 	new Maching(get_input('ds'),$match_code);
 	new Maching_right_l(get_input('ds'),$match_code);
 	
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
			 				$av_all=$ft_sel_bal['balance_all'];
			 				$av_encashe=$ft_sel_bal['balance_encashed'];
			 				$av_total=$ft_sel_bal['balance_total'];
			 				if ($av_com!=$all_balance) {	//====== Checking if there is any commission changes
			 					// $new_comm_bal=$all_balance+$av_com;
			 					$new_com=$all_balance;
			 					$new_all=$av_match+$av_upgrade+$new_com;
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
						case 2:
							$new_bal=16300;
							break;
						case 3:
							$new_bal=4300;
							break;
						case 4:
							$new_bal=3000;
							break;
						case 5:
							$new_bal=2057;
							break;
						case 6:
							$new_bal=1378;
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
			 				if ($in_balanc_ok) {		//============ New Balanmce Inserted
			 					
			 				}else{
			 				}

			 			}else{		//======If Balance exists
			 				$ft_sel_bal=$sel_bal->fetch(PDO::FETCH_ASSOC);
			 				$av_comm=$ft_sel_bal['balance_commission'];
			 				$av_match=$ft_sel_bal['balance_matching'];
			 				$av_upgrade=$ft_sel_bal['balance_upgrade'];
			 				$av_all=$ft_sel_bal['balance_all'];
			 				$av_encashe=$ft_sel_bal['balance_encashed'];
			 				$av_total=$ft_sel_bal['balance_total'];
			 				if ($av_upgrade!=$new_all_bal) {	//====== Checking if there is any commission changes
			 					// $new_comm_bal=$all_balance+$av_com;
			 					$new_upgr=$new_all_bal;
			 					$new_all=$av_match+$av_comm+$new_upgr;
			 					$new_ttl=$new_all-$av_encashe;
			 					$upd_bal=$conn->query("UPDATE balance SET balance_upgrade='$new_upgr',balance_all='$new_all',balance_total='$new_ttl' WHERE balance_account='$myId'");
			 					if ($upd_bal) {			//======== New balance records updated
			 						echo "Yesssss";
			 					}else{
			 						echo "Nooo";
			 					}
			 				}else{		//============= Nothing changed
			 					
			 				}
			 			}
			}else{
				//echo "No";
			}
			 	}

			function balance_matching($myId){
				$conn=parent::connect();
				$sel_math=$conn->query("SELECT matching_earn AS matching,matching_earn FROM matching WHERE matching_owner='$myId' ORDER BY matching_id DESC LIMIT 1");
				$cnt_sel_math=$sel_math->rowCount();
				$ft_sel_mat=$sel_math->fetch(PDO::FETCH_ASSOC);
				$all_match_bal=($ft_sel_mat['matching']*8000);
				if ($cnt_sel_math>=1) {
					$sel_bal=$conn->query("SELECT balance.*,accounts.* FROM balance,accounts WHERE balance.balance_account=accounts.account_id AND balance.balance_account=$myId");
			 			$cnt_sel_bal=$sel_bal->rowCount();
			 		if ($cnt_sel_bal<1) {		//==== If no balance exists
			 						$in_balanc=$conn->prepare("INSERT INTO balance(balance_account,balance_matching,balance_all,balance_total,balance_status) VALUES(?,?,?,?,?)");
			 						$in_balanc->bindValue(1,$myId);
			 						$in_balanc->bindValue(2,$all_match_bal);
			 						$in_balanc->bindValue(3,$all_match_bal);
			 						$in_balanc->bindValue(4,$all_match_bal);
			 						$in_balanc->bindValue(5,"E");
			 						$in_balanc_ok = $in_balanc->execute();
			 						if ($in_balanc_ok) {		//============ New Balanmce Inserted
			 							  //echo "Yes";
			 						}else{
			 								  //echo "Noo";
			 						}

			 			}else{		//======== If Balance exists
			 					//======If Balance exists
			 				$ft_sel_bal=$sel_bal->fetch(PDO::FETCH_ASSOC);
			 				$av_comm=$ft_sel_bal['balance_commission'];
			 				$av_match=$ft_sel_bal['balance_matching'];
			 				$av_upgrade=$ft_sel_bal['balance_upgrade'];
			 				$av_all=$ft_sel_bal['balance_all'];
			 				$av_encashe=$ft_sel_bal['balance_encashed'];
			 				$av_total=$ft_sel_bal['balance_total'];
			 				if ($av_match!=$all_match_bal) {	//====== Checking if there is any commission changes
			 					// $new_comm_bal=$all_balance+$av_com;
			 					$new_mtc=$all_match_bal;
			 					$new_all=$av_upgrade+$av_comm+$all_match_bal;
			 					$new_ttl=$new_all-$av_encashe;
			 					$upd_bal=$conn->query("UPDATE balance SET balance_matching='$all_match_bal',balance_all='$new_all',balance_total='$new_ttl' WHERE balance_account='$myId'");
			 					if ($upd_bal) {			//======== New balance records updated
			 						//echo "Yesssss";
			 					}else{
			 						//echo "Nooo";
			 					}
			 				}else{		//============= Nothing changed
			 					//echo "DDDDDDDDDDDDDDD";
			 				}
			 			}
				}
			}



			 	function __construct($myId)
			 	{
			 //============================== UPDATE FROM ALL ACCOUNTS
			 		$conn=parent::connect();
			 		$sel_all_acnts=$conn->query("SELECT account_id FROM accounts");
			 		$cnt_sel_all_acnts = $sel_all_acnts->rowCount();
			 		if ($cnt_sel_all_acnts>=1) {
			 			while ($ft_sel_all_acnts=$sel_all_acnts->fetch(PDO::FETCH_ASSOC)) {
			 				$ant_id = $ft_sel_all_acnts['account_id'];
								self::balance_matching($ant_id);
								self::balance_upgrades($ant_id);
								self::balance_commission($ant_id);
			 			}
			 		}
			 	}
}

 if (isset($_GET['UpdateBalances'])) {
 	$UpdateBalances = new UpdateBalances(get_input('ds'));
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
	$sel_en_method = $conn->query("SELECT * FROM encash_method WHERE encash_method_account='$my_ac_idd' AND ((encash_method_equity!= null) OR (encash_method_mobile!=null))");
	$cnt_sel_en_method = $sel_en_method->rowCount();
	if ($cnt_sel_en_method==1) {
		$ft_sel_en_method->fetch(PDO::FETCH_ASSOC);
		$my_enc_type;
		switch ($type) {
			case 'Equity':
				$my_enc_type = $ft_sel_en_method['encash_method_equity'];
				$sel_if_exist_eqt = $conn->query("SELECT * FROM encash_method WHERE encash_method_account='$my_ac_idd' AND encash_method_equity!=null");
				$cnt_sel_if_exist_eqt=$sel_if_exist_eqt->rowCount();
				if ($cnt_sel_if_exist_eqt==1) {
					echo "Bank account:<p class='account-number'>".$ft_sel_en_method['encash_method_equity']."</p>";
				}else{
					echo "No Equity account assigned to your account";
				}
				break;
			case 'MobileMoney':
				$my_enc_type = $ft_sel_en_method['encash_method_mobile'];
				$sel_if_exist_mbl = $conn->query("SELECT * FROM encash_method WHERE encash_method_account='$my_ac_idd' AND encash_method_mobile !=null");
				$cnt_sel_if_exist_mbl = $sel_if_exist_mbl->rowCount();
				if ($cnt_sel_if_exist_mbl==1) {
					echo "Mobile account:<p class='account-number'>".$ft_sel_en_method['encash_method_mobile']."</p>";
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
		echo "No such Encashment method for your account";
	}
	}
}
if (isset($_GET['onSelectEncash'])) {
	new Display_based_encash($my_acount_id,get_input('encash-type'));
}
































































































































?>

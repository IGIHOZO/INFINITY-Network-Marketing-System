<?php
require_once("sessions.php");
ver_session();
require_once("../main/classes.php");
$admin = new AdminAccountData($my_acount_id);
echo $admin->admin_encashment_list_request();			//ALL ENCASHMENTS
echo $admin->cash_admin_encashment_list_request();		//CASH ENCASHMENTS
echo $admin->mtn_admin_encashment_list_request();		//MTN ENCASHMENTS
echo $admin->equity_admin_encashment_list_request();	//EQUITY ENCASHMENTS 
echo $admin->register_on_balance_encashment_list();		//ON BALANCE REGISTRATION ENCASHMENTS 
echo $admin->pending_encashment_list();					//PENDING ENCASHMENTS
echo $admin->confirmed_encashment_list();				//CONFIRMED ENCASHMENTS
echo $admin->pending_equity_encashment_list();		//EQUITY PENDING ENCASHMENTS 
echo $admin->pending_mtn_encashment_list();					//MTN PENDING ENCASHMENTS
echo $admin->pending_cash_encashment_list();				//CASH PENDING ENCASHMENTS
?>
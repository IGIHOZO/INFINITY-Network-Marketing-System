<?php
require_once("sessions.php");
ver_session();
require_once("../main/classes.php");
$admin = new AdminAccountData($my_acount_id);


echo $admin->today_registered_accounts();										//ACOUNTS REGISTERRED TODAY

echo "<br><br><br>";

echo $admin->certain_day_registered_accounts('2019-07-25');						//ACOUNTS REGISTERRED A CERTAIN DAY

echo "<br><br><br>";

echo "NUMBER OF ALL SYSTEM ACCOUNTS  <br>";
echo "---------------------------------------------------------------- <br>";
echo $admin->num_all_accounts();												// NUMBER OF ALL ACCOUNTS

echo "<br><br><br>";

echo "NUMBER OF ALL SYSTEM PENDING  <br>";
echo "---------------------------------------------------------------- <br>";
echo $admin->num_all_pending_accounts();										// NUMBER OF ALL PENDING

echo "<br><br><br>";

echo "NUMBER OF ALL SYSTEM CONFIRMED  <br>";
echo "---------------------------------------------------------------- <br>";
echo $admin->num_all_comfirmed_accounts();										// NUMBER OF ALL CONFIRMED

echo "<br><br><br>";

echo "NUMBER OF TODAY's REGISTERD ACCOUNTS  <br>";
echo "---------------------------------------------------------------- <br>";
echo $admin->num_today_accounts();												// NUMBER OF TODAY's REGISTERD ACCOUNTS

echo "<br><br><br>";


echo "NUMBER OF ACOUNTS REGISTERED AT A CERTAIN DAY   (From Datepicker)<br>";
echo "---------------------------------------------------------------- <br>";
echo $admin->num_certain_day_accounts('2019-07-25');							// NUMBER OF ACOUNTS REGISTERRED A CERTAIN DAY (From Datepicker)

echo "<br><br><br>";


echo "TOTAL SYSTEM ENCASHED BALANCE  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->ttl_sys_encash_gross();											// TOTAL SYSTEM ENCASHED BALANCE

echo "<br><br><br>";

echo "TOTAL SYSTEM AVAILABLE BALANCE (Balance_total)  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->ttl_sys_balance_available();										//  TOTAL SYSTEM AVAILABLE BALANCE (Balance_total)

echo "<br><br><br>";

echo "TOTAL SYSTEM ALL BALANCE  (Balance_all)  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->ttl_sys_balance_all();												//  TOTAL SYSTEM AVAILABLE BALANCE (Balance_all)

echo "<br><br><br>";

echo "TOTAL SYSTEM INDEIRECT BALANCE   <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->ttl_sys_upgrades_available();										//  TOTAL SYSTEM INDEIRECT BALANCE 

echo "<br><br><br>";

echo "TOTAL SYSTEM MATCHING BALANCE   <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->ttl_sys_matching_available();										//  TOTAL SYSTEM MATCHING BALANCE 

echo "<br><br><br>";

echo "TOTAL SYSTEM DAILY SPONSOR BONUS BALANCE (daily sponsoring)  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->ttl_sys_daily_sponsor_bonus_available();							//  TOTAL SYSTEM DAILY SPONSOR BONUS BALANCE (daily sponsoring)

echo "<br><br><br>";

echo "TOTAL SYSTEM ACCOUNT BONUS BALANCE (direct acc_sponsoring)  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->ttl_sys_direct_sponsor_bonus_available();							//  TOTAL SYSTEM ACCOUNT BONUS BALANCE (direct acc_sponsoring)

echo "<br><br><br>";

echo "TOTAL SYSTEM COMMISSION BONUS BALANCE   <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->ttl_sys_commission_balance_available();							//  TOTAL SYSTEM COMMISSION BONUS BALANCE 

echo "<br><br><br>";

echo "TEMPORALY <b>PROFIT / LOSS</b> MEASUREMENT  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->general_profit_or_loss();											//  TEMPORALY <b>PROFIT / LOSS</b> MEASUREMENT 

echo "<br><br><br>";

echo "TOTAL SYSTEM ENCASHMENT TAX+SYSTEM_FEES (17%)  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->all_sys_tax_17_balance();											//  TOTAL SYSTEM ENCASHMENT TAX+SYSTEM_FEES (17%)

echo "<br><br><br>";

echo "TOTAL SYSTEM ENCASHMENT TAX ONLY (15%)  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->all_sys_tax_15_balance();											// TOTAL SYSTEM ENCASHMENT TAX ONLY (15%) 

echo "<br><br><br>";

echo "TOTAL SYSTEM ENCASHMENT SYSTEM FEES (2%)  <br>";
echo "----------------------------------------------------------- <br>";
echo $admin->all_sys_tax_2_sys_fees_balance();									//  TOTAL SYSTEM ENCASHMENT SYSTEM FEES (2%) 

echo "<br><br><br>";







?>
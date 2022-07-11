<aside class="sidebar" style="background:#0a193d;">
  <nav class="sidebar-nav">
    <ul class="metismenu" id="menu" style="display:none;">
      <li style="background-image:url('../img/bg-01.jpg');">
        <header>
          <style>
            .imglogoty{width:50%;height:60px;margin-left:25%;}
          </style>
      <img src="../img/final_logo_blue.png" class="imglogoty">

  <img src="../img/user.png" class="imglogo">
  <center>

  <p class="p-top"><?php echo $agent->member_name($my_acount_id);?></p>
  <p class="accountinfo" style="">CURRENT ACCOUNT: <?php echo $agent->my_pincode($my_acount_id);?></p>

  </header>
      </li>

      <li class="active">
        <a href="dashboard" aria-expanded="true">
        <i class="zmdi zmdi-view-dashboard"></i>
          <span class="sidebar-nav-item"> Dashboard</span>
        </a>
      </li>

      <li>
        <a href="javascript:;" aria-expanded="true">
           <i class="zmdi zmdi-settings"></i>
          Settings<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
          <li><a href="profile"><i class="zmdi zmdi-account-o"></i> My Profile</a></li>
<li><a href="password-change"><i class="zmdi zmdi-lock-outline"></i> Change password</a></li>
          <li><a href="../assests/ajax/main.php?lg=true&cat=Agent"><i class="zmdi zmdi-power"></i> Logout</a></li>
        </ul>
      </li>

      <li>
        <a href="javascript:;" aria-expanded="false">
<i class="zmdi zmdi-accounts"></i> Members<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
<li>
  <li><a href="Direct-add-member"><i class="zmdi zmdi-accounts-add"></i> Activate From balance</a></li>
<li>
<a href="downlines"><i class="zmdi zmdi-accounts-list"></i> View Your tree</a></li>
        <li><a href="downlines"><i class="zmdi zmdi-accounts-list"></i> Follow Up</a></li>
        </ul>
      </li>

      <li style="display:none;">
        <a href="javascript:;" aria-expanded="false">
           <i class="zmdi zmdi-money-box"></i>
        Incomes<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
          <li><a href="?"><i class="zmdi zmdi-money"></i> Matching bonus</a></li>
    <li><a href="make-encashment"><i class="zmdi zmdi-money-off"></i>Indirect Bonus</a></li>
          <li><a href="?"><i class="zmdi zmdi-money"></i> Commission</a></li>
        </ul>
      </li>

      <li>
        <a href="javascript:;" aria-expanded="false">
           <i class="zmdi zmdi-money-box"></i>
          Encashment<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
<li><a href="make-encashment"><i class="zmdi zmdi-money-off"></i> Make encashment</a></li>
      <li><a href="encashment-history"><i class="zmdi zmdi-money"></i> Encashment history</a></li>
        </ul>
      </li>

     



    </ul>
  </nav>
</aside>


<script>
  jQuery('#menu').metisMenu().show();
</script>

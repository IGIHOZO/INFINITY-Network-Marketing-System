<aside class="sidebar" style="background:#0a193d;">
  <nav class="sidebar-nav">
    <ul class="metismenu" id="menu" style="display:none;">
      <li style="background-image:url('../img/bg-01.jpg');">
        <header>
        <img src="../img/logo.png" class="imglogoty">

  <img src="../img/user.png" class="imglogo">
  <center>

  <p class="p-top"><?php echo $admin->admin_name($my_acount_id);?></p>

  </header>
      </li>

      <li class="active">
  <a href="javascript:;" aria-expanded="true"><i class="zmdi zmdi-view-dashboard"></i>
        <span class="sidebar-nav-item">Dashboard</span><span class="fa arrow"></span></a>
        <ul aria-expanded="false">
<li><a href="?"><i class="zmdi zmdi-account-o"></i> Web Analytics</a></li>
<!-- website vistors,login attempts ,likes on blog and others , error logs -->
<li><a href="?"><i class="zmdi zmdi-lock-outline"></i> Sales Monitoring</a></li>
<!-- Distribution datas   -->
<li><a href="?"><i class="zmdi zmdi-plus-square"></i> Finance Monitoring</a></li>
<!-- Income,loss,share holding,etc,expanses,other management books -->
<li><a href="?"><i class="zmdi zmdi-plus-square"></i> Products Management</a></li>
<!-- purchase products,sold products, income on products ,etc -->
        </ul>
      </li>

      <li>
        <a href="javascript:;" aria-expanded="true">
    <i class="zmdi zmdi-settings"></i> Settings<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
<li><a href="?"><i class="zmdi zmdi-account-o"></i> My Profile</a></li>
<li><a href="?"><i class="zmdi zmdi-lock-outline"></i> Change password</a></li>
<li><a href="?"><i class="zmdi zmdi-plus-square"></i> Add another system account</a></li>
<li><a href="?"><i class="zmdi zmdi-plus-square"></i> Manage branch</a></li>
<li><a href="?"><i class="zmdi zmdi-plus-square"></i> Manage Employees</a></li>

<li><a href="mlm-settings"><i class="zmdi zmdi-account-o"></i> Startup settings</a></li>
<!-- Setting matching bonus,point,upgrades,commision,distributor password change date,maximum income on distributor,pincode format,removing his/her ihttps://stackoverflow.com/questions/1695115/how-do-i-draw-the-lines-of-a-family-tree-using-html-css#ncome depending on
a given problem /setting a distributor income to another account -->


<li><a href="?"><i class="zmdi zmdi-power"></i> Logout</a></li>
        </ul>
      </li>

      <li>
        <a href="javascript:;" aria-expanded="false">
           <i class="zmdi zmdi-money-box"></i>
          System Accounts<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
          <li><a href="?"><i class="zmdi zmdi-money-off"></i> RSEMPIRE-1</a></li>
          <li><a href="?"><i class="zmdi zmdi-money-off"></i> RSEMPIRE-2</a></li>
          <li><a href="?"><i class="zmdi zmdi-money"></i> RSEMPIRE-3</a></li>
           <li><a href="?"><i class="zmdi zmdi-money"></i> RSEMPIRE-4</a></li>

        </ul>
      </li>

      <li>
        <a href="javascript:;" aria-expanded="false">
<i class="zmdi zmdi-accounts"></i>
          Members<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
    <li><a href="?"><i class="zmdi zmdi-accounts-add"></i> Manage Members</a></li>
    <!-- update,delete,disable accounts, and changing distributors password,viewing his/her profile -->
    <li><a href="member-tree"><i class="zmdi zmdi-accounts-list"></i> Members Tree</a></li>
    <!-- view hiearichical data of an given member -->
    <li><a href="Pincode"><i class="zmdi zmdi-accounts-list"></i> Generate Pincode</a></li>
    <!-- generating new pincode for new members -->
    <li><a href="?"><i class="zmdi zmdi-accounts-list"></i> Members Earnings</a></li>
    <!-- Top Earners,Least earners -->
        </ul>
      </li>





      <li>
        <a href="javascript:;" aria-expanded="false">
           <i class="zmdi zmdi-money-box"></i>
          Encashment<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
          <li><a href="?"><i class="zmdi zmdi-money-off"></i> Encashment history</a></li>
          <li><a href="?"><i class="zmdi zmdi-money"></i> Failed Encashment</a></li>
          <li><a href="?"><i class="zmdi zmdi-refresh-sync-off"></i></a></li>

        </ul>
      </li>

      <li>
        <a href="javascript:;" aria-expanded="false">
           <i class="zmdi zmdi-money-box"></i>
           Transactions<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
          <li><a href="?"><i class="zmdi zmdi-money-off"></i> Members Transaction history</a></li>
      <li><a href="?"><i class="zmdi zmdi-money"></i> Company Transaction history</a></li>
          <li><a href="?"><i class="zmdi zmdi-money"></i> Failed Transactions</a></li>
          <li><a href="?"><i class="zmdi zmdi-refresh-sync-off"></i></a></li>
        </ul>
      </li>

     <li>
        <a href="javascript:;" aria-expanded="false">
           <i class="zmdi zmdi-money-box"></i>
          Sales<span class="fa arrow"></span></a>
        <ul aria-expanded="false">
          <li><a href="?"><i class="zmdi zmdi-money-off"></i>Sales From Online retailing</a></li>
          <li><a href="?"><i class="zmdi zmdi-money"></i> Failed Encashment</a></li>
          <li><a href="?"><i class="zmdi zmdi-refresh-sync-off"></i></a></li>

        </ul>
      </li>




    </ul>
  </nav>
</aside>


<script>
  jQuery('#menu').metisMenu().show();
</script>

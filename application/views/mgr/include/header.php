<!-- Logo -->
<a href="/mgr" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>KURLY</b></span>
  <!-- logo for regular state and mobile devices -->
<!--  <span class="logo-lg"><b>PINEWOOD</b></span>-->
  <span style="font-size: 16px;"><b>KURLY</b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </a>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="glyphicon glyphicon-user"></i>
          <span class="hidden-xs"><?=$this->session->userdata('AName')?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <i class="glyphicon glyphicon-user"></i>
            <p>
                <?=$this->session->userdata('ALevel')?> - <?=$this->session->userdata('ALevelName')?>
                <small>Last Visit : <?=date('Y-m-d H:i', strtotime($this->session->userdata('ALastLoginDate')))?></small>
            </p>
          </li>
          <!-- Menu Body -->

          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-right">
              <a href="/mgr/login/logout" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
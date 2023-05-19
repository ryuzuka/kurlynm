<section class="sidebar" style="height: auto;">
	<!-- Sidebar user panel -->
	<div class="user-panel">
	<div class="pull-left image">
	  <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
        <i class="glyphicon glyphicon-user"></i>

	</div>
	<div class="pull-left info">
	  <p>Hello, <?=$this->session->userdata('AName')?>님</p>
	  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	</div>
	</div>
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
<?php
function cntArraySizeofValue($array, $argument, $value){
    $cnt = 0;
    foreach($array as $i=>$list){
        if($list->$argument==$value){
            $cnt++;
        }
    }
    return $cnt;
}
?>
<?php
    $tmp_main_code = "";
    $jj = 0;
    if($adminMenus){
        foreach($adminMenus as $i=>$list){
            // 서브메뉴 카운트
            $submenuCnt = cntArraySizeofValue($adminMenus, "main_code", $list->main_code);

            if($submenuCnt>1){
                $jj++;
                if($list->main_code<>$tmp_main_code){
?>
    <li class="treeview <?php if ($list->main_code == substr($current_menu_code, 0, 2)) { ?> active<?php } ?>">
      <a href="#">
          <i class="fa <?=$list->main_icon?>"></i><span><?=$list->main_name?></span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li <?php if ($list->sub_code == $current_menu_code) { ?> class="active"<?php } ?>><a href="<?=$list->sub_url?>"><i class="fa fa-circle-o"></i> <?=$list->sub_name?></a></li>
<?php
                } else {
?>
        <li <?php if ($list->sub_code == $current_menu_code) { ?> class="active"<?php } ?>><a href="<?=$list->sub_url?>"><i class="fa fa-circle-o"></i> <?=$list->sub_name?></a></li>
<?php
                }

                if($jj==$submenuCnt){
                    echo "</ul></li>";
				    $jj = 0;
                }
?>
<?php
            } else {
?>
    <li <?php if ($list->main_code == $current_menu_code) { ?> class="active"<?php } ?>>
        <a href="<?=$list->main_url?>">
            <i class="fa <?=$list->main_icon?>"></i> <span><?=$list->main_name?></span>
        </a>
    </li>
<?php
            }
            $tmp_main_code = $list->main_code;
        }
    }
?>
</ul>
</section>
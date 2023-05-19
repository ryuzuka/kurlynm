<script type="text/javascript">
<!--
	// 필수 입력 값 포커스 이동
	function setFocus(obj){
		obj.focus();
		obj.css('background', '#ff0'); // will change the background to red
	}

	$(document).ready(function(){
        // Insert
		$(".btn-popup").click(function(){
            var menu_code = $(this).data('menu_code');
            window.open("/mgr/adminauth/popAdminList?menu_code="+menu_code, "AdminList", "width=600,height=600,scrollbars=yes").focus();
        });
        
        // delete
        $('.btn-default').dblclick(function(){
            var admin_id = $(this).data('admin_id');
            var menu_code = $(this).data('menu_code');
            var yn = confirm("삭제하시겠습니까?");
//            alert(admin_id+"x"+menu_code);
            if (yn) {
                //$('#hiddenForm').attr('action', '/mgr/adminauth/delete?admin_id='+admin_id+'&menu_code='+menu_code).submit();
                location.href = "/mgr/adminauth/delete?admin_id="+admin_id+"&menu_code="+menu_code;
            } else {
                return false;
            }
        });
	});
//-->
</script>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert-info">
                ※ 관리자 계정의 권한을 삭제하려면 관리자 아이디을 더블클릭 하십시오.
            </div>
        </div>
    </div>
    
    <br>
    
    <div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <?php
                $temp_main_code = "";
                if ($adminAuthList) {
                    foreach($adminAuthList as $i => $list){
                        if ($temp_main_code != $list->main_code) {
                            if ($temp_main_code != "") {
                ?>
                </div>
                <?php
                            }
                            $temp_main_code = $list->main_code;
                ?>
                <div class="box-body">
                    <h4 class="page-header"><?=$list->main_name?></h4>
                <?php
                        }
                        
                        if ($list->admin_id_list) {
                            $arrayAdminList = explode(',', $list->admin_id_list);
                        } else {
                            $arrayAdminList = null;
                        }
                ?>
                    <div class="form-group clearfix">
                        <label class="col-sm-3 control-label"><i class="fa fa-circle-o"></i> &nbsp; <?=$list->sub_name?></label>
                        <div class="col-sm-9">
                            <a href="javascript:void(0);" class="btn-popup" data-menu_code="<?=$list->sub_code?>"><i class="fa fa-plus-square"></i></a>
                            <?php
                            if ($arrayAdminList) {
                                foreach($arrayAdminList as $key => $val){
                                    $arrayAdmin = explode('|', $val);
                            ?>
                            <button class="btn btn-default btn-sm" style="margin-left: 15px;" data-menu_code="<?=$list->sub_code?>" data-admin_id="<?=$arrayAdmin[0]?>" data-toggle="tooltip" data-placement="top" title="<?=$arrayAdmin[1]?>" data-original-title="<?=$arrayAdmin[1]?>"><?=$arrayAdmin[0]?></button>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php
                    }
                }
                ?>
                </div>
            </div>
            
        </div>
    </div>
</section>

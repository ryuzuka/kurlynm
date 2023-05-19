<script type="text/javascript">
<!--
	// 필수 입력 값 포커스 이동
	function setFocus(obj){
		obj.focus();
		obj.css('background', '#ff0'); // will change the background to red
	}

	$(document).ready(function(){
        // Insert
		$("#btn-insert").click(function(){
            var obj;

            obj = $('#menu_icon_add');
            if (obj.val() == "") {
                alert("메뉴 아이콘을 입력하세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#menu_name_add');
            if (obj.val() == "") {
                alert("메뉴명을 입력하세요.");
                setFocus(obj);
                return false;
            }

//            obj = $('#url_add');
//            if (obj.val() == "") {
//                alert("메뉴경로를 입력하세요.");
//                setFocus(obj);
//                return false;
//            }
/*
            obj = $('#auth_add');
            if (obj.val() == "") {
                alert("관리자 권한 등급을 입력하세요.");
                setFocus(obj);
                return false;
            }
*/
            obj = $('#sequence_add');
            if (obj.val() == "") {
                alert("메뉴 순서를 입력하세요.");
                setFocus(obj);
                return false;
            }
            
            var yn = confirm("추가하시겠습니까?");
            if (yn) {
                //$('#addForm').attr('action', '/Mgr/code/add').submit();
                $('#addForm').submit();
            } else {
                return false;
            }
        });
        
        // update
        $('.btn-update').click(function(){
            var obj;
            var menu_code = $(this).data('menu_code');
            
            obj = $('#menu_icon_'+menu_code);
            if (obj.val() == "") {
                alert("메뉴 아이콘을 입력하세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#menu_name_'+menu_code);
            if (obj.val() == "") {
                alert("메뉴명을 입력하세요.");
                setFocus(obj);
                return false;
            }
            
//            obj = $('#url_'+menu_code);
//            if (obj.val() == "") {
//                alert("메뉴경로를 입력하세요.");
//                setFocus(obj);
//                return false;
//            }
/*
            obj = $('#auth_'+menu_code);
            if (obj.val() == "") {
                alert("관리자 권한 등급을 입력하세요.");
                setFocus(obj);
                return false;
            }
*/
            obj = $('#sequence_'+menu_code);
            if (obj.val() == "") {
                alert("메뉴 순서를 입력하세요.");
                setFocus(obj);
                return false;
            }
            
            var yn = confirm("수정하시겠습니까?");
            if (yn) {
                $('#menu_code').val(menu_code);
                $('#menu_icon').val($('#menu_icon_'+menu_code).val());
                $('#menu_name').val($('#menu_name_'+menu_code).val());
                $('#url').val($('#url_'+menu_code).val());
                $('#auth').val($('#auth_'+menu_code).val());
                $('#is_use').val($('#is_use_'+menu_code).val());
                $('#sequence').val($('#sequence_'+menu_code).val());
                $('#listForm').attr('action', '/mgr/adminmenu/update').submit();
            } else {
                return false;
            }
        });
        
        // delete
        $('.btn-delete').click(function(){
            var menu_code = $(this).data('menu_code');
            var yn = confirm("삭제하시겠습니까?");
            if (yn) {
                $('#menu_code').val(menu_code);
                $('#listForm').attr('action', '/mgr/adminmenu/delete').submit();
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
            <div class="box">    
                <div class="box-body table-responsive">
                    <form id="listForm" name="listForm" method="post" class="form-horizontal">
                        <input type="hidden" id="parent" name="parent" value="<?=$parent?>">
                        <input type="hidden" id="menu_code" name="menu_code" value="">
                        <input type="hidden" id="menu_icon" name="menu_icon" value="">
                        <input type="hidden" id="menu_name" name="menu_name" value="">
                        <input type="hidden" id="url" name="url" value="">
                        <input type="hidden" id="auth" name="auth" value="">
                        <input type="hidden" id="is_use" name="is_use" value="">
                        <input type="hidden" id="sequence" name="sequence" value="">
                    <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                        <colgroup>
                            <col width="100">
                            <?php if ($parent == "") { ?><col width="100"><?php } ?>
                            <col width="200">
                            <col width="250">
                            <col width="150">
                            <col width="80">
                            <col width="80">
                            <col width="*">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Menu Code</th>
                                 <?php if ($parent == "") { ?><th class="text-center">Menu Icon</th><?php } ?>
                                <th class="text-center">Menu Name</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">Admin Level</th>
                                <th class="text-center">Use</th>
                                <th class="text-center">Sequence</th>
                                <th class="text-center">Update/Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($adminMenuList) {
                                foreach($adminMenuList as $i => $list){
                            ?>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><?=$list->menu_code?></td>
                                 <?php if ($parent == "") { ?><td><input type="text" class="form-control input-sm" id="menu_icon_<?=$list->menu_code?>" name="menu_icon_<?=$list->menu_code?>" value="<?=$list->menu_icon?>"></td><?php } ?>
                                <td><input type="text" class="form-control input-sm" id="menu_name_<?=$list->menu_code?>" name="menu_name_<?=$list->menu_code?>" value="<?=$list->menu_name?>"></td>
                                <td><input type="text" class="form-control input-sm" id="url_<?=$list->menu_code?>" name="url_<?=$list->menu_code?>" value="<?=$list->url?>"></td>
                                <td><input type="text" class="form-control input-sm" id="auth_<?=$list->menu_code?>" name="auth_<?=$list->menu_code?>" value="<?=$list->auth?>"></td>
                                <td style="vertical-align:middle;">
                                    <select id="is_use_<?=$list->menu_code?>" name="is_use_<?=$list->menu_code?>" class="form-control input-sm">
                                        <option value="Y"<?=$list->is_use == "Y" ? " selected='selected'" : ""?>>Yes</option>
                                        <option value="N"<?=$list->is_use == "N" ? " selected='selected'" : ""?>>No</option>
                                    </select>
                                </td>
                                <td style="vertical-align:middle;"><input type="text" id="sequence_<?=$list->menu_code?>" name="sequence_<?=$list->menu_code?>" class="form-control input-sm" style="text-align:center;" placeholder="Sequence" value="<?=$list->sequence?>"></td>
                                <td class="text-center" style="vertical-align:middle;">
                                    <?php if (strlen($parent) < 2) { ?><a href="/mgr/adminmenu?parent_code=<?=$list->menu_code?>" class="btn btn-success btn-sm" style="width:60px;">Sub</a><?php } ?>
                                    <input type="button" class="btn btn-info btn-sm btn-update" style="width:60px;" value="Update" data-menu_code="<?=$list->menu_code?>">
                                    <input type="button" class="btn btn-danger btn-sm btn-delete" style="width:60px;" value="Delete" data-menu_code="<?=$list->menu_code?>">
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="9" class="text-center" style="vertical-align:middle;">등록된 데이터가 없습니다.</td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12">
            <label for="Menu Add" style="color:#253C4F"><i class="glyphicon glyphicon-plus"></i> Menu Add</label>
            <div class="box">    
                <div class="box-body table-responsive">
                    <form id="addForm" name="addForm" method="post" action="/mgr/adminmenu/insert" class="bs-docs-example form-horizontal">
                        <input type="hidden" name="parent" value="<?=$parent?>">
                    <table class="table table-sub table-bordered responsive">
                        <colgroup>
                            <col width="100">
                            <?php if ($parent == "") { ?><col width="100"><?php } ?>
                            <col width="200">
                            <col width="250">
                            <col width="150">
                            <col width="80">
                            <col width="80">
                            <col width="*">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Menu Code</th>
                                <?php if ($parent == "") { ?><th class="text-center">Menu Icon</th><?php } ?>
                                <th class="text-center">Menu Name</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">Admin Level</th>
                                <th class="text-center">Use</th>
                                <th class="text-center">Sequence</th>
                                <th class="text-center">ADD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><strong>Add</strong></td>
                                <?php if ($parent == "") { ?><td><input type="text" class="form-control input-sm" id="menu_icon_add" name="menu_icon" placeholder="Menu Icon" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Menu Icon" value=""></td><?php } ?>
                                <td><input type="text" class="form-control input-sm" id="menu_name_add" name="menu_name" placeholder="Menu Name" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Menu Name" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="url_add" name="url" placeholder="Link" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Link" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="auth_add" name="auth" placeholder="Auth" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Auth" value=""></td>
                                <td style="vertical-align:middle;">
                                    <select id="is_use_add" name="is_use" class="form-control input-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Use">
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </td>
                                <td style="vertical-align:middle;"><input type="text" id="sequence_add" name="sequence" class="form-control input-sm" style="text-align:center;" placeholder="Sequence" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Sequence" value="<?=$next_seq?>"<?=$next_seq == 1 ? " readonly" : "" ?>></td>
                                <td class="text-center" style="vertical-align:middle;">
                                    <input type="button" id="btn-insert" class="btn btn-primary btn-sm" style="width:60px;" value="Add">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

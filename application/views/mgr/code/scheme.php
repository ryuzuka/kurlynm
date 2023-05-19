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

            obj = $('#scheme_code_add');
            if (obj.val() == "") {
                alert("Type Code를 입력하세요.");
                setFocus(obj);
                return false;
            }
            if (obj.val().length != 3) {
                alert("Type Code는 반드시 영문,숫자 3자리로 작성하세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#scheme_name_add');
            if (obj.val() == "") {
                alert("Type Name을 입력하세요.");
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
            var scheme_code = $(this).data('scheme_code');
            
            obj = $('#scheme_name_'+scheme_code);
            if (obj.val() == "") {
                alert("Type Name을 입력하세요.");
                setFocus(obj);
                return false;
            }
            
            var yn = confirm("수정하시겠습니까?");
            if (yn) {
                $('#scheme_code').val(scheme_code);
                $('#scheme_name').val($('#scheme_name_'+scheme_code).val());
                $('#desc').val($('#desc_'+scheme_code).val());
                $('#listForm').attr('action', '/mgr/code/schemeupdate').submit();
            } else {
                return false;
            }
        });
        
        // delete
        $('.btn-delete').click(function(){
            var scheme_code = $(this).data('scheme_code');
            var yn = confirm("삭제하시겠습니까?");
            if (yn) {
                $('#scheme_code').val(scheme_code);
                $('#listForm').attr('action', '/mgr/code/schemedelete').submit();
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
                        <input type="hidden" id="scheme_code" name="scheme_code" value="">
                        <input type="hidden" id="scheme_name" name="scheme_name" value="">
                        <input type="hidden" id="desc" name="desc" value="">
                    <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                        <colgroup>
                            <col width="100">
                            <col width="300">
                            <col width="400">
                            <col width="*">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Type Code</th>
                                <th class="text-center">Type Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Update/Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($schemeList) {
                                foreach($schemeList as $i => $list){
                            ?>
                            <tr>
                                <td class="text-center"><?=$list->scheme_code?></td>
                                <td><input type="text" class="form-control input-sm" id="scheme_name_<?=$list->scheme_code?>" name="scheme_name_<?=$list->scheme_code?>" maxlength="20" value="<?=$list->scheme_name?>"></td>
                                <td><input type="text" class="form-control input-sm" id="desc_<?=$list->scheme_code?>" name="desc_<?=$list->scheme_code?>" maxlength="50" value="<?=$list->desc?>"></td>
                                <td class="text-center">
                                    <a href="/mgr/code/codes?scheme_code=<?=$list->scheme_code?>" class="btn btn-success btn-sm" style="width:60px;">Codes</a>
                                    <input type="button" class="btn btn-info btn-sm btn-update" style="width:60px;" value="Update" data-scheme_code="<?=$list->scheme_code?>">
                                    <input type="button" class="btn btn-danger btn-sm btn-delete" style="width:60px;" value="Delete" data-scheme_code="<?=$list->scheme_code?>">
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="4" class="text-center">등록된 데이터가 없습니다.</td>
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
            <label for="Code Add" style="color:#253C4F"><i class="glyphicon glyphicon-plus"></i> Code Add</label>
            <div class="box">    
                <div class="box-body table-responsive">
                    <form id="addForm" name="addForm" method="post" action="" class="bs-docs-example form-horizontal">
                    <table class="table table-sub table-bordered responsive">
                        <colgroup>
                            <col width="100">
                            <col width="300">
                            <col width="400">
                            <col width="*">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Type Code</th>
                                <th class="text-center">Type Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">ADD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><input type="text" class="form-control input-sm" id="scheme_code_add" name="scheme_code" maxlength="3" placeholder="Type Code" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Type Code" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="scheme_name_add" name="scheme_name" maxlength="20" placeholder="Type Name" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Type Name" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="desc_add" name="desc" maxlength="50" placeholder="Description" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for Description" value=""></td>
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
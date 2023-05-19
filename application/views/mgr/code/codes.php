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

            obj = $('#code_add');
            if (obj.val() == "") {
                alert("Type Code를 입력하세요.");
                setFocus(obj);
                return false;
            }
            if (obj.val().length != 2) {
                alert("Code는 반드시 숫자 2자리로 작성하세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#code_name_add');
            if (obj.val() == "") {
                alert("Code Name을 입력하세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#sequence_add');
            if (obj.val() == "") {
                alert("Sequence를 입력하세요.");
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
            var seq = $(this).data('seq');

            obj = $('#code_name_'+seq);
            if (obj.val() == "") {
                alert("Code Name을 입력하세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#sequence_'+seq);
            if (obj.val() == "") {
                alert("Sequence를 입력하세요.");
                setFocus(obj);
                return false;
            }

            var yn = confirm("수정하시겠습니까?");
            if (yn) {
                $('#seq').val(seq);
                $('#code_name').val($('#code_name_'+seq).val());
                $('#value1').val($('#value1_'+seq).val());
                $('#value2').val($('#value2_'+seq).val());
                $('#value3').val($('#value3_'+seq).val());
                $('#value4').val($('#value4_'+seq).val());
                $('#is_use').val($('#is_use_'+seq).val());
                $('#sequence').val($('#sequence_'+seq).val());
                $('#listForm').attr('action', '/mgr/code/codeupdate').submit();
            } else {
                return false;
            }
        });
        
        // delete
        $('.btn-delete').click(function(){
            var seq = $(this).data('seq');
            var yn = confirm("삭제하시겠습니까?");
            if (yn) {
                $('#seq').val(seq);
                $('#listForm').attr('action', '/mgr/code/codedelete').submit();
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
                        <input type="hidden" id="seq" name="seq" value="">
                        <input type="hidden" id="scheme_code" name="scheme_code" value="<?=$scheme->scheme_code?>">
                        <input type="hidden" id="code" name="code" value="">
                        <input type="hidden" id="code_name" name="code_name" value="">
                        <input type="hidden" id="value1" name="value1" value="">
                        <input type="hidden" id="value2" name="value2" value="">
                        <input type="hidden" id="value3" name="value3" value="">
                        <input type="hidden" id="value4" name="value4" value="">
                        <input type="hidden" id="is_use" name="is_use" value="">
                        <input type="hidden" id="sequence" name="sequence" value="">
                    <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                        <colgroup>
                            <col width="70">
                            <col width="350">
                            <col width="100">
                            <col width="100">
                            <col width="100">
                            <col width="100">
                            <col width="80">
                            <col width="80">
                            <col width="*">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Code</th>
                                <th class="text-center">Code Name</th>
                                <th class="text-center">Value1</th>
                                <th class="text-center">Value2</th>
                                <th class="text-center">Value3</th>
                                <th class="text-center">Value4</th>
                                <th class="text-center">Use</th>
                                <th class="text-center">Sequence</th>
                                <th class="text-center">Update/Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($codeList) {
                                foreach($codeList as $i => $list){
                            ?>
                            <tr>
                                <td class="text-center"><?=$list->code?></td>
                                <td><input type="text" class="form-control input-sm" id="code_name_<?=$list->seq?>" name="code_name_<?=$list->seq?>" placeholder="" value="<?=$list->code_name?>"></td>
                                <td><input type="text" class="form-control input-sm" id="value1_<?=$list->seq?>" name="value1_<?=$list->seq?>" placeholder="" value="<?=$list->value1?>"></td>
                                <td><input type="text" class="form-control input-sm" id="value2_<?=$list->seq?>" name="value2_<?=$list->seq?>" placeholder="" value="<?=$list->value2?>"></td>
                                <td><input type="text" class="form-control input-sm" id="value3_<?=$list->seq?>" name="value3_<?=$list->seq?>" placeholder="" value="<?=$list->value3?>"></td>
                                <td><input type="text" class="form-control input-sm" id="value4_<?=$list->seq?>" name="value4_<?=$list->seq?>" placeholder="" value="<?=$list->value4?>"></td>
                                <td class="text-center">
                                    <select class="form-control input-sm" id="is_use_<?=$list->seq?>" name="is_use_<?=$list->seq?>">
                                        <option value="Y"<?=$list->is_use == "Y" ? " selected='selected'" : ""?>>Yes</option>
                                        <option value="N"<?=$list->is_use == "N" ? " selected='selected'" : ""?>>No</option>
                                    </select>
                                </td>
                                <td><input type="text" id="sequence_<?=$list->seq?>" name="sequence_<?=$list->seq?>" class="form-control input-sm" style="text-align:center;" placeholder="" value="<?=$list->sequence?>"></td>
                                <td class="text-center">
                                    <input type="button" class="btn btn-info btn-sm btn-update" style="width:60px;" value="Update" data-seq="<?=$list->seq?>">
                                    <input type="button" class="btn btn-danger btn-sm btn-delete" style="width:60px;" value="Delete" data-seq="<?=$list->seq?>">
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="9" class="text-center">등록된 데이터가 없습니다.</td>
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
                    <form id="addForm" name="addForm" method="post" action="/mgr/code/codes" class="bs-docs-example form-horizontal">
                        <input type="hidden" name="scheme_code" value="<?=$scheme->scheme_code?>">
                    <table class="table table-sub table-bordered responsive">
                        <colgroup>
                            <col width="70">
                            <col width="350">
                            <col width="100">
                            <col width="100">
                            <col width="100">
                            <col width="100">
                            <col width="80">
                            <col width="80">
                            <col width="*">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Code</th>
                                <th class="text-center">Code Name</th>
                                <th class="text-center">Value1</th>
                                <th class="text-center">Value2</th>
                                <th class="text-center">Value3</th>
                                <th class="text-center">Value4</th>
                                <th class="text-center">Use</th>
                                <th class="text-center">Sequence</th>
                                <th class="text-center">ADD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control input-sm" id="code_add" name="code" maxlength="2" placeholder="Code" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="code_name_add" name="code_name" placeholder="Code Name" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="value1_add" name="value1" placeholder="Value1" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="value2_add" name="value2" placeholder="Value2" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="value3_add" name="value3" placeholder="Value3" value=""></td>
                                <td><input type="text" class="form-control input-sm" id="value4_add" name="value4" placeholder="Value4" value=""></td>
                                <td style="vertical-align:middle;">
                                    <select id="is_use_add" name="is_use" class="form-control input-sm">
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </td>
                                <td style="vertical-align:middle;"><input type="text" id="sequence_add" name="sequence" class="form-control input-sm" style="text-align:center;" placeholder="순서" value=""></td>
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
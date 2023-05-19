<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        // 다중 checkbox 선택
        $(document).on('click', '#checkAll', function () {
            var totCheck = $('#checkAll').prop("checked");
            if (totCheck) {
                $('.checkno').prop("checked", true);
            } else {
                $('.checkno').prop("checked", false);
            }
        });

        // 리스트체크박스 체크시 checkAll해제  
        $(document).on('click', '.checkno', function (){
            if($("input:checkbox[name='checkno[]']:checked").length == $("input:checkbox[name='checkno[]']").length){
                $('#checkAll').prop("checked", true);
            }else{
                $('#checkAll').prop("checked", false);
            }

        });

        // 다중 checkbox delete
        $(document).on('click', '#btn-delete', function(){
            var cnt = $('input:checkbox[name="checkno[]"]:checked').length
            if (cnt < 1) {
                alert("삭제할 글을 하나 이상 체크하셔야 합니다.");
                return false;
            }

            if (confirm("선택하신 글을 삭제 하시겠습니까?")) {
                $('#listForm').submit();
            }
        }); 
    
        $(document).on('change', '#row_count', function(){
            var num = $(this).val();
            $('#limit_size').val(num);
            document.searchForm.submit();
        });
        
        $('.btn-add-submit').click(function () {
            var obj;

            obj = $('#start_count');
            if (obj.val() == "") {
                alert("월 물동량 시작 수량을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#end_count');
            if (obj.val() == "") {
                alert("월 물동량 마지막 수량을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#price');
            if (obj.val() == "") {
                alert("단가를 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            var yn = confirm("저장하시겠습니까?");
            if (yn) {
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $('.btn-update-submit').click(function () {
            var seq = $(this).attr("data-seq");
            var obj;

            obj = $('#start_count_' + seq);
            if (obj.val() == "") {
                alert("월 물동량 시작 수량을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#end_count_' + seq);
            if (obj.val() == "") {
                alert("월 물동량 마지막 수량을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#price_' + seq);
            if (obj.val() == "") {
                alert("단가를 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            var yn = confirm("수정하시겠습니까?");
            if (yn) {
                $("#mod_seq").val(seq);
                $("#mod_start_count").val($("#start_count_" + seq).val());
                $("#mod_end_count").val($("#end_count_" + seq).val());
                $("#mod_price").val($("#price_" + seq).val());
                
                $('#frmMod').submit();
            } else {
                return false;
            }
        });
        
        $(".onlynum").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        
        $('.btn-delete-submit').click(function () {
            var seq = $(this).attr("data-seq");
            var yn = confirm("삭제하시겠습니까?");
            console.log(seq);
            if (yn) {
                $("#del_seq").val(seq);
                
                $('#frmDel').submit();
            } else {
                return false;
            }
        });
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
    });
    
</script>

<section class="content">
    
    <div class="row">
                
        <div class="col-xs-12">            
            
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <form id="frmDel" name="frmDel" method="post" action="/mgr/site/fee_delete" class="form-horizontal" role="form" autocomplete="off">
                            <input type="hidden" id="del_seq" name="del_seq">
                        </form>
                        <form id="frmMod" name="frmMod" method="post" action="/mgr/site/fee_update" class="form-horizontal" role="form" autocomplete="off">
                            <input type="hidden" id="mod_seq" name="mod_seq">
                            <input type="hidden" id="mod_start_count" name="mod_start_count">
                            <input type="hidden" id="mod_end_count" name="mod_end_count">
                            <input type="hidden" id="mod_price" name="mod_price">
                        </form>
                        
                        </form>
                        <colgroup>
                            <col style="width:5%;">
                            <col>
                            <col style="width:24%;">
                            <col style="width:20%;">
                        </colgroup>
                        <thead>
                            <tr calss="text-center">
                                <th class="text-center" style="vertical-align:middle;"><input type="checkbox" id="checkAll" name="checkAll"></th>
                                <th class="text-center">월 물동량</th>
                                <th class="text-center">단가</th>                                
                                <th class="text-center">액션</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form id="frm" name="frm" method="post" action="/mgr/site/fee_insert" class="form-horizontal" role="form" autocomplete="off">
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <input type="text" id="start_count" name="start_count" maxlength="10" class="form-control input-sm onlynum" style="display: inline; height: 32px; width: 120px;">건 ~ 
                                        <input type="text" id="end_count" name="end_count" maxlength="10" class="form-control input-sm onlynum" style="display: inline; height: 32px; width: 120px;">건
                                    </td>
                                    <td class="text-center">
                                        <input type="text" id="price" name="price" maxlength="10" class="form-control input-sm onlynum" style="display: inline; height: 32px; width: 120px;">
                                    </td>
                                    <td class="text-center"><a class="btn-add-submit btn btn-primary btn-sm" style="width:60px;">등록</a></td>
                                </form>
                            </tr>
                            
                            <form id="listForm" name="listForm" method="post" action="/mgr/site/fee_chkdelete" class="form-horizontal" role="form">
                            <?php
                            if ($feeList) {
                                foreach($feeList as $i => $list) {
                            ?>                            
                            <tr>
                                <td class="text-center"><input type="checkbox" class="checkno" name="checkno[]" value="<?=$list->seq?>"></td>
                                <td class="text-center">
                                    <input type="text" id="start_count_<?=$list->seq?>" name="start_count_<?=$list->seq?>" maxlength="10" class="form-control input-sm onlynum" style="display: inline; height: 32px; width: 120px;" value="<?=$list->start_count?>">건 ~ 
                                    <input type="text" id="end_count_<?=$list->seq?>" name="end_count_<?=$list->seq?>" maxlength="10" class="form-control input-sm onlynum" style="display: inline; height: 32px; width: 120px;" value="<?=$list->end_count?>">건
                                </td>
                                <td class="text-center">
                                    <input type="text" id="price_<?=$list->seq?>" name="price_<?=$list->seq?>" maxlength="10" class="form-control input-sm onlynum" style="display: inline; height: 32px; width: 120px;" value="<?=$list->price?>">
                                </td>
                                <td class="text-center">
                                    <a class="btn-update-submit btn btn-info btn-sm btn-update" data-seq="<?=$list->seq?>" style="width:60px;">수정</a>
                                    <a class="btn-delete-submit btn btn-warning btn-sm btn-update" data-seq="<?=$list->seq?>" style="width:60px;">삭제</a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="4" class="text-center" style="vertical-align:middle;">등록된 데이터가 없습니다.</td>
                            </tr>
                            <?php
                            }
                            ?>
                            </form>
                        </tbody>
                    </table>
                    
                    <div style="margin:10px 0 20px;">
                        <div class="col-xs-6 text-left">
                            <button id="btn-delete" class="btn btn-danger btn-sm btn-delete" style="width:70px;">선택삭제</button>
                        </div>
                    </div>                    
                </div>
                
            </div>
            
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">수정이력</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">최초등록</label>
                        <div class="col-sm-4">
                            <?php if($feeHistory->regist_id) { ?> <?=$feeHistory->regist_id?> (<?=$feeHistory->regist_date?>) <?php } else { echo "N/A"; } ?>
                        </div>
                        <label class="col-sm-2 control-label">최종수정</label>
                        <div class="col-sm-4">
                            <?php if($feeHistory->update_id) { ?> <?=$feeHistory->update_id?> (<?=$feeHistory->update_date?>) <?php } else { echo "N/A"; } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    console.log("Referer : " + document.referrer);
</script>
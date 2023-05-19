<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#inquiry_day');
            if (obj.val() == "") {
                alert("1:1 문의 정보 보관기간을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#estimate_day');
            if (obj.val() == "") {
                alert("견적문의 정보 보관기간을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#member_day');
            if (obj.val() == "") {
                alert("회원정보 보관기간을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#join_day');
            if (obj.val() == "") {
                alert("탈퇴후 재가입 기간을 입력해주세요.");
                setFocus(obj);
                return false;
            }

            var yn = confirm("수정하시겠습니까?");
            if (yn) {
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $(".onlynum").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });   
    });
    
    function onlyNumber() {
        if((event.keyCode<48)||(event.keyCode>57))
           event.returnValue=false;
    }    
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/privates/privates_term_update" class="form-horizontal" role="form" autocomplete="off">
                <div class="box-header with-border">
                    <h3 class="box-title">각 개인정보 항목의 보관 기간 설정</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 1:1 문의</label>
                        <div class="col-sm-2">
                            <input type="text" id="inquiry_day" name="inquiry_day" maxlength="4" class="form-control input-sm onlynum" value="<?=$privates->inquiry_day?>" onkeypress="javascript:onlyNumber();">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 견적문의</label>
                        <div class="col-sm-2">
                            <input type="text" id="estimate_day" name="estimate_day" maxlength="4" class="form-control input-sm onlynum" value="<?=$privates->estimate_day?>" onkeypress="javascript:onlyNumber();">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 회원정보</label>
                        <div class="col-sm-2">
                            <input type="text" id="member_day" name="member_day" maxlength="4" class="form-control input-sm onlynum" value="<?=$privates->member_day?>" onkeypress="javascript:onlyNumber();">
                        </div>
                    </div>
                </div>
                
                <div class="box-header with-border">
                    <h3 class="box-title">탈퇴 후 재가입 기간 설정</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 재가입 기간</label>
                        <div class="col-sm-2">
                            <input type="text" id="join_day" name="join_day" maxlength="4" class="form-control input-sm onlynum" value="<?=$privates->join_day?>" onkeypress="javascript:onlyNumber();">
                        </div>
                    </div>
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">수정</a>
                </div>
            </form>
        </div>
        
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">수정이력</h3>
            </div>

            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">최초등록</label>
                    <div class="col-sm-4">
                        <?php if($privates->regist_id) { ?> <?=$privates->regist_id?> (<?=$privates->regist_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                    <label class="col-sm-2 control-label">최종수정</label>
                    <div class="col-sm-4">
                        <?php if($privates->update_id) { ?> <?=$privates->update_id?> (<?=$privates->update_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
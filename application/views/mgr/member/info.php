<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-submit').click(function () {
            var obj;
            
            obj = $('#email');
            if (obj.val() == "") {
                alert("이메일을 입력해주세요.");
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
    });
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/member/update" class="form-horizontal" role="form" autocomplete="off">
                <input type="hidden" id="member_id" name="member_id" value="<?=$member->member_id?>">
                
                <div class="box-header with-border">
                    <h3 class="box-title">회원정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">아이디</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?=$member->member_id?></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">이름</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?=$member->member_name?></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">연락처</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?=$member->dec_tel?></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">이메일</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?=$member->dec_email?></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">SNS</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?php if($member->member_type == "K") { echo "카카오"; } else if($member->member_type == "N") { echo "네이버"; } else if($member->member_type == "G") { echo "구글"; } ?></div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">상태</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?php if($member->status == "N") { echo "탈퇴"; } else { echo "회원"; } ?></div>
                        </div>
                    </div>
                    <?php if($member->status == "N") { ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">탈퇴사유</label>
                        <div class="col-sm-4">
                            <?=$member->secession_content?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FFFFFF;">*</span> 마지막 로그인</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?=$member->login_date?></div>
                        </div>
                        <label class="col-sm-2 control-label"><span style="color:#FFFFFF;">*</span> 로그인수</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?=$member->count?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FFFFFF;">*</span> 가입일</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?=$member->regist_date?></div>
                        </div>
                        <label class="col-sm-2 control-label"><span style="color:#FFFFFF;">*</span> 수정일</label>
                        <div class="col-sm-4">
                            <div style="padding-top: 8px;"><?=$member->update_date?></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/member/total_list?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#member_id');
            if (obj.val() == "") {
                alert("아이디를 입력해주세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#member_passwd');
            if (obj.val() == "") {
                alert("비밀번호를 입력해주세요.");
                setFocus(obj);
                return false;
            }

            obj2 = $('#member_passwd2');
            if (obj2.val() == "") {
                alert("비밀번호 확인을 입력해주세요.");
                setFocus(obj2);
                return false;
            }

            if (obj.val() != obj2.val()) {
                alert("비밀번호가 서로 일치하지 않습니다.");
                setFocus(obj);
                return false;
            }

            obj = $('#email');
            if (obj.val() == "") {
                alert("이메일을 입력해주세요.");
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
    });
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/member/insert" class="form-horizontal" role="form" autocomplete="off">
                <div class="box-header with-border">
                    <h3 class="box-title">필수 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 아이디</label>
                        <div class="col-sm-4">
                            <input type="text" id="member_id" name="member_id" maxlength="30" class="form-control input-sm">
                            <?php echo form_error('member_id'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 비밀번호</label>
                        <div class="col-sm-4">
                            <input type="password" id="member_passwd" name="member_passwd" maxlength="20" class="form-control input-sm" autocomplete="none">
                        </div>
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 비밀번호 확인</label>
                        <div class="col-sm-4">
                            <input type="password" id="member_passwd2" name="member_passwd2" maxlength="20" class="form-control input-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 이메일</label>
                        <div class="col-sm-4">
                            <input type="email" id="email" name="email" maxlength="100" class="form-control input-sm">
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
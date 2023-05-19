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

            var yn = confirm("저장하시겠습니까?");
            if (yn) {
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
    });
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/site/operation_action" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 운영주체명</label>
                        <div class="col-sm-4">
                            <input type="text" id="contact_name" name="contact_name" maxlength="100" class="form-control input-sm" value="<?php if($mode == "update") echo $operation->contact_name; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 이메일</label>
                        <div class="col-sm-4">
                            <input type="text" id="contact_email" name="contact_email" maxlength="100" class="form-control input-sm" value="<?php if($mode == "update") echo $operation->contact_email; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 우편번호</label>
                        <div class="col-sm-4">
                            <input type="text" id="zipcode" name="zipcode" maxlength="100" class="form-control input-sm" value="<?php if($mode == "update") echo $operation->zipcode; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 주소</label>
                        <div class="col-sm-4">
                            <input type="text" id="address" name="address" maxlength="100" class="form-control input-sm" value="<?php if($mode == "update") echo $operation->address; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 카피라이트</label>
                        <div class="col-sm-4">
                            <input type="text" id="copyright" name="copyright" maxlength="100" class="form-control input-sm" value="<?php if($mode == "update") echo $operation->copyright; ?>">
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                </div>
            </form>
        </div>

    </div>
</div>
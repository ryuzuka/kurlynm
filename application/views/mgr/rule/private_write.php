<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: '/editor/ckupload'
        });
        
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#content');
            if(CKEDITOR.instances.content.getData() =='' || CKEDITOR.instances.content.getData().length ==0) {
                alert("내용을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#start_date');
            if (obj.val() == "") {
                alert("시작일을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#end_date');
            if (obj.val() == "") {
                alert("종료일을 입력해주세요.");
                setFocus(obj);
                return false;
            }

            var yn = confirm("저장하시겠습니까?");
            if (yn) {
                $("#frm").attr("action", "/mgr/rule/private_insert");
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $('#btn-modify').click(function () {
            var obj;

            obj = $('#content');
            if(CKEDITOR.instances.content.getData() =='' || CKEDITOR.instances.content.getData().length ==0) {
                alert("내용을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#start_date');
            if (obj.val() == "") {
                alert("시작일을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#end_date');
            if (obj.val() == "") {
                alert("종료일을 입력해주세요.");
                setFocus(obj);
                return false;
            }

            var yn = confirm("수정하시겠습니까?");
            if (yn) {
                $("#frm").attr("action", "/mgr/rule/private_update");
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
        
        $('.calendar').datepicker().on('changeDate', function (ev) {
            $('.datepicker').hide();
        });
    });
</script>

<style>
    .rule-tab-menu { border: 1px solid #a9a9a9; padding: 6px 20px; border-top-left-radius: 6px; border-top-right-radius: 6px; font-size: 1em; cursor: pointer; }
    .activetab { background: #dedede; font-weight: 800; }
    .deactivetab { background: #f4f4f4; font-weight: 400; }
</style>

<div class="row">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-title rule-tab-menu activetab" style="margin: 0 0 0 20px !important;" onclick="javascript:location.href='private';">개인정보처리방침</div>
                <div class="box-title rule-tab-menu deactivetab" style="margin-left: -4px;" onclick="javascript:location.href='private_list';">이전 약관 관리</div>
            </div>

            <?php if($private) { ?>
            <form id="frm" name="frm" method="post" action="/mgr/rule/private_update" class="form-horizontal" role="form" autocomplete="off">
                <input type="hidden" id="seq" name="seq" value="<?=$private->seq?>">
                <input type="hidden" id="status" name="status" value="<?=$private->status?>">
                <div class="box-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 내용</label>
                        <div class="col-sm-7">
                            <textarea id="content" name="content" rows="16" cols="80"><?=$private->content?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 적용기간</label>
                        <div class="col-sm-4 term">
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="start_date" name="start_date" class="form-control pull-right calendar" value="<?=$private->start_date?>">
                                </div>
                            </div>                        
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="end_date" name="end_date" class="form-control pull-right calendar" value="<?=$private->end_date?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">노출</label>
                        <div class="col-sm-6" style="padding-top: 6px;">
                                프론트 약관 페이지에 노출됩니다.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">주의사항</label>
                        <div class="col-sm-10">
                            <p>신규저장 : 위 약관 내용으로 신규 저장해 프론트에 노출합니다.</p>
                            <p>수정 : 프론트에 노출 중인 약관 내용을 수정합니다.</p>
                        </div>
                    </div>
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">신규저장</a>
                    <a id="btn-modify" class="btn btn-warning btn-sm" style="width:80px;">수정</a>
                </div>
            </form>
            <?php } else { ?>
            <form id="frm" name="frm" method="post" action="/mgr/rule/private_insert" class="form-horizontal" role="form" autocomplete="off">
                <div class="box-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 내용</label>
                        <div class="col-sm-7">
                            <textarea id="content" name="content" rows="16" cols="80"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 적용기간</label>
                        <div class="col-sm-4 term">
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="start_date" name="start_date" class="form-control pull-right calendar">
                                </div>
                            </div>                        
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="end_date" name="end_date" class="form-control pull-right calendar">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> 노출</label>
                        <div class="col-sm-6" style="padding-top: 6px;">
                            프론트 약관 페이지에 노출됩니다.
                        </div>
                    </div>
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                </div>
            </form>
            <?php } ?>
        </div>

</div>

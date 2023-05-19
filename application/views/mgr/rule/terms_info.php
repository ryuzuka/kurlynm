<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: '/editor/ckupload'
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
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $('#btn-delete').click(function () {
            var yn = confirm("삭제하시겠습니까?");
            if (yn) {
                $("#frm").attr("action", "/mgr/rule/terms_delete");
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
    <div class="col-xs-12">

        <div class="box">
            <div class="box-header with-border">
                <div class="box-title rule-tab-menu deactivetab" style="margin: 0 0 0 5px !important;" onclick="javascript:location.href='terms';">택배표준약관</div>
                <div class="box-title rule-tab-menu activetab" style="margin-left: -4px;" onclick="javascript:location.href='terms_list';">이전 약관 관리</div>
            </div>

            <form id="frm" name="frm" method="post" action="/mgr/rule/terms_update" class="form-horizontal" role="form" autocomplete="off">
                <input type="hidden" id="seq" name="seq" value="<?=$terms->seq?>">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <input type="hidden" id="status" name="status" value="<?=$terms->status?>">
                <div class="box-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 내용</label>
                        <div class="col-sm-7">
                            <textarea id="content" name="content" rows="16" cols="80"><?=$terms->content?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시기간</label>
                        <div class="col-sm-4 term">
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="start_date" name="start_date" class="form-control pull-right calendar" value="<?=$terms->start_date?>">
                                </div>
                            </div>                        
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="end_date" name="end_date" class="form-control pull-right calendar" value="<?=$terms->end_date?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 이전목록 노출</label>
                        <div class="col-sm-1">
                            <select name="is_show" id="is_show" class="form-control input-sm">
                                <option value="N" <?php if($terms->is_show == "N") echo "selected"; ?>>N</option>
                                <option value="Y" <?php if($terms->is_show == "Y") { echo "selected"; } ?>>Y</option>
                            </select>                            
                        </div>
                    </div>
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-modify" class="btn btn-primary btn-sm" style="width:80px;">수정</a>
                    <a href="/mgr/rule/terms_list?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                    <a id="btn-delete" class="btn btn-danger btn-sm" style="width:80px;">삭제</a>
                </div>
            </form>
        </div>

    </div>
</div>

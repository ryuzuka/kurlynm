<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: '/editor/ckupload'
        });
        
        $('#status').change(function () {
            var cnt = $('#important_count').val();
            var currSel = $(this).val();
            
            if(currSel == "Y" && cnt >= 2) {
                alert("중요 공지는 2개까지 가능합니다.");
                $("#status").val("N").prop("selected", true);
                return false;
            }
        });
        
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#title');
            if (obj.val() == "") {
                alert("제목을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#s_term');
            if (obj.val() == "Y") {
                if ($('#start_date').val() == "") {
                    alert("시작일을 선택해주세요.");
                    setFocus($('#start_date'));
                    return false;
                }
                if ($('#end_date').val() == "") {
                    alert("종료일을 선택해주세요.");
                    setFocus($('#end_date'));
                    return false;
                }
            }
            
            obj = $('#content');
            if(CKEDITOR.instances.content.getData() =='' || CKEDITOR.instances.content.getData().length ==0) {
                alert("내용을 입력해주세요.");
                setFocus(obj);
                return false;
            }

            if($("#chk_del").is(":checked")) { 
                $('#img_del').val("D");
            } else { 
                $('#img_del').val("N");
            }

            var yn = confirm("저장하시겠습니까?");
            if (yn) {
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $('#btn-delete').click(function () {
            var obj;

            var yn = confirm("삭제하시겠습니까?");
            if (yn) {
                $("#frm").attr("action", "/mgr/site/notice_delete");
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $('#s_term').change(function () {
            if(this.value == "Y") {
                $(".term").css("display","block");
            } else {
                $(".term").css("display","none");
                $("#start_date").val("");
                $("#end_date").val("");
            }
        });
        
        $(document).on('click', '.del_file', function() {
            $('#file').val("");
        });
        
        $(document).on('click', '.btn-term', function() {
            var term_day = $(this).attr("data-day");
            var date = new Date();
            var yyyy = date.getFullYear();
            var mm = date.getMonth() + 1;
            var dd = date.getDate();
            
            if (mm < 10) mm = '0' + mm; 
            if (dd < 10) dd = '0' + dd; 
            
            var start_date = yyyy + "-" + mm + "-" + dd;
            
            date = new Date();
            date.setDate(date.getDate() + parseInt(term_day));
            console.log(date);
            yyyy = date.getFullYear();
            mm = date.getMonth() + 1;
            dd = date.getDate();
            
            if (mm < 10) mm = '0' + mm; 
            if (dd < 10) dd = '0' + dd; 
            
            end_date = yyyy + "-" + mm + "-" + dd;
            
            $("#start_date").val(start_date);
            $("#end_date").val(end_date);
        });
        
        var term = "<?=$notice->start_date?>";
        
        if(term) { 
            $(".term").css("display","block"); 
        }
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
        
        $('.calendar').datepicker().on('changeDate', function (ev) {
            $('.datepicker').hide();
        });
    });
</script>

<style>
    .term { display: none; }
    .del_file_wrap { padding: 10px 0; cursor: pointer; }
</style>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/site/notice_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$notice->seq?>">
                <input type="hidden" id="img_del" name="img_del" value="">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <input type="hidden" id="important_count" name="important_count" value="<?=$count?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 중요</label>
                        <div class="col-sm-2">
                            <select name="status" id="status" class="form-control input-sm">
                                <option value="N" <?php if($notice->status == "N") echo "selected"; ?>>아니오</option>
                                <option value="Y" <?php if($notice->status == "Y") echo "selected"; ?>>예</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                        <div class="col-sm-4">
                            <input type="text" id="title" name="title" maxlength="100" class="form-control input-sm" value="<?=$notice->title?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시기간</label>
                        <div class="col-sm-2">
                            <select name="s_term" id="s_term" class="form-control input-sm">
                                <option value="N" <?php if($notice->start_date == null) echo "selected"; ?>>사용안함</option>
                                <option value="Y" <?php if($notice->start_date != null) { echo "selected"; } ?>>사용함</option>
                            </select>
                        </div>
                        <div class="col-sm-4 term">
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="start_date" name="start_date" class="form-control pull-right calendar" value="<?=$notice->start_date?>">
                                </div>
                            </div>                        
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="end_date" name="end_date" class="form-control pull-right calendar" value="<?=$notice->end_date?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 term">
                                <button type="button" class="btn btn-sm btn-term" style="width:60px;" data-day="30">1개월</button>
                                <button type="button" class="btn  btn-sm btn-term" style="width:60px;" data-day="90">3개월</button>
                                <button type="button" class="btn  btn-sm btn-term" style="width:60px;" data-day="180">6개월</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 내용</label>
                        <div class="col-sm-7">
                            <textarea id="content" name="content" rows="16" cols="80"><?=$notice->content?></textarea>
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 파일 첨부</label>
                        <div class="col-sm-3">
                            <input type="file" id="file" name="file" maxlength="100" class="form-control input-sm">
                        </div>
                        <div class="col-sm-1 del_file_wrap">
                            <span class="del_file">[초기화]</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <?php if($notice->file_name) { ?>
                            <a href="<?=$notice->file_path?>/<?=$notice->file_name?>" target="_blank"><?=$notice->file_name?></a>
                            <span style="padding: 10px;"><input type="checkbox" id="chk_del" name="chk_del"> 삭제</span>
                            <?php } ?>
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/notice?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                    <a id="btn-delete" class="btn btn-danger btn-sm" style="width:80px;">삭제</a>
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
                        <?php if($notice->regist_id) { ?> <?=$notice->regist_id?> (<?=$notice->regist_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                    <label class="col-sm-2 control-label">최종수정</label>
                    <div class="col-sm-4">
                        <?php if($notice->update_id) { ?> <?=$notice->update_id?> (<?=$notice->update_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
</div>

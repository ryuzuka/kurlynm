<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        var answer_editor = CKEDITOR.replace('answer_content', {
            filebrowserUploadUrl: '/editor/ckupload'
        });
        
        $('#btn-submit').click(function () {
            var obj;
            var mode = $('#mode').val();
            
            obj = $('#answer_content');
            if(answer_editor.getData() == '' || answer_editor.getData().length == 0) {
                alert("답변 내용을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            var yn = confirm("답변을 저장하시겠습니까?");
            if (yn) {
                $('#frm').submit();
            } else {
                return false;
            }
        });
    
        $('#btn-reset').on('click',function(e) {
            var seq = $(this).attr("data-seq");

            var yn = confirm("비밀번호를 재발급하시겠습니까?");
            if(yn) {
                var url = "/mgr/inquiry/passwd_reset?seq=" + seq;

                $.get(url,function(data,status){
                    if (status == "success") {
                        //console.log(data);
                        $(".passwd-reset").html(data.toString());
                    } else {
                        alert("비밀번호 재발급 중 오류가 발생했습니다.");
                    }
                });
            } else {
                return false;
            }
        });

        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
    });
    
    
    function responseFirst(member) {
        $('#member_id').val(member.member_id);        
        $('#member_txt').val(member.member_name+" ("+member.member_id+")");
    }
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/inquiry/question_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$question->seq?>">
                <input type="hidden" id="mode" name="mode" value="<?=$question->status?>">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">작성자</label>
                        <div class="col-sm-4" style="padding-top: 6px;">
                            <?=$question->question_name?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">이메일</label>
                        <div class="col-sm-4" style="padding-top: 6px;">
                            <?=$question->dec_question_email?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">연락처</label>
                        <div class="col-sm-4" style="padding-top: 6px;">
                            <?=$question->dec_question_tel?>
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label">제목</label>
                        <div class="col-sm-4" style="padding-top: 6px;">
                            <?=$question->question_title?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">문의 내용</label>
                        <div class="col-sm-6" style="padding-top: 6px;">
                            <p><?=$question->question_content?></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">첨부파일</label>
                        <div class="col-sm-3">
                        <?php if($question->file_name_1) { ?>
                            <a href="<?=$question->file_path_1?>/<?=$question->file_name_1?>" target="_blank"><?=$question->file_name_1?></a>
                        <?php } ?>
                        </div>
                        <div class="col-sm-3">
                        <?php if($question->file_name_2) { ?>
                            <a href="<?=$question->file_path_2?>/<?=$question->file_name_2?>" target="_blank"><?=$question->file_name_2?></a>
                        <?php } ?>
                        </div>
                        <div class="col-sm-3">
                        <?php if($question->file_name_3) { ?>
                            <a href="<?=$question->file_path_3?>/<?=$question->file_name_3?>" target="_blank"><?=$question->file_name_3?></a>
                        <?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">비밀번호 초기화</label>
                        <div class="col-sm-6 passwd-reset" style="padding-top: 2px;">
                            <a id="btn-reset" class="btn btn-primary btn-sm" data-seq="<?=$question->seq?>" style="width:60px; height: 34px;">발급</a>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 답변 내용</label>
                        <div class="col-sm-6">
                            <textarea id="answer_content" name="answer_content" rows="16" cols="80"><?=$question->answer_content?></textarea>
                        </div>
                    </div>
                </div>

                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">답변저장</a>
                    <a href="/mgr/site/question_list?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>
        
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">수정이력</h3>
            </div>

            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">최초답변</label>
                    <div class="col-sm-4">
                        <?php if($question->update_id) { ?> <?=$question->update_id?> (<?=$question->update_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                    <label class="col-sm-2 control-label">최종답변</label>
                    <div class="col-sm-4">
                        <?php if($question->answer_date) { ?> <?=$question->answer_id?> (<?=$question->answer_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
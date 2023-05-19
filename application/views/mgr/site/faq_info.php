<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('answer_content', {
            filebrowserUploadUrl: '/editor/ckupload'
        });
                
        $('#btn-submit').click(function () {
            var obj;

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
            <form id="frm" name="frm" method="post" action="/mgr/site/faq_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$faq->seq?>">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 문의종류</label>
                        <div class="col-sm-2">
                            <select id="faq_cd" name="faq_cd" class="form-control input-sm">
                                <option value="">== 문의종류선택 ==</option>
                                <?php
                                    if ($faqCodeList) {
                                        foreach($faqCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($faq->faq_cd == $list->code) { echo "selected";} ?>><?=$list->code_name?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 질문</label>
                        <div class="col-sm-4">
                            <input type="text" id="question_title" name="question_title" maxlength="100" class="form-control input-sm" value="<?=$faq->question_title?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 답변 내용</label>
                        <div class="col-sm-6">
                            <textarea id="answer_content" name="answer_content" rows="16" cols="80"><?=$faq->answer_content?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 상태</label>
                        <div class="col-sm-2">
                            <select id="status" name="status" class="form-control input-sm">
                                <option value="Y" <?php if($faq->status == "Y") { echo "selected";} ?>>활성</option>
                                <option value="N" <?php if($faq->status == "N") { echo "selected";} ?>>비활성</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/faq_list?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div>
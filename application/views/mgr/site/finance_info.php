<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#title');
            if (obj.val() == "") {
                alert("제목을 입력해주세요.");
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
        
        $(document).on('click', '.del_file', function() {
            $('#file').val("");
        });
        
        $('#btn-delete').click(function () {
            var obj;

            var yn = confirm("삭제하시겠습니까?");
            if (yn) {
                $("#frm").attr("action", "/mgr/site/finance_delete");
                $('#frm').submit();
            } else {
                return false;
            }
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
            <form id="frm" name="frm" method="post" action="/mgr/site/finance_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$finance->seq?>">
                <input type="hidden" id="img_del" name="img_del" value="">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                        <div class="col-sm-4">
                            <input type="text" id="title" name="title" maxlength="100" class="form-control input-sm" value="<?=$finance->title?>">
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 파일 첨부</label>
                        <div class="col-sm-3">
                            <input type="file" id="file" name="file" maxlength="100" class="form-control input-sm">
                        </div>
                        <div class="col-sm-2 del_file_wrap">
                            <span class="del_file">[초기화]</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <?php if($finance->file_name) { ?>
                            <a href="<?=$finance->file_path?>/<?=$finance->file_name?>" target="_blank"><?=$finance->file_name?></a>
                            <span style="padding: 10px;"><input type="checkbox" id="chk_del" name="chk_del"> 삭제</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/finance" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
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
                        <?php if($finance->regist_id) { ?> <?=$finance->regist_id?> (<?=$finance->regist_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                    <label class="col-sm-2 control-label">최종수정</label>
                    <div class="col-sm-4">
                        <?php if($finance->update_id) { ?> <?=$finance->update_id?> (<?=$finance->update_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

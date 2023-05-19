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
            <form id="frm" name="frm" method="post" action="/mgr/site/sns_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$sns->seq?>">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> SNS 종류</label>
                        <div class="col-sm-4">
                            <select id="sns_cd" name="sns_cd" class="form-control input-sm">
                                <?php
                                    if ($snsCodeList) {
                                        foreach($snsCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($sns->sns_cd == $list->code) { echo "selected";} ?>><?=$list->code_name?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                        <div class="col-sm-4">
                            <input type="text" id="title" name="title" maxlength="100" class="form-control input-sm" value="<?=$sns->title?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 내용</label>
                        <div class="col-sm-7">
                            <textarea id="content" name="content" rows="16" cols="80"><?=$sns->content?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 링크 URL</label>
                        <div class="col-sm-4">
                            <input type="text" id="link_url" name="link_url" maxlength="100" class="form-control input-sm" value="<?=$sns->link_url?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 이미지</label>
                        <div class="col-sm-3">
                            <input type="file" id="image_file" name="image_file" maxlength="100" class="form-control input-sm">
                        </div>
                        <div class="col-sm-2">
                            <?php if($sns->file_name) { ?>
                                <img src="<?=$sns->file_path?>/<?=$sns->file_name?>" style="height: 120px;">
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 상태</label>
                        <div class="col-sm-2">
                            <select id="status" name="status" class="form-control input-sm">
                                <option value="Y" <?php if($sns->status == "Y") { echo "selected";} ?>>활성</option>
                                <option value="N" <?php if($sns->status == "N") { echo "selected";} ?>>비활성</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/sns?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
            <form id="frm" name="frm" method="post" action="/mgr/site/popup_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$popup->seq?>">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                        <div class="col-sm-4">
                            <input type="text" id="title" name="title" maxlength="100" class="form-control input-sm" value="<?=$popup->title?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 링크 URL</label>
                        <div class="col-sm-4">
                            <input type="text" id="link_url" name="link_url" maxlength="100" class="form-control input-sm" value="<?=$popup->link_url?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시 기간</label>
                        <div class="col-sm-2">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="start_date" name="start_date" class="form-control pull-right calendar" value="<?=date('Y-m-d', strtotime($popup->start_date))?>">
                            </div>
                        </div>                        
                        <div class="col-sm-2">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="end_date" name="end_date" class="form-control pull-right calendar" value="<?=date('Y-m-d', strtotime($popup->end_date))?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> PC 이미지</label>
                        <div class="col-sm-3">
                            <input type="file" id="image_file" name="image_file" maxlength="100" class="form-control input-sm">
                        </div>
                        <div class="col-sm-2">
                            <?php if($popup->file_name) { ?>
                                <img src="<?=$popup->file_path?>/<?=$popup->file_name?>" style="height: 120px;">
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 모바일 이미지</label>
                        <div class="col-sm-3">
                            <input type="file" id="mobile_image_file" name="mobile_image_file" maxlength="100" class="form-control input-sm">
                        </div>
                        <div class="col-sm-2">
                            <?php if($popup->mobile_file_name) { ?>
                                <img src="<?=$popup->file_path?>/<?=$popup->mobile_file_name?>" style="height: 120px;">
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 상태</label>
                        <div class="col-sm-2">
                            <select id="status" name="status" class="form-control input-sm">
                                <option value="Y" <?php if($popup->status == "Y") { echo "selected";} ?>>활성</option>
                                <option value="N" <?php if($popup->status == "N") { echo "selected";} ?>>비활성</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/popup_list?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div>
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
            <form id="frm" name="frm" method="post" action="/mgr/site/group_action" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 지원 - 대장정 참가</label>
                        <div class="col-sm-4">
                            <select id="road_group_cd" name="road_group_cd" class="form-control input-sm">
                                <option value="">== 기수선택 ==</option>
                                <?php
                                    if ($groupCodeList) {
                                        foreach($groupCodeList as $i => $list){
                                ?>                                
                                <option value="<?=$list->code?>" <?php if($mode == "update") { if($group->road_group_cd == $list->code) { echo "selected"; } } ?>><?=$list->code_name?> 기 (<?=$list->value1?>년)</option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 메인 - 대장정 앨범</label>
                        <div class="col-sm-4">
                            <select id="album_group_cd" name="album_group_cd" class="form-control input-sm">
                                <option value="">== 기수선택 ==</option>
                                <?php
                                    if ($groupCodeList) {
                                        foreach($groupCodeList as $i => $list){
                                ?>                                
                                <option value="<?=$list->code?>" <?php if($mode == "update") { if($group->album_group_cd == $list->code) { echo "selected"; } } ?>><?=$list->code_name?> 기 (<?=$list->value1?>년)</option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 메인 - 대장정 영상</label>
                        <div class="col-sm-4">
                            <select id="video_group_cd" name="video_group_cd" class="form-control input-sm">
                                <option value="">== 기수선택 ==</option>
                                <?php
                                    if ($groupCodeList) {
                                        foreach($groupCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($mode == "update") { if($group->video_group_cd == $list->code) { echo "selected"; } } ?>><?=$list->code_name?> 기 (<?=$list->value1?>년)</option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 서브 - 명예 대장정</label>
                        <div class="col-sm-4">
                            <select id="honor_group_cd" name="honor_group_cd" class="form-control input-sm">
                                <option value="">== 기수선택 ==</option>
                                <?php
                                    if ($groupCodeList) {
                                        foreach($groupCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($mode == "update") { if($group->honor_group_cd == $list->code) { echo "selected"; } } ?>><?=$list->code_name?> 기 (<?=$list->value1?>년)</option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 서브 - 프론티어 : OT</label>
                        <div class="col-sm-4">
                            <select id="ot_group_cd" name="ot_group_cd" class="form-control input-sm">
                                <option value="">== 기수선택 ==</option>
                                <?php
                                    if ($groupCodeList) {
                                        foreach($groupCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($mode == "update") { if($group->ot_group_cd == $list->code) { echo "selected"; } } ?>><?=$list->code_name?> 기 (<?=$list->value1?>년)</option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 서브 - 프론티어 : Club</label>
                        <div class="col-sm-4">
                            <select id="frontier_group_cd" name="frontier_group_cd" class="form-control input-sm">
                                <option value="">== 기수선택 ==</option>
                                <?php
                                    if ($groupCodeList) {
                                        foreach($groupCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($mode == "update") { if($group->frontier_group_cd == $list->code) { echo "selected"; } } ?>><?=$list->code_name?> 기 (<?=$list->value1?>년)</option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
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
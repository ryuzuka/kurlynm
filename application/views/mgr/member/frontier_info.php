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
            <form id="frm" name="frm" method="post" action="/mgr/member/frontier_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$member->seq?>">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <div class="box-header with-border">
                    <h3 class="box-title">필수 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 기수</label>
                        <div class="col-sm-2">
                            <select id="group_cd" name="group_cd" class="form-control input-sm" readonly>
                                <option value="">== 기수선택 ==</option>
                                <?php
                                    if ($groupCodeList) {
                                        foreach($groupCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($member->group_cd == $list->code) { echo "selected";} ?>><?=$list->code_name?> 기 (<?=$list->value1?>년)</option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 한글명</label>
                        <div class="col-sm-2">
                            <input type="text" id="member_name" name="member_name" maxlength="50" class="form-control input-sm" value="<?=$member->member_name?>" placeholder="[한글명]">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 성별</label>
                        <div class="col-sm-2">
                            <select id="gender" name="gender" class="form-control input-sm">
                                <option value="">== 성별선택 ==</option>
                                <option value="남" <?php if($member->gender == "남") { echo "selected";} ?>>남자</option>
                                <option value="여" <?php if($member->gender == "여") { echo "selected";} ?>>여자</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 대학</label>
                        <div class="col-sm-2">
                            <input type="text" id="univ_name" name="univ_name" maxlength="50" class="form-control input-sm" value="<?=$member->univ_name?>" placeholder="[대학]">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" id="dept" name="dept" maxlength="50" class="form-control input-sm" value="<?=$member->dept?>" placeholder="[학부]">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" id="major" name="major" maxlength="50" class="form-control input-sm" value="<?=$member->major?>" placeholder="[전공]">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 지원동기</label>
                        <div class="col-sm-4">
                            <textarea id="aspiration" name="aspiration" rows="8" cols="100"><?=$member->aspiration?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 앨범 사진</label>
                        <div class="col-sm-3">
                            <input type="file" id="photo_file" name="photo_file" maxlength="100" class="form-control input-sm" value="">
                        </div>
                        <div class="col-sm-2">
                            <?php if($member->photo_file_name) { ?>
                            <img src="<?=$member->photo_file_path?>/<?=$member->photo_file_name?>" style="height: 120px;">
                            <?php } else { ?>
                            사진없음
                        <?php } ?>
                        </div>
                    </div>
                </div>
                
                
                <div class="box-header with-border">
                    <h3 class="box-title">부가 정보</h3>
                </div>
                
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> 조</label>
                        <div class="col-sm-1">
                            <input type="text" id="road_part" name="road_part" maxlength="2" class="form-control input-sm" value="<?=$member->road_part?>" placeholder="[조]">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> 영문명</label>
                        <div class="col-sm-2">
                            <input type="text" id="eng_name" name="eng_name" maxlength="50" class="form-control input-sm" value="<?=$member->eng_name?>" placeholder="[영문명]">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"> 나이</label>
                        <div class="col-sm-1">
                            <input type="text" id="age" name="age" maxlength="2" class="form-control input-sm" value="<?=$member->age?>">
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/member/frontier_list?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div>
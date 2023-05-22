<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {

        $('#btn-submit').click(function () {
            var obj;

            obj = $('#client_count');
            if (obj.val() == "") {
                alert("누적 고객사를 입력해주세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#release_count');
            if (obj.val() == "") {
                alert("누적 출고량을 입력해주세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#member_count');
            if (obj.val() == "") {
                alert("배송 매니저를 입력해주세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#center_count');
            if (obj.val() == "") {
                alert("운영 터미널센터를 입력해주세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#base_date');
            if (obj.val() == "") {
                alert("기준일을 입력해주세요.");
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

        $(".onlynum").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});

        $('.calendar').datepicker().on('changeDate', function (ev) {
            $('.datepicker').hide();
        });
    });

    function onlyNumber() {
        if((event.keyCode<48)||(event.keyCode>57))
           event.returnValue=false;
    }
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/site/dashboard_action" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="mode" id="mode" value="<?=$mode?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 누적 고객사</label>
                        <div class="col-sm-2">
                            <input type="text" id="client_count" name="client_count" maxlength="4" class="form-control input-sm onlynum" value="<?php if($mode == "update") echo $dashboard->client_count; ?>" onkeypress="javascript:onlyNumber();">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 누적 출고량</label>
                        <div class="col-sm-2">
                            <input type="text" id="release_count" name="release_count" maxlength="4" class="form-control input-sm" value="<?php if($mode == "update") echo $dashboard->release_count; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 배송 매니저</label>
                        <div class="col-sm-2">
                            <input type="text" id="member_count" name="member_count" maxlength="4" class="form-control input-sm onlynum" value="<?php if($mode == "update") echo $dashboard->member_count; ?>" onkeypress="javascript:onlyNumber();">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 운영 터미널센터</label>
                        <div class="col-sm-2">
                            <input type="text" id="center_count" name="center_count" maxlength="3" class="form-control input-sm onlynum" value="<?php if($mode == "update") echo $dashboard->center_count; ?>" onkeypress="javascript:onlyNumber();">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 기준일</label>
                        <div class="col-sm-2">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="base_date" name="base_date" class="form-control pull-right calendar" value="<?php if($mode == "update") echo date('Y-m-d', strtotime($dashboard->base_date)); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
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
                        <?php if($dashboard->regist_id) { ?> <?=$dashboard->regist_id?> (<?=$dashboard->regist_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                    <label class="col-sm-2 control-label">최종수정</label>
                    <div class="col-sm-4">
                        <?php if($dashboard->update_id) { ?> <?=$dashboard->update_id?> (<?=$dashboard->update_date?>) <?php } else { echo "N/A"; } ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

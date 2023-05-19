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

            obj = $('#answer_email');
            if (obj.val() == "") {
                alert("답변자 이메일을 입력해주세요.");
                setFocus(obj);
                return false;
            }

            obj = $('#answer_title');
            if (obj.val() == "") {
                alert("답변 제목을 입력해주세요.");
                setFocus(obj);
                return false;
            }

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
    });
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/inquiry/estimate_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$estimate->estimate_seq?>">
                <input type="hidden" id="params" name="params" value="<?=$params?>">

                <div class="box-header with-border">
                    <h3 class="box-title">기업 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">사업체명</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->company_name?></label>
                        </div>
                        <label class="col-sm-2 control-label">대표자</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->company_ceo?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">사업자등록번호</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->company_no?></label>
                        </div>
                        <label class="col-sm-2 control-label">본사주소</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->company_address?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">판매 사이트</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->company_site?></label>
                        </div>
                        <label class="col-sm-2 control-label">대표 이메일</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->dec_company_email?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">브랜드명</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->company_brand?></label>
                        </div>
                        <label class="col-sm-2 control-label">고객센터 연락처</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->dec_company_tel?></label>
                        </div>
                    </div>
                </div>

                <?php
                    $arrPickup = explode(",", $estimate->pickup_type);
                ?>
                <div class="box-header with-border">
                    <h3 class="box-title">배송 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">출고시작일</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->release_date?></label>
                        </div>
                        <label class="col-sm-2 control-label">출고요일</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->release_week?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">주문 접수시간</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->release_time?></label>
                        </div>
                        <label class="col-sm-2 control-label">입고방법</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?php if($estimate->release_method == "P") { echo "픽업요청"; } else { echo "자체입고"; } ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">픽업 요청시간</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->pickup_time?></label>
                        </div>
                        <label class="col-sm-2 control-label">픽업 상차유형</label>
                        <div class="col-sm-4">
                            <label class="control-label">
                                <?php if(in_array("B", $arrPickup)) { echo "박스 "; } if(in_array("P", $arrPickup)) { echo "파레트 "; } if(in_array("R", $arrPickup)) { echo "롤테이너 "; } ?>
                                <?php if($estimate->pickup_etc) { echo "(".$estimate->pickup_etc.")"; } ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">픽업지 주소</label>
                        <div class="col-sm-10">
                            <label class="control-label"><?=$estimate->pickup_address1?> <?=$estimate->pickup_address2?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">특이사항</label>
                        <div class="col-sm-10">
                            <label class="control-label"><?=$estimate->release_content?></label>
                        </div>
                    </div>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">새벽배송 평균 물량</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">요일별</label>
                        <div class="col-sm-10">
                            월 : <label class="control-label"><?=$estimate->early_day1_cnt?></label>건 /
                            화 : <label class="control-label"><?=$estimate->early_day2_cnt?></label>건 /
                            수 : <label class="control-label"><?=$estimate->early_day3_cnt?></label>건 /
                            목 : <label class="control-label"><?=$estimate->early_day4_cnt?></label>건 /
                            금 : <label class="control-label"><?=$estimate->early_day5_cnt?></label>건 /
                            토 : <label class="control-label"><?=$estimate->early_day6_cnt?></label>건 /
                            일 : <label class="control-label"><?=$estimate->early_day7_cnt?></label>건
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">월별</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->early_month1?>월</label> : <label class="control-label"><?=$estimate->early_month1_cnt?></label>건 /
                            <label class="control-label"><?=$estimate->early_month2?>월</label> : <label class="control-label"><?=$estimate->early_month2_cnt?></label>건 /
                            <label class="control-label"><?=$estimate->early_month3?>월</label> : <label class="control-label"><?=$estimate->early_month3_cnt?></label>건
                        </div>
                    </div>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">택배배송 평균 물량</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">월별</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->delivery_month1?>월</label> : <label class="control-label"><?=$estimate->delivery_month1_cnt?></label>건 /
                            <label class="control-label"><?=$estimate->delivery_month2?>월</label> : <label class="control-label"><?=$estimate->delivery_month2_cnt?></label>건 /
                            <label class="control-label"><?=$estimate->delivery_month3?>월</label> : <label class="control-label"><?=$estimate->delivery_month3_cnt?></label>건
                        </div>
                    </div>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">물품 정보</h3>
                </div>

                <?php
                    $arrType = explode(",", $estimate->goods_type);
                ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">취급상품</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->goods_title?></label>
                        </div>
                        <label class="col-sm-2 control-label">유형</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?php if(in_array("F", $arrType)) { echo "냉동"; } if(in_array("C", $arrType)) { echo "냉장"; } if(in_array("R", $arrType)) { echo "상온"; } ?> <?php if($estimate->goods_etc) { echo "(".$estimate->goods_etc.")"; } ?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">규격</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->goods_length?>cm</label>
                        </div>
                        <label class="col-sm-2 control-label">무게</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->goods_weight?>kg</label>
                        </div>
                    </div>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">담당자 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">성함</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->manager_name?></label>
                        </div>
                        <label class="col-sm-2 control-label">연락처</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->dec_manager_tel?></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">이메일</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=$estimate->dec_manager_email?></label>
                        </div>
                    </div>
                </div>

                <div class="box-header with-border">
                    <h3 class="box-title">특이사항</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">내용</label>
                        <div class="col-sm-4">
                            <label class="control-label"><?=nl2br($estimate->estimate_content)?></label>
                        </div>
                    </div>
                </div>


                <div class="box-header with-border">
                    <h3 class="box-title">견적문의 답변</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">답변자 이메일</label>
                        <div class="col-sm-6">
                            <label class="control-label"><input type="text" id="answer_email" name="answer_email" maxlength="100" class="form-control input-sm" style="width:200px" value="<?=$estimate->dec_answer_email='nm_cs@kurlynextmile.com'?>"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">제목</label>
                        <div class="col-sm-10">
                            <label class="control-label"><input type="text" id="answer_title" name="answer_title" maxlength="100" class="form-control input-sm" style="width:300px" value="<?=$estimate->answer_title?>"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">답변 내용</label>
                        <div class="col-sm-6">
                            <textarea id="answer_content" name="answer_content" rows="16" cols="80"><?=$estimate->answer_content?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">파일첨부</label>
                        <div class="col-sm-3">
                            <input type="file" id="image_file" name="image_file" maxlength="100" class="form-control input-sm" value="">
                        </div>
                        <div class="col-sm-3">
                        <?php if($estimate->answer_filename) { ?>
                            <a href="<?=$estimate->answer_filepath?>/<?=$estimate->answer_filename?>" target="_blank"><?=$estimate->answer_filename?></a>
                        <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="box-footer text-center">
                    <?php if($estimate->estimate_status == "N") { ?>
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:100px;">답변저장</a>
                    <?php } ?>
                    <a href="/mgr/inquiry/estimate?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div>

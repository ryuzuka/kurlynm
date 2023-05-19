<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {        
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#research_cd');
            if (obj.val() == "") {
                alert("설문종류를 입력해주세요.");
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
        
        $('.radio-label input:radio').attr('disabled', 'disabled');
        $('input:checkbox').attr('disabled', 'true');
        $('textarea').attr('disabled', 'true');
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
    });
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/site/research_update" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" id="seq" name="seq" value="<?=$research->seq?>">
                <input type="hidden" id="params" name="params" value="<?=$params?>">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 설문 종류</label>
                        <div class="col-sm-4">
                            <select id="research_cd" name="research_cd" class="form-control input-sm">
                                <?php
                                    if ($researchCodeList) {
                                        foreach($researchCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($research->research_cd == $list->code) { echo "selected";} ?>><?=$list->code_name?></option>
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
                            <input type="text" id="title" name="title" maxlength="100" class="form-control input-sm" value="<?=$research->title?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시 기간</label>
                        <div class="col-sm-2">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="start_date" name="start_date" class="form-control pull-right calendar" value="<?=date('Y-m-d', strtotime($research->start_dt))?>">
                            </div>
                        </div>                        
                        <div class="col-sm-2">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" id="end_date" name="end_date" class="form-control pull-right calendar" value="<?=date('Y-m-d', strtotime($research->end_dt))?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 상태</label>
                        <div class="col-sm-2">
                            <select id="status" name="status" class="form-control input-sm">
                                <option value="Y" <?php if($research->status == "Y") { echo "selected";} ?>>활성</option>
                                <option value="N" <?php if($research->status == "N") { echo "selected";} ?>>비활성</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/research?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
            
            <?php
                if($research->research_cd == "02") {
            ?>
            <div class="box-header with-border">
                <h3 class="box-title">1차 지원 설문 정보</h3>
            </div>
            
            <div class="box-body">

                    <div class="cont-area apply_2_4">
                        <div class="cont-bottom">
                                <dl class="survey">
                                    <dt>1. '대학생 아시아 대장정'에 신청한 이유는 무엇입니까?</dt>
                                    <dd>
                                            <div class="radio-box">
                                              <label class="radio-label"><input type="radio" name="ans_1" value="1">1) 다양한 경험을 통해 견문을 넓히기 위해서</label>
                                              <label class="radio-label"><input type="radio" name="ans_1" value="2">2) 취업이나 진로에 도움이 될 수 있을것 같아서</label>
                                              <label class="radio-label"><input type="radio" name="ans_1" value="3">3) 다양한 대학, 전공 학생들과 교류할 수 있어서</label>
                                              <label class="radio-label"><input type="radio" name="ans_1" value="4">4) 해외탐방 프로그램의 주제와 내용에 공감해서</label>
                                              <label class="radio-label"><input type="radio" name="ans_1" value="5">5) 1회성 행사가 아닌 종합 인쟁 육성(리더십 함양 지원) 프로그램에 참여하기 위해서</label>
                                              <label class="radio-label"><input type="radio" name="ans_1" value="6">6) 개인 부담 없는 해외탐방 기회로 생각되서</label>
                                              <label class="radio-label">
                                                <input type="radio" name="ans_1" value="7">7) 기타
                                              </label>
                                            </div>
                                          </dd>
                                          <dt>2. '대학생 아시아 대장정'이 타기업에서 주최하는 대학생 프로그램과 차별성이 있다면 가장 차별화 된 점은 무엇이라고 생각하십니까?</dt>
                                          <dd>
                                            <div class="radio-box">
                                              <label class="radio-label"><input type="radio" name="ans_2" value="1">1) 오랜 역사와 전통</label>
                                              <label class="radio-label"><input type="radio" name="ans_2" value="2">2) 매년 새로운 주제의 해외탐담</label>
                                              <label class="radio-label"><input type="radio" name="ans_2" value="3">3) 동북아로 특화된 해외탐방</label>
                                              <label class="radio-label"><input type="radio" name="ans_2" value="4">4) 다양한 학교 및 전공의 학생 선발</label>
                                              <label class="radio-label"><input type="radio" name="ans_2" value="5">5) 1회성 해외탐방이 아닌 지속적인 인재 육성(리더십 함양 지원) 프로그램
                                                제공</label>
                                              <label class="radio-label">
                                                <input type="radio" name="ans_2" value="6">6) 기타
                                              </label>
                                            </div>
                                          </dd>
                                          <dt>3. '대학생 아시아 대장정'은 "해외탐방 프로그램"과 "사전, 사후 프로그램"으로 구성되어 있습니다.
                                            다음 보기는 해외탐방 중 프로그램입니다. 보기 중 가장 기대하는 프로그램은 무엇입니까?</dt>
                                          <dd>
                                            <div class="radio-box">
                                              <label class="radio-label"><input type="radio" name="ans_3" value="1">1) 탐방 주제 관련 강연 및 교육</label>
                                              <label class="radio-label"><input type="radio" name="ans_3" value="2">2) 현지 문화, 생활, 자연 체험</label>
                                              <label class="radio-label"><input type="radio" name="ans_3" value="3">3) 트래킹, 등산 등 극기 프로그램</label>
                                              <label class="radio-label"><input type="radio" name="ans_3" value="4">4) 현지 학생들 과의 교류</label>
                                              <label class="radio-label"><input type="radio" name="ans_3" value="5">5) 현지 자원봉사</label>
                                              <label class="radio-label"><input type="radio" name="ans_3" value="6">6) 그룹별 활동(소주제 탐방 등)</label>
                                            </div>
                                          </dd>
                                          <dt>4. '대학생 아시아 대장정'은 해외탐방 전, 후 참가자들의 리더십 함양을 지원하기 위한 프로그램을 제공하고 있습니다.<br>
                                            다음 중 중점을 두고 제공했으면 하는 프로그램은 무엇입니까?</dt>
                                          <dd>
                                            <div class="radio-box">
                                              <label class="radio-label"><input type="radio" name="ans_4" value="1">1) 셀프 리더십(비전 및 목표 수립, 실행, 도전정신 등) 프로그램</label>
                                              <label class="radio-label"><input type="radio" name="ans_4" value="2">2) 문화체험</label>
                                              <label class="radio-label"><input type="radio" name="ans_4" value="3">3) 온오프라인 커뮤니티 활동</label>
                                              <label class="radio-label"><input type="radio" name="ans_4" value="4">4) 자원봉사 활동</label>
                                              <label class="radio-label">
                                                <input type="radio" name="ans_4" value="5">5) 기타
                                              </label>
                                            </div>
                                          </dd>
                                          <dt>5. '대학생 아시아 대장정'을 알게 된 경로는 무엇입니까?</dt>
                                          <dd>
                                            <div class="radio-box">
                                              <label class="radio-label"><input type="radio" name="ans_5" value="1">1) 인터넷</label>
                                              <label class="radio-label"><input type="radio" name="ans_5" value="2">2) 신문, 잡지 기사 또는 광고</label>
                                              <label class="radio-label"><input type="radio" name="ans_5" value="3">3) 포스터 및 현수막</label>
                                              <label class="radio-label"><input type="radio" name="ans_5" value="4">4) TV, 라디오 방송</label>
                                              <label class="radio-label"><input type="radio" name="ans_5" value="5">5) 지인 소개</label>
                                              <label class="radio-label">
                                                <input type="radio" name="ans_5" value="6">6) 기타
                                              </label>
                                            </div>
                                          </dd>
                                          <dt class="ans_5_1">5-1. 5번 질문에서 '인터넷'으로 답한 경우 다음 중 '대학생 아시아 대장정'을 알게 된 경로는 무엇입니까?</dt>
                                          <dd class="ans_5_1">
                                            <div class="radio-box">
                                              <label class="radio-label"><input type="radio" name="ans_6" value="1">1) 페이스북</label>
                                              <label class="radio-label"><input type="radio" name="ans_6" value="2">2) 인스타그램</label>
                                              <label class="radio-label"><input type="radio" name="ans_6" value="3">3) 인터넷 커뮤니티 사이트(스펙업, 아웃캠퍼스 등)</label>
                                              <label class="radio-label"><input type="radio" name="ans_6" value="4">4) 이메일(교보생명, 대산문화재단, 교보문고)</label>
                                              <label class="radio-label"><input type="radio" name="ans_6" value="5">5) 홈페이지(교보생명, 대산문화재단, 교보문고, 대학생아시아대장정)</label>
                                              <label class="radio-label">
                                                <input type="radio" name="ans_6" value="6">6) 기타
                                              </label>
                                            </div>
                                          </dd>
                                          <dt class="ans_5_2">5-2. 5번 질문에서 '지인소개'으로 답한 경우 다음 중 어느 지인의 소개로 알게 되었습니까?</dt>
                                          <dd class="ans_5_2">
                                            <div class="radio-box">
                                              <label class="radio-label"><input type="radio" name="ans_7" value="1">1) 기존 참가자 친구(가족)</label>
                                              <label class="radio-label"><input type="radio" name="ans_7" value="2">2) 미 참가자 친구(가족)</label>
                                              <label class="radio-label"><input type="radio" name="ans_7" value="3">3) 부모님</label>
                                              <label class="radio-label"><input type="radio" name="ans_7" value="4">4) 교수님</label>
                                              <label class="radio-label">
                                                <input type="radio" name="ans_7" value="5">5) 기타
                                              </label>
                                            </div>
                                          </dd>
                                          <dt>6-1. 대한민국의 독립을 위해 헌신한 인물 중 본인이 가장 존경하는 인물은 누구인가요? 한 분만 적어 주시기 바랍니다.</dt>
                                          <dd>
                                            <textarea name="ans_8"></textarea>
                                          </dd>
                                          <dt>6-2. 대한민국의 독립을 위해 헌신한 인물 중 덜 알려져 있거나 재조명 받아야 한다고 생각하는 인물은 누구인가요?<br>
                                            한 분만 적어 주시기 바랍니다.</dt>
                                          <dd>
                                            <textarea name="ans_9"></textarea>
                                          </dd>
                                          <dt>7. 대학생 아시아 대장정의 탐방지와 관련 주제를 추천해주세요.</dt>
                                          <dd>
                                            <textarea name="ans_10"></textarea>
                                          </dd>
                                        <!-- </dl>

                                        <dl class="survey"> -->
                                          <dt>8. '교보생명'과 가장 잘 맞는 이미지는 무엇이라고 생각하십니까?</dt>
                                          <dd>
                                            <div class="radio-box">
                                              <label class="radio-label"><input type="radio" name="ans_11" value="1">1) 투명하고 윤리적인 회사</label>
                                              <label class="radio-label"><input type="radio" name="ans_11" value="2">2) 보험산업을 선도하는 회사</label>
                                              <label class="radio-label"><input type="radio" name="ans_11" value="3">3) 신뢰성이 높은 회사</label>
                                              <label class="radio-label"><input type="radio" name="ans_11" value="4">4) 재무구조가 튼튼한 회사</label>
                                              <label class="radio-label"><input type="radio" name="ans_11" value="5">5) 사회공헌활동을 잘 하는 회사</label>
                                              <label class="radio-label">
                                                <input type="radio" name="ans_11" value="6">6) 기타<br>
                                                <input type="text" name="ans_11_txt" id="ans_etc_txt">
                                              </label>
                                            </div>
                                          </dd>
                                          <dt>9. '교보생명'이라는 이름을 들었을 때 연상되는 것은 무엇입니까?(2개까지 선택 가능)</dt>
                                          <dd>
                                                <div class="check-box">
                                                  <label><input type="checkbox" name="ans_12_chk1" value="Y">1) 대형보험사</label>
                                                  <label><input type="checkbox" name="ans_12_chk2" value="Y">2) 교보빌딩</label>
                                                  <label><input type="checkbox" name="ans_12_chk3" value="Y">3) 교보문고</label>
                                                  <label><input type="checkbox" name="ans_12_chk4" value="Y">4) 교육보험</label>
                                                  <label><input type="checkbox" name="ans_12_chk5" value="Y">5) 대학생 아시아 대장정</label>
                                                  <label><input type="checkbox" name="ans_12_chk6" value="Y">6) 광화문글판</label>
                                                  <label><input type="checkbox" name="ans_12_chk7" value="Y">7) 공익재단과 사회공헌활동</label>
                                                </div>
                                            </dd>
                                        </dl>

                            </div>
                      </div>
                    
                </div>
            
                <?php
                    }
                ?>
            
            <?php
                if($research->research_cd == "03") {
            ?>
            <div class="box-header with-border">
                <h3 class="box-title">2차 지원 설문 정보</h3>
            </div>
            
            <div class="box-body">
                    <div class="cont-area apply_2_4">
                        <div class="cont-bottom">
                            <div class="info-box box-2">
                                <dl class="survey">
                                  <dt>1. 베트남의 지도자 호치민의 리더십에 대한 견해를 서술하고 이를 통해 본인이 갖추고 싶은 리더십의 덕목은 어떤 것인지 서술하세요. (300자 이내)</dt>
                                  <dd><textarea id="ans_1_txt" name="ans_1_txt"></textarea></dd>
                                  <dt>2. 본인 또는 타입의 도전 중 가장 가치 있었다고 생각 도전에 대해 적고 이번 대학생 아시아 대장정 참가자 본인에게 어떤 의미를 갖는 지 서술하세요. (300자 이내)
                                  </dt>
                                  <dd><textarea id="ans_2_txt" name="ans_2_txt"></textarea></dd>
                                  <dt>3. 빠르게 변하는 대한민국 사회 속에서 청년들이 무엇을 해야 하고 이를 위해 본인은 어떻게 실천 할 것인지 서술하세요. (300자 이내)</dt>
                                  <dd><textarea id="ans_3_txt" name="ans_3_txt"></textarea></dd>
                                  <dt>4. 주최 측에서는 탐방기간 중 대원들의 안전관리에 대해 최선의 노력을 기울이고 있습니다. 하지만 7박 9일간의 해외 탐방 프로그램이 정신적으로, 체력적으로 많은 부담이 될 수
                                    있으며, 예기치 못한 안전 사고가 발생할 가능성도 있습니다. 때문에 개인적인 차원에서의 안전관리 역시 중요합니다. 응모자께서는 안전한 탐방을 위해 개인적으로 어떠한 준비를 하실
                                    계획인지 서술해보십시오. (150자 이내)</dt>
                                  <dd><textarea id="ans_4_txt" name="ans_4_txt"></textarea></dd>
                                  <dt>※ 기타, 대학생 아시아 대장정 프로그램 중에서 공연, 행사 진행 등 개인의 끼를 뽐낼 기회들이 마련되어 있습니다.
                                    춤, 노래, 랩, 악기연주, 진행, 개인기 등 자타가 인정하는 수준급의 특기가 있는 분들은 적어주시 바랍니다. (공연팀 구성에 참조_배점 없음)</dt>
                                  <dd><textarea id="ans_5_txt" name="ans_5_txt"></textarea></dd>
                                </dl>
                              </div>
                        </div>
                    </div>
                </div>
            
            <?php
                }
            ?>
        </div>

    </div>
</div>
    <!-- s : contents -->
    <div class="contents information">
      <div class="visual information">
        <h2>견적문의</h2>
        <p class="text">간단한 문의서 작성으로 합리적인 요금을 확인해보세요</p>
      </div>
        
      <form id="frmEstimate" name="frmEstimate" method="post" action="/information/estimate_insert">
      <div class="inner-section if-inquiry">
        <div class="head-cont">
          <h3 class="kurly-text-02">문의서 작성</h3>
          <p class="kurly-text-05">더 빠르게 받아보고 싶은 고객의 니즈를 위해, 차별화된 새벽배송 서비스를 이용해보세요.</p>
        </div>
        <h4 class="kurly-text-03">기업정보</h4>
        <div class="round-box">
          <div class="form-box">
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="cpInfo01">사업체명</label>
                <div class="input">
                  <input type="text" id="company_name" name="company_name" placeholder="사업자등록증에 기입된 사업체명을 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="cpInfo02">대표자</label>
                <div class="input">
                  <input type="text" id="company_ceo" name="company_ceo" placeholder="사업자등록증에 기입된 대표자명을 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="cpInfo03">사업자등록번호</label>
                <div class="input">
                  <input type="text" id="company_no" name="company_no" placeholder="‘-’를 제외한 숫자만 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="cpInfo04">본사주소</label>
                <div class="input">
                  <input type="text" id="company_address" name="company_address" placeholder="본사주소를 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="cpInfo05">판매 사이트</label>
                <div class="input">
                  <input type="text" id="company_site" name="company_site" placeholder="URL을 입력해주세요. Ex) https://kurlynextmile.com">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="cpInfo06">대표 이메일</label>
                <div class="input">
                  <input type="text" id="company_email" name="company_email" placeholder="본사의 대표 이메일을 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="cpInfo07">브랜드명</label>
                <div class="input">
                  <input type="text" id="company_barnd" name="company_brand" placeholder="브랜드명이 있다면 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="cpInfo08">고객센터 연락처</label>
                <div class="input">
                  <input type="text" id="company_tel" name="company_tel" placeholder="‘-’를 제외한 숫자만 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h4 class="kurly-text-03">배송정보</h4>
        <div class="round-box">
          <div class="form-box">
            <div class="form-cell select-date">
              <label for="startYear" class="kurly-text-09">출고시작일</label>
              <input type="hidden" id="release_date" name="release_date">
              <div class="input-group">
                <div class="inbox">
                  <div class="year dropdown js-dropdown" data-placeholder="년">
                    <button type="button" id="startYear" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">년</button>
                    <div class="dropdown-box">
                      <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
	                      <!--
                        <li role="option" aria-selected="false"><button type="button" data-value="2022">2022년</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="2023">2023년</button></li>
                        -->
                      </ul>
                    </div>
                  </div>
                </div>
                
                <div class="inbox">
                  <div class="month dropdown js-dropdown" data-placeholder="월">
                    <button type="button" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">월</button>
                    <div class="dropdown-box">
                      <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                        <?php for($i=1; $i<=12; $i++) { ?>
                            <li role="option" aria-selected="false"><button type="button" data-value="<?=$i?>" class="sel_release_month"><?=$i?>월</button></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="inbox">
                  <div class="date dropdown js-dropdown" data-placeholder="일">
                    <button type="button" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">일</button>
                    <div class="dropdown-box">
                      <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                          <?php for($i=1; $i<=31; $i++) { ?>
                            <li role="option" aria-selected="false"><button type="button" data-value="<?=$i?>" class="sel_release_day"><?=$i?>일</button></li>
                          <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="form-head">
                <em class="kurly-text-09">출고요일</em>
                <span class="kurly-text-10">*픽업일 기준 (복수 선택 가능)</span>
                <input type="hidden" id="release_week" name="release_week">
              </div>
              <div class="input-group">
                <div class="chk-box">
                  <input type="checkbox" id="release_week_1" name="release_weeks" value="월" class="release_week"><label for="release_week_1">월</label>
                </div>
                <div class="chk-box">
                  <input type="checkbox" id="release_week_2" name="release_weeks" value="화" class="release_week"><label for="release_week_2">화</label>
                </div>
                <div class="chk-box">
                  <input type="checkbox" id="release_week_3" name="release_weeks" value="수" class="release_week"><label for="release_week_3">수</label>
                </div>
                <div class="chk-box">
                  <input type="checkbox" id="release_week_4" name="release_weeks" value="목" class="release_week"><label for="release_week_4">목</label>
                </div>
                <div class="chk-box">
                  <input type="checkbox" id="release_week_5" name="release_weeks" value="금" class="release_week"><label for="release_week_5">금</label>
                </div>
                <div class="chk-box">
                  <input type="checkbox" id="release_week_6" name="release_weeks" value="토" class="release_week"><label for="release_week_6">토</label>
                </div>
                <div class="chk-box">
                  <input type="checkbox" id="release_week_7" name="release_weeks" value="일" class="release_week"><label for="release_week_7">일</label>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="form-head">
                <label for="orderDate" class="kurly-text-09">주문 접수시간</label>
                <span class="kurly-text-10">*컬리넥스트마일에 접수하는 시간을 입력해주세요.</span>
                <input type="hidden" id="release_time" name="release_time">
              </div>
              <div class="input-group type">
                <div class="inbox">
                  <div class="dropdown js-dropdown" data-placeholder="0시">
                    <button type="button" id="orderDate" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">시</button>
                    <div class="dropdown-box">
                      <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                          <?php for($i=0; $i<=23; $i++) { ?>
                            <li role="option" aria-selected="false"><button type="button" data-value="<?=$i?>" class="sel_release_hour"><?=$i?>시</button></li>
                          <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="inbox">
                  <div class="dropdown js-dropdown" data-placeholder="0분">
                    <button type="button" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">분</button>
                    <div class="dropdown-box">
                      <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                          <?php for($i=0; $i<=50; $i=$i+10) { ?>
                            <li role="option" aria-selected="false"><button type="button"  data-value="<?=$i?>" class="sel_release_minute"><?=$i?>분</button></li>
                          <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <em class="kurly-text-09">입고 방법</em>
              <input type="hidden" id="release_method" name="release_method" value="S">
              <div class="input-group">
                <div class="rdo-box">
                  <input type="radio" id="release_method_1" name="sel_release_method" class="release_method" value="P"><label for="release_method_1">픽업요청</label>
                </div>
                <div class="rdo-box">
                  <input type="radio" id="release_method_2" name="sel_release_method" class="release_method" value="S" checked><label for="release_method_2">자체입고</label>
                </div>
              </div>
            </div>
            <div class="pickup-details">
              <div class="form-cell">
                <div class="form-head">
                  <div class="information">
                    <label for="pickupTime" class="kurly-text-09">픽업 요청시간</label>
                    <input type="hidden" id="pickup_time" name="pickup_time">
                    <div class="info-box">
                      <button type="button" class="button"><span class="blind"></span></button>
                      <div class="inner-layer">
                        <span>센터주소 : (서울센터) 서울시 송파구 송파대로 55<br>
                          (경기센터) 경기도 김포시 고촌읍 아라육로 57번길 15</span>
                      </div>
                    </div>
                  </div>
                  <span class="kurly-text-10">*자체입고시 센터입고 예정시간</span>
                </div>
                <div class="input-group type">
                  <div class="inbox">
                    <div class="dropdown js-dropdown" data-placeholder="시">
                      <button type="button" id="pickupTime" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">시</button>
                      <div class="dropdown-box">
                        <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                          <?php for($i=0; $i<=23; $i++) { ?>
                            <li role="option" aria-selected="false"><button type="button" data-value="<?=$i?>" class="sel_pickup_hour"><?=$i?>시</button></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="inbox">
                    <div class="dropdown js-dropdown" data-placeholder="분">
                      <button type="button" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">분</button>
                      <div class="dropdown-box">
                        <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                          <?php for($i=0; $i<=50; $i=$i+10) { ?>
                            <li role="option" aria-selected="false"><button type="button" data-value="<?=$i?>" class="sel_pickup_minute"><?=$i?>분</button></li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-cell">
                <em class="kurly-text-09">픽업 상차유형</em>
                <input type="hidden" id="pickup_type" name="pickup_type">
                <div class="input-group">
                  <div class="rdo-box">
                    <input type="radio" id="release_method_1" name="sel_release_type" class="pickup_type" value="B"><label for="release_method_1">박스</label>
                  </div>
                  <div class="rdo-box">
                    <input type="radio" id="release_method_2" name="sel_release_type" class="pickup_type" value="P"><label for="release_method_2">파레트</label>
                  </div>
                  <div class="rdo-box">
                    <input type="radio" id="release_method_3" name="sel_release_type" class="pickup_type" value="R"><label for="release_method_3">롤테이너</label>
                  </div>
                </div>
                <div class="input-area js-input">
                  <div class="input">
                    <input type="text" id="pickup_etc" name="pickup_etc" title="기타 유형 입력" placeholder="기타 : 유형을 입력해주세요.">
                  </div>
                </div>
              </div>
              <div class="form-cell full js-postcode">
                <em class="kurly-text-09">픽업지 주소</em>
                <div class="input-group address">
                  <div class="inbox">
                    <div class="input-area js-input">
                      <div class="input result">
                        <input type="text" id="pickup_address1" name="pickup_address1" class="noatv" readonly>
                      </div>
                    </div>
                    <button type="button" class="btn-search"><span class="blind">주소 검색</span></button>
                  </div>
                  <div class="inbox">
                    <div class="input-area js-input">
                      <div class="input detail">
                        <input type="text" id="pickup_address2" name="pickup_address2" title="상세 주소 입력" placeholder="상세주소를 입력해주세요.">
                        <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-cell full">
              <label for="pickupEtc" class="kurly-text-09">특이사항</label>
              <textarea id="release_content" name="release_content" cols="10" rows="3" placeholder="제품 또는 픽업 기사님께서 인지하여야 할 특이사항을 자세하게 입력해주세요."></textarea>
            </div>
          </div>
        </div>
        <h4 class="kurly-text-03">새벽배송 평균 물량</h4>
        <div class="round-box">
          <ul class="info-delivery">
            <li>*최근 3개월 이내의 평균 새벽배송 물량을 입력해주세요 (픽업일 기준) </li>
            <li>*새벽배송 물량이 없을경우 수도권 지역 일 평균 출고건을 기입해주세요.</li>
          </ul>
          <em class="kurly-text-09">요일별</em>
          <div class="week-group">
            <div class="inbox">
              <div class="input-area js-input">
                <label for="weekMon" class="day">월</label>
                <div class="input">
                  <input type="text" id="early_day1_cnt" name="early_day1_cnt" title="월요일 평균 물량 건수 입력">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input">
                <label for="weekTue" class="day">화</label>
                <div class="input">
                  <input type="text" id="early_day2_cnt" name="early_day2_cnt" title="화요일 평균 물량 건수 입력">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input">
                <label for="weekWed" class="day">수</label>
                <div class="input">
                  <input type="text" id="early_day3_cnt" name="early_day3_cnt" title="수요일 평균 물량 건수 입력">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input">
                <label for="weekThu" class="day">목</label>
                <div class="input">
                  <input type="text" id="early_day4_cnt" name="early_day4_cnt" title="목요일 평균 물량 건수 입력">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input">
                <label for="weekFri" class="day">금</label>
                <div class="input">
                  <input type="text" id="early_day5_cnt" name="early_day5_cnt" title="금요일 평균 물량 건수 입력">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input">
                <label for="weekSat" class="day">토</label>
                <div class="input">
                  <input type="text" id="early_day6_cnt" name="early_day6_cnt" title="토요일 평균 물량 건수 입력">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input">
                <label for="weekSun" class="day">일</label>
                <div class="input">
                  <input type="text" id="early_day7_cnt" name="early_day7_cnt" title="일요일 평균 물량 건수 입력">
                </div>
                건
              </div>
            </div>
          </div>
          <div class="vertical-box">
            <label for="dawnMonth" class="kurly-text-09">월별</label>
            <div class="month-group" data-type="early">
                <input type="hidden" id="early_month1" name="early_month1">
                <input type="hidden" id="early_month2" name="early_month2">
                <input type="hidden" id="early_month3" name="early_month3">
              <div class="input-group">
                <div class="inbox">
                  <div class="dropdown js-dropdown" data-placeholder="월">
                    <button type="button" id="dawnMonth" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">월</button>
                    <div class="dropdown-box">
                      <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                        <li role="option" aria-selected="false"><button type="button" data-value="1">1월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="2">2월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="3">3월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="4">4월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="5">5월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="6">6월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="7">7월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="8">8월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="9">9월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="10">10월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="11">11월</button></li>
                        <li role="option" aria-selected="false"><button type="button" data-value="12">12월</button></li>
                      </ul>
                    </div>
                  </div>
                </div>
                
                <div class="inbox">
                  <div class="input-area js-input number">
                    <div class="input">
                      <input type="text" id="early_month1_cnt" name="early_month1_cnt" title="월별 배송 건수 입력">
                    </div>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <div class="inbox">
                  <div class="dropdown js-dropdown" data-placeholder="월">
                    <button type="button" id="sel_early_month2" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">월</button>
                    <div class="dropdown-box">
                      <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                        <?php for($i=1; $i<=12; $i++) { ?>
                            <li role="option" aria-selected="false" data-value="<?=$i?>" class="sel_early_month2"><button type="button"><?=$i?>월</button></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="inbox">
                  <div class="input-area js-input number">
                    <div class="input">
                      <input type="text" id="early_month2_cnt" name="early_month2_cnt" title="월별 배송 건수 입력">
                    </div>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <div class="inbox">
                  <div class="dropdown js-dropdown" data-placeholder="월">
                    <button type="button" id="sel_early_month3" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">월</button>
                    <div class="dropdown-box">
                      <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                        <?php for($i=1; $i<=12; $i++) { ?>
                            <li role="option" aria-selected="false" data-value="<?=$i?>" class="sel_early_month3"><button type="button"><?=$i?>월</button></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="inbox">
                  <div class="input-area js-input number">
                    <div class="input">
                      <input type="text" id="early_month3_cnt" name="early_month3_cnt" title="월별 배송 건수 입력">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h4 class="kurly-text-03">택배배송 평균 물량</h4>
        <div class="round-box">
          <ul class="info-delivery">
            <li>*최근 3개월 이내의 평균 새벽배송 물량을 입력해주세요 (픽업일 기준) </li>
          </ul>
          <label for="deliveryMonth" class="kurly-text-09">월별</label>
          <div class="month-group" data-type="delivery">
                <input type="hidden" id="delivery_month1" name="delivery_month1">
                <input type="hidden" id="delivery_month2" name="delivery_month2">
                <input type="hidden" id="delivery_month3" name="delivery_month3">
            <div class="input-group">
              <div class="inbox">
                <div class="dropdown js-dropdown" data-placeholder="월">
                  <button type="button" id="deliveryMonth" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">월</button>
                  <div class="dropdown-box">
                    <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                        <?php for($i=1; $i<=12; $i++) { ?>
                            <li role="option" aria-selected="false" data-value="<?=$i?>" class="sel_delivery_month1"><button type="button"><?=$i?>월</button></li>
                        <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="inbox">
                <div class="input-area js-input number">
                  <div class="input">
                    <input type="text" id="delivery_month1_cnt" name="delivery_month1_cnt" title="월별 배송 건수 입력">
                  </div>
                </div>
              </div>
            </div>
            <div class="input-group">
              <div class="inbox">
                <div class="dropdown js-dropdown" data-placeholder="월">
                  <button type="button" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">월</button>
                  <div class="dropdown-box">
                    <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                        <?php for($i=1; $i<=12; $i++) { ?>
                            <li role="option" aria-selected="false" data-value="<?=$i?>" class="sel_delivery_month2"><button type="button"><?=$i?>월</button></li>
                        <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="inbox">
                <div class="input-area js-input number">
                  <div class="input">
                    <input type="text" id="delivery_month2_cnt" name="delivery_month2_cnt" title="월별 배송 건수 입력">
                  </div>
                </div>
              </div>
            </div>
            <div class="input-group">
              <div class="inbox">
                <div class="dropdown js-dropdown" data-placeholder="월">
                  <button type="button" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">월</button>
                  <div class="dropdown-box">
                    <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                        <?php for($i=1; $i<=12; $i++) { ?>
                            <li role="option" aria-selected="false" data-value="<?=$i?>" class="sel_delivery_month3"><button type="button"><?=$i?>월</button></li>
                        <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="inbox">
                <div class="input-area js-input number">
                  <div class="input">
                    <input type="text" id="delivery_month3_cnt" name="delivery_month3_cnt" title="월별 배송 건수 입력">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h4 class="kurly-text-03">물품정보</h4>
        <div class="round-box">
          <div class="form-box">
            <div class="form-cell">
              <label for="articleInfo01" class="kurly-text-09">취급상품</label>
              <div class="input-area js-input">
                <div class="input">
                  <input type="text" id="goods_title" name="goods_title" title="취급상품 입력" placeholder="Ex) 반찬, 샐러드, 육류, 의류 등">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
              <div class="vertical-box">
                <label for="articleInfo02" class="kurly-text-09">규격 (cm) / 무게 (kg)</label>
                <div class="standard-group-new">
                  <div class="input-area js-input">
                    <div class="input">
                      <input type="text" id="goods_length" name="goods_length" title="규격 가로 입력" placeholder="가로 x 세로 x 높이 (세변의 합)">
                    </div>
                  </div>
                  <div class="input-area js-input">
                    <div class="input">
                      <input type="text" id="goods_weight" name="goods_weight" title="무게 입력" placeholder="무게">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <em class="kurly-text-09">유형</em>
              <input type="hidden" id="goods_type" name="goods_type">
              <div class="input-group">
                <div class="chk-box">
                  <input type="checkbox" id="goods_types_1" name="goods_types" value="F" class="goods_type"><label for="goods_types_1">냉장</label>
                </div>
                <div class="chk-box">
                    <input type="checkbox" id="goods_types_2" name="goods_types" value="C" class="goods_type"><label for="goods_types_2">냉동</label>
                </div>
                <div class="chk-box">
                    <input type="checkbox" id="goods_types_3" name="goods_types" value="R" class="goods_type"><label for="goods_types_3">상온</label>
                </div>
              </div>
              <div class="input-area js-input">
                <div class="input">
                  <input type="text" id="goods_etc" name="goods_etc" title="기타 유형 입력" placeholder="기타 : 유형을 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h4 class="kurly-text-03">담당자</h4>
        <div class="round-box">
          <div class="form-box">
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="personInfo01" class="kurly-text-09 req">성함</label>
                <div class="input">
                  <input type="text" id="manager_name" name="manager_name" placeholder="담당자 성함을 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="personInfo02" class="kurly-text-09 req">연락처</label>
                <div class="input">
                  <input type="text" id="manager_tel" name="manager_tel" placeholder="담당자 연락처를 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
            <div class="form-cell">
              <div class="input-area js-input">
                <label for="personInfo03" class="kurly-text-09 req">이메일주소</label>
                <div class="input">
                  <input type="text" id="manager_email" name="manager_email" placeholder="담당자 이메일 주소를 입력해주세요.">
                  <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h4 class="kurly-text-03">특이사항</h4>
        <div class="textarea-type js-textarea">
          <textarea id="estimate_content" name="estimate_content" cols="30" rows="10" placeholder="기타 특이사항 및 문의사항을 입력해 주세요."></textarea>
        </div>
        <h4 class="kurly-text-03">개인정보 수집·이용 동의</h4>
        <div class="textarea-type js-textarea">
          <textarea id="txt-field2" name="txt-field" cols="30" rows="10" readonly>
- 이용자가 제공한 모든 정보는 다음의 목적을 위해 활용하며, 하기 목적 이외의 용도로는 사용되지 않습니다.
① 개인정보 수집 항목 및 수집·이용 목적
가) 수집 항목 (필수항목)
- 성명(국문), 주민등록번호, 주소, 전화번호(자택, 휴대전화), 사진, 이메일, 나이, 재학정보, 병역사항, 외국어 점수, 가족관계, 재산정도, 수상
내역, 사회활동, 타 장학금 수혜현황, 요식업 종사 현황 등 지원 신청서에 기재된 정보 또는 신청자가 제공한 정보
- 이용자가 제공한 모든 정보는 다음의 목적을 위해 활용하며, 하기 목적 이외의 용도로는 사용되지 않습니다.
          </textarea>
        </div>
        <div class="pre_agree">
          <span>개인정보 수집 및 이용에 대해 동의를 거부하실 수 있으나 거부하시는 경우 견적 문의가 불가합니다.</span>
          <div class="pre_agree_are">
            <div class="input_are">
            <input type="checkbox" id="pre_agree" name="pre_agree"><label for="pre_agree"></label>
            </div>
            <p>동의합니다.</p>
          </div>
        </div>
        <div class="btn-wrap">
          <button type="button" class="btn btn-submit btn-primary">문의하기</button>
        </div>
        <h4 class="kurly-text-03">견적문의 진행절차</h4>
        <ul class="list-inquiry process">
          <li>
            <em class="kurly-text-06">문의서 작성</em>
            <p class="text">고객사의 상품정보, 출고량 등<br>기본정보를 작성해주세요.</p>
          </li>
          <li>
            <em class="kurly-text-06">미팅 진행</em>
            <p class="text">미팅을 통해 구체적인<br>물류 서비스에 대해 설명드립니다.</p>
          </li>
          <li>
            <em class="kurly-text-06">견적서 작성</em>
            <p class="text">위탁 서비스의 특성에 따른<br>견적서를 작성합니다.</p>
          </li>
          <li>
            <em class="kurly-text-06">견적서 발행</em>
            <p class="text">합리적인 견적 금액을<br>제안드립니다.</p>
          </li>
        </ul>
      </div>
      </form>
        
      <div class="inquiry-section">
        <p class="text">편하신 경로로 문의주시면 신속하게 답변드리겠습니다.</p>
        <p class="kurly-text-02">궁금한 점이 있으신가요?</p>
        <span class="text-number">070-4352-4735</span>
        <div class="btn-wrap">
          <a href="/customer/inquiry_write" class="btn btn-primary-round">1:1 문의하기</a>
          <a href="#" class="btn-inquiry">카카오톡 문의하기</a>
        </div>
      </div>
    </div>
    <!-- e : contents -->
    
    <div id="pop-alert" class="layer" role="dialog" aria-modal="true">
        <div class="layer-wrap">
            <div class="layer-content"></div>
            <div class="button-wrap">
                <button class="btn"></button>
            </div>
        </div>
    </div>    
    
  <script>
    $(function() {
        $('#pop-alert').modal({
            text: '문의가 정상적으로 접수되었습니다.<br>빠른 시일 내에 답변 드리겠습니다.',
            buttonText: '확인',
            closedFocus: '.mypage_adit .modify'
        }, e => {
            if (e.type === 'before-close') {
                // modal before-close
            } else if (e.type === 'close') {
                var member_id = "<?=$this->session->userdata('MID')?>";
                
                if(member_id) {
                    location.href = "/member/estimate";
                } else {
                    location.href = "/";
                }
            }
        });

        $('.btn-submit').on('click',function(e) {
            var obj;

            obj = $('#company_name');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '사업체명을 입력해주세요.',
                    buttonText: '확인',
                    closedFocus: '.mypage_adit .modify'
                }, e => {
                    if (e.type === 'before-close') {
                        // modal before-close
                    } else if (e.type === 'close') {
                        obj.focus();
                    }
                });                
                return false;
            }
            
            obj = $('#manager_name');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '담당자 성함을 입력해주세요.',
                    buttonText: '확인',
                    closedFocus: '.mypage_adit .modify'
                }, e => {
                    if (e.type === 'before-close') {
                        // modal before-close
                    } else if (e.type === 'close') {
                        obj.focus();
                    }
                });                
                return false;
            }
            
            obj = $('#manager_tel');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '담당자 연락처를 입력해주세요.',
                    buttonText: '확인',
                    closedFocus: '.mypage_adit .modify'
                }, e => {
                    if (e.type === 'before-close') {
                        // modal before-close
                    } else if (e.type === 'close') {
                        obj.focus();
                    }
                });
                return false;
            }
            
            obj = $('#manager_email');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '담당자 이메일 주소를 입력해주세요.',
                    buttonText: '확인',
                    closedFocus: '.mypage_adit .modify'
                }, e => {
                    if (e.type === 'before-close') {
                        // modal before-close
                    } else if (e.type === 'close') {
                        obj.focus();
                    }
                });                
                return false;
            }
            
            obj = $('#pre_agree');
            if($('input:checkbox[id="pre_agree"]').is(":checked") == false) {
                $('#pop-alert').modal({
                    text: '개인정보 이용수집에 동의해해주세요.',
                    buttonText: '확인',
                    closedFocus: '.mypage_adit .modify'
                }, e => {
                    if (e.type === 'before-close') {
                        // modal before-close
                    } else if (e.type === 'close') {
                        obj.focus();
                    }
                });                
                return false;
            }
            
            var yn = confirm("견적 문의하시겠습니까?");
            if (yn) {
                $('#frmEstimate').submit();
            } else {
                return false;
            }
        });
        
        // 배송정보 - 출고 시작일
        var release_date;   var release_year = 0;   var release_month = 0;  var release_day = 0;
        
        $('.sel_release_year').on('click',function(e) {
            var sel_year = $(this).attr("data-value");
            release_year = sel_year;
            release_date = release_year + "-" + release_month + "-" + release_day;
            $("#release_date").val(release_date);
        });
        
        $('.sel_release_month').on('click',function(e) {
            var sel_month = $(this).attr("data-value");
            if(sel_month < 10) sel_month = "0" + sel_month;
            release_month = sel_month;
            release_date = release_year + "-" + release_month + "-" + release_day;
            $("#release_date").val(release_date);
        });
        
        $('.sel_release_day').on('click',function(e) {
            var sel_day = $(this).attr("data-value");
            if(sel_day < 10) sel_day = "0" + sel_day;
            release_day = sel_day;
            release_date = release_year + "-" + release_month + "-" + release_day;
            $("#release_date").val(release_date);
        });
        // 배송정보 - 출고 시작일
        
        // 배송정보 - 출고 요일        
        $('.release_week').on('click',function(e) {
            var release_week = "";
            $("input:checkbox[name='release_weeks']").each(function() {
                if($(this).is(":checked")) {
                    release_week += $(this).val() + ",";
                }
            });
            
            $("#release_week").val(release_week);
        });
        // 배송정보 - 출고 요일
        
        // 배송정보 - 주문 접수시간
        var release_time;   var release_hour = 0;   var release_minute = 0;
        
        $('.sel_release_hour').on('click',function(e) {
            var sel_hour = $(this).attr("data-value");
            if(sel_hour < 10) sel_hour = "0" + sel_hour;
            release_hour = sel_hour;
            release_time = release_hour + ":" + release_minute;
            $("#release_time").val(release_time);
        });
        
        $('.sel_release_minute').on('click',function(e) {
            var sel_minute = $(this).attr("data-value");
            if(sel_minute < 10) sel_minute = "0" + sel_minute;
            release_minute = sel_minute;
            release_time = release_hour + ":" + release_minute;
            $("#release_time").val(release_time);
        });
        // 배송정보 - 주문 접수시간
                
        // 배송정보 - 입고 방법
        $('.release_method').on('change',function(e) {
            $("#release_method").val($(this).val());
          
            if($(this).val() === 'P') {
                $('.pickup-details').css('display','flex');
            } else if ($(this).val() === 'S') {
                $('.pickup-details').css('display','none');
            }
        });
        // 배송정보 - 입고 방법
        
        // 배송정보 - 픽업 시간
        var pickup_time;   var pickup_hour = 0;   var pickup_minute = 0;
        
        $('.sel_pickup_hour').on('click',function(e) {
            var sel_hour = $(this).attr("data-value");
            if(sel_hour < 10) sel_hour = "0" + sel_hour;
            pickup_hour = sel_hour;
            pickup_time = pickup_hour + ":" + pickup_minute;
            $("#pickup_time").val(pickup_time);
        });
        
        $('.sel_pickup_minute').on('click',function(e) {
            var sel_minute = $(this).attr("data-value");
            if(sel_minute < 10) sel_minute = "0" + sel_minute;
            pickup_minute = sel_minute;
            pickup_time = pickup_hour + ":" + pickup_minute;
            $("#pickup_time").val(pickup_time);
        });
        // 배송정보 - 픽업 시간
        
        // 배송정보 - 픽업 상차유형
        $('.pickup_type').on('change',function(e) {
            $("#pickup_type").val($(this).val());
        });
        // 배송정보 - 픽업 상차유형
        
        
        // 새벽배송 - 월별 물량        
        $('.sel_early_month1').on('click',function(e) {
            var sel_month = $(this).attr("data-value");
            //if(sel_month < 10) sel_month = "0" + sel_month;
            $("#early_month1").val(sel_month);
        });
        
        $('.sel_early_month2').on('click',function(e) {
            var sel_month = $(this).attr("data-value");
            //if(sel_month < 10) sel_month = "0" + sel_month;
            $("#early_month2").val(sel_month);
        });
        
        $('.sel_early_month3').on('click',function(e) {
            var sel_month = $(this).attr("data-value");
            //if(sel_month < 10) sel_month = "0" + sel_month;
            $("#early_month3").val(sel_month);
        });
        // 새벽배송 - 월별 물량
        
        // 택배배송 - 월별 물량        
        $('.sel_delivery_month1').on('click',function(e) {
            var sel_month = $(this).attr("data-value");            
            //if(sel_month < 10) sel_month = "0" + sel_month;
            $("#delivery_month1").val(sel_month);
        });
        
        $('.sel_delivery_month2').on('click',function(e) {
            var sel_month = $(this).attr("data-value");
            //if(sel_month < 10) sel_month = "0" + sel_month;
            $("#delivery_month2").val(sel_month);
        });
        
        $('.sel_delivery_month3').on('click',function(e) {
            var sel_month = $(this).attr("data-value");
            //if(sel_month < 10) sel_month = "0" + sel_month;
            $("#delivery_month3").val(sel_month);
        });
        // 택배배송 - 월별 물량
        
        // 물품정보 - 유형
        $('.goods_type').on('click',function(e) {
            var goods_type = "";
            $("input:checkbox[name='goods_types']").each(function() {
                if($(this).is(":checked")) {
                    goods_type += $(this).val() + ",";
                }
            });
            
            $("#goods_type").val(goods_type);
        });
        // 물품정보 - 유형
    })
    
	  ;($ => {
		  $.depth1Index = 2
		  $.depth2Index = 1
		
		  $(function () {
			  /** 출고시작일 */
			  $('.select-date').on('change', e => {
				  console.log(e.date, e.dateFormat)
			  })
		    /** 출고요일 */
		    $('.input-group.date').on('change-input', e => {
			    console.log(e)
		    })
		    /** 입고 방법 */
		    $('.input-group.receiving').on('change-input', e => {
			    $('.pickup-details').css('display', e.value === 'rdoPickup' ? 'flex' : '')
		    })
		    /** 픽업 상차유형 */
		    $('.input-group.pickup').on('change-input', e => {
					console.log(e)
		    })
			  /** 물품정보 - 유형 */
			  $('.input-group.status').on('change-input', e => {
				  console.log(e)
			  })
			  /** 주문 접수시간 */
			  $('.select-time[data-type="release"]').on('change', e => {
				  console.log(e.time, e.timeFormat)
			  })
			  /** 픽업 요청시간 */
			  $('.select-time[data-type="pickup"]').on('change', e => {
				  console.log(e.time, e.timeFormat)
			  })
		  })
    })(window.jQuery)    
  </script>    
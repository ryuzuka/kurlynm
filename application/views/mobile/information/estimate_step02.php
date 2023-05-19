    <!--: Start #contents -->
    <div class="contents information information-detail">

        <div class="step6">
            <div class="step">
                <span class="atv ok"></span>
                <span class="atv"></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <form id="frmEstimate" name="frmEstimate" method="post" action="/information/estimate_step02_insert">
            <input type="hidden" id="estimate_seq" name="estimate_seq" value="<?=$estimate_seq?>">
            <input type="hidden" id="current_step" name="current_step" value="<?=$current_step?>">
            <div class="form">
                <h2>배송정보를 입력해주세요.</h2>

                <div class="round-box">
                  <div class="form-box">
                    <div class="form-cell select-date">
                      <label for="startYear">출고시작일</label>
                      <input type="hidden" id="release_date" name="release_date">
                      <div class="input-group">
                        <div class="inbox">
                          <div class="year dropdown js-dropdown" data-placeholder="년">
                            <button type="button" id="startYear" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">년</button>
                            <div class="dropdown-box">
                              <ul class="dropdown-list" role="listbox" aria-labelledby="dropdown" tabindex="-1">
                                
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
                        <em>출고요일</em>
                        <span>*픽업일 기준 (복수 선택 가능)</span>
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
                        <label for="orderDate">입고 방법</label>
                        <input type="hidden" id="release_method" name="release_method" value="S">
                      </div>
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
                      <div class="form-cell select-time" data-type="release">
                        <div class="form-head">
                          <label for="orderDate">주문 접수시간</label>
                          <span>*컬리넥스트마일에 접수하는 시간을 입력해주세요.</span>
                          <input type="hidden" id="release_time" name="release_time">
                        </div>
                        <div class="input-group type">
                          <div class="inbox">
                            <div class="hour dropdown js-dropdown" data-placeholder="0시">
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
                            <div class="minute dropdown js-dropdown" data-placeholder="0분">
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
                      <div class="form-cell select-time" data-type="pickup">
                        <div class="form-head">
                            <label for="pickupTime">픽업 요청시간</label>
                            <span>*자체입고 시 센터입고 예정시간</span>
                            <input type="hidden" id="pickup_time" name="pickup_time">
                        </div>
                        <div class="input-group type">
                          <div class="inbox">
                            <div class="hour dropdown js-dropdown" data-placeholder="0시">
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
                            <div class="minute dropdown js-dropdown" data-placeholder="0분">
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
                      <div class="form_center">
                        <span>센터주소</span>
                        <p>
                          (서울센터) 서울시 송파구 송파대로 55<br>
                          (경기센터) 경기도 김포시 고촌읍 아라육로 57번길 15
                        </p>
                      </div>

                  <div class="address full js-postcode">
                    <div class="input-area js-input">
                        <label for="inp-txt5">픽업지 주소</label>
                        <div class="input mbtn result">
                            <input type="text" id="pickup_address1" name="pickup_address1">
                          <button type="button" class="btn-search"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                        </div>
                        <div class="input mbtn detail">
                          <input type="text" id="pickup_address2" name="pickup_address2" title="상세 주소 입력" placeholder="상세주소를 입력해주세요.">
                          <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                        </div>
                    </div>
                  </div>

                      <div class="form-cell">
                        <div class="form-head">
                          <label>픽업 상차유형</label>
                          <input type="hidden" id="pickup_type" name="pickup_type">
                      </div>
                        <div class="input-group mbtn10">
                            <div class="chk-box">
                              <input type="checkbox" id="release_method_1" name="sel_release_type" class="pickup_type" value="B"><label for="release_method_1">박스</label>
                            </div>
                            <div class="chk-box">
                              <input type="checkbox" id="release_method_2" name="sel_release_type" class="pickup_type" value="P"><label for="release_method_2">파레트</label>
                            </div>
                            <div class="chk-box">
                              <input type="checkbox" id="release_method_3" name="sel_release_type" class="pickup_type" value="R"><label for="release_method_3">롤테이너</label>
                            </div>
                        </div>
                        <div class="input-area js-input">
                          <div class="input mbtn">
                            <input type="text" id="pickup_etc" name="pickup_etc" title="기타 유형 입력" placeholder="기타 : 유형을 입력해주세요.">
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="form-cell full">
                      <label for="pickupEtc" class="kurly-text-09">특이사항</label>
                      <textarea  id="release_content" name="release_content" cols="10" rows="3" placeholder="제품 또는 픽업 기사님께서 인지하여야 할 특이사항을 자세하게 입력해주세요."></textarea>
                    </div>
                  </div>
                </div>

            </div>
        </form>

        <div class="form_btn">
            <button class="btn btn-primary btn-w100 btn-next">다음</button>
            <button class="btn btn-secondary btn-w100 btn-prev">이전</button>
        </div>

       
    </div>


<script>
    $(function() {
        $('.pickup-details').css('display','none');
        
        $('.btn-next').on('click',function(e) {
            $('#frmEstimate').submit();
        });
        
        $('.btn-prev').on('click',function(e) {
            var estimate_seq = "<?=$estimate_seq?>";
            var current_step = "<?=$current_step?>";
            location.href = "/information/estimate_step01_info?estimate_seq="+estimate_seq+"&current_step="+current_step;
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
                $('.pickup-details').css('display','block');
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
            var pickup_type = "";
            $("input:checkbox[name='sel_release_type']").each(function() {
                if($(this).is(":checked")) {
                    pickup_type += $(this).val() + ",";
                }
            });
            $("#pickup_type").val(pickup_type);
        });
        // 배송정보 - 픽업 상차유형
    });
    
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
                $('.pickup-details').css('display', e.value === 'rdoPickup' ? 'block' : '')
            })
            /** 픽업 상차유형 */
            $('.input-group.pickup').on('change-input', e => {
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

    <!--: End #contents -->
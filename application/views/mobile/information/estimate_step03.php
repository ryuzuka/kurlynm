    <!--: Start #contents -->
    <div class="contents information information-detail">

        <div class="step6">
            <div class="step">
                <span class="atv ok"></span>
                <span class="atv ok"></span>
                <span class="atv"></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <form id="frmEstimate" name="frmEstimate" method="post" action="/information/estimate_step03_insert">
            <input type="hidden" id="estimate_seq" name="estimate_seq" value="<?=$estimate_seq?>">
            <input type="hidden" id="current_step" name="current_step" value="<?=$current_step?>">
        <div class="form">
        <h2>평균물량을 입력해주세요
          <span>*최근 3개월 이내의 평균물량 (픽업일 기준)</span>
        </h2>

        <div class="input-area js-input"></div>
        
        <div class="form_step4">
        <h4>새벽배송 평균 물량
          <span>*새벽배송 물량이 없을경우 수도권 지역의 일 평균 출고건 기입</span>
        </h4>
        <div class="daybox">
          <div class="form-head">
            <label>요일별</label>
        </div>
          <div class="week-group">
            <div class="inbox">
              <div class="input-area js-input number">
                <label for="weekMon" class="day">월</label>
                <div class="input">
                  <input type="text" id="early_day1_cnt" name="early_day1_cnt" title="월요일 평균 물량 건수 입력" maxlength="5">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input number">
                <label for="weekTue" class="day">화</label>
                <div class="input">
                  <input type="text" id="early_day2_cnt" name="early_day2_cnt" title="월요일 평균 물량 건수 입력" maxlength="5">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input number">
                <label for="weekWed" class="day">수</label>
                <div class="input">
                  <input type="text" id="early_day3_cnt" name="early_day3_cnt" title="월요일 평균 물량 건수 입력" maxlength="5">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input number">
                <label for="weekThu" class="day">목</label>
                <div class="input">
                  <input type="text" id="early_day4_cnt" name="early_day4_cnt" title="월요일 평균 물량 건수 입력" maxlength="5">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input number">
                <label for="weekFri" class="day">금</label>
                <div class="input">
                  <input type="text" id="early_day5_cnt" name="early_day5_cnt" title="월요일 평균 물량 건수 입력" maxlength="5">
                </div>
                건
              </div>
            </div>
            <div class="inbox">
              <div class="input-area js-input number">
                <label for="weekSat" class="day">토</label>
                <div class="input">
                  <input type="text" id="early_day6_cnt" name="early_day6_cnt" title="월요일 평균 물량 건수 입력" maxlength="5">
                </div>
                건
              </div>
            </div>
              <div class="inbox">
              <div class="input-area js-input number">
                <label for="weekSat" class="day">일</label>
                <div class="input">
                  <input type="text" id="early_day7_cnt" name="early_day7_cnt" title="월요일 평균 물량 건수 입력" maxlength="5">
                </div>
                건
              </div>
            </div>
          </div>
          <div class="vertical-box">
            <div class="form-head">
              <label>월별</label>
          </div>
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
                        <?php for($i=1; $i<=12; $i++) { ?>
                            <li role="option" aria-selected="false" data-value="<?=$i?>" class="sel_early_month1"><button type="button"><?=$i?>월</button></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="inbox">
                  <div class="input-area js-input number">
                    <div class="input">
                      <input type="text" id="early_month1_cnt" name="early_month1_cnt" title="월별 배송 건수 입력" maxlength="7">
                    </div>
                    건
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
                            <li role="option" aria-selected="false" data-value="<?=$i?>" class="sel_early_month2"><button type="button"><?=$i?>월</button></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="inbox">
                  <div class="input-area js-input number">
                    <div class="input">
                      <input type="text" id="early_month2_cnt" name="early_month2_cnt" title="월별 배송 건수 입력" maxlength="7">
                    </div>
                    건
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
                            <li role="option" aria-selected="false" data-value="<?=$i?>" class="sel_early_month3"><button type="button"><?=$i?>월</button></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="inbox">
                  <div class="input-area js-input number">
                    <div class="input">
                      <input type="text" id="early_month3_cnt" name="early_month3_cnt" title="월별 배송 건수 입력" maxlength="7">
                    </div>
                    건
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="line"></div>


      <div class="form_step4">
        <h4>택배배송 평균물량</h4>

        <div class="vertical-box">
          <div class="form-head">
            <label>월별</label>
        </div>
          <div class="month-group" data-type="delivery">
                <input type="hidden" id="delivery_month1" name="delivery_month1">
                <input type="hidden" id="delivery_month2" name="delivery_month2">
                <input type="hidden" id="delivery_month3" name="delivery_month3">            
            <div class="input-group">
              <div class="inbox">
                <div class="dropdown js-dropdown" data-placeholder="월">
                  <button type="button" id="dawnMonth" class="dropdown-btn" aria-haspopup="listbox" aria-expanded="false">월</button>
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
                    <input type="text" id="delivery_month1_cnt" name="delivery_month1_cnt" title="월별 배송 건수 입력" maxlength="7">
                  </div>
                  건
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
                    <input type="text" id="delivery_month2_cnt" name="delivery_month2_cnt" title="월별 배송 건수 입력" maxlength="7">
                  </div>
                  건
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
                    <input type="text" id="delivery_month3_cnt" name="delivery_month3_cnt" title="월별 배송 건수 입력" maxlength="7">
                  </div>
                  건
                </div>
              </div>
            </div>
          </div>
        </div>

      </div> 
        
            <div class="line"></div>
        
        </div>
        </form>
        <div class="form_btn">
            <button class="btn btn-primary btn-w100 btn-next">다음</button>
            <button class="btn btn-secondary btn-w100 btn-prev">이전</button>
        </div>
       
    </div>

<script>
    $(function() {
        $('.btn-next').on('click',function(e) {
            $('#frmEstimate').submit();
        });
        
        $('.btn-prev').on('click',function(e) {
            var estimate_seq = "<?=$estimate_seq?>";
            var current_step = "<?=$current_step?>";
            location.href = "/information/estimate_step02_info?estimate_seq="+estimate_seq+"&current_step="+current_step;
        });
        
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
    });
    
	  ;($ => {
		  $.depth1Index = 2
		  $.depth2Index = 1
		
		  $(function () {
			
		  })
	  })(window.jQuery)    
  </script>    
    <!--: End #contents -->
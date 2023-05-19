    <!--: Start #contents -->
    <div class="contents information information-detail">

        <div class="step6">
            <div class="step">
                <span class="atv ok"></span>
                <span class="atv ok"></span>
                <span class="atv ok"></span>
                <span class="atv ok"></span>
                <span class="atv"></span>
            </div>
        </div>

        <form id="frmEstimate" name="frmEstimate" method="post" action="/information/estimate_step06_insert">
            <input type="hidden" id="estimate_seq" name="estimate_seq" value="<?=$estimate_seq?>">
            <input type="hidden" id="current_step" name="current_step" value="<?=$current_step?>">
            <div class="form">
                <h2>기타사항을 입력해주세요. </h2>
                <div class="form-box">
                    <div class="pre_are">
                        <label for="pickupEtc" class="kurly-text-09">특이사항</label>
                        <textarea id="estimate_content" name="estimate_content" cols="10" rows="3" placeholder="기타 특이사항 및 문의사항을 입력해주세요."></textarea>
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
        $('.btn-next').on('click',function(e) {
            $('#frmEstimate').submit();
        });
        
        $('.btn-prev').on('click',function(e) {
            var estimate_seq = "<?=$estimate_seq?>";
            var current_step = "<?=$current_step?>";
            location.href = "/information/estimate_step05_info?estimate_seq="+estimate_seq+"&current_step="+current_step;
        });
    });
    
	  ;($ => {
		  $.depth1Index = 2
		  $.depth2Index = 1
		
		  $(function () {
			
		  })
	  })(window.jQuery)    
  </script>
    <!--: End #contents -->
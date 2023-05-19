<!--: Start #contents -->
    <div class="contents information information-detail">

        <div class="step6">
            <div class="step">
                <span class="atv"></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <form id="frmEstimate" name="frmEstimate" method="post" action="/information/estimate_step01_insert">
            <div class="form">
                <h2>기업정보를 입력해주세요.</h2>
                <div class="input-area js-input">
                    <label for="inp-txt0">사업체명</label>
                    <div class="input">
                      <input type="text" id="company_name" name="company_name" placeholder="사업자등록증에 기입된 사업체명">
                      <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                    </div>
                </div>
                <div class="input-area js-input">
                    <label for="inp-txt1">대표자</label>
                    <div class="input">
                      <input type="text" id="company_ceo" name="company_ceo" placeholder="대표자명 입력">
                      <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                    </div>
                </div>
                <div class="input-area js-input only-number">
                    <label for="inp-txt2">사업자등록번호</label>
                    <div class="input">
                      <input type="text" id="company_no" name="company_no" placeholder="‘-’를 제외한 숫자만 입력" maxlength="10">
                      <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                    </div>
                </div>
                <div class="input-area js-input">
                    <label for="inp-txt3">본사주소</label>
                    <div class="input">
                      <input type="text" id="company_address" name="company_address" placeholder="본사주소 입력">
                      <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                    </div>
                </div>
                <div class="input-area js-input">
                    <label for="inp-txt4">판매 사이트</label>
                    <div class="input">
                      <input type="text" id="company_site" name="company_site" placeholder="URL을 입력 Ex) https://kurlynextmile.com">
                      <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                    </div>
                </div>
                <div class="input-area js-input">
                    <label for="inp-txt5">대표 이메일</label>
                    <div class="input">
                      <input type="text" id="company_email" name="company_email" placeholder="본사의 대표 이메일">
                      <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                    </div>
                </div>
                <div class="input-area js-input">
                    <label for="inp-txt6">브랜드명</label>
                    <div class="input">
                      <input type="text" id="company_barnd" name="company_brand" placeholder="브랜드명">
                      <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                    </div>
                </div>
                <div class="input-area js-input only-number">
                    <label for="inp-txt7">고객센터 연락처</label>
                    <div class="input">
                      <input type="text" id="company_tel" name="company_tel" placeholder="‘-’를 제외한 숫자만 입력" maxlength="11">
                      <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
                    </div>
                </div>
            </div>
        </form>
        <div class="form_btn">
            <button class="btn btn-primary btn-w100 btn-submit">다음</button>
        </div>

    </div>

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
        $('.btn-submit').on('click',function(e) {
            var obj;

            obj = $('#company_name');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '사업체명을 입력해주세요.',
                    buttonText: '확인',
                    closeFocus: '.mypage_adit .modify'
                }, e => {
                    if (e.type === 'before-close') {
                        // modal before-close
                    } else if (e.type === 'close') {
                        obj.focus();
                    }
                });                
                return false;
            }
            
            $('#frmEstimate').submit();
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
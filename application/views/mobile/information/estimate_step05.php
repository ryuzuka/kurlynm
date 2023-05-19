    <!--: Start #contents -->
    <div class="contents information information-detail">

        <div class="step6">
            <div class="step">
                <span class="atv ok"></span>
                <span class="atv ok"></span>
                <span class="atv ok"></span>
                <span class="atv"></span>
                <span></span>
            </div>
        </div>

        <form id="frmEstimate" name="frmEstimate" method="post" action="/information/estimate_step05_insert">
            <input type="hidden" id="estimate_seq" name="estimate_seq" value="<?=$estimate_seq?>">
            <input type="hidden" id="current_step" name="current_step" value="<?=$current_step?>">
        <div class="form">
            <h2>담당자 정보를 입력해주세요. </h2>

            <div class="input-area js-input">
              <div class="input">
                <label>성함<span>*</span></label>
                <input type="text" id="manager_name" name="manager_name" placeholder="담당자 성함을 입력해주세요.">
                <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
              </div>
          </div>

          <div class="input-area js-input">
            <div class="input">
              <label>연락처<span>*</span></label>
              <input type="number" id="manager_tel" name="manager_tel" placeholder="'-' 없이 숫자만 입력해주세요.">
              <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
            </div>
        </div>

        <div class="input-area js-input">
          <div class="input">
            <label>메일 주소<span>*</span></label>
            <input type="email" id="manager_email" name="manager_email" placeholder="담당자 이메일 주소를 입력해주세요.">
            <button type="button" class="btn-clear"><span><span class="blind">입력 텍스트 삭제</span></span></button>
          </div>
       </div>

       <div class="form-box">
        <div class="pre_are">
         <label for="pickupEtc" class="kurly-text-09">개인정보 수집·이용 동의</label>
         <div class="pre_are_box">
<?php //if($privacy) { echo htmlspecialchars_decode($privacy->content); } ?>

	         <p><span style="font-size:14px">주식회사 컬리넥스트마일(이하 &#39;회사&#39;)은(는) 『개인정보보호법』 제30조에 따라 이용자의 개인정보를 보호하고 이와 관련한 고충을 신속하고 원활하게 처리할 수 있도록 하기 위하여 다음과 같이 개인정보처리방침을 수립하여 공개하고 있습니다.</span></p><br>
	         <p><span style="font-size:14px"><b style="font-weight: bold">1. 수집 및 이용 목적</b><br />
&nbsp;- 견적문의 신청 접수 및 응대</span></p>
	         <p><br />
		         <span style="font-size:14px"><b style="font-weight: bold">2. 개인정보 항목</b><br />
&nbsp;&nbsp;<strong>기업정보</strong><br />
&nbsp; &nbsp; - 사업체명<br />
&nbsp;&nbsp;&nbsp;&nbsp;- 대표자명<br />
&nbsp;&nbsp;&nbsp;&nbsp;- 사업자등록번호<br />
&nbsp;&nbsp;&nbsp;&nbsp;- 주소<br />
&nbsp;&nbsp;&nbsp;&nbsp;- 이메일 주소<br />
&nbsp;&nbsp;&nbsp;&nbsp;- 연락처<br />
<br />
&nbsp;&nbsp;<strong>담당자</strong><br />
&nbsp;&nbsp;&nbsp;&nbsp;- 성함<br />
&nbsp;&nbsp;&nbsp;&nbsp;- 연락처<br />
&nbsp;&nbsp;&nbsp;&nbsp;- 이메일주소</span></p>
	         <p><br />
		         <span style="font-size:14px"><b style="font-weight: bold">3. 보유기간</b><br />
<strong style="font-weight: bold">&nbsp;: 견적문의 응대 완료 후 30일 보관 후 즉시 파기</strong><br />
&nbsp;: 위 사항에 대하여 거부하실 수 있으나, 동의 거부 시 예상 견적 신청 접수가 제한됩니다.더 자세한 내용에 대해서는&nbsp;<a href="https://www.kurlynextmile.com/main/privacy" target="_blank" style="font-weight: bold; text-decoration-line: underline; color: #5e0080">[개인(위치)정보 처리방침]</a>을 참고하시기 바랍니다.</span></p>

         </div>
         <div class="pre_agree">
           <span>
             개인정보 수집 및 이용에 대해 동의를 거부하실 수 있으나<br>
         거부하시는 경우 견적 문의가 불가합니다.
           </span>
           <div class="pre_agree_are">
             <div class="input_are">
             <input type="checkbox" id="pre_agree" name="pre_agree"><label for="pre_agree"></label>
             </div>
             <p>동의합니다.</p>
           </div>
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
        $('.btn-next').on('click',function(e) {
            var obj;

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

            $('#frmEstimate').submit();
        });

        $('.btn-prev').on('click',function(e) {
            var estimate_seq = "<?=$estimate_seq?>";
            var current_step = "<?=$current_step?>";
            location.href = "/information/estimate_step04_info?estimate_seq="+estimate_seq+"&current_step="+current_step;
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

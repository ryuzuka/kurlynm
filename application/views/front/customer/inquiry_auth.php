<style>
.personal_inquiry .box .file .file_info {
    margin-right: 12px;
}    
.personal_inquiry .box .file .btn_are::after {
    background: none;
}
.personal_inquiry .box .file .file_info span {
    padding: 16px 50px 10px 20px;
    border-radius: 8px;
    margin-right: 0;
}
.tab-list2 {
    display: flex;
}
.tab-list2 button[aria-selected="true"] {
    border-color: #5f0080;
    color: #5f0080;
}

.tab-list2 button {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    padding: 45px;
    border-bottom: 6px solid #e7e7e7;
    font-size: 32px;
    font-weight: bold;
    color: #d3d3d3;
}
</style>

<!-- s : contents -->
    <div class="contents">
      <div class="visual customer">
        <h2>1:1 문의</h2>
        <p class="text">친절하고 신속하게 답변드리겠습니다.</p>
      </div>

      <div class="customer_section inner">

        <div class="tab js-tab">
            <div class="tab-list2" role="tablist">
              <button type="button" id="tab1" role="tab" aria-controls="tab-content1" aria-selected="false" onclick="location.href='inquiry_write';">문의하기</button>
              <button type="button" id="tab2" role="tab" aria-controls="tab-content2" aria-selected="true" class="active">나의 문의내역</button>
            </div>
            
            <div class="tab-content">
              <div id="tab-content2" class="content" role="tabpanel" aria-labelledby="tab2" tabindex="0">
                  <form id="frm" name="frm" method="post" action="/customer/inquiry_auth">
                    <div class="personal_inquiry">
                        <div class="box">
                            <h3>1:1문의 접수 시 등록하신 이메일/비밀번호를 입력해주세요.</h3>
                            <ul>
                                <li>
                                    <label>이메일</label>
                                    <input type="text" id="question_email" name="question_email" placeholder="">
                                </li>
                                <li>
                                    <label>비밀번호</label>
                                    <input type="password" id="question_passwd" name="question_passwd" placeholder="">
                                </li>
                            </ul>
                            <div class="notice">
                                <i></i>이메일 및 비밀번호를 분실하셨을 경우 고객센터로 문의해주세요. (고객센터 : 1833-3165)
                            </div>
                        </div>
                        <div class="btn-wrap">
                            <button type="button" class="btn btn-primary btn-inquiry">조회하기</button>
                       </div>                  
                      </div>
                  </form>
              </div>
                
            </div>
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
    $(document).ready(function () {
        $(document).on('click', '.btn-inquiry', function() {
            var obj;

            obj = $('#question_email');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '이메일 주소를 입력해주세요.',
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
            
            obj = $('#question_passwd');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '비밀번호를를 입력해주세요.',
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
            
            $('#frm').submit();
        });
    });
    
	  ;($ => {
		  $.depth1Index = 4
		  $.depth2Index = 2

	  })(window.jQuery)
  </script>    
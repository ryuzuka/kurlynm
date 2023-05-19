    <div class="visual mypage">
        <div class="text">
            <h2>회원정보수정</h2>
        <p class="text">고객님의 회원정보를 관리해보세요.</p>
        </div>
    </div>

    <!-- s : contents -->


      <div class="mypage_adit">
        <h2>기본정보</h2>
        <form id="frmEstimate" name="frmEstimate" method="post" action="/member/member_update">
            <input type="hidden" id="member_id" name="member_id" value="<?=$member->member_id?>">
            <input type="hidden" id="member_type" name="member_type" value="<?=$member->member_type?>">
            <div class="box">
                <ul>
                    <li>
                        <p class="title">이메일<span>*</span></p>
                        <input type="text" id="member_email" name="member_email" value="<?=$member->dec_email?>">
                    </li>
                    <li>
                        <p class="title">이름<span>*</span></p>
                        <input type="text" id="member_name" name="member_name" value="<?=$member->member_name?>" maxlength="8">
                    </li>
                    <li>
                        <p class="title">연락처<span>*</span></p>
                        <input type="text" id="member_tel" name="member_tel" value="<?=$member->dec_tel?>" onlyNumber maxlength="11">
                    </li>
                </ul>
            </div>
        </form>



        <div class="btn-wrap">
          <a href="#" class="btn btn-primary modify" aria-controls="pop-modify-complete">회원정보 수정</a>
        </div>

        <div class="member_delete">
          <a href="#none" class="withdrawal" aria-controls="pop-withdrawal">회원탈퇴</a>
        </div>

        <div id="pop-alert" class="layer" role="dialog" aria-modal="true">
            <div class="layer-wrap">
                <div class="layer-content"></div>
                <div class="button-wrap">
                    <button class="btn"></button>
                </div>
            </div>
        </div>
        
        <div id="pop-secession-complete" class="layer" role="dialog" aria-modal="true">
            <div class="layer-wrap">
              <div class="layer-content">
                <p>회원 탈퇴가 완료되었습니다.</p>
              </div>
              <div class="button-wrap">
                <button class="btn">확인</button>
              </div>
            </div>
        </div>        

        <div id="pop-withdrawal" class="layer" role="dialog" aria-modal="true">
            <div class="layer-wrap">
              <div class="layer-content">
                    <button class="close">
                    </button>
                <div class="title">
                    회원탈퇴
                </div>
                <div class="text">
                    <p>탈퇴 사유를 알려주세요</p>
                    <textarea id="secession_content" name="secession_content"></textarea>
                </div>
                <div class="seeyou">
                    <h3>그동안 이용해주셔서 감사합니다.</h3>
                    <p>고객님의 의견을 반영하여 더 나은 서비스를 제공하는 <br>
                        컬리넥스트마일이 되겠습니다.</p>
                    <p>회원 탈퇴 후 <?=$privates->join_day?>일간 재가입이 불가능합니다.</p>
                </div>
              </div>
              <div class="button-wrap">
                <button class="btn secession">회원탈퇴</button>
              </div>
            </div>
        </div>


    </div>
    <!-- e : contents -->
    
  <script>
        $(function () {
            /** 회원 수정 */
            $('.mypage_adit').on('click', '.modify', e => {
                e.preventDefault();

                var obj;
                
                obj = $('#member_email');
                if (obj.val() == "") {
                    if (!getEmailCheck(obj.val())) {
                        $('#pop-alert').modal({
                            text: '이메일을 입력해주세요.',
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
                }
                
                obj = $('#member_email');
                if (obj.val() != "") {
                    if (!getEmailCheck(obj.val())) {
                        $('#pop-alert').modal({
                            text: '이메일 형식에 맞지 않습니다.',
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
                }
                
                obj = $('#member_name');
                if (obj.val() == "") {
                    if (!getEmailCheck(obj.val())) {
                        $('#pop-alert').modal({
                            text: '이름을 입력해주세요.',
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
                }
                
                obj = $('#member_tel');
                if (obj.val() == "") {
                    if (!getEmailCheck(obj.val())) {
                        $('#pop-alert').modal({
                            text: '연락처를 입력해주세요.',
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
                }
                
                $.ajax({
                    url: '/member/update', // 요청 할 주소
                    async: true, // false 일 경우 동기 요청으로 변경
                    type: 'POST', // GET, PUT
                    data: {
                        member_type: '<?=$member->member_type?>',
                        member_id: '<?=$member->member_id?>',
                        member_email: $("#member_email").val(),
                        member_name: $("#member_name").val(),
                        member_tel: $("#member_tel").val(),
                    }, // 전송할 데이터
                    success: function(jqXHR) {}, // 요청 완료 시
                    error: function(jqXHR) {}, // 요청 실패.
                    complete: function(jqXHR) {
                        $('#pop-alert').modal({
                            text: '회원정보 수정이 완료되었습니다.',
                            buttonText: '확인',
                            closeFocus: '.mypage_adit .modify'
                        }, e => {
                            if (e.type === 'before-close') {
                                // modal before-close
                            } else if (e.type === 'close') {
                                location.href = '/member/info';
                            }
                        });
                    } // 요청의 실패, 성공과 상관 없이 완료 될 경우 호출
                });
            });
            
            /** 회원 탈퇴 */
            $('.mypage_adit').on('click', '.secession', e => {
                e.preventDefault();

                $.ajax({
                    url: '/member/secession', // 요청 할 주소
                    async: true, // false 일 경우 동기 요청으로 변경
                    type: 'POST', // GET, PUT
                    data: {
                        member_type: '<?=$member->member_type?>',
                        member_id: '<?=$member->member_id?>',
                        secession_content: $("#secession_content").val(),
                    }, // 전송할 데이터
                    success: function(jqXHR) {}, // 요청 완료 시
                    error: function(jqXHR) {}, // 요청 실패.
                    complete: function(jqXHR) {
                        $('#pop-secession-complete').modal({closedFocus: '.mypage_adit .modify'}, e => {
                            if (e.type === 'close') {
                                location.href = '/';
                            }
                        });
                    } // 요청의 실패, 성공과 상관 없이 완료 될 경우 호출
                });                
            });            
        });
        
	  ;($ => {
        $.depth1Index = -1
        $.depth2Index = -1

        /** 회원 탈퇴 */
        $('.mypage_adit').on('click', '.withdrawal', e => {
                  e.preventDefault()
            $('#pop-withdrawal').modal({closedFocus: '.mypage_adit .withdrawal'}, e => {
                if (e.type === 'close') {
                    console.log(e)
                }
            })
        })
    })(window.jQuery);
    
    
    //이메일 정규표현식 체크
    function getEmailCheck(email) {
        var result = false;

        var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
        // 검증에 사용할 정규식 변수 regExp에 저장

        if (email.match(regExp) != null) {
            result = true;
        } else {
            result = false;
        }

        return result;
    }        
</script>    
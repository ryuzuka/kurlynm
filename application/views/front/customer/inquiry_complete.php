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
</style>

<!-- s : contents -->
    <div class="contents">
      <div class="visual customer">
        <h2>1:1 문의</h2>
        <p class="text">친절하고 신속하게 답변드리겠습니다.</p>
      </div>

      <div class="customer_section inner">

        <div class="tab js-tab">
            <div class="tab-list" role="tablist">
              <button type="button" id="tab1" role="tab" aria-controls="tab-content1" aria-selected="false">문의하기</button>
              <button type="button" id="tab2" role="tab" aria-controls="tab-content2" aria-selected="false" onclick="location.href='inquiry_auth';">나의 문의내역</button>
            </div>
            
            <div class="tab-content">
                
              <div id="tab-content1" class="content" role="tabpanel" aria-labelledby="tab1" tabindex="0" hidden>
                  <form id="frm" name="frm" method="post" action="/customer/inquiry_insert" enctype="multipart/form-data">
                    <div class="personal_inquiry">
                        <h2>
                            기본정보
                            <span>*메일주소 및 비밀번호는 문의내역 조회시 이용됩니다.</span>
                        </h2>
                        <div class="box">
                            <ul>
                                <li>
                                    <label>성함<span>*</span></label>
                                    <input type="text" id="question_name" name="question_name" placeholder="고객님의 성함을 입력해주세요.">
                                </li>
                                <li>
                                    <label>메일주소<span>*</span></label>
                                    <input type="text" id="question_email" name="question_email" placeholder="메일주소를 입력해주세요.">
                                </li>
                                <li>
                                    <label>연락처<span>*</span></label>
                                    <input type="number" id="question_tel" name="question_tel" placeholder="‘-’를 제외한 숫자만 입력해주세요.">
                                </li>
                                <li>
                                    <label>비밀번호<span>*</span></label>
                                    <input type="password" id="question_passwd" name="question_passwd" maxlength="20" placeholder="숫자/영문 포함 8~20자리 이상">
                                </li>
                            </ul>
                        </div>
                        <h2>
                            문의내용
                        </h2>
                        <div class="box">
                            <ul>
                                <li class="w100">
                                    <label>제목<span>*</span></label>
                                    <input type="text" id="question_title" name="question_title" placeholder="">
                                </li>
                                <li class="w100">
                                    <label>내용<span>*</span></label>
                                   <textarea id="question_content" name="question_content" placeholder="내용을 입력해주세요."></textarea>
                                </li>
                                <li class="w100">
                                    <label>파일첨부</label>
                                    <div class="file">
                                        <div class="btn_are">
                                            <input type="file" id="file1" name="file1" onchange="loadFile(this, 1);" hidden>
                                            <input type="file" id="file2" name="file2" onchange="loadFile(this, 2);" hidden>
                                            <input type="file" id="file3" name="file3" onchange="loadFile(this, 3);" hidden>
                                            <div class="file_info file_info_1">
                                                <label class="btn btn-secondary btn_file_1" for="file1">파일첨부</label>
                                                <span class='sel_file sel_file_1' data-idx="1" hidden></span>
                                            </div>
                                            <div class="file_info file_info_2">
                                                <label class="btn btn-secondary btn_file_2" for="file2">파일첨부</label>
                                                <span class='sel_file sel_file_2' data-idx="2" hidden></span>
                                            </div>
                                            <div class="file_info file_info_3">
                                                <label class="btn btn-secondary btn_file_3" for="file3">파일첨부</label>
                                                <span class='sel_file sel_file_3' data-idx="3" hidden></span>
                                            </div>
                                            <p>*JPG, PNG, GIF 형식의 파일만 첨부 가능합니다.<br>
                                                *최대 3개까지 첨부 가능합니다.</p>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>

                        <h2>개인정보 수집·이용 동의</h2>
            <div class="textarea-type js-textarea">
              <textarea id="txt-field2" name="txt-field" cols="30" rows="10" readonly>- 이용자가 제공한 모든 정보는 다음의 목적을 위해 활용하며, 하기 목적 이외의 용도로는 사용되지 않습니다.
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
                              <button type="button" class="btn btn-primary btn-submit w100">문의하기</button>
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
        $('#pop-alert').modal({
            text: '문의가 정상적으로 접수되었습니다.<br>빠른 시일 내에 답변 드리겠습니다.',
            buttonText: '확인',
            closedFocus: '.mypage_adit .modify'
        }, e => {
            if (e.type === 'before-close') {
                // modal before-close
            } else if (e.type === 'close') {
                location.href = "/customer/inquiry_auth";
            }
        });

        $(document).on('click', '.btn-submit', function() {
            var obj;

            obj = $('#question_name');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '성함을 입력해주세요.',
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
            
            obj = $('#question_tel');
            if (obj.val() == "") {
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

            var pw = $('#question_passwd').val();
            var num = pw.search(/[0-9]/g);
            var eng = pw.search(/[a-z]/ig);
            var spa = checkSpace(pw);

            if (pw.length < 8 || pw.length > 20) {
                $('#pop-alert').modal({
                    text: '비밀번호는 8자리 ~ 20자리로 입력해주세요.',
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

            if (num < 0 || eng < 0) {
                $('#pop-alert').modal({
                    text: '비밀번호는 영문, 숫자를 혼합하여 입력해주세요.',
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

            if (spa) {
                $('#pop-alert').modal({
                    text: '비밀번호는 공백없이 입력해주세요.',
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

            obj = $('#question_title');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '제목을 입력해주세요.',
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
            
            obj = $('#question_content');
            if (obj.val() == "") {
                $('#pop-alert').modal({
                    text: '내용을 입력해주세요.',
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
            
            $('#frm').submit();
        });
        
        $(document).on('click', '.sel_file', function() {
            var idx = $(this).attr("data-idx");
            console.log(idx);
            $("#file"+idx).val("");
            $(".btn_file_"+idx).show();
            $(".sel_file_"+idx).hide();
        });
        
        function checkSpace(str) {
            if (str.search(/\s/) != -1) {
                return true;
            } else {
                return false;
            }
        }
        
        $(document).on('click', '.btn-search2', function() {
            var obj;

            obj = $('#search_email');
            if (obj.val() == "") {
                alert("이메일을 입력해주세요.");
                obj.focus();
                return false;
            }
            
            $('#frm').submit();
        });
    });
    
    function loadFile(input, idx) {
        var file = input.files[0];	//선택된 파일 가져오기

        //미리 만들어 놓은 div에 text(파일 이름) 추가
        //var name = document.getElementById('fileName');
        //name.textContent = file.name;

        $(".btn_file_"+idx).hide();
        $(".sel_file_"+idx).show();
        $(".sel_file_"+idx).html(file.name);
        
        /*
        //새로운 이미지 div 추가
        var newImage = document.createElement("img");
        newImage.setAttribute("class", 'img');

        //이미지 source 가져오기
        newImage.src = URL.createObjectURL(file);   

        newImage.style.width = "70%";
        newImage.style.height = "70%";
        newImage.style.visibility = "hidden";   //버튼을 누르기 전까지는 이미지를 숨긴다
        newImage.style.objectFit = "contain";
        */
    };

	  ;($ => {
		  $.depth1Index = 4
		  $.depth2Index = 2

	  })(window.jQuery)
  </script>    
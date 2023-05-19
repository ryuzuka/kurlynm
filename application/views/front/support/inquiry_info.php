    <script>
      jQuery(document).ready(function($) {

        $('#btn_add_file').click(function() {
          $('#question_file').change(function() {
            var filename = $('#question_file').val();
            var dd = filename.split("\\");
            filename = dd[dd.length-1];

            console.log(filename);
            $('#add_url').val(filename);
          });
        });

        $('#btn-submit').click(function () {
            var obj;

            obj = $('#question_title');
            if (obj.val() == "") {
                alert("제목을 입력해주세요.");
                setFocus(obj);
                return false;
            }

            var yn = confirm("수정하시겠습니까?");
            if (yn) {
                $('#frm').submit();
            } else {
                return false;
            }
        });
      });    
    </script>

<!-- SUB CONT -->
      <div class="sub-cont-wrap">
        
        <div class="sub-kv">
          <img class="responsive-image" src="/images/sub/sub_kv_05_2_1920.jpg"
            data-media-pc="/images/sub/sub_kv_05_2_1920.jpg" 
            data-media-mobile="/images/sub/sub_kv_05_2_768.jpg" alt="">
          <dl>
            <dt>1:1 문의</dt>
            <dd>대학생 아시아 대장정 프론티어를 위한 공간 입니다</dd>
          </dl>
        </div>

        <div class="sub-cont">
          <div class="breadcrumb">
            <a class="section">
              <img src="/images/sub/icon_home.png" alt="">
            </a>
            <div class="divider"> \ </div>
            <a class="section">지원센터</a>
            <div class="divider"> \ </div>
            <div class="active section">1:1 문의</div>
          </div>

          <div class="sub-menu">
            <a href="/support/notice"><span>공지사항</span></a>
            <a href="/support/inquiry" class="active"><span>1:1 문의</span></a>
          </div>


          <div class="cont-area inquiry_2">
              <form id="frm" name="frm" method="post" action="/support/inquiry_info" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                  <input type="hidden" id="seq" name="seq" value="<?=$inquiry->seq?>">
                    <div class="cont-top">
                      <ul class="ul-table">
                        <li>
                          <dl>
                            <dt><label for="">문의 유형</label></dt>
                            <dd>
                              <select id="question_cd" name="question_cd" class="sel">
                                    <?php
                                        if ($inquiryCodeList) {
                                            foreach($inquiryCodeList as $i => $list){
                                    ?>
                                    <option value="<?=$list->code?>" <?php if($inquiry->question_cd == $list->code) { echo "selected"; }?>><?=$list->code_name?></option>
                                    <?php
                                            }
                                        }
                                    ?>
                              </select>
                            </dd>
                          </dl>
                        </li>
                        <li>
                          <dl>
                            <dt><label for="">제목</label></dt>
                            <dd><input type="text" id="question_title" name="question_title" value="<?=$inquiry->question_title?>"></dd>
                          </dl>
                        </li>
                        <li>
                          <dl>
                            <dt><label for="">첨부파일</label></dt>
                            <dd>
                              <div class="add-file-box">
                                <input type="file" id="question_file" name="question_file">
                                <input type="text" id="add_url" value="<?php if($inquiry->file_name) { echo $inquiry->file_name; } else { echo "첨부파일 없음"; }?>" readonly>
                                <label for="question_file" id="btn_add_file" class="btn dark">파일첨부</label>
                              </div>
                            </dd>
                          </dl>
                        </li>
                        <li>
                          <dl>
                            <dt><label for="">내용</label></dt>
                            <dd><textarea id="question_content" name="question_content"><?=$inquiry->question_content?></textarea></dd>
                          </dl>
                        </li>
                      </ul>

                      <a id="btn-submit" class="btn blue">확인</a>
                      <a href="/support/inquiry?<?=$params?>" class="btn">취소</a>
                    </div>
            
              </form>
          </div>
        </div>

      </div>
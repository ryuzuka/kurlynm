    <script>
      jQuery(document).ready(function($) {

        $(".tabcont dl dt").on("click", function(){
          if($(this).hasClass("on")) {
            $(this).removeClass("on");
            $(this).next("dd").slideUp();
          } else {
            $(".tabcont dl dt").removeClass("on");
            $(".tabcont dl dd").slideUp();
            $(this).addClass("on");
            $(this).next("dd").slideDown();
          }
        });
      });
    </script>

<!-- SUB CONT -->
       <div class="sub-cont-wrap">

         <div class="sub-kv">
           <img class="responsive-image" src="/images/sub/sub_kv_05_3_1920.jpg"
             data-media-pc="/images/sub/sub_kv_05_3_1920.jpg" 
             data-media-mobile="/images/sub/sub_kv_05_3_768.jpg" alt="">
           <dl>
             <dt>FAQ</dt>
             <dd>대학생 아시아 대장정에 대해 궁금한 모든 사항을 알려드립니다.</dd>
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
             <div class="active section">FAQ</div>
           </div>

           <div class="sub-menu">
            <a href="/support/notice"><span>공지사항</span></a>
            <a href="/support/inquiry"><span>1:1 문의</span></a>
            <a href="/support/faq" class="active"><span>FAQ</span></a>
           </div>



           <div class="cont-area faq">
              <div class="cont-top">
                <p class="tit">자주 묻는 질문들을 모아 놓은 공간 입니다.<br class="pc-ver">
                  문의 하시기 전에 이곳에서 먼저 확인해 주시기 바랍니다.</p>
                <div class="tabmenu">
                  <a class="<?php if($faq_cd == "01") echo "active"; ?>" href="/support/faq?faq_cd=01">
                    <span class="icon-tabmenu join"></span>
                    <p>회원가입</p>
                  </a>
                  <a class="<?php if($faq_cd == "02") echo "active"; ?>" href="/support/faq?faq_cd=02">
                    <span class="icon-tabmenu particip"></span>
                    <p>참가신청</p>
                  </a>
                  <a class="<?php if($faq_cd == "03") echo "active"; ?>" href="/support/faq?faq_cd=03">
                    <span class="icon-tabmenu summary"></span>
                    <p>진행 및 일정</p>
                  </a>
                </div>
              </div>

              <div class="cont-bottom">
                <div class="table-top">
                    <form name="searchForm" method="get">
                        <input type="hidden" id="faq_cd" name="faq_cd" value="<?=$faq_cd?>">
                        <div class="table-filter">
                              <select id="s_field" name="s_field" class="sel">
                                  <option value="question_title"<?php if($s_field == "question_title") echo " selected"; ?>>제목</option>
                                  <option value="answer_content"<?php if($s_field == "answer_content") echo " selected"; ?>>내용</option>
                              </select>
                          <label>
                            <input type="text" id="s_string" name="s_string" value="<?=$s_string ? $s_string : ""?>">
                          </label>
                        </div>
                    </form>
                </div>

                <div class="tabcont">
                  <dl>
                    <?php
                        if ($faqList) {
                            foreach($faqList as $i => $list){
                    ?>                      
                        <dt><?=$list->question_title?></dt>
                        <dd><?=$list->answer_content?></dd>
                    <?php
                            }
                        } else {
                    ?>
                        <div class="no-result-box">
                            <p>검색어와 일치하는 내용이 없습니다.</p>
                        </div>                    
                    <?php
                        }
                    ?>
                  </dl>
                </div>
              </div>

            </div>
          </div>

        </div>
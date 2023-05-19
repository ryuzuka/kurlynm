    <script>
      jQuery(document).ready(function($) {
        $('#btn-delete').click(function () {
            var yn = confirm("삭제된 문의는 복구할 수 없습니다.\n삭제하시겠습니까?");
            if (yn) {
                location.href = "/support/inquiry_delete?seq=<?=$inquiry->seq?>";
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
            <dd>주식 마스터에 대해 궁금한 모든 사항을 알려드립니다.</dd>
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



          <div class="cont-area inquiry_4">
            <div class="cont-top">
              <ul class="ul-table-view">
                <li class="tit-row">
                  <p class="cate"><?=$inquiry->question_name?></p>
                  <p class="tit"><?=$inquiry->question_title?></p>
                  <p class="desc">
                    <span><?=$inquiry->member_id?></span>
                    <span><?=date('Y-m-d', strtotime($inquiry->regist_date))?></span>
                  </p>
                </li>
                <li class="cont-row">
                  <div class="cont-txt" style="padding-bottom: 60px;">
                    <?=$inquiry->question_content?>                    
                  </div>
                    <?php if($inquiry->file_name) {?>
                    <pre>
                        첨부파일 : <a href="<?=$inquiry->file_path?>/<?=$inquiry->file_name?>" target="_blank"><?=$inquiry->file_name?></a>
                    </pre>
                    <?php } ?>
                  <?php if(!$inquiry->answer_content) {?>
                  <a href="/support/inquiry_info?seq=<?=$inquiry->seq?>" class="btn">수정</a>
                  <?php } ?>
                  <a href="#none" id="btn-delete" class="btn red">삭제</a>
                </li>
              </ul>
              <?php if($inquiry->answer_content) {?>
              <div class="reply-box">
                <div class="r-box-info">
                  <span class="icon-inquiry done">답변완료</span>
                  <span class="r-box-date"><?=date('Y-m-d', strtotime($inquiry->answer_date))?></span>
                </div>
                <div class="r-box-text">
                  <span><?=$inquiry->answer_content?></span>
                </div>
              </div>
              <?php } ?>

              <a href="/support/inquiry" class="btn btn-list">목록</a>
            </div>

            <div class="cont-bottom">
              <ul class="ul-table-view-list">
                <li>
                  <a href="#none">
                    <dl>
                      <dt class="view-prev">이전글</dt>
                      <dd>[2018 대학생 아시아 대장정] 최종 선발자 안내 <span class="date">2018-06-25</span></dd>
                    </dl>
                  </a>
                </li>
                <li>
                  <a href="#none">
                    <dl>
                      <dt class="view-next">다음글</dt>
                      <dd class="no-more">다음글이 없습니다.</dd>
                    </dl>
                  </a>
                </li>
              </ul>
            </div>
            
            
          </div>
        </div>

      </div>
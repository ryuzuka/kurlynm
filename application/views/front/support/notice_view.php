      <!-- SUB CONT -->
      <div class="sub-cont-wrap">

        <div class="sub-kv">
          <img class="responsive-image" src="/images/sub/sub_kv_05_1_1920.jpg"
            data-media-pc="/images/sub/sub_kv_05_1_1920.jpg" 
            data-media-mobile="/images/sub/sub_kv_05_1_768.jpg"
            alt="">
          <dl>
            <dt>공지사항</dt>
            <dd>주식마스터에서 새로운 소식을 알려드립니다.</dd>
          </dl>
        </div>

        <div class="sub-cont">
          <div class="breadcrumb">
            <a class="section">
              <img src="/images/sub/icon_home.png" alt="">
            </a>
            <div class="divider"> \ </div>
            <a class="section">주식마스터</a>
            <div class="divider"> \ </div>
            <div class="active section">공지사항</div>
          </div>

          <div class="sub-menu">
            <a href="/support/notice" class="active"><span>공지사항</span></a>
            <a href="/support/inquiry"><span>1:1 문의</span></a>
          </div>


          <div class="cont-area notice_2">
            <div class="cont-top">
              <ul class="ul-table-view">
                <li class="tit-row">
                  <p class="tit"><?=$notice->title?></p>
                  <p class="desc">
                    <span>관리자</span>
                    <span><?=date('Y-m-d', strtotime($notice->regist_date))?></span>
                  </p>
                </li>
                <?php
                if ($notice->file_name) {
                ?>
                <li>
                    <dl>
                        <dt>첨부파일</dt>
                        <dd>
                            <span class="down-file-url"><?=$notice->file_name?></span>
                            <a href="<?=$notice->file_path?>/<?=$notice->file_name?>" target="_blank" class="btn dark">다운로드</a>
                        </dd>
                    </dl>
                </li>
                <?php
                }
                ?>
                <li class="cont-row">
                  <div class="cont-txt">
                    <?=$notice->content?>
                  </div>
                </li>
              </ul>
              <a href="/support/notice?<?=$params?>" class="btn btn-list">목록</a>
            </div>

            <div class="cont-bottom">
              <ul class="ul-table-view-list">
                <li>
                  <a href="<?php if($noticePrev) { ?>/support/notice_view?seq=<?=$noticePrev->seq?>&<?=$params?><?php } ?>">
                    <dl>
                      <dt class="view-prev">이전글</dt>
                      <?php if($noticePrev) { ?><dd><?=$noticePrev->title?> <span class="date"><?=date('Y-m-d', strtotime($noticePrev->regist_date))?></span></dd> <?php } else { ?> <dd class="no-more">다음글이 없습니다.</dd> <?php } ?>
                    </dl>
                  </a>
                </li>
                <li>
                  <a href="<?php if($noticeNext) { ?>/support/notice_view?seq=<?=$noticeNext->seq?>&<?=$params?><?php } ?>">
                    <dl>
                      <dt class="view-next">다음글</dt>
                      <?php if($noticeNext) { ?><dd><?=$noticeNext->title?> <span class="date"><?=date('Y-m-d', strtotime($noticeNext->regist_date))?></span></dd> <?php } else { ?> <dd class="no-more">다음글이 없습니다.</dd> <?php } ?>
                    </dl>
                  </a>
                </li>
              </ul>
            </div>
            
            
          </div>
        </div>

      </div>
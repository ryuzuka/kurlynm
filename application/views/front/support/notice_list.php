<script>

</script>


      <!-- SUB CONT -->
      <div class="sub-cont-wrap">

        <div class="sub-kv">
          <img class="responsive-image" src="/images/sub/sub_kv_05_1_1920.jpg"
            data-media-pc="/images/sub/sub_kv_05_1_1920.jpg" 
            data-media-mobile="/images/sub/sub_kv_05_1_768.jpg" alt="">
          
        </div>

        <div class="sub-cont">
          <div class="breadcrumb">
            <a class="section">
              <img src="/images/sub/icon_home.png" alt="">
            </a>
            <div class="divider"> \ </div>
            <a class="section">지원센터</a>
            <div class="divider"> \ </div>
            <div class="active section">공지사항</div>
          </div>

          <div class="sub-menu">
            <a href="/support/notice" class="active"><span>공지사항</span></a>
            <a href="/support/inquiry"><span>1:1 문의</span></a>
          </div>


          <div class="cont-area notice_1">
            <div class="cont-top">
              <p class="tit">주식마스터에서 알려드리는 공지사항입니다.</p>
            </div>
            <div class="cont-bottom">
              <div class="table-top">
                <div class="table-total"><?php if($s_string) { ?><strong>'<?=$s_string?>'</strong> 검색결과 <?php } ?>  총 <span><?=$total_count?></span>건</div>
                    <form name="searchForm" method="get">
                    <input type="hidden" id="page" name="page" value="">
                    <div class="table-filter">
                      <select id="s_field" name="s_field" class="sel">
                        <option value="title"<?php if($s_field == "title") echo " selected"; ?>>제목</option>
                      </select>
                      <label>
                        <input type="text" id="s_string" name="s_string" value="<?=$s_string ? $s_string : ""?>">
                      </label>
                    </div>
                    </form>
              </div>

              <table class="table-05">
                <tbody>
                    <?php
                        if ($noticeList) {
                            foreach($noticeList as $i => $list){
                                $no = $total_count - ($page_rows * ($page - 1)) - $i;
                    ?>                    
                  <tr>
                    <td class="number"><?=$no?></td>
                    <td>
                      <ul>
                        <li class="title">
                            <a href="/support/notice_view?seq=<?=$list->seq?>&<?=$params?>"><?=$list->title?></a>                          
                        </li>
                        <li class="date"><?=date('Y-m-d', strtotime($list->regist_date))?></li>
                      </ul>
                    </td>
                  </tr>
                    <?php
                            }
                        } else {
                    ?>
                  <tr>
                    <td>
                      <div class="no-result-box">
                        <p>검색어와 일치하는 내용이 없습니다.</p>
                      </div>
                    </td>
                  </tr>
                  <?php
                        }
                  ?>
                </tbody>
              </table>

              <div class="table-bottom">
                <div class="table-pagination">
                  <?=$pagination?>
                </div>
              </div>

            </div>

          </div>
        </div>

      </div>
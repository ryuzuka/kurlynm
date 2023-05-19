    <!-- s : contents -->
    <div class="contents">
      <div class="visual customer">
        <h2>공지사항</h2>
        <p class="text">이슈 및 공지사항을 확인해보세요.</p>
      </div>

    <?php
        if ($noticeList) {
    ?>
      <div class="customer_section inner">
        <div class="personal_inquiry">
            <div class="tblnew-box">
                <table class="tblnew-list">
                  <caption><span class="blind">공시정보</span></caption>
                  <colgroup>
                    <col style="width:8%;">
                    <col style="width:60%;">
                    <col style="width:16%;">
                    <col style="width:16%;">
                  </colgroup>
                  <thead>
                  <tr>
                    <th scope="col">번호</th>
                    <th scope="col">제목</th>
                    <th scope="col">등록일</th>
                    <th scope="col">조회수</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach($noticeList as $i => $list) {
                            $no = $total_count - ($page_rows * ($page - 1)) - $i;
                    ?>
                    <tr>
                        <td class="">
                            <?php if($list->status == "Y") { echo "<span class='note'>중요</span>"; } else { echo $no; } ?>
                        </td>
                        <td class=""><a href="notice_info?seq=<?=$list->seq?>&<?=$params?>" style="border: 0;"><?=$list->title?></a></td>
                        <td>
                            <?=date('Y-m-d', strtotime($list->regist_date))?>
                        </td>
                        <td class="">
                          <?=$list->view_count?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                  </tbody>
                </table>
              </div>

            <div class="paging js-paging">
                <?=$pagination?>
            </div>

      </div>

    </div>
    <?php } else { ?>
       <div class="inner-section">
        <div class="nodata nomargin">
            <img src="/pc/image/mypage/nodata.png">
            <h2>등록된 공지사항이 없습니다.</h2>

            <div class="btn-wrap">
                <a href="/" class="btn btn-primary">메인으로</a>
            </div>
        </div>
      </div>      
    <?php } ?>
    <!-- e : contents -->
    
  <script>
	  ;($ => {
      $.depth1Index = 4
      $.depth2Index = 3

	  })(window.jQuery)
  </script>    
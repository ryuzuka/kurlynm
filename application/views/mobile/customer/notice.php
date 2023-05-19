    <div class="visual customer">
      <div class="text">
          <h2>공지사항</h2>
          <p>이슈 및 공지사항을 확인해보세요.</p>
      </div>
  </div>

    <?php
        if ($noticeList) {
    ?>
    <!-- s : contents -->
    <div class="">
      <div class="customer_section inner">
        <div class="personal_inquiry">
          <div class="inquiry_list">
            <ul>
            <?php
                foreach($noticeList as $i => $list) {
                    $no = $total_count - ($page_rows * ($page - 1)) - $i;
            ?>                        
              <li>
                <h2><a href="notice_info?seq=<?=$list->seq?>&<?=$params?>" style="border: 0;"><?=$list->title?></a></h2>
                <p><?=date('Y-m-d', strtotime($list->regist_date))?></p>
                <?php if($list->status == "Y") { echo "<div class='state'>중요</div>"; } ?>
              </li>
                <?php } ?>
            </ul>

          </div>

          <div class="paging js-paging">
            <?=$pagination?>
        </div>
      </div>
    </div>
    <?php } else { ?>
    <div class="">
      <div class="customer_section inner">
        <div class="personal_inquiry">
            <div class="nodata nomargin">
                <img src="/pc/image/mypage/nodata.png">
                <h2>등록된 공지사항이 없습니다. </h2>

                <div class="btn-wrap">
                    <a href="/" class="btn btn-primary w100">메인으로</a>
                </div>
            </div>
        </div>
      </div>
    </div>    
    <?php } ?>
    <!-- e : contents -->

  <script>
	  ;($ => {
		  $.depth1Index = 4
		  $.depth2Index = 3
		
		  $(function () {
		  })
	  })(window.jQuery)
  </script>
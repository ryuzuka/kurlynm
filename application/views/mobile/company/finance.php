    <div class="visual company">
        <div class="text">
            <h2>공시정보</h2>
            <p>컬리넥스트마일의 재무정보를 투명하게 공개합니다.</p>
        </div>
    </div>

<?php if ($financeList) { ?>
    <!--: Start #contents -->
    <div class="contents location">
        <div class="tblnew-box">
            <table class="tblnew-list">
              <caption><span class="blind">공시정보</span></caption>
              <colgroup>
                <col style="width:85%;">
                <col style="width:15%;">
              </colgroup>
              <tbody>
                <?php
                if ($financeList) {
                    foreach($financeList as $i => $list) {
                        $no = $total_count - ($page_rows * ($page - 1)) - $i;
                ?>
                <tr>
                  <td><?=$list->title?></td>
                  <td>
                    <?php if($list->file_name) { ?>
                        <a href="<?=$list->file_path?>/<?=$list->file_name?>" class="btn-download" download><span class="blind">첨부파일 다운로드</span></a>
                    <?php } ?>
                  </td>
                </tr>
                <?php
                    }
                }
                ?>
              </tbody>
            </table>
          </div>
  
          <div class="paging js-paging">
            <?=$pagination?>
          </div>
    </div>
<?php } else { ?>
    <div class="">
      <div class="customer_section inner">
        <div class="personal_inquiry">
            <div class="nodata nomargin">
                <img src="/pc/image/mypage/nodata.png">
                <h2>등록된 공시정보가 없습니다. </h2>

                <div class="btn-wrap">
                    <a href="/" class="btn btn-primary w100">메인으로</a>
                </div>
            </div>
        </div>
      </div>
    </div>        
    <!--: End #contents -->
<?php } ?>    
  <script>
	  ;($ => {
		  $.depth1Index = 0
		  $.depth2Index = 2
		
	  })(window.jQuery)
  </script>    
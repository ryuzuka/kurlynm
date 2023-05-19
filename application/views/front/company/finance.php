    <!-- s : contents -->
    <div class="contents company">
      <div class="visual company">
        <h2>공시정보</h2>
        <p class="text">컬리넥스트마일의 재무정보를 투명하게 공개합니다.</p>
      </div>
        
    <?php
        if ($financeList) {
    ?>     
      <div class="inner-section">
        <div class="tblnew-box">
          <table class="tblnew-list">
            <caption><span class="blind">공시정보</span></caption>
            <colgroup>
              <col style="width:13.3%;">
              <col style="width:73.3%;">
              <col style="width:13.4%;">
            </colgroup>
            <thead>
            <tr>
              <th scope="col">번호</th>
              <th scope="col">제목</th>
              <th scope="col">첨부파일</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    foreach($financeList as $i => $list) {
                        $no = $total_count - ($page_rows * ($page - 1)) - $i;
                ?>
                <tr>
                  <td><?=$no?></td>
                  <td class="emp"><?=$list->title?></td>
                  <td>
                    <?php if($list->file_name) { ?>
                        <a href="<?=$list->file_path?>/<?=$list->file_name?>" class="btn-download" download><span class="blind">첨부파일 다운로드</span></a>
                    <?php } ?>
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
        
      <?php } else { ?>
      <div class="inner-section">
        
        <div class="nodata nomargin">
            <img src="/pc/image/mypage/nodata.png">
            <h2>등록된 공시정보가 없습니다.</h2>

            <div class="btn-wrap">
                <a href="/" class="btn btn-primary">메인으로</a>
            </div>
        </div>
      <?php } ?>
          
    </div>
    <!-- e : contents -->
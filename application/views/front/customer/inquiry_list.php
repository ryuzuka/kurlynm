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
.tab-list2 {
    display: flex;
}
.tab-list2 button[aria-selected="true"] {
    border-color: #5f0080;
    color: #5f0080;
}

.tab-list2 button {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    padding: 45px;
    border-bottom: 6px solid #e7e7e7;
    font-size: 32px;
    font-weight: bold;
    color: #d3d3d3;
}

.personal_inquiry .tblnew-list a {
    border: 0px;
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
            <div class="tab-list2" role="tablist">
              <button type="button" id="tab1" role="tab" aria-controls="tab-content1" aria-selected="false" onclick="location.href='inquiry_write';">문의하기</button>
              <button type="button" id="tab2" role="tab" aria-controls="tab-content2" aria-selected="true" class="active">나의 문의내역</button>
            </div>
            
            <div class="tab-content">
              <?php if($inquiryList) { ?>
              <div id="tab-content1" class="content" role="tabpanel" aria-labelledby="tab1" tabindex="0">
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
                        <th scope="col">처리 상태</th>
                        <th scope="col">등록일</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach($inquiryList as $i => $list) {
                            $no = $total_count - ($page_rows * ($page - 1)) - $i;
                            
                            if($list->status == "Y") {
                                $status = "답변완료";
                                $status_style = "";
                            } else {
                                $status = "처리중";
                                $status_style = "no";
                            }
                        ?>
                        <tr>
                            <td class=""><?=$no?></td>
                            <td class=""><a href="/customer/inquiry_info?seq=<?=$list->seq?>&<?=$params?>"><?=$list->question_title?></a></td>
                            <td>
                              <span class="<?=$status_style?>"><?=$status?></span>
                            </td>
                            <td class="">
                              <?=date('Y.m.d', strtotime($list->regist_date))?>
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

              <div id="tab-content2" class="content" role="tabpanel" aria-labelledby="tab2" tabindex="0" hidden>
                <div class="personal_inquiry">

                    <div class="nodata">
                        <img src="/pc/image/mypage/nodata.png">
                        <h2>작성된 문의내역이 없습니다.</h2>

                        <div class="btn-wrap">
                            <a href="#" class="btn btn-primary">메인으로</a>
                        </div>

                    </div>


                </div>
              </div>
              <?php } ?>
                
            </div>
          </div>

      </div>


    </div>
    <!-- e : contents -->
    
  <script>
	  ;($ => {
		  $.depth1Index = 4
		  $.depth2Index = 2

	  })(window.jQuery)
  </script>    
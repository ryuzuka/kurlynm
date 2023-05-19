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
    padding: 13px;
    color: #d3d3d3;
    font-size: 14px;
    font-weight: bold;
    border-bottom: 2px solid #d3d3d3;
}
</style>

<div class="visual customer">
      <div class="text">
          <h2>1:1 문의</h2>
          <p>친절하고 신속하게 답변드리겠습니다.</p>
      </div>
  </div>

    <!-- s : contents -->
    <div class="">


      <div class="customer_section inner">

        <div class="tab js-tab">
            <div class="tab-list2" role="tablist">
              <button type="button" id="tab1" role="tab" aria-controls="tab-content1" aria-selected="false" onclick="location.href='inquiry_write';">문의하기</button>
              <button type="button" id="tab2" role="tab" aria-controls="tab-content2" aria-selected="true" class="active">나의 문의내역</button>
            </div>
            
            <div class="tab-content">
              <?php if($inquiryList) { ?>
              <div id="tab-content2" class="content" role="tabpanel" aria-labelledby="tab2" tabindex="0" hidden>
                <div class="personal_inquiry">

                <div class="inquiry_list">
                  <ul>
                    <?php
                    foreach($inquiryList as $i => $list) {
                        $no = $total_count - ($page_rows * ($page - 1)) - $i;

                        if($list->status == "Y") {
                            $status = "답변완료";
                            $status_style = "ok";
                        } else {
                            $status = "처리중";
                            $status_style = "";
                        }
                    ?>                      
                    <li>
                      <h2><a href="/customer/inquiry_info?seq=<?=$list->seq?>&<?=$params?>"><?=$list->question_title?></a></h2>
                      <p><?=date('Y.m.d', strtotime($list->regist_date))?></p>
                      <div class="state <?=$status_style?>"><?=$status?></div>
                    </li>
                    <?php
                    }
                    ?>
                  </ul>

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
		
		  $(function () {
		  })
	  })(window.jQuery)
  </script>    
    <!-- s : contents -->
    <div class="contents estimate">
      <div class="visual ect">
        <h2>견적문의내역</h2>
        <p class="text">문의하신 내역을 확인해보세요.</p>
      </div>
    <div class="estimate-section">
        <form id="searchForm" name="searchForm" method="get">
        <input type="hidden" id="page" name="page" value="">
            <div class="estimate-form">
                <p>기간</p>
                <div class="estimate-choice">
                    <div class="input-group">
                      <div class="rdo-box">
                        <input type="radio" id="rdo1-1" name="rdo" value="all" class="sel_terms" <?php if($rdo == "all") { echo "checked"; } ?>><label for="rdo1-1">전체</label>
                      </div>
                      <div class="rdo-box">
                        <input type="radio" id="rdo1-2" name="rdo" value="1" class="sel_terms" <?php if($rdo == "1") { echo "checked"; } ?>><label for="rdo1-2">1개월</label>
                      </div>
                      <div class="rdo-box">
                        <input type="radio" id="rdo1-3" name="rdo" value="3" class="sel_terms" <?php if($rdo == "3") { echo "checked"; } ?>><label for="rdo1-3">3개월</label>
                      </div>
                      <div class="rdo-box">
                          <input type="radio" id="rdo1-4" name="rdo" value="6" class="sel_terms" <?php if($rdo == "6") { echo "checked"; } ?>><label for="rdo1-4">6개월</label>
                        </div>
                    </div>

                    <div class="calendar">
                      <div class="input-title">직접입력</div>
                      <div class="js-calendar datepicker from">
                        <input type="text" id="start_date" name="start_date" value="<?=$start_date?>" autocomplete='off'>
                      </div>
                      <span>~</span>
                      <div class="js-calendar datepicker to">
                        <input type="text" id="end_date" name="end_date" value="<?=$end_date?>" autocomplete='off'>
                      </div>
                    </div>

                    <div class="estimate_btn">
                      <a href="/member/estimate" class="reply reset">
                        <img src="/pc/image/mypage/reply.svg" class="login_logo">
                      </a>
                      <a href="javascript:void(0);" class="btn_search">
                        <span><img src="/pc/image/mypage/search.svg"></span><span>검색</span>
                      </a>
                    </div>
                </div>
            </div>
        </form>

        <?php
            if ($estimateList) {
        ?>
        
        <div class="inner-section">
            <div class="tblnew-box">
              <table class="tblnew-list">
                <caption><span class="blind">공시정보</span></caption>
                <colgroup>
                  <col style="width:16%;">
                  <col style="width:16%;">
                  <col style="width:16%;">
                  <col style="width:24%;">
                  <col style="width:16%;">
                  <col style="width:12%;">
                </colgroup>
                <thead>
                <tr>
                  <th scope="col">문의일시</th>
                  <th scope="col">사업체명</th>
                  <th scope="col">담당자 연락처</th>
                  <th scope="col">이메일</th>
                  <th scope="col">처리상태</th>
                  <th scope="col">상세확인</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach($estimateList as $i => $list){
                ?>
                <tr>
                  <td class=""><?=date('Y-m-d H:i', strtotime($list->regist_date))?></td>
                  <td class=""><?=$list->company_name?></td>
                  <td class=""><?=$list->dec_tel?></td>
                  <td class=""><?=$list->dec_email?></td>
                  <td>
                    <?php if ($list->status == "Y") { echo "<span class='ok'>답변완료</span>"; } else { echo "<span class='no'>처리중</span>"; } ?>
                  </td>
                  <td class="">
                    <a href="/member/estimate_info?seq=<?=$list->seq?>&<?=$params?>">보기</a>
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
                <div class="nodata">
                    <img src="/pc/image/mypage/nodata.png">
                    <h2>작성된 문의내역이 없습니다.</h2>

                    <div class="btn-wrap">
                        <a href="/" class="btn btn-primary">메인으로</a>
                    </div>

                </div>
        </div>        
        <?php } ?>
    </div>
    </div>
    <!-- e : contents -->
    
	    <div id="pop-invalid-date" class="layer" role="dialog" aria-modal="true">
		    <div class="layer-wrap">
			    <div class="layer-content">
				    <p>잘못된 날짜입니다.</p>
			    </div>
			    <div class="button-wrap">
				    <button class="btn">확인</button>
			    </div>
		    </div>
	    </div>
    
    <script>
    $(document).ready(function () {
        $(document).on('click', '.btn_search', function() {
            $('#searchForm').submit();
        });
        

    });
    
	  ;($ => {
		  $.depth1Index = -1
		  $.depth2Index = -1

		  $(function () {
				// 기간 설정
			  $('.estimate-form').on('change-calendar', e => {
                    //console.log(e.period, e.date)
                    console.log($("#start_date").val());
                    console.log($("#end_date").val());
			  })
              
                $(document).on('click', '.sel_terms', function() {
                    
//                    $('#searchForm').submit();
//                    if($("input[name='rdo']:checked").val() == "all") {
//                        location.href = "/member/estimate";
//                    } else {
//                        $('#searchForm').submit();
//                    }
                    //$('.btn_search').click();
                    //$('#searchForm').submit();
                });              
		  })
	  })(window.jQuery)    
    </script>    
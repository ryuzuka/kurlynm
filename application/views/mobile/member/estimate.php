    <div class="visual mypage">
        <div class="text">
            <h2>견적문의내역</h2>
        <p class="text">문의하신 내역을 확인해보세요.</p>
        </div>
    </div>


    <!-- s : contents -->

    <div class="estimate-section">
        <form id="searchForm" name="searchForm" method="get">
        <input type="hidden" id="page" name="page" value="">
        <div class="estimate-form">

            <div class="estimate-choice">
                <div class="input-group">
                  <div class="rdo-box">
                    <input type="radio" id="rdo1-1" name="rdo" value="all" <?php if($rdo == "all") { echo "checked"; } ?>><label for="rdo1-1">전체</label>
                  </div>
                  <div class="rdo-box">
                    <input type="radio" id="rdo1-2" name="rdo" value="1" <?php if($rdo == "1") { echo "checked"; } ?>><label for="rdo1-2">1개월</label>
                  </div>
                  <div class="rdo-box">
                    <input type="radio" id="rdo1-3" name="rdo" value="3" <?php if($rdo == "3") { echo "checked"; } ?>><label for="rdo1-3">3개월</label>
                  </div>
                  <div class="rdo-box">
                      <input type="radio" id="rdo1-4" name="rdo" value="6" <?php if($rdo == "6") { echo "checked"; } ?>><label for="rdo1-4">6개월</label>
                    </div>
                    <div class="rdo-box">
                        <input type="radio" id="rdo1-5" name="rdo" value="" <?php if($rdo == "") { echo "checked"; } ?>><label for="rdo1-5">직접입력</label>
                    </div>
                </div>

                <div class="calendar <?php if($rdo == "") { echo "on"; } ?>">
                  <div class="js-calendar datepicker from">
                    <input type="text" id="start_date" name="start_date" readonly value="<?=$start_date?>" autocomplete='off'>
                  </div>
                  <span>~</span>
                  <div class="js-calendar datepicker to">
                    <input type="text" id="end_date" name="end_date" readonly value="<?=$end_date?>" autocomplete='off'>
                  </div>
                </div>

                <div class="estimate_btn">
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
        <div class="estimate_list">
            <?php
                foreach($estimateList as $i => $list){
            ?>            
            <div class="box">
                <?php if ($list->status == "Y") { echo "<div class='status ok'>답변완료</div>"; } else { echo "<div class='status'>처리중</div>"; } ?>
                
                <p class="date"><?=date('Y-m-d H:i', strtotime($list->regist_date))?></p>
                <ul>
                    <li>
                        <p>사업체명</p>
                    </li>
                    <li>
                        <p><b><?=$list->company_name?></b></p>
                    </li>
                    <li>
                        <p>담당자 연락처</p>
                    </li>
                    <li>
                        <p><b><?=$list->dec_tel?></b></p>
                    </li>
                    <li>
                        <p>담당자 이메일</p>
                    </li>
                    <li>
                        <p><b><?=$list->dec_email?></b></p>
                    </li>
                    <li>
                        <p>상세확인</p>
                    </li>
                    <li>
                        <a href="/member/estimate_info?seq=<?=$list->seq?>&<?=$params?>">보기</a>
                    </li>
                </ul>
            </div>
            <?php
                }
            ?>
        </div>
        <?php } else { ?>
        <div class="estimate_list">
            <div class="nodata">
                <img src="/pc/image/mypage/nodata.png">
                <h2>작성된 문의내역이 없습니다.</h2>

                <div class="btn-wrap">
                    <a href="/" class="btn btn-primary">메인으로</a>
                </div>

            </div>
        </div>
        <?php } ?>
        
        <div class="paging js-paging">
            <?=$pagination?>
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
        
        $(document).on('click', '.sel_terms', function() {
            //console.log($("#start_date").val());
            //$('#searchForm').submit();
        });
    });
    
  ;($ => {
    $.depth1Index = -1
    $.depth2Index = -1

    $(function () {
			// 기간 설정
		  $('.estimate-form').on('change-calendar', e => {
				console.log(e.period, e.date)
		  })
	  })
	  })(window.jQuery)
  </script>    
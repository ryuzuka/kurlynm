    <!-- s : contents -->
    <div class="contents estimate">
      <div class="visual ect">
        <h2>택배표준약관</h2>
      
      </div>
      <div class="privacy terms">
        <div class="text">
            <?php if($terms) { ?>
            <?=$terms->content?>
            <?php } ?>            
          </div>

          <div class="before">
            <?php
            if($termsList) {
                foreach($termsList as $i => $list){
            ?>
	          <a href="#" class="modalBtn" aria-haspopup="dialog" aria-controls="pop-terms-201209" data-idx="<?=$list->seq?>" data-start="<?=$list->start_date?>" data-end="<?=$list->end_date?>"><?=$list->start_date?> ~ <?=$list->end_date?> 적용</a>
            <?php                 
                }
            }
            ?>
          </div>



        
        <div id="pop-terms-201209" class="layer" role="dialog" aria-modal="true">
            <div class="layer-wrap">
                <div class="layer-content">
                      <button class="close">
                      </button>
                  <div class="title">
                    택배표준약관
                      <span>2020-04-20 ~ 2021-12-08</span>
                  </div>
                  <div class="textarea dropdown-list">
                    <div class="text">
                      
                    </div>
                  </div>
                </div>
              </div>
        </div>

      </div>
    </div>
    <!-- e : contents -->
    
  <script>
	  ;($ => {
		  $.depth1Index = -1
		  $.depth2Index = -1
		
		  $(function () {
			  $('.terms').on('click', '.before a', e => {
				  e.preventDefault()
				  let idx = $(e.target).attr('data-idx');
                  let start = $(e.target).attr('data-start');
                  let end = $(e.target).attr('data-end');
                  let terms = $(e.target).attr('aria-controls');
                  //console.log(idx);
                  
                    $.ajax({
                        url: '/main/terms_info', // 요청 할 주소
                        async: false, // false 일 경우 동기 요청으로 변경
                        type: 'POST', // GET, PUT
                        data: {
                            seq: idx,
                        }, // 전송할 데이터
                        success: function(jqXHR) {
                            //alert(jqXHR);
                            $('#' + terms).modal({clickToClose: false});
                            $(".layer .title span").html(start +"~"+ end);
                            $(".dropdown-list .text").html(jqXHR);
                        }, // 요청 완료 시
                        error: function(jqXHR) {}, // 요청 실패.
                        complete: function(jqXHR) {
                            
                            
                        } // 요청의 실패, 성공과 상관 없이 완료 될 경우 호출
                    });                  
				  //$('#' + terms).modal({clickToClose: false});
			  })
		  })
	  })(window.jQuery)
  </script>    
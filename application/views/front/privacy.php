<!-- s : contents -->
<div class="contents estimate">
  <div class="visual ect">
    <h2>개인정보 처리방침</h2>
  </div>

	<div class="privacy">
    <div class="text">
      <?php if($privacy) { ?>
      <?=$privacy->content?>
      <?php } ?>
    </div>

    <div class="before">
      <?php
//         $string = '개인정보처리방침 0차';
//         $result = preg_replace('/0차/', '최초', $string);
//         echo $result;
      if($privacyList) {
          foreach($privacyList as $i => $list){
      ?>
        <a href="#" class="modalBtn" aria-haspopup="dialog" aria-controls="pop-privacy-220601" data-idx="<?=$list->seq?>" data-start="<?=$list->start_date?>" data-end="<?=$list->end_date?>">- 개인정보처리방침 <span class="round"><?=$list->seq-13?>차</span> (<span class="date"><?=$list->start_date?></span>) 바로가기</a>
      <?php
          }
      }
      ?>
    </div>

    <div id="pop-privacy-220601" class="layer" role="dialog" aria-modal="true">
      <div class="layer-wrap">
        <div class="layer-content">
          <button class="close">
          </button>
          <div class="title">
            개인정보 처리방침<span>2020-04-20 ~ 2021-12-08</span>
          </div>
          <div class="textarea dropdown-list">
            <div class="text"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  ;($ => {
	  $.depth1Index = -1
	  $.depth2Index = -1

    $(function () {
		  $('.privacy').on('click', '.before a', e => {
			  e.preventDefault()
			  let idx = $(e.target).attr('data-idx');
        let start = $(e.target).attr('data-start');
        let end = $(e.target).attr('data-end');
        let policy = $(e.target).attr('aria-controls');
        //console.log(idx);

          $.ajax({
              url: '/main/privacy_info', // 요청 할 주소
              async: false, // false 일 경우 동기 요청으로 변경
              type: 'POST', // GET, PUT
              data: {
                  seq: idx,
              }, // 전송할 데이터
              success: function(jqXHR) {
                  //alert(jqXHR);
                  $('#' + policy).modal({clickToClose: false});
                  $(".layer .title span").html(start +"~"+ end);
                  $(".dropdown-list .text").html(jqXHR);
              }, // 요청 완료 시
              error: function(jqXHR) {}, // 요청 실패.
              complete: function(jqXHR) {


              } // 요청의 실패, 성공과 상관 없이 완료 될 경우 호출
          });
			  //$('#' + terms).modal({clickToClose: false});
		  })

      $('.before a').each(function (index) {
	      $(this).find('.date').text(moment($(this).find('.date').text()).format('YYYY.MM.DD'))
	      if (index === $('.before a').length - 1) {
		      $(this).find('.round').text('최초')
	      }
      })
	  })
  })(window.jQuery)
</script>

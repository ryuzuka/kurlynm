    <div class="visual mypage">
      <div class="text">
          <h2>개인정보 처리방침</h2>
          <p></p>
      </div>
  </div>

    <!-- s : contents -->


<div class="privacy">
    <div class="text">
        <?php if($privacy) { ?>
        <?=$privacy->content?>
        <?php } ?>
      </div>

      <div class="before">
        <?php
        if($privacyList) {
            foreach($privacyList as $i => $list){
        ?>
	            <a href="privacy_prev?seq=<?=$list->seq?>">- 개인정보처리방침 <span class="round"><?=$list->seq-13?>차</span> (<span class="date"><?=$list->start_date?></span>) 바로가기</a>
        <?php
            }
        }
        ?>
      </div>

  </div>
</div>

<script>
	$(function () {
		$('.before a').each(function (index) {
			$(this).find('.date').text(moment($(this).find('.date').text()).format('YYYY.MM.DD'))
			if (index === $('.before a').length - 1) {
				$(this).find('.round').text('최초')
			}
		})
	})
</script>
<!-- e : contents -->

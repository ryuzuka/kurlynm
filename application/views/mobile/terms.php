    <div class="visual mypage">
      <div class="text">
          <h2>택배표준약관</h2>
          <p></p>
      </div>
  </div>

    <!-- s : contents -->
    <div class="contents estimate">
 
      <div class="privacy">
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
	          <a href="terms_prev?seq=<?=$list->seq?>"><?=$list->start_date?> ~ <?=$list->end_date?> 적용</a>
            <?php                 
                }
            }
            ?>
          </div>

      </div>
    </div>
    <!-- e : contents -->
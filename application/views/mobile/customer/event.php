    <div class="visual customer">
        <div class="text">
            <h2>이벤트</h2>
            <p>다양한 혜택을 드리는<br>
              이벤트에 참여해보세요.</p>
        </div>
    </div>

    <!-- s : contents -->
    <div class="">

      <div class="customer_section inner">
        <?php
            if ($eventList) {
        ?>
        <div>
            <ul class="event_list">
                <?php
                    foreach($eventList as $i => $list) {
                        $no = $total_count - ($page_rows * ($page - 1)) - $i;
                        
                        if($list->ing == "0") {
                            if($list->start_date > date("Y-m-d")) {
                                $style_value = "style='font-weight: 400'";
                                $status_value = "진행예정";
                            } else {
                                $style_value = "style='font-weight: 400'";
                                $status_value = "진행종료";
                            }
                        } else if($list->ing == "1") {
                            $style_value = "style='font-weight: 800'";
                            $status_value = "진행중";
                        }
                        
                        if($list->thumb_type == "B") {
                            $thumb = "";
                        } else {
                            $thumb = "background: url(".$list->file_path_mo."/".$list->file_name_mo.") no-repeat right bottom;";
                        }
                ?>                
                <li class="event_lists" style='<?=$thumb?>'>
                    <a href="event_info?seq=<?=$list->seq?>"></a>
                    <div class="state <?php if($list->ing == "0") { echo "end"; } ?>">
                        <?php echo $status_value; ?>
                    </div>
                    <h2>
                        <?=$list->thumb_mo1?><br>
                        <?=$list->thumb_mo2?>
                    </h2>
                    <p class="date">
                        <?=date('Y.m.d', strtotime($list->start_date))?> ~ <?=date('Y.m.d', strtotime($list->end_date))?>
                    </p>
                </li>
                <?php } ?>
            </ul>

            <div class="readmore">
                <a href="javascript:void(0);" class="btn_more">
                    + 더보기
                </a>
            </div>
        </div>
        <?php } else { ?>
        <div class="personal_inquiry">
          <div class="nodata nomargin">
            <img src="/pc/image/mypage/nodata.png">
            <h2>진행중인 이벤트가 없습니다. </h2>

            <div class="btn-wrap">
                <a href="/" class="btn btn-primary w100">메인으로</a>
            </div>

        </div>
        </div>          
        <?php } ?>  
      </div>
  
    </div>
    <!-- e : contents -->

  <script>
	  ;($ => {
		  $.depth1Index = 4
		  $.depth2Index = 0
		
		  $(function () {
		  })
	  })(window.jQuery)
    
    $('.btn_more').bind('click', function() {
        getMoreList();
    });
        
    var getMoreList = function() {
        var count = $('.event_lists').length;
        var countTotal = '<?=$total_count?>';

        if (count == countTotal) {
            alert('더 이상 컨텐츠가 없습니다.');
            return false;
        }
        $('.btn_more').unbind('click');

        $.ajax({
            type: 'POST',
            url: '/customer/event_more?<?=$params?>',
            data: { start: count, end: 5 }
        })
        .done(function( msg ) {
            $('.event_list').append(msg);
            $('.event_list').show();

            $('.btn_more').bind('click', function() {
                getMoreList();
            });
        });
    }      
  </script>
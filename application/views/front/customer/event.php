    <!-- s : contents -->
    <div class="contents">
      <div class="visual customer">
        <h2>이벤트</h2>
        <p class="text">다양한 혜택을 드리는 이벤트에 참여해보세요.</p>
      </div>

        <?php
            if ($eventList) {
        ?>          
        <div class="customer_section inner">
            <div class="event_list">
                <ul>
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
                                $thumb = "background:url(".$list->file_path_pc."/".$list->file_name_pc.") no-repeat right bottom;";
                            }

                    ?>
                    <li style='<?=$thumb?>'>
                        <a href="event_info?seq=<?=$list->seq?>"></a>
                        <div class="state <?php if($list->ing == "0") { echo "end"; } ?>">
                            <?php echo $status_value; ?>
                        </div>
                        <h2>
                            <?=$list->thumb_pc1?><br>
                            <?=$list->thumb_pc2?>
                        </h2>
                        <p class="date">
                            <?=date('Y.m.d', strtotime($list->start_date))?> ~ <?=date('Y.m.d', strtotime($list->end_date))?>
                        </p>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <?php } else { ?>
        <div class="inner-section">
            <div class="nodata nomargin">
                <img src="/pc/image/mypage/nodata.png">
                <h2>진행중인 이벤트가 없습니다.</h2>

                <div class="btn-wrap">
                    <a href="/" class="btn btn-primary">메인으로</a>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
    <!-- e : contents -->
    
  <script>
	  ;($ => {
      $.depth1Index = 4
      $.depth2Index = 0

	  })(window.jQuery)
  </script>    
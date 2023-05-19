<?php
    if ($eventList) {
        foreach($eventList as $i => $list) {
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
                <?php if($list->thumb_type == "B") { ?>
                <img src="/pc/image/customer/kurlylogo.svg" class="event_logo">
                <?php } else { ?>
                <img src="<?=$list->file_path_mo?>/<?=$list->file_name_mo?>" class="event_logo">
                <?php } ?>
            </li>

<?php 
        }
    } 
?>

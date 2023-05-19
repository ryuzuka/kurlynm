    <!-- s : contents -->
    <div class="">
      <div class="customer_section inner">
            <div class="personal_inquiry_detail">
                <div class="title">
                    <h2>
                        <?=$notice->title?>
                        <span class="date"><?=date('Y.m.d', strtotime($notice->regist_date))?></span>
                    </h2>
                </div>

                <div class="text">
                    <p>
                      <?=$notice->content?>
                    </p>
                </div>

                <?php if($notice->file_name) { ?>
                <div class="file">
                    <p>첨부파일</p>
                    <a href="<?=$notice->file_path?>/<?=$notice->file_name?>" target="_blank"><?=$notice->file_name?></a>
                </div>
                <?php } ?>

                <div class="btn-wrap">
                    <button type="button" class="btn btn-primary w100" onclick="javascript:history.back(-1);">목록</button>
                </div>
          </div>
      </div>
    </div>
    <!-- e : contents -->
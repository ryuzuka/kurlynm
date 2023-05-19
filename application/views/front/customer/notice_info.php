    <!-- s : contents -->
    <div class="contents">
      <div class="visual customer">
        <h2>공지사항</h2>
        <p class="text">이슈 및 공지사항을 확인해보세요.</p>
      </div>

      <div class="customer_section inner">

        <div class="notice_detail">
            <div class="title">
                <h2>
                    <?=$notice->title?>
                </h2>
                <div class="state_are">
                    <span class="date"><?=date('Y.m.d', strtotime($notice->regist_date))?></span>
                </div>
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
                <button type="button" class="btn btn-primary" onclick="javascript:history.back(-1);">목록</button>
           </div>
        </div>
      </div>
    </div>
    <!-- e : contents -->
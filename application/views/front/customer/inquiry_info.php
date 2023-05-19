<style>
.personal_inquiry .box .file .file_info {
    margin-right: 12px;
}    
.personal_inquiry .box .file .btn_are::after {
    background: none;
}
.personal_inquiry .box .file .file_info span {
    padding: 16px 50px 10px 20px;
    border-radius: 8px;
    margin-right: 0;
}
.tab-list2 {
    display: flex;
}
.tab-list2 button[aria-selected="true"] {
    border-color: #5f0080;
    color: #5f0080;
}

.tab-list2 button {
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    padding: 45px;
    border-bottom: 6px solid #e7e7e7;
    font-size: 32px;
    font-weight: bold;
    color: #d3d3d3;
}
</style>

<!-- s : contents -->
    <div class="contents">
      <div class="visual customer">
        <h2>1:1 문의</h2>
        <p class="text">친절하고 신속하게 답변드리겠습니다.</p>
      </div>

      <div class="customer_section inner">

        <div class="tab js-tab">
            <div class="tab-list2" role="tablist">
              <button type="button" id="tab1" role="tab" aria-controls="tab-content1" aria-selected="false" onclick="location.href='inquiry_write';">문의하기</button>
              <button type="button" id="tab2" role="tab" aria-controls="tab-content2" aria-selected="true" class="active">나의 문의내역</button>

            </div>
            <div class="tab-content">
              <div id="tab-content2" class="content" role="tabpanel" aria-labelledby="tab2" tabindex="0" hidden>
                <div class="personal_inquiry_detail">
                    <div class="title">
                        <h2>
                            <?=$inquiry->question_title?>
                        </h2>
                        <div class="state_are">
                            <span class="state"><?php if($inquiry->status == "Y") { echo "답변완료"; } else { echo "처리중"; } ?></span>
                            <span class="date"><?=date('Y.m.d', strtotime($inquiry->regist_date))?></span>
                        </div>
                    </div>

                    <div class="text">
                        <p><?=$inquiry->question_content?></p>
                    </div>

                    <?php if($inquiry->file_name_1 || $inquiry->file_name_2 || $inquiry->file_name_3) { ?>
                    <div class="file">
                        <p>첨부파일</p>
                        <?php if($inquiry->file_name_1) { ?>
                        <a href="<?=$inquiry->file_path_1?>/<?=$inquiry->file_name_1?>" target="_blank"><?=$inquiry->file_name_1?></a>
                        <?php } ?>
                        <?php if($inquiry->file_name_2) { ?>
                        <a href="<?=$inquiry->file_path_2?>/<?=$inquiry->file_name_2?>" target="_blank"><?=$inquiry->file_name_2?></a>
                        <?php } ?>
                        <?php if($inquiry->file_name_3) { ?>
                        <a href="<?=$inquiry->file_path_3?>/<?=$inquiry->file_name_3?>" target="_blank"><?=$inquiry->file_name_3?></a>
                        <?php } ?>
                    </div>
                    <?php } ?>

                    <?php if($inquiry->answer_content) {?>
                    <div class="reply">
                        <p><?=$inquiry->answer_content?></p>
                    </div>
                    <?php } ?>

                    <div class="btn-wrap">
                        <button type="button" class="btn btn-primary" onclick="javascript:history.back(-1);">목록</button>
                   </div>


                </div>
              </div>

            </div>
          </div>

      </div>


    </div>
    <!-- e : contents -->
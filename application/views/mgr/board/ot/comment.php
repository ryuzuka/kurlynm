                <br>
                <span>총 <b style="color: #367FA9;"><?=$comment_count?></b>개의 댓글</span>
                <div class="box">
                    <div class="box-body clearfix">
                        <form id="commentForm" name="commentForm" method="post" action="<?=$this->board_path?>insertComment?board_code=<?=$boardconfig->board_code?>&seq=<?=$seq?>" onsubmit="return false;" class="form-horizontal" role="form">
                            <textarea id="comment" name="comment" cols="20" rows="3" style="width: 100%;"></textarea>
                            <div class="col-xs-6 horizon-padding-none">
                                <span style="font-weight: bold;"><?=($this->session->userdata('AID')) ? "관리자" : $this->session->userdata('UName')?></span>
                                <?php if ($this->session->userdata('AID')) { ?>(<?=($this->session->userdata('AID')) ? $this->session->userdata('AID') : $this->session->userdata('UID')?>)<?php } ?>
                            </div>
                            <div class="col-xs-6 horizon-padding-none text-right"><button id="btn-comment-insert" class="btn btn-primary btn-xs">등록</button></div>
                        </form>
                    </div>
                </div>
                <?php
                if ($commentList) {
                    foreach($commentList as $i => $list){
                ?>
                <div class="box" style="border-top: 1px solid #EAEAEA;">
                    <div class="box-body">
                        <ul>
                            <li id="comment-<?=$list->c_no?>" style="padding-left: <?=$list->c_level*30?>px;">
                                <?php if ($list->c_level > 0) { ?><i class='fa fa-mail-forward reverse-vertical' style='color: #F56954;'></i><?php } ?>
                                <span class="write-name"><?=$list->name?></span> (<?=$list->user_id?>)
                                <span class="bar">|</span>
                                <span class="write-date"><?=date('Y-m-d H:i', strtotime($list->regist_date))?></span>
                                <span style="padding-left: 20px;">
                                    <?php if ($this->session->userdata('AID') || $this->session->userdata('UID') == $list->user_id) { ?>
                                    <a href="javascript:void(0);" class="btn-comment-update-form" style="color: #3C8DBC; font-size: 15px; margin-right: 5px;" title="수정" data-c_no="<?=$list->c_no?>"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" class="btn-comment-delete" style="color: #F56954; font-size: 15px; margin-right: 5px;" title="삭제" data-c_no="<?=$list->c_no?>"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </span>
                                <p><?=nl2br($list->comment)?></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
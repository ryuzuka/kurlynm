<li id='comment-reply' style='padding-left: <?=($comment->c_level+1)*30?>px;'>
    <form id="commentReplyForm" name="commentReplyForm" method="post" action="<?=$this->board_path?>insertComment?board_code=<?=$boardconfig->board_code?>&seq=<?=$seq?>" onsubmit="return false;" class="form-horizontal" role="form">
        <input type="hidden" name="c_group" value="<?=$comment->c_group?>">
        <input type="hidden" name="c_step" value="<?=$comment->c_step?>">
        <input type="hidden" name="c_level" value="<?=$comment->c_level?>">
    <i class='fa fa-mail-forward reverse-vertical' style='color: #F56954;'></i>
    <span class='write-name'><?=($this->session->userdata('AID')) ? "관리자" : $this->session->userdata('UName')?></span>
    (<?=($this->session->userdata('AID')) ? $this->session->userdata('AID') : $this->session->userdata('UID')?>)
    <textarea id="reply-comment" name="comment" cols='20' rows='3' style='width: 100%;'></textarea>
    <div class='text-right'>
        <button class='btn btn-primary btn-xs btn-comment-reply-insert'>확인</button>
        <button class='btn btn-warning btn-xs btn-comment-reply-close'>취소</button>
    </div>
    </form>
</li>
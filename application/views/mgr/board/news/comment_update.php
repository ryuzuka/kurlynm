<div id="comment-update">
    <form id="commentUpdateForm" name="commentUpdateForm" method="post" action="<?=$this->board_path?>updateComment?board_code=<?=$boardconfig->board_code?>&c_no=<?=$comment->c_no?>" onsubmit="return false;" class="form-horizontal" role="form">
        <textarea id="update-comment" name="comment" cols="20" rows="3" style="width: 100%;"><?=$comment->comment?></textarea>
        <div class="text-right">
            <button class="btn btn-primary btn-xs btn-comment-update">확인</button>
            <button class="btn btn-warning btn-xs btn-comment-update-close" data-c_no="<?=$comment->c_no?>">취소</button>
        </div>
    </form>
</div>
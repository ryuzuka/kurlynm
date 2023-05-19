<style type="text/css">
    .board-content {}
    .board-content img { max-width: 100%; }
</style>
<script type="text/javascript">
	$(document).ready(function(){
        $('.btn-delete').click(function(){
            var msg = "Would you like to Delete?"; 
            if (confirm(msg)) {
                // <form onsubmit="return false;" 일 경우 jquery.submit(); 동작 안함
                //$('#frm').attr("action", "<?=$this->board_path?>delete?<?=$params?>&seq=<?=$board->seq?>&page=<?=$page?>").submit();
                var f = document.frm;
                f.action = "<?=$this->board_path?>delete?<?=$params?>&seq=<?=$board->seq?>&page=<?=$page?>";
                f.submit();
            }
        });
        
        <?php if ($boardconfig->is_comment == "Y") { ?>getCommentList();<?php } ?>
    });
    
    
    function getCommentList() {
        var url = "<?=$this->board_path?>comment?board_code=<?=$boardconfig->board_code?>&seq=<?=$board->seq?>";
        jQueryAjaxView(url, $('.board-comment'));
    }
    
    
    function closeCommentReply() {
        $('#comment-reply').remove();
    }
    
    
    function closeCommentUpdate(c_no) {
        $('#comment-'+c_no+' p').css('display', 'block');
        $('#comment-update').remove();
    }


    // 댓글 쓰기
    $(document).on('click', '#btn-comment-insert', function(){
        var f = document.commentForm;
        var obj;

        obj = $('#comment');
        if (obj.val() == "") {
            alert("Please Enter Comment.");
            setFocus(obj);
            return false;
        }

        var msg = "Would you like to Register?";
        if (confirm(msg)) {
            jQueryAjaxForm($('#commentForm'), "getCommentList()");
        }
    });
    

    // 댓글 답변 쓰기
    $(document).on('click', '.btn-comment-reply-insert', function(){
        var f = document.commentForm;
        var obj;

        obj = $('#reply-comment');
        if (obj.val() == "") {
            alert("Please Enter Comment.");
            setFocus(obj);
            return false;
        }

        var msg = "Would you like to Register?";
        if (confirm(msg)) {
            jQueryAjaxForm($('#commentReplyForm'), "getCommentList()");
        }
    });
    

    // 댓글 수정
    $(document).on('click', '.btn-comment-update', function(){
        var f = document.commentForm;
        var obj;

        obj = $('#update-comment');
        if (obj.val() == "") {
            alert("Please Enter Comment.");
            setFocus(obj);
            return false;
        }

        var msg = "Would you like to Modify?";
        if (confirm(msg)) {
            jQueryAjaxForm($('#commentUpdateForm'), "getCommentList()");
        }
    });
    
    
    // 댓글 답변 폼 띄우기
    var old_c_no = "";
    $(document).on('click', '.btn-comment-reply-form', function(){
        var c_no = $(this).data('c_no');
        if (document.getElementById('comment-reply') && c_no == old_c_no) {
            closeCommentReply();
        } else {
            closeCommentReply();
            
            var url = "<?=$this->board_path?>commentReplyForm?board_code=<?=$boardconfig->board_code?>&seq=<?=$board->seq?>&c_no="+c_no;
            
            $.get(url, function(data,status){
                if (status == "success") {
                    $('#comment-'+c_no).after(data);
                } else {
                    alert("An error has occurred.");
                }
            });
            old_c_no = c_no;
        }
    });


    // 댓글 답변 폼 닫기
    $(document).on('click', '.btn-comment-reply-close', function(){
        closeCommentReply();
    });

    
    // 댓글 수정 폼 띄우기
    var update_c_no = "";
    $(document).on('click', '.btn-comment-update-form', function(){
        var c_no = $(this).data('c_no');
        
        if (document.getElementById('comment-update') && c_no == update_c_no) {
            closeCommentUpdate(update_c_no);
        } else {
            closeCommentUpdate(update_c_no);
            
            var url = "<?=$this->board_path?>commentUpdateForm?board_code=<?=$boardconfig->board_code?>&c_no="+c_no;

            $.get(url, function(data,status){
                if (status == "success") {
                    $('#comment-'+c_no+' p').css('display', 'none').after(data);
                } else {
                    alert("An error has occurred.");
                }
            });
            update_c_no = c_no;
        }
    });


    // 댓글 수정 폼 닫기
    $(document).on('click', '.btn-comment-update-close', function(){
        var c_no = $(this).data('c_no');
        closeCommentUpdate(c_no);
    });

    
    $(document).on('click', '.btn-comment-delete', function(){
        var msg = "Would you like to Delete?";
        if (confirm(msg)) {
            var c_no = $(this).data('c_no');
            var url = "<?=$this->board_path?>deleteComment?board_code=<?=$boardconfig->board_code?>&c_no="+c_no;
            
            $.get(url, function(data,status){
                if (status == "success") {
                    getCommentList();
                } else {
                    alert("An error has occurred.");
                }
            });
        }
    });
</script>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-body">
                    <form id="frm" name="frm" method="post" action="" onsubmit="return false;" class="form-horizontal" role="form">
                        <h4 class="page-header" style="font-size: 20px; margin-bottom: 0;">
                            <?php
                            if ($board->category) echo "<span style='color: #999999; font-size: 18px;'>[" . $board->category . "]</span> ";
                            ?>
                            <?=$board->subject?>
                        </h4>
                        <div class="bg-gray clearfix" style="padding: 10px 0;">
                            <div class="col-sm-4"><?=$board->name?> (<?=$board->user_id?>)</div>
                            <div class="col-sm-8 text-right">
                                <span style="color: #999999; margin-right: 7px;">Search</span> <span><?=$board->view_count?></span>
                                <span style="color: #999999; padding: 0 10px; ">|</span>
                                <span><?=date('F d, Y H:i', strtotime($board->regist_date))?></span>
                            </div>
                        </div>
                        <div class="clearfix" style="min-height: 200px; padding: 15px 0;">
                            <?php
                            if ($fileList) {
                            ?>
                            <!-- 첨부파일 -->
                            <div class="col-sm-12 text-right" style="padding-bottom: 10px;">
                                <span style="color: #999999;">File Attach</span>
                                <?php
                                foreach($fileList as $i => $list){
                                    $file_url = str_replace($this->global_root_path, "", $list->full_path);
                                ?>
                                <span style="margin-left: 10px;"><a href="<?=$this->board_path?>download?board_code=<?=$boardconfig->board_code?>&file_no=<?=$list->file_no?>"><?=$list->file_name?></a> (<?=$list->file_size?> KB)</span>
                                <?php
                                }
                                ?>
                            </div>
                            <?php
                            }
                            
                            if ($imageList) {
                                foreach($imageList as $i => $list){
                                    $image_url = str_replace($this->global_root_path, "", $list->full_path);
                            ?>
                            <!-- 이미지파일 -->
                            <div class="col-sm-12 text-center board-content" style="padding-bottom: 10px;"><img src="<?=$image_url?>"></div>
                            <?php
                                }
                            }
                            ?>
                            <div class="col-sm-12 board-content"><?=$board->content?></div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="clearfix">
                <div class="col-xs-6 horizon-padding-none">
                    <?php if ($board->is_notice == "N") { ?><!--<a href="<?=$this->board_path?>updateNotice?<?=$params?>&page=<?=$page?>&seq=<?=$board->seq?>" class="btn bg-purple btn-sm" style="width:60px;">공지</a>--><?php } ?>
                </div>
                <div class="col-xs-6 horizon-padding-none text-right">
                    <a href="<?=$this->board_path?>?<?=$params?>&page=<?=$page?>" class="btn btn-success btn-sm" style="width:60px;">List</a>
                    <?php if ($boardconfig->is_reply == "Y") { ?><a href="<?=$this->board_path?>insert?<?=$params?>&page=<?=$page?>&seq=<?=$board->seq?>" class="btn btn-primary btn-sm" style="width:60px;">Comment</a><?php } ?>
                    <a href="<?=$this->board_path?>update?<?=$params?>&page=<?=$page?>&seq=<?=$board->seq?>" class="btn btn-primary btn-sm" style="width:60px;">Modify</a>
                    <button type="button" class="btn btn-danger btn-sm btn-delete" style="width:60px;">Delete</button>
                </div>
            </div>
            
            
            
            <?php
            if ($boardconfig->is_comment == "Y") {
            ?>
            <div class="board-comment"></div>
            <?php
            }
            ?>

            
            
        </div>
	</div>   <!-- /.row -->
</section>

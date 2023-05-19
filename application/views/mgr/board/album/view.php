<style type="text/css">
    .board-content {}
    .board-content img { max-width: 100%; }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-delete').click(function(){
            var msg = "삭제하시겠습니까?"; 
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
        jQueryAjaxView(url, $('#board-comment'));
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
            alert("댓글을 입력하세요.");
            setFocus(obj);
            return false;
        }

        var msg = "댓글을 등록하시겠습니까?";
        if (confirm(msg)) {
            jQueryAjaxForm($('#commentForm'), "getCommentList()");
        }
    });
    

//    // 댓글 답변 쓰기
//    $(document).on('click', '.btn-comment-reply-insert', function(){
//        var f = document.commentForm;
//        var obj;
//
//        obj = $('#reply-comment');
//        if (obj.val() == "") {
//            alert("댓글을 입력하세요.");
//            setFocus(obj);
//            return false;
//        }
//
//        var msg = "등록하시겠습니까?";
//        if (confirm(msg)) {
//            jQueryAjaxForm($('#commentReplyForm'), "getCommentList()");
//        }
//    });
    

    // 댓글 수정
    $(document).on('click', '.btn-comment-update', function(){
        var f = document.commentForm;
        var obj;

        obj = $('#update-comment');
        if (obj.val() == "") {
            alert("댓글을 입력하세요.");
            setFocus(obj);
            return false;
        }

        var msg = "수정하시겠습니까?";
        if (confirm(msg)) {
            jQueryAjaxForm($('#commentUpdateForm'), "getCommentList()");
        }
    });
    
    
    // 댓글 답변 폼 띄우기
//    var old_c_no = "";
//    $(document).on('click', '.btn-comment-reply-form', function(){
//        var c_no = $(this).data('c_no');
//        if (document.getElementById('comment-reply') && c_no == old_c_no) {
//            closeCommentReply();
//        } else {
//            closeCommentReply();
//            
//            var url = "<?=$this->board_path?>commentReplyForm?board_code=<?=$boardconfig->board_code?>&seq=<?=$board->seq?>&c_no="+c_no;
//            
//            $.get(url, function(data,status){
//                if (status == "success") {
//                    $('#comment-'+c_no).after(data);
//                } else {
//                    alert("웹페이지를 여는동안 에러가 발생하였습니다.");
//                }
//            });
//            old_c_no = c_no;
//        }
//    });


    // 댓글 답변 폼 닫기
//    $(document).on('click', '.btn-comment-reply-close', function(){
//        closeCommentReply();
//    });

    
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
                    alert("웹페이지를 여는동안 에러가 발생하였습니다.");
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
        var msg = "삭제하시겠습니까?";
        if (confirm(msg)) {
            var c_no = $(this).data('c_no');
            var url = "<?=$this->board_path?>deleteComment?board_code=<?=$boardconfig->board_code?>&c_no="+c_no;
            
            $.get(url, function(data,status){
                if (status == "success") {
                    getCommentList();
                } else {
                    alert("웹페이지를 여는동안 에러가 발생하였습니다.");
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
                            <?=$board->title?>
                        </h4>
                        <div class="bg-gray clearfix" style="padding: 10px 0;">
                            <div class="col-sm-4">글쓴이 : <?=$board->name?> </div>
                            <div class="col-sm-8 text-right">
                                <span style="color: #999999; margin-right: 7px;">조회</span> <span><?=$board->view_count?></span>
                                <span style="color: #999999; padding: 0 10px; ">|</span>
                                <span><?=date('Y년m월d일', strtotime($board->regist_date))?></span>
                            </div>
                        </div>
                        <div class="clearfix" style="min-height: 200px; padding: 15px 0;">
                            <?php
                            if ($fileList) {
                            ?>
                            <!-- 첨부파일 -->
                            <div class="col-sm-12 text-right" style="padding-bottom: 10px;">
                                <span style="color: #999999;">첨부파일</span>
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
                    <?php if ($board->is_notice == "N") { ?><a href="<?=$this->board_path?>updateNotice?<?=$params?>&page=<?=$page?>&seq=<?=$board->seq?>" class="btn bg-purple btn-sm" style="width:60px;">공지</a><?php } ?>
                </div>
                <div class="col-xs-6 horizon-padding-none text-right">
                    <a href="/mgr/board?<?=$params?>&page=<?=$page?>" class="btn btn-success btn-sm" style="width:60px;">목록</a>
                    <a href="<?=$this->board_path?>update?<?=$params?>&page=<?=$page?>&seq=<?=$board->seq?>" class="btn btn-primary btn-sm" style="width:60px;">수정</a>
                    <button type="button" class="btn btn-danger btn-sm btn-delete" style="width:60px;">삭제</button>
                </div>
            </div>
            
            
            
            <?php
            if ($boardconfig->is_comment == "Y") {
            ?>
            <div id="board-comment"></div>
            <?php
            }
            ?>
            
            <!-- 이전글 다음글 정보 -->
            <?php
            if (isset($prev_board) && $prev_board || isset($next_board) && $next_board) {
            ?>
            <div class="box">
                <div class="box-body clearfix">
                    <?php
                        if (isset($prev_board) && $prev_board) {
                            if($prev_board->is_notice == 'Y') {
                                $is_notice = '<span style="font-weight: bold; color: #F4543C;">[공지]</span>';
                            } else {
                                $is_notice = "";
                            }
                    ?>
                    <div class="form-group">
                        <div class="col-xs-2 horizon-padding-none">
                            <a href="<?=$this->board_path?>view?<?=$params?>&page=<?=$page?>&seq=<?=$prev_board->seq?>"><i class="fa fa-angle-up"></i><span style="font-weight: bold;">이전 글</span></a>
                        </div>
                        <div class="col-xs-8 horizon-padding-none">
                            <a href="<?=$this->board_path?>view?<?=$params?>&page=<?=$page?>&seq=<?=$prev_board->seq?>"><?=$is_notice?><span style="font-weight: bold;"><?=$prev_board->title?></span></a>
                        </div>
                        <div class="col-xs-2 horizon-padding-none">
                            <span style="font-weight: bold;"><?=date('Y-m-d', strtotime($prev_board->regist_date))?></span>
                        </div>
                    </div>
                    <?php
                    }
                        if (isset($next_board) && $next_board) {
                            if($next_board->is_notice == 'Y') {
                                $is_notice = '<span style="font-weight: bold; color: #F4543C;">[공지]</span>';
                            } else {
                                $is_notice = "";
                            }
                    ?>
                    <hr style="margin-top: 30px; margin-bottom: 10px;">
                    <div class="form-group">
                        <div class="col-xs-2 horizon-padding-none">
                            <a href="<?=$this->board_path?>view?<?=$params?>&page=<?=$page?>&seq=<?=$next_board->seq?>"><i class="fa fa-angle-down"></i><span style="font-weight: bold;">다음 글</span></a>
                        </div>
                        <div class="col-xs-8 horizon-padding-none">
                            <a href="<?=$this->board_path?>view?<?=$params?>&page=<?=$page?>&seq=<?=$next_board->seq?>"><?=$is_notice?><span style="font-weight: bold;"><?=$next_board->title?></span></a>
                        </div>
                        <div class="col-xs-2 horizon-padding-none">
                            <span style="font-weight: bold;"><?=date('Y-m-d', strtotime($next_board->regist_date))?></span>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>

            
            
        </div>
	</div>   <!-- /.row -->
</section>

<style type="text/css">
    .auth label { margin-right: 10px; }
</style>
<script type="text/javascript">
    $(document).ready(function(){
    // Replace the <textarea id="editor1"> with a CKEditor
    CKEDITOR.replace( 'board_speech', {
        filebrowserUploadUrl: '/editor/upload'
    });

    $('#btn-confirm').click(function() {
        var f = document.frm;
        var obj;

        obj = $('#board_skin');
            if (obj.val() == "") {
                alert("게시판을 선택해주세요.");
                setFocus(obj);
                return false;
            }

        obj = $('#board_name');
        if (obj.val() == "") {
            alert("게시판 이름은 필수 입력사항입니다.");
            setFocus(obj);
            return;
        }

        var yn = confirm("수정하시겠습니까?");
        if (yn) {
            //selectCategoryAll();		// 카테고리 옵션 모두 선택
            f.submit();
        } else {
            return;
        }
    });
});

    $(document).on('click', '#btn-delete', function(){
        var yn = "삭제하시겠습니까?";
        
        if (confirm(yn)) {
            location.href = '/mgr/boardconfig/delete?board_code=<?=$boardconfig->board_code?>';
        }
    });
    

</script>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-body">
                    <form id="frm" name="frm" method="post" action="/mgr/boardconfig/update?board_code=<?=$boardconfig->board_code?>" onsubmit="return false;" class="form-horizontal" role="form">
                        <input type="hidden" name="page" value="<?=$page?>">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시판 코드</label>
                            <div class="col-sm-2">
                                <input type="text" id="board_code" name="board_code" class="form-control input-sm" value="<?=$boardconfig->board_code?>" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시판 분류</label>
                            <div class="col-sm-2">
                                <select id="board_skin" name="board_skin" class="form-control input-sm group_part">
                                    <option value="">== 게시판 ==</option>
                                    <?php
                                    if ($boardCodeList) {
                                        foreach($boardCodeList as $i => $list){
                                    ?>
                                    <option value="<?=$list->value1?>"<?=($boardconfig->board_skin == $list->value1) ? " selected='selected'" : "" ?>><?=$list->code_name?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <p id="warnmsg" style="margin-top: 6px; color: red;"></p>
                            </div>
                        </div>
                        <div id="group-select"></div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시판 이름</label>
                            <div class="col-sm-4">
                                <input type="text" id="board_name" name="board_name" class="form-control input-sm" value="<?=$boardconfig->board_name?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> 게시판 머릿글</label>
                            <div class="col-sm-9">
                                <textarea id="board_speech" name="board_speech" rows="10" cols="80"><?=$boardconfig->board_speech?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시판 사용</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_use" class="minimal" value="Y"<?php if ($boardconfig->is_use == "Y") echo " checked"; ?>/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_use" class="minimal" value="N"<?php if ($boardconfig->is_use == "N") echo " checked"; ?>/> X
                                </label>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 댓글</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_comment" class="minimal" value="Y"<?php if ($boardconfig->is_comment == "Y") echo " checked"; ?>/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_comment" class="minimal" value="N"<?php if ($boardconfig->is_comment == "N") echo " checked"; ?>/> X
                                </label>
                            </div>
                        </div>
                        <!--div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 비밀글</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_secret" class="minimal" value="Y"<?php if ($boardconfig->is_secret == "Y") echo " checked"; ?>/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_secret" class="minimal" value="N"<?php if ($boardconfig->is_secret == "N") echo " checked"; ?>/> X
                                </label>
                            </div>
                        </div-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 이미지첨부</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_image" class="minimal" value="Y"<?php if ($boardconfig->is_image == "Y") echo " checked"; ?>/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_image" class="minimal" value="N"<?php if ($boardconfig->is_image == "N") echo " checked"; ?>/> X
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 파일첨부</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_file" class="minimal" value="Y"<?php if ($boardconfig->is_file == "Y") echo " checked"; ?>/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_file" class="minimal" value="N"<?php if ($boardconfig->is_file == "N") echo " checked"; ?>/> X
                                </label>
                            </div>
                        </div>

                        <h4 class="page-header"></h4>
                        <div class="form-group text-center">
                            <button type="button" id="btn-confirm" class="btn btn-primary btn-sm" style="width:60px;">저장</button>
                            <button type="button" id="btn-delete" class="btn btn-danger btn-sm" style="width:60px;">삭제</button>
                            <a href="mgr/boardconfig" class="btn btn-success btn-sm" style="width:60px;">목록</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
	</div>   <!-- /.row -->
</section>

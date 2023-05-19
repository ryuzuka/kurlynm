<script type="text/javascript">
	$(document).ready(function(){
        // Replace the <textarea id="editor1"> with a CKEditor
        var ckeditor = CKEDITOR.replace( 'content', {
            filebrowserUploadUrl: '/editor/ckupload'
        });
        
        $('#btn-confirm').click(function() {
            var f = document.frm;
            var obj;
            
            obj = $('#title');
            if (obj.val() == "") {
                alert("제목을 입력하십시오.");
                setFocus(obj);
                return;
            }

            if (ckeditor.getData() == "") {
                alert("내용을 입력하십시오.");
                ckeditor.focus();
                return;
            }

            var yn = confirm("수정하시겠습니까?");
            if (yn) {
                f.submit();
            } else {
                return;
            }
        });
    });
</script>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-body">
                    <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="<?=$this->board_path?>update?<?=$params?>&page=<?=$page?>&seq=<?=$board->seq?>" onsubmit="return false;" class="form-horizontal" role="form">
                    <input type="hidden" name="road_part" value="<?=$board->road_part?>">
                    <h4 class="page-header">글수정</h4>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 기수</label>
                            <div class="col-sm-2">
                                <input type="text" id="group_cd" name="group_cd" class="form-control input-sm" value="<?=$board->group_cd?>" readonly="">
                            </div>
                        </div>
                        <?php if ($board->road_part != 0)  {?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 조</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control input-sm" value="<?=$board->road_part?>" readonly="">
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 이름</label>
                            <div class="col-sm-3">
                                <input type="text" id="name" name="name" maxlength="20" class="form-control input-sm" placeholder="이름" value="<?=$board->name?>" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                            <div class="col-sm-6">
                                <input type="text" id="title" name="title" maxlength="100" class="form-control input-sm" placeholder="글제목" value="<?=$board->title?>">
                            </div>
                        </div>
                    
                        <?php
                        // 이미지 파일 업로드
                        if ($boardconfig->is_image == "Y") {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> 이미지 첨부</label>
                            <div class="col-sm-4">
                                <?php
                                if ($imageList) {
                                    foreach($imageList as $i => $list){
                                        $image_url = str_replace($this->global_root_path, "", $list->full_path);
                                ?>
                                <input type="hidden" name="image_file_no" value="<?=$list->file_no?>">
                                <span style="margin-right: 20px;">현재파일 : <a href="<?=$image_url?>" target="_blank"><?=$list->file_name?></a></span>
                                <input type="checkbox" name="image_file_delete" value="Y"> 삭제
                                <input type="file" name="image_file" class="board-image form-control input-sm" value="">
                                <?php
                                    }
                                } else {
                                ?>
                                <input type="hidden" name="image_file_no" value="">
                                <input type="hidden" name="image_delete" value="">
                                <input type="file" name="image_file" class="board-image form-control input-sm" value="">
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        }
                        
                        // 첨부 파일 업로드
                        if ($boardconfig->is_file == "Y") {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> 파일 첨부</label>
                            <div class="col-sm-4">
                                <?php
                                if ($fileList) {
                                    foreach($fileList as $i => $list){
                                        $file_url = str_replace($this->global_root_path, "", $list->full_path);
                                ?>
                                <input type="hidden" name="file_no" value="<?=$list->file_no?>">
                                <span style="margin-right: 20px;">현재파일 : <a href="<?=$this->board_path?>download?board_code=<?=$boardconfig->board_code?>&file_no=<?=$list->file_no?>"><?=$list->file_name?></a></span>
                                <input type="checkbox" name="file_delete" value="Y"> 삭제
                                <input type="file" name="file" class="board-file form-control input-sm" value="">
                                <?php
                                    }
                                } else {
                                ?>
                                <input type="hidden" name="file_no" value="">
                                <input type="hidden" name="file_delete" value="">
                                <input type="file" name="file" class="board-file form-control input-sm" value="">
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 내용</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="content" rows="10" cols="80"><?=$board->content?></textarea>
                            </div>
                        </div>
                    
                    <h4 class="page-header"></h4>
                        <div class="form-group text-center">
                            <button type="button" id="btn-confirm" class="btn btn-primary btn-sm" style="width:60px;">확인</button>
                            <a href="<?=$this->board_path?>view?<?=$params?>&seq=<?=$board->seq?>&page=<?=$page?>" class="btn btn-warning btn-sm" style="width:60px;">취소</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
	</div>   <!-- /.row -->
</section>

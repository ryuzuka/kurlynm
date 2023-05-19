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

            var yn = confirm("등록하시겠습니까?");
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
                    <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="<?=$this->board_path?>insert?board_code=<?=$boardconfig->board_code?>" onsubmit="return false;" class="form-horizontal" role="form">
                        <input type="hidden" name="road_part" value="">
                        <input type="hidden" name="group_cd" value="<?=$group->ot_group_cd?>">
                        <input type="hidden" name="re_group" value="<?=$board ? $board->re_group : ""?>">
                        <input type="hidden" name="re_step" value="<?=$board ? $board->re_step : ""?>">
                        <input type="hidden" name="re_level" value="<?=$board ? $board->re_level : ""?>">
                    <h4 class="page-header">글쓰기</h4>
                    <!--<div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 기수</label>
                            <div class="col-sm-2">
                                <input type="text" id="group_cd" name="group_cd" class="form-control input-sm" value="<?=$group->ot_group_cd?>" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 조 선택</label>
                            <div class="col-sm-2">
                                <select id="road_part" name="road_part" class="form-control input-sm group_part">
                                    <option value="">== 조 선택 ==</option>
                                    <?php
                                    for ($i=1; $i<=10; $i++) {
                                    ?>
                                    <option value="<?=$i?>"><?=$i?>조</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 이름</label>
                            <div class="col-sm-3">
                                <input type="text" id="name" name="name" maxlength="20" class="form-control input-sm" placeholder="이름" value="<?=($this->session->userdata('AID')) ? "운영사무국" : $this->session->userdata('UName')?>" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                            <div class="col-sm-6">
                                <input type="text" id="title" name="title" maxlength="100" class="form-control input-sm" placeholder="글제목" value="<?php if ($board) { echo "Re : ".$board->subject; } else { echo set_value('subject'); } ?>">
                            </div>
                        </div>
                        <?php
                        if ($boardconfig->is_image == "Y") {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> 이미지 첨부</label>
                            <div class="col-sm-4">
                                <input type="file" name="image_file" class="board-image form-control input-sm" value="">
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        
                        <?php
                        if ($boardconfig->is_file == "Y") {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> 파일 첨부</label>
                            <div class="col-sm-4">
                                <input type="file" name="file" class="board-file form-control input-sm" value="">
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 내용</label>
                            <div class="col-sm-8">
                                <textarea id="content" name="content" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                    
                    <h4 class="page-header"></h4>
                        <div class="form-group text-center">
                            <button type="button" id="btn-confirm" class="btn btn-primary btn-sm" style="width:60px;">확인</button>
                            <button type="button" class="btn btn-warning btn-sm" style="width:60px;" onclick="location.href='<?=$this->board_path?>?<?=$params?>&page=<?=$page?>';">취소</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
	</div>   <!-- /.row -->
</section>


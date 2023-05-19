<script type="text/javascript">
	// 필수 입력 값 포커스 이동
	function setFocus(obj){
		obj.focus();
		obj.css('background', '#ff0'); // will change the background to red
	}

    
	$(document).ready(function(){
        // Replace the <textarea id="editor1"> with a CKEditor
        var ckeditor = CKEDITOR.replace( 'content', {
            filebrowserUploadUrl: '/editor/ckupload'
        });
        
        $('#btn-confirm').click(function() {
            var f = document.frm;
            var obj;

            obj = $('#name');
            if (obj.val() == "") {
                alert("이름을 입력하십시오.");
                setFocus(obj);
                return;
            }
            
            <?php
            if ($boardconfig->board_category) {
            ?>
            obj = $('#category');
            if (obj.val() == "") {
                alert("Please Enter Category.");
                setFocus(obj);
                return;
            }
            <?php
            }
            ?>

            obj = $('#subject');
            if (obj.val() == "") {
                alert("Please Enter Title.");
                setFocus(obj);
                return;
            }

            obj = $('#image1');
            if (obj.val() == "") {
                alert("Please Select Image.");
                setFocus(obj);
                return;
            }

            if (ckeditor.getData() == "") {
                alert("Please Enter Content.");
                ckeditor.focus();
                return;
            }

            var yn = confirm("Would you like to Register?");
            if (yn) {
                f.submit();
            } else {
                return;
            }
        });
        
        
        $("#image_cnt").change(function(){
            $("#image_cnt option:selected").each(function(){
                var cnt = $(this).val();
                var tot = $(".board-image").length;
                for (var i=1; i<=tot; i++) {
                    if (i <= cnt) {
                        $(".board-image:eq("+(i-1)+")").css("display", "");
                    } else {
                        $(".board-image:eq("+(i-1)+")").css("display", "none").val("");
                    }
                }
            });
        }); 
        
        $("#file_cnt").change(function(){
            $("#file_cnt option:selected").each(function(){
                var cnt = $(this).val();
                var tot = $(".board-file").length;
                for (var i=1; i<=tot; i++) {
                    if (i <= cnt) {
                        $(".board-file:eq("+(i-1)+")").css("display", "");
                    } else {
                        $(".board-file:eq("+(i-1)+")").css("display", "none").val("");
                    }
                }
            });
        }); 

    });
</script>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-body">
                    <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="<?=$this->board_path?>insert?board_code=<?=$boardconfig->board_code?>" onsubmit="return false;" class="form-horizontal" role="form">
                        <input type="hidden" name="re_group" value="<?=$board ? $board->re_group : ""?>">
                        <input type="hidden" name="re_step" value="<?=$board ? $board->re_step : ""?>">
                        <input type="hidden" name="re_level" value="<?=$board ? $board->re_level : ""?>">
                    <h4 class="page-header">Gallery Registration</h4>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Name</label>
                            <div class="col-sm-3">
                                <input type="text" id="name" name="name" maxlength="20" class="form-control input-sm" placeholder="Name" value="<?=($this->session->userdata('AID')) ? "Admin" : $this->session->userdata('UName')?>">
                            </div>
                        </div>
                        <?php
                        if ($boardconfig->board_category) {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Category</label>
                            <div class="col-sm-8">
                                <select name="category" id="category" class="form-control input-sm" style="width: auto; display: inline; vertical-align: middle; margin-right: 10px;">
                                    <option value="">== 선택 ==</option>
                                    <?php
                                    foreach($boardconfig->board_category as $key => $value){
                                        if ($board && $board->category == $value) {     // 답변 글 작성시..
                                    ?>
                                    <option value="<?=$value?>" selected><?=$value?></option>
                                    <?php
                                        } else if (!$board) {       // 답변글이 아닌 일반 글 작성시..
                                    ?>
                                    <option value="<?=$value?>"><?=$value?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('cotegory'); ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Title</label>
                            <div class="col-sm-9">
                                <input type="text" id="subject" name="subject" maxlength="100" class="form-control input-sm" placeholder="Title" value="<?php if ($board) { echo "Re : ".$board->subject; } else { echo set_value('subject'); } ?>">
                                <?php echo form_error('subject'); ?>
                            </div>
                        </div>
                        <?php
                        if ($boardconfig->is_image == "Y") {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> Image Attach</label>
                            <div class="col-sm-8">
                                <input type="file" id="image1" name="image1" class="board-image form-control input-sm" value="">
                                <input type="file" name="image2" class="board-image form-control input-sm" style="display: none;" value="">
                                <input type="file" name="image3" class="board-image form-control input-sm" style="display: none;" value="">
                                <input type="file" name="image4" class="board-image form-control input-sm" style="display: none;" value="">
                                <input type="file" name="image5" class="board-image form-control input-sm" style="display: none;" value="">
                            </div>
                            <div class="col-sm-2">
                                <select name="image_cnt" id="image_cnt" class="form-control input-sm" style="width: auto; display: inline; vertical-align: middle; margin-right: 10px;">
                                    <?php
                                    for ($i=1; $i<=5; $i++) {
                                    ?>
                                    <option value="<?=$i?>"><?=$i?>개</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        }
                        
                        if ($boardconfig->is_file == "Y") {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> File Attach</label>
                            <div class="col-sm-8">
                                <input type="file" name="file1" class="board-file form-control input-sm" value="">
                                <input type="file" name="file2" class="board-file form-control input-sm" style="display: none;" value="">
                                <input type="file" name="file3" class="board-file form-control input-sm" style="display: none;" value="">
                                <input type="file" name="file4" class="board-file form-control input-sm" style="display: none;" value="">
                                <input type="file" name="file5" class="board-file form-control input-sm" style="display: none;" value="">
                            </div>
                            <div class="col-sm-2">
                                <select name="file_cnt" id="file_cnt" class="form-control input-sm" style="width: auto; display: inline; vertical-align: middle; margin-right: 10px;">
                                    <?php
                                    for ($i=1; $i<=5; $i++) {
                                    ?>
                                    <option value="<?=$i?>"><?=$i?>개</option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Content</label>
                            <div class="col-sm-10">
                                <textarea id="content" name="content" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                    
                    <h4 class="page-header"></h4>
                        <div class="form-group text-center">
                            <button type="button" id="btn-confirm" class="btn btn-primary btn-sm" style="width:60px;">Save</button>
                            <button type="button" class="btn btn-warning btn-sm" style="width:60px;" onclick="location.href='<?=$this->board_path?>?board_code=<?=$boardconfig->board_code?>';">Back</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
	</div>   <!-- /.row -->
</section>

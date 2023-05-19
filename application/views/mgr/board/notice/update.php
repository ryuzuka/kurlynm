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
                alert("Please Enter Name.");
                setFocus(obj);
                return;
            }
            
            <?php
            if ($boardconfig->board_category) {
            ?>
            obj = $('#category');
            if (obj.val() == "") {
                alert("Please Select Category.");
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

            if (ckeditor.getData() == "") {
                alert("Please Enter Content.");
                ckeditor.focus();
                return;
            }

            var yn = confirm("Would you like to Modify?");
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
                    <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="<?=$this->board_path?>update?<?=$params?>&page=<?=$page?>&seq=<?=$board->seq?>" onsubmit="return false;" class="form-horizontal" role="form">
                    <h4 class="page-header">Notice Modify</h4>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Name</label>
                            <div class="col-sm-3">
                                <input type="text" id="name" name="name" maxlength="20" class="form-control input-sm" placeholder="Name" value="<?=$board->name?>">
                            </div>
                        </div>
                        <?php
                        if ($boardconfig->board_category) {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Category</label>
                            <div class="col-sm-8">
                                <select name="category" id="category" class="form-control input-sm" style="width: auto; display: inline; vertical-align: middle; margin-right: 10px;">
                                    <option value="">== Select ==</option>
                                    <?php
                                    foreach($boardconfig->board_category as $key => $value){
                                    ?>
                                    <option value="<?=$value?>"<?php if ($board->category == $value) echo " selected"; ?>><?=$value?></option>
                                    <?php
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
                                <input type="text" id="subject" name="subject" maxlength="100" class="form-control input-sm" placeholder="Title" value="<?=$board->subject?>">
                                <?php echo form_error('subject'); ?>
                            </div>
                        </div>
                    
                        <?php
                        // 이미지 파일 업로드
                        if ($boardconfig->is_image == "Y") {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> Image Attach</label>
                            <div class="col-sm-8">
                                <?php
                                if ($imageList) {
                                    foreach($imageList as $i => $list){
                                        $image_url = str_replace($this->global_root_path, "", $list->full_path);
                                ?>
                                <input type="hidden" name="image<?=$i+1?>_file_no" value="<?=$list->file_no?>">
                                <span style="margin-right: 20px;"><?=$i+1?>. Current Image : <a href="<?=$image_url?>" target="_blank"><?=$list->file_name?></a></span>
                                <input type="checkbox" name="image<?=$i+1?>_delete" value="Y"> Delete
                                <input type="file" name="image<?=$i+1?>" class="board-image form-control input-sm" value="">
                                <?php
                                    }
                                } else {
                                    $i = -1;
                                }
                                
                                $cnt = $i+1;
                                $cnt_select = $cnt;
                                if ($cnt == 0) $cnt_select = 1;
                                
                                for ($m=$cnt; $m<5; $m++) {
                                ?>
                                <input type="hidden" name="image<?=$m+1?>_file_no" value="">
                                <input type="hidden" name="image<?=$m+1?>_delete" value="">
                                <input type="file" name="image<?=$m+1?>" class="board-image form-control input-sm"<?php if ($m > 0) { ?> style="display: none;"<?php } ?> value="">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-2">
                                <select name="image_cnt" id="image_cnt" class="form-control input-sm" style="width: auto; display: inline; vertical-align: middle; margin-right: 10px;">
                                    <?php
                                    for ($i=$cnt_select; $i<=5; $i++) {
                                    ?>
                                    <option value="<?=$i?>"<?php if ($cnt_select == $i) echo " selected"; ?>><?=$i?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        }
                        
                        // 첨부 파일 업로드
                        if ($boardconfig->is_file == "Y") {
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> File Attach</label>
                            <div class="col-sm-8">
                                <?php
                                if ($fileList) {
                                    foreach($fileList as $i => $list){
                                        $file_url = str_replace($this->global_root_path, "", $list->full_path);
                                ?>
                                <input type="hidden" name="file<?=$i+1?>_file_no" value="<?=$list->file_no?>">
                                <span style="margin-right: 20px;"><?=$i+1?>. Current File : <a href="<?=$this->board_path?>download?board_code=<?=$boardconfig->board_code?>&file_no=<?=$list->file_no?>"><?=$list->file_name?></a></span>
                                <input type="checkbox" name="file<?=$i+1?>_delete" value="Y"> Delete
                                <input type="file" name="file<?=$i+1?>" class="board-file form-control input-sm" value="">
                                <?php
                                    }
                                } else {
                                    $i = -1;
                                }
                                
                                $cnt = $i+1;
                                $cnt_select = $cnt;
                                if ($cnt == 0) $cnt_select = 1;
                                
                                for ($m=$cnt; $m<5; $m++) {
                                ?>
                                <input type="hidden" name="file<?=$m+1?>_file_no" value="">
                                <input type="hidden" name="file<?=$m+1?>_delete" value="">
                                <input type="file" name="file<?=$m+1?>" class="board-file form-control input-sm"<?php if ($m > 0) { ?> style="display: none;"<?php } ?> value="">
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-2">
                                <select name="file_cnt" id="file_cnt" class="form-control input-sm" style="width: auto; display: inline; vertical-align: middle; margin-right: 10px;">
                                    <?php
                                    for ($i=$cnt_select; $i<=5; $i++) {
                                    ?>
                                    <option value="<?=$i?>"<?php if ($cnt_select == $i) echo " selected"; ?>><?=$i?></option>
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
                                <textarea id="content" name="content" rows="10" cols="80"><?=$board->content?></textarea>
                            </div>
                        </div>
                    
                    <h4 class="page-header"></h4>
                        <div class="form-group text-center">
                            <button type="button" id="btn-confirm" class="btn btn-primary btn-sm" style="width:60px;">Save</button>
                            <a href="<?=$this->board_path?>view?<?=$params?>&seq=<?=$board->seq?>&page=<?=$page?>" class="btn btn-warning btn-sm" style="width:60px;">Back</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
	</div>   <!-- /.row -->
</section>

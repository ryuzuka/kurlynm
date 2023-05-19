<style type="text/css">
    .auth label { margin-right: 10px; }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        CKEDITOR.replace('board_speech', {
            filebrowserUploadUrl: '/editor/ckupload'
        });

        $('#btn-confirm').click(function () {
            var f = document.frm;
            var obj;
            
            obj = $('#board_code');
            if (obj.val() == "") {
                alert("게시판 코드는 필수 입력사항입니다.");
                setFocus(obj);
                return false;
            } else {
                var rtn = checkCode();
                if (rtn > 0) {
                    alert("중복된 코드입니다.");
                    return false;
                }
            }

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
                return false;
            }
            
            var yn = confirm("등록하시겠습니까??");
            if (yn) {
                //selectCategoryAll();		// 카테고리 옵션 모두 선택
                f.submit();
            } else {
                return false;
            }
        });
    });
    
    function checkCode() {
        var board_code = $('#board_code').val();
        var rtn = "";
        $.ajax({
            type:"GET",
            url: "/mgr/boardconfig/checkBoardCode",
            async: false,
            data : { "board_code" : board_code},
            dataType : "text",
            success: function(data){
                
                console.log(data);
                if(data > 0) {
                    $('#warnmsg').text('중복된 코드입니다.');
                } else {
                    $('#board_code').val(board_code);
                    $('#warnmsg').text('');
                    console.log(board_code);
                }
                
               rtn = data;
            },
            error: function(error) {
                    alert("Error Occurred!!"+ error);
            }	
        });
        return rtn;
    }
    
    //게시판 selectBox선택
//    $(document).on('change', '#board_skin', function(){
//        var board_skin = $(this).val();
//        
//        if (board_skin == 'ot' || board_skin == 'club') {
//            selectGroup();
//        } else {
//            $("#group-select").html("");
//        }
//    });
    
//    function selectGroup() {
//        var url = "/mgr/boardconfig/getPartSelect";
//        jQueryAjaxView(url, $('#group-select'));
//    }
    
//    //selectBox 기수 가져오기
//    $(document).on('change', '#group_cd', function(){
//        var group_text = $('#group_cd option:selected').text();
//        
//        var group = group_text.substring(0,2);
//        $('#group').val(group);
//    });
    
</script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-body">
                    <form id="frm" name="frm" method="post" action="/mgr/boardconfig/insert" onsubmit="return false;" class="form-horizontal" role="form">
                        <!--    
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 기수</label>
                            <div class="col-sm-2">
                                <select id="group" name="group" class="form-control input-sm group_part">
                                    <option value="">== 기수선택 ==</option>
                                    <?php
                                        if ($groupCodeList) {
                                            foreach($groupCodeList as $i => $list){
                                    ?>
                                    <option value="<?=$list->code?>,<?=$list->value2?>"><?=$list->code_name?> (<?=$list->value1?>년)</option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        -->
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시판 코드</label>
                            <div class="col-sm-2">
                                <input type="text" id="board_code" name="board_code" maxlength="100" value="" oninput="checkCode()" class="form-control input-sm">
                            </div>
                            <div class="col-sm-3">
                                <p id="warnmsg" style="margin-top: 6px; color: red;"></p>
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
                                    <option value="<?=$list->value1?>"><?=$list->code_name?></option>
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
                                <input type="text" id="board_name" name="board_name" maxlength="100" class="form-control input-sm" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FFF;">*</span> 게시판 머릿글</label>
                            <div class="col-sm-9">
                                <textarea id="board_speech" name="board_speech" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 게시판 사용</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_use" class="minimal" value="Y" checked/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_use" class="minimal" value="N"/> X
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 댓글</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_comment" class="minimal" value="Y" checked/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_comment" class="minimal" value="N"/> X
                                </label>
                            </div>
                        </div>
                        <!--div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 비밀글</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_secret" class="minimal" value="Y" checked/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_secret" class="minimal" value="N"/> X
                                </label>
                            </div>
                        </div-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 이미지첨부</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_image" class="minimal" value="Y" checked/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_image" class="minimal" value="N"/> X
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 파일첨부</label>
                            <div class="col-sm-7">
                                <label style="margin-top: 6px;">
                                    <input type="radio" name="is_file" class="minimal" value="Y" checked/> O
                                </label>
                                <label style="margin-left: 50px;">
                                    <input type="radio" name="is_file" class="minimal" value="N"/> X
                                </label>
                            </div>
                        </div>

                        <h4 class="page-header"></h4>
                        <div class="form-group text-center">
                            <button type="button" id="btn-confirm" class="btn btn-primary btn-sm" style="width:60px;">저장</button>
                            <button type="button" class="btn btn-warning btn-sm" style="width:60px;" onclick="history.back();">뒤로</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>   <!-- /.row -->
</section>

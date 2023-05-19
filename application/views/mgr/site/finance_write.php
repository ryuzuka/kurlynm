<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#title');
            if (obj.val() == "") {
                alert("제목을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#file');
            if (obj.val() == "") {
                alert("첨부 파일을 선택해주세요.");
                setFocus(obj);
                return false;
            }

            var yn = confirm("저장하시겠습니까?");
            if (yn) {
                $('#frm').submit();
            } else {
                return false;
            }
        });
        
        $(document).on('click', '.del_file', function() {
            $('#file').val("");
        });
    });
</script>

<style>
    .term { display: none; }
    .del_file_wrap { padding: 10px 0; cursor: pointer; }
</style>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/site/finance_insert" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                        <div class="col-sm-4">
                            <input type="text" id="title" name="title" maxlength="100" class="form-control input-sm">
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 파일 첨부</label>
                        <div class="col-sm-3">
                            <input type="file" id="file" name="file" maxlength="100" class="form-control input-sm" value="">
                        </div>
                        <div class="col-sm-2 del_file_wrap">
                            <span class="del_file">[초기화]</span>
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/finance" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div>
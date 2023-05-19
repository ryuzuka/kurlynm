<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('question_content', {
            filebrowserUploadUrl: '/editor/ckupload'
        });
        
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#member_id');
            if (obj.val() == "") {
                alert("아이디를 입력해주세요.");
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
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
    });
    
    // 회원 검색 팝업 - 관리자
    function openSearchMember(func) {
        window.open("/mgr/member/search?func=" + func, "SearchEmployee", "width=1000,height=600,scrollbars=yes");
    }

    $(document).on('click', '#btn-member', function(){
        openSearchMember('responseFirst');
    });

    function responseFirst(member) {
        $('#member_id').val(member.member_id);        
        $('#member_txt').val(member.member_name+" ("+member.member_id+")");
    }
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/site/question_insert" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 작성자</label>
                        <div class="col-sm-2">
                            <input type="hidden" id="member_id" name="member_id">
                            <input type="text" id="member_txt" name="member_txt" maxlength="50" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-sm-1">
                            <a href="javascript:void(0);" id="btn-member" class="btn btn-default btn-sm" style="width: 100%;">Search</a>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 문의종류</label>
                        <div class="col-sm-2">
                            <select id="question_cd" name="question_cd" class="form-control input-sm">
                                <option value="">== 문의종류선택 ==</option>
                                <?php
                                    if ($questionCodeList) {
                                        foreach($questionCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>"><?=$list->code_name?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                        <div class="col-sm-4">
                            <input type="text" id="question_title" name="question_title" maxlength="100" class="form-control input-sm">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 문의 내용</label>
                        <div class="col-sm-6">
                            <textarea id="question_content" name="question_content" rows="16" cols="80"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 첨부파일</label>
                        <div class="col-sm-3">
                            <input type="file" id="image_file" name="image_file" maxlength="100" class="form-control input-sm" value="">
                        </div>
                    </div>
                    
                </div>

                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/question_list?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: '/editor/ckupload'
        });
        
        $('#btn-submit').click(function () {
            var obj;

            obj = $('#title');
            if (obj.val() == "") {
                alert("제목을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#start_date');
            if (obj.val() == "") {
                alert("시작일을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#end_date');
            if (obj.val() == "") {
                alert("종료일을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#content');
            if(CKEDITOR.instances.content.getData() =='' || CKEDITOR.instances.content.getData().length ==0){
                alert("내용을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#thumb_type');
            if (obj.val() == "I") {
                if($('#file_pc').val() == "") {
                    alert("PC 이미지를 선택해주세요.");
                    setFocus($('#file_pc'));
                    return false;
                }
                
                if($('#file_mo').val() == "") {
                    alert("모바일 이미지를 선택해주세요.");
                    setFocus($('#file_mo'));
                    return false;
                }
            }
            
            obj = $('#thumb_pc1');
            if (obj.val() == "") {
                alert("PC 출력문구 첫째 줄을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#thumb_mo1');
            if (obj.val() == "") {
                alert("모바일 출력문구 첫째 줄을 입력해주세요.");
                setFocus(obj);
                return false;
            }
            
            obj = $('#banner_title');
            if (obj.val() == "") {
                alert("띠배너 출력문구를 입력해주세요.");
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
        
        $('#s_term').change(function () {
            if(this.value == "Y") {
                $(".term").css("display","block");
            } else {
                $(".term").css("display","none");
                $("#start_date").val("");
                $("#end_date").val("");
            }
        });
        
        $(document).on('click', '.del_file_pc', function() {
            $('#file_pc').val("");
        });
        
        $(document).on('click', '.del_file_mo', function() {
            $('#file_mo').val("");
        });
        
        $(document).on('click', '.btn-term', function() {
            var term_day = $(this).attr("data-day");
            var date = new Date();
            var yyyy = date.getFullYear();
            var mm = date.getMonth() + 1;
            var dd = date.getDate();
            
            if (mm < 10) mm = '0' + mm; 
            if (dd < 10) dd = '0' + dd; 
            
            var start_date = yyyy + "-" + mm + "-" + dd;
            
            date = new Date();
            date.setDate(date.getDate() + parseInt(term_day));
            yyyy = date.getFullYear();
            mm = date.getMonth() + 1;
            dd = date.getDate();
            
            if (mm < 10) mm = '0' + mm; 
            if (dd < 10) dd = '0' + dd; 
            
            end_date = yyyy + "-" + mm + "-" + dd;
            
            $("#start_date").val(start_date);
            $("#end_date").val(end_date);
        });
        
        $('#thumb_type').change(function () {
            if(this.value == "I") {
                $(".thumb_img").css("display","contents");
            } else {
                $(".thumb_img").css("display","none");
                $("#file_pc").val("");
                $("#file_mo").val("");
            }
        });
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
    });
</script>

<style>
    .table>tr>td { border-top: 0px !important; }
    .thumb_img { display: none; }
    .del_file_wrap { padding: 10px 0; cursor: pointer; }
</style>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/site/event_insert" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 제목</label>
                        <div class="col-sm-4">
                            <input type="text" id="title" name="title" maxlength="50" class="form-control input-sm">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 진행기간</label>
                        <div class="col-sm-4 term">
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="start_date" name="start_date" class="form-control pull-right calendar">
                                </div>
                            </div>                        
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="end_date" name="end_date" class="form-control pull-right calendar">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 term">
                            <button type="button" class="btn btn-sm btn-term" style="width:60px;" data-day="30">1개월</button>
                            <button type="button" class="btn  btn-sm btn-term" style="width:60px;" data-day="90">3개월</button>
                            <button type="button" class="btn  btn-sm btn-term" style="width:60px;" data-day="180">6개월</button>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 내용</label>
                        <div class="col-sm-7">
                            <textarea id="content" name="content" rows="16" cols="110"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 썸네일</label>
                        
                        <div class="col-sm-10">
                            <table class="table thumb-table">
                                <tr>
                                    <td colspan="4">
                                        <div class="col-sm-2">
                                            <select name="thumb_type" id="thumb_type" class="form-control">
                                                <option value="B">BG 컬러</option>
                                                <option value="I">이미지</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-sm-2 thumb_img">
                                            <span> (등록 가능 확장자 : jpg, gif, png)</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="thumb_img">
                                    <td><span style="color:#FF0000;">*</span> PC 이미지</td>
                                    <td>
                                        <input type="file" id="file_pc" name="file_pc" maxlength="100" class="form-control input-sm">
                                        <div class="col-sm-2 del_file_wrap">
                                            <span class="del_file_pc">[초기화]</span>
                                        </div>
                                    </td>
                                    <td><span style="color:#FF0000;">*</span> 모바일 이미지</td>
                                    <td>
                                        <input type="file" id="file_mo" name="file_mo" maxlength="100" class="form-control input-sm">
                                        <div class="col-sm-2 del_file_wrap">
                                            <span class="del_file_mo">[초기화]</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">PC 출력문구</td>
                                    <td colspan="2">모바일 출력문구</td>
                                </tr>
                                <tr>
                                    <td><span style="color:#FF0000;">*</span> 첫째 줄</td>
                                    <td><input type="text" id="thumb_pc1" name="thumb_pc1" class="form-control input-sm" maxlength="40" placeholder="최대 40자"></td>
                                    <td><span style="color:#FF0000;">*</span> 첫째 줄</td>
                                    <td><input type="text" id="thumb_mo1" name="thumb_mo1" class="form-control input-sm" maxlength="20" placeholder="최대 40자"></td>
                                </tr>
                                <tr>
                                    <td>둘째 줄</td>
                                    <td><input type="text" id="thumb_pc2" name="thumb_pc2" class="form-control input-sm" maxlength="40" placeholder="최대 40자"></td>
                                    <td>둘째 줄</td>
                                    <td><input type="text" id="thumb_mo2" name="thumb_mo2" class="form-control input-sm" maxlength="20" placeholder="최대 20자"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 띠배너 출력문구</label>
                        <div class="col-sm-4">
                            <input type="text" id="banner_title" name="banner_title" maxlength="100" class="form-control input-sm">
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/event?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div>
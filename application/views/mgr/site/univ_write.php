<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {        
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
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/site/univ_insert" class="form-horizontal" role="form" autocomplete="off" enctype="multipart/form-data">                
                <div class="box-header with-border">
                    <h3 class="box-title">기본 정보</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 학교명</label>
                        <div class="col-sm-4">
                            <input type="text" id="univ_name" name="univ_name" maxlength="100" class="form-control input-sm">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 지역</label>
                        <div class="col-sm-7">
                            <input type="text" id="univ_area" name="univ_area" maxlength="20" class="form-control input-sm">
                        </div>
                    </div>
                                        
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 등급</label>
                        <div class="col-sm-3">
                            <input type="text" id="univ_grade" name="univ_grade" maxlength="20" class="form-control input-sm">
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer text-center">
                    <a id="btn-submit" class="btn btn-primary btn-sm" style="width:80px;">저장</a>
                    <a href="/mgr/site/univ_list?<?=$params?>" class="btn btn-warning btn-sm" style="width:80px;">취소</a>
                </div>
            </form>
        </div>

    </div>
</div><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


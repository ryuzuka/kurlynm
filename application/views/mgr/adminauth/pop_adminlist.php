<script>
	$(document).ready(function(){
        //When unchecking the checkbox
        $("#check-all").on('ifUnchecked', function(event) {
            //Uncheck all checkboxes
            $("input[type='checkbox']", ".table").iCheck("uncheck");
        });
        //When checking the checkbox
        $("#check-all").on('ifChecked', function(event) {
            //Check all checkboxes
            $("input[type='checkbox']", ".table").iCheck("check");
        });


        $('#btn-insert').click(function(){
            var len = $('.check-admin:checked').length;
			if (len < 1) {
				alert("적어도 하나 이상 선택하셔야 합니다.");
			} else {
				$('#listForm').submit();
			}
    	});
	});
</script>

<section class="content">
    <h4 class="page-header"><?=$adminMenu->menu_name?></h4>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">    
                
                <form id="listForm" name="listForm" method="post" action="/mgr/adminauth/insert">
                    <input type="hidden" name="menu_code" value="<?=$adminMenu->menu_code?>">
                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <colgroup>
                            <col style="width:60px;">
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check-all" name="check-all"></th>
                                <th>아이디</th>
                                <th>이름</th>
                                <th>연락처</th>
                                <th>등급</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($adminList) {
                                foreach($adminList as $i => $list){
                            ?>
                            <tr>
                                <td><input type="checkbox" name="admin_id[]" class="check-admin" value="<?=$list->admin_id?>"<?php if ($list->check_auth > 0) echo " disabled"; ?>></td>
                                <td><?=$list->admin_id?></td>
                                <td><?=$list->admin_name?></td>
                                <td><?=$list->phone?></td>
                                <td><span data-toggle="tooltip" data-placement="top" title="<?=$list->admin_level_name?>" data-original-title="<?=$list->admin_level_name?>"><?=$list->admin_level?></span></td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="9" class="text-center" style="vertical-align:middle;">등록된 데이터가 없습니다.</td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                </form>
                
                <div style="margin:10px 0;">
                    <div class="col-xs-6">
                        <div class="dataTables_paginate paging_bootstrap" style="float:left;">
                            <div id="pagination">
<!--                                <ul class="tsc_pagination">
                                     Show pagination links 
                                    <li></li>
                                </ul>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 text-right">
                        <button id="btn-insert" class="btn btn-primary btn-sm">권한추가</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).on('change', '#row_count', function(){
        var num = $(this).val();
        $('#limit_size').val(num);
        document.searchForm.submit();
    });
    
    $(document).on('click', '#btn-go', function(){
        var page = $('#go_page').val();
        $('#page').val(page);
        document.searchForm.submit();
    });
    
    function selected(id, name) {
        var member = {
            member_id: id,
            member_name: name
        };
        
        window.opener.<?=$func?>(member);
        window.close();
    }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            회원
            <small>검색</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SEARCH BOX -->
        <div class="box" style="border-top:1px;">
        <form name="searchForm" method="get">
            <input type="hidden" id="limit_size" name="limit_size" value="<?=$limit_size?>">
            <input type="hidden" id="func" name="func" value="<?=$func?>">
            <input type="hidden" id="page" name="page" value="">
            <div>
                <table class="table table-bordered">
                    <colgroup>
                        <col width="10%">
                        <col width="80%">
                        <col width="10%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td><div class="text-center col-xs-12">검색</div></td>
                        <td>
                            <div class="col-xs-3">
                                <select name="s_field" id="s_option" class="form-control input-sm">                                    
                                    <option value="member_name"<?php if($s_field == "member_name") echo " selected"; ?>>이름</option>
                                    <option value="member_id"<?php if($s_field == "member_id") echo " selected"; ?>>아이디</option>
                                    <option value="email"<?php if($s_field == "email") echo " selected"; ?>>이메일</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" name="s_string" class="form-control input-sm" placeholder="search" value="<?=$s_string ? $s_string : ""?>">
                            </div>
                        </td>
                        <td class="text-center">
                            <button type="submit" class="btn btn-info btn-sm" style="width:60px;">Search</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </form>
        </div>


        <div class="row">

            <div class="col-xs-12">            

                <div class="row" style="margin: 0 0 10px 0;">
                    <div class="col-sm-6">
                        <div class="dataTables_length">
                            <select id="row_count" name="row_count" class="form-control input-sm" style="width: 90px;">
                                <option value="15"<?=($limit_size == 15) ? " selected='selected'" : ""?>>15</option>
                                <option value="30"<?=($limit_size == 30) ? " selected='selected'" : ""?>>30</option>
                                <option value="50"<?=($limit_size == 50) ? " selected='selected'" : ""?>>50</option>
                                <option value="100"<?=($limit_size == 100) ? " selected='selected'" : ""?>>100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button id="btn-excel-download" class="btn bg-olive btn-sm" style="width:80px;">다운로드</button>
                    </div>
                </div>

                <div class="box">
                    <div class="box-body table-responsive">
                        <table id="member-list" class="table table-bordered table-hover">
                            <colgroup>
                                <col style="width:5%;">
                                <col style="width:15%;">
                                <col style="width:10%;">
                                <col style="width:15%;">
                                <col>
                                <col style="width:10%;">
                                <col style="width:10%;">
                            </colgroup>
                            <thead>
                                <tr calss="text-center">
                                    <th>No</th>
                                    <th>아이디</th>
                                    <th>이름</th>
                                    <th>휴대전화</th>
                                    <th>이메일</th>
                                    <th>레벨</th>
                                    <th>가입날짜</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($memberList) {
                                    foreach($memberList as $i => $list){
                                        $no = $total_count - ($page_rows * ($page - 1)) - $i;
                                ?>
                                <tr>
                                    <td class="text-center"><?=$no;?></td>
                                    <td><?=$list->member_id?></td>
                                    <td><?=$list->member_name?></td>
                                    <td><?=$list->dec_mobile?></td>
                                    <td><?=$list->dec_email?></td>
                                    <td class="text-center"><?=$list->level?></td>
                                    <td class="text-center"><?=date('Y-m-d', strtotime($list->regist_date))?></td>
                                    <td class="text-center" style="vertical-align:middle;">
                                        <a href="javascript:selected('<?=$list->member_id?>', '<?=$list->member_name?>');" class="btn btn-default btn-sm" style="width: 100%;">Select</a>
                                    </td>
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
                    <div style="margin:10px 0;">
                        <div class="col-xs-6 horizon-padding-none">
                            <div class="dataTables_paginate paging_bootstrap" style="float:left;">
                                <?=$pagination?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

  
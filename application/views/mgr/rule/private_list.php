<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#row_count', function(){
            var num = $(this).val();
            $('#limit_size').val(num);
            document.searchForm.submit();
        });
    });
    
</script>

<style>
    .rule-tab-menu { border: 1px solid #a9a9a9; padding: 6px 20px; border-top-left-radius: 6px; border-top-right-radius: 6px; font-size: 1em; cursor: pointer;; }
    .activetab { background: #dedede; font-weight: 800; }
    .deactivetab { background: #f4f4f4; font-weight: 400; }
</style>

    <div class="row" style="margin-right: 0px; margin-left: 0px;">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title rule-tab-menu deactivetab" style="margin: 0 0 0 5px !important;" onclick="javascript:location.href='private';">개인정보처리방침</div>
                    <div class="box-title rule-tab-menu activetab" style="margin-left: -4px;" onclick="javascript:location.href='private_list';">이전 약관 관리</div>
                </div>
                
                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <colgroup>
                            <col style="width:5%;">
                            <col>
                            <col style="width:14%;">
                            <col style="width:14%;">
                            <col style="width:8%;">
                        </colgroup>
                        <thead>
                            <tr calss="text-center">
                                <th>No</th>
                                <th>적용기간</th>                                
                                <th>등록일</th>
                                <th>수정일</th>
                                <th>이전목록 노출</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($privateList) {
                                foreach($privateList as $i => $list){
                                    $no = $total_count - ($page_rows * ($page - 1)) - $i;
                            ?>
                            <tr>
                                <td class="text-center"><?=$no;?></td>
                                <td><a href="/mgr/rule/private_info?seq=<?=$list->seq?>&<?=$params?>"><?=date('Y-m-d', strtotime($list->start_date))?> ~ <?=date('Y-m-d', strtotime($list->end_date))?></a></td>
                                <td class=""><?=date('Y-m-d', strtotime($list->regist_date))?></td>
                                <td class=""><?php if($list->update_date) { echo date('Y-m-d', strtotime($list->update_date)); } ?></td>
                                <td class="text-center"><?=$list->is_show?></td>
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
                    <div class="col-xs-6 text-right">
                        <a href="/mgr/rule/private" class="btn btn-primary btn-sm" style="width:80px;">등록</a>
                    </div>
                </div>
            </div>
    </div>

<script>
    console.log("Referer : " + document.referrer);
</script>
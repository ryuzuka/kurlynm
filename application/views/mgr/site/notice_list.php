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
        
        $(document).on('click', '.btn-term', function() {
            var term_day = $(this).attr("data-day");
            var date = new Date();
            var yyyy = date.getFullYear();
            var mm = date.getMonth() + 1;
            var dd = date.getDate();
            
            if (mm < 10) mm = '0' + mm; 
            if (dd < 10) dd = '0' + dd; 
            
            var end_date = yyyy + "-" + mm + "-" + dd;
            
            date = new Date();
            date.setDate(date.getDate() - parseInt(term_day));
            yyyy = date.getFullYear();
            mm = date.getMonth() + 1;
            dd = date.getDate();
            
            if (mm < 10) mm = '0' + mm; 
            if (dd < 10) dd = '0' + dd; 
            
            start_date = yyyy + "-" + mm + "-" + dd;
            
            $("#start_date").val(start_date);
            $("#end_date").val(end_date);
            
            $("#s_month").val(term_day);
        });
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
        
        $('.calendar').datepicker().on('changeDate', function (ev) {
            $('.datepicker').hide();
        });
    });
    
</script>

<section class="content">
    <!-- SEARCH BOX -->
    <div class="box" style="border-top:1px;">
    <form name="searchForm" method="get">
        <input type="hidden" id="page" name="page" value="">
        <input type="hidden" id="s_month" name="s_month" value="">
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
                        <div class="col-xs-2">
                            <select name="s_field" id="s_field" class="form-control input-sm">
                                <option value="title"<?php if($s_field == "title") echo " selected"; ?>>제목</option>
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="s_string" class="form-control input-sm" placeholder="search" value="<?=$s_string ? $s_string : ""?>">
                        </div>
                    </td>
                    <td class="text-center" rowspan="2" style="vertical-align: middle;">
                        <button type="submit" class="btn btn-info btn-sm" style="width:60px; height: 40px;">Search</button>
                    </td>
                </tr>
                <tr>
                    <td><div class="text-center col-xs-12">기간</div></td>
                    <td>
                        <div class="col-xs-2">
                            <select name="s_term" id="s_term" class="form-control input-sm">
                                <option value="regist_date"<?php if($s_term == "regist_date") echo " selected"; ?>>등록일</option>
                                <option value="start_date"<?php if($s_term == "start_date") echo " selected"; ?>>시작일</option>
                                <option value="end_date"<?php if($s_term == "end_date") echo " selected"; ?>>종료일</option>
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="start_date" name="start_date" class="form-control pull-right calendar" value="<?=$start_date?>">
                                </div>
                            </div>                        
                            <div class="col-xs-6" style="padding-left: 0;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" id="end_date" name="end_date" class="form-control pull-right calendar" value="<?=$end_date?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" class="btn btn-sm btn-term <?php if($s_month == "30") echo " text-bold"; ?>" style="width:60px;" data-day="30">1개월</button>
                            <button type="button" class="btn  btn-sm btn-term <?php if($s_month == "90") echo " text-bold"; ?>" style="width:60px;" data-day="90">3개월</button>
                            <button type="button" class="btn  btn-sm btn-term <?php if($s_month == "180") echo " text-bold"; ?>" style="width:60px;" data-day="180">6개월</button>
                        </div>
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
                <div class="col-sm-2">
                    <div class="dataTables_length">
                        
                    </div>
                </div>
                <div class="col-sm-3 text-right">
                    
                </div>
            </div>
            
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <colgroup>
                            <col style="width:5%;">
                            <col style="width:5%;">
                            <col>
                            <col style="width:18%;">
                            <col style="width:10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">중요</th>
                                <th class="text-center">제목</th>
                                <th class="text-center">게시기간</th>                                
                                <th class="text-center">등록일</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($noticeList) {
                                foreach($noticeList as $i => $list){
                                    $no = $total_count - ($page_rows * ($page - 1)) - $i;
                            ?>
                            <tr class=" <?php if($list->status == "Y") { echo "text-bold"; } ?>">
                                <td class="text-center"><?=$no;?></td>
                                <td class="text-center"><?=$list->status?></td>
                                <td><a href="/mgr/site/notice_info?seq=<?=$list->seq?>&<?=$params?>"><?=$list->title?></a></td>
                                <td class="text-center">
                                    <?php if($list->start_date) { ?>
                                    <?=date('Y-m-d', strtotime($list->start_date))?> ~ <?=date('Y-m-d', strtotime($list->end_date))?>
                                    <?php } else { ?>
                                    상시
                                    <?php } ?>
                                </td>
                                <td class="text-center"><?=date('Y-m-d', strtotime($list->regist_date))?></td>
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
                        <a href="/mgr/site/notice_insert?<?=$params?>" class="btn btn-primary btn-sm" style="width:80px;">등록</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    console.log("Referer : " + document.referrer);
</script>
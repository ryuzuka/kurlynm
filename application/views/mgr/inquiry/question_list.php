<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#row_count', function() {
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
                                <option value=""<?php if($s_field == "") echo " selected"; ?>>전체</option>
                                <option value="question_title"<?php if($s_field == "question_title") echo " selected"; ?>>제목</option>
                                <option value="question_name"<?php if($s_field == "question_name") echo " selected"; ?>>작성자</option>
                            </select>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="s_string" class="form-control input-sm" placeholder="Keyword" value="<?=$s_string ? $s_string : ""?>">
                        </div>
                    </td>
                    <td class="text-center" rowspan="3" style="vertical-align: middle;">
                        <button type="submit" class="btn btn-info btn-sm" style="width:80px; height: 80px;">Search</button>
                    </td>
                </tr>
                <tr>
                    <td><div class="text-center col-xs-12">기간</div></td>
                    <td>
                        <div class="col-xs-2">
                            <select name="s_term" id="s_term" class="form-control input-sm">
                                <option value="question_date"<?php if($s_term == "question_date") echo " selected"; ?>>문의일</option>
                                <option value="answer_date"<?php if($s_term == "answer_date") echo " selected"; ?>>답변일</option>
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
                <tr>
                    <td><div class="text-center col-xs-12">상태</div></td>
                    <td>
                        <div class="col-xs-2">
                            <select name="s_status" id="s_status" class="form-control input-sm">
                                <option value=""<?php if($s_status == "") echo " selected"; ?>>전체</option>
                                <option value="N"<?php if($s_status == "N") echo " selected"; ?>>답변대기</option>
                                <option value="Y"<?php if($s_status == "Y") echo " selected"; ?>>답변완료</option>
                            </select>
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
                            <col>
                            <col style="width:10%;">
                            <col style="width:12%;">
                            <col style="width:12%;">
                            <col style="width:10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">제목</th>
                                <th class="text-center">이름</th>
                                <th class="text-center">문의일</th>
                                <th class="text-center">답변일</th>
                                <th class="text-center">상태</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($questionList) {
                                foreach($questionList as $i => $list){
                                    $no = $total_count - ($page_rows * ($page - 1)) - $i;
                                    if($list->status == "Y") {
                                        $style_value = "style='font-weight: 400'";
                                        $status_value = "답변완료";
                                    } else {
                                        $style_value = "style='font-weight: 800'";
                                        $status_value = "답변대기";
                                    }
                            ?>
                            <tr <?=$style_value?>>
                                <td class="text-center"><?=$no;?></td>
                                <td><a href="/mgr/inquiry/question_info?seq=<?=$list->seq?>&<?=$params?>"><?=$list->question_title?></a></td>
                                <td class="text-center"><?=$list->question_name?></td>
                                <td class="text-center"><?=date('Y-m-d', strtotime($list->regist_date))?></td>
                                <td class="text-center"><?php if($list->answer_date) { echo date('Y-m-d', strtotime($list->answer_date)); } ?></td>
                                <td class="text-center"><?=$status_value?></td>
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
                    <!--div class="col-xs-6 text-right">
                        <a href="/mgr/site/question_insert?<?=$params?>" class="btn btn-primary btn-sm" style="width:80px;">등록</a>
                    </div-->
                </div>
            </div>
        </div>
    </div>
</section>
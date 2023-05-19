<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
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
        
        $(document).on('click', '#btn-secession', function() {
            var seq = $(this).attr("data-seq");
            $(".secession_content").hide();
            $("#secession_"+seq).show();
        });
        
        $('.calendar').datepicker({format: 'yyyy-mm-dd', todayHighlight: true});
        
        $('.calendar').datepicker().on('changeDate', function (ev) {
            $('.datepicker').hide();
        });
    });
</script>

<style>
    .rule-tab-menu { border: 1px solid #a9a9a9; padding: 6px 20px; border-top-left-radius: 6px; border-top-right-radius: 6px; font-size: 1em; cursor: pointer;; }
    .activetab { background: #dedede; font-weight: 800; }
    .deactivetab { background: #f4f4f4; font-weight: 400; }
    .secession_content {display: none;}
</style>

<section class="content">
    <!-- SEARCH BOX -->
    <div class="box" style="border-top:1px;">
                <div class="box-header with-border">
                    <div class="box-title rule-tab-menu deactivetab" style="margin: 0 0 0 5px !important;" onclick="javascript:location.href='total_list';">회원 목록</div>
                    <div class="box-title rule-tab-menu activetab" style="margin-left: -4px;" onclick="javascript:location.href='secession_list';">탈퇴회원 목록</div>
                </div>
        
        <form name="searchForm" method="get">
            <input type="hidden" id="limit_size" name="limit_size" value="<?=$limit_size?>">
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
                                <select name="s_field" id="s_option" class="form-control input-sm">
                                    <option value="member_name"<?php if($s_field == "member_name") echo " selected"; ?>>이름</option>
                                    <option value="member_tel"<?php if($s_field == "member_tel") echo " selected"; ?>>연락처</option>
                                    <option value="member_email"<?php if($s_field == "member_email") echo " selected"; ?>>이메일</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" name="s_string" class="form-control input-sm" placeholder="search" value="<?=$s_string ? $s_string : ""?>">
                            </div>
                        </td>
                        <td rowspan="2" class="text-center" style="vertical-align: middle;">
                            <button type="submit" class="btn btn-info btn-sm"  style="width:60px; height: 40px;">Search</button>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="text-center col-xs-12">기간</div></td>
                        <td>
                            <div class="col-xs-2">
                                <select name="s_term" id="s_term" class="form-control input-sm">
                                    <option value="regist_date"<?php if($s_term == "question_date") echo " selected"; ?>>가입일</option>
                                    <option value="login_date"<?php if($s_term == "answer_date") echo " selected"; ?>>최종로그인</option>
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
                            <div class="col-xs-5">
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
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <colgroup>
                            <col style="width:5%;">
                            <col style="width:10%;">
                            <col style="width:10%;">
                            <col style="width:10%;">
                            <col style="width:20%;">
                            <col>
                            <col style="width:10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">아이디</th>
                                <th style="text-align: center;">이름</th>
                                <th style="text-align: center;">연락처</th>
                                <th style="text-align: center;">이메일</th>
                                <th style="text-align: center;">탈퇴사유</th>
                                <th style="text-align: center;">탈퇴날짜</th>
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
                                <td class="text-center"><a href="/mgr/member/update?member_id=<?=$list->member_id?>&<?=$params?>"><?=$list->member_id?></a></td>
                                <td class="text-center"><?=$list->member_name?></td>
                                <td class="text-center"><?=$list->dec_tel?></td>
                                <td class="text-center"><?=$list->dec_email?></td>
                                <td class="text-center"><a id="btn-secession" class="btn btn-primary btn-sm" data-seq="<?=$list->member_id?>" style="width:60px;">보기</a></td>
                                <td class="text-center"><?=date('Y-m-d', strtotime($list->update_date))?></td>
                            </tr>
                            <tr id="secession_<?=$list->member_id?>" class="secession_content">
                                <td class="text-center" colspan="2">탈퇴사유</td>
                                <td class="text-center" colspan="5"><?=$list->secession_content?></td>
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
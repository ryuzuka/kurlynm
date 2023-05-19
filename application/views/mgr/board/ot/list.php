<script type="text/javascript">
    $(document).on('change', '#row_count', function(){
        var num = $(this).val();
        $('#limit_size').val(num);
        document.searchForm.submit();
    });
    
    /**************************************************
    ** Excel Upload / Download
    **************************************************/    
    $(document).on('click', '#btn-excel-download', function() {
        var process_nm = "employee";
        var params = "<?=$params?>";
        excelDownload(process_nm, params);
    });
    
    // 다중 checkbox 선택
    $(document).on('click', '#checkAll', function () {
        var totCheck = $('#checkAll').prop("checked");
        if (totCheck) {
            $('.checkno').prop("checked", true);
        } else {
            $('.checkno').prop("checked", false);
        }
    });
    
    // 리스트체크박스 체크시 checkAll해제  
    $(document).on('click', '.checkno', function (){
        if($("input:checkbox[name='checkno[]']:checked").length == $("input:checkbox[name='checkno[]']").length){
            $('#checkAll').prop("checked", true);
        }else{
            $('#checkAll').prop("checked", false);
        }
        
    });
    
    // 다중 checkbox delete
    $(document).on('click', '#btn-delete', function(){
        var cnt = $('input:checkbox[name="checkno[]"]:checked').length
        if (cnt < 1) {
            alert("삭제할 글을 하나 이상 체크하셔야 합니다.");
            return false;
        }

        if (confirm("선택하신 글을 삭제 하시겠습니까?")) {
            $('#listForm').attr('target', 'ifrm');
            $('#listForm').submit();
        }
    });
    
    $(document).on('change', '#road_group', function(){    
        $('#s_road_group').val(this.value);
       document.searchForm.submit();
    });
</script>

<section class="content">
    
    <!-- SEARCH BOX -->
    <div class="box" style="border-top:1px;">
    <form name="searchForm" method="get">
        <input type="hidden" name="board_code" value="<?=$boardconfig->board_code?>">
        <input type="hidden" id="page" name="page" value="">
        <div>
            <table class="table table-bordered">
                <colgroup>
                    <col width="10%">
                    <col width="35%">
                    <col width="10%">
                    <col width="35%">
                </colgroup>
                <tbody>
                <tr>
                    <td><div class="text-center col-xs-12">기수</div></td>
                    <td>
                        <div class="col-xs-12">
                            <select name="s_road_group" id="s_road_group" class="form-control input-sm">
                                <!--<option value="">== 기수전체 ==</option>-->
                                <?php
                                    if ($groupCodeList) {
                                        foreach($groupCodeList as $i => $list){
                                ?>
                                <option value="<?=$list->code?>" <?php if($s_road_group == $list->code) { echo "selected";} ?>><?=$list->code_name?> 기 (<?=$list->value1?>년)</option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td><div class="text-center col-xs-12">검색</div></td>
                    <td>
                        <div class="col-xs-4">
                            <select name="s_field" id="s_field" class="form-control input-sm">
                                <option value="title"<?php if($s_field == "title") echo " selected"; ?>>제목</option>
                                <option value="content"<?php if(isset($s_field) && $s_field == "content") echo " selected"; ?>>내용</option>
                                <option value="name"<?php if(isset($s_field) && $s_field == "name") echo " selected"; ?>>이름</option>
                            </select>
                        </div>
                        <div class="col-xs-8">
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
    
    <div class="row" style="margin: 0 0 10px 0;">
        <div class="col-xs-10 horizon-padding-none text-right" style="line-height: 30px; margin: 6px 0 0 0;">
            <!--<span>총 <b style="color: #367FA9;"><?=$total_count?></b>개의 글이 등록되어 있습니다.</span>-->
            <!--<a href="<?=$this->board_path?>excel?<?=$params?>" class="btn bg-olive btn-sm" style="width: 80px;">다운로드</a>-->
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form id="listForm" name="listForm" method="post" action="<?=$this->board_path?>chkdelete?<?=$params?>&page=<?=$page?>" class="form-horizontal" role="form">
                <div class="box-body table-responsive">
                    <table class="table table-sub table-bordered responsive">
                        <colgroup>
                            <col width="3%">
                            <col width="5%">
                            <col width="5%">
                            <col width="*">
                            <col width="5%">
                            <col width="12%">
                            <col width="12%">
                            <col width="7%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center" style="vertical-align:middle;"><input type="checkbox" id="checkAll" name="checkAll"></th>
                                <th class="text-center">No</th>
                                <th class="text-center">기수</th>
                                <th class="text-center">제목</th>
                                <th class="text-center">파일</th>
                                <th class="text-center">작성자</th>
                                <th class="text-center">작성일</th>
                                <th class="text-center">조회수</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($noticeList) {
                                foreach($noticeList as $i => $list){
                            ?>
                            
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><input type="checkbox" class="checkno" name="checkno[]" value="<?=$list->seq?>"></td>
                                <?php if ($this->board_path == "/mgr/board/") { ?>
                                <td class="text-center" style="vertical-align:middle;"><a href="<?=$this->board_path?>deleteNotice?<?=$params?>&page=<?=$page?>&seq=<?=$list->seq?>"><span style="font-weight: bold; color: #F4543C;">공지</span><i class="fa fa-minus-square"></i></a></td>
                                <?php } ?>
                                <td class="text-center" style="vertical-align:middle;"><?=$list->group_cd?>기</td>
                                <td style="text-align: left; word-break: break-all;">
                                    <?php if ($list->re_level > 0) { ?><span style="color: #999; margin-left: <?=10*($list->re_level-1)?>px;"><i class="fa fa-long-arrow-right"></i></span><?php } ?>
                                    <a href="<?=$this->board_path?>view?<?=$params?>&page=<?=$page?>&seq=<?=$list->seq?>"><?=$list->title?> <?=($arrNoticeComment[$list->seq] > 0) ? '('.$arrNoticeComment[$list->seq].')' : ''?></a>
                                </td>
                                <td class="text-center" style="vertical-align:middle;">
                                    <?php
                                        if ($arrNoticeFile[$list->seq]) {
                                            echo "<a href='/mgr/board/download?file_no=".$arrNoticeFileNo[$list->seq]."&board_code=$list->board_code'><i class='fa fa-paperclip'></i></a>";
                                        }
                                    ?>
                                </td>
                                <td class="text-center" style="vertical-align:middle;"><?=$list->name?></td>
                                <td class="text-center" style="vertical-align:middle;"><?=date('Y-m-d', strtotime($list->regist_date))?></td>
                                <td class="text-center" style="vertical-align:middle;"><?=number_format($list->view_count)?></td>
                            </tr>
                            <?php
                                }
                            }
                            
                            if ($boardList) {
                                foreach($boardList as $i => $list){
                                    $no = $total_count - ($page_rows * ($page - 1)) - $i;
                            ?>
                            
                            <tr>
                                <td class="text-center" style="vertical-align:middle;"><input type="checkbox" class="checkno" name="checkno[]" value="<?=$list->seq?>"></td>
                                <td class="text-center" style="vertical-align:middle;"><?=$no?></td>
                                <td class="text-center" style="vertical-align:middle;"><?=$list->group_cd?>기</td>
                                <td style="text-align: left; word-break: break-all; vertical-align: middle;">
                                    <?php if ($list->re_level > 0) { ?><span style="color: #999; margin-left: <?=10*($list->re_level-1)?>px;"><i class="fa fa-mail-forward reverse-vertical"></i></span><?php } ?>
                                    <a href="<?=$this->board_path?>view?<?=$params?>&page=<?=$page?>&seq=<?=$list->seq?>"><?=$list->title?> <?=($arrComment[$list->seq] > 0) ? '('.$arrComment[$list->seq].')' : ''?></a>
                                </td>
                                <td class="text-center" style="vertical-align:middle;">
                                    <?php
                                        if ($arrFile[$list->seq]) {
                                            echo "<a href='/mgr/board/download?file_no=".$arrFileNo[$list->seq]."&board_code=$list->board_code'><i class='fa fa-paperclip'></i></a>";
                                        }
                                    ?>
                                </td>
                                <td class="text-center" style="vertical-align:middle;"><?=$list->name?></td>
                                <td class="text-center" style="vertical-align:middle;"><?=date('Y-m-d', strtotime($list->regist_date))?></td>
                                <td class="text-center" style="vertical-align:middle;"><?=number_format($list->view_count)?></td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="8" class="text-center" style="vertical-align:middle;">조회된 데이터가 없습니다.</td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                </form>
                <div style="margin:10px 0;">
                    <div class="col-xs-6 horizon-padding-none">
                        <div class="dataTables_paginate paging_bootstrap" style="float:left;">
                            <?=$pagination?>
                        </div>
                    </div>
                    <div class="col-xs-6 horizon-padding-none text-right">
                        <a href="<?=$this->board_path?>insert?<?=$params?>&page=<?=$page?>" class="btn btn-primary btn-sm" style="width:70px;">글쓰기</a>
                        <?php if ($this->session->userdata('AID')) { ?><button id="btn-delete" class="btn btn-danger btn-sm btn-delete" style="width:70px;">선택삭제</button><?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>

<script type="text/javascript">
    $(document).ready(function(){
        //When unchecking the checkbox
        $(".check-all").on('ifUnchecked', function(event) {
            //Uncheck all checkboxes
            $(".check-seq").iCheck("uncheck");
        });
        //When checking the checkbox
        $(".check-all").on('ifChecked', function(event) {
            //Check all checkboxes
            $(".check-seq").iCheck("check");
        });
        
        
        // 선택 삭제
        $('.btn-delete').click(function(){
            var cnt = $(".check-seq:checked").length;
            if (cnt < 1) {
                alert("There is no data selected.");
            } else {
                var msg = "Would you like to Delete?"; 
                if (confirm(msg)) {
                   // <form onsubmit="return false;" 일 경우 jquery.submit(); 동작 안함
                   //$('#frm').attr("action", "<?=$this->board_path?>selectdelete?<?=$params?>&page=<?=$page?>").submit();
                   var f = document.frm;
                   f.action = "<?=$this->board_path?>selectdelete?<?=$params?>&page=<?=$page?>";
                   f.submit();
                }
            }
        });
    });
</script>

<section class="content">
    <?php
    if ($boardconfig->board_speech) {
    ?>
    <!-- BOARD SPEECH -->
    <div class="board-speech"><?=$boardconfig->board_speech?></div>
    <?php
    }
    ?>
    
    <!-- SEARCH BOX -->
    <div class="clearfix" style="padding: 10px 0;">
    <form name="searchForm" method="get">
        <input type="hidden" name="board_code" value="<?=$boardconfig->board_code?>">
        <div class="col-xs-6 horizon-padding-none" style="line-height: 30px;">
            <?php
            if ($boardconfig->board_category) {
            ?>
            <select name="s_category" id="s_category" class="form-control input-sm" style="width: auto; display: inline; vertical-align: middle; margin-right: 10px;" onchange="searchForm.submit();">
                <option value="">== All ==</option>
                <?php
                foreach($boardconfig->board_category as $key => $value){
                ?>
                <option value="<?=$value?>"<?php if (isset($s_category) && $value == $s_category) echo " selected"; ?>><?=$value?></option>
                <?php
                }
                ?>
            </select>
            <?php
            }
            ?>
            <span>Total : <b style="color: #367FA9;"><?=$total_count?></b></span>
        </div>
        <div class="col-xs-6 horizon-padding-none text-right">
            <select name="s_field" id="s_option" class="form-control input-sm" style="width: 100px; display: inline; vertical-align: middle;">
                <option value="subject"<?php if(isset($s_field) && $s_field == "subject") echo " selected"; ?>>Title</option>
                <option value="content"<?php if(isset($s_field) && $s_field == "content") echo " selected"; ?>>Content</option>
                <option value="name"<?php if(isset($s_field) && $s_field == "name") echo " selected"; ?>>Name</option>
            </select>
            <input type="text" name="s_string" class="form-control input-sm" style="width: 200px; display: inline; vertical-align: middle;" placeholder="search" value="<?=(isset($s_string) && $s_string) ? $s_string : ""?>">
            <button type="submit" class="btn btn-info btn-sm" style="width:60px; vertical-align: middle;">Search</button>
        </div>
    </form>
    </div>
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form id="frm" name="frm" method="post" action="" onsubmit="return false;" class="form-horizontal" role="form">
                <div class="box-body table-responsive">
                    <table class="table table-sub table-bordered responsive">
                        <colgroup>
                            <?php if ($this->board_path == "/manager/board/") { ?><col width="7%"><?php } ?>
                            <col width="7%">
                            <?php if ($boardconfig->board_category) { ?><col width="15%"><?php } ?>
                            <col width="*">
                            <col width="12%">
                            <col width="12%">
                            <col width="7%">
                        </colgroup>
                        <thead>
                            <tr>
                                <?php if ($this->board_path == "/manager/board/") { ?><th class="text-center"><input type="checkbox" name="check-all" class="check-all"></th><?php } ?>
                                <th class="text-center">No</th>
                                <?php if ($boardconfig->board_category) { ?><th class="text-center">Category</th><?php } ?>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Hit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($noticeList) {
                                foreach($noticeList as $i => $list){
                            ?>
                            <tr>
                                <?php if ($this->board_path == "/manager/board/") { ?><td class="text-center"><a href="<?=$this->board_path?>deleteNotice?<?=$params?>&page=<?=$page?>&seq=<?=$list->seq?>" style="font-size: 20px;"><i class="fa fa-minus-square"></i></a></td><?php } ?>
                                <td class="text-center"><span style="font-weight: bold; color: #F4543C;">Notice</span></td>
                                <?php if ($boardconfig->board_category) { ?><td class="text-center"><?=$list->category?></td><?php } ?>
                                <td style="text-align: left; word-break: break-all;">
                                    <?php if ($list->re_level > 0) { ?><span style="color: #999; margin-left: <?=10*($list->re_level-1)?>px;"><i class="fa fa-long-arrow-right"></i></span><?php } ?>
                                    <a href="<?=$this->board_path?>view?<?=$params?>&page=<?=$page?>&seq=<?=$list->seq?>"><?=$list->subject?></a>
                                </td>
                                <td class="text-center"><?=$list->name?></td>
                                <td class="text-center"><?=date('d-M-Y', strtotime($list->regist_date))?></td>
                                <td class="text-center"><?=$list->view_count?></td>
                            </tr>
                            <?php
                                }
                            }
                            
                            if ($boardList) {
                                foreach($boardList as $i => $list){
                                    $no = $total_count - ($page_rows * ($page - 1)) - $i;
                            ?>
                            <tr>
                                <?php if ($this->board_path == "/manager/board/") { ?><td class="text-center"><input type="checkbox" name="seq[]" class="check-seq" value="<?=$list->seq?>"></td><?php } ?>
                                <td class="text-center"><?=$no?></td>
                                <?php if ($boardconfig->board_category) { ?><td class="text-center"><?=$list->category?></td><?php } ?>
                                <td style="text-align: left; word-break: break-all;">
                                    <?php if ($list->re_level > 0) { ?><span style="color: #999; margin-left: <?=10*($list->re_level-1)?>px;"><i class="fa fa-mail-forward reverse-vertical"></i></span><?php } ?>
                                    <a href="<?=$this->board_path?>view?<?=$params?>&page=<?=$page?>&seq=<?=$list->seq?>"><?=$list->subject?></a>
                                </td>
                                <td class="text-center"><?=$list->name?></td>
                                <td class="text-center"><?=date('d-M-Y', strtotime($list->regist_date))?></td>
                                <td class="text-center"><?=$list->view_count?></td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="8" class="text-center" style="vertical-align:middle;">No data.</td>
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
                        <?php if ($this->session->userdata('ALevel') == "09" || $this->session->userdata('ALevel') == "05") { ?>
                        <a href="<?=$this->board_path?>insert?board_code=<?=$boardconfig->board_code?>" class="btn btn-primary btn-sm" style="width:90px;">Registration</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>

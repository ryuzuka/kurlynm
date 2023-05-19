<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
    
    $(document).on('change', '#road_group', function(){    
        $('#s_road_group').val(this.value);
       document.searchForm.submit();
    });    
</script>

<section class="content">
    <!-- SEARCH BOX -->
    <div class="box" style="border-top:1px;">
    <form name="searchForm" method="get">
        <input type="hidden" id="page" name="page" value="">
        <input type="hidden" id="s_road_group" name="s_road_group" value="">
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
                                <option value="univ_name"<?php if($s_field == "univ_name") echo " selected"; ?>>대학교</option>
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
                <div class="col-sm-2">
                    <div class="dataTables_length">
                        <select name="road_group" id="road_group" class="form-control input-sm">
                            <option value="">== 기수전체 ==</option>
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
                </div>
                <div class="col-sm-10 text-right">
                    <a href="<?=$this->member_path?>frontier_excel?<?=$params?>" class="btn bg-olive btn-sm" style="width: 80px;">다운로드</a>
                </div>
            </div>
            
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <colgroup>
                            <col style="width:5%;">
                            <col style="width:10%;">
                            <col style="width:15%;">
                            <col style="width:10%;">
                            <col style="width:20%;">
                            <col>
                            <col style="width:15%;">
                        </colgroup>
                        <thead>
                            <tr calss="text-center">
                                <th>No</th>
                                <th>기수</th>
                                <th>이름</th>
                                <th>성별</th>
                                <th>대학</th>
                                <th>학부</th>
                                <th>사진</th>
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
                                <td><?=$list->group_cd?></td>
                                <td><a href="/mgr/member/frontier_info?seq=<?=$list->seq?>&<?=$params?>"><?=$list->member_name?></a></td>
                                <td><?=$list->gender?></td>
                                <td><?=$list->univ_name?></td>
                                <td><?=$list->dept?></td>
                                <td class="text-center"><img src="<?=$list->photo_file_path?>/<?=$list->photo_file_name?>" style="height: 50px;"></td>
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
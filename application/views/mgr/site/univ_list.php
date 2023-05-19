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
                            <select name="s_field" id="s_field" class="form-control input-sm">
                                <option value="univ_name"<?php if($s_field == "univ_name") echo " selected"; ?>>학교명</option>
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
                            <col style="width:15%;">
                            <col style="width:10%;">
                            <col style="width:10%;">
                        </colgroup>
                        <thead>
                            <tr calss="text-center">
                                <th>No</th>
                                <th>학교명</th>
                                <th>지역</th>
                                <th>등급</th>
                                <th>상태</th>
                                <th>등록일</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($univList) {
                                foreach($univList as $i => $list){
                                    $no = $total_count - ($page_rows * ($page - 1)) - $i;
                                    if($list->status == "Y") {
                                        $style_value = "style='font-weight: 800'";
                                        $status_value = "활성";
                                    } else {
                                        $style_value = "style='font-weight: 400'";
                                        $status_value = "비활성";
                                    }
                            ?>
                            <tr <?=$style_value?>>
                                <td class="text-center"><?=$no;?></td>                                
                                <td><a href="/mgr/site/univ_info?seq=<?=$list->seq?>&<?=$params?>"><?=$list->univ_name?></a></td>
                                <td><?=$list->univ_area?></td>
                                <td><?=$list->univ_grade?></td>
                                <td><?=$status_value?></td>
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
                        <a href="/mgr/site/univ_insert?<?=$params?>" class="btn btn-primary btn-sm" style="width:80px;">등록</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
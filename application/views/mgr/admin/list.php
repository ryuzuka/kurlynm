<style>
    table th { text-align: center; }
</style>

<section class="content">
    <!-- SEARCH BOX -->
    <div class="box" style="border-top:1px;">
    <form name="searchForm" method="get">
        <div>
            <table class="table table-bordered">
                <colgroup>
                    <col width="10%">
                    <col width="80%">
                    <col width="10%">
                </colgroup>
                <tbody>
                <tr>
                    <td><div class="col-xs-2">Search</div></td>
                    <td>
                        <div class="col-xs-3">
                            <select name="s_field" id="s_option" class="form-control input-sm">
                                <option value="">== ALL ==</option>
                                <option value="admin_id"<?php if($s_field == "admin_id") echo " selected"; ?>>ID</option>
                                <option value="admin_name"<?php if($s_field == "admin_name") echo " selected"; ?>>Name</option>
                                <option value="email"<?php if($s_field == "email") echo " selected"; ?>>Email</option>
                                <option value="phone"<?php if($s_field == "phone") echo " selected"; ?>>Phone</option>
                            </select>
                        </div>
                        <div class="col-xs-5">
                            <input type="text" name="s_string" class="form-control input-sm" placeholder="search" value="<?=$s_string ? $s_string : ""?>">
                        </div>
                    </td>
                    <td>
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
            <div class="box">
                <div class="box-body table-responsive">
                    <table id="member-list" class="table table-bordered table-hover">
                        <colgroup>
                            <col style="width:60px;">
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col style="width:80px;">
                        </colgroup>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Grade</th>
                            <th>Reg Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($adminList) {
                            foreach($adminList as $i => $list){
								$no = $total_count - ($page_rows * ($page - 1)) - $i;
                        ?>
                        <tr>
                            <td class="text-center"><?=$no;?></td>
                            <td><a href="/mgr/admin/update?admin_id=<?=$list->admin_id?>"><?=$list->admin_id?></a></td>
                            <td><a href="/mgr/admin/update?admin_id=<?=$list->admin_id?>"><?=$list->admin_name?></a></td>
                            <td><?=$list->phone?></td>
                            <td><?=$list->email?></td>
                            <td class="text-center"><span data-toggle="tooltip" data-placement="top" title="<?=$list->admin_level_name?>" data-original-title="<?=$list->admin_level_name?>"><?=$list->admin_level?></span></td>
                            <td class="text-center"><?=date('Y-m-d', strtotime($list->regist_date))?></td>
                            <td class="text-center"><?=$list->status=="Y" ? "active" : "inactive"?></td>
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
                        <a href="/mgr/admin/insert" class="btn btn-primary btn-sm" style="width:90px;">Registration</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
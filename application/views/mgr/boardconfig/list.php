<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                    <table class="table table-sub table-bordered responsive">
                        <colgroup>
                            <col width="5%">
                            <col width="10%">
                            <col width="*">
                            <col width="8%">
                            <col width="8%">
                            <col width="8%">
                            <col width="8%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">게시판 코드</th>
                                <th class="text-center">게시판 이름</th>
                                <th class="text-center">게시판 사용</th>
                                <th class="text-center">댓글</th>
                                <!--th class="text-center">비밀글</th-->
                                <th class="text-center">이미지첨부</th>
                                <th class="text-center">파일첨부</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($boardconfigList) {
                                foreach($boardconfigList as $i => $list){
                                    $no = $total_count - ($page_rows * ($page - 1)) - $i;
                            ?>
                            <tr>
                                <td class="text-center"><?=$no?></td>
                                <td class="text-center"><?=$list->board_code?></td>
                                <td><a href="/mgr/boardconfig/update?board_code=<?=$list->board_code?>&page=<?=$page?>"><?=$list->board_name?></a></td>
                                <td class="text-center"><?=($list->is_use == 'Y') ? 'O':'X'?></td>
                                <td class="text-center"><?=($list->is_comment == 'Y') ? 'O':'X'?></td>
                                <!--td class="text-center"><?=($list->is_secret == 'Y') ? 'O':'X'?></td-->
                                <td class="text-center"><?=($list->is_image == 'Y') ? 'O':'X'?></td>
                                <td class="text-center"><?=($list->is_file == 'Y') ? 'O':'X'?></td>
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
                <div style="margin:10px 0;">
                    <div class="col-xs-6">
                        <div class="dataTables_paginate paging_bootstrap" style="float:left;">
                            <?=$pagination?>
                        </div>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a href="/mgr/boardconfig/insert" class="btn btn-primary btn-sm" style="width:90px;">등록</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

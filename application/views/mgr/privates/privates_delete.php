<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript">
    $(document).ready(function () {
        
        $('.btn-delete').click(function () {
            var mode = $(this).attr("data-mode");
            
            var yn = confirm("삭제한 데이터는 복구할 수 없습니다.\n삭제하시겠습니까?");
            if (yn) {
                $("#mode").val(mode);
                $('#frm').submit();
            } else {
                return false;
            }
        });
          
    });
    
</script>

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <form id="frm" name="frm" method="post" action="/mgr/privates/privates_delete_proc" class="form-horizontal" role="form" autocomplete="off">
                <input type="hidden" name="mode" id="mode">
                <div class="box-header with-border">
                    <h3 class="box-title">정해진 기간 이후의 개인정보 삭제</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">1:1 문의 (<?=$privates->inquiry_day?> 일)</label>
                        <div class="col-sm-1" style="padding-top: 6px;">
                            <?=$inquiryCount?> 건
                        </div>
                        <div class="col-sm-8">
                            <a id="btn-delete" class="btn btn-danger btn-sm <?php if($inquiryCount > 0) { echo "btn-delete"; } ?>" data-mode="inquiry" style="width:80px;" <?php if($inquiryCount == 0) { echo "disabled"; } ?>>삭제</a>
                        </div>
                    </div>
                </div>
            
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">견적문의 (<?=$privates->estimate_day?> 일)</label>
                        <div class="col-sm-1" style="padding-top: 6px;">
                            <?=$estimateCount?> 건
                        </div>
                        <div class="col-sm-8">
                            <a id="btn-delete" class="btn btn-danger btn-sm <?php if($estimateCount > 0) { echo "btn-delete"; } ?>" data-mode="estimate" style="width:80px;" <?php if($estimateCount == 0) { echo "disabled"; } ?>>삭제</a>
                        </div>
                    </div>
                </div>
                
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">회원정보 (<?=$privates->member_day?> 일)</label>
                        <div class="col-sm-1" style="padding-top: 6px;">
                            <?=$memberCount?> 건
                        </div>
                        <div class="col-sm-8">
                            <a id="btn-delete" class="btn btn-danger btn-sm <?php if($memberCount > 0) { echo "btn-delete"; } ?>" data-mode="member" style="width:80px;" <?php if($memberCount == 0) { echo "disabled"; } ?>>삭제</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        

    </div>
</div>
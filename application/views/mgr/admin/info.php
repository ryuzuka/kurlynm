<script type="text/javascript">
<!--
	$(document).ready(function(){
        // delete
        $('.btn-delete').click(function(){
            var admin_id = $(this).data('admin_id');
            //var yn = confirm("삭제하시겠습니까?");
            var yn = confirm("Anda ingin menghapus akun ini?");
            if (yn) {
                $('#hiddenForm').attr('action', '/mgr/admin/delete?admin_id='+admin_id).submit();
            } else {
                return false;
            }
        }); 
    });
//-->
</script>

<section class="content">
	<div class="row">
        <div class="col-xs-12">
            
            <div class="box">
                <div class="box-body">
                    <h4 class="page-header">Admin Modify</h4>
                    <form id="frm" name="frm" method="post" action="/mgr/admin/update" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> ID</label>
                            <div class="col-sm-4">
                                <input type="text" id="admin_id" name="admin_id" class="form-control input-sm" placeholder="ID" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for admin ID" value="<?=$admin->admin_id?>" readonly="">
                            </div>
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Name</label>
                            <div class="col-sm-4">
                                <input type="text" id="admin_name" name="admin_name" class="form-control input-sm" placeholder="Name" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for name" value="<?=$admin->admin_name?>">
                                <?php echo form_error('admin_name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Password</label>
                            <div class="col-sm-4">
                                <input type="password" id="admin_passwd" name="admin_passwd" class="form-control input-sm" placeholder="Password" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for password" value="">
                                <?php echo form_error('admin_passwd'); ?>
                            </div>
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Re-Password</label>
                            <div class="col-sm-4">
                                <input type="password" id="admin_passwd2" name="admin_passwd2" class="form-control input-sm" placeholder="Re-Password" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for password confirm" value="">
                                <?php echo form_error('admin_passwd2'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> E-mail</label>
                            <div class="col-sm-4">
                                <input type="text" id="email" name="email" class="form-control input-sm" placeholder="E-mail" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for e-mail" value="<?=$admin->email?>">
                                <?php echo form_error('email'); ?>
                            </div>
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Phone</label>
                            <div class="col-sm-4">
                                <input type="text" id="phone" name="phone" class="form-control input-sm" placeholder="Phone" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for mobile" value="<?=$admin->phone?>">
                                <?php echo form_error('phone'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Grade</label>
                            <div class="col-sm-4">
                                <?php
                                // 최고관리자 아니면.. 최고관리자 등급 선택할 수 없도록..
                                if ($admin->admin_id != $this->global_admin_id) $adminLevelList = $useAdminLevelList;
                                ?>
                                <select id="admin_level" name="admin_level" class="form-control input-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for admin level">
                                    <option value="">== Select Grade ==</option>
                                    <?php
                                    if ($adminLevelList) {
                                        foreach($adminLevelList as $i => $list){
                                    ?>
                                    <option value="<?=$list->code?>"<?php if ($list->code == $admin->admin_level) echo " selected"; ?>><?=$list->code?> : <?=$list->code_name?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo form_error('admin_level'); ?>
                            </div>
                            <label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> Status</label>
                            <div class="col-sm-4">
                                <select id="status" name="status" class="form-control input-sm" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tooltip for admin status">
                                    <option value="Y"<?php if ($admin->status == "Y") echo " selected"; ?>>Active</option>	
                                    <option value="N"<?php if ($admin->status == "N") echo " selected"; ?>>Inactive</option>
                                </select>
                                <?php echo form_error('status'); ?>
                            </div>
                        </div>

                        <h4 class="page-header"></h4>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-sm" style="width:60px;">Save</button>
                            <a href="/mgr/admin" class="btn btn-warning btn-sm" style="width:60px;">Back</a>
                            <?php if ($admin->admin_id != $this->global_admin_id) { ?><input type="button" class="btn btn-danger btn-sm btn-delete" style="width:60px;" value="Delete" data-admin_id="<?=$admin->admin_id?>"><?php } ?>
                        </div>
                    </form>
                </div>
            </div>

        </div>
	</div>   <!-- /.row -->
</section>
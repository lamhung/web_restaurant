<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Creat Menu 
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class=" col-lg-6 col-md-offset-3">
                        <form role="form" name="form" method="POST" enctype="multipart/form-data" autocomplete="ON">
                            <div class="form-group <?php if (form_error('fullname')) echo 'has-error'; ?>">
                                <label><?=$this->lang->line('user_fullname')?></label>
                                <input class="form-control" name='fullname' id="fullname" placeholder="Enter <?=$this->lang->line('user_fullname')?>" value="<?=set_value('fullname', $row['fullname'])?>">
                                <p><?php echo form_error('fullname', "<small class='help-block'>", '</small>'); ?></p>
                            </div>
                            <div class="form-group <?php if (form_error('username')) echo 'has-error'; ?>">
                                <label><?=$this->lang->line('user_username')?></label>
                                <input class="form-control" name='username' id="username"  placeholder="Enter <?=$this->lang->line('user_username')?>" value="<?=set_value('username', $row['username'])?>">
                                <p><?php echo form_error('username', "<small class='help-block'>", '</small>'); ?></p>
                            </div>
                            <div class="form-group <?php if (form_error('password')) echo 'has-error'; ?>">
                                <label><?=$this->lang->line('user_password')?></label>
                                <input type="password" class="form-control" name='password' id="password"  placeholder="Enter <?=$this->lang->line('user_password')?>" value="">
                                <p><?php echo form_error('password', "<small class='help-block'>", '</small>'); ?></p>
                            </div>
                            <div class="form-group <?php if (form_error('repassword')) echo 'has-error'; ?>">
                                <label><?=$this->lang->line('user_repassword')?></label>
                                <input type="password" class="form-control" name='repassword' id="repassword"  placeholder="Enter <?=$this->lang->line('user_repassword')?>" value="">
                                <p><?php echo form_error('repassword', "<small class='help-block'>", '</small>'); ?></p>
                            </div>
                            <div class="form-group <?php if (isset($image_error)) echo 'has-error'; ?>">
                                <label><?=$this->lang->line('menu_image')?></label>
                                 <div class="clearfix"></div>
                                <div class="col-sm-4">
                                    <img src="<?php echo $row['image_']; ?>" width = "150" class='img-responsive'/>
                                </div>
                                <div class="col-sm-8">
                                    <input class="form-control" id="image" name= 'image' type="file">
                                    <?php
                                    if (isset($image_error)) {
                                        echo "<small class='help-block'>" . $image_error . '</small>';
                                    }
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                            </div><!-- /Form group-->
                             <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                            <button type="submit" name='submit' value="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
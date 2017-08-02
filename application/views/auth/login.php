<div class="col-md-4 col-md-offset-4" style="padding-top: 70px;">
    <?php if(!empty($msg)){ ?>
        <div class="alert alert-danger" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>[Logger]</strong> <?= $msg ;?>
        </div>
    <?php }?>
    <div class="login-panel panel panel-default" style="margin-top: 20px;">
    
        <div class="panel-heading">
            <h3 class="panel-title">Please Sign In</h3>
        </div>
        <div class="panel-body">
            
            <form role="form" method="post"  autocomplete="OFF">
                <fieldset>
                    <div class="form-group <?php if (form_error('username')) echo 'has-error'; ?>">
                    <input class="form-control" placeholder="Enter Username" name="username" type="text" autofocus="" value="<?=set_value('username')?>">
                    <p><?php echo form_error('username', "<small class='help-block'>", '</small>'); ?></p>
                    </div>
                    <div class="form-group <?php if (form_error('password')) echo 'has-error'; ?>">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                         <p><?php echo form_error('password', "<small class='help-block'>", '</small>'); ?></p>
                    </div>
                    
                    <!-- Change this to a button or input when using this as a form -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                    <input type="submit" name='submit' value='Login' class="btn btn-lg btn-success btn-block">
                </fieldset>
            </form>
        </div>
    </div>
</div>
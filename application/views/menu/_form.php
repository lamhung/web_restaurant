<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?=$this->lang->line('create');?> 
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class=" col-lg-6 col-md-offset-3">

                        <form role="form" name="form" method="POST" enctype="multipart/form-data">
                            <div class="form-group <?php if (form_error('name')) echo 'has-error'; ?>">
                                <label><?=$this->lang->line('menu_name')?></label>
                                <input class="form-control" name='name' id="name" placeholder="Enter <?=$this->lang->line('menu_name')?>" value="<?=set_value('name', $row['name'])?>">
                                <p><?php echo form_error('name', "<small class='help-block'>", '</small>'); ?></p>
                            </div>
                            <div class="form-group <?php if (form_error('cost')) echo 'has-error'; ?>">
                                <label><?=$this->lang->line('menu_cost')?></label>
                                <input class="form-control" name='cost' id="cost"  placeholder="Enter <?=$this->lang->line('menu_cost')?>" value="<?=set_value('cost', number_vn_format($row['cost']))?>" onkeyup="format_currency(this)">
                                <p><?php echo form_error('cost', "<small class='help-block'>", '</small>'); ?></p>
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
                            <div class="form-group">
                                <label><?=$this->lang->line('menu_type')?></label>
                                <input class="form-control" name='menu_type' id="menu_type"  placeholder="Enter <?=$this->lang->line('menu_type')?>" value="<?=set_value('menu_type', $row['menu_type'])?>">
                            </div>
                             <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                            <button type="submit" name='submit' value="submit" class="btn btn-primary"><?=$this->lang->line('save');?> </button>
                            <button type="reset" class="btn btn-default"><?=$this->lang->line('reset');?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<script type="text/javascript">

</script>
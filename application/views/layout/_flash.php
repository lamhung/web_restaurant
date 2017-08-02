<?php if ($this->session->flashdata('msg_error')) { ?>
<div class="alert alert-danger" role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>[Logger]</strong> <?php echo $this->session->flashdata('msg_error')?>
</div>
<?php }?>
<?php if ($this->session->flashdata('msg_success')) { ?>
<div class="alert alert-success" role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>[Logger]</strong> <?php echo $this->session->flashdata('msg_success')?>
</div>
<?php }?>
<?php if ($this->session->flashdata('msg_info')) { ?>
<div class="alert alert-info" role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>[Logger]</strong> <?php echo $this->session->flashdata('msg_info')?>
</div>
<?php }?>
 
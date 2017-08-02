<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">User </h3>

    </div>
    <!-- /.col-lg-12 -->
</div>
<?php $this->load->view('layout/_flash');?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a  href='<?=base_url("user/add/")?>' class="btn btn-success pull-left">New</a>
                <div class="clearfix"></div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?=$this->lang->line('user_fullname')?></th>
                                <th><?=$this->lang->line('user_username')?></th>
                                <th><?=$this->lang->line('user_image')?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i = 1;
                            foreach($rows as $row) {
                                $row = $this->user_model->convert_output($row);
                        ?>
                            <tr>
                                <td><?=$row['pknum']?></td>
                                <td><?=$row['fullname']?></td>
                                <td><?=$row['username']?></td>
                                <td><img src="<?=$row['image_']?>" class='img-responsive' width='50'></td>
                                <td><a href='<?=base_url("user/edit?id=".$row['pknum'])?>' class=' btn btn-warning btn-circle' title='edit'><i class="fa fa-link"></i></a>
                                <a href='#' class=' btn btn-danger btn-circle' title='delete' onClick="delete_user('<?= $row['pknum']?>', '<?= $this->input->get('page');?>')"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php }?>  
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <div class="text-center">
                <?php echo $this->pagination->create_links();?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    
</div>
<script>
    function delete_user(id, current_page)
    {
        modal_confirm("Delete menu",'Are you sure?', function(){
            var page = current_page ? '&page='+current_page : '';
            window.location.replace('<?=base_url();?>' + 'user/delete?id=' + id + page);
        });
    }

</script>
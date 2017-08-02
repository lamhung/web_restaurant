<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Menu </h3>

    </div>
    <!-- /.col-lg-12 -->
</div>
<?php $this->load->view('layout/_flash');?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading " style="position: relative">
                <a  href='<?=base_url("menu/add/")?>' class="btn btn-success pull-left"><?=$this->lang->line('new');?></a>
                <div class="search col-md-5 pull-right">
                    <form action='' method="get" class="frm_search" autocomplete="ON">
                        <div class="form-group col-md-9 col-sm-9 col-xs-12" style="margin: 0"> 
                            <input placeholder="Search" type="text"  class="form-control" id="keywords" name="keywords" value="<?= $this->input->get('keywords') ?  $this->input->get('keywords') : ''?>">
                        </div>
                        <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin: 0; padding: 0">
                            <button type="submit" value="" class="btn btn_primary"><i class='fa fa-search'></i></button>
                            
                        </div>

                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div style="height: 20px;"></div>
            

            <div class="clearfix"></div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?=$this->lang->line('menu_name')?></th>
                                <th><?=$this->lang->line('menu_cost')?></th>
                                <th><?=$this->lang->line('menu_type')?></th>
                                <th><?=$this->lang->line('menu_image')?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i = 1;
                            foreach($rows as $row) {
                                $row = $this->menu_model->convert_output($row);
                        ?>
                            <tr>
                                <td><?=$row['pknum']?></td>
                                <td><?=$row['name']?></td>
                                <td><?=number_format($row['cost'],0)?></td>
                                <td><?=$row['menu_type']?></td>
                                <td><img src="<?=$row['image_']?>" class='img-responsive' width='50'></td>
                                <td><a href='<?=base_url("menu/edit?id=".$row['pknum'])?>' class=' btn btn-warning btn-circle' title='edit'><i class="fa fa-link"></i></a>
                                <a href='#' class=' btn btn-danger btn-circle' title='delete' onClick="delete_menu('<?= $row['pknum']?>', '<?= $this->input->get('page');?>')"><i class="fa fa-times"></i></a>
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
    function delete_menu(id, current_page)
    {
        modal_confirm("Delete menu",'Are you sure?', function(){
            var page = current_page ? '&page='+current_page : '';
            window.location.replace('<?=base_url();?>' + 'menu/delete?id=' + id + page);
        });
    }

</script>
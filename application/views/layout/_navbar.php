<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Restaurant Menu System</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="">
                    <?php 
                        $user_login = $this->session->userdata('user_login');
                        if($user_login) {
                    ?>
                        <a href="#" ><?=$user_login['fullname']?></a>
                    <?php 
                        }
                      ?>      
                            
                            
                </li>
                <!-- /.dropdown -->
            </ul>
            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="<?= base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="<?= base_url('menu'); ?>"><i class="fa fa-table fa-fw"></i> Menu</a>
                        </li>
                        <li>
                            <a href="<?= base_url('user'); ?>"><i class="fa fa-edit fa-fw"></i> User</a>
                        </li>
                        <?php if($user_login) { ?>
                            <li>
                                <a href="<?= base_url('sign_out'); ?>"><i class="fa fa-edit fa-fw"></i> Sign out</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
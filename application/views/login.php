<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $sign; ?></h3>
                </div>
                <div class="panel-body">
                   <form method="post" action="<?php echo base_url('index.php/Websys/login'); ?>" >
                        <?php echo $this->session->flashdata('msg'); ?>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
                            <input type="text" autocomplete="off" name="username" id="username" class="form-control" placeholder="Username" >
                        </div>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                            <input type="password" autocomplete="off" name="password" id="password" class="form-control" placeholder="Password" >
                        </div>
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" id="show-password"> Show Password
                                    </label>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-default btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

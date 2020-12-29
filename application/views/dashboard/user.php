<script>
    $(document).ready(function() {
        <?php if($this->session->flashdata('pesan')){ ?>
        $.Notification.notify('success','top right','Success!', 'Berhasil ditambahkan...');
        <?php } ?>
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <?php
            if (!empty($link)){
                foreach ($link as $row) {
                    echo $row;
                }
            }
        ?>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-users fa-fw"></i> User Management
                <form class="pull-right" method="POST" action="<?php echo $form_cari; ?>" >
                    <input placeholder="search..." type="text" id="usercari" name="usercari" autocomplete="off" value="<?php echo $usercari;?>">
                </form>
            </div>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th width="50">#</th>
                    <th width="100">Nama</th>
                    <th width="150">Email</th>
                    <th width="150">Role</th>
                    <th width="100">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($userlist->result_array() as $d) { ?>

                    <tr>
                        <th><?php echo $nourut; ?></th>
                        <td><?php echo $d['name']; ?></td>
                        <td><?php echo $d['email']; ?></td>
                        <td><?php echo $d['level']; ?></td>
                        <td align="center" width="50px">
                            <a data-toggle="modal" title="Edit user..." data-target="#EditModal" onclick="getroom('<?php echo $d['id']; ?>')"><i class="fa fa-pencil-square-o fa-fw"></i>  Edit</a> &nbsp;&nbsp;&nbsp;
                            <a data-toggle="modal" title="Hapus User..." data-target="#HapusModal" onclick="getroom('<?php echo $d['id']; ?>')"><i class="fa fa-trash fa-fw"></i>  Remove</a> &nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    <?php
                        $nourut++;
                    } ?>
                </tbody>
            </table>
            <!-- /.panel-body -->
        </div>
        <div class="modal fade" id="reserveModal">
            <form method="post" action="<?php echo $form_actreg; ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Room Reservation</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Room</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="room" id="room" readonly="yes">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nama Tamu</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="namatamu" id="namatamu" autocomplete="off" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Durasi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="durasi" id="durasi" autocomplete="off" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

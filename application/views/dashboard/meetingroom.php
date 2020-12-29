<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-meetup fa-fw"></i> Meeting Room
                <form class="pull-right" method="POST" action="<?php echo $form_cari; ?>" >
                    <input placeholder="search..." type="text" id="roomcari" name="roomcari" autocomplete="off" value="<?php echo $roomcari;?>">
                </form>
            </div>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th width="50">#</th>
                    <th width="100">Room</th>
                    <th width="150">Password</th>
                    <th width="150">Longstay</th>
                    <th width="200">Checkin</th>
                    <th width="200">CheckOut</th>
                    <th width="100">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($roomlist->result_array() as $d) { ?>
                
                    <tr>
                        <th><?php echo $nourut; ?></th>
                        <td><?php echo $d['room']; ?></td>
                        <td><?php echo $d['name']; ?></td>
                        <?php if(($d['durasi']) == 0 ) { ?>
                            <td>Ready To Reserve...</td>
                        <?php } ?>
                        <td><?php echo $d['startdate']; ?></td>
                        <td><?php echo $d['expiredate']; ?></td>
                        <td align="center" width="50px">
                            <a data-toggle="modal" title="Reserve..." data-target="#reserveModal" onclick="getroom('<?php echo $d['id']; ?>')"><i class="fa fa-sign-in fa-fw"></i>  Reserve...</a> &nbsp;&nbsp;&nbsp;
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
                            <h4 class="modal-title">Meeting Room Reservation</h4>
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
                                <label class="col-sm-4 col-form-label">Perusahaan</label>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

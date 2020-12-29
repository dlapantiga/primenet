<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-check-square-o fa-fw"></i> Reserved Room
                 <form class="pull-right" method="POST" action="<?php echo $form_cari; ?>" >
                    <input placeholder="search..." type="text" id="roomcari" name="roomcari" autocomplete="off" value="<?php echo $roomcari;?>">
                </form>
            </div>
            <!-- <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th width="50">#</th>
                    <th width="75">Room</th>
                    <th width="100">Password</th>
                    <th width="100">LongStay</th>
                    <th width="150">Start</th>
                    <th width="150">End</th>
                    <th width="100">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($room as $d) {
                    $sdate = $this->date_m->normalformat($d['startdate']).' '.$this->date_m->normaltime($d['starttime']);
                    $edate = $this->date_m->normalformatdatetime($d['expiredate']);
                    ?>
                    <tr>
                        <th><?php echo $nourut; ?></th>
                        <td><?php echo $d['room']; ?></td>
                        <td><?php echo $d['name']; ?></td>
                        <td><?php echo $d['durasi']; ?> Hari</td>
                        <td><?php echo $sdate; ?></td>
                        <td><?php echo $edate; ?></td>
                        <td align="center" width="90px">
                            <a data-toggle="modal" data-target="#checkoutModal" class="glyphicon glyphicon-minus-sign" onclick="getroomco('<?php echo $d['id']; ?>')"> Checkout</a> &nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    <?php 
                        $nourut++;
                    } ?>
                </tbody>
            </table> -->
            <?php
                $tampilan_tabel=array('table_open'=>'<table margintop="0" class="table table-striped table-bordered table-condensed table-hover">',
                'heading_cell_start'=>'<th>',
                'row_start'=>'<tr>');
                $this->table->set_template($tampilan_tabel);
                $no = 1;
                $this->table->set_heading('#','Room','Password','Longstay', 'Checkin','Checkout','Action');
                if(isset($roomlist)){
                    foreach($roomlist->result_array() as $d){
                        $this->table->add_row(
                        $no,
                        $d['room'],
                        $d['name'],
                        $d['durasi'].' Hari',
                        $this->date_m->normalformat($d['startdate']).' '.$this->date_m->normaltime($d['starttime']),
                        $this->date_m->normalformatdatetime($d['expiredate']),
                        "<a data-toggle='modal' data-target='#checkoutModal' onclick='getroomco($d[id])' title='Check Out'><span class='fa fa-sign-out'></span> Checkout</a>"                        
                        );
                        $no++;
                    }
                }
                echo $this->table->generate();
            ?>
            <!-- /.panel-body -->
        </div>
        <div class="modal fade" id="checkoutModal">
            <form method="post" action="<?php echo $form_co; ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Check Out </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            Are you sure to Checkout ?
                        </div>
                         <div class="col-sm-8">
                            <input type="text" name="room" id="room" readonly="yes" hidden>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"><i class="fa fa-check"></i> Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
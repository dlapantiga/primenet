<div class="row">
   <!--  <form action="" method="post">
        <div class="col-sm-6 pull-right">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="input-group" >
                        <input class="form-control" placeholder="search..." type="text" id="roomcari" name="roomcari" autocomplete="off" value="<?php echo $roomcari;?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </form> -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <i class="fa fa-wifi fa-fw md-6"></i> Monitoring Access Point
                <div class="col-sm-6 pull-right">
                    <!-- <div class="col-sm-5"> -->
                        <!-- <div class="pull-right" method="POST" action="<?php echo $form_cari; ?>">
                            <label class="control-label">Select Floor...</label>
                            <select name="floor" id="floor" required="required">
                                <option selected value="01"></option>
                                <?php
                                foreach ($listfloor as $row) {
                                echo "<option value='".$row->nfl."'>".$row->nfl."</option>";
                                }
                                ?>
                            </select>
                        </div> -->
                    <form class="pull-right" method="POST" action="<?php echo $form_cari; ?>" >
                        <input text-align="left" placeholder="type floor..." type="text" id="floor" name="floor" autocomplete="off" value="<?php echo $floor;?>">
                    </form>
                    <!-- </div> -->
                </div>
            </div>
        </div>

            <?php
                $tampilan_tabel=array('table_open'=>'<table margintop="0" class="table table-striped table-bordered table-condensed table-hover">',
                'heading_cell_start'=>'<th>',
                'row_start'=>'<tr>');
                $this->table->set_template($tampilan_tabel);
                $status = '';
                $no = 1;
                $this->table->set_heading('#','Status','Access Point','IP Address', 'Floor','Description');
                if(isset($aplist)){
                    foreach($aplist->result_array() as $d){
                        $this->table->add_row(
                            $no,
                            $this->Qdbase_m->getstatusbyip($d['ipaddr']),
                            $d['nap'],
                            $d['ipaddr'],
                            $d['nfl'],
                            $d['ndesc']
                        );
                        $no++;
                    }
                }
                echo $this->table->generate();
            ?>
        </div>
    </div>
</div>

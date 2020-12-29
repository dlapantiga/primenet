<div class="row">
    <form action="<?php echo $showdata; ?>" method="post"> 
        <div class="col-sm-6">
            <div class="col-sm-8"> 
                <div class="form-group"> 
                    <div class="input-group" >
                        <input class="form-control" placeholder="search..." type="text" id="roomcari" name="roomcari" autocomplete="off" value="">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 pull-right">
            <div class="col-sm-5"> 
                <div class="form-group">  
                    <div class="input-group date " data-date="" data-date-format="dd-mm-yyyy">  
                        <input class="form-control" id="periode1" name="periode1" readonly="" required="" value="<?php echo $periode1; ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>  
                </div>
            </div> 
            <div class="col-sm-5"> 
                <div class="form-group"> 
                    <div class="input-group date " data-date="" data-date-format="dd-mm-yyyy">  
                        <input class="form-control" id="periode2" name="periode2" readonly="" required="" value="<?php echo $periode2; ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>  
                </div>  
            </div>
            <div class="col-sm-2">
                <div class="form-group">   
                    <button type="submit" class="btn btn-success">GO</button>  
                </div> 
            </div>
        </div> 
    </form>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="<?php echo $isiclass; ?>"></i> Report
                <!-- <form class="pull-right" method="POST" action="" >
                    <input placeholder="search..." type="text" id="roomcari" name="roomcari" autocomplete="off" value="">
                </form> -->
            </div>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th width="50">#</th>
                    <th width="100">Guest</th>
                    <th width="150">Start Date</th>
                    <th width="150">End Date</th>
                    <th width="150">Basic (Days)</th>
                    <th width="200">Room</th>
                    <th width="200">Bandwidth Usege</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($loglist as $d) { ?>

                    <!-- Convert Download Value -->
                    <?php if (($d['usedl']) >= '1073741824')
                            {
                                $dl = number_format(($d['usedl']) / 1073741824, 2) . ' GB';
                            }
                            elseif (($d['usedl']) >= '1048576')
                            {
                                $dl = number_format(($d['usedl']) / 1048576, 2) . ' MB';
                            }
                            elseif (($d['usedl']) >= 1024)
                            {
                                $dl = number_format(($d['usedl']) / 1024, 2) . ' KB';
                            }
                            elseif (($d['usedl']) > 1)
                            {
                                $dl = ($d['usedl']) . ' bytes';
                            }
                            elseif (($d['usedl']) == 1)
                            {
                                $dl = ($d['usedl']) . ' byte';
                            }
                            else
                            {
                                $dl = '0 bytes';
                            } ?>

                    <!-- Convert Upload Value -->
                    <?php if (($d['useul']) >= '1073741824')
                            {
                                $ul = number_format(($d['useul']) / 1073741824, 2) . ' GB';
                            }
                            elseif (($d['useul']) >= '1048576')
                            {
                                $ul = number_format(($d['useul']) / 1048576, 2) . ' MB';
                            }
                            elseif (($d['useul']) >= 1024)
                            {
                                $ul = number_format(($d['useul']) / 1024, 2) . ' KB';
                            }
                            elseif (($d['useul']) > 1)
                            {
                                $ul = ($d['useul']) . ' bytes';
                            }
                            elseif (($d['useul']) == 1)
                            {
                                $ul = ($d['useul']) . ' byte';
                            }
                            else
                            {
                                $ul = '0 bytes';
                            } ?>

                    <?php $bandwidth = "DL : ".$dl." / UP : ".$ul." "; ?>

                    <tr>
                        <th><?php echo $nourut; ?></th>
                        <td><?php echo $d['name']; ?></td>
                        <td><?php echo $this->Date_m->normalformat($d['startdate']); ?></td>
                        <td><?php echo $this->Date_m->normalformat($d['enddate']); ?></td>
                        <td><?php echo number_format($d['sumdate']); ?></td>
                        <td><?php echo $d['room']; ?></td>
                        <td><?php echo $bandwidth; ?></td>
                    </tr>
                    <?php
                        $nourut++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


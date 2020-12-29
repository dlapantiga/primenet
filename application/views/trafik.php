<?php
if ($this->routerosapi->connect($this->session->userdata('iphost'), $this->session->userdata('userhost'), $this->session->userdata('passwdhost')))
{
    $iface ='=interface=ether2-Maxindo';
    $once = 'once';
    $this->routerosapi->write('/interface/monitor-traffic', false);
    $this->routerosapi->write($iface);
    $this->routerosapi->write($once);
    $ARRAY = $this->routerosapi->read(); ?>
    <table border=1>
      <tr><td>Interface</td><td>rx</td><td>rx</td></tr> <?php
      foreach ($ARRAY as $key) {
        if (($key['name'] == "ether2-Maxindo")) { ?>
        <tr><td><?php echo $key['name']; ?></td>
          <td><?php echo $key['rx-bits-per-second']; ?></td>
          <td><?php echo $key['tx-bits-per-second']; ?></td>
          </tr> <?php
        }
      } ?>
    </table><?php
    $this->routerosapi->disconnect();
  } else {
   echo "Gagal tersambung ke Mikrotik";
  }
?>
    <!-- <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">26</div>
                        <div>New Comments</div>
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">12</div>
                        <div>New Tasks!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div> -->

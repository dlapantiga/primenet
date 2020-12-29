<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?php echo base_url(); ?>index.php/Dashboard"  title="Halaman Depan..."><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
             <?php if ($this->session->userdata('levelweb') == 'Administrator' || $this->session->userdata('levelweb') == 'Hotel Manager' || $this->session->userdata('levelweb') == 'Operator') { ?>
                <li>
                    <a href="#"><i class="fa fa-home fa-fw"></i> Room Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Available" title="Room Tersedia..."><i class="fa fa-exchange fa-fw"></i>  Available Room</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Reserved" title="Room Terpakai..."><i class="fa fa-check-square-o fa-fw"></i>  Reserved Room</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Meetingroom" title="Ruang Rapat / Ruang Pertemuan"><i class="fa fa-meetup fa-fw"></i>  Meeting Room</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <?php if ($this->session->userdata('levelweb') == 'Administrator' || $this->session->userdata('levelweb') == 'Hotel Manager' || $this->session->userdata('levelweb') == 'Operator') { ?>
                <li>
                    <a href="#"  title="Spesial akun wifi..."><i class="fa fa-plug fa-fw"></i>  Premium Service</a>
                </li>
            <?php } ?>

            <?php if ($this->session->userdata('levelweb') == 'Administrator' || $this->session->userdata('levelweb') == 'Operator') { ?>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/Monitoring"  title="Monitoring Status AP Wifi..."><i class="fa fa-wifi fa-fw"></i>  Monitoring AP</a>
                </li>
            <?php } ?>

            <?php if ($this->session->userdata('levelweb') == 'Administrator' || $this->session->userdata('levelweb') == 'Hotel Manager' || $this->session->userdata('levelweb') == 'Finance') { ?>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i>  System Management<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?php if ($this->session->userdata('levelweb') === 'Administrator' ) { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/User"  title="Pengaturan Akses Webservice Wifi..."><i class="fa fa-users fa-fw"></i>  User Management</a>
                            </li>
                            <?php } ?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Report"  title="Laporan..."><i class="fa fa-bar-chart fa-fw"></i>  Report</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

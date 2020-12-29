<!-- <div id="about" class="about-area area-padding container-fluid"> -->
<div class="container-fluid">
	<div class="panel-body">
		<div class="panel panel-info">
		    <div class="panel-heading">
		    	<div class="panel-heading"><span class="glyphicon glyphicon-th-list"></span>&nbsp;<b>Available Room</b></div>
		    </div>
	  	</div>
		<?php
			$tampilan_tabel=array('table_open'=>'<table margintop="0" class="table table-striped table-bordered table-condensed table-hover">',
			'heading_cell_start'=>'<th>',
			'row_start'=>'<tr>');
			$this->table->set_template($tampilan_tabel);

			$link =base_url();
			$no=0;
			$hal=$this->uri->segment(3);
			$no=$no+$hal;
			$hal=empty($hal)?0:$hal;

			 $this->table->set_heading(
			 	// anchor("availableroom/index/room/".
			 	// (($sort_order == 'asc' && $sort_by == 'room') ? 'desc' : 'asc'),'Room '.  (($sort_by == 'room') ? (($sort_order=='asc') ? '▲' : '▼') : '')),
			 	// anchor("availableroom/index/name/".
			 	// (($sort_order == 'asc' && $sort_by == 'name') ? 'desc' : 'asc'),'Name '.  (($sort_by == 'name') ? (($sort_order=='asc') ? '▲' : '▼') : '')),
			 	// anchor("availableroom/index/durasi/".
			 	// (($sort_order == 'asc' && $sort_by == 'durasi') ? 'desc' : 'asc'),'Durasi '.  (($sort_by == 'durasi') ? (($sort_order=='asc') ? '▲' : '▼') : '')),
			 	"Room",
			 	"Name",
			 	"Durasi",
			 	"Action");
			if(isset($roomavailable)){
				foreach($roomavailable->result() as $baris){
					$this->table->add_row(
						$baris->room,
						$baris->name,
						$baris->durasi
					);
				}
			}
			echo $this->table->generate();
		?>
		<?php
		echo $halaman;
		?>
	</div>
</div>

</body>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>

</html>

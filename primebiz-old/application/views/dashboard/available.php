<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h7 class="h3 mb-0 text-gray-800">Available Room</h7>
  </div>
	<div class="panel-body">
		<div class="row">
			<table class="table">
				<thead>
          <th>#</th>
          <th>Room</th>
          <th>Guest Name</th>
          <th>Session</th>
          <th>Action</th>
				</thead>
				<tbody>
          <?php
            $no = 1;
            foreach($room as $row) {
              echo "
              <tr>
                <td>$no</td>
                <td>$row[room]</td>
                <td>$row[name]</td>
                <td>$row[durasi]</td>
                <td>
                  <a href='#' data-toggle='modal' data-target='#reserveModal' class='btn btn-sm btn-info'>Reserve</a>
                </td>
              </tr>
              ";
              $no++;
            }
          ?>
				</tbody>
			</table>
		</div>
	</div>

  <!--<div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h7 class="modal-title" id="exampleModalLabel">Room Reservation</h7>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
       <div class="modal-body">
          <form>
             <div class="row">
              <div class="col-lg-12">
                <div id="kolom1" class="col-lg-6">
                  <div class="card-box">
                    <div class="form-group">  
                      <label class="control-label" >First Name<sup>*</sup> : </label> 
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                  </div>
                </div>
                <div id="kolom2" class="col-lg-6">
                  <div class="card-box">
                    <div class="form-group">  
                      <label class="control-label" >Last Name : </label> 
                      <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Reset</button>
          <a class="btn btn-primary" href="#">Submit</a>
        </div> -->
  <div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Room Reservation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form >
          <div class="modal-body">
            <input type="hidden" name="id" id="id" value="0">
              <table class="table table-form">
                <tr><td style="width: 25%">First Name<sup>*</sup> :</td><td style="width: 75%"><input type="text" class="form-control" name="nama" id="nama" required></td></tr>
                <tr><td style="width: 25%">Last Name : </td><td style="width: 75%"><input type="text" class="form-control" name="nim" id="nim" required></td></tr>
              </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
            <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-minus-circle"></i> Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

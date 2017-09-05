<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Edit Perusahaan</h4>
      	</div>
      	<div class="modal-body">
      	<div id="loader_edit" class="loader" style="margin: 0 auto"></div>
      	<form id="edit_member" class="form-Perusahaan form-spinner">
   			<input type="hidden" name="id" id="upd_id" class="form-control">
   			<div class="row">
  				<div class="col-md-4">
		      		<div class="form-group">
		      			<label>Nama Perusahaan</label>
		      			<input type="text" name="nama_mlm" id="upd_nama_mlm" class="form-control text-uppercase" required="required">
		      		</div>
	      		</div>
	      		<div class="col-md-8">
		      		<div class="form-group">
		      			<label>Deskripsi Perusahaan</label>
		      			<input type="text" name="desk_mlm" id="upd_desk_mlm" class="form-control text-capitalize" required="required">
		      		</div>
		      	</div>
      		</div>
      		<div class="row">
      			<div class="col-md-6">
		      		<div class="form-group">
		      			<label>Nama Distributor MLM</label>
		      			<input type="text" name="nama_distributor_mlm" id="upd_nama_distributor_mlm" class="form-control">
		      		</div>
		      	</div>
      		</div>
      		<div class="row">
      			<div class="col-md-12">
      				<div class="form-group">
      					<label>Alamat Perusahaan Distributor</label>
      					<textarea rows="3" id="upd_alamat_distributor_mlm" name="alamat_distributor_mlm" class="form-control"></textarea>
      				</div>
      			</div>
      		</div>
		    <div class="row">
  				<div class="col-md-6">
		      		<div class="form-group">
		      			<label>No. HP</label>
		      			<input type="text" min="6" max="14" name="no_hp_mlm" id="upd_no_hp_mlm" class="form-control">
		      		</div>
		      	</div>
  				<div class="col-md-6">
		      		<div class="form-group">
		      			<label>No. Telpon</label>
		      			<input type="text" min="6" max="14" name="no_telp_mlm" id="upd_no_telp_mlm" class="form-control">
		      		</div>
		      	</div>
		    </div>
      	</div>
      	</form>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
        	<button type="button" class="btn btn-flat btn-primary pull-right update submit"><i class="fa fa-save"></i>  Simpan</button>
      	</div>
    </div>
  </div>
</div>
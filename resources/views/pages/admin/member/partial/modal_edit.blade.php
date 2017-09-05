
<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Edit Member</h4>
      	</div>
      	<div class="modal-body">
      	<div class="spinner"></div>
      	<form id="edit_member" class="form-member form-spinner">
   			<input type="hidden" name="id" id="upd_member_id" class="form-control">
   			<input type="hidden" name="idss" id="upd_member_relation_id" class="form-control">
   			<div class="row">
  				<div class="col-md-4">
		      		<div class="form-group">
		      			<label>ID Member</label>
		      			<input type="text" name="id_member" id="upd_id_member" class="form-control text-uppercase">
		      			<input type="hidden" name="member_id" id="upd_member_id" class="form-control text-uppercase">
		      		</div>
	      		</div>
	      		<div class="col-md-8">
		      		<div class="form-group">
		      			<label>Nama Member</label>
		      			<input type="text" name="nama_member" id="upd_nama_member" class="form-control text-capitalize">
		      		</div>
		      	</div>
      		</div>
		    <div class="row">
  				<div class="col-md-12">
		      		<div class="form-group">
		      			<label>Alamat</label>
		      			<textarea name="alamat_member" id="upd_alamat_member" class="form-control text-uppercase" rows="3"></textarea>
		      		</div>
		      	</div>
		     </div>
      		<div class="row">
  				<div class="col-md-6">
		      		<div class="form-group">
		      			<label>Email</label>
		      			<input type="email" name="email_member" id="upd_email_member" class="form-control">
		      		</div>
		      	</div>
		    </div>
		    <div class="row">
  				<div class="col-md-6">
		      		<div class="form-group">
		      			<label>No. HP</label>
		      			<input type="number" name="no_hp_member" id="upd_no_hp_member" class="form-control">
		      		</div>
		      	</div>
		      	<div class="col-md-6">
		      		<div class="form-group">
		      			<label>No. Telp</label>
		      			<input type="number" name="no_telp_member" id="upd_no_telp_member" class="form-control text-uppercase">
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
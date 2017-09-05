
<!-- Modal Edit -->
<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="edit">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Lihat Member</h4>
      	</div>
      	<div class="modal-body">
      	<div class="spinner"></div>
      	<form id="edit_member" class="form-member form-spinner">
   			<input readonly="readonly" type="hidden" name="id" id="shw_member_id" class="form-control">
   			<input readonly="readonly" type="hidden" name="idss" id="shw_member_relation_id" class="form-control">
   			<div class="row">
  				<div class="col-md-4">
		      		<div class="form-group">
		      			<label>ID Member</label>
		      			<input readonly="readonly" type="text" name="id_member" id="shw_id_member" class="form-control text-uppercase">
		      			<input readonly="readonly" type="hidden" name="member_id" id="shw_member_id" class="form-control text-uppercase">
		      		</div>
	      		</div>
	      		<div class="col-md-8">
		      		<div class="form-group">
		      			<label>Nama Member</label>
		      			<input readonly="readonly" type="text" name="nama_member" id="shw_nama_member" class="form-control text-capitalize">
		      		</div>
		      	</div>
      		</div>
		    <div class="row">
  				<div class="col-md-12">
		      		<div class="form-group">
		      			<label>Alamat</label>
		      			<textarea readonly="readonly" name="alamat_member" id="shw_alamat_member" class="form-control text-uppercase" rows="3"></textarea>
		      		</div>
		      	</div>
		     </div>
      		<div class="row">
  				<div class="col-md-6">
		      		<div class="form-group">
		      			<label>Email</label>
		      			<input readonly="readonly" type="email" name="email_member" id="shw_email_member" class="form-control">
		      		</div>
		      	</div>
		    </div>
		    <div class="row">
  				<div class="col-md-6">
		      		<div class="form-group">
		      			<label>No. HP</label>
		      			<input readonly="readonly" type="number" name="no_hp_member" id="shw_no_hp_member" class="form-control">
		      		</div>
		      	</div>
		      	<div class="col-md-6">
		      		<div class="form-group">
		      			<label>No. Telp</label>
		      			<input readonly="readonly" type="number" name="no_telp_member" id="shw_no_telp_member" class="form-control text-uppercase">
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
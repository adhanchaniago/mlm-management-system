
<!-- Modal Add -->
<div class="modal fade" id="add_member" tabindex="-1" role="dialog" aria-labelledby="add">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Tambah Member</h4>
      	</div>
      	<div class="modal-body">
      		<form id="reset_form" class="form-member">
      			<div class="row">
      				<div class="col-md-4">
			      		<div class="form-group">
			      			<label>ID Member</label>
			      			<input type="text" name="id_member" id="ins_id_member" class="form-control text-uppercase">
			      		</div>
		      		</div>
		      		<div class="col-md-8">
			      		<div class="form-group">
			      			<label>Nama Member</label>
			      			<input type="text" name="nama_member" id="ins_nama" class="form-control text-capitalize">
			      		</div>
			      	</div>
	      		</div>
	      		<div class="row">
	      			<div class="col-md-12">
	      				<div class="form-group">
			      			<label>Alamat</label>
			      			<textarea name="alamat_member" id="ins_alamat" class="form-control text-uppercase" rows="3"></textarea>
			      		</div>
	      			</div>	
	      		</div>
	      		<div class="row">
	      			<div class="col-md-4">
	      				<div class="form-group">
			      			<label>Email</label>
			      			<input type="text" name="email_member" id="ins_email" class="form-control">
			      		</div>
	      			</div>
	      		</div>
	      		<div class="row">
	      			<div class="col-md-6">
	      				<div class="form-group">
			      			<label>No. HP</label>
			      			<input type="text" name="no_hp_member" id="ins_no_hp" class="form-control">
			      		</div>
	      			</div>
	      			<div class="col-md-6">
	      				<div class="form-group">
			      			<label>No. Telp</label>
			      			<input type="text" name="no_telp_member" id="ins_no_telp" class="form-control text-uppercase">
			      		</div>
	      			</div>
	      		</div>
	    	</form>
      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
        	<button id="add_confirm_member" type="button" class="btn btn-flat btn-primary submit"><i class="fa fa-save"></i>  Simpan</button>
      	</div>
    </div>
  </div>
</div>

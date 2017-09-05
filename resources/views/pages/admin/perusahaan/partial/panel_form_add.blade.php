<form action="{{ route('addPerusahaan') }}" method="POST">
	{{ csrf_field() }}
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-plus"></i> Tambah Perusahaan</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			
			<div class="row">
	      		<div class="col-md-8">
		      		<div class="form-group">
		      			<label>Nama Perusahaan</label>
		      			<input type="text" name="nama_mlm" id="ins_nama_mlm" class="form-control text-capitalize" required="required">
		      		</div>
		      	</div>
      			<div class="col-md-12">
      				<div class="form-group">
		      			<label>Deskripsi Perusahaan</label>
		      			<input type="text" name="desk_mlm" id="ins_desk_mlm" class="form-control text-uppercase" required="required">
		      		</div>
      			</div>	

      			<div class="col-md-12">
      				<div class="form-group">
		      			<label>Nama Distributor MLM</label>
		      			<input type="text" name="nama_distributor_mlm" id="ins_nama_distributor_mlm" class="form-control text-uppercase" required="required">
		      		</div>
      			</div>	
      			<div class="col-md-12">
      				<div class="form-group">
		      			<label>Alamat Distributor MLM</label>
		      			<textarea rows="3" type="text" name="alamat_distributor_mlm" id="ins_alamat_distributor_mlm" class="form-control text-uppercase" required="required"></textarea>
		      		</div>
      			</div>	
      			<div class="col-md-12">
      				<div class="form-group">
		      			<label>URL Slug</label>
		      			<input type="text" name="url_slug" id="ins_url_slug" class="form-control text-uppercase" required="required">
		      		</div>
      			</div>	
	      			<div class="col-md-6">
	      				<div class="form-group">
			      			<label>No. HP MLM</label>
			      			<input type="text" name="no_hp_mlm" id="ins_no_hp_mlm" class="form-control">
			      		</div>
	      			</div>
	      			<div class="col-md-6">
	      				<div class="form-group">
			      			<label>No. Telp. MLM</label>
			      			<input type="text" name="no_telp_mlm" id="ins_no_telp_mlm" class="form-control">
			      		</div>
	      			</div>
      		</div>
  		</div><!-- /.box-body -->
  		<div class="box-footer">
  			<div class="row">
      			<div class="col-md-12">
      				<button type="submit" class="btn btn-block btn-success pull-right btn-flat"><i class="fa fa-save"></i>  Simpan</button>
      			</div>
      		</div>
  		</div>
	</div>
</form>
<!-- Modal Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Tambah Produk</h4>
      	</div>
      	<div class="modal-body">
      		<form id="add_produk_form" class="form-produk">
	      		<div class="form-group">
	      			<label>Kode Produk</label>
	      			<input type="text" name="kode_prod" id="add_kode_prod" class="form-control text-uppercase" required>
	      		</div>
	      		<div class="form-group">
	      			<label>Nama Produk</label>
	      			<input type="text" name="nama_prod" id="add_nama_prod" class="form-control text-capitalize">
	      		</div>
	      		<div class="form-group">
	      			<label>Diskon</label>
	      			<input type="text" name="disk_prod" id="add_disk_prod" class="form-control diskon" maxlength="3">
	      		</div>
	      		<div class="form-group">
	      			<label>Harga Katalog</label>
	      			<input type="text" name="harga_katalog_prod" id="add_harga_katalog_prod" class="form-control number" maxlength="6">
	      		</div>
	      		<div class="form-group">
	      			<label>Harga Member</label>
	      			<input type="text" name="harga_member_prod" id="add_harga_member_prod" class="form-control number" maxlength="6">
	      		</div>
	      		<div class="form-group">
	      			<label>Edisi Katalog</label>
	      			<input type="text" name="edisi_kat_prod" id="add_edisi_kat_prod" class="form-control text-uppercase">
	      		</div>
	    	</form>
      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
        	<button id="add_confirm" type="button" class="btn btn-flat btn-primary submit">Save changes</button>
      	</div>
    </div>
  </div>
</div>
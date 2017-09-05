<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Edit Produk</h4>
      	</div>
      	<div class="modal-body">
        <div id="loader_edit" class="loader" style="margin: 0 auto"></div>
      	<form id="edit_produk" class="form-produk">
   			<input type="hidden" name="id" id="upd_id" class="form-control">
      		<div class="form-group">
      			<label>Kode Produk</label>
      			<input type="text" name="kode_prod" id="upd_kode_prod" class="form-control text-uppercase">
      		</div>
      		<div class="form-group">
      			<label>Nama Produk</label>
      			<input type="text" name="nama_prod" id="upd_nama_prod" class="form-control text-capitalize">
      		</div>
      		<div class="form-group">
      			<label>Diskon</label>
      			<input type="text" name="disk_prod" id="upd_disk_prod" class="form-control number">
      		</div>
      		<div class="form-group">
      			<label>Harga Katalog</label>
      			<input type="text" name="harga_katalog_prod" id="upd_harga_katalog_prod" class="form-control text-right number">
      		</div>
      		<div class="form-group">
      			<label>Harga Netto</label>
      			<input type="text" name="harga_nett_prod" id="upd_harga_member_prod" class="form-control text-right number" readonly="readonly">
      		</div>
      		<div class="form-group">
      			<label>Edisi Katalog</label>
      			<input type="text" name="edisi_kat_prod" id="upd_edisi_kat_prod" class="form-control text-uppercase">
      		</div>
      	</div>
      	</form>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">Batal</button>
        	<button type="button" class="btn btn-flat btn-primary pull-right update submit"><i class="fa fa-save"></i>  Simpan</button>
      	</div>
    </div>
  </div>
</div>

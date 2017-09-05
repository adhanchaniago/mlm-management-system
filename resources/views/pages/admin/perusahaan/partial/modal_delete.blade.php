<!-- Modal Delete -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Delete Perusahaan</h4>
      	</div>
      	<div class="modal-body">
      	<div class="spinner"></div>
		  	<div id="delete_member" class="form-Perusahaan form-spinner">
        <h3>Anda yakin menghapus Nama Perusahaan ini?</h3>
        <br>
        <hr>
        <div class="callout callout-warning">
          <h4>Peringatan !<br></h4>
          <p>Jika anda menghapus Perusaahaan ini, maka Data Perusahaan seperti Data Produk, Data Member dan Invoice akan terhapus.</p>
        </div>
		  	</div>
      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
        	<button id="yes_confirm_delete_perusahaan" type="button" class="btn btn-flat btn-danger pull-right submit"><i class="fa fa-save"></i>  Hapus</button>
      	</div>
    </div>
  </div>
</div>
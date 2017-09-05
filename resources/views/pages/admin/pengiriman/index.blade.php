@section('htmlheader_title', '')
@extends('layouts.admin')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="callout callout-success" id="message_success" style="display: none">
            <h4><i class="fa fa-check-circle"></i>   Berhasil!</h4>
            <p id="message_success_w"></p>
        </div>
        <div class="callout callout-danger" id="message_error" style="display: none">
            <h4><i class="fa fa-exclamation"></i>   Gagal!</h4>
            <p class="message_error_w"></p>
        </div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					Data Produk 
				</div>
			</div>
			<div class="panel-body">
				@if($pengirimans->isEmpty())
					<h4 class="text-center">Tidak Ada Data</h4>
				@else
				<div id="loader" class="loadersmall center-block text-center" style="display: none"></div>
				<div class="col-md-6">
					<div class="btn-group">
						<button id="belum_dikirim" type="button" class="btn btn-default btn-flat btnstatus" disabled="disabled" value="Belum Dikirim"><i class="fa fa-check-circle"></i>  Tandai Belum Dikirim </button>
						<button id="dalam_proses" type="button" class="btn btn-default btn-flat btnstatus" disabled="disabled" value="Dalam Proses"><i class="fa fa-check-circle"></i>  Tandai Dalam Proses</button>
						<button id="sudah_dikirim" type="button" class="btn btn-default btn-flat btnstatus" disabled="disabled" value="Sudah Terkirim"><i class="fa fa-check-circle"></i>  Tandai Sudah Dikirim</button>
					</div>
				</div>
				<div class="col-md-2 col-md-offset-4">
				<form class="form-horizontal">
					<div class="form-group">
						<div class="input-group">
	                        <span class="input-group-addon">
	                          <input type="checkbox" id="chk_tanggal">
	                        </span>
		                    <input id="tanggal" type="text" class="form-control" placeholder="Pilih tanggal" readonly="readonly">
		                </div>
		            </div>
	                <div class="form-group">
						<div class="input-group">
							<input type="text" class="form-control">
						    <span class="input-group-btn">
						      <button type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i> </button>
						    </span>
						</div>
			        </div>
			    </form>
				</div>
				<div class="pull-right col-md-3">
					
				</div>
				<table id="table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center"><input id="checkall" type="checkbox"></th>
							<th>No.</th>
							<th class="text-center">Nama Member</th>
							<th class="text-center">Nama Expedisi</th>
							{{-- <th class="text-center">No. Resi</th> --}}
							{{-- <th class="text-center" class="text-center">Diskon (%)</th> --}}
							{{-- <th class="text-center">Tanggal Kirim</th> --}}
							<th class="text-center">Status<br>Pengiriman</th>
							<th class="text-center">Biaya<br>Pengiriman</th>
							<th class="text-center">Total<br>Pembelian</th>
							<th class="text-center">Total<br>Tagihan</th>
							<th class="text-center">Status<br>Pembayaran</th>
							{{-- <th class="text-center" class="text-center">Biaya<br>Pengiriman</th> --}}
							<th class="text-center" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody id="result">
						@foreach($pengirimans as $i => $pengiriman)
						<tr>
							<td class="text-center"><input id="{{ $i+1 }}" type="checkbox" value="{{ $pengiriman->id }}" class="case"></td>
							<td>{{ $i+1 }}</td>
							<td class="text-uppercase">{{ $pengiriman -> invoice -> member -> nama_member }} ({{ $pengiriman -> invoice -> member -> id_member }})</td>	
							<td class="text-uppercase">{{ $pengiriman -> expedisi -> nama_exp }}</td>
							{{-- <td class="text-capitalize">{{ $pengiriman -> no_resi_krm }}</td> --}}
							{{-- <td class="text-center text-uppercase">{{ $pengiriman -> no_inv_krm }}</td> --}}
							{{-- <td class="number">{{ $pengiriman -> tanggal_krm }}</td> --}}
							
							
							@if($pengiriman->status_krm == "Belum Dikirim")
								<td id="label_{{ $pengiriman->id }}" class="text-center">
									<span class="label label-danger">Belum Dikirim</span>
								</td>
							@elseif($pengiriman->status_krm == "Dalam Proses")
								<td id="label_{{ $pengiriman->id }}" class="text-center">
									<span class="label label-info">Dalam Proses</span>
								</td>
							@elseif($pengiriman->status_krm == "Sudah Terkirim")
								<td id="label_{{ $pengiriman->id }}" class="text-center">
									<span class="label label-success">Sudah Terkirim</span>
								</td>
							@endif
							<td></td>
							<td></td>
							<td></td>
							@if($pengiriman->invoice->status_transfer_inv == "Belum")
								<td id="label_{{ $pengiriman->id }}" class="text-center">
									<span class="label label-danger">{{ $pengiriman->invoice->status_transfer_inv }}</span>
								</td>
							@elseif($pengiriman->status_krm == "Dalam")
								<td id="label_{{ $pengiriman->id }}" class="text-center">
									<span class="label label-info">{{ $pengiriman->invoice->status_transfer_inv }}</span>
								</td>
							@endif
							
							{{-- <td class="text-center text-uppercase">{{ $pengiriman -> biaya_krm }}</td> --}}
							<td class="text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-flat btn-default btn-xs edit" value="{{ $pengiriman -> id }}"><i class="fa fa-edit"></i>  Edit</button>
									<button type="button" class="btn btn-flat btn-default btn-xs delete" value="{{ $pengiriman -> id }}"><i class="fa fa-trash"></i>  Delete</button>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>

			<div class="panel-footer">
				
			</div>
		</div>
	</div>
</div>


<!-- Modal Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Tambah Produk</h4>
      	</div>
      	<div class="modal-body">
      		<form id="reset_form" class="form-produk">
	      		<div class="form-group">
	      			<label>Kode Produk</label>
	      			<input type="text" name="kode_prod" id="ins_kode_prod" class="form-control text-uppercase">
	      		</div>
	      		<div class="form-group">
	      			<label>Nama Produk</label>
	      			<input type="text" name="nama_prod" id="ins_nama_prod" class="form-control text-capitalize">
	      		</div>
	      		<div class="form-group">
	      			<label>Diskon</label>
	      			<input type="text" name="disk_prod" id="ins_disk_prod" class="form-control">
	      		</div>
	      		<div class="form-group">
	      			<label>Harga Katalog</label>
	      			<input type="text" name="harga_prod" id="ins_harga_prod" class="form-control number">
	      		</div>
	      		<div class="form-group">
	      			<label>Harga Katalog</label>
	      			<input type="text" name="harga_nett_prod" id="ins_harga_nett_prod" class="form-control number" readonly="readonly">
	      		</div>
	      		<div class="form-group">
	      			<label>Edisi Katalog</label>
	      			<input type="text" name="edisi_kat_prod" id="ins_edisi_kat_prod" class="form-control text-uppercase">
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

<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Edit Produk</h4>
      	</div>
      	<div class="modal-body">
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
      			<input type="text" name="disk_prod" id="upd_disk_prod" class="form-control">
      		</div>
      		<div class="form-group">
      			<label>Harga Katalog</label>
      			<input type="text" name="harga_prod" id="upd_harga_prod" class="form-control number">
      		</div>
      		<div class="form-group">
      			<label>Harga Netto</label>
      			<input type="text" name="harga_nett_prod" id="upd_harga_nett_prod" class="form-control number" readonly="readonly">
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

<!-- Modal Delete -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Hapus Produk</h4>
      	</div>
      	<div class="modal-body" id="hapus_content">
      		
      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
        	<button type="button" class="btn btn-flat btn-primary" id="delete_confirm"><i class="fa fa-trash"></i>  Hapus</button>
      	</div>
    </div>
  </div>
</div>

@endsection
@push('css')
<style type="text/css">
.modal-backdrop {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: -9999;
    background-color: #000;
}
</style>
@endpush

@push('script')
<script type="text/javascript">
$('body').attr('class','skin-blue sidebar-mini sidebar-collapse');
var checked = [];
	// Ajax CSRF TOKEN
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      }
  });

function enableDisableButton(){
	if (checked != 0) {
		$('.btnstatus').prop('disabled', false);
	} else {
		$('.btnstatus').prop('disabled', true);
	}
}

$('#checkall').on('ifChecked', function(event){
	$('input.case').iCheck('check');
});

$('#checkall').on('ifUnchecked', function(event){
	$('input.case').iCheck('uncheck');
});

$('input.case').on('ifChecked', function(event){
	id = $(this).val().toString();
	checked.push(id)
	enableDisableButton();
});

$('input.case').on('ifUnchecked', function(event){
  	id = $(this).val().toString();
  	var i = checked.indexOf(id);
	if(i != -1) {
		checked.splice(i, 1);
	}
	enableDisableButton();
});

$('body').on('click', '.btnstatus', function(){
	var status_krm = $(this).val();
	$.each(checked, function(i,val){
		$('#label_'+val).html('<i class="fa fa-circle-o-notch fa-pulse fa-fw"></i>');
	});
	$.ajax({
		url : '{{ route('ajaxStatusPengiriman') }}',
		type : 'POST',
		data : {status_krm : status_krm, 'id' : checked},
		success : function(data){
			$.each(data,function(i, val){
				if (status_krm == "Belum Dikirim") {
					$("#label_"+val).html('<span id="label_' + val + '" class="label label-danger">' + status_krm + '</span>');
				} else if (status_krm == "Dalam Proses") {
					$("#label_"+val).html('<span id="label_' + val + '" class="label label-info">' + status_krm + '</span>');
				} else if (status_krm == "Sudah Terkirim") {
					$("#label_"+val).html('<span id="label_' + val + '" class="label label-success">' + status_krm + '</span>');
				}
			});
		}
	});
});
</script>
<script type="text/javascript">
// Checkbok untuk mengaktifkan Tanggal DateRange
$('#chk_tanggal').on('ifChecked', function(event){
	$('#tanggal').prop('readonly', false);
});

$('#chk_tanggal').on('ifUnchecked', function(event){
	$('#tanggal').prop('readonly', true);
});

// Checkbok untuk mengaktifkan Tanggal DateRange
$('#chk_tanggal').on('ifChecked', function(event){
	$('#tanggal').prop('readonly', false);
});

$('#chk_tanggal').on('ifUnchecked', function(event){
	$('#tanggal').prop('readonly', true);
});

$('#tanggal').daterangepicker(
    {
		ranges: {
		'Hari Ini': [moment(), moment()],
		'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
		'30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
		'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
		'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		locale: {
		  format: 'DD/MM/YYYY'
		},
		startDate: moment().subtract(29, 'days'),
		endDate: moment()
    },
    function (start, end) {
      $('#tanggal span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
);
$('#tanggal').on('change',function(){
	dates = $(this).val().replace(/ /g,'').split("-");
	date0 = dates[0];
	date1 = dates[1];
	console.log(date1);
});
</script>
@endpush
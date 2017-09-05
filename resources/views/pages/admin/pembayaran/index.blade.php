@section('htmlheader_title', 'Tagihan Member')
@extends('layouts.admin')

@section('main-content')

<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-12">
			@if(Session::has('message'))
				<div class="callout {!! Session::get('callout-class') !!}">
		        	<h4>Berhasil!</h4>
		        	<p>{!! Session::get('isi_message') !!}</p>
		      	</div>
			@endif
		</div>
		<div class="col-md-12">
			<div class="callout callout-success" id="message_success" style="display: none">
                <h4><i class="fa fa-check-circle"></i>   Berhasil!</h4>
                <p id="message_success_w"></p>
            </div>
            <div class="callout callout-danger" id="message_error" style="display: none">
                <h4><i class="fa fa-exclamation"></i>   Gagal!</h4>
                <p id="message_error_w"></p>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="callout callout-success" id="message_success" style="display: none">
                <h4><i class="fa fa-check-circle"></i>   Berhasil!</h4>
                <p id="message_success_w"></p>
            </div>
            <div class="callout callout-danger" id="message_error" style="display: none">
                <h4><i class="fa fa-exclamation"></i>   Gagal!</h4>
                <p id="message_error_w"></p>
            </div>
		</div>
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-money"></i>   Tagihan Pembayaran</h3>
				</div><!-- /.box-header -->
				<div class="box-body">	
					<a href="{{ route('addPembayaran')}}">Add</a>
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Nama Member</th>
								<th>Jenis<br>Pembayaran</th>
								<th>Jumlah<br>Uang</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div><!-- /.box-body -->
            </div>
		</div>
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-money"></i>   Transaksi Pembayaran</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
					<form class="">
						<div class="form-group">
							<label>Nama Member</label>
							<input type="text" name="autocomplete_member" class="form-control">
						</div>
						<div class="form-group">
							<label>Jenis Pembarayan</label>
							<select name="jenis_pembayaran" class="form-control">
								<option value="transfer">Transfer</option>
								<option value="tunai">Tunai</option>
							</select>
						</div>
						<div class="form-group">
							<label>Jumlah Pembayaran</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<button type="submit"><i class="fa fa-plus"></i>   Tambah</button>
						</div>
					</form>
				</div><!-- /.box-body -->
            </div>
		</div>
	</div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="add_member" tabindex="-1" role="dialog" aria-labelledby="add">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Tambah Member</h4>
      	</div>
      	<div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-4">
	      			<table class="table table-bordered table-hover table-condensed table-striped">
	      				<thead>
	      					<tr>
	      						<th class="col-md-6">ID Member</th>
	      						<th class="col-md-6">Jenis Member</th>
	      					</tr>
	      				</thead>
	      				<tbody>
	      					@foreach($sidebar_menus as $i => $perusahaan)
	      					<tr>
	      						<td>
	      							<input type="text" name="multi_id_member[{{ $i }}]" class="form-control multi_id_member">
	      						</td>
	      						<td>
	      							<input type="hidden" name="id_jenis_perusahaan[]" value="{{$perusahaan->id}}">
		      						<input type="text" name="jenis_perusahaan[]" value="{{$perusahaan->nama_mlm}}" class="form-control" readonly="readonly">
	      						</td>
	      					</tr>
	      					@endforeach
	      				</tbody>
	      			</table>
	      			{{-- <div class="col-md-6">

	      				<div class="form-group">
	      					<input type="text" name="id_member" class="form-control">
	      				</div>
	      			</div>
	      			<div class="col-md-6">
	      				
	      				<div class="form-group">
	      					<select name="" class="form-control">
	      						@foreach($sidebar_menus as $perusahaan)
	      						<option value="{{$perusahaan->id}}">{{ $perusahaan->nama_mlm }}</option>
	      						@endforeach
	      					</select>
	      				</div>
	      			</div> --}}
	      		</div>
	      		<div class="col-md-8">
		      		<form id="reset_form" class="form-member">
		      			<div class="row">
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
	      	</div>
      		
      	</div>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
        	<button id="add_confirm_member" type="button" class="btn btn-flat btn-primary submit"><i class="fa fa-save"></i>  Simpan</button>
      	</div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      	<div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title" id="">Edit Member</h4>
      	</div>
      	<div class="modal-body">
      	
      	</form>
      	<div class="modal-footer">
        	<button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
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
        	<h4 class="modal-title" id="">Hapus Member</h4>
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
	$('body').on('keyup','#search', function(){

		$.ajaxSetup({
		 	'cache' : true,
		  	headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
		});

		// type = "all";
		$.ajax({
			url : '{{ route('ajaxSearchMemberAll') }}',
			type : 'POST',
			data : {'search': this.value},
			success : function(response){
				if(response.length == 0){
					$result = "<td colspan='5'><h4 class='text-center'>Tidak Ada Data</h4></td>";
				} else {
					$result = response;
				}
				$('#result').html($result);
			}
		});
	});
</script>
@endpush
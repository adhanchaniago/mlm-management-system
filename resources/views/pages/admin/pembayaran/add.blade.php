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
		<div class="col-md-12">
			<form class="">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-money"></i>   Transaksi Pembayaran</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
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
				</div><!-- /.box-body -->
            </div>
			</form>
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
@endpush
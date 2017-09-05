@section('htmlheader_title', 'Import Data Excel')
@extends('layouts.admin')

@section('main-content')

<div class="container-fluid spark-screen">
	<div class="row">	
		
		<div class="col-md-10">
			<div class="callout callout-warning">
				<h4>Informasi Penting !</h4>

				<strong>Pastikan Anda sudah Download Backup Data (Produk dan Member) sebelum melakukan Import Data Excel.</strong>
			</div>
		</div>
		<div class="col-md-2">
			<form action="" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="backup" value="export">
				<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-download"></i>  Download Backup</button>
			</form>
		</div>

		<div class="col-md-6">
			<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Import Data Excel</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<form action="{{ route('postImportExcel') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
					<div class="panel-title">
						Import Data Excel
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama MLM</label>
								<select name="perusahaan_id" class="form-control">
									@isset($slug)
									<optgroup label="Default">
										<option value="{{ $slug }}" selected>{{ $slug }}</option>
									</optgroup>
									@endisset
									<optgroup label="Pilihan">
										@foreach($sidebar_menus as $perusahaan)
										<option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_mlm }}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Jenis Data</label>
								<select name="jenis_data" class="form-control">
									@isset($type)
									<optgroup label="Default">
										<option value="{{ $type }}" selected></option>
									</optgroup>
									@endisset
									<optgroup label="Pilihan">
										<option value="member">Member</option>
										<option value="katalog">Katalog</option>
									</optgroup>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label>File Excel</label>
							<div class="form-group">
								<input type="file" name="file_excel" class="form-control">
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-primary btn-flat">Import</button>
				</form>
            </div>
            <!-- /.box-body -->
          </div>
		</div>

		<div class="col-md-6">
			<form method="POST" action="">
			<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Export Data Excel</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	
            		{{ csrf_field() }}
            		<div class="form-group col-md-6">
            			<label>Nama Perusahaan</label>
            			<select name="perusahaan_id" class="form-control">
            				@foreach($sidebar_menus as $per)
            				<option value="{{ $per->id }}">{{ $per->nama_mlm }}</option>
            				@endforeach
            			</select>
            		</div>
            		<div class="form-group col-md-6">
            			<label>Jenis Data</label>
            			<select name="jenis_data" class="form-control">
            				<option value="member">Member</option>
            				<option value="katalog">Katalog</option>
            			</select>
            		</div>
            	
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
       			<button name="download_type" value="excel" type="submit" class="btn btn-default btn-flat pull-right">Download Excel</button>
       			<button name="download_type" value="pdf" type="submit" class="btn btn-default btn-flat pull-right">Download PDF</button>
            </div>
          </div>
          </form>
		</div>

		<div class="callout callout-success" id="message_success" style="display: none">
            <h4><i class="fa fa-check-circle"></i>   Berhasil!</h4>
            <p id="message_success_w"></p>
        </div>
        <div class="callout callout-danger" id="message_error" style="display: none">
            <h4><i class="fa fa-exclamation"></i>   Gagal!</h4>
            <p class="message_error_w"></p>
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


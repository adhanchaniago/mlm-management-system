<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title">
			Data Produk {{ $jenis_perusahaan ->nama_mlm}}
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<div class="pull-left">
					<div class="form-group">
						<button type="button" class="btn btn-flat btn-default add"><i class="fa fa-plus"></i>  Tambah Produk</button>
					</div>
				</div>
				<div class="pull-right col-md-4">
					<div class="form-group">
						<div class="input-group margin">
			                <input id="search" class="form-control text-uppercase" type="text">
		                    <span class="input-group-btn">
		                      <button id="btn_search" type="button" class="btn btn-info btn-flat">Cari</button>
		                    </span>
			            </div>
			        </div>
				</div>
			</div>
		</div>
		<hr>
		@if($produks->isEmpty())
			<h4 class="text-center">Tidak Ada Data</h4>
		@else
		<div id="loader" class="loadersmall center-block text-center" style="display: none"></div>
		<table id="table_produk" class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="text-center">No.</th>
					<th class="text-center">Kode Produk</th>
					<th class="text-center">Nama Produk</th>
					<th class="text-center">Harga<br>Katalog</th>
					<th class="text-center">Harga<br>Member</th>
					<th class="text-center" class="text-center">Diskon<br>(%)</th>
					<th class="text-center" class="text-center">Edisi<br>Katalog</th>
					<th class="text-center col-md-1" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody id="result">
				@foreach($produks as $i => $produk)
				<tr>	
					<td class="text-center text-uppercase">{{ $i + 1 }}</td>
					<td class="text-uppercase">{{ $produk -> kode_prod }}</td>
					<td class="text-capitalize">{{ $produk -> nama_prod }}</td>
					<td class="text-right number">{{ $produk -> harga_katalog_prod }}</td>
					<td class="text-right number">{{ $produk -> harga_member_prod }}</td>
					<td class="text-center text-uppercase">{{ $produk -> disk_prod }}</td>
					<td class="text-center text-uppercase">{{ $produk -> edisi_kat_prod }}</td>
					<td class="text-center">
						<div class="btn-group">
							<button type="button" class="btn btn-flat btn-default btn-sm edit" value="{{ $produk -> id }}"><i class="fa fa-edit"></i>  </button>
							<button type="button" class="btn btn-flat btn-default btn-sm delete" value="{{ $produk -> id }}"><i class="fa fa-trash"></i>  </button>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
	</div>

	<div class="box-footer">
		
	</div>
</div>
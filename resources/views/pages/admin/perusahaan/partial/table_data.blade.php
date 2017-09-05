<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><i class="fa fa-building"></i>   Perusahaan MLM</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="table" class="table table-bordered table-hover table-striped table-condensed">
			<thead>
				<tr>
					<th class="text-center col-md-1">No</th>
					<th class="text-center col-md-2">Nama MLM</th>
					{{-- <th class="col-md-3">Deskripsi</th> --}}
					<th class="col-md-3 text-center">Nama Distributor</th>
					<th class="text-center col-md-2">No. HP</th>
					<th class="text-center col-md-2">No. Telp</th>
					<th class="text-center col-md-2" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody id="result">
				@foreach($perusahaans as $no => $perusahaan)
					<tr>
						<td class="text-center"> {{ $no + 1 }} </td>
						<td> {{ $perusahaan->nama_mlm }} </td>
						{{-- <td> {{ $perusahaan->desk_mlm }} </td> --}}
						{{-- <td> {{ $perusahaan->alamat_distributor_mlm }} </td> --}}
						<td class="text-center"> {{ $perusahaan->nama_distributor_mlm }} </td>
						<td class="text-center"> {{ $perusahaan->no_hp_mlm }} </td>
						<td class="text-center"> {{ $perusahaan->no_telp_mlm }} </td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-flat btn-default btn-sm edit" value="{{ $perusahaan->id }}"><i class="fa fa-edit"></i>  </button>
								<button value="{{ $perusahaan->id }}" type="button" class="btn btn-flat btn-default btn-sm delete" value="{{ $perusahaan->id }}"><i class="fa fa-trash"></i>  </button>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div>
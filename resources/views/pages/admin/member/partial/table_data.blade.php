<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-title">
			Data Member {{ $jenis_perusahaan ->nama_mlm}}
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<div class="pull-left">
					<div class="form-group">
						<button type="button" class="btn btn-flat btn-default add_member"><i class="fa fa-plus"></i>  Tambah Member</button>
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
		@if($members->isEmpty())
			<h4 class="text-center">Tidak Ada Data</h4>
		@else
		<div id="loader" class="loadersmall center-block text-center" style="display: none"></div>
		<table id="table" class="table table-bordered table-hover table-striped table-condensed">
			<thead>
				<tr>
					<th class="text-center">No.</th>
					<th class="text-center col-md-1">ID Member</th>
					<th class="text-center col-md-2">Nama<br>Member</th>
					<!-- <th class="text-center">Email</th> -->
					<th class="text-center">Alamat</th>
					<th class="text-center col-md-1">No. HP</th>
					<th class="text-center col-md-1">No. Telp</th>
					<th class="text-center" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody id="result">
				@foreach($members as $i => $member)
				<tr>	
					<td class="text-uppercase text-center">{{ $i + 1 }}</td>
					<td class="text-uppercase">{{ $member -> id_member }}</td>
					<td class="text-capitalize">{{ $member -> nama_member }}</td>
					<!-- <td>{{ $member -> email_member }}</td> -->
					<td class="text-capitalize">{{ str_limit($member -> alamat_member, 60) }}</td>
					<td class="text-center">{{ $member -> no_hp_member }}</td>
					<td class="text-center">{{ $member -> no_telp_member }}</td>
					<td class="text-center">
						<div class="btn-group">
							<button type="button" class="btn btn-flat btn-default btn-sm show" value="{{ $member-> member_id }}"><i class="fa fa-external-link"></i>  </button>
							<button type="button" class="btn btn-flat btn-default btn-sm edit" value="{{ $member-> member_id }}"><i class="fa fa-edit"></i>  </button>
							<button type="button" class="btn btn-flat btn-default btn-sm delete" value="{{ $member-> member_id }}"><i class="fa fa-trash"></i>  </button>
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
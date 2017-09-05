@section('htmlheader_title', 'Edit Member')
@extends('layouts.admin')

@section('main-content') 

<div class="container-fluid spark-screen">
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
		<form action="{{ route('updateMember') }}" method="POST">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $member->id }}">
		<div class="col-md-12">
			<div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Member</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="row">
		      		<div class="col-md-4">
		      			<table class="table table-bordered table-hover table-condensed table-striped">
		      				<thead>
		      					<tr>
		      						<th class="col-md-6 text-center">Jenis Member</th>
		      						<th class="col-md-6 text-center">ID Member</th>
		      					</tr>
		      				</thead>
		      				<tbody>
		      					@foreach($member->relation as $i => $relation)
		      					<tr>
		      						<td>
		      							<input type="hidden" name="member_relations[{{ $i }}][id_member_relation]" value="{{$relation->id}}">
			      						<input type="text" name="member_relations[{{ $i }}][nama_perusahaan]" value="{{$relation->perusahaan->nama_mlm}}" class="form-control text-uppercase" readonly="readonly">
		      						</td>
		      						<td>
		      							<input type="text" name="member_relations[{{ $i }}][id_member]" class="form-control text-uppercase" value="{{ $relation->id_member }}">
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
			      			<div class="row">
					      		<div class="col-md-8">
						      		<div class="form-group">
						      			<label>Nama Member</label>
						      			<input type="text" name="nama_member" class="form-control text-capitalize" value="{{ $member->nama_member }}">
						      		</div>
						      	</div>
				      		</div>
				      		<div class="row">
				      			<div class="col-md-10">
				      				<div class="form-group">
						      			<label>Alamat</label>
						      			<textarea name="alamat_member" class="form-control text-uppercase" rows="3">{{ $member->alamat_member }}</textarea>
						      		</div>
				      			</div>	
				      		</div>
				      		<div class="row">
				      			<div class="col-md-4">
				      				<div class="form-group">
						      			<label>Email</label>
						      			<input type="text" name="email_member" class="form-control"value="{{ $member->email_member }}">
						      		</div>
				      			</div>
				      			<div class="col-md-4">
				      				<div class="form-group">
						      			<label>No. HP</label>
						      			<input type="text" name="no_hp_member" class="form-control"value="{{ $member->no_hp_member }}">
						      		</div>
				      			</div>
				      			<div class="col-md-4">
				      				<div class="form-group">
						      			<label>No. Telp</label>
						      			<input type="text" name="no_telp_member" class="form-control text-uppercase" value="{{ $member->no_telp_member }}">
						      		</div>
				      			</div>
				      		</div>
			    	</div>
		      	</div>
              </div><!-- /.box-body -->
              <div class="box-footer">
              	<div class="form-group pull-left">
              		<a href="{{ URL::previous() }}" class="btn btn-default btn-flat"><i class="fa fa-arrow-left"></i>  Kembali</a>
              	</div>
              	<div class="form-group pull-right">
              		<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i>  Simpan</button>
              	</div>
              </div>
            </div>
		</div>
		</form>
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

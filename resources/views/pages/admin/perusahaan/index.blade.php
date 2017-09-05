@section('htmlheader_title', 'Perusahaan MLM')
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
		<div class="col-md-8">
			@include('pages.admin.perusahaan.partial.table_data')
		</div>

		<div class="col-md-4">
			@include('pages.admin.perusahaan.partial.panel_form_add')
		</div>
	</div>
</div>

@include('pages.admin.perusahaan.partial.modal_edit')
@include('pages.admin.perusahaan.partial.modal_delete')

@endsection


@push('css')
	@include('pages.admin.perusahaan.partial.css')	
@endpush

@push('script')
	@include('pages.admin.perusahaan.partial.js')	
@endpush
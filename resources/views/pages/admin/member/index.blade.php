@section('htmlheader_title', $jenis_perusahaan->nama_mlm)
@extends('layouts.admin')

@section('main-content') 

<div class="row">
	@include('pages.admin.member.partial.message')
	<div class="col-md-12">
		@include('pages.admin.member.partial.table_data')
	</div>
</div>

@include('pages.admin.member.partial.modal_show')
@include('pages.admin.member.partial.modal_add')
@include('pages.admin.member.partial.modal_edit')
@include('pages.admin.member.partial.modal_delete')


@endsection
@push('css')
	@include('pages.admin.member.partial.css')
@endpush

@push('script')
	@include('pages.admin.member.partial.js')
@endpush
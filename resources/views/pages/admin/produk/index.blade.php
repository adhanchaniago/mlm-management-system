@section('htmlheader_title', $jenis_perusahaan->nama_mlm)
@extends('layouts.admin')
@section('main-content')
<div class="row">
	<div class="col-md-12">
		@include('pages.admin.produk.partial.message')
		@include('pages.admin.produk.partial.table_data')
	</div>
</div>

@include('pages.admin.produk.partial.modal_add')
@include('pages.admin.produk.partial.modal_edit')
@include('pages.admin.produk.partial.modal_delete')


@endsection
@push('css')
	@include('pages.admin.produk.partial.css')
@endpush

@push('script')
	@include('pages.admin.produk.partial.js')
@endpush
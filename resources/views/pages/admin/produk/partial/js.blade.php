
<script type="text/javascript">	
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
	    }
	});
	function addCommas(nStr) {
	    nStr += '';
	    var x = nStr.split(',');
	    var x1 = x[0];
	    var x2 = x.length > 1 ? ',' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + '.' + '$2');
	    }
	    return x1 + x2;
	}

	$('.number').autoNumeric("init", {
        aSep: '.',
        aDec: ',', 
        vMin: '0',
        vMax: '10000000'
	});
	$('.diskon').autoNumeric("init", {
        aSep: '.',
        aDec: ',', 
        vMin: '0',
        vMax: '100'
	});

	$(document).ready(function(){
		// Setting upd_harga_katalog_prod Number Comma
		$('body').on('change keyup blur','#upd_harga_katalog_prod , #upd_disk_prod', function(){
			$('.number').autoNumeric("init", {
		        aSep: '.',
		        aDec: ',', 
		        vMin: '0',
		        vMax: '10000000'
			});
			h_kat_prod = $('#upd_harga_katalog_prod').autoNumeric('get');
			disk_kat_prod = $('#upd_disk_prod').val();
			h_nett_prod = h_kat_prod - (h_kat_prod * disk_kat_prod / 100);
			$('#upd_harga_member_prod').autoNumeric('set', h_nett_prod);
		});

		// Form Validator
		$('.form-produk').validate({
	        rules: {
	            kode_prod: {
	                minlength: 3,
	                maxlength: 16,
	                required: true
	            },
	            nama_prod: {
	                minlength: 3,
	                maxlength: 100,
	                required: true
	            },
	            disk_prod: {
	                minlength: 1,
	                maxlength: 3,
	                required: true,
	                // regex: "^[0-9]"
	            },
	            harga_katalog_prod: {
	                minlength: 3,
	                maxlength: 6,
	                required: true
	            },
	            edisi_kat_prod: {
	                minlength: 1,
	                maxlength: 20,
	                required: false
	            }
	        },
	        highlight: function(element) {
	            $(element).closest('.form-group').addClass('has-error');
	        },
	        unhighlight: function(element) {
	            $(element).closest('.form-group').removeClass('has-error');
	        },
	        errorElement: 'span',
	        errorClass: 'help-block',
	        errorPlacement: function(error, element) {
	            if(element.parent('.input-group').length) {
	                error.insertAfter(element.parent());
	            } else {
	                error.insertAfter(element);
	            }
	        },
	        submitHandler: function(form) { // <- pass 'form' argument in
	            $(".submit").attr("disabled", true);
	            form.submit(); // <- use 'form' argument here.
	        }
	    });

	    $('.form-produk').on('keyup blur', function () {
	        if ($('.form-produk').valid()) {
	            $('.submit').prop('disabled', false);
	        } else {
	            $('.submit').prop('disabled', 'disabled');
	        }
	    });
	});

$(document).ready(function(){

	// Setting Global Variabel Javascript
	var field = ['id_prod','kode_prod','nama_prod','disk_prod','harga_katalog_prod','edisi_kat_prod'];

	function preventDbClick(obj){
		event.preventDefault();
		$el = $(obj);
		$el.prop('disabled', true);
		setTimeout(function(){$el.prop('disabled', false); }, 2000);
		return true;
	}

	function refresh(type,value){
		$.ajax({
			url : '{{ route('ajaxRefreshProduk',['slug'=> $slug]) }}',
			type : 'POST',
			data : {type: type,'value':value},
			success : function(response){
				if(response.length == 0){
					$result = "<td colspan='6'><h4 class='text-center'>Tidak Ada Data</h4></td>";
				} else {
					$result = "";
					$.each(response, function(i, val){

						$result += "<tr>";
						$result += "<td class='text-uppercase'>" + val.kode_prod + "</td>";
						$result += "<td class='text-capitalize'>" + val.nama_prod + "</td>";
						$result += "<td class='text-center'>" + val.disk_prod + "</td>";
						$result += "<td class='number text-right'>" + addCommas(val.harga_katalog_prod) + "</td>";
						$result += "<td class='number text-right'>" + addCommas(val.harga_member_prod) + "</td>";

						if (val.edisi_kat_prod == null) { 
							$result += "<td class='text-center'></td>";
						} else {
							$result += "<td class='text-center'>" + val.edisi_kat_prod + "</td>";	
						}

						$result += '<td class="text-center"><div class="btn-group"><button type="button" class="btn btn-flat btn-default btn-sm edit" value="' + val.id +'"><i class="fa fa-edit"></i>  </button><button type="button" class="btn btn-flat btn-default btn-sm delete" value="' + val.id +'"><i class="fa fa-trash"></i>  </button></div></td>';
						$result += "<tr>";
					});
				}

				$('#result').html($result);
			}

		});
	}

	// Show Modal BST Tambah Data
	$('body').on('click','.add', function(){
		$('#add').modal('show');
		$('body').on('click','#add_confirm',function(){
			if(preventDbClick(this)){
				$url = '{{ route('ajaxAddProduk', ['slug'=> $slug]) }}';
				kode_prod = $('#add_kode_prod').val();
				nama_prod = $('#add_nama_prod').val();
				disk_prod = $('#add_disk_prod').val();
				harga_katalog_prod = $('#add_harga_katalog_prod').autoNumeric('get');
				harga_member_prod = $('#add_harga_member_prod').autoNumeric('get');
				edisi_kat_prod = $('#add_edisi_kat_prod').val();
				$.ajax({
					url : $url,
					type : 'POST',
					data : {'kode_prod': kode_prod,'nama_prod' : nama_prod,'disk_prod' : disk_prod,'harga_katalog_prod' : harga_katalog_prod,'harga_member_prod' : harga_member_prod,'edisi_kat_prod' : edisi_kat_prod},
					success : function(response){
						$('#add').modal('hide');
						if (response = 1) {
							// $('#reset_form')[0].reset();
							$('#message_success_w').text("Produk berhasil diubah...");
							$('#message_success').show().fadeIn('slow').delay(3000).fadeOut('fast');
						} else {
							$('#message_error_w').text("Error...");
							$('#message_error').show().fadeIn('slow').delay(3000).fadeOut('fast');
						}
						refresh("addRefresh","");				
					}
				});
			}
		});
	});

	

	$('body').on('click','.edit', function(){
		$url = '{{ route('ajaxEditProduk', ['slug'=> $slug]) }}';
		var this_id = this.value;
		$.ajax({
			url : $url,
			type : 'POST',
			data : {'id': this.value},
			beforeSend : function(){
				$('#loader_edit').show();
				$('#edit_produk').hide();
			},
			success : function(response){
				$('#upd_id').val(response.id);
				$('#upd_kode_prod').val(response.kode_prod);
				$('#upd_nama_prod').val(response.nama_prod);
				$('#upd_disk_prod').val(response.disk_prod);
				$('#upd_harga_katalog_prod').autoNumeric('set',response.harga_katalog_prod);
				$('#upd_harga_member_prod').autoNumeric('set',response.harga_member_prod);
				$('#upd_edisi_kat_prod').val(response.edisi_kat_prod);
			}
		}).done(function(){
		$('#loader_edit').hide();
		$('#edit_produk').show();
	});
		$('#edit').modal('show');
	});

	$('body').on('click','.update', function(){
		if(preventDbClick(this)){
			$url = '{{ route('ajaxUpdateProduk', ['slug'=> $slug]) }}';
			id_prod = $('#upd_id').val();
			kode_prod = $('#upd_kode_prod').val();
			nama_prod = $('#upd_nama_prod').val();
			disk_prod = $('#upd_disk_prod').val();
			harga_katalog_prod = $('#upd_harga_katalog_prod').autoNumeric('get');
			harga_member_prod = $('#upd_harga_member_prod').autoNumeric('get');
			edisi_kat_prod = $('#upd_edisi_kat_prod').val();
			$.ajax({
				url : $url,
				type : 'POST',
				data : {'id': id_prod,'kode_prod': kode_prod,'nama_prod':nama_prod,'disk_prod':disk_prod,'harga_katalog_prod':harga_katalog_prod,'harga_member_prod':harga_member_prod,'edisi_kat_prod':edisi_kat_prod},
				success : function(response){
					$('#edit').modal('hide');
					if (response = 1) {
						$('#message_success_w').text("Produk berhasil diubah...");
						$('#message_success').show().fadeIn('slow').delay(3000).fadeOut('fast');
					} else {
						$('#message_error_w').text("Error...");
						$('#message_error').show().fadeIn('slow').delay(3000).fadeOut('fast');
					}
					refresh("editRefresh",$('#search').val());
				}
			});
		}
		// $('#edit').modal('show');
	});

	$('body').on('click','.delete', function(){
		$('#delete').modal('show');

		$url = '{{ route('ajaxDeleteProduk', ['slug'=> $slug]) }}';
		var id = this.value;
		$('#delete_confirm').on('click', function(){
			if(preventDbClick(this)){
				$.ajax({
					url : $url,
					type : 'POST',
					data : {'id': id},
					success : function(response){
						
					},
				}).done(function(response){
					$('#delete').modal('hide');
						if (response = 1) {
							$('#message_success_w').text("Produk berhasil diubah...");
							$('#message_success').show().fadeIn('slow').delay(3000).fadeOut('fast');
						}
						refresh("deleteRefresh",$('#search').val());
				});
			}
		});
	});

	$('body').on('click','#btn_search', function(){
		$.ajax({
			url : '{{ route('ajaxSearchProduk') }}',
			type : 'POST',
			data : {'search': $('#search').val() , 'id_perusahaan' : '{{ $jenis_perusahaan->id }}'},
			success : function(response){
				if(response.length == 0){
					$result = "<td colspan='6'><h4 class='text-center'>Tidak Ada Data</h4></td>";
				} else {
					$result = "";
					$.each(response, function(i, val){
						$result += "<tr>";
						$result += "<td class='text-center text-uppercase'>" + (i + 1) + "</td>";
						$result += "<td class='text-uppercase'>" + val.kode_prod + "</td>";
						$result += "<td class='text-capitalize'>" + val.nama_prod + "</td>";
						$result += "<td class='text-center'>" + val.disk_prod + "</td>";
						$result += "<td class='number text-right'>" + addCommas(val.harga_katalog_prod) + "</td>";
						$result += "<td class='number text-right'>" + addCommas(val.harga_member_prod) + "</td>";

						if (val.edisi_kat_prod == null) { 
							$result += "<td class='text-center'></td>";
						} else {
							$result += "<td class='text-center'>" + val.edisi_kat_prod + "</td>";	
						}

						$result += '<td class="text-center"><div class="btn-group"><button type="button" class="btn btn-flat btn-default btn-sm edit" value="' + val.id +'"><i class="fa fa-edit"></i>  </button><button type="button" class="btn btn-flat btn-default btn-sm delete" value="' + val.id +'"><i class="fa fa-trash"></i>  </button></div></td>';
						$result += "<tr>";
					});
				}
				$('#result').html($result);
			}
		});
	});

}); //end ready
</script>
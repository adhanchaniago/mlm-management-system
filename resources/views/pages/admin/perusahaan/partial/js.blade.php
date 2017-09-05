
<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
		 	'cache' : true,
		  	headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
		});
	});
	
$(document).ready(function(){

	// Setting Global Variabel Javascript
	var field = ['nama_mlm','desk_mlm','no_hp_mlm','no_telp_mlm'];

	function preventDbClick(obj){
		return true;
	}

	function refresh(){
		$.ajax({
			url : '{{ route('ajaxRefreshPerusahaan') }}',
			type : 'POST',
			beforeSend: function () {
	        	$('#result').hide().fadeOut('slow');
	    	},
			success : function(response){
				if(response.length == 0){
					$result = "<td colspan='7'><h4 class='text-center'>Tidak Ada Data</h4></td>";
				} else {
					$result = "";
					$.each(response, function(i, val){
						$result += "<tr>";
						$result += "<td class='text-center'>" + (i+1) + "</td>";
						$result += "<td class='text-uppercase'>" + val.nama_mlm + "</td>";
						// $result += "<td class='text-capitalize'>" + val.desk_mlm + "</td>";
						$result += "<td class='text-capitalize'>" + val.nama_distributor_mlm + "</td>";
						// $result += "<td>" + val.email_member + "</td>";
						$result += "<td class='text-center'>" + val.no_hp_mlm + "</td>";
						$result += "<td class='text-center'>" + val.no_telp_mlm + "</td>";
						$result += '<td class="text-center"><div class="btn-group"><button type="button" class="btn btn-flat btn-default btn-sm edit" value="' + val.id +'"><i class="fa fa-edit"></i>  </button><button type="button" class="btn btn-flat btn-default btn-sm delete" value="' + val.id +'"><i class="fa fa-trash"></i>  </button></div></td>';

						$result += "<tr>";
					});
				}
			}

		}).done(function(response) {
			// $('#result').show().delay(10000).;
			$('#result').html($result).fadeIn('slow');
		});
	}

	$('body').on('click','.edit', function(){
		$url = '{{ route('ajaxEditPerusahaan') }}';
		var this_id = this.value;
		$.ajax({
			url : $url,
			type : 'POST',
			data : {'id': this.value},
			beforeSend: function () {
	        	
	        	$('#edit_member').hide();
	        	$('#loader_edit').show();
	        	$('#edit').modal('show');
	    	},
			success : function(response){
		  		$('#upd_id').val(response.id);
				$('#upd_nama_mlm').val(response.nama_mlm);
				$('#upd_desk_mlm').val(response.desk_mlm);
				$('#upd_nama_distributor_mlm').val(response.nama_distributor_mlm);
				$('#upd_alamat_distributor_mlm').val(response.alamat_distributor_mlm);
				$('#upd_no_hp_mlm').val(response.no_hp_mlm);
				$('#upd_no_telp_mlm').val(response.no_telp_mlm);
			}
		}).done(function(response) {
			$('#edit_member').show().fadeIn('slow');
        	$('#loader_edit').hide().fadeOut('slow');
		});
		
	});

	$('body').on('click','.delete', function(){
		$('#yes_confirm_delete_perusahaan').val(this.value);
		$('#delete').modal('show');		

	});
	$('body').on('click','#yes_confirm_delete_perusahaan', function(){
		id_perusahaan = $('#yes_confirm_delete_perusahaan').val();

		$.ajax({
			url : '{{ route('ajaxDeletePerusahaan') }}',
			type : 'POST',
			data : {'id_perusahaan':id_perusahaan},
			success : function(response){
				$('#delete').modal('hide');
				if (response = 1) {
					$('#message_success_w').html("<h5>Perusahaan MLM Berhasil Dihapus...<h5>");
					$('#message_success').show().fadeIn('slow').delay(5000).fadeOut('fast');
				} else {
					$('#message_error_w').text("Error...");
					$('#message_error').show().fadeIn('slow').delay(5000).fadeOut('fast');
				}
				refresh("editRefresh",$('#search').val());
			}
		});
	});

	$('body').on('click','.update', function(){
		if(preventDbClick(this)){
			// search = $('#search').val();
			$url = '{{ route('ajaxUpdatePerusahaan') }}';
			id = $('#upd_id').val();
			nama_mlm = $('#upd_nama_mlm').val();
			desk_mlm = $('#upd_desk_mlm').val();
			nama_distributor_mlm = $('#upd_nama_distributor_mlm').val();
			alamat_distributor_mlm = $('#upd_alamat_distributor_mlm').val();
			no_hp_mlm = $('#upd_no_hp_mlm').val();
			no_telp_mlm = $('#upd_no_telp_mlm').val();
			$.ajax({
				url : $url,
				type : 'POST',
				data : {'id': id,'nama_mlm': nama_mlm,'desk_mlm':desk_mlm,'nama_distributor_mlm':nama_distributor_mlm,'alamat_distributor_mlm':alamat_distributor_mlm,'no_hp_mlm':no_hp_mlm,'no_telp_mlm':no_telp_mlm},
				success : function(response){
					$('#edit').modal('hide');
					if (response = 1) {
						$('#message_success_w').html("<h5>Perusahaan : <strong>" + nama_mlm + " </strong> Berhasil di Ubah<h5>");
						$('#message_success').show().fadeIn('slow').delay(10000).fadeOut('fast');
					} else {
						$('#message_error_w').text("Error...");
						$('#message_error').show().fadeIn('slow').delay(10000).fadeOut('fast');
					}
					refresh("editRefresh",$('#search').val());
				}
			});
		}
		// $('#edit').modal('show');
	});
}); //end ready
</script>
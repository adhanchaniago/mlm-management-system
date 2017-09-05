<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
		 	'cache' : true,
		  	headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
		});
	});

	
	
// });

// $('#testcallout').hide();
$(document).ready(function(){

	// Setting Global Variabel Javascript
	var field = ['id_member','nama_member','email_member','no_hp_member','no_telp_member','alamat_member'];

	function preventDbClick(obj){
		return true;
	}

	function refresh(type,value){
		search = $('#search').val();
		$.ajax({
			url : '{{ route('ajaxRefreshMember') }}',
			type : 'POST',
			data : {type: type,'value':value,'search':search,'id_perusahaan': '{{ $jenis_perusahaan->id }}'},
			success : function(response){
				if(response.length == 0){
					$result = "<td colspan='7'><h4 class='text-center'>Tidak Ada Data</h4></td>";
				} else {
					$result = "";
					$.each(response, function(i, val){
						$result += "<tr>";
						$result += "<td class='text-uppercase'>" + (i+1) + "</td>";
						$result += "<td class='text-uppercase'>" + val.id_member + "</td>";
						$result += "<td class='text-capitalize'>" + val.nama_member + "</td>";
						// $result += "<td>" + val.email_member + "</td>";
						$result += "<td>" + val.alamat_member + "</td>";
						$result += "<td>" + val.no_hp_member + "</td>";
						$result += "<td>" + val.no_telp_member + "</td>";
						$result += '<td class="text-center"><div class="btn-group"><button type="button" class="btn btn-flat btn-default btn-sm edit" value="' + val.id +'"><i class="fa fa-edit"></i>  </button><button type="button" class="btn btn-flat btn-default btn-sm delete" value="' + val.id +'"><i class="fa fa-trash"></i>  </button></div></td>';
						$result += "<tr>";
					});
				}

				$('#result').html($result);
			}

		});
	}

	$('body').on('click','.add_member', function(){
		$('#add_member').modal('show');
	});

	$('body').on('click','#add_confirm_member',function(){
		if(preventDbClick(this)){
			$url = '{{ route('ajaxAddMember', ['slug'=> $slug]) }}';
			id_member = $('#ins_id_member').val();
			nama = $('#ins_nama').val();
			email = $('#ins_email').val();
			no_hp = $('#ins_no_hp').val();
			no_telp = $('#ins_no_telp').val();
			alamat = $('#ins_alamat').val();
			$.ajax({
				url : $url,
				type : 'POST',
				data : {'id_member': id_member,'nama_member' : nama,'email_member' : email,'no_hp_member' : no_hp,'no_telp_member' : no_telp,'alamat_member':alamat},
				success : function(response){
					$('#add_member').modal('hide');
					if (response = 1) {
						$('#reset_form')[0].reset();
						$('#message_success_w').text("Member berhasil diubah...");
						$('#message_success').show().fadeIn('slow').delay(3000).fadeOut('fast');
					} else {
						$('#message_error_w').text("Error...");
						$('#message_error').show().fadeIn('slow').delay(3000).fadeOut('fast');
					}
					refresh("addRefresh","");				
				},
				error : function(response){
					$('#add_member').modal('hide');
					// $('#reset_form')[0].reset();
					$('#message_error_w').text("Maaf, Member tidak berhasil ditambahkan...");
					$('#message_error').show().fadeIn('slow').delay(10000).fadeOut('fast');

				}
			});
		}
		
	});

	$('body').on('click','.edit', function(){
		$url = '{{ route('ajaxEditMember', ['slug'=> $slug]) }}';
		var this_id = this.value;
		$.ajax({
			url : $url,
			type : 'POST',
			data : {'id': this.value},
			success : function(response){
				console.log(response);
		  		$('#upd_member_id').val(response.member.member_id);
		  		$('#upd_member_relation_id').val(response.member.member_relation_id);
				$('#upd_id_member').val(response.member.id_member);
				$('#upd_nama_member').val(response.member.nama_member);
				$('#upd_email_member').val(response.member.email_member);
				$('#upd_no_hp_member').val(response.member.no_hp_member);
				$('#upd_no_telp_member').val(response.member.no_telp_member);
				$('#upd_alamat_member').val(response.member.alamat_member);
			}
		}).done(function(response) {
			$('#edit').modal('show');
		});
		
	});



	$('body').on('click','.show', function(){
		$url = '{{ route('ajaxShowMember') }}';
		var this_id = this.value;
		$.ajax({
			url : $url,
			type : 'POST',
			data : {'id': this.value, perusahaan_id : '{{ $jenis_perusahaan->id }}'},
			success : function(response){
				console.log(response);
		  		$('#shw_member_id').val(response.member.member_id);
		  		$('#shw_member_relation_id').val(response.member.member_relation_id);
				$('#shw_id_member').val(response.member.id_member);
				$('#shw_nama_member').val(response.member.nama_member);
				$('#shw_email_member').val(response.member.email_member);
				$('#shw_no_hp_member').val(response.member.no_hp_member);
				$('#shw_no_telp_member').val(response.member.no_telp_member);
				$('#shw_alamat_member').val(response.member.alamat_member);
			}
		}).done(function(response) {
			$('#show').modal('show');
		});
		
	});

	$('body').on('click','.update', function(){
		if(preventDbClick(this)){
			// search = $('#search').val();
			$url = '{{ route('ajaxUpdateMember', ['slug'=> $slug]) }}';
			member_relation_id = $('#upd_member_relation_id').val();
			id_member = $('#upd_id_member').val();
			member_id = $('#upd_member_id').val();
			nama_member = $('#upd_nama_member').val();
			email_member = $('#upd_email_member').val();
			no_hp_member = $('#upd_no_hp_member').val();
			no_telp_member = $('#upd_no_telp_member').val();
			alamat_member = $('#upd_alamat_member').val();
			$.ajax({
				url : $url,
				type : 'POST',
				data : {'member_relation_id': member_relation_id,'id_member': id_member,'member_id': member_id,'nama_member':nama_member,'email_member':email_member,'no_hp_member':no_hp_member,'no_telp_member':no_telp_member,'alamat_member':alamat_member},
				success : function(response){
					$('#edit').modal('hide');
					if (response = 1) {
						$('#message_success_w').html("<h5>Member dengan ID : <strong>" + id_member + " </strong>, Nama : <strong>" + nama_member + "</strong> Berhasil di Ubah<h5>");
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

	$('body').on('click','.delete', function(){
		$('#delete').modal('show');

		$url = '{{ route('ajaxDeleteMember', ['slug'=> $slug]) }}';
		var id = this.value;
		$('#delete_confirm').on('click', function(){
			if(preventDbClick(this)){
				$.ajax({
					url : $url,
					type : 'POST',
					data : {'id': id},
					success : function(response){
						
					},
					// 'error' : function(){
					// 	$('#message_error_w').text("Error...");
					// 	$('#message_error').show().fadeIn('slow').delay(3000).fadeOut('fast');
					// }
				}).done(function(response){
					$('#delete').modal('hide');
						if (response = 1) {
							$('#message_success_w').text("Member berhasil diubah...");
							$('#message_success').show().fadeIn('slow').delay(3000).fadeOut('fast');
						}
						refresh("deleteRefresh",$('#search').val());
				});
			}
		});
	});

	$('body').on('click','#btn_search', function(){
		$.ajax({
			url : '{{ route('ajaxSearchMember') }}',
			type : 'POST',
			data : {'search': $('#search').val(), 'id_perusahaan':'{{ $jenis_perusahaan->id }}'},
			beforeSend : function() {
				$('#loader').show();
				$('#table').hide();
			},
			success : function(response){
				if(response.length == 0){
					$result = "<td colspan='7'><h4 class='text-center'>Tidak Ada Data</h4></td>";
				} else {
					$result = "";
					$.each(response, function(i, val){
						$result += "<tr>";
						$result += "<td class='text-center'>" + (i+1) + "</td>";
						$result += "<td>" + val.id_member + "</td>";
						$result += "<td>" + val.nama_member + "</td>";
						$result += "<td>" + val.alamat_member + "</td>";
						$result += "<td class='text-center'>" + val.no_hp_member + "</td>";
						$result += "<td class='text-center'>" + val.no_telp_member + "</td>";
						$result += '<td class="text-center"><div class="btn-group"><button type="button" class="btn btn-flat btn-default btn-sm edit" value="' + val.id +'"><i class="fa fa-edit"></i>  </button><button type="button" class="btn btn-flat btn-default btn-sm delete" value="' + val.id +'"><i class="fa fa-trash"></i>  </button></div></td>';
						$result += "<tr>";
					});
				}
				$('#result').html($result);
			}
		}).done(function(){
			$('#loader').hide();
			$('#table').show();
		});
	});

}); //end ready
</script>
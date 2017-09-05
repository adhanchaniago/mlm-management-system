@foreach($members as $member)
<tr>	
	<td class="text-capitalize">{{ $member-> nama_member }}</td>
	<td class="text-capitalize">{{ $member-> alamat_member }}</td>
	<td class="text-center">{{ $member-> no_hp_member }}</td>
	<td class="text-center">{{ $member-> no_telp_member }}</td>	<td class="text-center">
		<div class="btn-group">
			<a href="{{ route('editMember', $member->id) }}" class="btn btn-flat btn-default btn-sm edit"><i class="fa fa-edit"></i>  </a>
			<a href="{{ route('deleteMember', $member->id) }}" class="btn btn-flat btn-default btn-sm delete" value="{{ $member-> id }}"><i class="fa fa-trash"></i>  </a>
		</div>
	</td>
</tr>
@endforeach
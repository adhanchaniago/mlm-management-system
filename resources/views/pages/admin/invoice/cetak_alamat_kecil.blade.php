@for($i = 1;$i<= $jumlah;$i++)
@if($i == 1 || $i == 3 || $i == 5 || $i == 7)
<div class="row">
@endif
<div class="col-md-6 col-sm-6 custom_alamat">
    <div class="col-md-6">
        <input type="text" name="autocomplete_member" class="autocomplete_member form-control hidden-print" placeholder="ID Member..." id="{{ $i }}">
    </div>
    <div class="col-md-12">
    <table class="pure-table pure-table-bordered pure-table-horizontal" style="width: 98%">
        <thead>
            
        <tr>
          <th>Kepada</th>
          <th id="nama_member_{{ $i }}"></th>
        </tr>
        </thead>
      <tbody>
        <tr>
          <th>Alamat</th>
          <th class="alamat_member" id="alamat_member_{{ $i }}"></th>
        </tr>
        <tr>
          <th style="border-left: 1px solid #cbcbcb;/*  inner column border */border-width: 0 0 0 1px;font-size: 12px;margin: 0;overflow: visible; /*to make ths where the title is really long work*/
    padding: 0.5em 1em; /* cell padding */" colspan="2">No. HP : <strong id="no_hp_member_{{ $i }}"></strong>   &emsp;| &emsp; No. Telp : <strong id="no_telp_member_{{ $i }}"></strong></th>
        </tr>
      </tbody>

    </table >
    <table class="pure-table pure-table-bordered pure-table-horizontal"> 
      <thead>
    
        <tr>
          <th>Pengirim</th>
          <th id="nama_distributor_mlm_{{ $i }}"></th>
        </tr>
        </thead>
      <tbody>
        <tr>
          <th>Alamat</th>
          <th class="nama_distributor_mlm" id="alamat_distributor_mlm_{{ $i }}"></th>
        </tr>
        <tr>
          <th style="border-left: 1px solid #cbcbcb;/*  inner column border */border-width: 0 0 0 1px;font-size: 12px;margin: 0;overflow: visible; /*to make ths where the title is really long work*/
    padding: 0.5em 1em; /* cell padding */" colspan="2">No. HP : <strong id="no_hp_mlm{{ $i }}"></strong>   &emsp;| &emsp; No. Telp : <strong id="no_telp_mlm_{{ $i }}"></strong></th>
        </tr>
      </tbody>
    </table>
    </div> 
</div>
@if($i == 2 || $i == 4 || $i == 6 || $i == 8)
</div>
<br>
<hr>
<br>
@endif
@endfor
</div>
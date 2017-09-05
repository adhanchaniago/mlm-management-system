
{{-- <script type="text/javascript" src="{{ asset('plugins/autocomplete/jquery.autocomplete.min.js') }}"></script> --}}
<script type="text/javascript">
  // Auto Numeric CSS Class .number
  $('.number').autoNumeric("init", { aSep: '.', aDec: ',', vMin: '0', vMax: '99999999'});

  // Ajax CSRF TOKEN
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      }
  });

  $(document).ajaxError(function() {
    alert("Maaf, Terjadi kesalahan sistem...");
  });

  // Inisialisasi autoNumeric (Thousand Separator)
  $('body').on('focus change blur keyup','.number',function(){
    $(this).autoNumeric("init", { aSep: '.', aDec: ',', vMin: '0', vMax: '99999999'});
  });

  // Antisipasi Hitung Error
  function checkNaN(val){
    if (isNaN(val)) {
      val = '';
      return val;
    } else {
      return val;
    }
  }

  // Hitung Total Akhir (Termasuk Biaya Kirim)
  function getTotalAkhir(){
    tot_awal = 0;
    $('.subtotal').each(function(){
      tot_awal += parseInt($(this).autoNumeric('get'));
    });

    // biaya_kirim = $('#biaya_kirim').autoNumeric('get');
    // total_akhir = parseInt(tot_awal) + parseInt(biaya_kirim);
    total_akhir = parseInt(tot_awal);
    return total_akhir;
  }

  // Tambah Table Row
  $('body').on('click','#add_row',function(){
    i = $('#tb_invoice tbody tr').length;
    a = i + 1;
    tr = '<tr>';
    tr += '<input id="pid_'+ a +'" type="hidden" name="invoiceDetail['+ i +'][id_prod_det]" class="form-control text-uppercase autocomplete_produk">';
    tr += '<td>'+ a +'</td>';
    tr += '<td><input id="kode_prod_'+ a +'" type="text" name="invoiceDetail['+ i +'][kode_prod_det]" class="form-control text-uppercase autocomplete_produk" pattern="[a-zA-Z0-9]+" required="required"></td>';
    tr += '<td><input id="nama_prod_'+ a +'" type="text" name="invoiceDetail['+ i +'][nama_prod_det]" class="form-control text-capitalize"></td>';
    tr += '<td><input id="harga_katalog_'+ a +'" type="text" name="invoiceDetail['+ i +'][harga_katalog_det]" class="form-control text-right number changes"></td>';
    tr += '<td><input id="harga_member_'+ a +'" type="text" name="invoiceDetail['+ i +'][harga_member_det]" class="form-control text-right number changes" readonly="readonly"></td>';
    tr += '<td><input id="disk_prod_'+ a +'" type="text" name="invoiceDetail['+ i +'][disk_prod_det]" class="form-control text-center changes"></td>';
    tr += '<td><input id="qty_prod_'+ a +'" type="text" name="invoiceDetail['+ i +'][jumlah_inv_det]" class="form-control text-center qty changes" value="1"></td>';
    tr += '<td><input id="subtotal_prod_'+ a +'" type="text" name="invoiceDetail['+ i +'][subtotal_inv]" class="form-control subtotal number subtotal text-right" readonly="readonly"></td>';
    tr += '<td>';
    tr += '<button type="button" class="btn btn-default btn-flat btn-sm delete_row"><i class="fa fa-trash"></i>  </button>';
    tr += '</td>';
    tr += '</tr>';
    $('#tb_invoice_tr').append(tr);
  });

  // Hapus Table Row
  $('body').on('click','.delete_row',function(){
    $(this).parent().parent().remove();
    // console.log(getTotalAkhir());
    $('#total_akhir').autoNumeric('set', getTotalAkhir());

  });
 
  // Autocomplete Produk
  $('body').on('focus','.autocomplete_produk',function(){
    perusahaan_id = '{{ $jenis_perusahaan->id }}';
    $(this).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url : '{{ route('ajaxAutocompleteProdukInvoice') }}',
          dataType: "json",
          method: 'POST',
          data: {
             kode_prod : request.term,
             perusahaan_id : perusahaan_id
          },
           success: function( data ) {
             response( $.map( data, function( item ) {
              return {
                label: item.kode_prod,
                value: item.kode_prod,
                data : item
              }
            }));
          }
        });
      },
      select: function( event, ui ) {
        $('.number').autoNumeric("init", { aSep: '.', aDec: ',', vMin: '0', vMax: '99999999'});
        id = $(this).attr("id").replace("kode_prod_","");
        // harganett = ui.item.data.harga_katalog_prod - (ui.item.data.harga_katalog_prod * ui.item.data.disk_prod / 100);
        subtotal = parseInt(ui.item.data.harga_member_prod) * parseInt($("#qty_prod_"+id).val());
        $("#pid_"+id).val(ui.item.data.id);
        // $("#nama_prod_"+id).val(ui.item.data.nama_prod);
        $("#nama_prod_"+id).val(ui.item.data.nama_prod);
        $("#harga_katalog_"+id).autoNumeric('set',ui.item.data.harga_katalog_prod);
        $("#harga_member_"+id).autoNumeric('set',ui.item.data.harga_member_prod);
        $("#disk_prod_"+id).val(ui.item.data.disk_prod);
        $("#subtotal_prod_"+id).autoNumeric('set',subtotal);
        
        tot_awal = 0;
        $('.subtotal').each(function(){
          tot_awal += parseInt($(this).autoNumeric('get'));
        });

        $('#total_akhir').autoNumeric('set',tot_awal);
      },
      minLength: 1 
    });
  });

  // Hitung Semua .changes
  $('body').on('keyup','.changes', function(){   
    $('.number').autoNumeric("init", { aSep: '.', aDec: ',', vMin: '0', vMax: '99999999'});

    subtotal = 0;

    id = $(this).attr("id").split("_").pop();
    inp_harga_kat = checkNaN(parseFloat($('#harga_katalog_'+id).autoNumeric('get')));
    inp_disk = checkNaN(parseInt($('#disk_prod_'+id).val()));
    inp_harganett = checkNaN(parseFloat($('#harga_member_'+id).autoNumeric('get')));
    inp_qty = checkNaN(parseInt($('#qty_prod_'+id).val()));
    inp_subtotal = checkNaN(parseFloat($('#subtotal_prod_'+id).autoNumeric('get')));
    // inp_biaya_kirim = checkNaN(parseFloat($('#biaya_kirim').autoNumeric('get')));

    harganett = inp_harga_kat - (inp_harga_kat * inp_disk / 100);
    subtotal = harganett * inp_qty;
    $('#harga_katalog_'+id).autoNumeric('set', inp_harga_kat);
    $('#disk_prod_'+id).val(inp_disk);
    $('#harga_member_'+id).autoNumeric('set', harganett);
    $('#qty_prod_'+id).val(inp_qty);
    $('#subtotal_prod_'+id).autoNumeric('set', subtotal);
    $('#total_akhir').autoNumeric('set', getTotalAkhir());
  });

  // Hitung Biaya Kirim
  $('body').on('change keyup focus','#biaya_kirim', function(){
    $('#total_akhir').autoNumeric('set', getTotalAkhir());
  });


  // Hapus AutoNumeric
  $('form').submit(function(){
    var form = $(this);
    $('input').each(function(i){
        var self = $(this);
        try{
            var v = self.autoNumeric('get');
            self.autoNumeric('destroy');
            self.val(v);
        }catch(err){
            console.log("Not an autonumeric field: " + self.attr("name"));
        }
    });
    return true;
  });
</script>

<script type="text/javascript">
  $('body').on('focus','.autocomplete_member',function(){
    var perusahaan_id = '{{ $jenis_perusahaan->id }}';
    console.log(perusahaan_id);
    $(this).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url : '{{ route('ajaxAutocompleteMemberInvoice') }}',
          dataType: "json",
          method: 'POST',
          data: {
             id_member : request.term,
             perusahaan_id : perusahaan_id
          },
           success: function( data ) {
             response( $.map( data, function( item ) {
              return {
                label: item.id_member,
                value: item.id_member,
                data : item
              }
            }));
          }
        });
      },
      autoFocus: true,          
      minLength: 1,
      // appendTo: "#modal-fullscreen",
      select: function( event, ui ) {
        $("#uid").val(ui.item.data.id);
        // $("id_member").val(ui.item.data.id_member);
        $("#nama_member").val(ui.item.data.nama_member);
        $("#alamat_member").val(ui.item.data.alamat_member);
        $("#no_hp_member").val(ui.item.data.no_hp_member);
        $("#no_telp_member").val(ui.item.data.no_telp_member);
        $('#member_inv_id').val(ui.item.data.member_inv_id);
        // no_inv = $("#no_inv").val() + "/" + ui.item.data.id_member;
        // $("#no_inv").val(no_inv);
      } 
    });
  });
</script>








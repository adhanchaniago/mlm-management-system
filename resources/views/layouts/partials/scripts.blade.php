<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script src="{{ asset('plugins/jqueryui/jquery-ui.min.js') }}"></script>

{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script> --}}
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('plugins/autoNumeric/autoNumeric.min.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('plugins/jqBootstrapValidation/jqBootstrapValidation.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('plugins/jQuery/jquery.validate.min.js') }}"></script>


<script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/unserialize/unserialize.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
]); ?>
</script>
<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-blue',
    radioClass: 'iradio_flat-blue'
  });
});
</script>
@stack('script')
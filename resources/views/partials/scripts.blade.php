 <!-- jQuery -->
 <!-- <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script> -->
 <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>

 <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

 <!-- Bootstrap Core JavaScript -->
 <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

 <!-- Custom scripts for all pages-->
 <script src="{{asset('js/sb-admin-2.js')}}"></script>

 <!-- Page level plugins -->
 <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

 <!-- Page level custom scripts -->
 <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

 <script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"
   type="application/javascript"></script>

 <script type="application/javascript">
$('[data-countdown]').each(function() {
  var $this = $(this);
  var finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    $this.html(event.strftime('%D days %H:%M:%S'));
  });
});
 </script>
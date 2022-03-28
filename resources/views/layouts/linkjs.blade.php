<!-- General JS Scripts -->
<!-- <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script> -->
<script src="{{ asset('assets/module/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/module/popper/popper.min.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> -->
<script src="{{ asset('assets/module/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('assets/module/tooltip/dist/tooltip.min.js') }}"></script> -->
<script src="{{ asset('assets/module/moment/moment.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<!-- Datepicker -->
<script src="{{ asset('assets/module/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/module/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<!-- Datatable -->
<script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
<!-- jQUery Validation -->
<script src="{{ asset('assets/js/jquery-validation/jquery.validate.js') }}"></script>
<!-- NiceScroll -->
<script src="{{ asset('assets/module/nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<!-- Sweetalert -->
<script src="{{ asset('assets/module/sweetalert/sweetalert.js') }}"></script>
<!-- Bootstrap Growl -->
<script src="{{ asset('assets/module/bootstrap-growl-master/jquery.bootstrap-growl.min.js') }}"></script>


<script>
    $('.only-string').keypress(function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });

    $('.only-number').keypress(function (e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
    });

    $('.only-lowercase').bind('keyup', function (e) {
        if (e.which >= 97 && e.which <= 122) {
            var newKey = e.which - 32;
            // I have tried setting those
            e.keyCode = newKey;
            e.charCode = newKey;
        }

        $('.only-lowercase').val(($('.only-lowercase').val()).toLowerCase());
    });

    function logout()
    {
        $('#form-logout').submit();
    }
</script>
<!-- Modal -->
<div class="modal fade" id="indikator-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Indikator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form-indikator" autocomplete="off">
                <div class="modal-body">
                    {{ csrf_field() }}

                    <!-- Input Hidden -->
                    <input type="hidden" id="Kode_Aset">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Umur Ergonomis</label>
                                <input type="text" name="Umur_Ergonomis" required id="Ergonomis" class="form-control only-number"> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('custom-script')

    <script>
        // Jquery Validator
        $("#form-indikator").validate({
            // Rules
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                // Add Class
                $('.form-group').addClass('has-danger');
                // $('.form-control').addClass('form-control-danger');
            }
        });
    </script>

@endpush
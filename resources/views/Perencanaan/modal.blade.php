<div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Perencanaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="#">
                            <div class="row">
                                <!-- Nama Perencanaan -->
                                <div class="col-sm-2">
                                    <span><strong>Nama Perencanaan</strong></span>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" id="Nama_Perencanaan">
                                    </div>
                                </div>

                            </div>

                            <!-- Merek Aset -->
                            <div class="row">
                                <div class="col-sm-2">
                                    <span><strong>Merek Aset</strong></span>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" id="Merek_Aset">
                                    </div>
                                </div>
                            </div>

                            <!-- Harga Satuan -->
                            <div class="row">
                                <div class="col-sm-2">
                                    <span><strong>Harga Satuan</strong></span>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" id="Harga_Satuan">
                                    </div>
                                </div>
                            </div>

                            <!-- Jumlah Aset -->
                            <div class="row">
                                <div class="col-sm-2">
                                    <span><strong>Jumlah Aset</strong></span>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" id="Jumlah_Aset">
                                    </div>
                                </div>
                            </div>

                            <!-- Total Harga -->
                            <div class="row">
                                <div class="col-sm-2">
                                    <span><strong>Total Harga</strong></span>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" readonly class="form-control" id="Total_Harga">
                                    </div>
                                </div>
                            </div>

                            <!-- Alasan -->
                            <div class="row">
                                <div class="col-sm-2">
                                    <span><strong>Alasan</strong></span>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <textarea class="form-control" name="Alasan" id="Alasan" cols="30" rows="5" readonly></textarea>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
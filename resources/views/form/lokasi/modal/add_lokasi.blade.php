<div class="modal fade" id="add_lokasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                
            </div>
            <form id="quickForm">
                <div class="modal-body">  
                    <div class="form-group">
                        <label for="lokasi_add">Lokasi Barang</label>
                        <input type="text" class="form-control" name="lokasi_add" id="lokasi_add">
                        <div id="lokasi_add-error"></div>
                    </div>    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="store_data_lokasi">Simpan</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
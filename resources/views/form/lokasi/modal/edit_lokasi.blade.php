<div class="modal fade" id="edit_lokasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                
            </div>
            <form id="quickForm">
                <div class="modal-body">
                    <input type="hidden" id="id"> 
                    <div class="form-group">
                        <label for="lokasi_edit">lokasi Barang</label>
                        <input type="text" class="form-control" name="lokasi_edit" id="lokasi_edit">
                        <div id="lokasi_edit-error"></div>
                    </div>     
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="update_data_lokasi">Ubah</button>
                </div>            
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>